<?php
/**
 * Default sidebar.
 *
 * @package BrillianceJewelry
 */
if ( ! is_active_sidebar( 'shop-sidebar' ) ) {
	return;
}
?>
<aside class="sidebar">
	<?php dynamic_sidebar( 'shop-sidebar' ); ?>
</aside>
