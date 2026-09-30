/**
 * Agrovia Main Frontend Script
 *
 * @package Agrovia
 * @since 1.0.0
 */

(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		// Header elevation on scroll.
		const header = document.getElementById('masthead');
		if (header) {
			window.addEventListener('scroll', function () {
				if (window.scrollY > 20) {
					header.classList.add('is-scrolled');
				} else {
					header.classList.remove('is-scrolled');
				}
			}, { passive: true });
		}
	});
})();
