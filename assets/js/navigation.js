/**
 * Agrovia Navigation Script
 * Handles mobile drawer, accessible dropdown toggles, and keyboard focus trap.
 *
 * @package Agrovia
 * @since 1.0.0
 */

(function () {
	'use strict';

	const nav = document.getElementById('site-navigation');
	if (!nav) return;

	const toggle = nav.querySelector('.menu-toggle');
	const drawer = nav.querySelector('.menu-drawer-wrapper');
	const backdrop = document.querySelector('.menu-backdrop');
	if (!toggle || !drawer) return;

	/**
	 * Toggle Mobile Drawer Navigation.
	 */
	function openMobileMenu() {
		toggle.setAttribute('aria-expanded', 'true');
		nav.classList.add('is-open');
		if (backdrop) backdrop.classList.add('is-active');
		document.body.classList.add('menu-open');

		// Focus the first focusable link in the drawer.
		const firstFocusable = drawer.querySelector('a, button');
		if (firstFocusable) {
			firstFocusable.focus();
		}
	}

	function closeMobileMenu() {
		toggle.setAttribute('aria-expanded', 'false');
		nav.classList.remove('is-open');
		if (backdrop) backdrop.classList.remove('is-active');
		document.body.classList.remove('menu-open');
		toggle.focus();
	}

	toggle.addEventListener('click', function () {
		const isOpen = nav.classList.contains('is-open');
		if (isOpen) {
			closeMobileMenu();
		} else {
			openMobileMenu();
		}
	});

	if (backdrop) {
		backdrop.addEventListener('click', closeMobileMenu);
	}

	/**
	 * Accessible Submenu Dropdown Toggles.
	 */
	const dropdownToggles = nav.querySelectorAll('.dropdown-toggle');
	dropdownToggles.forEach(function (button) {
		button.addEventListener('click', function (e) {
			e.preventDefault();
			const parentItem = button.closest('.menu-item-has-children');
			if (!parentItem) return;

			const isSubOpen = parentItem.classList.contains('sub-menu-open');
			if (isSubOpen) {
				parentItem.classList.remove('sub-menu-open');
				button.setAttribute('aria-expanded', 'false');
			} else {
				parentItem.classList.add('sub-menu-open');
				button.setAttribute('aria-expanded', 'true');
			}
		});
	});

	/**
	 * Focus Trapping in Mobile Drawer & Escape Key Dismiss.
	 */
	document.addEventListener('keydown', function (e) {
		if (e.key === 'Escape') {
			if (nav.classList.contains('is-open')) {
				closeMobileMenu();
				return;
			}

			// Close any open desktop submenus on Escape.
			const openSubmenus = nav.querySelectorAll('.sub-menu-open');
			openSubmenus.forEach(function (item) {
				item.classList.remove('sub-menu-open');
				const btn = item.querySelector('.dropdown-toggle');
				if (btn) btn.setAttribute('aria-expanded', 'false');
			});
			return;
		}

		// Focus trap when mobile drawer is open.
		if (e.key === 'Tab' && nav.classList.contains('is-open')) {
			const focusableElements = drawer.querySelectorAll('a, button');
			if (focusableElements.length === 0) return;

			const firstElement = focusableElements[0];
			const lastElement = focusableElements[focusableElements.length - 1];

			if (e.shiftKey) {
				if (document.activeElement === firstElement || document.activeElement === toggle) {
					lastElement.focus();
					e.preventDefault();
				}
			} else {
				if (document.activeElement === lastElement) {
					firstElement.focus();
					e.preventDefault();
				}
			}
		}
	});

	/**
	 * Keyboard Navigation on Desktop (focus/blur handlers).
	 */
	const menuLinks = nav.querySelectorAll('a');
	menuLinks.forEach(function (link) {
		link.addEventListener('focus', function () {
			let parent = link.parentElement;
			while (parent && parent !== nav) {
				if (parent.tagName === 'LI') {
					parent.classList.add('focus');
				}
				parent = parent.parentElement;
			}
		});

		link.addEventListener('blur', function () {
			let parent = link.parentElement;
			while (parent && parent !== nav) {
				if (parent.tagName === 'LI') {
					parent.classList.remove('focus');
				}
				parent = parent.parentElement;
			}
		});
	});

	/**
	 * Reset on viewport resize across mobile breakpoint.
	 */
	window.addEventListener('resize', function () {
		if (window.innerWidth > 991 && nav.classList.contains('is-open')) {
			closeMobileMenu();
		}
	}, { passive: true });
})();
