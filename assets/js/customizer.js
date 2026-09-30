/**
 * Agrovia Customizer Live Preview
 *
 * Real-time customizer controls preview without page refreshes.
 *
 * @package Agrovia
 * @since 1.0.0
 */

(function ($) {
	'use strict';

	// Site title
	wp.customize('blogname', function (value) {
		value.bind(function (to) {
			$('.site-title a').text(to);
		});
	});

	// Site description
	wp.customize('blogdescription', function (value) {
		value.bind(function (to) {
			$('.site-description').text(to);
		});
	});

	// Header CTA button text
	wp.customize('agrovia_header_cta_text', function (value) {
		value.bind(function (to) {
			$('.btn-header-cta').html(to + ' <span class="cta-arrow" aria-hidden="true">&rarr;</span>');
		});
	});

	// Footer copyright
	wp.customize('agrovia_footer_copyright', function (value) {
		value.bind(function (to) {
			$('.copyright-custom-text').text(to);
		});
	});
})(jQuery);
