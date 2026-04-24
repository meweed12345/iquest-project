<?php
/**
 * AJAX endpoints.
 *
 * @package BrillianceJewelry
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Newsletter subscription endpoint.
 *
 * Stores emails in an option array; integrate with Mailchimp / Klaviyo by
 * filtering `brilliance_newsletter_subscribe`.
 */
function brilliance_ajax_newsletter() {
	check_ajax_referer( 'brilliance_nonce', 'nonce' );

	$email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	if ( ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => __( 'Please enter a valid email address.', 'brilliance-jewelry' ) ) );
	}

	$subscribers = get_option( 'brilliance_newsletter_subscribers', array() );
	if ( ! in_array( $email, $subscribers, true ) ) {
		$subscribers[] = $email;
		update_option( 'brilliance_newsletter_subscribers', $subscribers );
	}

	/**
	 * Hook for third-party integrations.
	 *
	 * @param string $email Email address.
	 */
	do_action( 'brilliance_newsletter_subscribe', $email );

	wp_send_json_success( array(
		'message' => __( 'Thank you! Check your inbox for a welcome offer.', 'brilliance-jewelry' ),
	) );
}
add_action( 'wp_ajax_brilliance_newsletter', 'brilliance_ajax_newsletter' );
add_action( 'wp_ajax_nopriv_brilliance_newsletter', 'brilliance_ajax_newsletter' );

/**
 * Refresh cart count fragment after add-to-cart.
 */
function brilliance_cart_fragment( $fragments ) {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return $fragments;
	}
	ob_start();
	?>
	<span class="header-action__count" data-cart-count><?php echo (int) WC()->cart->get_cart_contents_count(); ?></span>
	<?php
	$fragments['[data-cart-count]'] = ob_get_clean();
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'brilliance_cart_fragment' );

/**
 * Contact form AJAX endpoint.
 */
function brilliance_ajax_contact() {
	check_ajax_referer( 'brilliance_nonce', 'nonce' );

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$subject = isset( $_POST['subject'] ) ? sanitize_text_field( wp_unslash( $_POST['subject'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	if ( ! $name || ! is_email( $email ) || ! $message ) {
		wp_send_json_error( array( 'message' => __( 'Please fill in all required fields.', 'brilliance-jewelry' ) ) );
	}

	$to      = get_option( 'admin_email' );
	$headers = array(
		'Content-Type: text/html; charset=UTF-8',
		'Reply-To: ' . $name . ' <' . $email . '>',
	);
	$body = sprintf(
		'<p><strong>%s:</strong> %s</p><p><strong>%s:</strong> %s</p><p><strong>%s:</strong></p><p>%s</p>',
		esc_html__( 'From', 'brilliance-jewelry' ),
		esc_html( $name . ' <' . $email . '>' ),
		esc_html__( 'Subject', 'brilliance-jewelry' ),
		esc_html( $subject ),
		esc_html__( 'Message', 'brilliance-jewelry' ),
		nl2br( esc_html( $message ) )
	);

	$sent = wp_mail( $to, sprintf( '[%s] %s', wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES ), $subject ?: __( 'New contact message', 'brilliance-jewelry' ) ), $body, $headers );

	if ( ! $sent ) {
		wp_send_json_error( array( 'message' => __( 'Something went wrong. Please try again.', 'brilliance-jewelry' ) ) );
	}

	wp_send_json_success( array(
		'message' => __( 'Thank you! We’ll reply within one business day.', 'brilliance-jewelry' ),
	) );
}
add_action( 'wp_ajax_brilliance_contact', 'brilliance_ajax_contact' );
add_action( 'wp_ajax_nopriv_brilliance_contact', 'brilliance_ajax_contact' );

/**
 * Quick-view product endpoint.
 */
function brilliance_ajax_quick_view() {
	check_ajax_referer( 'brilliance_nonce', 'nonce' );
	$product_id = isset( $_POST['product_id'] ) ? absint( $_POST['product_id'] ) : 0;
	if ( ! $product_id || ! class_exists( 'WooCommerce' ) ) {
		wp_send_json_error();
	}
	$product = wc_get_product( $product_id );
	if ( ! $product ) {
		wp_send_json_error();
	}
	ob_start();
	?>
	<div class="quick-view">
		<div class="quick-view__media">
			<?php echo $product->get_image( 'woocommerce_single' ); ?>
		</div>
		<div class="quick-view__body">
			<h2><?php echo esc_html( $product->get_name() ); ?></h2>
			<div class="quick-view__price"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>
			<div class="quick-view__excerpt"><?php echo wp_kses_post( wpautop( $product->get_short_description() ) ); ?></div>
			<a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="btn btn--primary"><?php esc_html_e( 'View product', 'brilliance-jewelry' ); ?></a>
		</div>
	</div>
	<?php
	wp_send_json_success( array( 'html' => ob_get_clean() ) );
}
add_action( 'wp_ajax_brilliance_quick_view', 'brilliance_ajax_quick_view' );
add_action( 'wp_ajax_nopriv_brilliance_quick_view', 'brilliance_ajax_quick_view' );
