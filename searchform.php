<?php
/**
 * Accessible Search Form Template
 *
 * @package Agrovia
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

$agrovia_unique_id = wp_unique_id( 'search-form-' );
?>
<form role="search" method="get" class="search-form agrovia-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $agrovia_unique_id ); ?>" class="search-form-label">
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'agrovia' ); ?></span>
	</label>
	<div class="search-form-input-group">
		<input
			type="search"
			id="<?php echo esc_attr( $agrovia_unique_id ); ?>"
			class="search-field"
			placeholder="<?php echo esc_attr_x( 'Search crops, practices, insights…', 'placeholder', 'agrovia' ); ?>"
			value="<?php echo get_search_query(); ?>"
			name="s"
			required
		/>
		<button type="submit" class="search-submit agrovia-btn agrovia-btn-primary" aria-label="<?php echo esc_attr_x( 'Submit search', 'submit button', 'agrovia' ); ?>">
			<span class="search-submit-icon" aria-hidden="true">
				<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<circle cx="11" cy="11" r="8"></circle>
					<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
				</svg>
			</span>
			<span class="screen-reader-text"><?php echo esc_html_x( 'Search', 'submit button', 'agrovia' ); ?></span>
		</button>
	</div>
</form>
