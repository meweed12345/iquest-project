<?php
/**
 * Single post template.
 *
 * @package BrillianceJewelry
 */

get_header(); ?>

<div class="container page-wrap">
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class( 'single-post' ); ?>>
			<header class="single-post__head">
				<p class="single-post__meta">
					<?php echo esc_html( get_the_date() ); ?> &middot;
					<?php the_category( ', ' ); ?>
				</p>
				<h1 class="single-post__title"><?php the_title(); ?></h1>
				<?php if ( get_the_excerpt() ) : ?>
					<p class="single-post__lede"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<?php endif; ?>
			</header>
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="single-post__thumb"><?php the_post_thumbnail( 'brilliance-hero' ); ?></div>
			<?php endif; ?>
			<div class="single-post__body prose">
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
			</div>
			<footer class="single-post__foot">
				<?php the_tags( '<div class="post-tags">' . esc_html__( 'Tags: ', 'brilliance-jewelry' ), ', ', '</div>' ); ?>
			</footer>
		</article>

		<?php if ( comments_open() || get_comments_number() ) : ?>
			<section class="post-comments">
				<?php comments_template(); ?>
			</section>
		<?php endif; ?>
	<?php endwhile; ?>
</div>

<?php get_footer(); ?>
