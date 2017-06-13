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
<div id="pw-pro-panel">
	<p>PW Image Cleaner will show you unused images within your WordPress site and let you download a CSV list of the detected images so you can delete them and free up space.</p>
	<p>Always make a backup of your database and site before deleting images!</p>
	<p><strong>PW Image Cleaner Pro</strong> includes <a href="#" id="pw-pro-features-button">additional features!</a></p>
	<div id="pw-pro-features">
		<ul>
			<li>Automated backup of unused images</li>
			<li>Delete unused images in one click!</li>
			<li>Ignore falsely flagged images</li>
			<li>1 year of support</li>
			<li>1 year of upgrades</li>
		</ul>
	</div>
	<a href="https://www.pimwick.com/pw-cleaner/" class="button button-primary" target="_blank">Buy the Pro Version for only $20</a>
</div>
<div class="wrap">
	<?php
		if ( !empty( $cleaner->error_message ) ) {
			?>
			<div class="error notice">
				<p><?php echo $cleaner->error_message; ?></p>
			</div>
			<?php
		}
	?>
	<img id="pw-logo" src="<?php echo plugins_url( 'assets/images/logo.png', dirname( __FILE__ ) ); ?>">
	<div id="pw-cleaner-main">
		<?php
			if ( isset( $_POST['scan'] ) ) {
				require( 'scan.php' );
			} else {
				?>
				<p>
					PW Image Cleaner provides a list of unused images to help you free up valuable storage space.
				</p>

				<a href="" id="pw-scan-button" class="button">Perform Scan</a>

				<div id="pw-cleaner-loading">
					<h3>Scanning...</h3>
					<img src="<?php echo plugins_url( 'assets/images/loading.gif', dirname( __FILE__ ) ); ?>">
				</div>
				<?php
			}
		?>
	</div>
</div>
<script>
	jQuery("#pw-scan-button").click(function() {
		jQuery("#pw-scan-button").hide();
		jQuery("#pw-cleaner-loading").show();

		jQuery.post(ajaxurl, {'action': 'image_scan'}, function(response) {
			jQuery("#pw-cleaner-main").html(response);
		});

		return false;
	});

	jQuery("#pw-pro-features-button").click(function() {
		jQuery('#pw-pro-features').toggle();
		return false;
	});
</script>