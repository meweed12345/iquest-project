<?php
/**
 * Template Name: Diamond Education (4 Cs)
 *
 * @package BrillianceJewelry
 */
get_header(); ?>

<div class="container page-wrap">
	<header class="page-header">
		<p class="eyebrow"><?php esc_html_e( 'Diamond education', 'brilliance-jewelry' ); ?></p>
		<h1 class="page-title"><?php esc_html_e( 'Understanding the 4 Cs', 'brilliance-jewelry' ); ?></h1>
		<p><?php esc_html_e( 'Cut, color, clarity, and carat — the universal language of diamond quality. Here is what each one means.', 'brilliance-jewelry' ); ?></p>
	</header>

	<div class="post-grid post-grid--three">
		<article class="post-card">
			<div class="post-card__body">
				<h3 class="post-card__title"><?php esc_html_e( 'Cut', 'brilliance-jewelry' ); ?></h3>
				<p><?php esc_html_e( 'The proportions and craftsmanship that determine how a diamond reflects light. Cut grade is the most important factor in a stone’s sparkle.', 'brilliance-jewelry' ); ?></p>
			</div>
		</article>
		<article class="post-card">
			<div class="post-card__body">
				<h3 class="post-card__title"><?php esc_html_e( 'Color', 'brilliance-jewelry' ); ?></h3>
				<p><?php esc_html_e( 'Graded D (colorless) to Z (light yellow). The less color a diamond has, the more rare and valuable it is.', 'brilliance-jewelry' ); ?></p>
			</div>
		</article>
		<article class="post-card">
			<div class="post-card__body">
				<h3 class="post-card__title"><?php esc_html_e( 'Clarity', 'brilliance-jewelry' ); ?></h3>
				<p><?php esc_html_e( 'A measure of internal inclusions and external blemishes. Most stones VS2 or higher are eye-clean.', 'brilliance-jewelry' ); ?></p>
			</div>
		</article>
		<article class="post-card">
			<div class="post-card__body">
				<h3 class="post-card__title"><?php esc_html_e( 'Carat', 'brilliance-jewelry' ); ?></h3>
				<p><?php esc_html_e( 'A unit of weight (1 ct = 0.2 g). Two stones with the same carat weight can look different depending on cut and shape.', 'brilliance-jewelry' ); ?></p>
			</div>
		</article>
	</div>

	<div style="text-align:center; margin-top:48px;">
		<a href="<?php echo esc_url( home_url( '/diamond-search/' ) ); ?>" class="btn btn--primary"><?php esc_html_e( 'Start your diamond search', 'brilliance-jewelry' ); ?></a>
	</div>
</div>

<?php get_footer(); ?>
