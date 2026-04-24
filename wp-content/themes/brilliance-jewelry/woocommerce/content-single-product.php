<?php
/**
 * Single product content.
 *
 * @package BrillianceJewelry
 */
defined( 'ABSPATH' ) || exit;
global $product;
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'single-product-main', $product ); ?>>

	<div class="single-product-main__media">
		<?php
		do_action( 'woocommerce_before_single_product_summary' );
		?>
	</div>

	<div class="single-product-main__summary summary entry-summary">
		<?php
		/**
		 * woocommerce_single_product_summary:
		 * @hooked woocommerce_template_single_title           - 5
		 * @hooked woocommerce_template_single_rating          - 10
		 * @hooked woocommerce_template_single_price           - 10
		 * @hooked woocommerce_template_single_excerpt         - 20
		 * @hooked woocommerce_template_single_add_to_cart     - 30
		 * @hooked brilliance_single_product_wishlist_button   - 35
		 * @hooked woocommerce_template_single_meta            - 40
		 * @hooked woocommerce_template_single_sharing         - 50
		 */
		do_action( 'woocommerce_single_product_summary' );
		?>

		<ul class="product-assurances">
			<li><?php brilliance_icon( 'shipping' ); ?> <?php esc_html_e( 'Free insured shipping', 'brilliance-jewelry' ); ?></li>
			<li><?php brilliance_icon( 'return' ); ?> <?php esc_html_e( '30-day returns', 'brilliance-jewelry' ); ?></li>
			<li><?php brilliance_icon( 'warranty' ); ?> <?php esc_html_e( 'Lifetime warranty', 'brilliance-jewelry' ); ?></li>
			<li><?php brilliance_icon( 'certificate' ); ?> <?php esc_html_e( 'Certified authenticity', 'brilliance-jewelry' ); ?></li>
		</ul>
	</div>

	<div class="single-product-main__tabs">
		<?php do_action( 'woocommerce_after_single_product_summary' ); ?>
	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
