<?php
/**
 * Template Name: About
 *
 * @package BrillianceJewelry
 */
get_header(); ?>

<section class="hero hero--small">
	<div class="hero__placeholder"></div>
	<div class="hero__content container">
		<p class="hero__eyebrow"><?php esc_html_e( 'Our story', 'brilliance-jewelry' ); ?></p>
		<h1 class="hero__title"><?php the_title(); ?></h1>
	</div>
</section>

<div class="container page-wrap">
	<?php while ( have_posts() ) : the_post(); ?>
		<article class="page-content prose" style="max-width:760px;margin:0 auto;">
			<?php
			if ( get_the_content() ) {
				the_content();
			} else {
				?>
				<p><?php esc_html_e( 'Brilliance was founded with a simple belief: a beautiful diamond should not come at a cost to the planet, the people who mine it, or the people who buy it.', 'brilliance-jewelry' ); ?></p>
				<h2><?php esc_html_e( 'Lab-grown, ethically created', 'brilliance-jewelry' ); ?></h2>
				<p><?php esc_html_e( 'Every stone we sell is chemically, optically and physically identical to a mined diamond — but created in a laboratory using cutting-edge technology, with a fraction of the environmental impact and zero conflict.', 'brilliance-jewelry' ); ?></p>
				<h2><?php esc_html_e( 'Hand-finished by master jewelers', 'brilliance-jewelry' ); ?></h2>
				<p><?php esc_html_e( 'Every ring, necklace and pair of earrings is finished by hand in our workshop. We use only recycled gold and platinum, and we back every piece with a lifetime warranty.', 'brilliance-jewelry' ); ?></p>
				<?php
			}
			?>
		</article>
	<?php endwhile; ?>
</div>

<?php get_footer(); ?>
