<?php

/*
Copyright (C) 2016 Pimwick, LLC

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

class Pimwick_Cleaner {
	public $error_message = '';

	private $_upload_dir = '';
	private $_whitelist_file = '';
	private $_extensions;

	function __construct() {
		$upload_dir = wp_upload_dir();
		$this->_upload_dir = $upload_dir['basedir'];
		$this->_whitelist_file = plugin_dir_path( dirname( __FILE__ ) ) . '/whitelist.txt';

		if ( basename( plugin_dir_path( dirname( __FILE__ ) ) ) == 'pw-image-cleaner' ) {
			$this->_extensions = array( 'png', 'jpg', 'jpeg', 'gif', 'bmp' );
		}
	}

	public function get_orphaned_files() {
		$this->all_files = $this->find_files( $this->_upload_dir );
		return $this->find_orphaned_files( $this->all_files );
	}

	public function get_whitelisted_files() {
		$files = array();

		$files[] = 'GeoIP.dat';
		$files[] = 'GeoIPv6.dat';
		$files[] = 'wc-logs/.htaccess';
		$files[] = 'wc-logs/index.html';
		$files[] = 'revslider/*';
		$files[] = 'woocommerce_uploads/.htaccess';
		$files[] = 'woocommerce_uploads/index.html';

		if ( is_file( $this->_whitelist_file ) ) {
			$files = array_merge( $files, file( $this->_whitelist_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES ) );
		}

		return $files;
	}

	public function error( $message ) {
		if ( !empty( $this->error_message ) ) {
			$this->error_message .= '<br />';
		}

		$this->error_message .= $message;
	}

	// Snippet from PHP Share: http://www.phpshare.org
	public function format_size( $bytes ) {
		if ( $bytes >= 1073741824 ) {
			$bytes = number_format( $bytes / 1073741824, 2 ) . ' GB';
		} else if ( $bytes >= 1048576 ) {
			$bytes = number_format( $bytes / 1048576, 2 ) . ' MB';
		} else if ( $bytes >= 1024 ) {
			$bytes = number_format( $bytes / 1024, 2 ) . ' KB';
		} else if ( $bytes > 1 || $bytes == 0 ) {
			$bytes = $bytes . ' bytes';
		} else {
			$bytes = '1 byte';
		}

		return $bytes;
	}

	private function find_orphaned_files( $files ) {
		global $wpdb;

		if ( empty( $files ) ) { return; }

		// Clear out any whitelisted files.
		foreach ( $this->get_whitelisted_files() as $whitelisted_file ) {
			if ( basename( $whitelisted_file ) == '*' || basename( $whitelisted_file ) == '*.*' ) {
				foreach ( $files as $filename => $filesize ) {
					if ( $this->startsWith( strtolower( dirname( $filename ) ), strtolower( dirname( $whitelisted_file ) ) ) ) {
						unset( $files[$filename] );
					}
				}
			} else {
				unset( $files[$whitelisted_file] );
				unset( $files[str_replace("\\", "/", $whitelisted_file)] );
			}
		}

		$wpdb->query( "
			CREATE TEMPORARY TABLE tmpAttachments (post_id INT, INDEX(post_id))
		");

		$wpdb->query( "
			INSERT INTO tmpAttachments
				SELECT meta_value AS post_id FROM {$wpdb->postmeta} WHERE meta_key IN ('_thumbnail_id', '_product_image_gallery')
		");

		$attached_files = $wpdb->get_results( "
			SELECT
				postmeta.meta_key,
				postmeta.meta_value
			FROM
				{$wpdb->posts} AS posts
			JOIN
				{$wpdb->postmeta} AS postmeta ON (
					postmeta.post_id = posts.ID
					AND postmeta.meta_key IN ('_wp_attached_file', '_wp_attachment_metadata')
				)
			JOIN
				tmpAttachments ON (
					FIND_IN_SET(posts.ID, tmpAttachments.post_id)
				)
			WHERE
				posts.post_type = 'attachment'
				AND posts.post_status = 'publish'
		");

		$wpdb->query( "
			DROP TABLE tmpAttachments
		");

		// First check for exact matches (faster)
		if ( !empty( $attached_files ) ) {
			foreach ( $attached_files as $attached_file ) {
				switch ( $attached_file->meta_key ) {
					case '_wp_attached_file':
						$file = $attached_file->meta_value;
						unset( $files[$file] );
						break;

					case '_wp_attachment_metadata':
						$metadata = maybe_unserialize( $attached_file->meta_value );
						if ( !empty( $metadata ) ) {
							$file = $metadata['file'];
							unset( $files[$file] );

							foreach ( $metadata['sizes'] as $altsize ) {
								$file = dirname( $metadata['file'] ) . '/' . $altsize['file'];
								unset( $files[$file] );
							}
						}
						break;
				}
			}
		}

		$pages = $wpdb->get_results( "
			SELECT
				posts.post_content
			FROM
				{$wpdb->posts} AS posts
			WHERE
				posts.post_type NOT IN ('attachment', 'revision', 'product', 'product_variation')
				AND posts.post_content IS NOT NULL
				AND posts.post_content != ''
		" );

		if ( !empty( $pages ) && !empty( $files ) ) {
			foreach ( $pages as $page ) {
				foreach ( $files as $filename => $filesize ) {
					if ( stripos( $page->post_content, $filename ) !== false ) {
						unset( $files[$filename] );
					}
				}
			}
		}

		return $files;
	}

	private function find_files( $directory ) {

		if ( !is_dir( $directory ) ) { return array(); }

		$directory_iterator = new RecursiveDirectoryIterator( $directory, RecursiveDirectoryIterator::SKIP_DOTS );
		$iterator = new RecursiveIteratorIterator( $directory_iterator, RecursiveIteratorIterator::LEAVES_ONLY );

		if ( !empty( $iterator ) ) {
			foreach ( $iterator as $fileinfo ) {
				if ( empty( $this->_extensions ) || in_array( $fileinfo->getExtension(), $this->_extensions ) ) {
					$filename = substr( $fileinfo->getPathname(), strlen( $directory ) + 1 );
					$files[$filename] = $fileinfo->getSize();
				}
			}
		}

		if ( !empty( $files ) ) {
			ksort( $files );
		} else {
			$files = array();
		}

		return $files;
	}

	private function startsWith($haystack, $needle) {
		// search backwards starting from haystack length characters from the end
		return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
	}
}

?>