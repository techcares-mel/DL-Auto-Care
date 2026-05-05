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
			<p class="footer-tagline">Done With Satisfaction</p>
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

<?php wp_footer(); ?>
</body>
</html>
