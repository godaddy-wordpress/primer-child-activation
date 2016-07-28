<?php
/**
 * The template for displaying no header pages.
 *
 * Template Name: No Header
 *
 * @package Primer
 * @since 1.0.0
 */

get_header() ?>

<div id="primary" class="content-area">

	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post() ?>

			<?php get_template_part( 'content', 'page' ) ?>

			<?php if ( comments_open() || get_comments_number() ) : ?>

				<?php comments_template() ?>

			<?php endif; ?>

		<?php endwhile; ?>

	</main><!-- #main -->

</div><!-- #primary -->

<?php get_sidebar() ?>

<?php get_sidebar( 'tertiary' ) ?>

<?php get_footer() ?>
