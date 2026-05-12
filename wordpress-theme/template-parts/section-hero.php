<?php
/**
 * Hero section — full-viewport with background image, headline, CTA buttons.
 */

$h1      = dl_get( 'dl_hero_headline1', 'Done With' );
$h2      = dl_get( 'dl_hero_headline2', 'Satisfaction.' );
$sub     = dl_get( 'dl_hero_sub', 'Melbourne\'s trusted smash &amp; mechanical repair specialists.' );
$addr    = dl_get( 'dl_contact_address', '2-3/9 Lacy St, Braybrook VIC 3019' );
$eyebrow = dl_get( 'dl_hero_eyebrow', 'Smash & Mechanical' );
$btn1    = dl_get( 'dl_hero_btn1_label', 'Get a Quote' );
$btn2    = dl_get( 'dl_hero_btn2_label', 'Our Services' );
$tags_raw = dl_get( 'dl_hero_tags', 'Smash Repair, Spray Painting, Mechanical, Windscreen, Log Book' );
$tags    = array_filter( array_map( 'trim', explode( ',', $tags_raw ) ) );

$img1 = dl_get( 'dl_gallery_image1', '' );
if ( ! $img1 ) {
	$img1 = get_template_directory_uri() . '/assets/images/image1.webp';
}
?>
<section class="hero" aria-label="Hero">

	<div class="hero-bg" aria-hidden="true">
		<img src="<?php echo esc_url( $img1 ); ?>"
			alt=""
			fetchpriority="high"
			decoding="async">
		<div class="hero-overlay"></div>
	</div>

	<div class="container hero-body">

		<span class="eyebrow hero-eyebrow">
			<?php echo esc_html( $addr ); ?> &nbsp;&middot;&nbsp; <?php echo esc_html( $eyebrow ); ?>
		</span>

		<h1 class="hero-headline">
			<?php echo esc_html( $h1 ); ?><br>
			<em><?php echo esc_html( $h2 ); ?></em>
		</h1>

		<p class="hero-sub"><?php echo esc_html( $sub ); ?></p>

		<div class="hero-buttons">
			<button class="btn btn-primary open-quote" type="button"><?php echo esc_html( $btn1 ); ?></button>
			<a href="#services" class="btn btn-ghost"><?php echo esc_html( $btn2 ); ?></a>
		</div>

		<?php if ( $tags ) : ?>
		<div class="hero-tags" aria-label="Services at a glance">
			<?php foreach ( $tags as $tag ) : ?>
			<span class="tag"><?php echo esc_html( $tag ); ?></span>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

	</div>

	<div class="scroll-indicator" aria-hidden="true">
		<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false">
			<polyline points="6 9 12 15 18 9"/>
		</svg>
	</div>

</section>
