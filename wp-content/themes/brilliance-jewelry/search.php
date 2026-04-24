<?php
/**
 * Search results.
 *
 * @package BrillianceJewelry
 */
get_header(); ?>

<div class="container page-wrap">
	<header class="page-header">
		<h1 class="page-title">
			<?php printf( esc_html__( 'Search results for: %s', 'brilliance-jewelry' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?>
		</h1>
	</header>

	<?php if ( have_posts() ) : ?>
		<div class="search-results">
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'search-result' ); ?>>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="search-result__excerpt"><?php the_excerpt(); ?></div>
				</article>
			<?php endwhile; ?>
		</div>
		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'Nothing matched your search. Try different keywords.', 'brilliance-jewelry' ); ?></p>
		<?php get_search_form(); ?>
	<?php endif; ?>
</div>

<?php get_footer(); ?>
