<?php
/**
 *
 * Add child and parent theme files.
 *
 */
function activation_theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
}
add_action( 'wp_enqueue_scripts', 'activation_theme_enqueue_styles' );

/**
 *
 * Register Footer Menu.
 *
 */
function activation_theme_register_nav_menu() {
	 register_nav_menu( 'footer', __( 'Footer Menu', 'activation' ) );
}
add_action( 'after_setup_theme', 'activation_theme_register_nav_menu' );

/**
 *
 * Register Hero Widget.
 *
 */
register_sidebar(
	array(
		'name'          => esc_html__( 'Hero', 'activation' ),
		'id'            => 'hero',
		'description'   => esc_html__( 'The Hero widget area.', 'primer' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	)
);

/**
 *
 * Adding content to footer via action.
 *
 */
function activation_theme_footer_content() {
	return;
}
add_action( 'primer_footer', 'activation_theme_footer_content' );

/**
 * Returns the featured image, custom header or false in this priority order.
 *
 * @return false|string
 */
function primer_get_custom_header() {
	$post_id = get_queried_object_id();
	$image_size = (int) get_theme_mod( 'full_width' ) === 1 ? 'hero-2x' : 'hero';
	if ( has_post_thumbnail( $post_id ) ) {
		$image = get_the_post_thumbnail_url( $post_id, $image_size );
		if ( getimagesize( $image ) ) {
			return $image;
		}
	}
	$custom_header = get_custom_header();
	if ( ! empty( $custom_header->attachment_id ) ) {
		$image = wp_get_attachment_image_url( $custom_header->attachment_id, $image_size );
		if ( getimagesize( $image ) ) {
			return $image;
		}
	}
	$header_image = get_header_image();
	return $header_image;
}

/**
 *
 * Adding hero content to theme header.
 *
 */
function activation_theme_hero_content() {
?>
<div class="hero-wrapper<?php if ( is_front_page() && is_active_sidebar( 'hero' ) ) : ?> home<?php endif; ?>">
	<div class="hero-inner">
		<?php if ( is_front_page() && is_active_sidebar( 'hero' ) ) : ?>
			<?php dynamic_sidebar( 'hero' ); ?>
		<?php elseif ( is_page() && is_page_template( 'page-no-header.php' ) ) : ?>
			<?php get_template_part( 'templates/parts/loop/page-title-none' ); ?>
		<?php elseif ( is_page() ) : ?>
			<?php get_template_part( 'templates/parts/loop/page-title' ); ?>
		<?php elseif ( is_search() ) : ?>
			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'activation' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->
		<?php elseif ( get_post_type() == 'post' ) : ?>
			<h1><?php esc_html_e( 'Blog', 'activation' ); ?></h1>
		<?php endif; ?>
	</div>
</div>
<?php }
add_action( 'primer_header', 'activation_theme_hero_content' );

/**
 * Display the footer nav before the site info.
 *
 * @action primer_after_footer
 *
 * @since 1.0.0
 */
function activation_add_nav_footer() {

	get_template_part( 'templates/parts/footer-nav' );

}
add_action( 'primer_after_footer', 'activation_add_nav_footer', 10 );

/**
 *
 * Add selectors for font customizing.
 *
 * @since 1.0.0
 */
function update_font_types() {
	return	array(
		array(
			'name'    => 'primary_font',
			'label'   => __( 'Primary Font', 'primer' ),
			'default' => 'Lato',
			'css'     => array(
				'body, p, .hero-wrapper .textwidget p, .site-description, .search-form input[type="search”], .widget li a, .site-info-text, h6, body p, .widget p, ' => array(
					'font-family' => '"%s", sans-serif',
				),
			),
		),
		array(
			'name'    => 'secondary_font',
			'label'   => __( 'Secondary Font', 'primer' ),
			'default' => 'Lato',
			'css'     => array(
				'h1, h2, h3, h4, h5, h6, label, legend, table th, .site-title, .entry-title, .widget-title, .main-navigation li a, button, a.button, input[type="button"], input[type="reset"], input[type="submit"], blockquote, .entry-meta, .entry-footer, .comment-list li .comment-meta .says, .comment-list li .comment-metadata, .comment-reply-link, #respond .logged-in-as, .fl-callout-text, .site-title, .hero-wrapper .textwidget h1, .hero-wrapper .textwidget .button, .main-navigation li a, .widget-title, .footer-nav ul li a, h1, h2, h3, h4, h5, .entry-title, .single .entry-meta, ' => array(
					'font-family' => '"%s", sans-serif',
				),
			),
		),
	);
}
add_action( 'primer_font_types', 'update_font_types' );

/**
 * Update colors
 *
 * @action primer_colors
 */
function activation_colors() {
	return array(
				array(
					'name'    => 'header_textcolor',
					'default' => '#fff',
					'css'     => array(
						'.side-masthead .site-description, .hero-widget, header .main-navigation-container .menu li a, .main-navigation-container .menu li.current-menu-item > a, .main-navigation-container .menu li.current-menu-item > a:hover, .side-masthead .site-title a, .side-masthead .site-title a:hover, .hero-widget h2.widget-title' => array(
							'color' => '%1$s',
						),
					),
				),
				array(
					'name'    => 'background_color',
					'default' => '#fff',
				),
				array(
					'name'    => 'header_backgroundcolor',
					'label'   => __( 'Header Background Color', 'primer' ),
					'default' => '#d24343',
					'css'     => array(
						'.side-masthead, header .main-navigation-container .menu li.menu-item-has-children:hover > ul' => array(
							'background-color' => '%1$s',
						),
					),
				),
				array(
					'name'    => 'link_color',
					'label'   => __( 'Link Color', 'primer' ),
					'default' => '#3fba73',
					'css'     => array(
						'a, a:visited, .entry-footer a, .sticky .entry-title a:before' => array(
							'color' => '%1$s',
						),
					),
					'rgba_css' => array(
						'a:hover, a:visited:hover, .entry-footer a:hover' => array(
							'color' => 'rgba(%1$s, 0.75)',
						),
						'button:hover, a.button:hover, a.button:visited:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .site-info-wrapper:hover .site-info:hover .social-menu a:hover' => array(
							'background-color' => 'rgba(%1$s, 0.75)',
						),
					),
				),
				array(
					'name'    => 'main_text_color',
					'label'   => __( 'Main Text Color', 'primer' ),
					'default' => '#212121',
					'css'     => array(
						'.site-content, .site-content h1, .site-content h2, .site-content h3, .site-content h4, .site-content h5, .site-content h6, .site-content p, .site-content blockquote, legend' => array(
							'color' => '%1$s',
						),
					),
				),
				array(
					'name'    => 'secondary_text_color',
					'label'   => __( 'Secondary Text Color', 'primer' ),
					'default' => '#999999',
					'css'     => array(
						'.side-masthead .social-menu a, .entry-meta li, .side-masthead .social-menu a:hover' => array(
							'color' => '%1$s',
						),
					),
				),
				array(
					'name'    => 'button_color',
					'label'   => __( 'Button Color', 'primer' ),
					'default' => '#3fba73',
					'css'     => array(
						'.cta, button, a.button, a.button:visited, input[type="button"], input[type="reset"], input[type="submit"], .fl-button' => array(
							'background-color' => '%1$s',
						),
					),
				),
				array(
					'name'    => 'w_text_color',
					'label'   => __( 'Widget Text Color', 'primer' ),
					'default' => '#c5c3c6',
					'css'     => array(
						'.footer-widget-area, .footer-widget .widget-title, .site-footer, .footer-widget-area .footer-widget .widget, .footer-widget-area .footer-widget .widget-title' => array(
							'color' => '%1$s',
						),
					),
				),
				array(
					'name'    => 'w_background_color',
					'label'   => __( 'Widget Background Color', 'primer' ),
					'default' => '#353535',
					'css'     => array(
						'.site-footer' => array(
							'background-color' => '%1$s',
						),
					),
				),
				array(
					'name'    => 'footer_textcolor',
					'label'   => __( 'Footer Text Color', 'primer' ),
					'default' => '#fff',
					'css'     => array(
						'.site-info-wrapper a, .site-info .social-menu a' => array(
							'color' => '%1$s',
						),
					),
				),
				array(
					'name'    => 'footer_backgroundcolor',
					'label'   => __( 'Footer Background Color', 'primer' ),
					'default' => '#212121',
					'css'     => array(
						'.site-info-wrapper' => array(
							'background-color' => '%1$s',
						),
					),
				),
			);
}
add_action( 'primer_colors', 'activation_colors', 30 );

add_filter( 'primer_default_layout', 'one-column-wide' );

/**
 *
 * Add custom color schemes for Activation theme.
 *
 */
function activation_color_schemes() {
	return array(
		'default' => array(
			'label'  => esc_html__( 'Default', 'activation' ),
			'colors' => array(
				'header_textcolor'         => '#ffffff',
				'header_backgroundcolor'   => '#00b0f1',
				'background_color'         => '#ffffff',
				'link_color'               => '#97d321',
				'main_text_color'          => '#202223',
				'secondary_text_color'     => '#ffffff',
				'button_color'			   => '#97d321',
				'w_text_color'			   => '#c5c3c6',
				'w_background_color'	   => '#353535',
				'footer_textcolor'		   => '#ffffff',
				'footer_backgroundcolor'   => '#212121',

			),
		),
		'blue' => array(
			'label'  => esc_html__( 'Blue', 'activation' ),
			'colors' => array(
				'header_textcolor'         => '#ffffff',
				'header_backgroundcolor'   => '#d24343',
				'background_color'         => '#ffffff',
				'link_color'               => '#3fba73',
				'main_text_color'          => '#202223',
				'secondary_text_color'     => '#ffffff',
				'button_color'			   => '#3fba73',
				'w_text_color'			   => '#5c6d7c',
				'w_background_color'	   => '#303d4c',
				'footer_textcolor'		   => '#ffffff',
				'footer_backgroundcolor'   => '#2c3845',

			),
		),
	);
}
add_filter( 'primer_color_schemes', 'activation_color_schemes' );
