<?php
/**
 * Theme updater admin page and functions.
 *
 * @package EDD Sample Theme
 */

class ISH_EDD_Theme_Updater_Admin {

	/**
	* Variables required for the theme updater
	*
	* @since 1.0.0
	* @type string
	*/
	protected $remote_api_url = null;
	protected $theme_slug = null;
	protected $version = null;
	protected $author = null;
	protected $download_id = null;
	protected $renew_url = null;
	protected $strings = null;
	protected $notify_about_days;

	/**
	 * Initialize the class.
	 *
	 * @since 1.0.0
	 */
	function __construct( $config = array(), $strings = array() ) {

		$config = wp_parse_args( $config, array(
			'remote_api_url' => 'http://easydigitaldownloads.com',
			'theme_slug' => get_template(),
			'item_name' => '',
			'license' => '',
			'version' => '',
			'author' => '',
			'download_id' => '',
			'renew_url' => '',
			'beta' => false,
			'notify_about_days' => 3,
		) );

		// Set config arguments
		$this->remote_api_url = $config['remote_api_url'];
		$this->item_name = $config['item_name'];
		$this->theme_slug = sanitize_key( $config['theme_slug'] );
		$this->version = $config['version'];
		$this->author = $config['author'];
		$this->download_id = $config['download_id'];
		$this->renew_url = $config['renew_url'];
		$this->response_key = $config['theme_slug'] . '-' . $config['beta'] . '-update-response';
		$this->beta = $config['beta'];
		$this->notify_about_days = $config['notify_about_days'];

		// Populate version fallback
		if ( '' == $config['version'] ) {
			$theme = wp_get_theme( $this->theme_slug );
			$this->version = $theme->get( 'Version' );
		}

		// Strings passed in from the updater config
		$this->strings = $strings;

		add_action( 'init', array( $this, 'updater' ) );
		add_action( 'admin_init', array( $this, 'register_option' ) );
		add_action( 'admin_menu', array( $this, 'license_menu' ) );
		add_action( 'update_option_' . $this->theme_slug . '_license_key', array( $this, 'before_activate_license' ), 10, 2 );
		add_action( 'update_option_' . $this->theme_slug . '_license_email', array( $this, 'before_activate_license' ), 10, 2 );
		add_filter( 'pre_update_option_' . $this->theme_slug . '_license_key', array( $this, 'before_options_update' ), 10, 2 );
		add_filter( 'http_request_args', array( $this, 'disable_wporg_request' ), 5, 2 );
		add_action( 'admin_menu', array( $this, 'add_count_bubble' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ), 20 );

		// remember the activation date.
		add_action( 'after_switch_theme', array( $this, 'after_switch_theme' ) );

	}

	/**
	 * Creates the updater class.
	 *
	 * since 1.0.0
	 */
	function updater() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// delete_transient( $this->theme_slug . '_license_message' );
		if ( ! get_transient( $this->theme_slug . '_license_message' ) ) {
			$license_status = $this->check_license();
			set_transient( $this->theme_slug . '_license_message', $license_status, ( 60 * 60 * 3 ) );
		}

		if ( ! class_exists( 'ISH_EDD_Theme_Updater' ) ) {
			// Load our custom theme updater.
			include get_parent_theme_file_path( '/assets/framework/wp/update-checker/updater/theme-updater-class.php' );
		}

		new ISH_EDD_Theme_Updater(
			array(
				'remote_api_url' 	        => $this->remote_api_url,
				'version' 			        => $this->version,
				'license' 			        => trim( get_option( $this->theme_slug . '_license_key' ) ),
				'email' 			        => trim( get_option( $this->theme_slug . '_license_email' ) ),
				'item_name' 		        => $this->item_name,
				'item_id' 		            => $this->download_id,
				'author'			        => $this->author,
				'beta'                      => $this->beta,
				'notify_about_days'         => $this->notify_about_days
			),
			$this->strings
		);
	}

	/**
	 * Adds a menu item for the theme license under the appearance menu.
	 *
	 * since 1.0.0
	 */
	function license_menu() {

		$strings = $this->strings;

		add_theme_page(
			$strings['theme-license'],
			$strings['theme-license'] . $this->get_menu_notifications_bubble(),
			'manage_options',
			$this->theme_slug . '-license',
			array( $this, 'license_page' )
		);
	}

	/**
	 * Outputs the markup used on the theme license page.
	 *
	 * since 1.0.0
	 */
	function license_page() {

		$strings = $this->strings;

		$license = trim( get_option( $this->theme_slug . '_license_key' ) );
		$license_email = trim( get_option( $this->theme_slug . '_license_email' ) );
		$status = get_option( $this->theme_slug . '_license_key_status', false );

		$message = '';
		$message_email = '';

		// Checks license status to display under license key
		if ( ! $license || ! $license_email ) {
		    if ( ! $license ) {
			    $message    = $strings['enter-key'];
			}
			if ( ! $license_email ) {
			    $message_email    = $strings['enter-email'];
			}
		} else {
			$the_message = get_transient( $this->theme_slug . '_license_message' );

			if ( ! $the_message || 'valid' !== $status ) {
				$license_status = $this->check_license();

				if ( 'invalid' !==  $license_status ) {
					set_transient( $this->theme_slug . '_license_message', $license_status, ( 60 * 60 * 3 ) );
				}
			}

			$the_message = get_transient( $this->theme_slug . '_license_message' );
			$the_message_type = ( false !== strpos( strtolower($the_message), ' active' ) ) ? 'updated' : 'error';

			add_settings_error(
                $this->theme_slug . '_license',
                'license-message',
                $the_message,
                $the_message_type
            );
		}
		?>
		<div class="wrap">
			<h2><?php echo esc_html__( 'Theme License Activation', 'freelo' ); ?></h2>
			<?php settings_errors(); ?>
			<p>
				<?php echo esc_html__( 'By activating your license you will be able to receive update notifications and install the updates without having to download the files manually. This is only available with a valid IshYoBoy.com license. Licenses from other marketplaces are not valid and need to be converted to a valid IshYoBoy.com license.', 'freelo' );  ?>
				<?php echo sprintf( __( 'Where to <a href="%1$s" target="_blank">find your license key</a>?', 'freelo' ), esc_url( trailingslashit( $this->remote_api_url ) . 'account/#license-keys' ) ); ?>
			</p>
			<form method="post" action="options.php">

				<?php settings_fields( $this->theme_slug . '-license' ); ?>

				<table class="form-table">
					<tbody>

						<tr valign="top">
							<th scope="row" valign="top">
								<?php echo esc_html( $strings['license-key'] ); ?>
							</th>
							<td>
								<input id="<?php echo esc_attr( $this->theme_slug ); ?>_license_key" name="<?php echo esc_attr( $this->theme_slug ); ?>_license_key" type="text" class="regular-text" value="<?php echo esc_attr( $license ); ?>" />
								<p class="description">
									<?php echo esc_html( $message ); ?>
								</p>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row" valign="top">
								<?php echo esc_html( $strings['license-email'] ); ?>
							</th>
							<td>
								<input id="<?php echo esc_attr( $this->theme_slug ); ?>_license_email" name="<?php echo esc_attr( $this->theme_slug); ?>_license_email" type="text" class="regular-text" value="<?php echo esc_attr( $license_email ); ?>" />
								<p class="description">
									<?php echo esc_html( $message_email ); ?>
								</p>
							</td>
						</tr>

					</tbody>
				</table>
				<?php
				if ( empty( $license ) || empty( $license_email ) ) {
					submit_button( "Save & Activate");
				} else {
					submit_button( "Update & Check");
				}
				?>

			</form>
			<p></p>
			<h1><?php echo esc_html__( "Don't have a valid IshYoBoy.com License?", 'freelo' ); ?></h1>
			<p><?php echo esc_html__( 'If you own a valid license or purchase key from other marketplaces, you can easily convert it to a valid IshYoBoy.com license.', 'freelo' )?></p>
			<?php
				$theme = ( false !== strpos( $this->theme_slug, '-pro' ) ) ? $this->theme_slug : $this->theme_slug . '-wp';
				$new_license_url = trailingslashit( $this->remote_api_url ) . 'themes/' . $theme . '/';
				$convert_license_url = trailingslashit( $this->remote_api_url ) . 'convert-license/';
			?>
			<p class="submit">
				<a class="button-primary" href="<?php echo esc_url( $new_license_url );?>" target="_blank"><?php echo esc_html__( "Get a license", 'freelo' ); ?></a>
				<a class="button-secondary" href="<?php echo esc_url( $convert_license_url );?>" target="_blank"><?php echo esc_html__( "Convert existing license", 'freelo' ); ?></a>
			</p>

		<?php
	}

	/**
	 * Registers the option used to store the license key in the options table.
	 *
	 * since 1.0.0
	 */
	function register_option() {
		register_setting(
			$this->theme_slug . '-license',
			$this->theme_slug . '_license_key',
			array( $this, 'sanitize_license' )
		);

		register_setting(
			$this->theme_slug . '-license',
			$this->theme_slug . '_license_email',
			array( $this, 'sanitize_license_email' )
		);
	}

	/**
	 * Sanitizes the license key.
	 *
	 * since 1.0.0
	 *
	 * @param string $new License key that was submitted.
	 * @return string $new Sanitized license key.
	 */
	function sanitize_license( $new ) {

		$old = get_option( $this->theme_slug . '_license_key' );

		if ( $old && $old != $new ) {
			// New license has been entered, so must reactivate
			delete_option( $this->theme_slug . '_license_key_status' );
			delete_transient( $this->theme_slug . '_license_message' );
		}

		if ( empty( $new ) ){
            add_settings_error(
                $this->theme_slug . '_license',
                'missing-license-key',
                 esc_html__('License key missing.', 'freelo'),
                'error'
            );
        }

		return $new;
	}

	/**
	 * Sanitizes the license email.
	 *
	 * since 1.0.0
	 *
	 * @param string $new License email that was submitted.
	 * @return string $new Sanitized license email.
	 */
	function sanitize_license_email( $new ) {

		$old = get_option( $this->theme_slug . '_license_email' );

		if ( $old && $old != $new ) {
			// New license has been entered, so must reactivate
			delete_option( $this->theme_slug . '_license_key_status' );
			delete_transient( $this->theme_slug . '_license_message' );
		}

		if ( empty( $new ) ){
            add_settings_error(
                $this->theme_slug . '_license',
                'missing-license-email',
                 esc_html__('License email missing.', 'freelo'),
                'error'
            );
        }

		return $new;
	}

	/**
	 * Makes a call to the API.
	 *
	 * @since 1.0.0
	 *
	 * @param array $api_params to be used for wp_remote_get.
	 * @return array $response decoded JSON response.
	 */
	 function get_api_response( $api_params ) {

		// Call the custom API.
		$response = wp_remote_post( $this->remote_api_url, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

		// Make sure the response came back okay.
		if ( is_wp_error( $response ) ) {
			wp_die( esc_html( $response->get_error_message() ), esc_html__( 'Error', 'freelo' ) . esc_html( $response->get_error_code() ) );
		}

		return $response;
	 }


	 /**
	 * Checks if all fields are entered before activating the license.
	 *
	 * @since 1.0.0
	 */
    function before_activate_license() {
        $license = trim( get_option( $this->theme_slug . '_license_key' ) );
        $license_email = trim( get_option( $this->theme_slug . '_license_email' ) );

        if ( $license && $license_email && ! empty( $license ) && ! empty( $license_email ) ){
            $this->activate_license();
        }
    }

	function before_options_update( $new, $old ) {
		delete_option( $this->theme_slug . '_license_key_status' );
		delete_transient( $this->theme_slug . '_license_message' );
		delete_transient( $this->response_key );

		return $new;
	}

	/**
	 * Activates the license key.
	 *
	 * @param bool $return
	 * @return string
     */
	function activate_license( $return = false ) {

		$license = trim( get_option( $this->theme_slug . '_license_key' ) );
		$license_email = trim( get_option( $this->theme_slug . '_license_email' ) );
		$license_status = 'invalid';

		// Data to send in our API request.
		$api_params = array(
			'edd_action' => 'activate_license',
			'license'    => $license,
			'email'      => urlencode( $license_email ),
			'item_name'  => urlencode( $this->item_name ),
			'item_id'    => urlencode( $this->download_id ),
			'url'        => home_url()
		);

		$response = $this->get_api_response( $api_params );

		// make sure the response came back okay
		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

			if ( is_wp_error( $response ) ) {
				$message = $response->get_error_message();
			} else {
				$message = esc_html__( 'An error occurred, please try again.', 'freelo' );
			}

		} else {

			$license_data = json_decode( wp_remote_retrieve_body( $response ) );

			if ( false === $license_data->success ) {

				switch( $license_data->error ) {

					case 'expired' :

						$message = sprintf(
							esc_html__( 'Your license key expired on %s.', 'freelo'  ),
							date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) )
						);
						break;

					case 'revoked' :

						$message = esc_html__( 'Your license key has been disabled.', 'freelo'  );
						break;

					case 'missing' :

						$message = esc_html__( 'Invalid license.', 'freelo'  );
						break;

					case 'invalid' :
					case 'site_inactive' :

						$message = esc_html__( 'Your license is not active for this URL.', 'freelo'  );
						break;

					case 'item_name_mismatch' :

						$message = sprintf( esc_html__( 'This appears to be an invalid license key for %s.', 'freelo' ), $api_params['item_name'] );
						break;

					case 'invalid_item_id' :

						$message = sprintf( esc_html__( 'This appears to be an invalid license key for %s.', 'freelo' ), $api_params['item_name'] );
						break;

					case 'no_activations_left':
						$message = sprintf( __( 'Your license key has reached its activation limit. <a href="%1$s" target="_blank">Manage your licenses</a>.', 'freelo' ), esc_url( trailingslashit( $this->remote_api_url ) . 'account/#license-keys' ) );
						break;

					default :
						$message = esc_html__( 'An error occurred, please try again.', 'freelo'  );
						break;
				}


				if ( ! empty( $message ) ) {

					if ( $license_data && isset( $license_data->license ) ) {

						$license_status = $license_data->license;
						update_option( $this->theme_slug . '_license_key_status', $license_data->license );
						delete_transient( $this->theme_slug . '_license_message' );
						set_transient( $this->theme_slug . '_license_message', $message, ( 60 * 60 * 1 ) );

					}

					if ( ! $return ) {
						$base_url = admin_url( 'themes.php?page=' . $this->theme_slug . '-license' );
						$redirect = add_query_arg( array( 'sl_theme_activation' => 'false', 'message' => urlencode( $message ) ), $base_url );
						wp_redirect( $redirect );
					} else {
						return $license_status;
					}

					exit();
				}

			}

		}

		// $response->license will be either "valid" or "invalid"
		if ( $license_data && isset( $license_data->license ) ) {
			$license_status = $license_data->license;
			update_option( $this->theme_slug . '_license_key_status', $license_data->license );
			delete_transient( $this->theme_slug . '_license_message' );
		}

		if ( ! $return ) {
			wp_redirect( admin_url( 'themes.php?page=' . $this->theme_slug . '-license' ) );
		} else {
			return $license_status;
		}


		exit();

	}

	/**
	 * Constructs a renewal link
	 *
	 * @since 1.0.0
	 */
	function get_renewal_link() {

		// If a renewal link was passed in the config, use that
		if ( '' != $this->renew_url ) {
			return $this->renew_url;
		}

		// If download_id was passed in the config, a renewal link can be constructed
		$license_key = trim( get_option( $this->theme_slug . '_license_key', false ) );
		if ( '' != $this->download_id && $license_key ) {
			$url = esc_url( trailingslashit( $this->remote_api_url ) );
			$url .= 'checkout/?edd_license_key=' . $license_key . '&download_id=' . $this->download_id;
			return $url;
		}

		// Otherwise return the remote_api_url
		return $this->remote_api_url;

	}

	/**
	 * Checks if license is valid and gets expire date.
	 *
	 * @since 1.0.0
	 *
	 * @return string $message License status message.
	 */
	function check_license() {

		$license = trim( get_option( $this->theme_slug . '_license_key' ) );
		$license_email = trim( get_option( $this->theme_slug . '_license_email' ) );
		$strings = $this->strings;
		$status = 'invalid';

		$api_params = array(
			'edd_action' => 'check_license',
			'license'    => $license,
			'email'      => $license_email,
			'item_name'  => urlencode( $this->item_name ),
			'item_id'    => urlencode( $this->download_id ),
			'url'        => home_url()
		);

		$response = $this->get_api_response( $api_params );

		// make sure the response came back okay
		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

			if ( is_wp_error( $response ) ) {
				$message = $response->get_error_message();
			} else {
				$message = $strings['license-status-unknown'];
			}

		} else {

			$license_data = json_decode( wp_remote_retrieve_body( $response ) );

			// If response doesn't include license data, return
			if ( ! isset( $license_data->license ) ) {
				$message = $strings['license-status-unknown'];
				return $message;
			}

			// We need to update the license status at the same time the message is updated
			if ( $license_data && isset( $license_data->license ) && ( 'valid' === $license_data->license || 'inactive' === $license_data->license ) ) {

				if ( 'inactive' === $license_data->license ) {
					delete_option( $this->theme_slug . '_license_key_status' );
				}

				// Check if license is valid for this URL but do no redirects.
				if ( 'valid' === $license_data->license ) {
					$status = $this->activate_license( true );
				} else {
					$status = $this->activate_license();
				}

			} else {
				delete_option( $this->theme_slug . '_license_key_status' );
			}

			// Get expire date
			$expires = false;
			if ( isset( $license_data->expires ) && 'lifetime' != $license_data->expires ) {
				$expires = date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) );
				$renew_link = '<a href="' . esc_url( $this->get_renewal_link() ) . '" target="_blank">' . $strings['renew'] . '</a>';
			} elseif ( isset( $license_data->expires ) && 'lifetime' == $license_data->expires ) {
				$expires = 'lifetime';
			}

			if ( $license_data->license === 'valid' ) {

				// Get site counts
				$site_count = $license_data->site_count;
				$license_limit = $license_data->license_limit;

				// If unlimited
				if ( 0 == $license_limit ) {
					$license_limit = $strings['unlimited'];
				}

				$message = $strings['license-key-is-active'] . ' ';
				if ( isset( $expires ) && 'lifetime' != $expires ) {
					$message .= sprintf( $strings['expires%s'], $expires ) . ' ';
				}
				if ( isset( $expires ) && 'lifetime' == $expires ) {
					$message .= $strings['expires-never'];
				}
//				if ( $site_count && $license_limit ) {
//					$message .= sprintf( $strings['%1$s/%2$-sites'], $site_count, $license_limit );
//				}
			} else if ( $license_data->license == 'expired' ) {
				if ( $expires ) {
					$message = sprintf( $strings['license-key-expired-%s'], $expires );
				} else {
					$message = $strings['license-key-expired'];
				}
				if ( $renew_link ) {
					$message .= ' ' . $renew_link;
				}
			} else if ( $license_data->license == 'invalid' ) {
				$message = $strings['license-keys-do-not-match'];
			} else if ( $license_data->license == 'inactive' ) {
				$message = $strings['license-is-inactive'];
			} else if ( $license_data->license == 'disabled' ) {
				$message = $strings['license-key-is-disabled'];
			} else if ( $license_data->license == 'site_inactive' ) {
				// Site is inactive
				$message = $strings['site-is-inactive'];
			} else {
				$message = $strings['license-status-unknown'];
			}

		}

		if ( isset( $license_data ) && ( 'valid' === $license_data->license && 'invalid' === $status ) ) {
			$message = 'invalid';
		}

		return $message;
	}

	/**
	 * Disable requests to wp.org repository for this theme.
	 *
	 * @since 1.0.0
	 */
	function disable_wporg_request( $r, $url ) {

		// If it's not a theme update request, bail.
		if ( 0 !== strpos( $url, 'https://api.wordpress.org/themes/update-check/1.1/' ) ) {
 			return $r;
 		}

 		// Decode the JSON response
 		$themes = json_decode( $r['body']['themes'] );

 		// Remove the active parent and child themes from the check
 		$parent = get_option( 'template' );
 		$child = get_option( 'stylesheet' );
 		unset( $themes->themes->$parent );
 		unset( $themes->themes->$child );

 		// Encode the updated JSON response
 		$r['body']['themes'] = json_encode( $themes );

 		return $r;
	}

	/**
	 * Adds a "update count" bubble to Admin Menu 'Appearance'.
	 */
	function add_count_bubble(){
		global $menu;

		foreach ( $menu as $key => $value ) {
			if ( 'switch_themes' === $menu[$key][1] ) {
				$menu[$key][0] .= $this->get_menu_notifications_bubble();
				break;
			}
		}
	}

	/**
     * Returns the string to display "update count" bubble for Admin Menu.
     *
	 * @return string
	 */
	function get_menu_notifications_bubble() {
		$updates_count = '';
		$license = trim( get_option( $this->theme_slug . '_license_key' ) );
		$email = trim( get_option( $this->theme_slug . '_license_email' ) );
		$status = get_option( $this->theme_slug . '_license_key_status' );
		$the_message = get_transient( $this->theme_slug . '_license_message' );
		$is_active = ( false !== strpos( strtolower( $the_message ), ' active' ) ) ? true : false;

		$api_response = get_transient( $this->response_key );

		if ( empty( $license ) || empty( $email ) || 'valid' != $status || ! $is_active ) {

			$activation_date = get_option( $this->theme_slug . '_activation_date', false );
			$now    = new DateTime();

			if ( $activation_date ) {

				if ( $activation_date->modify( '+' . $this->notify_about_days . ' days' ) < $now ) {

					$updates_count = wp_kses_post( ' <span class="awaiting-mod count-1"><span class="update-count">1</span></span>' );

				} // End if().
			} else {
				// In case there is no date saved, save it.
				update_option( $this->theme_slug . '_activation_date', new DateTime() );
			} // End if().


		}

		return $updates_count;
	}

	function after_switch_theme() {
		// Update activation date on every theme activation.
		update_option( $this->theme_slug . '_activation_date', new DateTime() );
	}

	/**
	 * Makes notices dismissable.
	 */
	function dismiss_notice() {

		if ( isset( $_GET['days'] ) ) {
			$days = (int) $_GET['days'];
			update_option( 'pro_version_notice_' . $days , 1 );
		}

	}

	function scripts() {
		wp_enqueue_script( 'freelo-update-checker', get_template_directory_uri() . '/assets/framework/wp/update-checker/js/update-checker.js', array( 'jquery', 'customize-base' ), '20180424' );

		$version = $this->version;
		$api_response = get_transient( $this->response_key );

		if ( $api_response && isset( $api_response->new_version ) ) {
			$version = $api_response->new_version;
		}

		wp_localize_script( 'freelo-update-checker', 'theme', array(
			'version' => $version,
			'slug' => $this->theme_slug,
			'update_notice' => $this->strings['update-notice']
		) );
	}

}