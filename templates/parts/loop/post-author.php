<?php
/**
 * Template part for displaying the post author image.
 *
 * @package Activation
 */
?>

<?php

	$avatar = get_avatar( get_the_author_meta( 'user_email' ), '100' );

	if ( ! empty( $avatar ) ) :

?>

	<div class="author-image">

		<?php echo $avatar; ?>

	</div><!-- .featured-image -->

<?php endif; ?>
