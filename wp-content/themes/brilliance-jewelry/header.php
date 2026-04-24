<?php
/**
 * Header template.
 *
 * @package BrillianceJewelry
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'brilliance-jewelry' ); ?></a>

<header id="masthead" class="site-header">

	<div class="topbar">
		<div class="container topbar__inner">
			<p class="topbar__promo">
				<?php
				echo esc_html( get_theme_mod(
					'brilliance_topbar_text',
					__( 'Complimentary shipping and returns on every order', 'brilliance-jewelry' )
				) );
				?>
			</p>
			<nav class="topbar__nav" aria-label="<?php esc_attr_e( 'Top bar menu', 'brilliance-jewelry' ); ?>">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'secondary',
					'container'      => false,
					'menu_class'     => 'topbar__menu',
					'depth'          => 1,
					'fallback_cb'    => 'brilliance_topbar_fallback',
				) );
				?>
			</nav>
		</div>
	</div>

	<div class="header-main">
		<div class="container header-main__inner">

			<button class="header-toggle" aria-label="<?php esc_attr_e( 'Open menu', 'brilliance-jewelry' ); ?>" aria-controls="mobile-menu" aria-expanded="false">
				<span></span><span></span><span></span>
			</button>

			<div class="site-branding">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-title-link" rel="home">
						<span class="site-title"><?php bloginfo( 'name' ); ?></span>
					</a>
				<?php endif; ?>
			</div>

			<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary menu', 'brilliance-jewelry' ); ?>">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'primary-menu',
					'container'      => false,
					'fallback_cb'    => 'brilliance_primary_menu_fallback',
				) );
				?>
			</nav>

			<div class="header-actions">
				<button class="header-action header-action--search" aria-label="<?php esc_attr_e( 'Search', 'brilliance-jewelry' ); ?>" data-search-toggle>
					<?php brilliance_icon( 'search' ); ?>
				</button>

				<a href="<?php echo esc_url( get_permalink( get_option( 'brilliance_wishlist_page' ) ) ?: '#' ); ?>" class="header-action header-action--wishlist" aria-label="<?php esc_attr_e( 'Wishlist', 'brilliance-jewelry' ); ?>">
					<?php brilliance_icon( 'heart' ); ?>
					<span class="header-action__count" data-wishlist-count><?php echo (int) brilliance_get_wishlist_count(); ?></span>
				</a>

				<a href="<?php echo class_exists( 'WooCommerce' ) ? esc_url( wc_get_account_endpoint_url( 'dashboard' ) ) : esc_url( wp_login_url() ); ?>" class="header-action header-action--account" aria-label="<?php esc_attr_e( 'Account', 'brilliance-jewelry' ); ?>">
					<?php brilliance_icon( 'user' ); ?>
				</a>

				<a href="<?php echo class_exists( 'WooCommerce' ) ? esc_url( wc_get_cart_url() ) : '#'; ?>" class="header-action header-action--cart" aria-label="<?php esc_attr_e( 'Cart', 'brilliance-jewelry' ); ?>">
					<?php brilliance_icon( 'bag' ); ?>
					<span class="header-action__count" data-cart-count>
						<?php echo class_exists( 'WooCommerce' ) ? (int) WC()->cart->get_cart_contents_count() : 0; ?>
					</span>
				</a>
			</div>
		</div>

		<div class="header-search" data-search-panel>
			<div class="container">
				<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<label for="header-search-input" class="screen-reader-text"><?php esc_html_e( 'Search for products', 'brilliance-jewelry' ); ?></label>
					<input id="header-search-input" type="search" name="s" placeholder="<?php esc_attr_e( 'Search rings, necklaces, diamonds…', 'brilliance-jewelry' ); ?>" autocomplete="off">
					<?php if ( class_exists( 'WooCommerce' ) ) : ?>
						<input type="hidden" name="post_type" value="product">
					<?php endif; ?>
					<button type="submit" aria-label="<?php esc_attr_e( 'Submit search', 'brilliance-jewelry' ); ?>">
						<?php brilliance_icon( 'search' ); ?>
					</button>
					<button type="button" class="search-close" aria-label="<?php esc_attr_e( 'Close search', 'brilliance-jewelry' ); ?>" data-search-toggle>
						<?php brilliance_icon( 'close' ); ?>
					</button>
				</form>
			</div>
		</div>
	</div>
</header>

<div class="mobile-menu" id="mobile-menu" aria-hidden="true">
	<div class="mobile-menu__inner">
		<button class="mobile-menu__close" aria-label="<?php esc_attr_e( 'Close menu', 'brilliance-jewelry' ); ?>">
			<?php brilliance_icon( 'close' ); ?>
		</button>
		<?php
		wp_nav_menu( array(
			'theme_location' => 'mobile',
			'menu_class'     => 'mobile-menu__list',
			'container'      => false,
			'fallback_cb'    => 'brilliance_primary_menu_fallback',
		) );
		?>
	</div>
</div>

<div id="page" class="site">
	<main id="content" class="site-content">
