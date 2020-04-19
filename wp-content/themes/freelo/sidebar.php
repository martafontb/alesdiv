<?php
global $ishfreelotheme_sidebar_width, $ishfreelotheme_sidebar_area, $ishfreelotheme_options;
$sidebar_position = ishfreelotheme_get_sidebar_position();
$sidebar_resp_center = ( isset($ishfreelotheme_options) && 1 == $ishfreelotheme_options['responsive_content_centering'] ) || ( ! isset($ishfreelotheme_options) ) ? ' ish-resp-centered' : '';

if ( 'left' == $sidebar_position || 'right' == $sidebar_position){
?>
	<div class="ish-grid4 ish-main-sidebar ish-<?php echo esc_attr( $sidebar_position . '-sidebar'. $sidebar_resp_center ); ?>" id="sidebar">
		<div class="ish-row ish-row-notfull">
			<div class="ish-row_inner">
				<?php $ishfreelotheme_sidebar_width = 3; // Used when displaying widgets ?>
				<?php $ishfreelotheme_sidebar_area = 'main-sidebar'; // Used when displaying widgets ?>
				<?php $sidebar = ishfreelotheme_get_sidebar(); ?>
				<?php if (function_exists( 'dynamic_sidebar') && dynamic_sidebar($sidebar)) : else : ?>

					<div class="pre-widget">
						<div class="space"></div>
						<p><strong>Widgetized Sidebar</strong></p>
						<p>This panel is active and ready for you to add some widgets via the WP Admin</p>
					</div>

				<?php endif; ?>

				<div class="space"></div>

			</div>
		</div>
	</div>
<?php
}
?>