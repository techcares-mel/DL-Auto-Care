<?php
/**
 * Marquee strip — infinite scrolling service names. Editable via Customizer.
 */

$items_raw = dl_get(
	'dl_marquee_items',
	'Smash Repair, Spray Painting, Mechanical Repair, Windscreen Repair, Log Book Service, Panel Beating, Dent Removal, Wheel & Tyre, Engine Repair, Suspension'
);
$items = array_filter( array_map( 'trim', explode( ',', $items_raw ) ) );
if ( empty( $items ) ) {
	return;
}

$inner = '';
foreach ( $items as $item ) {
	$inner .= '<span class="marquee-item">' . esc_html( $item ) . '</span>'
		. '<span class="marquee-sep" aria-hidden="true">&#10022;</span>';
}
// Duplicate for seamless CSS animation loop
$inner = $inner . $inner;
?>
<section class="marquee-section" aria-hidden="true">
	<div class="marquee-track">
		<?php echo $inner; // Already escaped via esc_html above ?>
	</div>
</section>
