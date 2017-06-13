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

?>
<div class="pw-cleaner-panel">
	<form method="POST">
		<input type="hidden" name="scan" value="true">
		<?php
			flush();

			$orphaned_files = $cleaner->get_orphaned_files();

		?>
		<div id="pw-orphan-heading-count" class="pw-cleaner-heading" data-count="<?php echo count( $orphaned_files ); ?>"><?php echo number_format( count( $orphaned_files ) ); ?> Unused Images</div>
		<div id="pw-orphan-heading-size" class="pw-cleaner-heading-size" data-size="<?php echo array_sum( $orphaned_files ); ?>"><?php echo $cleaner->format_size( array_sum( $orphaned_files ) ); ?></div>
		<p>
			<a href="/download/pw-image-cleaner.csv" class="button button-secondary button-large">Download CSV List</a>
		</p>
		<div class="pw-cleaner-files">
			<ul id="pw-orphan-files">
				<?php
					foreach ( $orphaned_files as $filename => $size ) {
						?>
						<li>
							<a href="<?php echo wp_upload_dir()['baseurl'] . "/$filename"; ?>" target="_blank"><?php echo $filename; ?></a> (<?php echo $cleaner->format_size( $size ); ?>)
						</li>
						<?php
					}
				?>
			</ul>
		</div>
	</form>
</div>
