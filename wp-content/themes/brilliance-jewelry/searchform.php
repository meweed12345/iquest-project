<?php
/**
 * Search form.
 *
 * @package BrillianceJewelry
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( uniqid( 's-' ) ); ?>" class="screen-reader-text"><?php esc_html_e( 'Search', 'brilliance-jewelry' ); ?></label>
	<input type="search" id="<?php echo esc_attr( uniqid( 's-' ) ); ?>" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search…', 'brilliance-jewelry' ); ?>">
	<button type="submit" class="btn btn--ghost"><?php esc_html_e( 'Search', 'brilliance-jewelry' ); ?></button>
</form>
