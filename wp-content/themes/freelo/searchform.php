<form role="search" method="get" id="searchform" action="<?php echo esc_url( apply_filters( 'ishfreelotheme_searchform_url', home_url( '/' ) ) ); ?>">
	<div>
        <label class="screen-reader-text" for="s"><?php esc_html_e( 'Search for:', 'freelo' ); ?></label>
        <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php esc_html_e( 'Search...', 'freelo' ); ?>">
        <input type="submit" id="searchsubmit" value="9">
	</div>
</form>
