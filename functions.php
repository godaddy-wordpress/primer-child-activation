<?php

/**
 * Child theme version.
 *
 * @since 1.0.0
 *
 * @var string
 */
define( 'PRIMER_CHILD_VERSION', '1.1.2' );

/**
 * Move some elements around.
 *
 * @action template_redirect
 * @since  1.0.0
 */
function activation_move_elements() {

	remove_action( 'primer_after_header', 'primer_add_page_title', 12 );

	if ( ! is_front_page() || ! is_active_sidebar( 'hero' ) ) {

		add_action( 'primer_hero', 'primer_add_page_title', 12 );

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
 * @param  string $html Markup for the site title and tagline.
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
 * @param  array $fonts The array of available fonts in Primer.
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
 * @param  array $font_types The array of available font types in Primer.
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
 * @param  array $colors The array of available colors in Primer color schemes.
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
		 * Text colors.
		 */
		'header_textcolor' => array(
			'default' => '#ffffff',
		),
		'tagline_text_color' => array(
			'default' => '#ffffff',
		),
		'hero_text_color' => array(
			'default' => '#ffffff',
		),
		'menu_text_color' => array(
			'default' => '#ffffff',
		),
		'heading_text_color' => array(
			'default' => '#353535',
		),
		'primary_text_color' => array(
			'default' => '#252525',
		),
		'secondary_text_color' => array(
			'default' => '#686868',
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
		 * Link / Button colors.
		 */
		'link_color' => array(
			'default' => '#cc494f',
		),
		'button_color' => array(
			'default' => '#39bc72',
		),
		'button_text_color' => array(
			'default' => '#ffffff',
		),
		/**
		 * Background colors.
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
 * @param  array $color_schemes The array of available colors schemes in Primer.
 *
 * @return array
 */
function activation_color_schemes( $color_schemes ) {

	unset( $color_schemes['blush'] );

	$overrides = array(
		'bronze' => array(
			'colors' => array(
				'link_color'            => $color_schemes['bronze']['base'],
				'button_color'          => $color_schemes['bronze']['base'],
				'menu_background_color' => $color_schemes['bronze']['base'],
			),
		),
		'canary' => array(
			'colors' => array(
				'link_color'            => $color_schemes['canary']['base'],
				'button_color'          => $color_schemes['canary']['base'],
				'menu_background_color' => $color_schemes['canary']['base'],
			),
		),
		'cool' => array(
			'colors' => array(
				'link_color'            => $color_schemes['cool']['base'],
				'button_color'          => $color_schemes['cool']['base'],
				'menu_background_color' => $color_schemes['cool']['base'],
			),
		),
		'dark' => array(
			'colors' => array(
				// Text.
				'tagline_text_color'   => '#999999',
				'heading_text_color'   => '#ffffff',
				'primary_text_color'   => '#e5e5e5',
				'secondary_text_color' => '#c1c1c1',
				// Backgrounds.
				'background_color'      => '#2c3845',
				'menu_background_color' => '#303d4c',
			),
		),
		'iguana' => array(
			'colors' => array(
				'link_color'            => $color_schemes['iguana']['base'],
				'button_color'          => $color_schemes['iguana']['base'],
				'menu_background_color' => $color_schemes['iguana']['base'],
			),
		),
		'muted' => array(
			'colors' => array(
				// Text.
				'heading_text_color'     => '#4f5875',
				'primary_text_color'     => '#4f5875',
				'secondary_text_color'   => '#888c99',
				'footer_menu_text_color' => $color_schemes['muted']['base'],
				'footer_text_color'      => '#4f5875',
				// Links & Buttons.
				'link_color'   => $color_schemes['muted']['base'],
				'button_color' => $color_schemes['muted']['base'],
				// Backgrounds.
				'background_color'               => '#d5d6e0',
				'hero_background_color'          => '#5a6175',
				'menu_background_color'          => '#5a6175',
				'footer_widget_background_color' => '#5a6175',
				'footer_background_color'        => '#d5d6e0',
			),
		),
		'plum' => array(
			'colors' => array(
				'link_color'            => $color_schemes['plum']['base'],
				'button_color'          => $color_schemes['plum']['base'],
				'menu_background_color' => $color_schemes['plum']['base'],
			),
		),
		'rose' => array(
			'colors' => array(
				'link_color'            => $color_schemes['rose']['base'],
				'button_color'          => $color_schemes['rose']['base'],
				'menu_background_color' => $color_schemes['rose']['base'],
			),
		),
		'tangerine' => array(
			'colors' => array(
				'link_color'            => $color_schemes['tangerine']['base'],
				'button_color'          => $color_schemes['tangerine']['base'],
				'menu_background_color' => $color_schemes['tangerine']['base'],
			),
		),
		'turquoise' => array(
			'colors' => array(
				'link_color'            => $color_schemes['turquoise']['base'],
				'button_color'          => $color_schemes['turquoise']['base'],
				'menu_background_color' => $color_schemes['turquoise']['base'],
			),
		),
	);

	return primer_array_replace_recursive( $color_schemes, $overrides );

}
add_filter( 'primer_color_schemes', 'activation_color_schemes' );
