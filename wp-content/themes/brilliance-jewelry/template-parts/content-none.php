<?php
/**
 * Empty results template.
 *
 * @package BrillianceJewelry
 */
?>
<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing found', 'brilliance-jewelry' ); ?></h1>
	</header>
	<div class="page-content">
		<p><?php esc_html_e( 'It looks like nothing was found at this location. Try a search?', 'brilliance-jewelry' ); ?></p>
		<?php get_search_form(); ?>
	</div>
</section>
