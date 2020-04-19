<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Sample Theme
 */

// Includes the files needed for the theme updater.
if ( ! class_exists( 'ISH_EDD_Theme_Updater_Admin' ) ) {
	include get_parent_theme_file_path( '/assets/framework/wp/update-checker/updater/theme-updater-admin.php' );
}

// Load Theme Details.
$freelo_my_theme = wp_get_theme();

// Loads the updater classes.
$updater = new ISH_EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://ishyoboy.com/', // Site where EDD is hosted
		'item_name'      => 'Freelo', // IMPORTANT Name of theme.
		'theme_slug'     => 'freelo', // Theme slug
		'version'        => $freelo_my_theme->get( 'Version' ), // The current version of this theme
		'author'         => $freelo_my_theme->get( 'Author' ), // The author of this theme
		'download_id'    => '746', // IMPORTANT, used for generating a license renewal link
		'beta'           => false, // Optional, set to true to opt into beta versions
	),

	// Strings
	$strings = array(
		'theme-license'             			=> esc_html__( 'Theme License', 'freelo' ),
		'enter-key'                 			=> esc_html__( 'Enter your theme license key.', 'freelo' ),
		'enter-email'               			=> esc_html__( 'Enter your theme license email.', 'freelo' ),
		'enable-updates'               			=> __('<strong>%1$s</strong> security issue detected! Activate theme to receive security updates automatically via WordPress updates. <a href="%2$s" title="%1$s">Fix now</a>.', 'freelo' ),
		'license-key'               			=> esc_html__( 'License Key', 'freelo' ),
		'license-email'             			=> esc_html__( 'License Email', 'freelo' ),
		'license-action'            			=> esc_html__( 'License Action', 'freelo' ),
		'deactivate-license'        			=> esc_html__( 'Deactivate License', 'freelo' ),
		'activate-license'          			=> esc_html__( 'Activate License', 'freelo' ),
		'status-unknown'            			=> esc_html__( 'License status is unknown.', 'freelo' ),
		'renew'                     			=> esc_html__( 'Renew?', 'freelo' ),
		'unlimited'                 			=> esc_html__( 'unlimited', 'freelo' ),
		'license-key-is-active'     			=> esc_html__( 'License key is active.', 'freelo' ),
		'expires%s'                 			=> esc_html__( 'Expires %s.', 'freelo' ),
		'expires-never'             			=> esc_html__( 'Lifetime License.', 'freelo' ),
		'%1$s/%2$-sites'            			=> esc_html__( 'You have %1$s / %2$s sites activated.', 'freelo' ),
		'license-key-expired-%s'    			=> esc_html__( 'License key expired %s.', 'freelo' ),
		'license-key-expired'       			=> esc_html__( 'License key has expired.', 'freelo' ),
		'license-keys-do-not-match'				=> esc_html__( 'License keys do not match.', 'freelo' ),
		'license-is-inactive'       			=> esc_html__( 'License is inactive.', 'freelo' ),
		'license-key-is-disabled'   			=> esc_html__( 'License key is disabled.', 'freelo' ),
		'site-is-inactive'          			=> esc_html__( 'Site is inactive.', 'freelo' ),
		'license-status-unknown'    			=> esc_html__( 'License status is unknown.', 'freelo' ),
		'update-notice'             			=> esc_html__( "Updating this theme will lose any customizations you have made to its code files. Make sure you have everything backed up. 'Cancel' to stop, 'OK' to update.", 'freelo' ),
		'update-available'          			=> __('<strong>%1$s v%2$s</strong> is available. <a href="%3$s" title="%4$s" target="_blank">Check out what\'s new</a> or <a href="%5$s" class="ish-updater-confirm-link">update now</a>.', 'freelo' ),
		'update-available-no-package' 			=> __('<strong>%1$s v%2$s</strong> is available. <a href="%3$s" title="%4$s" target="_blank">Check out what\'s new</a> or <a href="%5$s">activate theme</a> to update.', 'freelo' ),
	)

);
