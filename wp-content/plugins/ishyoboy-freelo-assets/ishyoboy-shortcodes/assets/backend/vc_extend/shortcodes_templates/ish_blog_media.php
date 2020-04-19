<?php

// Default SC attributes
$defaults = array(
	//'el_text' => '',
);

// Extract all attributes
$sc_atts = $this->extract_sc_attributes( $defaults, $atts );

// SHORTCODE BEGIN
$return = '';
$return .= '<div class="';

// CLASSES
$class = 'ish-sc_blog_media';
$class .= ( '' != $sc_atts['css_class'] ) ? ' ' . esc_attr( $sc_atts['css_class'] ) : '' ;
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_color'] ) ? ' ish-tooltip-' . esc_attr( $sc_atts['tooltip_color'] ) : '';
$class .= ( '' != $sc_atts['tooltip'] && '' != $sc_atts['tooltip_text_color'] ) ? ' ish-tooltip-text-' . esc_attr( $sc_atts['tooltip_text_color'] ) : '';
$class .= ( '' != $sc_atts['bottom_margin'] ) ? ' ish-bottom-margin-' . $sc_atts['bottom_margin'] : '' ;
$return .= apply_filters( 'ish_sc_classes', $class, $tag );
$return .= '"' ;

// ID
$return .= ( '' != $sc_atts['id'] ) ? ' id="' . esc_attr( $sc_atts['id'] ) . '"' : '';

// STYLE
if ( '' != $sc_atts['style']){
	$return .= ' style="';
	$return .= ( '' != $sc_atts['style'] ) ? ' ' . esc_attr( $sc_atts['style'] ) : '';
	$return .= '"';
}

// TOOLTIP
$return .= ( '' != $sc_atts['tooltip'] ) ? ' data-type="tooltip" title="' . esc_attr( $sc_atts['tooltip'] ) . '"' : ''  ;

$return .= '>';

// CONTENT

ob_start();
$format = get_post_format( get_the_ID() );
if( false === $format ) { $format = 'standard'; }

switch ( $format ){
	case 'audio':
		if ( function_exists( 'ishfreelotheme_the_post_audio') ){
			ishfreelotheme_the_post_audio( get_the_ID(), '', '', '', false, false );
		}
		break;
	case 'video':
		if ( function_exists( 'ishfreelotheme_the_post_video') ){
			ishfreelotheme_the_post_video( get_the_ID(), '', '', '', false, false );
		}
		break;
	case 'link':
		if ( function_exists( 'ishfreelotheme_get_post_format_url') ){
		?>
			<h2><a href="<?php echo esc_attr( ishfreelotheme_get_post_format_url() ); ?>" target="_blank"><i class="ish-icon-link"></i><?php echo ishfreelotheme_get_post_format_url_text(); ?></a></h2>
		<?php
		}
		break;
	case 'quote':
		// Get Quote
		if ( function_exists( 'ishfreelotheme_get_post_format_quote') ){
			$quote = ishfreelotheme_get_post_format_quote();
			if ( '' != $quote ){
				echo '<blockquote class="ish-sc-element ish-sc_quote ish-h2">' . $quote;

				// Get Quote source
				$quote_source = ishfreelotheme_get_post_format_quote_source();
				if ('' != $quote_source){

					// Get Quote URL
					$quote_url = ishfreelotheme_get_post_format_url();
					if ('' != $quote_url){

						echo '<cite><a href="' . $quote_url . '" target="_blank">' . $quote_source . '</a></cite>';

					}
					else{

						echo '<cite>', $quote_source, '</cite>';

					}

				}

				echo '</blockquote>';
			}
		}
		break;
	default :
		if ( has_post_thumbnail() ){
			echo '';
			echo '<div class="ish-main-post-image">';

			$img_details = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
			echo '<a href="' . esc_attr( $img_details[0] ) . '" target="_blank">';

			echo get_the_post_thumbnail( get_the_ID(), 'theme-large');
			echo '</a>';
			echo '</div>';
		}
}
$content = ob_get_contents();
ob_end_clean();

$return .= $content;

// SHORTCODE END
$return .= '</div>';

echo apply_filters( 'ishfreelotheme_sc_template_output', $return);