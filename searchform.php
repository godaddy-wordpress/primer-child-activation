<?php
/**
 * The search form for our theme.
 *
 * This is the search form that is displayed in the header/nav area of the theme.
 *
 * @package Activation
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'activation' ) ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'activation' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'activation' ) ?>" />
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'activation' ) ?>" />
</form>