<?php
/**
 * Lightweight wishlist implementation (cookie-backed).
 *
 * @package BrillianceJewelry
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Read wishlist IDs from cookie.
 */
function brilliance_get_wishlist_ids() {
	if ( empty( $_COOKIE['brilliance_wishlist'] ) ) {
		return array();
	}
	$raw = sanitize_text_field( wp_unslash( $_COOKIE['brilliance_wishlist'] ) );
	$ids = array_filter( array_map( 'absint', explode( ',', $raw ) ) );
	return array_values( array_unique( $ids ) );
}

/**
 * Count items in wishlist.
 */
function brilliance_get_wishlist_count() {
	return count( brilliance_get_wishlist_ids() );
}

/**
 * AJAX: toggle wishlist item.
 */
function brilliance_ajax_toggle_wishlist() {
	check_ajax_referer( 'brilliance_nonce', 'nonce' );

	$product_id = isset( $_POST['product_id'] ) ? absint( $_POST['product_id'] ) : 0;
	if ( ! $product_id ) {
		wp_send_json_error( array( 'message' => __( 'Invalid product.', 'brilliance-jewelry' ) ) );
	}

	$ids = brilliance_get_wishlist_ids();
	if ( in_array( $product_id, $ids, true ) ) {
		$ids  = array_diff( $ids, array( $product_id ) );
		$action = 'removed';
	} else {
		$ids[] = $product_id;
		$action = 'added';
	}

	$value   = implode( ',', array_map( 'absint', $ids ) );
	$expires = time() + ( 30 * DAY_IN_SECONDS );
	setcookie( 'brilliance_wishlist', $value, $expires, COOKIEPATH, COOKIE_DOMAIN, is_ssl(), false );

	wp_send_json_success( array(
		'count'  => count( $ids ),
		'action' => $action,
		'ids'    => array_values( $ids ),
	) );
}
add_action( 'wp_ajax_brilliance_toggle_wishlist', 'brilliance_ajax_toggle_wishlist' );
add_action( 'wp_ajax_nopriv_brilliance_toggle_wishlist', 'brilliance_ajax_toggle_wishlist' );

/**
 * Shortcode to render the wishlist page.
 */
function brilliance_wishlist_shortcode() {
	ob_start();

	$ids = brilliance_get_wishlist_ids();
	if ( empty( $ids ) || ! class_exists( 'WooCommerce' ) ) {
		?>
		<div class="wishlist-empty">
			<p><?php esc_html_e( 'Your wishlist is empty.', 'brilliance-jewelry' ); ?></p>
			<a href="<?php echo esc_url( class_exists( 'WooCommerce' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' ) ); ?>" class="btn btn--primary"><?php esc_html_e( 'Continue shopping', 'brilliance-jewelry' ); ?></a>
		</div>
		<?php
		return ob_get_clean();
	}

	$args = array(
		'post_type'      => 'product',
		'post__in'       => $ids,
		'posts_per_page' => -1,
	);
	$query = new WP_Query( $args );
	if ( $query->have_posts() ) :
		?>
		<ul class="products columns-4 wishlist-grid">
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<?php wc_get_template_part( 'content', 'product' ); ?>
			<?php endwhile; ?>
		</ul>
		<?php
	endif;
	wp_reset_postdata();

	return ob_get_clean();
}
add_shortcode( 'brilliance_wishlist', 'brilliance_wishlist_shortcode' );

/**
 * Add a wishlist button on single product pages.
 */
function brilliance_single_product_wishlist_button() {
	global $product;
	if ( ! $product ) {
		return;
	}
	$ids      = brilliance_get_wishlist_ids();
	$is_saved = in_array( $product->get_id(), $ids, true );
	?>
	<button type="button" class="wishlist-btn <?php echo $is_saved ? 'is-active' : ''; ?>" data-wishlist-toggle data-product-id="<?php echo esc_attr( $product->get_id() ); ?>">
		<?php brilliance_icon( 'heart' ); ?>
		<span class="wishlist-btn__label"><?php echo $is_saved ? esc_html__( 'Saved', 'brilliance-jewelry' ) : esc_html__( 'Save to wishlist', 'brilliance-jewelry' ); ?></span>
	</button>
	<?php
}
add_action( 'woocommerce_single_product_summary', 'brilliance_single_product_wishlist_button', 35 );

/**
 * Add a wishlist icon to each product in the catalog loop.
 */
function brilliance_loop_wishlist_button() {
	global $product;
	if ( ! $product ) {
		return;
	}
	$ids      = brilliance_get_wishlist_ids();
	$is_saved = in_array( $product->get_id(), $ids, true );
	?>
	<button type="button" class="wishlist-chip <?php echo $is_saved ? 'is-active' : ''; ?>" data-wishlist-toggle data-product-id="<?php echo esc_attr( $product->get_id() ); ?>" aria-label="<?php esc_attr_e( 'Toggle wishlist', 'brilliance-jewelry' ); ?>">
		<?php brilliance_icon( 'heart' ); ?>
	</button>
	<?php
}
add_action( 'woocommerce_before_shop_loop_item_title', 'brilliance_loop_wishlist_button', 5 );
