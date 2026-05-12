<?php
/**
 * Contact section — 2-column layout with CTA buttons + info cards + Google Map.
 * All values from the WordPress Customizer.
 */

$eyebrow     = dl_get( 'dl_contact_eyebrow', 'Get In Touch' );
$headline    = dl_get( 'dl_contact_headline', 'Ready to Book?' );
$subtext     = dl_get( 'dl_contact_subtext', 'Bring your car in or give us a call. We\'ll give you an honest assessment and a fair quote — no surprises.' );
$phone       = dl_get( 'dl_contact_phone', '0423 310 713' );
$address     = dl_get( 'dl_contact_address', '2-3/9 Lacy St, Braybrook VIC 3019' );
$weekday     = dl_get( 'dl_contact_hours_weekday', 'Mon–Fri 8am–6pm' );
$saturday    = dl_get( 'dl_contact_hours_saturday', 'Sat 8am–2pm' );
$sunday      = dl_get( 'dl_contact_sunday', 'Sun Closed' );
$maps_url    = dl_get( 'dl_contact_maps_url', 'https://maps.google.com/?q=2-3/9+Lacy+St+Braybrook+VIC+3019' );
$maps_embed  = dl_get( 'dl_contact_maps_embed', '' );
$specs       = dl_get( 'dl_contact_specialties', 'Smash Repair · Mechanical · Spray Painting' );
$phone_clean = preg_replace( '/\s+/', '', $phone );
?>
<section id="contact" class="sec contact-sec">
	<div class="container contact-grid">

		<div class="contact-left">
			<p class="eyebrow animate animate-d1"><?php echo esc_html( $eyebrow ); ?></p>
			<h2 class="animate"><?php echo esc_html( $headline ); ?></h2>
			<p class="animate animate-d1"><?php echo esc_html( $subtext ); ?></p>
			<div class="contact-buttons animate animate-d2">
				<a href="tel:<?php echo esc_attr( $phone_clean ); ?>" class="btn btn-primary">
					Call <?php echo esc_html( $phone ); ?>
				</a>
				<a href="<?php echo esc_url( $maps_url ); ?>" class="btn btn-ghost"
					target="_blank" rel="noopener noreferrer">
					Get Directions
				</a>
			</div>
		</div>

		<div class="contact-right animate animate-d2">

			<div class="info-card">
				<span class="info-icon" aria-hidden="true">&#128205;</span>
				<div>
					<strong>Address</strong>
					<p><?php echo esc_html( $address ); ?></p>
				</div>
			</div>

			<div class="info-card">
				<span class="info-icon" aria-hidden="true">&#128222;</span>
				<div>
					<strong>Phone</strong>
					<p>
						<a href="tel:<?php echo esc_attr( $phone_clean ); ?>">
							<?php echo esc_html( $phone ); ?>
						</a>
					</p>
				</div>
			</div>

			<div class="info-card">
				<span class="info-icon" aria-hidden="true">&#128336;</span>
				<div>
					<strong>Hours</strong>
					<p><?php echo esc_html( $weekday ); ?></p>
					<p><?php echo esc_html( $saturday ); ?></p>
					<p><?php echo esc_html( $sunday ); ?></p>
				</div>
			</div>

			<div class="info-card">
				<span class="info-icon" aria-hidden="true">&#128295;</span>
				<div>
					<strong>Specialties</strong>
					<p><?php echo esc_html( $specs ); ?></p>
				</div>
			</div>

		</div>
	</div>

	<?php if ( $maps_embed ) : ?>
	<div class="container">
		<div class="contact-map animate">
			<iframe
				src="<?php echo esc_url( $maps_embed ); ?>"
				width="100%"
				height="380"
				style="border:0;"
				allowfullscreen
				loading="lazy"
				referrerpolicy="no-referrer-when-downgrade"
				title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> location on Google Maps">
			</iframe>
		</div>
	</div>
	<?php endif; ?>

</section>
