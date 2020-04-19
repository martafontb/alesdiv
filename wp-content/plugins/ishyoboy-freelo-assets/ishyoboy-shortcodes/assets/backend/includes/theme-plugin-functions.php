<?php

if ( ! function_exists( 'ishfreelotheme_get_title_color_data' ) ) {
	function ishfreelotheme_get_title_color_data( $id = null ){

		if ( null == $id ){
			$id = get_the_ID();
		}

		$bg_class = '';

		// Grid Item Color
		$bg_color = IshYoMetaBox::get('title_color', true, $id );
		if ( ! empty( $bg_color ) ){
			$bg_class = ' ish-' . $bg_color;
		}

		$text_class = '';

		// Grid Item Text Color
		$text_color = IshYoMetaBox::get('title_text_color', true, $id );
		if ( ! empty( $text_color ) ){
			$text_class = ' ish-text-' . $text_color;
		}

		$data = Array(
			'bg_color' => $bg_color,
			'text_color' => $text_color,
			'bg_class' => $bg_class,
			'text_class' => $text_class,
			'classes' => $bg_class . $text_class,
		);

		return apply_filters( 'ishfreelotheme_get_title_color_data', $data, $id );

	}
}

if ( ! function_exists( 'ishfreelotheme_get_color_data' ) ) {
	function ishfreelotheme_get_color_data( $id = null ){

		if ( null == $id ){
			$id = get_the_ID();
		}

		$bg_class = '';

		// Grid Item Color
		$bg_color = IshYoMetaBox::get('color', true, $id );
		if ( ! empty( $bg_color ) ){

			/*
			if ( is_page() ){
				$bg_color = 'color3';
			}
			else{
				$bg_color = 'color5';
			}
			/**/

			$bg_class = ' ish-' . $bg_color;

		}

		$text_class = '';

		// Grid Item Text Color
		$text_color = IshYoMetaBox::get('text_color', true, $id );
		if ( ! empty( $text_color ) ){

			/*
			if ( is_page() ){
				$text_color = 'color1';
			}
			else{
				$text_color = 'color3';
			}
			/**/

			$text_class = ' ish-text-' . $text_color;
		}

		$data = Array(
			'bg_color' => $bg_color,
			'text_color' => $text_color,
			'bg_class' => $bg_class,
			'text_class' => $text_class,
			'classes' => $bg_class . $text_class,
		);

		return apply_filters( 'ishfreelotheme_get_color_data', $data, $id );

	}
}

if ( ! function_exists( 'ish_get_the_ID' ) ) {
	function ish_get_the_ID(){

		if ( is_home() ){
			$pst = get_post( get_option( 'page_for_posts' ) );
			if ( 'page' != get_option('show_on_front') ){
				$pst = null;
			}
			return (!empty($pst)) ? ( $pst->ID ) : null;
		}

		$pst = get_post();
		return (!empty($pst)) ? ( $pst->ID ) : null;

	}
}

if ( ! function_exists( 'ishfreelotheme_get_post_format_quote' ) ) {
	function ishfreelotheme_get_post_format_quote(){

		if (function_exists( 'get_post_format_meta')){

			/**
			 *   Adding support fo WP >= 3.6.0
			 */
			$meta =  get_post_format_meta( get_the_ID() );
			return $meta['quote'];
		} else{

			/**
			 *   WP <= 3.5.9
			 */
			return IshYoMetaBox::get('post_quote');
		}

	}
}

if ( ! function_exists( 'ishfreelotheme_get_post_format_quote_source' ) ) {
	function ishfreelotheme_get_post_format_quote_source(){

		if (function_exists( 'get_post_format_meta')){

			/**
			 *   Adding support fo WP >= 3.6.0
			 */
			$meta =  get_post_format_meta( get_the_ID() );
			return $meta['quote_source'];
		} else{

			/**
			 *   WP <= 3.5.9
			 */
			return IshYoMetaBox::get('post_quote_source');
		}

	}
}

if ( ! function_exists( 'ishfreelotheme_get_post_format_url' ) ) {
	function ishfreelotheme_get_post_format_url() {


		if (function_exists( 'get_the_post_format_url')){

			/**
			 *   Adding support fo WP >= 3.6.0
			 */
			$url =  get_the_post_format_url();
			return ($url) ? $url : apply_filters( 'the_permalink', get_permalink() );
		} else{

			/**
			 *   WP <= 3.5.9
			 */
			switch (get_post_format()){
				case 'quote' :
					$url = IshYoMetaBox::get('post_quote_url');
					break;
				default :
					$url = IshYoMetaBox::get('post_url');
					break;
			}
			return ($url) ? $url : '';
		}
	}
}

if ( ! function_exists( 'ishfreelotheme_get_post_format_url_text' ) ) {
	function ishfreelotheme_get_post_format_url_text() {
		$url = IshYoMetaBox::get('post_url_text');
		return ( $url ) ? $url : '';
	}
}

if ( ! function_exists( 'ishfreelotheme_the_post_video' ) ) {
	function ishfreelotheme_the_post_video( $id, $ish_tagline_bg_color = '', $ish_tagline_text_color = '', $ish_blog_type = '', $show_image_placeholder = false, $permalink_on_images = false ) {
		global $content_width;

		$ish_link_read_more = '';

		$ish_grid = ( 'classic' != $ish_blog_type ) ? ' ish-grid6' : '';

		if ( $show_image_placeholder ){
			$ish_link_read_more = '<div class="ish-blog-post-media">
									<div class="ish-main-post-image ish-empty">
										<div class="ish-main-post-image-content">
											<a href="' . get_permalink() . '">
												<i class="' . ishfreelotheme_get_post_format_icon() . '"></i>
											</a>
										</div>
									</div>';
		}
		else {
			$ish_link_read_more = '<div class="ish-blog-post-media">
									<a href="' . get_permalink() . '" class="ish-link-media">
										<h3 class="ish-format-link-url ish-h5 ish-link-read-more">
											' . esc_html__( 'Read More', 'freelo' ) . '
										</h3>
									</a>';
		}

		wp_enqueue_script( 'wp-mediaelement' );
		wp_enqueue_style( 'wp-mediaelement' );

		if (function_exists( 'get_the_post_format_media')){

			echo '<div class="ish-post-media' . $ish_grid . '">';
			echo '<div class="ish-blog-post-media">';
			/**
			 *   Adding support fo WP >= 3.6.0
			 */
			$video = get_the_post_format_media('video');
			if ( '' != $video ) {
				echo '<div class="ish-blog-video-content">', $video, '</div>';
			}

		} else{

			/**
			 *   WP <= 3.5.9
			 */
			if ( ( 'true' == IshYoMetaBox::get('post_embedded_video', true, $id) ) ){

				$video = IshYoMetaBox::get('post_video', true, $id);
				if ( '' != $video ) {?>
					<div class="ish-post-media<?php echo esc_attr( $ish_grid ); ?>">
						<div class="ish-blog-post-media">
							<div class="ish-blog-video-content">
								<!-- EMBEDDED VIDEO BEGIN -->
								<?php

								if ( substr($video, 0, 4) == "http" ){
									global $wp_embed;
									echo do_shortcode($wp_embed->run_shortcode('[embed]'. $video . '[/embed]'));
								}else{
									echo str_replace( '&', '&amp;', $video );
								}

								?>
								<!-- EMBEDDED VIDEO END -->
							</div>
				<?php } else {
					if ( has_post_thumbnail() && ( 'classic' != $ish_blog_type ) ){
						$img_details = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'theme-large' );

						$return = '';
						$return .= '<div class="ish-post-media' . $ish_grid . '">';
						$return .= '<div class="ish-blog-post-media">';
						$return .= '<div class="ish-main-post-image">';

						$return .= '<div class="ish-main-post-image-content">'; //style="background-image: url(' . $img_details[0] . ');"

						if ( $permalink_on_images ){
							$return .= '<a href="' . get_permalink() . '">';
						}
						else{
							$img_details = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full' );
							$return .= '<a href="' . esc_attr( $img_details[0] ) . '" target="_blank">';
						}

						$return .= get_the_post_thumbnail($id, 'theme-large');
						$return .= '</a>';
						$return .= '</div>';

						$return .= '</div>';

						echo apply_filters( 'ishfreelotheme_post_media_output', $return );
					}
					else {
						$return = '';
						$return .= '<div class="ish-post-media' . $ish_grid . $ish_tagline_text_color . $ish_tagline_bg_color . '">';
						//$return .= '<div class="ish-blog-post-media ish-empty">';
						if ( 'classic' != $ish_blog_type ) {
							$return .= $ish_link_read_more;
						}
						else {
							echo '<div class="ish-blog-post-media">';
						}

						/*if ( $show_image_placeholder ){
							$return .= '<div class="ish-main-post-image"><div class="ish-main-post-image-content"><a href="' . get_permalink() . '"><i class="' . ishfreelotheme_get_post_format_icon() . '"></i></a></div></div>';
						}*/

						echo apply_filters( 'ishfreelotheme_post_media_output', $return );
					}
				}
			} else {

				echo '<div class="ish-post-media' . $ish_grid . $ish_tagline_text_color . $ish_tagline_bg_color . '">';

				$mp4 = IshYoMetaBox::get('post_video_mp4', true, $id);
				$mebm = IshYoMetaBox::get('post_video_webm', true, $id);

				if ( '' != $mp4 || '' != $mebm ) { ?>
					<div class="ish-blog-post-media">
					<div class="ish-blog-video-content">
						<!-- HTML5 VIDEO BEGIN -->
						<div class="wp-video">
							<video class="wp-video-shortcode ish-video" controls="controls" preload="metadata" style="width: 100%; height: 100%;" width="<?php echo esc_attr($content_width); ?>" <?php if ('' != IshYoMetaBox::get('post_video_poster', true, $id)) echo 'poster="' . IshYoMetaBox::get('post_video_poster', true, $id) . '"'; ?>>
								<?php if ( '' != $mp4 ) echo '<source src="' . $mp4 . '" type="video/mp4"/>'; ?>
								<?php if ( '' != $mebm ) echo '<source src="' . $mebm . '" type="video/webm"/>'; ?>
								<?php if ( '' != $mp4 ) { echo '<a href="' . $mp4 . '">' . $mp4 . '</a>'; } else { echo '<a href="' . $mebm . '">' . $mebm . '</a>'; } ?>
							</video>
						</div>
						<!-- HTML5 VIDEO END -->
					</div><?php
				} else {

					if ( has_post_thumbnail() && ( 'classic' != $ish_blog_type ) ){

						$img_details = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'theme-large' );

						$return = '';
						$return .= '<div class="ish-blog-post-media">';
						$return .= '<div class="ish-main-post-image">';

						$return .= '<div class="ish-main-post-image-content" style="background-image: url(' . $img_details[0] . ');">';

						if ( $permalink_on_images ){
							$return .= '<a href="' . get_permalink() . '">';
						}
						else{
							$img_details = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full' );
							$return .= '<a href="' . esc_attr( $img_details[0] ) . '" target="_blank">';
						}

						$return .= get_the_post_thumbnail($id, 'theme-large');
						$return .= '</a>';
						$return .= '</div>';

						$return .= '</div>';

						echo apply_filters( 'ishfreelotheme_post_media_output', $return );
					}
					else {
						$return = '';
						//$return .= '<div class="ish-blog-post-media ish-empty">';
						if ( 'classic' != $ish_blog_type ) {
							$return .= $ish_link_read_more;
						}
						else {
							echo '<div class="ish-blog-post-media">';
						}


						/*if ( $show_image_placeholder ){
							$return .= '<div class="ish-main-post-image ish-empty"><div class="ish-main-post-image-content"><a href="' . get_permalink() . '"><i class="' . ishfreelotheme_get_post_format_icon() . '"></i></a></div></div>';
						}*/

						echo apply_filters( 'ishfreelotheme_post_media_output', $return );

					}

				}
			}
		}

		echo '</div>';
		echo '</div>';
	}
}

if ( ! function_exists( 'ishfreelotheme_the_post_audio' ) ) {
	function ishfreelotheme_the_post_audio( $id, $ish_tagline_bg_color = '', $ish_tagline_text_color = '', $ish_blog_type = '', $show_image_with_player = true, $permalink_on_images = true, $show_post_thumbnail_backup = true){

		$ish_link_read_more = '<div class="ish-blog-post-media">
									<a href="' . get_permalink() . '" class="ish-link-media">
										<h3 class="ish-format-link-url ish-h5 ish-link-read-more">
											' . esc_html__( 'Read More', 'freelo' ) . '
										</h3>
									</a>';

		$ish_grid = ( 'classic' != $ish_blog_type ) ? ' ish-grid6' : '';

		if ( '' != IshYoMetaBox::get('post_audio', true, $id) ) {?>

			<?php
			wp_enqueue_script( 'wp-mediaelement' );
			wp_enqueue_style( 'wp-mediaelement' );
			?>

				<?php
				if ( $show_image_with_player && (function_exists( 'has_post_thumbnail')) && (has_post_thumbnail())  ){
					$img_details = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'theme-large' );
					?>
					<div class="ish-post-media<?php echo esc_attr( $ish_grid ); ?>">
						<div class="ish-blog-post-media">
							<div class="ish-blog-audio-content">
								<div class="ish-blog-audio-image ish-main-post-image"> <!--style="background-image: url('<?php /*echo esc_url($img_details[0]); */?>');"-->
									<?php if ( !is_single() ) { ?>
										<a href="<?php the_permalink(); ?>">
											<?php echo get_the_post_thumbnail($id, 'theme-large'); ?>
										</a>
									<?php } else { ?>
										<?php
										$img_details = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full' );
										?>
										<a href="<?php echo esc_attr($img_details[0]); ?>"  target="_blank">
											<?php  echo get_the_post_thumbnail($id, 'theme-large'); ?>
										</a>
									<?php } ?>
								</div>
				<?php
				}
				else {
					$return = '';
					$return .= '<div class="ish-post-media' . $ish_grid . '">';
					$return .= '<div class="ish-blog-post-media">';
					$return .= '<div class="ish-blog-audio-content' . $ish_tagline_bg_color . $ish_tagline_text_color . '">';

					if ( $show_image_with_player ) {
						if ( 'classic' != $ish_blog_type ) {
							$return .= '<div class="ish-blog-post-media ish-empty"><div class="ish-main-post-image-content"><a href="' . get_permalink() . '"><i class="' . ishfreelotheme_get_post_format_icon() . '"></i></a></div></div>';
						}
					}
					else {
						$return .= '<div class="ish-blog-post-media ish-empty">';
						//$return .= $ish_link_read_more;
						$return .= '</div>';
					}

					echo apply_filters( 'ishfreelotheme_post_media_output', $return );

				}
				?>

				<div class="ish-blog-audio-player">
					<!-- AUDIO BEGIN -->
					<?php $audio = IshYoMetaBox::get('post_audio', true, $id); ?>
					<!--[if lt IE 9]><script>document.createElement('audio');</script><![endif]-->
					<?php echo '<audio class="wp-audio-shortcode ish-audio" preload="none" style="width: 100%" controls="controls">
						<source type="audio/mpeg" src="' . $audio . '" />
						<a href="' . $audio . '">' . $audio . '</a>
					</audio>'; ?>
					<!-- AUDIO END -->
				</div>
			</div>
		<?php } else {

			if ( has_post_thumbnail() && ( 'classic' != $ish_blog_type ) ){

				if ( $show_post_thumbnail_backup ) {

					$img_details = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'theme-large');

					$return = '';
					$return .= '<div class="ish-post-media' . $ish_grid . '">';
					$return .= '<div class="ish-blog-post-media">';
					$return .= '<div class="ish-main-post-image">';

					$return .= '<div class="ish-main-post-image-content">'; // style="background-image: url(' . $img_details[0] . ');"

					if ($permalink_on_images) {
						$return .= '<a href="' . get_permalink() . '">';
					} else {
						$img_details = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'full');
						$return .= '<a href="' . esc_attr($img_details[0]) . '" target="_blank">';
					}

					$return .= get_the_post_thumbnail($id, 'theme-large');
					$return .= '</a>';

					$return .= '</div>';

					$return .= '</div>';

					echo apply_filters( 'ishfreelotheme_post_media_output', $return );

				}
				else {
					echo '<div class="ish-post-media' . $ish_tagline_bg_color . $ish_tagline_text_color . '">';
					//echo '<div class="ish-blog-post-media ish-empty">';
					if ( 'classic' != $ish_blog_type ) {
						echo apply_filters( 'ishfreelotheme_post_media_link_more_output', $ish_link_read_more );
					}
					else {
						echo '<div class="ish-blog-post-media">';
					}
				}
			}
			else {
				$return = '';
				$return .= '<div class="ish-post-media' . $ish_grid . $ish_tagline_bg_color . $ish_tagline_text_color . '">';
				//$return .= '<div class="ish-blog-post-media ish-empty">';
				if ( 'classic' != $ish_blog_type ) {
					$return .= $ish_link_read_more;
				}
				else {
					echo '<div class="ish-blog-post-media">';
				}

				echo apply_filters( 'ishfreelotheme_post_media_output', $return );

			}
		}

		echo '</div>';
		echo '</div>';
	}
}

if ( ! function_exists( 'ishfreelotheme_get_item_bg_style' ) ) {
	function ishfreelotheme_get_item_bg_style( $id = null ){

		if ( null == $id ){
			$id = ish_get_the_ID();
		}

		if ( has_post_thumbnail() ) {
			$img_id = get_post_thumbnail_id( get_the_ID() );
			$img_details = wp_get_attachment_image_src( $img_id, 'theme-large' );
			$bg_style = 'style="background-image: url(\'' . $img_details[0] . '\'); background-size: cover; background-position-y: 50%; background-attachment: fixed;"';
			return $bg_style;
		}

		return '';
	}
}

if ( ! function_exists( 'ishfreelotheme_get_masonry_item_bg_style' ) ) {
	function ishfreelotheme_get_masonry_item_bg_style( $id = null ){

		if ( null == $id ){
			$id = ish_get_the_ID();
		}

		if ( has_post_thumbnail() ) {
			$img_id = get_post_thumbnail_id( get_the_ID() );
			$img_details = wp_get_attachment_image_src( $img_id, 'theme-large' );
			$bg_style = 'style="background-image: url(\'' . $img_details[0] . '\'); background-size: cover; background-position: 50% 50%;"';
			return $bg_style;
		}

		return '';
	}
}



if ( ! function_exists( 'ishfreelotheme_get_blog_overlay_div' ) ) {
	function ishfreelotheme_get_blog_overlay_div( $id = null ){
		global $post;

		if ( null == $id ){
			$id = get_the_ID();
		}

		$color_opacity = IshYoMetaBox::get( 'overview_color_opacity', true, $id );
		$color_opacity = trim( str_replace( '%', '' , $color_opacity ) );
		$overlay_container = '<div class="ish-overlay"></div>';

		if ( '' != $color_opacity ){

			if ( is_numeric( $color_opacity ) ){
				if ( $color_opacity > 100 ) { $color_opacity = 100; }
				else if ( $color_opacity < 0 ) { $color_opacity = 0; }
				else if ( $color_opacity > 0 && $color_opacity < 1  ) { $color_opacity = $color_opacity * 100; }
			}
			else {
				$color_opacity = '';
			}

			if ( '' != $color_opacity ){
				$overlay_container = '<div class="ish-overlay" style="opacity: ' . ( $color_opacity / 100) . ';"></div>';
			}
			else{
				$overlay_container = '<div class="ish-overlay"></div>';
			}
		}
		else{
			$color_opacity = ( defined('ISHFREELOTHEME_BLOG_OPACITY') ) ? ( ISHFREELOTHEME_BLOG_OPACITY / 100 ) : '0.3';
			$overlay_container = '<div class="ish-overlay" style="opacity: ' . $color_opacity . ';"></div>';
		}

		return $overlay_container;
	}
}

if ( ! function_exists( 'ishfreelotheme_get_blog_excerpt' ) ) {
	function ishfreelotheme_get_blog_excerpt( $length = null ){

		/*if ( ! empty( $length ) ) {

			$func = function( $arg ) use ( $length ) {
				return $length;
			}

			add_filter( 'excerpt_length', $func, 999 );
		}*/

		if ( ! empty( $length ) ) {
			$excerpt = wpautop( wp_trim_words( apply_filters( 'the_excerpt', get_the_excerpt() ) , $length ) );
		} else {
			$excerpt =  wpautop( apply_filters( 'the_excerpt', get_the_excerpt() ) );
		}

		if ( ! empty( $excerpt ) ) {
			return '<div class="ish-blog-post-excerpt">' . $excerpt . '</div>';
		}
		else{
			return '';
		}

	}
}

if ( ! function_exists( 'ishfreelotheme_get_post_details' ) ) {
	function ishfreelotheme_get_post_details(){

		// Call masonry details as they are the same in this theme
		return ishfreelotheme_get_masonry_post_details();

	}
}

if ( ! function_exists( 'ishfreelotheme_get_single_post_details' ) ) {
	function ishfreelotheme_get_single_post_details()
	{

//		global $post, $authordata;
//		if ( !is_object( $authordata ) ){
//			if ( isset( $post->post_author ) ){
//				$authordata = get_userdata( $post->post_author );
//			}
//		}

		$return = '';

		$return .= '<div class="ish-blog-post-details">';


		$return .= '<span>';
		// Icon & Date
		// $return .= esc_html__( 'Posted:', 'freelo' ) . ' ';
		$return .= '<a href="' . get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')) . '">' . get_the_time(get_option('date_format')) . '</a>';
		$return .= '</span>';

//		//Author
//		if ( is_object( $authordata ) ) {
//			$return .= '<span class="ish-spacer">.</span>';
//			//$return .= '<span>' . esc_html__( 'By:', 'freelo' ) . ' ';
//			$return .= '<a href="' . get_author_posts_url( $authordata->ID ). '">' . get_the_author() . '</a>' . '</span>';
//		}
//
//		// Likes
//		$return .= '<span class="ish-spacer">.</span>';
//		$return .= '<span>' . ishfreelotheme_get_likes(false) . '</span>';
//
//		// Comments
//		$return .= '<span class="ish-spacer">.</span>';
//		$return .= '<span>' . '<a href="' . get_comments_link() . '">' . get_comments_number_text('0 ' . esc_html__( 'Comments', 'freelo' ), '1 ' . esc_html__( 'Comment', 'freelo' ) , '% ' . esc_html__( 'Comments', 'freelo' )) . '</a>' . '</span>';

		// Categories
		if ( has_category() ){

			$return .= '<span class="ish-spacer">/</span>';
			//$return .= '<span>' . esc_html__( 'Categories:', 'freelo' ) . ' ';

			$terms = get_the_terms(get_the_ID(), 'category');

			if ( isset( $terms ) && '' != $terms ) {
				$i = 0;
				foreach ( $terms as $term ) {
					$i++;
					if ( 1 != $i ) {
						$return .= ', ';
					}
					$return .= '<a href="' . esc_attr( get_term_link( $term ) ) . '">' . $term->name . '</a>';
					if ( 1 <= $i ) {
						// Break to display only first N category
						break;
					}
				}
			}

			// $return .= '</span>';
		}

		// Reading Time
		$reading_time = esc_html( IshYoMetaBox::get( 'post_reading_time', true, get_the_ID() ) );
		if ( $reading_time ){

			$return .= '<span class="ish-spacer">/</span>';
			$return	.= '<a href="' . get_the_permalink() . '">';
			$return .= '<span>';
			$return .= $reading_time . ' ';
			$return .= esc_html__( 'min. read', 'freelo' );
			$return .= '</span>';
			$return .= '</a>';
		}

		// Tags
		/* if ( has_tag() ){

			$return .= '<span class="ish-spacer">.</span>';
			// $return .= '<span>' . esc_html__( 'Tags:', 'freelo' ) . ' ';

			$terms = get_the_terms(get_the_ID(), 'post_tag');

			if ( isset( $terms ) && '' != $terms ) {
				$i = 0;
				foreach ( $terms as $term ) {
					$i++;
					if ( 1 != $i ) {
						$return .= ', ';
					}
					$return .= '<a href="' . esc_attr( get_term_link( $term ) ) . '">' . '#' . $term->name . '</a>';
					if ( 1 <= $i ) {
						// Break to display only first N tags
						break;
					}
				}
			}

			// $return .= '</span>';
		}*/

		// Permalink
		//$return	.=  '<div><span>' . '<a href="' . get_the_permalink() . '"><i class="ish-icon-export-1"></i></a>' . '</span></div>';

		$return .= '</div>';

		return $return;
	}
}

if ( ! function_exists( 'ishfreelotheme_get_all_post_details' ) ) {
	function ishfreelotheme_get_all_post_details( $id = null, $use_colors = null  )
	{

		global $post, $authordata;
		if ( !is_object( $authordata ) ){
			if ( isset( $post->post_author ) ){
				$authordata = get_userdata( $post->post_author );
			}
		}

		$return = '';

		// use tagline custom colors for ish-single_post_categories_and_tags box
		$tagline_colors_use = '';

		if ( null == $id ){
			$id = get_the_ID();
		}

		if ( null == $use_colors ){
			$use_colors = ( 'true' == IshYoMetaBox::get( 'use_colors', true, $id ) ) ? true : false;
		}

		// check if tagline has custom colors and use tagline custom colors
		$ish_color_data = ishfreelotheme_get_title_color_data( $id );
		if ( $use_colors && '' != $ish_color_data['bg_class'] ) {
			$text_color_class = $ish_color_data['classes'];
			$tagline_colors_use = $text_color_class;
		} else {
			$tagline_colors_use = 'ish-color1 ish-text-color4';
		}


		$return = '<div class="ish-single_post_categories_and_tags ' . $tagline_colors_use . '">';
		//$term_separator = '<span class="ish-separator">/</span>';

		//Author
		if ( is_object( $authordata ) ) {
			//$return .= '<span>' . esc_html__( 'By:', 'freelo' ) . ' ';
			$return .= '<a href="' . get_author_posts_url( $authordata->ID ). '">' . get_the_author() . '</a>';
			//$return .= '</span>';
		}

		// Comments
		$return .= '<span class="ish-spacer">/</span>';
		$return .= '<span>' . '<a href="' . get_comments_link() . '">' . get_comments_number_text('0 ' . esc_html__( 'Comments', 'freelo' ), '1 ' . esc_html__( 'Comment', 'freelo' ) , '% ' . esc_html__( 'Comments', 'freelo' )) . '</a>' . '</span>';

		// Likes
		$return .= '<span class="ish-spacer">/</span>';
		$return .= '<span>' . ishfreelotheme_get_likes(false) . '</span>';

		// Categories
		if ( has_category() ){

			$return .= '<span class="ish-spacer">/</span>';
			//$return .= '<span>' . esc_html__( 'Categories:', 'freelo' ) . ' ';

			$terms = get_the_terms(get_the_ID(), 'category');

			if ( isset( $terms ) && '' != $terms ) {
				$i = 0;
				foreach ( $terms as $term ) {
					$i++;
					if ( 1 != $i ) {
						$return .= ', ';
					}
					$return .= '<a href="' . esc_attr( get_term_link( $term ) ) . '">' . $term->name . '</a>';
					//if ( 1 <= $i ) {
						// Break to display only first N category
					//	break;
					//}
				}
			}

			//$return .= '</span>';
		}

		// Tags
		if ( has_tag() ){

			$return .= '<span class="ish-spacer">/</span>';
			// $return .= '<span>' . esc_html__( 'Tags:', 'freelo' ) . ' ';

			$terms = get_the_terms(get_the_ID(), 'post_tag');

			if ( isset( $terms ) && '' != $terms ) {
				$i = 0;
				foreach ( $terms as $term ) {
					$i++;
					if ( 1 != $i ) {
						$return .= ', ';
					}
					$return .= '<a href="' . esc_attr( get_term_link( $term ) ) . '">' . '#' . $term->name . '</a>';
					//if ( 1 <= $i ) {
						// Break to display only first N tags
					//	break;
					//}
				}
			}

			//$return .= '</span>';
		}

		// Permalink
		//$return	.=  '<div><span>' . '<a href="' . get_the_permalink() . '"><i class="ish-icon-export-1"></i></a>' . '</span></div>';

		$return .= '</div>';

		return $return;
	}
}

if ( ! function_exists( 'ishfreelotheme_get_responsive_post_details' ) ) {
	function ishfreelotheme_get_responsive_post_details(){
		$return = '';

		$return .= '<div class="ish-blog-responsive-post-details">';

		$return .= '<span>';
		// Icon & Date
		$return	.= '<a href="' . get_day_link( get_post_time('Y'), get_post_time('m'), get_post_time('j') ) . '"><i class="ish-post-main-icon ' . ishfreelotheme_get_post_format_icon() . '"></i>' . get_the_time( get_option( 'date_format' ) ) . '</a>';
		$return .= '</span>';

		$return .= '<span class="ish-spacer">/</span>';
		// Comments
		$return	.= '<span>' . '<a href="'. get_comments_link() . '"><i class="ish-icon-chat"></i>' . get_comments_number_text('0 ' . esc_html__( 'Comments', 'freelo' ), '1 ' . esc_html__( 'Comment', 'freelo' ) , '% ' . esc_html__( 'Comments', 'freelo' )) . '</a>' . '</span>';

		$return .= '<span class="ish-spacer">/</span>';

		// Likes
		$return	.= '<span>' . ishfreelotheme_get_likes( false ) . '</span>';

		$return .= '<span class="ish-spacer">/</span>';

		// Permalink
		$return	.=  '<span>' . '<a href="' . get_the_permalink() . '"><i class="ish-icon-export-1"></i></a>' . '</span>';

		$return .= '</div>';

		return $return;
	}
}

if ( ! function_exists( 'ishfreelotheme_get_post_format_icon' ) ) {
	function ishfreelotheme_get_post_format_icon(){
		switch ( get_post_format() ){
			case 'image' :
				return 'ish-icon-picture-1';
				break;
			case 'audio' :
				return 'ish-icon-note-beamed';
				break;
			case 'video' :
				return 'ish-icon-movie';
				break;
			case 'quote' :
				return 'ish-icon-quote-right';
				break;
			case 'link' :
				return 'ish-icon-link';
				break;
			default:
				return 'ish-icon-doc-text-inv';
		}
		return '';
	}
}

if ( ! function_exists( 'ishfreelotheme_get_masonry_post_details' ) ) {
	function ishfreelotheme_get_masonry_post_details()
	{

		global $post, $authordata;
		if ( !is_object( $authordata ) ){
			if ( isset( $post->post_author ) ){
				$authordata = get_userdata( $post->post_author );
			}
		}

		$return = '';

		$return .= '<div class="ish-blog-post-details">';


		$return .= '<span>';
		// Icon & Date
		// $return .= esc_html__( 'Posted:', 'freelo' ) . ' ';
		$return .= '<a href="' . get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')) . '">' . get_the_time(get_option('date_format')) . '</a>';
		$return .= '</span>';

		//Author
		/*if ( is_object( $authordata ) ) {
			$return .= '<span class="ish-spacer">.</span>';
			//$return .= '<span>' . esc_html__( 'By:', 'freelo' ) . ' ';
			$return .= '<a href="' . get_author_posts_url( $authordata->ID ). '">' . get_the_author() . '</a>' . '</span>';
		}*/

		// Likes
		/*$return .= '<span class="ish-spacer">.</span>';
		$return .= '<span>' . ishfreelotheme_get_likes(false) . '</span>';*/

		// Comments
		/*$return .= '<span class="ish-spacer">.</span>';
		$return .= '<span>' . '<a href="' . get_comments_link() . '">' . get_comments_number_text('0 ' . esc_html__( 'Comments', 'freelo' ), '1 ' . esc_html__( 'Comment', 'freelo' ) , '% ' . esc_html__( 'Comments', 'freelo' )) . '</a>' . '</span>';*/

		// Categories
		if ( has_category() ){

			$return .= '<span class="ish-spacer">/</span>';
			//$return .= '<span>' . esc_html__( 'Categories:', 'freelo' ) . ' ';

			$terms = get_the_terms(get_the_ID(), 'category');

			if ( isset( $terms ) && '' != $terms ) {
				$i = 0;
				foreach ( $terms as $term ) {
					$i++;
					if ( 1 != $i ) {
						$return .= ', ';
					}
					$return .= '<a href="' . esc_attr( get_term_link( $term ) ) . '">' . $term->name . '</a>';
					if ( 1 <= $i ) {
						// Break to display only first N category
						break;
					}
				}
			}

			//$return .= '</span>';
		}

		// Tags
		/*if ( has_tag() ){

			$return .= '<span class="ish-spacer">.</span>';
			// $return .= '<span>' . esc_html__( 'Tags:', 'freelo' ) . ' ';

			$terms = get_the_terms(get_the_ID(), 'post_tag');

			if ( isset( $terms ) && '' != $terms ) {
				$i = 0;
				foreach ( $terms as $term ) {
					$i++;
					if ( 1 != $i ) {
						$return .= ', ';
					}
					$return .= '<a href="' . esc_attr( get_term_link( $term ) ) . '">' . '#' . $term->name . '</a>';
					if ( 1 <= $i ) {
						// Break to display only first N tags
						break;
					}
				}
			}

			$return .= '</span>';
		}*/

		// Comments
		$return .= '<span class="ish-spacer">/</span>';
		$return .= '<span>' . '<a href="' . get_comments_link() . '">' . get_comments_number_text('0 ' . esc_html__( 'Comments', 'freelo' ), '1 ' . esc_html__( 'Comment', 'freelo' ) , '% ' . esc_html__( 'Comments', 'freelo' )) . '</a>' . '</span>';


		// Reading Time
		$reading_time = esc_html( IshYoMetaBox::get( 'post_reading_time', true, get_the_ID() ) );
		if ( $reading_time ){

			$return .= '<span class="ish-spacer">/</span>';
			$return	.= '<a href="' . get_the_permalink() . '">';
			$return .= '<span>';
			$return .= $reading_time . ' ';
			$return .= esc_html__( 'min. read', 'freelo' );
			$return .= '</span>';
			$return .= '</a>';
		}

		// Permalink
		//$return	.=  '<div><span>' . '<a href="' . get_the_permalink() . '"><i class="ish-icon-export-1"></i></a>' . '</span></div>';

		$return .= '</div>';


		return $return;
	}
	/*{
		$return = '';

		ob_start(); ?>
		<span class="ish-blog-post-details">
			<a href="<?php echo get_day_link( get_post_time('Y'), get_post_time('m'), get_post_time('j') ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>
			<a href="<?php comments_link(); ?>"><i class="ish-icon-chat"></i><?php comments_number('0', '1', '%'); ?></a>
			<?php ishfreelotheme_the_likes( false ); ?>
		</span>
		<?php
		$return .= ob_get_contents();
		ob_end_clean();

		return $return;
	}*/
}

if ( ! function_exists( 'ishfreelotheme_get_theme_colors_array' ) ) {
	function ishfreelotheme_get_theme_colors_array() {

		global $ishfreelotheme_options;

		$ish_theme_colors = Array();

		if ( ! empty( $ishfreelotheme_options ) ){

			for ($i = 1; $i <= ISHFREELOTHEME_COLORS_COUNT; $i++ ){

				if ( isset( $ishfreelotheme_options['color' . $i ] ) ){
					$ish_theme_colors[ 'Color' . $i ] = 'color' . $i  ;
				}

			}

		}

		return $ish_theme_colors;

	}
}

if ( ! function_exists( 'ishfreelotheme_output_theme_colors_css' ) ) {
	function ishfreelotheme_output_theme_colors_css() {

		global $ishfreelotheme_options;

		echo '<style type="text/css">';

		for ($i = 1; $i <= ISHFREELOTHEME_COLORS_COUNT; $i++ ){

			if ( ! isset( $ishfreelotheme_options['color' . $i] ) ) {
				$ishfreelotheme_options['color' . $i] = constant( 'ISHFREELOTHEME_COLOR_' . $i );
			}

			echo '.ish_meta_param.ish_color_selector_item color' . $i . ', .ish_meta_param.ish_color_selector_container [data-ish-value="color' . $i . '"] { background-color: ' . $ishfreelotheme_options['color' . $i] . "; color: " . ishfreelotheme_get_color_contrast( $ishfreelotheme_options['color' . $i] ) . "; }\n";

		}

		echo '</style>' . "\n";
	}
}

/**
 * Return an associative array with items containing the $prefix in their key.
 *
 * @param Array - The associative array to be filtered
 * @param string - The prefix of array keys
 * @return Array
 */
if ( ! function_exists( 'ishfreelotheme_filter_array' ) ) {
	function ishfreelotheme_filter_array( $arr, $prefix ) {

		$output = Array();
		$len = strlen( $prefix );

		if ( is_array( $arr ) && ! empty($prefix) ) {

			foreach ( $arr as $key => $val ){

				if ( 0 === strpos( $key, $prefix) ){
					$output[ substr($key, $len)] = $val;
				}
			}
		}

		return $output;

	}
}