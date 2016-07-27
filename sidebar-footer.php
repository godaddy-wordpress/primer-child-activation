<?php
/**
 * The sidebar containing the footer widget area.
 *
 * @package Activation
 */

if ( ! is_active_sidebar( 'sidebar-footer' ) ) {

	return;

}

?>

<div class="widget-area" role="complementary">

	<?php dynamic_sidebar( 'sidebar-footer' ) ?>

</div>
