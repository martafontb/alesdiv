<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to ishfreelotheme_comments() which is
 * located in the functions.php file.
 *
 */

// ##########  Do not delete these lines
if ( isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ('Please do not load this page directly. Thanks!');
}

if ( have_comments() || comments_open() ) {
	echo '<div class="wpb_row vc_row-fluid ish-row-notfull ish-row_notsection ish-blog-comments-container"><div class="ish-vc_row_inner">';
}

if ( have_comments() && post_password_required() ) { ?>

	<div class="ish-sc_separator ish-separator-text ish-separator-double ish-h6" id="comments">
		<span class="ish-line ish-left"><span class="ish-line-border"></span></span>
	</div>

	<h4 class="ish-comments-headline"><?php echo esc_html__( 'Comments', 'freelo' ); ?></h4>

	<div class="ish-sc-element ish-sc_divider"></div>

    <p class="nocomments"><?php esc_html_e( 'This post is password protected. Enter the password to view comments.', 'freelo' ); ?></p>
<?php

	if ( have_comments() || comments_open() ) {
		echo '</div></div>';
	}

    return;
}
// ##########  End do not delete section

// Display Comments Section
if ( have_comments() ) { ?>
	<div class="ish-sc_separator ish-separator-text ish-separator-double ish-h6" id="comments">
		<span class="ish-line ish-left"><span class="ish-line-border"></span></span>
		<!--<span class="ish-text">
			<?php /*comments_number( esc_html__( 'Comments (0)', 'freelo' ), esc_html__( 'Comments (1)', 'freelo' ), esc_html__( 'Comments (%)', 'freelo' ) ); */?>
		</span>
		<span class="ish-line ish-right"></span>-->
	</div>

	<h4 class="ish-comments-headline"><?php comments_number( esc_html__( 'Comments (0)', 'freelo' ), esc_html__( 'Comments (1)', 'freelo' ), esc_html__( 'Comments (%)', 'freelo' ) ); ?></h4>

    <ul class="ish-comments">
        <?php
        wp_list_comments(array(
            // see http://codex.wordpress.org/Function_Reference/wp_list_comments
            'login_text'        => 'Login to reply',
            'callback'          => 'ishfreelotheme_comments',
            'type'              => 'comment'
        ));
        ?>
    </ul>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        <?php
        echo '<div class="ish-pagination">';
		$pagin = paginate_comments_links(array(
            //'base'         => '%_%',
            //'format'       => '?page=%#%',
            //'total'        => 1,
            //'current'      => 0,
            'show_all'     => False,
            'end_size'     => 1,
            'mid_size'     => 2,
            'prev_next'    => True,
            'prev_text'    => '&laquo;',
            'next_text'    => '&raquo;',
            'type'         => 'plain',
            'add_args'     => False,
            'add_fragment' => '',
            'echo' => false,
        ));
		// $pagin = str_replace( 'page-numbers', 'page-numbers ish-sc_button ish-text-color1 ish-color3', $pagin );
		// $pagin = str_replace( 'ish-text-color1 ish-color3 current', 'ish-text-color4 ish-color5 current', $pagin );
		$pagin = str_replace(array("\r\n", "\n", "\r"), '', $pagin);
        echo apply_filters( 'ishfreelotheme_comments_pagination_output', $pagin );
        echo '</div>';
        ?>
    <?php endif; // check for comment navigation ?>

    <?php
        if ( ! comments_open() ) : // There are comments but comments are now closed
            echo'<p class="nocomments">' . esc_html__( 'Comments are closed.' , 'freelo' ) . '</p><div class="space"></div>';

        endif;
    ?>

<?php } else { // I.E. There are no Comments

}?>

<?php if ( comments_open() ) : ?>
    <div class="ish-comments-form">
        <?php

        $commenter = wp_get_current_commenter();
        $req      = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );

        comment_form( array(
            'fields'               => apply_filters( 'comment_form_default_fields', array(
                    'author' => '<p><label><input type="text" placeholder="' . esc_html__( 'Your name', 'freelo' ) . ( $req ? ' *' : '' ) . '" class="' . ( $req ? 'required' : '' ) . '" name="author" id="author" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req .'></label></p>',
                    'email'  => '<p><label><input type="text" placeholder="' . esc_html__( 'Your email', 'freelo' ) . ( $req ? ' *' : '' ) . '" class="email' . ( $req ? ' required' : '' ) . '" name="email" id="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . '></label></p>',
                    'url'    => '<p><label><input type="text" placeholder="' . esc_html__( 'Your web page', 'freelo' ) . '" name="url" id="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '"></label></p>'
                )

            ),
            'comment_field'        => '<p><label for="comment"><textarea class="required" placeholder="' . esc_html__( 'Your comment', 'freelo' ) . ' *' . '" name="comment" id="comment" aria-required="true"></textarea></label></p>',
            'comment_notes_before' => '',
            'comment_notes_after'  => '',
            //'comment_notes_after'  => '</div><p class="form-allowed-tags">' . sprintf( esc_html__( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
            'submit_button_before' => '<p>',
            'submit_button_after'  => '</p>',
            'id_form'              => 'commentform',
            'id_submit'            => 'submit',
            'class_form'           => 'validate clearfix',
            'class_submit'         => 'btn-big',
            'title_reply'          => '<div class="ish-sc_separator ish-separator-text ish-separator-double ish-h6 ish-add-comment-headline" id="respond"><span class="ish-line ish-left"><span class="ish-line-border"></span></span></div><h4 class="ish-comments-headline">' . esc_html__( 'Add comment', 'freelo' ) . '</h4>',
            'title_reply_to'       => '<div class="ish-sc_separator ish-separator-text ish-separator-double ish-h6 ish-add-comment-headline" id="respond"><span class="ish-line ish-left"><span class="ish-line-border"></span></span></div><h4 class="ish-comments-headline">' . esc_html__( 'Add a reply', 'freelo' ) . '</h4>',
            'cancel_reply_link'    => esc_html__( 'Cancel a reply', 'freelo' ),
            'label_submit'         => esc_html__( 'Add Comment', 'freelo' )
        ));

        ?>
    </div>

<?php endif;

if ( have_comments() || comments_open() ) {
	echo '</div></div>';
}