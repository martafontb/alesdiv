<form role="search" method="get" id="headersearchform" action="<?php echo esc_url( apply_filters( 'ishfreelotheme_searchform_url', home_url( '/' ) ) ); ?>">
    <label>
        <input type="text" value="<?php the_search_query(); ?>" name="s" id="sh" autocomplete="off" placeholder="<?php esc_html_e( 'Search...', 'freelo' ); ?>">
    </label>
</form>

<a href="#close" class="ish-ps-searchform_close ish-icon-cancel-outline" title="<?php esc_html_e( 'Close Search (ESC)', 'freelo' ); ?>"></a>
