<?php
/**
 * Template helper functions.
 *
 * @package BrillianceJewelry
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Output an inline SVG icon.
 *
 * @param string $name Icon name.
 */
function brilliance_icon( $name ) {
	$icons = array(
		'search'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>',
		'heart'       => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l7.8-7.6 1-1a5.5 5.5 0 0 0 0-7.8Z"/></svg>',
		'user'        => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg>',
		'bag'         => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 7h12l-1 13H7L6 7Z"/><path d="M9 7a3 3 0 1 1 6 0"/></svg>',
		'close'       => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><path d="m6 6 12 12M18 6 6 18"/></svg>',
		'shipping'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" stroke-linecap="round"><path d="M3 6h11v10H3zM14 9h4l3 3v4h-7zM7 20a2 2 0 1 0 0-4 2 2 0 0 0 0 4ZM17 20a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/></svg>',
		'return'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 12a8 8 0 1 1 2 5.3"/><path d="M4 20v-4h4"/></svg>',
		'certificate' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="10" r="5"/><path d="m9 14-1 7 4-2 4 2-1-7"/></svg>',
		'warranty'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" stroke-linecap="round"><path d="M12 3 4 6v6c0 4.4 3.2 7.9 8 9 4.8-1.1 8-4.6 8-9V6l-8-3Z"/><path d="m9 12 2 2 4-4"/></svg>',
		'instagram'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor"/></svg>',
		'facebook'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 8h3V4h-3a4 4 0 0 0-4 4v2H7v4h3v8h4v-8h3l1-4h-4V8Z"/></svg>',
		'pinterest'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"><circle cx="12" cy="12" r="9"/><path d="M11 22c1-2 2-5 2-7M8 11a4 4 0 1 1 8 0c0 3-2 5-4 5s-2-2-2-3"/></svg>',
		'tiktok'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 4v9a4 4 0 1 1-4-4"/><path d="M15 4c.5 2 2 3.5 4 4"/></svg>',
		'youtube'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"><rect x="2" y="6" width="20" height="12" rx="3"/><path d="m10 9 5 3-5 3V9Z" fill="currentColor"/></svg>',
		'arrow-right' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>',
	);

	$svg = isset( $icons[ $name ] ) ? $icons[ $name ] : '';
	if ( ! $svg ) {
		return;
	}
	echo '<span class="icon icon--' . esc_attr( $name ) . '" aria-hidden="true">' . $svg . '</span>';
}

/**
 * Format a price with no decimals.
 *
 * @param mixed $price Price.
 */
function brilliance_format_price( $price ) {
	if ( function_exists( 'wc_price' ) ) {
		return wc_price( $price );
	}
	return '$' . number_format_i18n( (float) $price, 2 );
}

/**
 * Fallback primary menu.
 */
function brilliance_primary_menu_fallback() {
	$shop_url = class_exists( 'WooCommerce' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
	?>
	<ul class="primary-menu">
		<li><a href="<?php echo esc_url( home_url( '/engagement/' ) ); ?>"><?php esc_html_e( 'Engagement', 'brilliance-jewelry' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/rings/' ) ); ?>"><?php esc_html_e( 'Rings', 'brilliance-jewelry' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/necklaces/' ) ); ?>"><?php esc_html_e( 'Necklaces', 'brilliance-jewelry' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/earrings/' ) ); ?>"><?php esc_html_e( 'Earrings', 'brilliance-jewelry' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/bracelets/' ) ); ?>"><?php esc_html_e( 'Bracelets', 'brilliance-jewelry' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/diamond-search/' ) ); ?>"><?php esc_html_e( 'Diamonds', 'brilliance-jewelry' ); ?></a></li>
		<li><a href="<?php echo esc_url( $shop_url ); ?>"><?php esc_html_e( 'Shop all', 'brilliance-jewelry' ); ?></a></li>
	</ul>
	<?php
}

/**
 * Fallback top bar menu.
 */
function brilliance_topbar_fallback() {
	?>
	<ul class="topbar__menu">
		<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About', 'brilliance-jewelry' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'brilliance-jewelry' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/education/' ) ); ?>"><?php esc_html_e( 'Diamond education', 'brilliance-jewelry' ); ?></a></li>
	</ul>
	<?php
}

/** Footer fallbacks. */
function brilliance_footer_menu_fallback_shop() {
	?>
	<ul class="footer-menu">
		<li><a href="<?php echo esc_url( home_url( '/engagement-rings/' ) ); ?>"><?php esc_html_e( 'Engagement rings', 'brilliance-jewelry' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/wedding-bands/' ) ); ?>"><?php esc_html_e( 'Wedding bands', 'brilliance-jewelry' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/necklaces/' ) ); ?>"><?php esc_html_e( 'Necklaces', 'brilliance-jewelry' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/earrings/' ) ); ?>"><?php esc_html_e( 'Earrings', 'brilliance-jewelry' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/bracelets/' ) ); ?>"><?php esc_html_e( 'Bracelets', 'brilliance-jewelry' ); ?></a></li>
	</ul>
	<?php
}
function brilliance_footer_menu_fallback_help() {
	?>
	<ul class="footer-menu">
		<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact us', 'brilliance-jewelry' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/shipping/' ) ); ?>"><?php esc_html_e( 'Shipping', 'brilliance-jewelry' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/returns/' ) ); ?>"><?php esc_html_e( 'Returns', 'brilliance-jewelry' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/warranty/' ) ); ?>"><?php esc_html_e( 'Warranty', 'brilliance-jewelry' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>"><?php esc_html_e( 'FAQ', 'brilliance-jewelry' ); ?></a></li>
	</ul>
	<?php
}
function brilliance_footer_menu_fallback_about() {
	?>
	<ul class="footer-menu">
		<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'Our story', 'brilliance-jewelry' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/education/' ) ); ?>"><?php esc_html_e( 'Diamond education', 'brilliance-jewelry' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/sustainability/' ) ); ?>"><?php esc_html_e( 'Sustainability', 'brilliance-jewelry' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'Journal', 'brilliance-jewelry' ); ?></a></li>
	</ul>
	<?php
}

/**
 * Generate an excerpt.
 */
function brilliance_excerpt_more() {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'brilliance_excerpt_more' );

/**
 * Body class additions.
 */
function brilliance_body_classes( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'has-hero';
	}
	if ( ! is_active_sidebar( 'shop-sidebar' ) ) {
		$classes[] = 'no-shop-sidebar';
	}
	return $classes;
}
add_filter( 'body_class', 'brilliance_body_classes' );
