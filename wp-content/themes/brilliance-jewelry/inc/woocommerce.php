<?php
/**
 * WooCommerce integration and overrides.
 *
 * @package BrillianceJewelry
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Wrap the WooCommerce content in our container.
 */
function brilliance_woocommerce_wrapper_start() {
	echo '<div class="container woocommerce-wrap page-wrap">';
}
function brilliance_woocommerce_wrapper_end() {
	echo '</div>';
}
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', 'brilliance_woocommerce_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'brilliance_woocommerce_wrapper_end', 10 );

/**
 * Set products per page and columns on shop archives.
 */
function brilliance_loop_columns() {
	return 4;
}
add_filter( 'loop_shop_columns', 'brilliance_loop_columns' );

function brilliance_loop_per_page() {
	return 24;
}
add_filter( 'loop_shop_per_page', 'brilliance_loop_per_page', 20 );

/**
 * Show result count + ordering side-by-side on shop pages.
 */
function brilliance_shop_loop_header() {
	echo '<div class="shop-loop__head">';
}
function brilliance_shop_loop_header_end() {
	echo '</div>';
}
add_action( 'woocommerce_before_shop_loop', 'brilliance_shop_loop_header', 5 );
add_action( 'woocommerce_before_shop_loop', 'brilliance_shop_loop_header_end', 40 );

/**
 * Sidebar with filter widgets on shop page.
 */
function brilliance_before_shop_sidebar() {
	if ( ( is_shop() || is_product_category() || is_product_tag() ) && is_active_sidebar( 'shop-sidebar' ) ) {
		echo '<aside class="shop-sidebar">';
		dynamic_sidebar( 'shop-sidebar' );
		echo '</aside>';
	}
}
add_action( 'woocommerce_before_main_content', 'brilliance_before_shop_sidebar', 12 );

/**
 * Change number of related products.
 */
function brilliance_related_products_args( $args ) {
	$args['posts_per_page'] = 4;
	$args['columns']        = 4;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'brilliance_related_products_args' );

/**
 * Custom breadcrumb separator.
 */
function brilliance_breadcrumb_defaults( $defaults ) {
	$defaults['wrap_before'] = '<nav class="breadcrumb" aria-label="' . esc_attr__( 'Breadcrumb', 'brilliance-jewelry' ) . '">';
	$defaults['wrap_after']  = '</nav>';
	$defaults['delimiter']   = ' <span aria-hidden="true">/</span> ';
	return $defaults;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'brilliance_breadcrumb_defaults' );

/**
 * Replace default sale flash with a nicer badge.
 */
function brilliance_sale_flash() {
	return '<span class="onsale">' . esc_html__( 'Sale', 'brilliance-jewelry' ) . '</span>';
}
add_filter( 'woocommerce_sale_flash', 'brilliance_sale_flash' );

/**
 * Replace the default "Add to cart" label with something nicer on archives.
 */
function brilliance_add_to_cart_text( $text, $product ) {
	if ( $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() ) {
		return __( 'Add to bag', 'brilliance-jewelry' );
	}
	if ( $product->is_type( 'variable' ) ) {
		return __( 'Select options', 'brilliance-jewelry' );
	}
	return $text;
}
add_filter( 'woocommerce_product_add_to_cart_text', 'brilliance_add_to_cart_text', 10, 2 );
add_filter( 'woocommerce_product_single_add_to_cart_text', 'brilliance_add_to_cart_text', 10, 2 );

/**
 * Registers a wishlist page on theme activation.
 */
function brilliance_create_core_pages() {
	$pages = array(
		'brilliance_wishlist_page' => array(
			'title'   => __( 'Wishlist', 'brilliance-jewelry' ),
			'content' => '[brilliance_wishlist]',
		),
		'brilliance_diamond_search_page' => array(
			'title'   => __( 'Diamond Search', 'brilliance-jewelry' ),
			'content' => '[brilliance_diamond_search]',
		),
	);
	foreach ( $pages as $option => $data ) {
		if ( get_option( $option ) ) {
			continue;
		}
		$page_id = wp_insert_post( array(
			'post_title'   => $data['title'],
			'post_content' => $data['content'],
			'post_status'  => 'publish',
			'post_type'    => 'page',
		) );
		if ( $page_id && ! is_wp_error( $page_id ) ) {
			update_option( $option, $page_id );
		}
	}
}
add_action( 'after_switch_theme', 'brilliance_create_core_pages' );
