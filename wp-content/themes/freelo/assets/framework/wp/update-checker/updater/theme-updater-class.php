<?php
/**
 * Theme updater class.
 *
 * @package EDD Sample Theme
 * @version 1.0.3
 */

class ISH_EDD_Theme_Updater {

	private $remote_api_url;
	private $request_data;
	private $response_key;
	private $theme_slug;
	private $license_key;
	private $version;
	private $author;
	private $notify_about_days;
	protected $strings = null;


	/**
	 * Initiate the Theme updater
	 *
	 * @param array $args    Array of arguments from the theme requesting an update check
	 * @param array $strings Strings for the update process
	 */
	function __construct( $args = array(), $strings = array() ) {

		$defaults = array(
			'remote_api_url'    => 'http://easydigitaldownloads.com',
			'request_data'      => array(),
			'theme_slug'        => get_template(), // use get_stylesheet() for child theme updates
			'item_name'         => '',
			'item_id'           => '',
			'license'           => '',
			'email'             => '',
			'version'           => '',
			'author'            => '',
			'beta'              => false,
			'notify_about_days' => 0,
		);

		$args = wp_parse_args( $args, $defaults );

		$this->license              = $args['license'];
		$this->email                = $args['email'];
		$this->item_name            = $args['item_name'];
		$this->item_id              = $args['item_id'];
		$this->version              = $args['version'];
		$this->theme_slug           = sanitize_key( $args['theme_slug'] );
		$this->author               = $args['author'];
		$this->beta                 = $args['beta'];
		$this->remote_api_url       = $args['remote_api_url'];
		$this->response_key         = $this->theme_slug . '-' . $this->beta . '-update-response';
		$this->strings              = $strings;
		$this->notify_about_days    = $args['notify_about_days'];

		add_filter( 'site_transient_update_themes',        array( $this, 'theme_update_transient' ) );
		add_filter( 'delete_site_transient_update_themes', array( $this, 'delete_theme_update_transient' ) );
		add_action( 'load-update-core.php',                array( $this, 'delete_theme_update_transient' ) );
		add_action( 'load-themes.php',                     array( $this, 'delete_theme_update_transient' ) );
		add_action( 'admin_notices',                       array( $this, 'load_themes_screen' ) );
		add_action( 'admin_notices',                       array( $this, 'load_themes_screen' ) );
		add_action( 'admin_notices', 					   array( $this, 'update_nag' ) );
		add_action( 'admin_notices', 					   array( $this, 'license_nag' ) );
	}

	/**
	 * Show the update notification when neecessary

	 * @return void
	 */
	function load_themes_screen() {
		add_thickbox();
	}

	/**
	 * Display the update notifications
	 *
	 * @return void
	 */
	function update_nag() {

		global $pagenow;

		if ( 'themes.php' === $pagenow && isset( $_GET['page'] ) && $_GET['page'] === $this->theme_slug . '-license' ) {
			return;
		}

		if ( 'admin.php' === $pagenow && isset( $_GET['page'] ) && $_GET['page'] === 'jetpack' ) {
			return;
		}

		$strings      = $this->strings;
		$theme        = wp_get_theme( $this->theme_slug );
		$api_response = get_transient( $this->response_key );
		$status = get_option( $this->theme_slug . '_license_key_status' );

		if ( false === $api_response ) {
			return;
		}

		// Make sure that the theme name is contained within the remote name
		if ( ! isset( $api_response->name ) || ( false === strpos( strtolower( $api_response->name ), str_replace( ' pro', '', strtolower( $this->item_name ) ) ) ) ) {
			return;
		}

		$update_url     = wp_nonce_url( 'update.php?action=upgrade-theme&amp;theme=' . urlencode( $this->theme_slug ), 'upgrade-theme_' . $this->theme_slug );

		if ( version_compare( $this->version, $api_response->new_version, '<' ) ) {

			// Remove cookie on new version available.
			if ( isset( $_COOKIE['freelo-license-nag-dismissed'] ) && version_compare( $api_response->new_version, $_COOKIE['freelo-license-nag-dismissed'], '>' ) ) {

				// Remove cookie from php, so other code on the current page will ignore it.
				unset( $_COOKIE['freelo-license-nag-dismissed'] );

				// Remove cookie completely from browser for next load.
				setcookie( 'freelo-license-nag-dismissed', 0, time() - 3600, '/' );
			}

			if ( 'valid' === $status && isset( $api_response->package ) && ( ! empty( $api_response->package ) ) ) {
				$string = $strings['update-available'];
				$changelog_url = $api_response->url;
			} else {
				$string = $strings['update-available-no-package'];
				$changelog_url = $api_response->url;
				$update_url = admin_url( 'themes.php?page=' . $this->theme_slug . '-license' );
			}

			?>
			<div id="update-nag">
				<?php printf(
					wp_kses_post( $string ),
					esc_html( $theme->get( 'Name' ) ),
					esc_html( $api_response->new_version ),
					esc_attr( $changelog_url ),
					esc_attr( $theme->get( 'Name' ) ),
					esc_url( $update_url )
				); ?>
			</div>
		<?php }
	}

	/**
	 * Display the update notifications
	 *
	 * @return void
	 */
	function license_nag() {

		global $pagenow;

		if ( 'themes.php' === $pagenow && isset( $_GET['page'] ) && $_GET['page'] === $this->theme_slug . '-license' ) {
			return;
		}

		if ( 'admin.php' === $pagenow && isset( $_GET['page'] ) && $_GET['page'] === 'jetpack' ) {
			return;
		}

		$strings      = $this->strings;
		$theme        = wp_get_theme( $this->theme_slug );

		$license = trim( get_option( $this->theme_slug . '_license_key' ) );
		$email = trim( get_option( $this->theme_slug . '_license_email' ) );
		$status = get_option( $this->theme_slug . '_license_key_status' );
		$the_message = get_transient( $this->theme_slug . '_license_message' );
		$is_active = ( false !== strpos( strtolower( $the_message ), ' active' ) ) ? true : false;

		if ( empty( $license ) || empty( $email ) || 'valid' != $status || ! $is_active ) {

			if ( ! isset( $_COOKIE['freelo-license-nag-dismissed'] ) || version_compare( $this->version, $_COOKIE['freelo-license-nag-dismissed'], '>' ) ) {

				$activation_date = get_option( $this->theme_slug . '_activation_date', false );
				$now             = new DateTime();

				if ( $activation_date ) {

					if ( $activation_date->modify( '+' . $this->notify_about_days . ' days' ) < $now ) {

						$string = $strings['enable-updates'];
						$url    = admin_url( 'themes.php?page=' . $this->theme_slug . '-license' );
						?>
						<div id="license-nag" class="error settings-error notice is-dismissible">
							<p><?php printf( wp_kses_post( $string ), esc_html( $theme->get( 'Name' ) ), esc_attr( $url ) ); ?></p>
						</div>
						<?php

					} // End if().
				} else {
					// In case there is no date saved, save it.
					update_option( $this->theme_slug . '_activation_date', new DateTime() );
				} // End if().
			}
		}
	}

	/**
	 * Update the theme update transient with the response from the version check
	 *
	 * @param  array $value   The default update values.
	 * @return array|boolean  If an update is available, returns the update parameters, if no update is needed returns false, if
	 *                        the request fails returns false.
	 */
	function theme_update_transient( $value ) {
		$update_data = $this->check_for_update();
		if ( $update_data ) {
			$value->response[ $this->theme_slug ] = $update_data;
		}
		return $value;
	}

	/**
	 * Remove the update data for the theme
	 *
	 * @return void
	 */
	function delete_theme_update_transient() {
		delete_transient( $this->response_key );
	}

	/**
	 * Call the EDD SL API (using the URL in the construct) to get the latest version information
	 *
	 * @return array|boolean  If an update is available, returns the update parameters, if no update is needed returns false, if
	 *                        the request fails returns false.
	 */
	function check_for_update() {

		$update_data = get_transient( $this->response_key );
		$status = get_option( $this->theme_slug . '_license_key_status' );

		if ( false === $update_data ) {

			$failed = false;

			$api_params = array(
				'edd_action' => 'get_version',
				'license'    => $this->license,
				'name'       => $this->item_name,
				'item_id'    => $this->item_id,
				'slug'       => $this->theme_slug,
				'version'    => $this->version,
				'author'     => $this->author,
				'beta'       => $this->beta
			);

			if ( 'valid' !== $status ) {
				$api_params['license'] = '';
			}

			$response = wp_remote_post( $this->remote_api_url, array( 'timeout' => 15, 'body' => $api_params ) );

			// Make sure the response was successful
			if ( is_wp_error( $response ) || 200 != wp_remote_retrieve_response_code( $response ) ) {
				$failed = true;
			}

			$update_data = json_decode( wp_remote_retrieve_body( $response ) );

			if ( ! is_object( $update_data ) ) {
				$failed = true;
			}

			// Make sure that the theme name is contained within the remote name
			if ( ! $failed ) {
				if ( ! isset( $update_data->name ) || false === strpos( strtolower( $update_data->name ), str_replace( ' pro', '', strtolower( $this->item_name ) ) ) ) {
					$failed = true;
				}
			}

			// Do not allow download without valid license
			if ( ! $failed ) {
				if ( get_option( $this->theme_slug . '_license_key_status', false) != 'valid' ) {
					$update_data->package = '';
					$update_data->download_link = '';
				}
			}

			// If the response failed, try again in 30 minutes
			if ( $failed ) {
				$data = new stdClass;
				$data->new_version = $this->version;
				set_transient( $this->response_key, $data, strtotime( '+30 minutes', current_time( 'timestamp' ) ) );
				return false;
			}

			// If the status is 'ok', return the update arguments
			if ( ! $failed ) {
				$update_data->sections = maybe_unserialize( $update_data->sections );
				set_transient( $this->response_key, $update_data, strtotime( '+12 hours', current_time( 'timestamp' ) ) );
			}
		}

		if ( version_compare( $this->version, $update_data->new_version, '>=' ) ) {
			return false;
		}


		return (array) $update_data;
	}

}
