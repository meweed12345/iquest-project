<?php
/**
 * Demo content importer.
 *
 * Adds an admin button under Tools that creates a set of sample categories,
 * products, pages and menus so the theme can be demoed instantly. Safe to run
 * multiple times — items are skipped if they already exist.
 *
 * @package BrillianceJewelry
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add admin page.
 */
function brilliance_demo_admin_menu() {
	add_management_page(
		__( 'Brilliance Demo Content', 'brilliance-jewelry' ),
		__( 'Brilliance Demo', 'brilliance-jewelry' ),
		'manage_options',
		'brilliance-demo',
		'brilliance_demo_admin_page'
	);
}
add_action( 'admin_menu', 'brilliance_demo_admin_menu' );

function brilliance_demo_admin_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$status = '';
	if ( ! empty( $_POST['brilliance_demo'] ) && check_admin_referer( 'brilliance_demo_action' ) ) {
		$result = brilliance_demo_run_import();
		$status = sprintf(
			/* translators: 1: created count, 2: skipped count */
			__( 'Done. Created %1$d items, skipped %2$d that already existed.', 'brilliance-jewelry' ),
			$result['created'],
			$result['skipped']
		);
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Brilliance Demo Content', 'brilliance-jewelry' ); ?></h1>
		<p><?php esc_html_e( 'Generate sample categories, products, and pages to populate the storefront. WooCommerce must be installed and active.', 'brilliance-jewelry' ); ?></p>
		<?php if ( $status ) : ?>
			<div class="notice notice-success"><p><?php echo esc_html( $status ); ?></p></div>
		<?php endif; ?>
		<form method="post">
			<?php wp_nonce_field( 'brilliance_demo_action' ); ?>
			<input type="hidden" name="brilliance_demo" value="1">
			<p><button type="submit" class="button button-primary"><?php esc_html_e( 'Import demo content', 'brilliance-jewelry' ); ?></button></p>
		</form>
	</div>
	<?php
}

/**
 * Create sample data.
 */
function brilliance_demo_run_import() {
	$created = 0;
	$skipped = 0;

	if ( ! class_exists( 'WooCommerce' ) ) {
		return array( 'created' => 0, 'skipped' => 0 );
	}

	// Categories.
	$categories = array(
		'engagement-rings' => __( 'Engagement Rings', 'brilliance-jewelry' ),
		'wedding-bands'    => __( 'Wedding Bands', 'brilliance-jewelry' ),
		'necklaces'        => __( 'Necklaces', 'brilliance-jewelry' ),
		'earrings'         => __( 'Earrings', 'brilliance-jewelry' ),
		'bracelets'        => __( 'Bracelets', 'brilliance-jewelry' ),
		'loose-diamonds'   => __( 'Loose Diamonds', 'brilliance-jewelry' ),
	);
	$cat_ids = array();
	foreach ( $categories as $slug => $name ) {
		$term = get_term_by( 'slug', $slug, 'product_cat' );
		if ( $term ) {
			$cat_ids[ $slug ] = $term->term_id;
			$skipped++;
			continue;
		}
		$res = wp_insert_term( $name, 'product_cat', array( 'slug' => $slug ) );
		if ( ! is_wp_error( $res ) ) {
			$cat_ids[ $slug ] = $res['term_id'];
			$created++;
		}
	}

	// Products.
	$products = array(
		array(
			'title'       => 'Solitaire Round Engagement Ring',
			'category'    => 'engagement-rings',
			'price'       => 1290,
			'regular'     => 1490,
			'description' => 'A timeless solitaire featuring a brilliant round lab-grown diamond on a slender band of recycled 18k gold.',
			'short'       => 'Classic six-prong solitaire with a 1.0ct round brilliant.',
			'sku'         => 'BB-ENG-001',
		),
		array(
			'title'       => 'Pavé Halo Engagement Ring',
			'category'    => 'engagement-rings',
			'price'       => 1690,
			'description' => 'A radiant halo of pavé-set diamonds surrounds a brilliant centre stone for maximum sparkle.',
			'short'       => 'Pavé halo setting in 18k white gold.',
			'sku'         => 'BB-ENG-002',
		),
		array(
			'title'       => 'Classic Plain Wedding Band',
			'category'    => 'wedding-bands',
			'price'       => 590,
			'description' => 'A simple, elegant comfort-fit band crafted from recycled 18k gold.',
			'short'       => '2.5mm comfort-fit band.',
			'sku'         => 'BB-WB-001',
		),
		array(
			'title'       => 'Diamond Tennis Necklace',
			'category'    => 'necklaces',
			'price'       => 2490,
			'description' => 'A continuous line of brilliant lab-grown diamonds on a 16-inch chain.',
			'short'       => '3.0ct total weight, 16-inch chain.',
			'sku'         => 'BB-NL-001',
		),
		array(
			'title'       => 'Solitaire Pendant',
			'category'    => 'necklaces',
			'price'       => 690,
			'description' => 'A delicate solitaire pendant featuring a 0.5ct round brilliant lab-grown diamond.',
			'short'       => '0.5ct solitaire pendant.',
			'sku'         => 'BB-NL-002',
		),
		array(
			'title'       => 'Diamond Stud Earrings',
			'category'    => 'earrings',
			'price'       => 790,
			'description' => 'Classic four-prong studs with brilliant round lab-grown diamonds.',
			'short'       => '1.0ct total weight studs.',
			'sku'         => 'BB-EAR-001',
		),
		array(
			'title'       => 'Hoop Diamond Earrings',
			'category'    => 'earrings',
			'price'       => 1190,
			'description' => 'Pavé-set hoops in 18k gold.',
			'short'       => '20mm pavé hoops.',
			'sku'         => 'BB-EAR-002',
		),
		array(
			'title'       => 'Diamond Tennis Bracelet',
			'category'    => 'bracelets',
			'price'       => 1990,
			'description' => 'A modern classic — round brilliant diamonds set in 18k recycled gold.',
			'short'       => '4.0ct total weight tennis bracelet.',
			'sku'         => 'BB-BR-001',
		),
		array(
			'title'       => 'Round Brilliant Loose Diamond',
			'category'    => 'loose-diamonds',
			'price'       => 1100,
			'description' => 'Lab-grown round brilliant diamond. IGI certified. Ideal cut, F color, VS1 clarity.',
			'short'       => '1.00ct, F, VS1, Ideal cut.',
			'sku'         => 'BB-LD-001',
			'meta'        => array( '_carat' => '1.00' ),
		),
		array(
			'title'       => 'Oval Loose Diamond',
			'category'    => 'loose-diamonds',
			'price'       => 1450,
			'description' => 'Lab-grown oval-cut diamond. IGI certified. G color, VS2 clarity.',
			'short'       => '1.20ct, G, VS2, Excellent cut.',
			'sku'         => 'BB-LD-002',
			'meta'        => array( '_carat' => '1.20' ),
		),
	);

	foreach ( $products as $p ) {
		$existing = get_page_by_title( $p['title'], OBJECT, 'product' );
		if ( $existing ) {
			$skipped++;
			continue;
		}
		$post_id = wp_insert_post( array(
			'post_title'   => $p['title'],
			'post_content' => $p['description'],
			'post_excerpt' => $p['short'],
			'post_status'  => 'publish',
			'post_type'    => 'product',
		) );
		if ( ! $post_id || is_wp_error( $post_id ) ) {
			continue;
		}
		wp_set_object_terms( $post_id, 'simple', 'product_type' );
		if ( isset( $cat_ids[ $p['category'] ] ) ) {
			wp_set_object_terms( $post_id, $cat_ids[ $p['category'] ], 'product_cat' );
		}
		update_post_meta( $post_id, '_visibility', 'visible' );
		update_post_meta( $post_id, '_stock_status', 'instock' );
		update_post_meta( $post_id, '_sku', $p['sku'] );
		update_post_meta( $post_id, '_regular_price', isset( $p['regular'] ) ? $p['regular'] : $p['price'] );
		update_post_meta( $post_id, '_sale_price', isset( $p['regular'] ) ? $p['price'] : '' );
		update_post_meta( $post_id, '_price', $p['price'] );
		if ( ! empty( $p['meta'] ) ) {
			foreach ( $p['meta'] as $k => $v ) {
				update_post_meta( $post_id, $k, $v );
			}
		}
		$created++;
	}

	// Pages.
	$pages = array(
		'about'    => array( 'title' => __( 'About', 'brilliance-jewelry' ), 'template' => 'page-about.php', 'content' => '' ),
		'contact'  => array( 'title' => __( 'Contact', 'brilliance-jewelry' ), 'template' => 'page-contact.php', 'content' => '' ),
		'education'=> array( 'title' => __( 'Diamond Education', 'brilliance-jewelry' ), 'template' => 'page-education.php', 'content' => '' ),
		'shipping' => array( 'title' => __( 'Shipping & Returns', 'brilliance-jewelry' ), 'content' => 'Free insured shipping on every order. Hassle-free 30-day returns.' ),
		'warranty' => array( 'title' => __( 'Warranty', 'brilliance-jewelry' ), 'content' => 'Lifetime warranty on all our pieces.' ),
		'faq'      => array( 'title' => __( 'FAQ', 'brilliance-jewelry' ), 'content' => 'Frequently asked questions go here.' ),
	);
	foreach ( $pages as $slug => $page ) {
		if ( get_page_by_path( $slug ) ) {
			$skipped++;
			continue;
		}
		$page_id = wp_insert_post( array(
			'post_title'   => $page['title'],
			'post_name'    => $slug,
			'post_content' => $page['content'],
			'post_status'  => 'publish',
			'post_type'    => 'page',
		) );
		if ( $page_id && ! empty( $page['template'] ) ) {
			update_post_meta( $page_id, '_wp_page_template', $page['template'] );
		}
		if ( $page_id && ! is_wp_error( $page_id ) ) {
			$created++;
		}
	}

	// Primary menu.
	if ( ! wp_get_nav_menu_object( 'Primary' ) ) {
		$menu_id = wp_create_nav_menu( 'Primary' );
		if ( ! is_wp_error( $menu_id ) ) {
			foreach ( array( 'Engagement Rings', 'Wedding Bands', 'Necklaces', 'Earrings', 'Bracelets', 'Loose Diamonds' ) as $name ) {
				$slug = sanitize_title( $name );
				$term = get_term_by( 'slug', $slug, 'product_cat' );
				if ( $term ) {
					wp_update_nav_menu_item( $menu_id, 0, array(
						'menu-item-title'     => $name,
						'menu-item-object'    => 'product_cat',
						'menu-item-object-id' => $term->term_id,
						'menu-item-type'      => 'taxonomy',
						'menu-item-status'    => 'publish',
					) );
				}
			}
			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title'  => __( 'Diamonds', 'brilliance-jewelry' ),
				'menu-item-url'    => home_url( '/diamond-search/' ),
				'menu-item-type'   => 'custom',
				'menu-item-status' => 'publish',
			) );
			$locations            = get_theme_mod( 'nav_menu_locations', array() );
			$locations['primary'] = $menu_id;
			$locations['mobile']  = $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
			$created++;
		}
	}

	return array( 'created' => $created, 'skipped' => $skipped );
}
