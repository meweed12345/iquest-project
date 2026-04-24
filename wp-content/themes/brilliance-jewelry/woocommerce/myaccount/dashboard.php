<?php
/**
 * My Account dashboard.
 *
 * @package BrillianceJewelry
 */
defined( 'ABSPATH' ) || exit;
$user = wp_get_current_user();
?>

<div class="account-dashboard">
	<h2>
		<?php
		printf(
			/* translators: %s: customer name */
			esc_html__( 'Welcome back, %s', 'brilliance-jewelry' ),
			esc_html( $user->display_name )
		);
		?>
	</h2>
	<p>
		<?php
		printf(
			wp_kses_post( __( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'brilliance-jewelry' ) ),
			esc_url( wc_get_endpoint_url( 'orders' ) ),
			esc_url( wc_get_endpoint_url( 'edit-address' ) ),
			esc_url( wc_get_endpoint_url( 'edit-account' ) )
		);
		?>
	</p>

	<div class="account-tiles" style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:32px;">
		<a href="<?php echo esc_url( wc_get_endpoint_url( 'orders' ) ); ?>" class="account-tile" style="background:#fff;border:1px solid var(--bb-line);padding:24px;border-radius:var(--bb-radius);text-align:center;">
			<strong style="display:block;font-size:1.2rem;margin-bottom:6px;"><?php esc_html_e( 'My orders', 'brilliance-jewelry' ); ?></strong>
			<span style="color:var(--bb-muted);"><?php esc_html_e( 'Track and review purchases', 'brilliance-jewelry' ); ?></span>
		</a>
		<a href="<?php echo esc_url( get_permalink( get_option( 'brilliance_wishlist_page' ) ) ?: '#' ); ?>" class="account-tile" style="background:#fff;border:1px solid var(--bb-line);padding:24px;border-radius:var(--bb-radius);text-align:center;">
			<strong style="display:block;font-size:1.2rem;margin-bottom:6px;"><?php esc_html_e( 'Wishlist', 'brilliance-jewelry' ); ?></strong>
			<span style="color:var(--bb-muted);"><?php esc_html_e( 'Saved for later', 'brilliance-jewelry' ); ?></span>
		</a>
		<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address' ) ); ?>" class="account-tile" style="background:#fff;border:1px solid var(--bb-line);padding:24px;border-radius:var(--bb-radius);text-align:center;">
			<strong style="display:block;font-size:1.2rem;margin-bottom:6px;"><?php esc_html_e( 'Addresses', 'brilliance-jewelry' ); ?></strong>
			<span style="color:var(--bb-muted);"><?php esc_html_e( 'Manage shipping & billing', 'brilliance-jewelry' ); ?></span>
		</a>
	</div>
</div>
