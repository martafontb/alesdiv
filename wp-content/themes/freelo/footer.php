<?php
    global $ishfreelotheme_sidebar_width, $ishfreelotheme_sidebar_area, $ishfreelotheme_options;
?>
	            <?php if ( ishfreelotheme_use_footer_sidebar() ){?>
	                <!-- Footer part section -->

		            <?php $footer_class = ( isset($ishfreelotheme_options['footer_text_align'])) ? ( ' ish-' . esc_attr( $ishfreelotheme_options['footer_text_align'] ) ) : ''; ?>

	                <section class="ish-part_footer<?php echo esc_attr( $footer_class ); ?>" id="ish-part_footer">

		                <div class="ish-row ish-row-notfull">
			                <div class="ish-row_inner">

		                        <?php $ishfreelotheme_sidebar_width = 12; // Used when displaying widgets ?>
				                <?php $ishfreelotheme_sidebar_area = 'footer-sidebar'; // Used when displaying widgets ?>
				                <?php if (function_exists( 'dynamic_sidebar') && dynamic_sidebar(ishfreelotheme_get_footer_sidebar())) : else : ?>

		                        <!-- NO WIDGETS -->

	                            <?php endif; ?>
				            </div>
	                    </div>

	                </section>
	                <!-- Footer part section END -->
	            <?php } ?>

				<?php if ( ishfreelotheme_use_footer_legals() ){?>
	                <!-- Footer legals part section -->
	                <section class="ish-part_legals">

		                <div class="ish-row ish-row-notfull ish-resp-centere">
			                <div class="ish-row_inner">
				                <?php
				                $f_legals = do_shortcode($ishfreelotheme_options['footer_legals_area']);
				                $f_legals = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $f_legals );
				                echo apply_filters( 'ishfreelotheme_footer_legals_output', $f_legals );
				                ?>
				            </div>
	                    </div>

	                </section>
	                <!-- Footer legals part section END -->
	            <?php } ?>


			</div>
			<!-- Wrap whole page - boxed / unboxed END -->

			<?php
			if ( isset( $ishfreelotheme_options['show_back_to_top'] ) && ( '1' == $ishfreelotheme_options['show_back_to_top'] ) ){
				echo '<a href="#top" class="ish-back_to_top ish-smooth_scroll ish-icon-angle-double-up"></a>';
			}
			?>


		</div>
		<!-- ish-body END -->


        <!--[if lte IE 8]><script src="<?php echo get_template_directory_uri(); ?>/assets/frontend/js/ie8.js"></script><![endif]-->

		<?php

        /*
         * Call wp footer
         */
        wp_footer();

        ?>
	</body>

</html>