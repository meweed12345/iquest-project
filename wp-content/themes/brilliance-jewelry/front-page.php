<?php
/**
 * Front page template.
 *
 * @package BrillianceJewelry
 */

get_header(); ?>

<section class="hero">
	<div class="hero__media">
		<?php
		$hero_image = get_theme_mod( 'brilliance_hero_image' );
		if ( $hero_image ) :
			?>
			<img src="<?php echo esc_url( $hero_image ); ?>" alt="" loading="eager">
		<?php else : ?>
			<div class="hero__placeholder"></div>
		<?php endif; ?>
	</div>
	<div class="hero__content container">
		<p class="hero__eyebrow"><?php echo esc_html( get_theme_mod( 'brilliance_hero_eyebrow', __( 'New Collection', 'brilliance-jewelry' ) ) ); ?></p>
		<h1 class="hero__title">
			<?php echo esc_html( get_theme_mod( 'brilliance_hero_title', __( 'Timeless brilliance, consciously crafted.', 'brilliance-jewelry' ) ) ); ?>
		</h1>
		<p class="hero__subtitle">
			<?php echo esc_html( get_theme_mod( 'brilliance_hero_subtitle', __( 'Lab-grown diamonds and fine jewelry created with integrity.', 'brilliance-jewelry' ) ) ); ?>
		</p>
		<div class="hero__actions">
			<a href="<?php echo esc_url( get_theme_mod( 'brilliance_hero_primary_url', class_exists( 'WooCommerce' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop' ) ) ); ?>" class="btn btn--primary">
				<?php echo esc_html( get_theme_mod( 'brilliance_hero_primary_label', __( 'Shop collection', 'brilliance-jewelry' ) ) ); ?>
			</a>
			<a href="<?php echo esc_url( get_theme_mod( 'brilliance_hero_secondary_url', home_url( '/diamond-search' ) ) ); ?>" class="btn btn--ghost">
				<?php echo esc_html( get_theme_mod( 'brilliance_hero_secondary_label', __( 'Design your ring', 'brilliance-jewelry' ) ) ); ?>
			</a>
		</div>
	</div>
</section>

<section class="value-bar">
	<div class="container value-bar__inner">
		<div class="value-item">
			<?php brilliance_icon( 'shipping' ); ?>
			<div>
				<strong><?php esc_html_e( 'Free shipping', 'brilliance-jewelry' ); ?></strong>
				<span><?php esc_html_e( 'Insured & tracked, worldwide', 'brilliance-jewelry' ); ?></span>
			</div>
		</div>
		<div class="value-item">
			<?php brilliance_icon( 'return' ); ?>
			<div>
				<strong><?php esc_html_e( '30-day returns', 'brilliance-jewelry' ); ?></strong>
				<span><?php esc_html_e( 'Easy, no-questions-asked', 'brilliance-jewelry' ); ?></span>
			</div>
		</div>
		<div class="value-item">
			<?php brilliance_icon( 'certificate' ); ?>
			<div>
				<strong><?php esc_html_e( 'Certified diamonds', 'brilliance-jewelry' ); ?></strong>
				<span><?php esc_html_e( 'IGI & GIA graded', 'brilliance-jewelry' ); ?></span>
			</div>
		</div>
		<div class="value-item">
			<?php brilliance_icon( 'warranty' ); ?>
			<div>
				<strong><?php esc_html_e( 'Lifetime warranty', 'brilliance-jewelry' ); ?></strong>
				<span><?php esc_html_e( 'Craftsmanship guaranteed', 'brilliance-jewelry' ); ?></span>
			</div>
		</div>
	</div>
</section>

<?php
// Shop by category.
if ( class_exists( 'WooCommerce' ) ) :
	$product_categories = get_terms( array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => false,
		'number'     => 6,
		'exclude'    => array( get_option( 'default_product_cat' ) ),
	) );
	if ( ! is_wp_error( $product_categories ) && ! empty( $product_categories ) ) :
		?>
		<section class="section section--categories">
			<div class="container">
				<header class="section__head">
					<h2 class="section__title"><?php esc_html_e( 'Shop by category', 'brilliance-jewelry' ); ?></h2>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="link-arrow"><?php esc_html_e( 'View all', 'brilliance-jewelry' ); ?></a>
				</header>
				<ul class="category-grid">
					<?php foreach ( $product_categories as $cat ) :
						$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
						$image        = $thumbnail_id ? wp_get_attachment_image_url( $thumbnail_id, 'brilliance-category' ) : '';
						?>
						<li class="category-card">
							<a href="<?php echo esc_url( get_term_link( $cat ) ); ?>">
								<span class="category-card__media">
									<?php if ( $image ) : ?>
										<img src="<?php echo esc_url( $image ); ?>" alt="" loading="lazy">
									<?php endif; ?>
								</span>
								<span class="category-card__name"><?php echo esc_html( $cat->name ); ?></span>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</section>
		<?php
	endif;
endif;
?>

<?php if ( class_exists( 'WooCommerce' ) ) : ?>
	<section class="section section--featured">
		<div class="container">
			<header class="section__head">
				<h2 class="section__title"><?php esc_html_e( 'Best sellers', 'brilliance-jewelry' ); ?></h2>
				<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="link-arrow"><?php esc_html_e( 'See more', 'brilliance-jewelry' ); ?></a>
			</header>
			<?php echo do_shortcode( '[products limit="8" columns="4" orderby="popularity" class="product-carousel"]' ); ?>
		</div>
	</section>

	<section class="section section--featured section--alt">
		<div class="container">
			<header class="section__head">
				<h2 class="section__title"><?php esc_html_e( 'New arrivals', 'brilliance-jewelry' ); ?></h2>
				<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>?orderby=date" class="link-arrow"><?php esc_html_e( 'Shop all', 'brilliance-jewelry' ); ?></a>
			</header>
			<?php echo do_shortcode( '[products limit="8" columns="4" orderby="date"]' ); ?>
		</div>
	</section>
<?php endif; ?>

<section class="section section--split">
	<div class="container section--split__inner">
		<div class="split-card">
			<div class="split-card__body">
				<p class="eyebrow"><?php esc_html_e( 'Bespoke', 'brilliance-jewelry' ); ?></p>
				<h3><?php esc_html_e( 'Design your engagement ring', 'brilliance-jewelry' ); ?></h3>
				<p><?php esc_html_e( 'Choose your diamond, setting, and metal to create a ring that is truly yours.', 'brilliance-jewelry' ); ?></p>
				<a href="<?php echo esc_url( home_url( '/diamond-search/' ) ); ?>" class="btn btn--dark"><?php esc_html_e( 'Start designing', 'brilliance-jewelry' ); ?></a>
			</div>
		</div>
		<div class="split-card split-card--alt">
			<div class="split-card__body">
				<p class="eyebrow"><?php esc_html_e( 'Our story', 'brilliance-jewelry' ); ?></p>
				<h3><?php esc_html_e( 'Ethical luxury, redefined', 'brilliance-jewelry' ); ?></h3>
				<p><?php esc_html_e( 'Every stone is lab-grown and every piece is handcrafted to the highest standards.', 'brilliance-jewelry' ); ?></p>
				<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="btn btn--ghost-dark"><?php esc_html_e( 'Read more', 'brilliance-jewelry' ); ?></a>
			</div>
		</div>
	</div>
</section>

<section class="section section--testimonials">
	<div class="container">
		<header class="section__head section__head--center">
			<h2 class="section__title"><?php esc_html_e( 'What our customers say', 'brilliance-jewelry' ); ?></h2>
		</header>
		<div class="testimonials">
			<?php
			$testimonials = array(
				array(
					'quote'  => __( 'Beautifully made and truly sparkles. Customer service was exceptional from start to finish.', 'brilliance-jewelry' ),
					'author' => __( 'Alina P.', 'brilliance-jewelry' ),
					'rating' => 5,
				),
				array(
					'quote'  => __( 'I wanted a conflict-free stone and the quality exceeded every expectation.', 'brilliance-jewelry' ),
					'author' => __( 'Matei R.', 'brilliance-jewelry' ),
					'rating' => 5,
				),
				array(
					'quote'  => __( 'The design team helped me create the perfect ring for my proposal. Unforgettable.', 'brilliance-jewelry' ),
					'author' => __( 'Sofia L.', 'brilliance-jewelry' ),
					'rating' => 5,
				),
			);
			foreach ( $testimonials as $t ) :
				?>
				<figure class="testimonial">
					<div class="testimonial__stars" aria-label="<?php echo esc_attr( sprintf( _n( '%d star', '%d stars', $t['rating'], 'brilliance-jewelry' ), $t['rating'] ) ); ?>">
						<?php echo str_repeat( '<span>&#9733;</span>', (int) $t['rating'] ); ?>
					</div>
					<blockquote><p><?php echo esc_html( $t['quote'] ); ?></p></blockquote>
					<figcaption><?php echo esc_html( $t['author'] ); ?></figcaption>
				</figure>
				<?php
			endforeach;
			?>
		</div>
	</div>
</section>

<?php
// Latest posts from journal.
$journal = new WP_Query( array(
	'post_type'      => 'post',
	'posts_per_page' => 3,
	'ignore_sticky_posts' => true,
) );
if ( $journal->have_posts() ) : ?>
	<section class="section section--journal">
		<div class="container">
			<header class="section__head">
				<h2 class="section__title"><?php esc_html_e( 'From the journal', 'brilliance-jewelry' ); ?></h2>
				<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog' ) ); ?>" class="link-arrow"><?php esc_html_e( 'Read more', 'brilliance-jewelry' ); ?></a>
			</header>
			<div class="post-grid post-grid--three">
				<?php while ( $journal->have_posts() ) : $journal->the_post(); ?>
					<article <?php post_class( 'post-card' ); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<a class="post-card__thumb" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'brilliance-category' ); ?></a>
						<?php endif; ?>
						<div class="post-card__body">
							<p class="post-card__meta"><?php echo esc_html( get_the_date() ); ?></p>
							<h3 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<a href="<?php the_permalink(); ?>" class="link-arrow"><?php esc_html_e( 'Read', 'brilliance-jewelry' ); ?></a>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
		</div>
	</section>
<?php endif; wp_reset_postdata(); ?>

<?php get_footer(); ?>
