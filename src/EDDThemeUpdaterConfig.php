<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Sample Theme
 */

namespace ProteusThemes\EDDThemeUpdater;

class EDDThemeUpdaterConfig {

	/**
	 * EDDThemeUpdaterMain construct method.
	 *
	 * @param array $config Array of arguments from the theme requesting an update check.
	 */
	function __construct( $config = array() ) {

		$config = wp_parse_args( $config, array(
			'remote_api_url' => 'https://www.proteusthemes.com', // Site where EDD is hosted.
			'item_name'      => '', // Name of theme.
			'theme_slug'     => '', // Theme slug.
			'version'        => '', // The current version of this theme.
			'author'         => 'ProteusThemes', // The author of this theme.
			'download_id'    => '', // Optional, used for generating a license renewal link.
			'renew_url'      => '', // Optional, allows for a custom license renewal link.
		) );

		// Strings.
		$strings = array(
			'theme-license'             => __( 'Theme License', 'adrenaline-pt' ),
			'enter-key'                 => __( 'Enter your theme license key.', 'adrenaline-pt' ),
			'license-key'               => __( 'License Key', 'adrenaline-pt' ),
			'license-action'            => __( 'License Action', 'adrenaline-pt' ),
			'deactivate-license'        => __( 'Deactivate License', 'adrenaline-pt' ),
			'activate-license'          => __( 'Activate License', 'adrenaline-pt' ),
			'status-unknown'            => __( 'License status is unknown.', 'adrenaline-pt' ),
			'renew'                     => __( 'Renew?', 'adrenaline-pt' ),
			'unlimited'                 => __( 'unlimited', 'adrenaline-pt' ),
			'license-key-is-active'     => __( 'License key is active.', 'adrenaline-pt' ),
			'expires%s'                 => __( 'Expires %s.', 'adrenaline-pt' ),
			'expires-never'             => __( 'Lifetime License.', 'adrenaline-pt' ),
			'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'adrenaline-pt' ),
			'license-key-expired-%s'    => __( 'License key expired %s.', 'adrenaline-pt' ),
			'license-key-expired'       => __( 'License key has expired.', 'adrenaline-pt' ),
			'license-keys-do-not-match' => __( 'License keys do not match.', 'adrenaline-pt' ),
			'license-is-inactive'       => __( 'License is inactive.', 'adrenaline-pt' ),
			'license-key-is-disabled'   => __( 'License key is disabled.', 'adrenaline-pt' ),
			'site-is-inactive'          => __( 'Site is inactive.', 'adrenaline-pt' ),
			'license-status-unknown'    => __( 'License status is unknown.', 'adrenaline-pt' ),
			'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'adrenaline-pt' ),
			'update-available'          => __( '<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'adrenaline-pt' ),
		);

		// Loads the updater classes.
		$updater = new EDDThemeUpdaterAdmin( $config, $strings );

		// WP actions.
		add_action( 'admin_notices', array( $this, 'edd_sample_theme_admin_notices' ) );
	}


	/**
	 * This is a means of catching errors from the activation method above and displyaing it to the customer
	 */
	function edd_sample_theme_admin_notices() {
		if ( isset( $_GET['sl_theme_activation'] ) && ! empty( $_GET['message'] ) ) {

			switch( $_GET['sl_theme_activation'] ) {

				case 'false':
					$message = urldecode( $_GET['message'] );
					?>
					<div class="error">
						<p><?php echo $message; ?></p>
					</div>
					<?php
					break;

				case 'true':
				default:

					break;

			}
		}
	}
}
