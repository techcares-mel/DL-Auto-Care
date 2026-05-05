<?php
/**
 * Gallery / Bento grid — 12-column CSS grid with two Customizer images.
 */

$img1 = dl_get( 'dl_gallery_image1', '' );
if ( ! $img1 ) {
	$img1 = get_template_directory_uri() . '/assets/images/image1.webp';
}
$img2 = dl_get( 'dl_gallery_image2', '' );
if ( ! $img2 ) {
	$img2 = get_template_directory_uri() . '/assets/images/image2.webp';
}
?>
<section id="gallery" class="sec gallery-sec">
	<div class="container">

		<p class="eyebrow animate animate-d1">Our Work</p>
		<h2 class="sec-title animate">See the Results</h2>

		<div class="bento-grid" aria-label="Photo gallery">

			<div class="bento-cell bento-main animate animate-d1">
				<img src="<?php echo esc_url( $img1 ); ?>"
					alt="DL Auto Care — engine and mechanical work"
					loading="lazy">
			</div>

			<div class="bento-cell bento-text1 animate animate-d2">
				<p class="bento-label">Panel Beating &amp; Smash Repair</p>
			</div>

			<div class="bento-cell bento-num animate animate-d3" aria-hidden="true">
				<span>10+</span>
				<small>Years in Braybrook</small>
			</div>

			<div class="bento-cell bento-sec animate animate-d4">
				<img src="<?php echo esc_url( $img2 ); ?>"
					alt="DL Auto Care mechanic at work"
					loading="lazy">
			</div>

			<div class="bento-cell bento-text2 animate animate-d5">
				<p class="bento-label">Spray Painting</p>
			</div>

			<div class="bento-cell bento-text3 animate animate-d6">
				<p class="bento-label">Engine &amp; Mechanical</p>
			</div>

		</div>
	</div>
</section>
