<?php
/**
 * Template part for displaying the page title inside The Loop.
 *
 * @package Primer
 */
?>

<header class="page-header">

	<?php
	/**
	 * Fires before the page title element.
	 *
	 * @since 1.0.0
	 */
	do_action( 'primer_before_page_title' );
	?>

	<?php
	/**
	 * Fires after the page title element.
	 *
	 * @since 1.0.0
	 */
	do_action( 'primer_after_page_title' );
	?>

</header><!-- .entry-header -->
