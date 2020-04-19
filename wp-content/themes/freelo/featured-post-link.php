<?php

// TITLE OR TAGLINES & SUB-TAGLINES
$title = '';

// TITLE OR TAGLINES & SUB-TAGLINES
$title = '';
$display_taglines = IshYoMetaBox::get( 'use_taglines', true, $id );
if ( 'true' == $display_taglines ) {
	$tagline_1 = esc_html( IshYoMetaBox::get( 'tagline_1', true, get_the_ID() ) );

	if ( !empty( $tagline_1 ) ){ $title .= '<h1 data-firstletter="' . $tagline_1[0] . '"><a href="' .get_permalink( $id ) . '">' . $tagline_1 . '</a></h1>'; }
}
else{
	$page_title = get_the_title();
	if ( ! empty( $page_title ) ) {
		$title .= '<h1 data-firstletter="' . $page_title[0] . '"><a href="' . get_permalink( $id ) . '">' . $page_title . '</a></h1>';
	}
}

// TITLE
echo apply_filters( 'ishfreelotheme_post_title_output', $title );