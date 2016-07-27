<?php
/**
 * Template part for displaying the post author image.
 *
 * @package Activation
 */
?>

<?php if ( ! empty( get_avatar( get_the_author_meta( 'user_email' ), '100' ) ) ) : ?>

	<div class="author-image">

		<?php echo get_avatar( get_the_author_meta( 'user_email' ), '100' ); ?>

	</div><!-- .featured-image -->

<?php endif; ?>
