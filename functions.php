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
 * Registers color schemes for primer.
 *
 * Can be filtered with {@see 'primer_color_schemes'}.
 *
 * The order of colors in a colors array:
 * 1. Main Background Color.
 * 2. Page Background Color.
 * 3. Link Color.
 * 4. Main Text Color.
 * 5. Secondary Text Color.
 *
 * @return array An associative array of color scheme options.
 */
function activation_get_color_schemes() {

	/**
	 * Filter the color schemes registered for use with primer.
	 *
	 * The default schemes include 'default', 'dark', 'gray', 'red', and 'yellow'.
	 *
	 * @since 1.0.0
	 *
	 * @var array $schemes {
	 *     Associative array of color schemes data.
	 *
	 *     @type array $slug {
	 *         Associative array of information for setting up the color scheme.
	 *
	 *         @type string $label  Color scheme label.
	 *         @type array  $colors HEX codes for default colors prepended with a hash symbol ('#').
	 *                              Colors are defined in the following order: Main background, page
	 *                              background, link, main text, secondary text.
	 *     }
	 * }
	 */
	return apply_filters( 'primer_color_schemes',
		array(
			'default' => array(
				'label'  => __( 'Default', 'activation' ),
				'colors' => array(
					'#212121',
					'#ffffff',
					'#0060f1',
					'#c5c3c6',
					'#97d321',
					'#212121',
					'#c5c3c6',
				),
			),
			'my_red' => array(
				'label'  => __( 'Red', 'activation' ),
				'colors' => array(
					'#202223',
					'#ffffff',
					'#d24343',
					'#c5c3c6',
					'#3fba73',
					'#202223',
					'#c5c3c6',
				),
			),
		)
	);

}
