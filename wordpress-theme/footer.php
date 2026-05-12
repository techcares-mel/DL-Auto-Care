<footer class="footer" role="contentinfo">
	<div class="container footer-grid">

		<div class="footer-brand animate animate-d1">
			<?php
			if ( has_custom_logo() ) {
				the_custom_logo();
			} else {
				?>
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>"
					alt="<?php bloginfo( 'name' ); ?>" height="48" width="auto" loading="lazy">
				<?php
			}
			?>
			<p class="footer-tagline"><?php echo esc_html( dl_get( 'dl_footer_tagline', 'Melbourne\'s trusted auto repair specialists. Honest advice, quality workmanship, every time.' ) ); ?></p>
		</div>

		<div class="footer-col animate animate-d2">
			<h4>Navigate</h4>
			<ul>
				<li><a href="#services">Services</a></li>
				<li><a href="#about">About</a></li>
				<li><a href="#gallery">Gallery</a></li>
				<li><a href="#team">Team</a></li>
				<li><a href="#contact">Contact</a></li>
			</ul>
		</div>

		<div class="footer-col animate animate-d3">
			<h4>Services</h4>
			<ul>
				<li><a href="#services">Smash Repair</a></li>
				<li><a href="#services">Mechanical Repair</a></li>
				<li><a href="#services">Spray Painting</a></li>
				<li><a href="#services">Windscreen Repair</a></li>
				<li><a href="#services">Wheel &amp; Tyre</a></li>
				<li><a href="#services">Log Book Service</a></li>
			</ul>
		</div>

	</div>

	<div class="footer-bar">
		<div class="container">
			<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> DL Auto Care Pty Ltd &middot; <?php echo esc_html( dl_get( 'dl_contact_address', '2-3/9 Lacy St, Braybrook VIC 3019' ) ); ?></p>
		</div>
	</div>
</footer>

<!-- ═══ BACK TO TOP ════════════════════════════════════════════════ -->
<button class="back-top" id="backTop" aria-label="Back to top" title="Back to top">
	<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
		<polyline points="18 15 12 9 6 15"/>
	</svg>
</button>

<!-- ═══ MECHANICDESK BOOKING MODAL ════════════════════════════════ -->
<div class="booking-overlay" id="bookingOverlay" role="dialog" aria-modal="true" aria-label="Online Booking">
	<div class="booking-box">
		<div class="booking-header">
			<div class="booking-header-text">
				<h3>Book a Service</h3>
				<p>Fill in your details and we&#8217;ll confirm your appointment shortly.</p>
			</div>
			<button class="booking-close" id="bookingClose" aria-label="Close booking" type="button">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true" focusable="false"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
			</button>
		</div>
		<iframe class="booking-iframe" src="about:blank"
			data-src="https://www.mechanicdesk.com.au/online-booking/75d4c8e7552f8e3c612a6cd966e771ba8296a332"
			title="Online Booking"></iframe>
	</div>
</div>

<!-- ═══ GET A QUOTE MODAL (Contact Form 7) ════════════════════════ -->
<div class="quote-overlay" id="quoteOverlay" role="dialog" aria-modal="true" aria-label="Get a Quote">
	<div class="quote-box">
		<div class="quote-header">
			<div class="quote-header-text">
				<h3>Get a Quote</h3>
				<p>We&#8217;ll get back to you within 24 hours.</p>
			</div>
			<button class="quote-close" id="quoteClose" aria-label="Close" type="button">
				<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" aria-hidden="true" focusable="false"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
			</button>
		</div>
		<div class="quote-body">
			<?php
			$cf7_id = absint( get_theme_mod( 'dl_cf7_quote_form_id', 0 ) );
			if ( $cf7_id && function_exists( 'wpcf7_contact_form' ) ) {
				echo do_shortcode( '[contact-form-7 id="' . $cf7_id . '"]' );
			} else {
				echo '<p class="quote-placeholder">Contact form not yet configured. Go to <strong>Appearance &rarr; Customize &rarr; Contact &amp; Hours</strong> and enter your CF7 form ID after installing Contact Form 7.</p>';
			}
			?>
		</div>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>
