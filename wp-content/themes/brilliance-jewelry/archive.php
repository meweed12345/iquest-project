<?php
/**
 * Archive template.
 *
 * @package BrillianceJewelry
 */
get_header(); ?>

<div class="container page-wrap">
	<header class="page-header">
		<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
		<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
	</header>

	<?php if ( have_posts() ) : ?>
		<div class="post-grid">
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'post-card' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<a class="post-card__thumb" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'brilliance-category' ); ?></a>
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
		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'No content found.', 'brilliance-jewelry' ); ?></p>
	<?php endif; ?>
</div>

<?php get_footer(); ?>
