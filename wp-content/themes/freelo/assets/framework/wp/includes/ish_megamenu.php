<?php
/*
Plugin Name: IshYoBoy MegaMenu
Plugin URI: http://ishyoboy.com/
Description: Adds "Mega Menu" functionality to a theme
Version: 1.0
Author: IshYoBoy
Author URI: http://ishyoboy.com
*/

if ( ! class_exists( 'Ishyoboy_Megamenu' ) ) {

	class Ishyoboy_Megamenu {

		function __construct() {

			// add custom menu fields to menu
			add_filter( 'wp_setup_nav_menu_item', array( &$this, 'add_custom_fields' ) );

			// save menu custom fields
			add_action( 'wp_update_nav_menu_item', array( &$this, 'update_custom_fields'), 10, 3 );

			// edit backend menu walker
			add_filter( 'wp_edit_nav_menu_walker', array( $this, 'edit_backend_walker'), 10, 2 );

			// edit frontend menu walker and arguments
			add_filter( 'wp_nav_menu_args', array( &$this,'edit_frontend_walker_and_arguments'), 100);

		}


		/**
		 * Add custom fields to $item nav object
		 * in order to be used in a custom Walker
		 *
		 * @access      public
		 * @since       1.0
		 * @return      object
		 */
		public function add_custom_fields( $menu_item ) {

			$menu_item->megamenu = get_post_meta( $menu_item->ID, '_menu-item-ish-megamenu', true );

			return $menu_item;

		}

		/**
		 * Save menu custom fields
		 *
		 * @access      public
		 * @since       1.0
		 * @return      void
		 */
		function update_custom_fields( $menu_id, $menu_item_db_id, $args ) {
			$check = apply_filters( 'ish_mega_menu_post_meta_fields', array( 'megamenu', 'division', 'textarea'), $menu_id, $menu_item_db_id);

			if ( isset( $args ) && is_array( $args ) ){

				foreach ( $check as $key )
				{
					if ( isset( $args[ 'menu-item-ish-' . $key ] ) ) {
						$value = $args[ 'menu-item-ish-' . $key ];
					}
					elseif ( isset( $_POST[ 'menu-item-ish-' . $key ][ $menu_item_db_id ] ) ) {
						$value = $_POST[ 'menu-item-ish-' . $key ][ $menu_item_db_id ];
					}
					else{
						$value = '';
					}

					update_post_meta( $menu_item_db_id, '_menu-item-ish-' . $key, sanitize_key( $value ) );
				}

			}

		}

		/**
		 * Define new Walker edit
		 *
		 * @access      public
		 * @since       1.0
		 * @return      string
		 */
		function edit_backend_walker( $walker, $menu_id ) {

			return apply_filters( 'ish_megamenu_backend_walker', 'Ishyoboy_Backend_Walker' );

		}

		/**
		 * Replaces the default arguments for the front end menu creation with new ones
		 */
		function edit_frontend_walker_and_arguments( $arguments ){

			if ( isset( $arguments['theme_location'] ) && ( ( 'header-bar-menu' === $arguments['theme_location'] ) || ('header-menu' === $arguments['theme_location']) ) ) {
				// Use MegaMenu walker only on Header Bar and Main Menu

				if ( ! isset( $arguments['menu_class'] ) || ( false === strpos( $arguments['menu_class'], 'ish-widget-main_nav' ) ) ) {
					//  Use MegaMenu walker only when menu not used as a widget.

					$walker = apply_filters( 'ish_megamenu_frontend_walker', 'Ishyboy_Frontend_Walker' );

					if ( $walker ) {
						$arguments['walker'] = new $walker();
						$arguments['container_class'] .= ' ish-megamenu-wrapper';
						$arguments['menu_class'] .= ' ish-megamenu';
					}

				}
			}

			return $arguments;

		}

	}

}


if( !class_exists( 'Ishyoboy_Backend_Walker' ) )
{
	/**
	 * Create HTML list of nav menu input items.
	 * A copy of Walker_Nav_Menu_Edit WordPress Class modified to support new fields
	 *
	 * @package WordPress
	 * @since 3.0.0
	 * @uses Walker_Nav_Menu
	 */
	class Ishyoboy_Backend_Walker extends Walker_Nav_Menu {
		/**
		 * Starts the list before the elements are added.
		 *
		 * @see Walker_Nav_Menu::start_lvl()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   Not used.
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {}

		/**
		 * Ends the list of after the elements are added.
		 *
		 * @see Walker_Nav_Menu::end_lvl()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   Not used.
		 */
		public function end_lvl( &$output, $depth = 0, $args = array() ) {}

		/**
		 * Start the element output.
		 *
		 * @see Walker_Nav_Menu::start_el()
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item   Menu item data object.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   Not used.
		 * @param int    $id     Not used.
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $_wp_nav_menu_max_depth;
			$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

			ob_start();
			$item_id = esc_attr( $item->ID );
			$removed_args = array(
				'action',
				'customlink-tab',
				'edit-menu-item',
				'menu-item',
				'page-tab',
				'_wpnonce',
			);

			$original_title = '';
			if ( 'taxonomy' == $item->type ) {
				$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
				if ( is_wp_error( $original_title ) )
					$original_title = false;
			} elseif ( 'post_type' == $item->type ) {
				$original_object = get_post( $item->object_id );
				$original_title = get_the_title( $original_object->ID );
			}

			$classes = array(
				'menu-item menu-item-depth-' . $depth,
				'menu-item-' . esc_attr( $item->object ),
				'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
			);

			$title = $item->title;

			if ( ! empty( $item->_invalid ) ) {
				$classes[] = 'menu-item-invalid';
				/* translators: %s: title of menu item which is invalid */
				$title = sprintf( esc_html__( '%s (Invalid)', 'freelo'  ), $item->title );
			} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
				$classes[] = 'pending';
				/* translators: %s: title of menu item in draft status */
				$title = sprintf( esc_html__( '%s (Pending)', 'freelo' ), $item->title );
			}

			$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

			$submenu_text = '';
			if ( 0 == $depth )
				$submenu_text = 'style="display: none;"';

			global $megamenu_class;

			if ( 0 == $depth ) {
				$megamenu_class = '';
				$megamenu_class = get_post_meta( $item->ID, '_menu-item-ish-megamenu', true);
				if ( '' != $megamenu_class ) $megamenu_class = ' ish-megamenu-active';
			}
			?>

		<li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo implode(' ', $classes ) . $megamenu_class; ?>">
			<dl class="menu-item-bar">
				<dt class="menu-item-handle">
					<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo ' ' . $submenu_text; ?>><?php esc_html_e( 'sub item', 'freelo' ); ?></span></span>
					<span class="item-controls">
						<span class="item-type item-type-default"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-type item-type-megamenu-column"><?php esc_html_e( 'Column', 'freelo' ); ?></span>
						<span class="item-type item-type-megamenu"><?php esc_html_e( 'Mega Menu', 'freelo' ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
							echo wp_nonce_url(
								add_query_arg(
									array(
										'action' => 'move-up-menu-item',
										'menu-item' => $item_id,
									),
									remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
								),
								'move-menu_item'
							);
							?>" class="item-move-up"><abbr title="<?php esc_attr_e( 'Move up', 'freelo' ); ?>">&#8593;</abbr></a>
							|
							<a href="<?php
							echo wp_nonce_url(
								add_query_arg(
									array(
										'action' => 'move-down-menu-item',
										'menu-item' => $item_id,
									),
									remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
								),
								'move-menu_item'
							);
							?>" class="item-move-down"><abbr title="<?php esc_attr_e( 'Move down', 'freelo' ); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo esc_attr( $item_id ); ?>" title="<?php esc_attr_e( 'Edit Menu Item', 'freelo' ); ?>" href="<?php
						echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
						?>"><?php esc_html_e( 'Edit Menu Item', 'freelo' ); ?></a>
					</span>
				</dt>
			</dl>

			<div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr( $item_id ); ?>">
				<?php if( 'custom' == $item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>">
							<?php esc_html_e( 'URL', 'freelo' ); ?><br />
							<input type="text" id="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
				<p class="description description-thin">
					<label for="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Navigation Label', 'freelo' ); ?><br />
						<input type="text" id="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
						<span class="description ish-megamenu-label"><?php esc_html_e( 'Enter "-" not to output the label.', 'freelo' ); ?></span>
					</label>
				</p>
				<p class="description description-thin">
					<label for="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Title Attribute', 'freelo' ); ?><br />
						<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
					</label>
				</p>
				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr( $item_id ); ?>]"<?php checked( $item->target, '_blank' ); ?> />
						<?php esc_html_e( 'Open link in a new window/tab', 'freelo' ); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'CSS Classes (optional)', 'freelo' ); ?><br />
						<input type="text" id="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Link Relationship (XFN)', 'freelo' ); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
					</label>
				</p>
				<p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Description', 'freelo' ); ?><br />
						<textarea id="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr( $item_id ); ?>]"><?php echo esc_html( $item->post_content ); // textarea_escaped ?></textarea>
						<span class="description"><?php esc_html_e( 'The description will be displayed in the menu if the current theme supports it.', 'freelo' ); ?></span>
						<span class="description ish-megamenu-label"><?php esc_html_e( 'Use the description to output any text or HTML content.', 'freelo' ); ?></span>
					</label>
				</p>

				<?php // ########## IshYoBoy Code starts here. ########## ?>

				<p class="field-ish-megamenu field-ish-megamenu-activate description description-wide">
					<label for="edit-menu-item-ish-megamenu-<?php echo esc_attr( $item_id ); ?>">
						<input type="checkbox" id="edit-menu-item-ish-megamenu-<?php echo esc_attr( $item_id ); ?>" value="_blank" class="menu-item-ish-megamenu" name="menu-item-ish-megamenu[<?php echo esc_attr( $item_id ); ?>]"<?php checked( $item->megamenu, '_blank' ); ?> />
						<?php esc_html_e( 'Activate MegaMenu', 'freelo' ); ?>
					</label>
				</p>

				<?php // ########## IshYoBoy Code ends here. ##########?>

				<p class="field-move hide-if-no-js description description-wide">
					<label>
						<span><?php esc_html_e( 'Move', 'freelo' ); ?></span>
						<a href="#" class="menus-move menus-move-up" data-dir="up"><?php esc_html_e( 'Up one', 'freelo' ); ?></a>
						<a href="#" class="menus-move menus-move-down" data-dir="down"><?php esc_html_e( 'Down one', 'freelo' ); ?></a>
						<a href="#" class="menus-move menus-move-left" data-dir="left"></a>
						<a href="#" class="menus-move menus-move-right" data-dir="right"></a>
						<a href="#" class="menus-move menus-move-top" data-dir="top"><?php esc_html_e( 'To the top', 'freelo' ); ?></a>
					</label>
				</p>

				<div class="menu-item-actions description-wide submitbox">
					<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
						<p class="link-to-original">
							<?php printf( esc_html__( 'Original: %s', 'freelo' ), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
						</p>
					<?php endif; ?>
					<a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr( $item_id ); ?>" href="<?php
					echo wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'delete-menu-item',
								'menu-item' => $item_id,
							),
							admin_url( 'nav-menus.php' )
						),
						'delete-menu_item_' . $item_id
					); ?>"><?php esc_html_e( 'Remove', 'freelo' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr( $item_id ); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
					?>#menu-item-settings-<?php echo esc_attr( $item_id ); ?>"><?php esc_html_e( 'Cancel', 'freelo' ); ?></a>
				</div>

				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item_id ); ?>" />
				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
			<?php
			$output .= ob_get_clean();
		}

	} // Walker_Nav_Menu_Edit

}

if( !class_exists( 'Ishyboy_Frontend_Walker' ) )
{

	/**
	 * Create HTML list of nav menu input items.
	 * A copy of Walker_Nav_Menu WordPress Class modified to support new fields
	 *
	 * @package WordPress
	 * @since 3.0.0
	 * @uses Walker_Nav_Menu
	 */
	class Ishyboy_Frontend_Walker extends Walker {
		/**
		 * What the class handles.
		 *
		 * @see Walker::$tree_type
		 * @since 3.0.0
		 * @var string
		 */
		public $tree_type = array( 'post_type', 'taxonomy', 'custom' );

		/**
		 * Database fields to use.
		 *
		 * @see Walker::$db_fields
		 * @since 3.0.0
		 * @todo Decouple this.
		 * @var array
		 */
		public $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

		public $megamenu_active = false;
		public $megamenu_items_count = 0;


		/**
		 * Starts the list before the elements are added.
		 *
		 * @see Walker::start_lvl()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   An array of arguments. @see wp_nav_menu()
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			if ( 0 === $depth ) $output .= '{ish_megamenu_opener}';
			$output .= "\n$indent<ul class=\"sub-menu\">\n";
		}

		/**
		 * Ends the list of after the elements are added.
		 *
		 * @see Walker::end_lvl()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   An array of arguments. @see wp_nav_menu()
		 */
		public function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "$indent</ul>\n";

			if ( $depth === 0 ) {

				if ( $this->megamenu_active ) {

					$output .= "\n</div>\n</div>\n";
					$output = str_replace( '{ish_megamenu_opener}', "\n<div class='ish-megamenu-container ish-megamenu-columns-" . $this->megamenu_items_count . "'><div class=\"ish-megamenu-inner\">\n", $output );
					$this->megamenu_items_count = 0;

				}
				else {
					$output = str_replace( '{ish_megamenu_opener}', '', $output );
				}
			}
		}

		/**
		 * Start the element output.
		 *
		 * @see Walker::start_el()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item   Menu item data object.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   An array of arguments. @see wp_nav_menu()
		 * @param int    $id     Current item ID.
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$item_output = '';

			if ( 0 === $depth ) {
				$this->megamenu_active = ( isset( $item->megamenu ) && ( '' != $item->megamenu ) );

				if ( $this->megamenu_active ){
					$classes[] = 'ish-megamenu-item';
				}
			}
			else if ( 1 === $depth && $this->megamenu_active ) {
				$classes[] = 'ish-megamenu-column';
			}



			/**
			 * Filter the CSS class(es) applied to a menu item's list item element.
			 *
			 * @since 3.0.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param array  $classes The CSS classes that are applied to the menu item's `<li>` element.
			 * @param object $item    The current menu item.
			 * @param array  $args    An array of {@see wp_nav_menu()} arguments.
			 * @param int    $depth   Depth of menu item. Used for padding.
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );

			if ( 2 < $depth && $this->megamenu_active && false === strpos( $class_names, 'ish-icon-' ) ) {

				if ( !(' ' != $item->post_content && '' != $item->post_content && '-' == $item->title ) ) {
					// Do not add bullets if description is entered.
					$class_names .= apply_filters( 'ish_megamenu_default_bullet_classes',' ish-icon-right-open-1 ish-default-bullet' );
				}

			}

			// Add class to Link or span if the item displays description
			if ( 1 <= $depth && $this->megamenu_active && ' ' != $item->post_content && '' != $item->post_content) {
				$class_names .= ' ish-has-description';
			}


			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			/**
			 * Filter the ID applied to a menu item's list item element.
			 *
			 * @since 3.0.1
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
			 * @param object $item    The current menu item.
			 * @param array  $args    An array of {@see wp_nav_menu()} arguments.
			 * @param int    $depth   Depth of menu item. Used for padding.
			 */
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $class_names .'>';

			$atts = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
			$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
			$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

			/**
			 * Filter the HTML attributes applied to a menu item's anchor element.
			 *
			 * @since 3.6.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param array $atts {
			 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
			 *
			 *     @type string $title  Title attribute.
			 *     @type string $target Target attribute.
			 *     @type string $rel    The rel attribute.
			 *     @type string $href   The href attribute.
			 * }
			 * @param object $item  The current menu item.
			 * @param array  $args  An array of {@see wp_nav_menu()} arguments.
			 * @param int    $depth Depth of menu item. Used for padding.
			 */
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			if ( 1 === $depth && $this->megamenu_active ) {
				$this->megamenu_items_count++;

				$megamenu_title = apply_filters( 'the_title', $item->title, $item->ID );

				if ( '-' != $item->title )
				{
					$attributes = str_replace( 'class="', 'class="ish-megamenu-title ish-h5 ', $attributes);

					$item_output .= $args->before;
					if ( isset($atts['href']) && ! empty($atts['href']) && ('#' !== $atts['href']) ) {
						$item_output .= '<a' . $attributes . '>';
					} else{
						$attributes = str_replace( ' href="#"', '', $attributes );
						$attributes = str_replace( ' target="_blank"', '', $attributes );
						$item_output .= '<span' . $attributes . '>';
					}

					$item_output .= $args->link_before . $megamenu_title . $args->link_after;

					if ( isset($atts['href']) && ! empty($atts['href']) && ('#' !== $atts['href']) ) {
						$item_output .= '</a>';
					} else{
						$item_output .= '</span>';
					}

				}
			}
			else{
				/** This filter is documented in wp-includes/post-template.php */

				if ( '-' != $item->title ) {
					$item_output .= '<a' . $attributes . '>';
					$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
					$item_output .= '</a>';
				}
			}

			if ( 1 <= $depth && $this->megamenu_active && ' ' != $item->post_content && '' != $item->post_content) {

				$item_output .= '<div class="ish-menu-item-description">';
				$item_output .= $args->link_before . do_shortcode( $item->post_content ) . $args->link_after;
				$item_output .= '</div>';

			}



			$item_output .= $args->after;

			/**
			 * Filter a menu item's starting output.
			 *
			 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
			 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
			 * no filter for modifying the opening and closing `<li>` for a menu item.
			 *
			 * @since 3.0.0
			 *
			 * @param string $item_output The menu item's starting HTML output.
			 * @param object $item        Menu item data object.
			 * @param int    $depth       Depth of menu item. Used for padding.
			 * @param array  $args        An array of {@see wp_nav_menu()} arguments.
			 */
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

		/**
		 * Ends the element output, if needed.
		 *
		 * @see Walker::end_el()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item   Page data object. Not used.
		 * @param int    $depth  Depth of page. Not Used.
		 * @param array  $args   An array of arguments. @see wp_nav_menu()
		 */
		public function end_el( &$output, $item, $depth = 0, $args = array() ) {
			$output .= "</li>\n";
		}

	} // Walker_Nav_Menu

}

$GLOBALS['ish_megamenu'] = new Ishyoboy_Megamenu();