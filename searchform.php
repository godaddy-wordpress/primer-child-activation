<?php
/**
 * The search form for our theme.
 *
 * This is the search form that is displayed in the header/nav area of the theme.
 *
 * @package Activation
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_attr( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'activation' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search', 'activation' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php esc_attr_e( 'Search for:', 'activation' ); ?>" />
	</label>
	<input type="submit" class="search-submit" value="<?php esc_attr_e( 'Search', 'activation' ); ?>" />
</form>
