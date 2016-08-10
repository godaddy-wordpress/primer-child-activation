<?php

/**
 * Move titles above menu templates.
 *
 * @package activation
 * @since 1.0.0
 */
function activation_remove_titles() {

	remove_action( 'primer_after_header', 'primer_add_page_builder_template_title', 100 );
	remove_action( 'primer_after_header', 'primer_add_blog_title', 100 );
	remove_action( 'primer_after_header', 'primer_add_archive_title', 100 );

	if ( ! is_front_page() ) {

		add_action( 'primer_header', 'primer_add_page_builder_template_title' );
		add_action( 'primer_header', 'primer_add_blog_title' );
		add_action( 'primer_header', 'primer_add_archive_title' );

	}

}
add_action( 'init', 'activation_remove_titles', 5 );

/**
 * Add child and parent theme files.
 *
 * @package activation
 * @since 1.0.0
 */
function activation_theme_enqueue_styles() {

	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

	wp_enqueue_script( 'primer-navigation' );

}
add_action( 'wp_enqueue_scripts', 'activation_theme_enqueue_styles' );

/**
 * Register Footer Menu.
 *
 * @package activation
 * @since   1.0.0
 *
 * @param $menu
 */
function activation_register_nav_menu( $menu ) {

	$menu[ 'footer' ] = esc_attr__( 'Footer Menu', 'activation' );

	return $menu;

}
add_filter( 'primer_nav_menus', 'activation_register_nav_menu' );

/**
 * Register sidebar areas.
 *
 * @link    http://codex.wordpress.org/Function_Reference/register_sidebar
 *
 * @package activation
 * @since   1.0.0
 *
 * @param array $sidebars
 *
 * @return array
 */
function activation_register_sidebars( $sidebars ) {

	/**
	 * Register Hero Widget.
	 */
	$sidebars[] = array(
		'name'          => esc_attr__( 'Hero', 'activation' ),
		'id'            => 'hero',
		'description'   => esc_attr__( 'The Hero widget area.', 'activation' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	);

	return $sidebars;

}
add_filter( 'primer_sidebars', 'activation_register_sidebars' );

/**
 * Display the footer nav before the site info.
 *
 * @package activation
 * @since  1.0.0
 */
function activation_add_nav_footer() {

	get_template_part( 'templates/parts/footer-nav' );

}
add_action( 'primer_after_footer', 'activation_add_nav_footer', 10 );

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
				'h1, h2, h3, h4, h5, h6, label, legend, table th, .site-title, .entry-title, .widget-title, .main-navigation li a, button, a.button, input[type="button"], input[type="reset"], input[type="submit"], blockquote, .entry-meta, .entry-footer, .comment-list li .comment-meta .says, .comment-list li .comment-metadata, .comment-reply-link, #respond .logged-in-as, .fl-callout-text, .site-title, .hero-wrapper .textwidget h1, .hero-wrapper .textwidget .button, .main-navigation li a, .widget-title, .footer-nav ul li a, h1, h2, h3, h4, h5, .entry-title, .single .entry-meta, ' => array(
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
				'.site-info-wrapper, .footer-nav, .site-info-wrapper' => array(
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

/**
 * Add default header image.
 *
 * @package activation
 * @since   1.0.0
 *
 * @param $array
 *
 * @return array
 */
function activation_set_default_header_image( $array ) {

	$array['default-image'] = get_stylesheet_directory_uri() . '/assets/img/header.png';

	return $array;

}
add_filter( 'primer_custom_header_args', 'activation_set_default_header_image', 20 );
