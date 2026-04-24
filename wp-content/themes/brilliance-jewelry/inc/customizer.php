<?php
/**
 * Theme Customizer settings.
 *
 * @package BrillianceJewelry
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function brilliance_customize_register( $wp_customize ) {

	// Top bar.
	$wp_customize->add_section( 'brilliance_topbar', array(
		'title'    => __( 'Top Bar', 'brilliance-jewelry' ),
		'priority' => 30,
	) );
	$wp_customize->add_setting( 'brilliance_topbar_text', array(
		'default'           => __( 'Complimentary shipping and returns on every order', 'brilliance-jewelry' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( 'brilliance_topbar_text', array(
		'label'   => __( 'Announcement text', 'brilliance-jewelry' ),
		'section' => 'brilliance_topbar',
		'type'    => 'text',
	) );

	// Hero.
	$wp_customize->add_section( 'brilliance_hero', array(
		'title'    => __( 'Homepage Hero', 'brilliance-jewelry' ),
		'priority' => 35,
	) );
	$hero_fields = array(
		'brilliance_hero_image'           => array( 'label' => __( 'Hero image URL', 'brilliance-jewelry' ), 'type' => 'url', 'default' => '' ),
		'brilliance_hero_eyebrow'         => array( 'label' => __( 'Eyebrow', 'brilliance-jewelry' ), 'type' => 'text', 'default' => __( 'New Collection', 'brilliance-jewelry' ) ),
		'brilliance_hero_title'           => array( 'label' => __( 'Title', 'brilliance-jewelry' ), 'type' => 'text', 'default' => __( 'Timeless brilliance, consciously crafted.', 'brilliance-jewelry' ) ),
		'brilliance_hero_subtitle'        => array( 'label' => __( 'Subtitle', 'brilliance-jewelry' ), 'type' => 'textarea', 'default' => __( 'Lab-grown diamonds and fine jewelry created with integrity.', 'brilliance-jewelry' ) ),
		'brilliance_hero_primary_label'   => array( 'label' => __( 'Primary button label', 'brilliance-jewelry' ), 'type' => 'text', 'default' => __( 'Shop collection', 'brilliance-jewelry' ) ),
		'brilliance_hero_primary_url'     => array( 'label' => __( 'Primary button URL', 'brilliance-jewelry' ), 'type' => 'url', 'default' => '' ),
		'brilliance_hero_secondary_label' => array( 'label' => __( 'Secondary button label', 'brilliance-jewelry' ), 'type' => 'text', 'default' => __( 'Design your ring', 'brilliance-jewelry' ) ),
		'brilliance_hero_secondary_url'   => array( 'label' => __( 'Secondary button URL', 'brilliance-jewelry' ), 'type' => 'url', 'default' => '' ),
	);
	foreach ( $hero_fields as $id => $args ) {
		$wp_customize->add_setting( $id, array(
			'default'           => $args['default'],
			'sanitize_callback' => 'url' === $args['type'] ? 'esc_url_raw' : 'sanitize_text_field',
			'transport'         => 'refresh',
		) );
		$wp_customize->add_control( $id, array(
			'label'   => $args['label'],
			'section' => 'brilliance_hero',
			'type'    => $args['type'],
		) );
	}

	// Newsletter & footer.
	$wp_customize->add_section( 'brilliance_footer', array(
		'title'    => __( 'Footer', 'brilliance-jewelry' ),
		'priority' => 120,
	) );
	$footer_fields = array(
		'brilliance_newsletter_heading'  => array( 'label' => __( 'Newsletter heading', 'brilliance-jewelry' ), 'default' => __( 'Join the Brilliance Club', 'brilliance-jewelry' ) ),
		'brilliance_newsletter_sub'      => array( 'label' => __( 'Newsletter subtitle', 'brilliance-jewelry' ), 'default' => __( 'Sign up for new arrivals, exclusive offers and styling tips.', 'brilliance-jewelry' ) ),
		'brilliance_footer_tagline'      => array( 'label' => __( 'Footer tagline', 'brilliance-jewelry' ), 'default' => __( 'Ethically crafted lab-grown diamond jewelry designed to last a lifetime.', 'brilliance-jewelry' ) ),
		'brilliance_social_instagram'    => array( 'label' => __( 'Instagram URL', 'brilliance-jewelry' ), 'default' => '', 'type' => 'url' ),
		'brilliance_social_facebook'     => array( 'label' => __( 'Facebook URL', 'brilliance-jewelry' ), 'default' => '', 'type' => 'url' ),
		'brilliance_social_pinterest'    => array( 'label' => __( 'Pinterest URL', 'brilliance-jewelry' ), 'default' => '', 'type' => 'url' ),
		'brilliance_social_tiktok'       => array( 'label' => __( 'TikTok URL', 'brilliance-jewelry' ), 'default' => '', 'type' => 'url' ),
		'brilliance_social_youtube'      => array( 'label' => __( 'YouTube URL', 'brilliance-jewelry' ), 'default' => '', 'type' => 'url' ),
	);
	foreach ( $footer_fields as $id => $args ) {
		$type = isset( $args['type'] ) ? $args['type'] : 'text';
		$wp_customize->add_setting( $id, array(
			'default'           => $args['default'],
			'sanitize_callback' => 'url' === $type ? 'esc_url_raw' : 'sanitize_text_field',
			'transport'         => 'refresh',
		) );
		$wp_customize->add_control( $id, array(
			'label'   => $args['label'],
			'section' => 'brilliance_footer',
			'type'    => $type,
		) );
	}

	// Colors.
	$wp_customize->add_setting( 'brilliance_accent_color', array(
		'default'           => '#c7a87a',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brilliance_accent_color', array(
		'label'   => __( 'Accent color', 'brilliance-jewelry' ),
		'section' => 'colors',
	) ) );
}
add_action( 'customize_register', 'brilliance_customize_register' );

/**
 * Inline color variables.
 */
function brilliance_customizer_css() {
	$accent = get_theme_mod( 'brilliance_accent_color', '#c7a87a' );
	?>
	<style id="brilliance-customizer-css">
		:root { --bb-accent: <?php echo esc_attr( $accent ); ?>; }
	</style>
	<?php
}
add_action( 'wp_head', 'brilliance_customizer_css' );
