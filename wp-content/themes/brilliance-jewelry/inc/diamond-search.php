<?php
/**
 * Diamond search tool.
 *
 * Exposes a [brilliance_diamond_search] shortcode that renders a filter UI for
 * products in the `loose-diamonds` product category. Filters are stored in the
 * URL so they are shareable and bookmarkable.
 *
 * @package BrillianceJewelry
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function brilliance_diamond_search_shortcode() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return '<p>' . esc_html__( 'WooCommerce is required for the diamond search.', 'brilliance-jewelry' ) . '</p>';
	}

	$shapes     = array( 'Round', 'Oval', 'Princess', 'Emerald', 'Cushion', 'Radiant', 'Pear', 'Marquise', 'Asscher', 'Heart' );
	$colors     = array( 'D', 'E', 'F', 'G', 'H', 'I', 'J' );
	$clarities  = array( 'FL', 'IF', 'VVS1', 'VVS2', 'VS1', 'VS2', 'SI1', 'SI2' );
	$cuts       = array( 'Ideal', 'Excellent', 'Very Good', 'Good' );

	$selected_shape   = isset( $_GET['shape'] ) ? sanitize_text_field( wp_unslash( $_GET['shape'] ) ) : '';
	$selected_color   = isset( $_GET['color'] ) ? sanitize_text_field( wp_unslash( $_GET['color'] ) ) : '';
	$selected_clarity = isset( $_GET['clarity'] ) ? sanitize_text_field( wp_unslash( $_GET['clarity'] ) ) : '';
	$selected_cut     = isset( $_GET['cut'] ) ? sanitize_text_field( wp_unslash( $_GET['cut'] ) ) : '';
	$min_carat        = isset( $_GET['min_carat'] ) ? floatval( $_GET['min_carat'] ) : 0.3;
	$max_carat        = isset( $_GET['max_carat'] ) ? floatval( $_GET['max_carat'] ) : 5.0;
	$min_price        = isset( $_GET['min_price'] ) ? floatval( $_GET['min_price'] ) : 0;
	$max_price        = isset( $_GET['max_price'] ) ? floatval( $_GET['max_price'] ) : 100000;

	ob_start();
	?>
	<div class="diamond-search">
		<form class="diamond-search__form" method="get" action="">
			<div class="diamond-search__filters">
				<fieldset class="diamond-filter">
					<legend><?php esc_html_e( 'Shape', 'brilliance-jewelry' ); ?></legend>
					<div class="shape-grid">
						<?php foreach ( $shapes as $shape ) : ?>
							<label class="shape-chip">
								<input type="radio" name="shape" value="<?php echo esc_attr( $shape ); ?>" <?php checked( $selected_shape, $shape ); ?>>
								<span><?php echo esc_html( $shape ); ?></span>
							</label>
						<?php endforeach; ?>
					</div>
				</fieldset>

				<fieldset class="diamond-filter">
					<legend><?php esc_html_e( 'Carat', 'brilliance-jewelry' ); ?></legend>
					<div class="range-inputs">
						<label><?php esc_html_e( 'Min', 'brilliance-jewelry' ); ?>
							<input type="number" name="min_carat" step="0.1" min="0.1" max="10" value="<?php echo esc_attr( $min_carat ); ?>">
						</label>
						<label><?php esc_html_e( 'Max', 'brilliance-jewelry' ); ?>
							<input type="number" name="max_carat" step="0.1" min="0.1" max="10" value="<?php echo esc_attr( $max_carat ); ?>">
						</label>
					</div>
				</fieldset>

				<fieldset class="diamond-filter">
					<legend><?php esc_html_e( 'Color', 'brilliance-jewelry' ); ?></legend>
					<div class="chip-row">
						<?php foreach ( $colors as $color ) : ?>
							<label class="chip">
								<input type="radio" name="color" value="<?php echo esc_attr( $color ); ?>" <?php checked( $selected_color, $color ); ?>>
								<span><?php echo esc_html( $color ); ?></span>
							</label>
						<?php endforeach; ?>
					</div>
				</fieldset>

				<fieldset class="diamond-filter">
					<legend><?php esc_html_e( 'Clarity', 'brilliance-jewelry' ); ?></legend>
					<div class="chip-row">
						<?php foreach ( $clarities as $clarity ) : ?>
							<label class="chip">
								<input type="radio" name="clarity" value="<?php echo esc_attr( $clarity ); ?>" <?php checked( $selected_clarity, $clarity ); ?>>
								<span><?php echo esc_html( $clarity ); ?></span>
							</label>
						<?php endforeach; ?>
					</div>
				</fieldset>

				<fieldset class="diamond-filter">
					<legend><?php esc_html_e( 'Cut', 'brilliance-jewelry' ); ?></legend>
					<div class="chip-row">
						<?php foreach ( $cuts as $cut ) : ?>
							<label class="chip">
								<input type="radio" name="cut" value="<?php echo esc_attr( $cut ); ?>" <?php checked( $selected_cut, $cut ); ?>>
								<span><?php echo esc_html( $cut ); ?></span>
							</label>
						<?php endforeach; ?>
					</div>
				</fieldset>

				<fieldset class="diamond-filter">
					<legend><?php esc_html_e( 'Price', 'brilliance-jewelry' ); ?></legend>
					<div class="range-inputs">
						<label><?php esc_html_e( 'Min', 'brilliance-jewelry' ); ?>
							<input type="number" name="min_price" step="50" min="0" value="<?php echo esc_attr( $min_price ); ?>">
						</label>
						<label><?php esc_html_e( 'Max', 'brilliance-jewelry' ); ?>
							<input type="number" name="max_price" step="50" min="0" value="<?php echo esc_attr( $max_price ); ?>">
						</label>
					</div>
				</fieldset>
			</div>
			<div class="diamond-search__actions">
				<button type="submit" class="btn btn--primary"><?php esc_html_e( 'Apply filters', 'brilliance-jewelry' ); ?></button>
				<a href="<?php echo esc_url( strtok( $_SERVER['REQUEST_URI'], '?' ) ); ?>" class="btn btn--ghost"><?php esc_html_e( 'Reset', 'brilliance-jewelry' ); ?></a>
			</div>
		</form>

		<div class="diamond-search__results">
			<?php
			$tax_query = array( 'relation' => 'AND' );
			$meta_query = array( 'relation' => 'AND' );

			$tax_query[] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => 'loose-diamonds',
			);

			foreach ( array(
				'shape'   => 'pa_shape',
				'color'   => 'pa_color',
				'clarity' => 'pa_clarity',
				'cut'     => 'pa_cut',
			) as $param => $taxonomy ) {
				$value = isset( $_GET[ $param ] ) ? sanitize_text_field( wp_unslash( $_GET[ $param ] ) ) : '';
				if ( $value ) {
					$tax_query[] = array(
						'taxonomy' => $taxonomy,
						'field'    => 'name',
						'terms'    => $value,
					);
				}
			}

			if ( $min_carat || $max_carat ) {
				$meta_query[] = array(
					'key'     => '_carat',
					'value'   => array( $min_carat, $max_carat ),
					'type'    => 'DECIMAL(5,2)',
					'compare' => 'BETWEEN',
				);
			}

			if ( $min_price || $max_price ) {
				$meta_query[] = array(
					'key'     => '_price',
					'value'   => array( $min_price, $max_price ),
					'type'    => 'NUMERIC',
					'compare' => 'BETWEEN',
				);
			}

			$q = new WP_Query( array(
				'post_type'      => 'product',
				'posts_per_page' => 24,
				'tax_query'      => $tax_query,
				'meta_query'     => $meta_query,
				'paged'          => max( 1, get_query_var( 'paged' ) ),
			) );

			if ( $q->have_posts() ) :
				?>
				<p class="results-count"><?php echo esc_html( sprintf( _n( '%s diamond found', '%s diamonds found', $q->found_posts, 'brilliance-jewelry' ), number_format_i18n( $q->found_posts ) ) ); ?></p>
				<ul class="products columns-4">
					<?php while ( $q->have_posts() ) : $q->the_post(); ?>
						<?php wc_get_template_part( 'content', 'product' ); ?>
					<?php endwhile; ?>
				</ul>
			<?php else : ?>
				<p class="results-empty"><?php esc_html_e( 'No diamonds match your criteria. Try widening the filters.', 'brilliance-jewelry' ); ?></p>
			<?php endif; wp_reset_postdata(); ?>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'brilliance_diamond_search', 'brilliance_diamond_search_shortcode' );
