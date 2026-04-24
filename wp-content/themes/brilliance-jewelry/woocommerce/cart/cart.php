<?php
/**
 * Cart page template.
 *
 * @package BrillianceJewelry
 */
defined( 'ABSPATH' ) || exit;
do_action( 'woocommerce_before_cart' ); ?>

<form class="woocommerce-cart-form cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	<div class="cart-table" aria-label="<?php esc_attr_e( 'Shopping cart', 'brilliance-jewelry' ); ?>">
		<div class="cart-table__head">
			<span class="col-product"><?php esc_html_e( 'Product', 'brilliance-jewelry' ); ?></span>
			<span class="col-price"><?php esc_html_e( 'Price', 'brilliance-jewelry' ); ?></span>
			<span class="col-qty"><?php esc_html_e( 'Quantity', 'brilliance-jewelry' ); ?></span>
			<span class="col-total"><?php esc_html_e( 'Total', 'brilliance-jewelry' ); ?></span>
		</div>

		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<div class="cart-row <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
					<div class="col-product">
						<?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
						echo $product_permalink ? sprintf( '<a href="%s" class="cart-row__thumb">%s</a>', esc_url( $product_permalink ), $thumbnail ) : '<span class="cart-row__thumb">' . $thumbnail . '</span>';
						?>
						<div class="cart-row__info">
							<?php
							if ( ! $product_permalink ) {
								echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) );
							} else {
								echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" class="cart-row__name">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
							}
							do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
							echo wc_get_formatted_cart_item_data( $cart_item );

							echo apply_filters(
								'woocommerce_cart_item_remove_link',
								sprintf(
									'<a href="%s" class="cart-row__remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">%s</a>',
									esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
									esc_attr__( 'Remove this item', 'brilliance-jewelry' ),
									esc_attr( $product_id ),
									esc_attr( $_product->get_sku() ),
									esc_html__( 'Remove', 'brilliance-jewelry' )
								),
								$cart_item_key
							);
							?>
						</div>
					</div>
					<div class="col-price">
						<?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
					</div>
					<div class="col-qty">
						<?php
						if ( $_product->is_sold_individually() ) {
							$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
						} else {
							$product_quantity = woocommerce_quantity_input( array(
								'input_name'   => "cart[{$cart_item_key}][qty]",
								'input_value'  => $cart_item['quantity'],
								'max_value'    => $_product->get_max_purchase_quantity(),
								'min_value'    => '0',
								'product_name' => $_product->get_name(),
							), $_product, false );
						}
						echo $product_quantity;
						?>
					</div>
					<div class="col-total">
						<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
					</div>
				</div>
				<?php
			}
		}
		?>

		<?php do_action( 'woocommerce_cart_contents' ); ?>

		<div class="cart-actions">
			<?php if ( wc_coupons_enabled() ) : ?>
				<div class="cart-coupon">
					<label for="coupon_code"><?php esc_html_e( 'Promo code', 'brilliance-jewelry' ); ?></label>
					<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Promo code', 'brilliance-jewelry' ); ?>">
					<button type="submit" class="btn btn--ghost" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'brilliance-jewelry' ); ?>"><?php esc_html_e( 'Apply', 'brilliance-jewelry' ); ?></button>
				</div>
			<?php endif; ?>

			<button type="submit" class="btn btn--ghost" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'brilliance-jewelry' ); ?>"><?php esc_html_e( 'Update cart', 'brilliance-jewelry' ); ?></button>
			<?php do_action( 'woocommerce_cart_actions' ); ?>
			<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
		</div>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</div>

	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals">
	<?php do_action( 'woocommerce_cart_collaterals' ); ?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
