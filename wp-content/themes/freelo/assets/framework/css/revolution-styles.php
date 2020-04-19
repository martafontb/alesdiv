<?php

// ISH-TODO: zistit na co nam toto je !!!

global $ishfreelotheme_options;

echo '<style type="text/css">';

$c1 = ( isset( $ishfreelotheme_options['color1'] ) && '' != $ishfreelotheme_options['color1'] ) ? $ishfreelotheme_options['color1'] : ISHFREELOTHEME_COLOR_1;
$c2 = ( isset( $ishfreelotheme_options['color2'] ) && '' != $ishfreelotheme_options['color2'] ) ? $ishfreelotheme_options['color2'] : ISHFREELOTHEME_COLOR_2;
$c3 = ( isset( $ishfreelotheme_options['color3'] ) && '' != $ishfreelotheme_options['color3'] ) ? $ishfreelotheme_options['color3'] : ISHFREELOTHEME_COLOR_3;
$c4 = ( isset( $ishfreelotheme_options['color4'] ) && '' != $ishfreelotheme_options['color4'] ) ? $ishfreelotheme_options['color4'] : ISHFREELOTHEME_COLOR_4;

$c_text = ( isset( $ishfreelotheme_options['text_color'] ) && '' != $ishfreelotheme_options['text_color'] ) ? $ishfreelotheme_options['text_color'] : ISHFREELOTHEME_TEXT_COLOR;
$c_body = ( isset( $ishfreelotheme_options['body_color'] ) && '' != $ishfreelotheme_options['body_color'] ) ? $ishfreelotheme_options['body_color'] : ISHFREELOTHEME_BODY_COLOR;
$c_background = ( isset( $ishfreelotheme_options['background_color'] ) && '' != $ishfreelotheme_options['background_color'] ) ? $ishfreelotheme_options['background_color'] : ISHFREELOTHEME_BACKGROUND_COLOR;

$c1_rgb = ishfreelotheme_hex2rgb($c1);
$c2_rgb = ishfreelotheme_hex2rgb($c2);
$c3_rgb = ishfreelotheme_hex2rgb($c3);
$c4_rgb = ishfreelotheme_hex2rgb($c4);

$c_text_rgb = ishfreelotheme_hex2rgb($c_text);

global $ishfreelotheme_fonts;

// FONT SETTINGS
ishfreelotheme_load_font_settings('body_font', $ishfreelotheme_options);
ishfreelotheme_load_font_settings('body_font_2', $ishfreelotheme_options);
ishfreelotheme_load_font_settings('header_font', $ishfreelotheme_options);
ishfreelotheme_load_font_settings('h1_font', $ishfreelotheme_options);
ishfreelotheme_load_font_settings('h2_font', $ishfreelotheme_options);
ishfreelotheme_load_font_settings('h3_font', $ishfreelotheme_options);
ishfreelotheme_load_font_settings('h4_font', $ishfreelotheme_options);
ishfreelotheme_load_font_settings('h5_font', $ishfreelotheme_options);
ishfreelotheme_load_font_settings('h6_font', $ishfreelotheme_options);


foreach ( $ishfreelotheme_fonts as $key => $val){

    switch ( $val['variant'] ){
        case '100' :
            $ishfreelotheme_fonts[$key]['variant'] = '100';
            $ishfreelotheme_fonts[$key]['font-style'] = 'normal';
            break;
        case '100italic' :
            $ishfreelotheme_fonts[$key]['variant'] = '100';
            $ishfreelotheme_fonts[$key]['font-style'] = 'italic';
            break;
        case '200' :
            $ishfreelotheme_fonts[$key]['variant'] = '200';
            $ishfreelotheme_fonts[$key]['font-style'] = 'normal';
            break;
        case '200italic' :
            $ishfreelotheme_fonts[$key]['variant'] = '200';
            $ishfreelotheme_fonts[$key]['font-style'] = 'italic';
            break;
        case '300' :
            $ishfreelotheme_fonts[$key]['variant'] = '300';
            $ishfreelotheme_fonts[$key]['font-style'] = 'normal';
            break;
        case '300italic' :
            $ishfreelotheme_fonts[$key]['variant'] = '300';
            $ishfreelotheme_fonts[$key]['font-style'] = 'italic';
            break;
        case 'regular' :
            $ishfreelotheme_fonts[$key]['variant'] = '400';
            $ishfreelotheme_fonts[$key]['font-style'] = 'normal';
            break;
        case 'italic' :
            $ishfreelotheme_fonts[$key]['variant'] = '400';
            $ishfreelotheme_fonts[$key]['font-style'] = 'italic';
            break;
        case '500' :
            $ishfreelotheme_fonts[$key]['variant'] = '500';
            $ishfreelotheme_fonts[$key]['font-style'] = 'normal';
            break;
        case '500italic' :
            $ishfreelotheme_fonts[$key]['variant'] = '500';
            $ishfreelotheme_fonts[$key]['font-style'] = 'italic';
            break;
        case '600' :
            $ishfreelotheme_fonts[$key]['variant'] = '600';
            $ishfreelotheme_fonts[$key]['font-style'] = 'normal';
            break;
        case '600italic' :
            $ishfreelotheme_fonts[$key]['variant'] = '600';
            $ishfreelotheme_fonts[$key]['font-style'] = 'italic';
            break;
        case '700' :
            $ishfreelotheme_fonts[$key]['variant'] = '700';
            $ishfreelotheme_fonts[$key]['font-style'] = 'normal';
            break;
        case '700italic' :
            $ishfreelotheme_fonts[$key]['variant'] = '700';
            $ishfreelotheme_fonts[$key]['font-style'] = 'italic';
            break;
        case '800' :
            $ishfreelotheme_fonts[$key]['variant'] = '800';
            $ishfreelotheme_fonts[$key]['font-style'] = 'normal';
            break;
        case '800italic' :
            $ishfreelotheme_fonts[$key]['variant'] = '800';
            $ishfreelotheme_fonts[$key]['font-style'] = 'italic';
            break;
        case '900' :
            $ishfreelotheme_fonts[$key]['variant'] = '900';
            $ishfreelotheme_fonts[$key]['font-style'] = 'normal';
            break;
        case '900italic' :
            $ishfreelotheme_fonts[$key]['variant'] = '900';
            $ishfreelotheme_fonts[$key]['font-style'] = 'italic';
            break;
    }
}

$images_path = ISHFREELOTHEME_HTML_URI . '/images';

?>

/* 7.1 Font family ****************************************************************************************************/

/*
* Font Roboto
*/
.tp-caption *{
font-family: <?php echo '' . $ishfreelotheme_fonts['body_font']['name'];  ?>, sans-serif !important;
font-weight: <?php echo '' . $ishfreelotheme_fonts['body_font']['variant']; ?>;
}

/*
* Headlines
*/
.tp-caption h1, .tp-caption .h1, .tp-caption[class*="<?php echo ISHFREELOTHEME_THEME_SLUG; ?>_big_"] {
font-family: <?php echo '' . $ishfreelotheme_fonts['h1_font']['name'];  ?>, sans-serif !important;
font-size: <?php echo '' . $ishfreelotheme_fonts['h1_font']['size'];  ?>px;
font-weight: <?php echo '' . $ishfreelotheme_fonts['h1_font']['variant'];  ?>;
font-style: <?php echo '' . $ishfreelotheme_fonts['h1_font']['font-style'];  ?>;
letter-spacing: -1px;
line-height: <?php echo '' . $ishfreelotheme_fonts['h1_font']['line_height'];  ?>px;
}

.tp-caption h2, .tp-caption .h2,  .tp-caption[class*="<?php echo ISHFREELOTHEME_THEME_SLUG; ?>_medium_"] {
font-family: <?php echo '' . $ishfreelotheme_fonts['h2_font']['name'];  ?>, sans-serif !important;
font-size: <?php echo '' . $ishfreelotheme_fonts['h2_font']['size'];  ?>px;
font-weight: <?php echo '' . $ishfreelotheme_fonts['h2_font']['variant'];  ?>;
font-style: <?php echo '' . $ishfreelotheme_fonts['h2_font']['font-style'];  ?>;
letter-spacing: -1px;
line-height: <?php echo '' . $ishfreelotheme_fonts['h2_font']['line_height'];  ?>px;
}

.tp-caption h3, .tp-caption .h3,  .tp-caption[class*="<?php echo ISHFREELOTHEME_THEME_SLUG; ?>_small_"] {
font-family: <?php echo '' . $ishfreelotheme_fonts['h3_font']['name'];  ?>, sans-serif !important;
font-size: <?php echo '' . $ishfreelotheme_fonts['h3_font']['size'];  ?>px;
font-weight: <?php echo '' . $ishfreelotheme_fonts['h3_font']['variant'];  ?>;
font-style: <?php echo '' . $ishfreelotheme_fonts['h3_font']['font-style'];  ?>;
letter-spacing: -1px;
line-height: <?php echo '' . $ishfreelotheme_fonts['h3_font']['line_height'];  ?>px;
}

.tp-caption h4, .tp-caption .h4 {
font-family: <?php echo '' . $ishfreelotheme_fonts['h4_font']['name'];  ?>, sans-serif !important;
font-size: <?php echo '' . $ishfreelotheme_fonts['h4_font']['size'];  ?>px;
font-weight: <?php echo '' . $ishfreelotheme_fonts['h4_font']['variant'];  ?>;
font-style: <?php echo '' . $ishfreelotheme_fonts['h4_font']['font-style'];  ?>;
line-height: <?php echo '' . $ishfreelotheme_fonts['h4_font']['line_height'];  ?>px;
}

.tp-caption h5, .tp-caption .h5 {
font-family: <?php echo '' . $ishfreelotheme_fonts['h5_font']['name'];  ?>, sans-serif !important;
font-size: <?php echo '' . $ishfreelotheme_fonts['h5_font']['size'];  ?>px;
font-weight: <?php echo '' . $ishfreelotheme_fonts['h5_font']['variant'];  ?>;
font-style: <?php echo '' . $ishfreelotheme_fonts['h5_font']['font-style'];  ?>;
line-height: <?php echo '' . $ishfreelotheme_fonts['h5_font']['line_height'];  ?>px;
}

.tp-caption h6, .tp-caption .h6 {
font-family: <?php echo '' . $ishfreelotheme_fonts['h6_font']['name'];  ?>, sans-serif !important;
font-size: <?php echo '' . $ishfreelotheme_fonts['h6_font']['size'];  ?>px;
font-weight: <?php echo '' . $ishfreelotheme_fonts['h6_font']['variant'];  ?>;
font-style: <?php echo '' . $ishfreelotheme_fonts['h6_font']['font-style'];  ?>;
line-height: <?php echo '' . $ishfreelotheme_fonts['h6_font']['line_height'];  ?>px;
}

.tp-caption[class*="with_bg"]{
    padding: 5px 10px;
}

/*
* 1.
*/
.tp-caption h1.color1, .tp-caption h2.color1, .tp-caption h3.color1, .tp-caption h4.color1, .tp-caption h5.color1, .tp-caption h6.color1,
.tp-caption .h1.color1, .tp-caption .h2.color1, .tp-caption .h3.color1, .tp-caption .h4.color1, .tp-caption .h5.color1, .tp-caption .h6.color1,
.tp-caption[class*="_color1"]{
    color: <?php echo '' . $c1; ?>;
}

.tp-caption[class*="color1_with_bg"]{
    background: <?php echo '' . $c1; ?>;
    background: rgba(<?php echo '' . $c1_rgb; ?>, 0.95);
}

/*
* 2.
*/
.tp-caption h1.color2, .tp-caption h2.color2, .tp-caption h3.color2, .tp-caption h4.color2, .tp-caption h5.color2, .tp-caption h6.color2,
.tp-caption .h1.color2, .tp-caption .h2.color2, .tp-caption .h3.color2, .tp-caption .h4.color2, .tp-caption .h5.color2, .tp-caption .h6.color2,
.tp-caption[class*="_color2"]{
    color: <?php echo '' . $c_text; ?>;
}

.tp-caption[class*="color3_with_bg"], .tp-caption[class*="color4_with_bg"]{
    color: <?php echo '' . $c_text; ?>!important;
}

.tp-caption[class*="color2_with_bg"]{
    background: <?php echo '' . $c2; ?>;
    background: rgba(<?php echo '' . $c2_rgb; ?>, 0.95);
}

/*
* 3.
*/
.tp-caption h1.color3, .tp-caption h2.color3, .tp-caption h3.color3, .tp-caption h4.color3, .tp-caption h5.color3, .tp-caption h6.color3,
.tp-caption .h1.color3, .tp-caption .h2.color3, .tp-caption .h3.color3, .tp-caption .h4.color3, .tp-caption .h5.color3, .tp-caption .h6.color3,
.tp-caption[class*="_color3"]{
    color: <?php echo '' . $c3; ?>;
}

.tp-caption[class*="color3_with_bg"]{
    background: <?php echo '' . $c3; ?>;
    background: rgba(<?php echo '' . $c3_rgb; ?>, 0.95);
}

/*
* 4.
*/
.tp-caption h1.color4, .tp-caption h2.color4, .tp-caption h3.color4, .tp-caption h4.color4, .tp-caption h5.color4, .tp-caption h6.color4,
.tp-caption .h1.color4, .tp-caption .h2.color4, .tp-caption .h3.color4, .tp-caption .h4.color4, .tp-caption .h5.color4, .tp-caption .h6.color4,
.tp-caption[class*="_color4"], .tp-caption[class*="color1_with_bg"], .tp-caption[class*="color2_with_bg"]{
    color: <?php echo '' . $c4; ?>;
}

.tp-caption[class*="color4_with_bg"]{
    background: <?php echo '' . $c4; ?>;
    background: rgba(<?php echo '' . $c4_rgb; ?>, 0.95);
}

<?php echo '</style>'; ?>