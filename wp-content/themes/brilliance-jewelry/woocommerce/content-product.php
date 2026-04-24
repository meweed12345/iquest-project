<?php
/**
 * Product card in the catalog loop.
 *
 * @package BrillianceJewelry
 */
defined( 'ABSPATH' ) || exit;
global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( 'product-card', $product ); ?>>
	<div class="product-card__media">
		<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
		<a href="<?php the_permalink(); ?>" class="product-card__link">
			<?php echo $product->get_image( 'brilliance-product-thumb' ); ?>
		</a>
	</div>
	<div class="product-card__body">
		<h3 class="product-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>

		<?php
		$rating = $product->get_average_rating();
		if ( $rating ) : ?>
			<div class="product-card__rating">
				<?php echo wc_get_rating_html( $rating ); ?>
				<span class="product-card__rating-count">(<?php echo (int) $product->get_review_count(); ?>)</span>
			</div>
		<?php endif; ?>

		<div class="product-card__price"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>

		<?php woocommerce_template_loop_add_to_cart(); ?>
	</div>
</li>
