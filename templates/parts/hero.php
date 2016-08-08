<?php
/**
 * Template part for displaying the hero area on the front page.
 *
 * @package Activation
 */
?>

<?php if( is_front_page() && is_active_sidebar( 'hero' ) ): ?>

<div class="hero-wrapper home">
	<div class="hero-inner">
		<?php dynamic_sidebar( 'hero' ); ?>
	</div>
</div>

<?php endif; ?>