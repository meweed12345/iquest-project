<?php
/**
 * Brilliance Jewelry theme functions.
 *
 * @package BrillianceJewelry
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BRILLIANCE_VERSION', '1.0.0' );
define( 'BRILLIANCE_DIR', get_template_directory() );
define( 'BRILLIANCE_URI', get_template_directory_uri() );

/**
 * Theme setup.
 */
function brilliance_setup() {
	load_theme_textdomain( 'brilliance-jewelry', BRILLIANCE_DIR . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 240,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
		'navigation-widgets',
	) );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );

	// WooCommerce support.
	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width' => 600,
		'single_image_width'    => 1000,
		'product_grid'          => array(
			'default_rows'    => 4,
			'min_rows'        => 2,
			'default_columns' => 4,
			'min_columns'     => 2,
			'max_columns'     => 6,
		),
	) );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	// Image sizes.
	add_image_size( 'brilliance-hero', 1920, 900, true );
	add_image_size( 'brilliance-category', 600, 600, true );
	add_image_size( 'brilliance-product-thumb', 400, 400, true );

	// Navigation menus.
	register_nav_menus( array(
		'primary'     => __( 'Primary Menu', 'brilliance-jewelry' ),
		'secondary'   => __( 'Top Bar Menu', 'brilliance-jewelry' ),
		'footer-1'    => __( 'Footer Column 1', 'brilliance-jewelry' ),
		'footer-2'    => __( 'Footer Column 2', 'brilliance-jewelry' ),
		'footer-3'    => __( 'Footer Column 3', 'brilliance-jewelry' ),
		'mobile'      => __( 'Mobile Menu', 'brilliance-jewelry' ),
	) );
}
add_action( 'after_setup_theme', 'brilliance_setup' );

/**
 * Content width.
 */
function brilliance_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'brilliance_content_width', 1280 );
}
add_action( 'after_setup_theme', 'brilliance_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function brilliance_scripts() {
	// Google Fonts.
	wp_enqueue_style(
		'brilliance-fonts',
		'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap',
		array(),
		null
	);

	// Main stylesheet.
	wp_enqueue_style(
		'brilliance-style',
		BRILLIANCE_URI . '/assets/css/main.css',
		array(),
		BRILLIANCE_VERSION
	);

	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_style(
			'brilliance-woocommerce',
			BRILLIANCE_URI . '/assets/css/woocommerce.css',
			array( 'brilliance-style' ),
			BRILLIANCE_VERSION
		);
	}

	wp_enqueue_script(
		'brilliance-main',
		BRILLIANCE_URI . '/assets/js/main.js',
		array( 'jquery' ),
		BRILLIANCE_VERSION,
		true
	);

	wp_localize_script( 'brilliance-main', 'brilliance_vars', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'nonce'    => wp_create_nonce( 'brilliance_nonce' ),
		'cart_url' => class_exists( 'WooCommerce' ) ? wc_get_cart_url() : home_url( '/cart' ),
		'i18n'     => array(
			'added_to_cart'     => __( 'Added to cart', 'brilliance-jewelry' ),
			'added_to_wishlist' => __( 'Added to wishlist', 'brilliance-jewelry' ),
		),
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'brilliance_scripts' );

/**
 * Widget areas.
 */
function brilliance_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Shop Sidebar', 'brilliance-jewelry' ),
		'id'            => 'shop-sidebar',
		'description'   => __( 'Filters and widgets for the shop archive.', 'brilliance-jewelry' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Newsletter', 'brilliance-jewelry' ),
		'id'            => 'footer-newsletter',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'brilliance_widgets_init' );

// Includes.
require BRILLIANCE_DIR . '/inc/template-functions.php';
require BRILLIANCE_DIR . '/inc/customizer.php';
require BRILLIANCE_DIR . '/inc/wishlist.php';
require BRILLIANCE_DIR . '/inc/ajax.php';
require BRILLIANCE_DIR . '/inc/diamond-search.php';
require BRILLIANCE_DIR . '/inc/woocommerce.php';

if ( is_admin() ) {
	require BRILLIANCE_DIR . '/inc/demo-content.php';
}
