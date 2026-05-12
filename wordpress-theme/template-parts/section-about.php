<?php
/**
 * About section — 2-column layout with image, body text, stats, and CTA buttons.
 */

$eyebrow     = dl_get( 'dl_about_eyebrow', 'About Us' );
$headline    = dl_get( 'dl_about_headline', 'We Take Pride in Every Job' );
$p1          = dl_get( 'dl_about_p1', 'We\'re a family-run smash and mechanical repair workshop in Braybrook, serving Melbourne\'s west for over 15 years. Our experienced team treats every vehicle like their own.' );
$p2          = dl_get( 'dl_about_p2', 'From minor dents to full panel replacement, spray painting to log book servicing — we do it all with honesty and pride.' );
$btn_label   = dl_get( 'dl_about_btn_label', 'Book a Service' );
$img2        = dl_get( 'dl_gallery_image2', '' );
if ( ! $img2 ) {
	$img2 = get_template_directory_uri() . '/assets/images/image2.webp';
}
$phone       = dl_get( 'dl_contact_phone', '0423 310 713' );
$phone_clean = preg_replace( '/\s+/', '', $phone );

$s1v = dl_get( 'dl_about_stat1_v', '500+' );
$s1l = dl_get( 'dl_about_stat1_l', 'Cars Repaired' );
$s2v = dl_get( 'dl_about_stat2_v', '15 Yrs' );
$s2l = dl_get( 'dl_about_stat2_l', 'Experience' );
$s3v = dl_get( 'dl_about_stat3_v', '5★' );
$s3l = dl_get( 'dl_about_stat3_l', 'Google Rating' );
?>
<section id="about" class="sec about-sec">
	<div class="container about-grid">

		<div class="about-img animate-left">
			<img src="<?php echo esc_url( $img2 ); ?>"
				alt="DL Auto Care mechanic at work"
				loading="lazy">
		</div>

		<div class="about-body animate-right">
			<p class="eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
			<h2><?php echo esc_html( $headline ); ?></h2>

			<?php if ( $p1 ) : ?>
			<p><?php echo esc_html( $p1 ); ?></p>
			<?php endif; ?>

			<?php if ( $p2 ) : ?>
			<p><?php echo esc_html( $p2 ); ?></p>
			<?php endif; ?>

			<div class="about-stats" aria-label="Key stats">
				<div class="about-stat">
					<span class="stat-val"><?php echo esc_html( $s1v ); ?></span>
					<span class="stat-label"><?php echo esc_html( $s1l ); ?></span>
				</div>
				<div class="about-stat">
					<span class="stat-val"><?php echo esc_html( $s2v ); ?></span>
					<span class="stat-label"><?php echo esc_html( $s2l ); ?></span>
				</div>
				<div class="about-stat">
					<span class="stat-val"><?php echo esc_html( $s3v ); ?></span>
					<span class="stat-label"><?php echo esc_html( $s3l ); ?></span>
				</div>
			</div>

			<div class="about-buttons">
				<button class="btn btn-primary open-booking" type="button"><?php echo esc_html( $btn_label ); ?></button>
				<a href="tel:<?php echo esc_attr( $phone_clean ); ?>" class="btn btn-ghost"><?php echo esc_html( $phone ); ?></a>
			</div>
		</div>

	</div>
</section>
