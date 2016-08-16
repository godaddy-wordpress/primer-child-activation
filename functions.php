<?php

/**
 * Move template elements around.
 *
 * @package activation
 * @since 1.0.0
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
 * Add child and parent theme files.
 *
 * @package activation
 * @since 1.0.0
 */
function activation_theme_enqueue_styles() {

	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}
add_action( 'wp_enqueue_scripts', 'activation_theme_enqueue_styles' );

/**
 * Add selectors for font customizing.
 *
 * @package activation
 * @since 1.0.0
 */
function activation_update_font_types() {

	return array(
		'primary_font' => array(
			'label'   => esc_html__( 'Primary Font', 'activation' ),
			'default' => 'Lato',
			'css'     => array(
				'body, p, .hero-wrapper .textwidget p, .site-description, .search-form input[type="search"], .widget li a, .site-info-text, h6, body p, .widget p, ' => array(
					'font-family' => '"%s", sans-serif',
				),
			),
		),
		'secondary_font' => array(
			'label'   => esc_html__( 'Secondary Font', 'activation' ),
			'default' => 'Lato',
			'css'     => array(
				'h1, h2, h3, h4, h5, h6, label, legend, table th, .site-title, .entry-title, .widget-title, .main-navigation li a, button, a.button, input[type="button"], input[type="reset"], input[type="submit"], blockquote, .entry-meta, .entry-footer, .comment-list li .comment-meta .says, .comment-list li .comment-metadata, .comment-reply-link, #respond .logged-in-as, .fl-callout-text, .site-title, .hero-wrapper .textwidget h1, .hero-wrapper .textwidget .button, .main-navigation li a, .widget-title, .footer-menu ul li a, h1, h2, h3, h4, h5, .entry-title, .single .entry-meta, ' => array(
					'font-family' => '"%s", sans-serif',
				),
			),
		),
	);

}
add_action( 'primer_font_types', 'activation_update_font_types' );

/**
 * Update colors
 *
 * @package activation
 * @since 1.0.0
 */
function activation_colors() {

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
				'.cta, button, a.button, a.button:visited, input[type="button"], input[type="reset"], input[type="submit"]:not(.search-submit), a.fl-button' => array(
					'background-color' => '%1$s',
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
add_action( 'primer_colors', 'activation_colors' );

/**
 * Change Activation color schemes
 *
 * @package activation
 * @since 1.0.0
 *
 * @return array
 */
function activation_color_schemes() {

	return array(
		'blue_green' => array(
			'label'  => esc_html__( 'Blue and Green', 'activation' ),
			'colors' => array(
				'background_color'         => '#ffffff',
				'header_background_color'  => '#00b0f1',
				'link_color'               => '#00B0F1',
				'button_color'			   => '#97d321',
				'w_background_color'	   => '#353535',
				'footer_background_color'  => '#212121',
			),
		),
	);

}
add_action( 'primer_color_schemes', 'activation_color_schemes' );
