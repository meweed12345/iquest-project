<?php
/**
 * Default page template.
 *
 * @package BrillianceJewelry
 */

get_header(); ?>

<div class="container page-wrap">
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class( 'page-article' ); ?>>
			<header class="page-header">
				<h1 class="page-title"><?php the_title(); ?></h1>
			</header>
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="page-thumb"><?php the_post_thumbnail( 'brilliance-hero' ); ?></div>
			<?php endif; ?>
			<div class="page-content prose">
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
			</div>
		</article>

		<?php if ( comments_open() || get_comments_number() ) : ?>
			<div class="page-comments">
				<?php comments_template(); ?>
			</div>
		<?php endif; ?>
	<?php endwhile; ?>
</div>

<?php get_footer(); ?>
