<?php
/**
 * Holiday Banner — rendered in header.php before the nav.
 * Only outputs HTML when the banner is enabled and within date range.
 */

if ( ! dl_should_show_banner() ) {
	return;
}

$type        = get_option( 'dl_banner_type', 'info' );
$message     = get_option( 'dl_banner_message', '' );
$dismissible = get_option( 'dl_banner_dismissible', 1 );
$start       = get_option( 'dl_banner_start', '' );
$banner_id   = md5( $message . $start );
$type_class  = 'dl-banner--' . sanitize_html_class( $type );
?>
<div id="dl-banner"
	class="dl-banner <?php echo esc_attr( $type_class ); ?>"
	role="alert"
	aria-live="polite"
	data-id="<?php echo esc_attr( $banner_id ); ?>">
	<div class="dl-banner__inner">
		<p class="dl-banner__msg"><?php echo esc_html( $message ); ?></p>
		<?php if ( $dismissible ) : ?>
		<button
			class="dl-banner__close"
			aria-label="Dismiss banner"
			onclick="window.dlDismissBanner('<?php echo esc_js( $banner_id ); ?>')">&#10005;</button>
		<?php endif; ?>
	</div>
</div>
