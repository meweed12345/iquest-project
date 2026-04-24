<?php
/**
 * Single product template.
 *
 * @package BrillianceJewelry
 */
defined( 'ABSPATH' ) || exit;
get_header( 'shop' );
?>

<div class="container page-wrap single-product-wrap">
	<?php woocommerce_breadcrumb(); ?>

	<?php while ( have_posts() ) :
		the_post();
		wc_get_template_part( 'content', 'single-product' );
	endwhile; ?>
</div>

<?php get_footer( 'shop' ); ?>
