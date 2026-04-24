<?php
/**
 * Product archive (shop) template override.
 *
 * @package BrillianceJewelry
 */
defined( 'ABSPATH' ) || exit;
get_header( 'shop' );
?>

<div class="container page-wrap shop-archive">
	<header class="shop-archive__head">
		<?php woocommerce_breadcrumb(); ?>
		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
		<?php endif; ?>
		<?php do_action( 'woocommerce_archive_description' ); ?>
	</header>

	<div class="shop-archive__body">
		<?php if ( is_active_sidebar( 'shop-sidebar' ) ) : ?>
			<aside class="shop-sidebar">
				<?php dynamic_sidebar( 'shop-sidebar' ); ?>
			</aside>
		<?php endif; ?>

		<div class="shop-archive__main">
			<?php
			if ( woocommerce_product_loop() ) {
				woocommerce_product_loop_start();
				if ( wc_get_loop_prop( 'total' ) ) {
					while ( have_posts() ) {
						the_post();
						do_action( 'woocommerce_shop_loop' );
						wc_get_template_part( 'content', 'product' );
					}
				}
				woocommerce_product_loop_end();
				do_action( 'woocommerce_after_shop_loop' );
			} else {
				do_action( 'woocommerce_no_products_found' );
			}
			?>
		</div>
	</div>
</div>

<?php get_footer( 'shop' ); ?>
