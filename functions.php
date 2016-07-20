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
				'h1, h2, h3, h4, h5, h6, label, legend, table th, .site-title, .entry-title, .widget-title, .main-navigation li a, button, a.button, input[type="button"], input[type="reset"], input[type="submit"], blockquote, .entry-meta, .entry-footer, .comment-list li .comment-meta .says, .comment-list li .comment-metadata, .comment-reply-link, #respond .logged-in-as, .fl-callout-text, .site-title, .hero-wrapper .textwidget h1, .hero-wrapper .textwidget .button, .main-navigation li a, .widget-title, .menu-footer li a, h1, h2, h3, h4, h5, .entry-title, .single .entry-meta, ' => array(
					'font-family' => '"%s", sans-serif',
				),
			),
		),
	);
}
add_action( 'primer_font_types', 'update_font_types' );
