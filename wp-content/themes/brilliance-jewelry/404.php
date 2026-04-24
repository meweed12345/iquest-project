<?php
/**
 * 404 template.
 *
 * @package BrillianceJewelry
 */
get_header(); ?>

<div class="container page-wrap error-404">
	<h1><?php esc_html_e( 'Page not found', 'brilliance-jewelry' ); ?></h1>
	<p><?php esc_html_e( 'The page you’re looking for doesn’t exist. Try a search or explore our collections.', 'brilliance-jewelry' ); ?></p>
	<?php get_search_form(); ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary"><?php esc_html_e( 'Go home', 'brilliance-jewelry' ); ?></a>
</div>

<?php get_footer(); ?>
