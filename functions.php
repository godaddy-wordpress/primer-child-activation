<?php

/**
 * Move some elements around.
 *
 * @action template_redirect
 * @since  1.0.0
 */
function activation_move_elements() {

	remove_action( 'primer_after_header', 'primer_add_page_title' );

	add_action( 'primer_site_navigation', 'get_search_form', 11, 0 );

	if ( ! is_front_page() || ! is_active_sidebar( 'hero' ) ) {

		add_action( 'primer_hero', 'primer_add_page_title' );

	}

}
add_action( 'template_redirect', 'activation_move_elements' );

/**
 * Hide site title and description when a custom logo is present.
 *
 * @filter primer_the_site_title
 * @filter primer_the_site_description
 * @since  1.0.0
 *
 * @param  string $html
 *
 * @return string|null
 */
function activation_the_site_title( $html ) {

	return primer_has_custom_logo() ? null : $html;

}
add_filter( 'primer_the_site_title',       'activation_the_site_title' );
add_filter( 'primer_the_site_description', 'activation_the_site_title' );

/**
 * Set fonts.
 *
 * @filter primer_fonts
 * @since  1.0.0
 *
 * @param  array $fonts
 *
 * @return array
 */
function activation_fonts( $fonts ) {

	$fonts[] = 'Lato';

	return $fonts;

}
add_filter( 'primer_fonts', 'activation_fonts' );

/**
 * Set font types.
 *
 * @filter primer_font_types
 * @since  1.0.0
 *
 * @param  array $font_types
 *
 * @return array
 */
function activation_font_types( $font_types ) {

	$overrides = array(
		'site_title_font' => array(
			'default' => 'Lato',
		),
		'navigation_font' => array(
			'default' => 'Lato',
		),
		'heading_font' => array(
			'default' => 'Lato',
		),
		'primary_font' => array(
			'default' => 'Lato',
		),
		'secondary_font' => array(
			'default' => 'Lato',
		),
	);

	return primer_array_replace_recursive( $font_types, $overrides );

}
add_filter( 'primer_font_types', 'activation_font_types' );

/**
 * Set colors.
 *
 * @filter primer_colors
 * @since  1.0.0
 *
 * @param  array $colors
 *
 * @return array
 */
function activation_colors( $colors ) {

	unset(
		$colors['content_background_color'],
		$colors['footer_widget_content_background_color']
	);

	$overrides = array(
		/**
		 * Text colors
		 */
		'menu_text_color' => array(
			'css'      => array(
				'.main-navigation .search-form input[type="search"]' => array(
					'color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'.main-navigation .search-form input[type="search"]' => array(
					'border-color' => 'rgba(%1$s, 0.2)',
				),
			),
		),
		'footer_widget_heading_text_color' => array(
			'default' => '#ffffff',
		),
		'footer_widget_text_color' => array(
			'default' => '#ffffff',
		),
		'footer_menu_text_color' => array(
			'default' => '#7c848c',
		),
		'footer_text_color' => array(
			'default' => '#7c848c',
		),
		/**
		 * Link / Button colors
		 */
		'link_color' => array(
			'default'  => '#cc494f',
		),
		'button_color' => array(
			'default'  => '#cc494f',
		),
		/**
		 * Background colors
		 */
		'background_color' => array(
			'default' => '#ffffff',
		),
		'hero_background_color' => array(
			'default' => '#2c3845',
		),
		'menu_background_color' => array(
			'default' => '#cc494f',
		),
		'footer_widget_background_color' => array(
			'default' => '#303d4c',
		),
		'footer_background_color' => array(
			'default' => '#2c3845',
		),
	);

	return primer_array_replace_recursive( $colors, $overrides );

}
add_filter( 'primer_colors', 'activation_colors' );

/**
 * Set color schemes.
 *
 * @filter primer_color_schemes
 * @since  1.0.0
 *
 * @param  array $color_schemes
 *
 * @return array
 */
function activation_color_schemes( $color_schemes ) {

	unset( $color_schemes['blush'] );

	$overrides = array(
		'bronze' => array(
			'colors' => array(
				'hero_background_color'          => '#2c3845',
				'footer_widget_background_color' => '#303d4c',
			),
		),
		'canary' => array(
			'colors' => array(
				'hero_background_color'          => '#2c3845',
				'footer_widget_background_color' => '#303d4c',
			),
		),
		'cool' => array(
			'colors' => array(
				'hero_background_color'          => '#2c3845',
				'footer_widget_background_color' => '#303d4c',
			),
		),
		'dark' => array(
			'colors' => array(
				'link_color'                     => '#62bf7c',
				'button_color'                   => '#62bf7c',
				'background_color'               => '#2c3845',
				'hero_background_color'          => '#2c3845',
				'menu_background_color'          => '#303d4c',
				'footer_widget_background_color' => '#303d4c',
				'footer_background_color'        => '#2c3845',
			),
		),
		'iguana' => array(
			'colors' => array(
				'hero_background_color'          => '#2c3845',
				'footer_widget_background_color' => '#303d4c',
			),
		),
		'muted' => array(
			'colors' => array(
				'hero_background_color'          => '#2c3845',
				'footer_widget_background_color' => '#5a6175',
			),
		),
		'plum' => array(
			'colors' => array(
				'hero_background_color'          => '#2c3845',
				'footer_widget_background_color' => '#303d4c',
			),
		),
		'rose' => array(
			'colors' => array(
				'hero_background_color'          => '#2c3845',
				'footer_widget_background_color' => '#303d4c',
			),
		),
		'tangerine' => array(
			'colors' => array(
				'hero_background_color'          => '#2c3845',
				'footer_widget_background_color' => '#303d4c',
			),
		),
		'turquoise' => array(
			'colors' => array(
				'hero_background_color'          => '#2c3845',
				'footer_widget_background_color' => '#303d4c',
			),
		),
	);

	return primer_array_replace_recursive( $color_schemes, $overrides );

}
add_filter( 'primer_color_schemes', 'activation_color_schemes' );
