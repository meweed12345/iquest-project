<?php
/**
 * Main template file.
 *
 * @package BrillianceJewelry
 */

get_header(); ?>

<div class="container page-wrap">
	<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<h1 class="page-title">
				<?php
				if ( is_home() && ! is_front_page() ) {
					single_post_title();
				} elseif ( is_archive() ) {
					the_archive_title();
				} else {
					esc_html_e( 'Journal', 'brilliance-jewelry' );
				}
				?>
			</h1>
		</header>

		<div class="post-grid">
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'post-card' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<a class="post-card__thumb" href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'brilliance-category' ); ?>
						</a>
					<?php endif; ?>
					<div class="post-card__body">
						<p class="post-card__meta"><?php echo esc_html( get_the_date() ); ?></p>
						<h2 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div class="post-card__excerpt"><?php the_excerpt(); ?></div>
						<a href="<?php the_permalink(); ?>" class="link-arrow"><?php esc_html_e( 'Read article', 'brilliance-jewelry' ); ?></a>
					</div>
				</article>
			<?php endwhile; ?>
		</div>

		<?php the_posts_pagination( array(
			'prev_text' => __( '&larr; Previous', 'brilliance-jewelry' ),
			'next_text' => __( 'Next &rarr;', 'brilliance-jewelry' ),
		) ); ?>

	<?php else : ?>
		<section class="no-results">
			<h1><?php esc_html_e( 'Nothing here yet', 'brilliance-jewelry' ); ?></h1>
			<p><?php esc_html_e( 'Try a different search or explore our collections.', 'brilliance-jewelry' ); ?></p>
			<?php get_search_form(); ?>
		</section>
	<?php endif; ?>
</div>

<?php get_footer(); ?>
