<?php
/**
 * Template Name: Contact
 *
 * @package BrillianceJewelry
 */
get_header(); ?>

<div class="container page-wrap">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Contact us', 'brilliance-jewelry' ); ?></h1>
		<p><?php esc_html_e( 'Our concierge team is here to help you find the perfect piece.', 'brilliance-jewelry' ); ?></p>
	</header>

	<div class="contact-grid">
		<div class="contact-form">
			<form data-contact-form>
				<div class="form-row">
					<label for="contact-name"><?php esc_html_e( 'Name', 'brilliance-jewelry' ); ?> *</label>
					<input id="contact-name" name="name" type="text" required>
				</div>
				<div class="form-row">
					<label for="contact-email"><?php esc_html_e( 'Email', 'brilliance-jewelry' ); ?> *</label>
					<input id="contact-email" name="email" type="email" required>
				</div>
				<div class="form-row">
					<label for="contact-subject"><?php esc_html_e( 'Subject', 'brilliance-jewelry' ); ?></label>
					<input id="contact-subject" name="subject" type="text">
				</div>
				<div class="form-row">
					<label for="contact-message"><?php esc_html_e( 'Message', 'brilliance-jewelry' ); ?> *</label>
					<textarea id="contact-message" name="message" rows="6" required></textarea>
				</div>
				<button type="submit" class="btn btn--primary"><?php esc_html_e( 'Send message', 'brilliance-jewelry' ); ?></button>
				<p class="newsletter-form__message" data-contact-message aria-live="polite"></p>
			</form>
		</div>

		<aside class="contact-info">
			<h3><?php esc_html_e( 'Get in touch', 'brilliance-jewelry' ); ?></h3>
			<ul>
				<li><strong><?php esc_html_e( 'Email', 'brilliance-jewelry' ); ?></strong><br><?php echo esc_html( get_option( 'admin_email' ) ); ?></li>
				<li><strong><?php esc_html_e( 'Phone', 'brilliance-jewelry' ); ?></strong><br>+1 (000) 000-0000</li>
				<li><strong><?php esc_html_e( 'Hours', 'brilliance-jewelry' ); ?></strong><br><?php esc_html_e( 'Monday – Saturday, 10:00 – 19:00', 'brilliance-jewelry' ); ?></li>
				<li><strong><?php esc_html_e( 'Address', 'brilliance-jewelry' ); ?></strong><br>Bucharest, Romania</li>
			</ul>

			<h3 style="margin-top:32px;"><?php esc_html_e( 'Book an appointment', 'brilliance-jewelry' ); ?></h3>
			<p><?php esc_html_e( 'Visit our showroom for a private consultation. Reservations recommended.', 'brilliance-jewelry' ); ?></p>
		</aside>
	</div>
</div>

<?php get_footer(); ?>
