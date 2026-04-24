(function ($) {
	'use strict';

	const App = {

		init() {
			this.cacheDom();
			this.bindEvents();
			this.initStickyHeader();
		},

		cacheDom() {
			this.$body         = $('body');
			this.$searchToggle = $('[data-search-toggle]');
			this.$searchPanel  = $('[data-search-panel]');
			this.$mobileToggle = $('.header-toggle');
			this.$mobileMenu   = $('#mobile-menu');
			this.$mobileClose  = $('.mobile-menu__close');
			this.$toast        = $('[data-toast]');
		},

		bindEvents() {
			this.$searchToggle.on('click', this.toggleSearch.bind(this));
			this.$mobileToggle.on('click', this.openMobileMenu.bind(this));
			this.$mobileClose.on('click', this.closeMobileMenu.bind(this));
			this.$mobileMenu.on('click', (e) => {
				if (e.target === this.$mobileMenu[0]) this.closeMobileMenu();
			});

			$(document).on('keyup', (e) => {
				if (e.key === 'Escape') {
					this.closeMobileMenu();
					this.closeSearch();
				}
			});

			$(document).on('click', '[data-wishlist-toggle]', this.toggleWishlist.bind(this));
			$(document).on('submit', '[data-newsletter-form]', this.submitNewsletter.bind(this));
			$(document).on('submit', '[data-contact-form]', this.submitContact.bind(this));
			$(document).on('click', '[data-quick-view]', this.openQuickView.bind(this));
		},

		initStickyHeader() {
			let lastY = window.scrollY;
			$(window).on('scroll', () => {
				const y = window.scrollY;
				$('.site-header').toggleClass('is-scrolled', y > 80);
				lastY = y;
			});
		},

		toggleSearch(e) {
			e && e.preventDefault();
			const isOpen = this.$searchPanel.hasClass('is-open');
			this.$searchPanel.toggleClass('is-open', !isOpen);
			if (!isOpen) {
				setTimeout(() => this.$searchPanel.find('input[type="search"]').trigger('focus'), 50);
			}
		},

		closeSearch() {
			this.$searchPanel.removeClass('is-open');
		},

		openMobileMenu() {
			this.$mobileMenu.addClass('is-open').attr('aria-hidden', 'false');
			this.$body.addClass('no-scroll');
		},

		closeMobileMenu() {
			this.$mobileMenu.removeClass('is-open').attr('aria-hidden', 'true');
			this.$body.removeClass('no-scroll');
		},

		toggleWishlist(e) {
			e.preventDefault();
			const $btn      = $(e.currentTarget);
			const productId = $btn.data('product-id');
			if (!productId) return;

			$.post(brilliance_vars.ajax_url, {
				action:     'brilliance_toggle_wishlist',
				nonce:      brilliance_vars.nonce,
				product_id: productId,
			}).done((res) => {
				if (!res.success) {
					this.showToast(res.data && res.data.message ? res.data.message : 'Error');
					return;
				}
				const isAdded = res.data.action === 'added';
				$(`[data-wishlist-toggle][data-product-id="${productId}"]`).each(function () {
					$(this).toggleClass('is-active', isAdded);
					const $label = $(this).find('.wishlist-btn__label');
					if ($label.length) {
						$label.text(isAdded ? 'Saved' : 'Save to wishlist');
					}
				});
				$('[data-wishlist-count]').text(res.data.count);
				this.showToast(isAdded ? brilliance_vars.i18n.added_to_wishlist : 'Removed from wishlist');
			});
		},

		submitNewsletter(e) {
			e.preventDefault();
			const $form    = $(e.currentTarget);
			const $message = $form.find('[data-newsletter-message]');
			const email    = $form.find('input[type="email"]').val();

			$message.removeClass('is-error is-success').text('');

			$.post(brilliance_vars.ajax_url, {
				action: 'brilliance_newsletter',
				nonce:  brilliance_vars.nonce,
				email:  email,
			}).done((res) => {
				if (res.success) {
					$message.addClass('is-success').text(res.data.message);
					$form[0].reset();
				} else {
					$message.addClass('is-error').text(res.data.message || 'Error');
				}
			}).fail(() => {
				$message.addClass('is-error').text('Network error, please try again.');
			});
		},

		submitContact(e) {
			e.preventDefault();
			const $form    = $(e.currentTarget);
			const $message = $form.find('[data-contact-message]');
			const $btn     = $form.find('button[type="submit"]');

			$message.removeClass('is-error is-success').text('');
			$btn.prop('disabled', true);

			$.post(brilliance_vars.ajax_url, {
				action:  'brilliance_contact',
				nonce:   brilliance_vars.nonce,
				name:    $form.find('[name="name"]').val(),
				email:   $form.find('[name="email"]').val(),
				subject: $form.find('[name="subject"]').val(),
				message: $form.find('[name="message"]').val(),
			}).done((res) => {
				$btn.prop('disabled', false);
				if (res.success) {
					$message.addClass('is-success').text(res.data.message);
					$form[0].reset();
				} else {
					$message.addClass('is-error').text(res.data.message || 'Error');
				}
			}).fail(() => {
				$btn.prop('disabled', false);
				$message.addClass('is-error').text('Network error, please try again.');
			});
		},

		openQuickView(e) {
			e.preventDefault();
			const $btn      = $(e.currentTarget);
			const productId = $btn.data('product-id');
			if (!productId) return;

			$.post(brilliance_vars.ajax_url, {
				action:     'brilliance_quick_view',
				nonce:      brilliance_vars.nonce,
				product_id: productId,
			}).done((res) => {
				if (!res.success) return;
				const $modal = $(`<div class="brilliance-modal" role="dialog" aria-modal="true">
					<div class="brilliance-modal__backdrop"></div>
					<div class="brilliance-modal__panel">
						<button class="brilliance-modal__close" aria-label="Close">&times;</button>
						${res.data.html}
					</div>
				</div>`);
				$('body').append($modal).addClass('no-scroll');
				$modal.on('click', '.brilliance-modal__backdrop, .brilliance-modal__close', () => {
					$modal.remove();
					$('body').removeClass('no-scroll');
				});
			});
		},

		showToast(message) {
			if (!this.$toast.length) return;
			this.$toast.text(message).addClass('is-visible');
			clearTimeout(this._toastTimer);
			this._toastTimer = setTimeout(() => {
				this.$toast.removeClass('is-visible');
			}, 2400);
		},
	};

	$(document).ready(() => App.init());

	$(document.body).on('added_to_cart', (e, fragments, hash, $btn) => {
		if (window.brilliance_vars) {
			const t = $('[data-toast]');
			t.text(brilliance_vars.i18n.added_to_cart).addClass('is-visible');
			setTimeout(() => t.removeClass('is-visible'), 2400);
		}
	});

})(jQuery);
