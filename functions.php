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

	if ( ! is_front_page() ) {

		add_action( 'primer_header', 'primer_add_page_title' );

	}

}
add_action( 'template_redirect', 'activation_move_elements' );

/**
 * Set the default hero image description.
 *
 * @filter primer_default_hero_images
 * @since  1.0.0
 *
 * @param  array $defaults
 *
 * @return array
 */
function activation_default_hero_images( $defaults ) {

	$defaults['default']['description'] = esc_html__( 'Woman exercising at the gym', 'activation' );

	return $defaults;

}
add_filter( 'primer_default_hero_images', 'activation_default_hero_images' );

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
		'header_font' => array(
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

	return array(
		'background_color' => array(
			'default' => '#fff',
			'body' => array(
				'background' => '%1$s',
			),
		),
		'header_background_color' => array(
			'label'   => esc_html__( 'Menu Background Color', 'activation' ),
			'default' => '#d24343',
			'css'     => array(
				'.side-masthead, header .main-navigation-container .menu li.menu-item-has-children:hover > ul, .main-navigation-container, .menu-main-menu-container, .main-navigation, .main-navigation .sub-menu' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'link_color' => array(
			'label'   => esc_html__( 'Link Color', 'activation' ),
			'default' => '#3fba73',
			'css'     => array(
				'a, a:visited, .entry-footer a, .sticky .entry-title a:before, .footer-widget-area .footer-widget .widget a' => array(
					'color' => '%1$s',
				),
			),
		),
		'button_color' => array(
			'label'   => esc_html__( 'Button Color', 'activation' ),
			'default' => '#3fba73',
			'css'     => array(
				'button, a.button, a.button:visited, input[type="button"], input[type="reset"], input[type="submit"]:not(.search-submit), a.fl-button' => array(
					'background-color' => '%1$s',
				),
			),
			'rgba_css'     => array(
				'button:hover, a.button:hover, a.button:visited:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:not(.search-submit):hover, a.fl-button:hover' => array(
					'background-color' => 'rgba(%1$s, 0.7)',
				),
			),
		),
		'w_background_color' => array(
			'label'   => esc_html__( 'Widget Background Color', 'activation' ),
			'default' => '#303d4c',
			'css'     => array(
				'.site-footer' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'footer_background_color' => array(
			'label'   => esc_html__( 'Footer Background Color', 'activation' ),
			'default' => '#2c3845',
			'css'     => array(
				'.site-info-wrapper, .footer-menu, .site-info-wrapper' => array(
					'background-color' => '%1$s',
				),
			),
		),
	);

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

	return array(
		'blue_green' => array(
			'label'  => esc_html__( 'Blue and Green', 'activation' ),
			'colors' => array(
				'background_color'        => '#ffffff',
				'header_background_color' => '#00b0f1',
				'link_color'              => '#00b0f1',
				'button_color'            => '#97d321',
				'w_background_color'      => '#353535',
				'footer_background_color' => '#212121',
			),
		),
	);

}
add_filter( 'primer_color_schemes', 'activation_color_schemes' );
