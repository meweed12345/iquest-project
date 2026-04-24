<?php
/**
 * Footer template.
 *
 * @package BrillianceJewelry
 */
?>
	</main><!-- .site-content -->

	<footer id="colophon" class="site-footer">
		<div class="footer-newsletter">
			<div class="container footer-newsletter__inner">
				<div class="footer-newsletter__text">
					<h2><?php echo esc_html( get_theme_mod( 'brilliance_newsletter_heading', __( 'Join the Brilliance Club', 'brilliance-jewelry' ) ) ); ?></h2>
					<p><?php echo esc_html( get_theme_mod( 'brilliance_newsletter_sub', __( 'Sign up for new arrivals, exclusive offers and styling tips.', 'brilliance-jewelry' ) ) ); ?></p>
				</div>
				<form class="newsletter-form" data-newsletter-form>
					<label for="newsletter-email" class="screen-reader-text"><?php esc_html_e( 'Email address', 'brilliance-jewelry' ); ?></label>
					<input type="email" id="newsletter-email" name="email" required placeholder="<?php esc_attr_e( 'Your email address', 'brilliance-jewelry' ); ?>">
					<button type="submit" class="btn btn--primary"><?php esc_html_e( 'Subscribe', 'brilliance-jewelry' ); ?></button>
					<p class="newsletter-form__message" data-newsletter-message aria-live="polite"></p>
				</form>
			</div>
		</div>

		<div class="footer-columns">
			<div class="container footer-columns__inner">
				<div class="footer-col footer-col--brand">
					<?php if ( has_custom_logo() ) : the_custom_logo(); else : ?>
						<h3 class="footer-brand"><?php bloginfo( 'name' ); ?></h3>
					<?php endif; ?>
					<p class="footer-tagline">
						<?php echo esc_html( get_theme_mod( 'brilliance_footer_tagline', __( 'Ethically crafted lab-grown diamond jewelry designed to last a lifetime.', 'brilliance-jewelry' ) ) ); ?>
					</p>
					<ul class="social-links">
						<?php
						$socials = array(
							'instagram' => get_theme_mod( 'brilliance_social_instagram' ),
							'facebook'  => get_theme_mod( 'brilliance_social_facebook' ),
							'pinterest' => get_theme_mod( 'brilliance_social_pinterest' ),
							'tiktok'    => get_theme_mod( 'brilliance_social_tiktok' ),
							'youtube'   => get_theme_mod( 'brilliance_social_youtube' ),
						);
						foreach ( $socials as $network => $url ) :
							if ( ! $url ) {
								continue;
							}
							?>
							<li>
								<a href="<?php echo esc_url( $url ); ?>" aria-label="<?php echo esc_attr( ucfirst( $network ) ); ?>" rel="noopener noreferrer" target="_blank">
									<?php brilliance_icon( $network ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>

				<div class="footer-col">
					<h4 class="footer-col__title"><?php esc_html_e( 'Shop', 'brilliance-jewelry' ); ?></h4>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer-1',
						'menu_class'     => 'footer-menu',
						'container'      => false,
						'depth'          => 1,
						'fallback_cb'    => 'brilliance_footer_menu_fallback_shop',
					) );
					?>
				</div>

				<div class="footer-col">
					<h4 class="footer-col__title"><?php esc_html_e( 'Help', 'brilliance-jewelry' ); ?></h4>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer-2',
						'menu_class'     => 'footer-menu',
						'container'      => false,
						'depth'          => 1,
						'fallback_cb'    => 'brilliance_footer_menu_fallback_help',
					) );
					?>
				</div>

				<div class="footer-col">
					<h4 class="footer-col__title"><?php esc_html_e( 'About', 'brilliance-jewelry' ); ?></h4>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer-3',
						'menu_class'     => 'footer-menu',
						'container'      => false,
						'depth'          => 1,
						'fallback_cb'    => 'brilliance_footer_menu_fallback_about',
					) );
					?>
				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container footer-bottom__inner">
				<p class="footer-copy">&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'brilliance-jewelry' ); ?></p>
				<ul class="footer-payments" aria-label="<?php esc_attr_e( 'Accepted payment methods', 'brilliance-jewelry' ); ?>">
					<li>Visa</li>
					<li>Mastercard</li>
					<li>Amex</li>
					<li>PayPal</li>
					<li>Klarna</li>
					<li>Apple Pay</li>
				</ul>
			</div>
		</div>
	</footer>
</div><!-- #page -->

<!-- Toast notification -->
<div class="brilliance-toast" data-toast aria-live="polite"></div>

<?php wp_footer(); ?>
</body>
</html>
