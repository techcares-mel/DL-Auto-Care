<?php
/**
 * Statement band — brand promise + 3 key stats. All editable via Customizer.
 */

$eyebrow = dl_get( 'dl_statement_eyebrow', 'Our Promise' );
$quote   = dl_get( 'dl_statement_quote', 'Quality work. Honest price. Every time.' );
$s1v     = dl_get( 'dl_statement_stat1_v', '500+' );
$s1l     = dl_get( 'dl_statement_stat1_l', 'Cars Repaired' );
$s2v     = dl_get( 'dl_statement_stat2_v', '15 Yrs' );
$s2l     = dl_get( 'dl_statement_stat2_l', 'Experience' );
$s3v     = dl_get( 'dl_statement_stat3_v', '5★' );
$s3l     = dl_get( 'dl_statement_stat3_l', 'Google Rating' );
?>
<section class="sec-g statement-sec" aria-label="Brand statement">
	<div class="container statement-inner">

		<div class="statement-text animate">
			<p class="eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
			<h2><?php echo esc_html( $quote ); ?></h2>
		</div>

		<div class="statement-stats" aria-label="Key stats">
			<div class="stat-item animate animate-d1">
				<span class="stat-val"><?php echo esc_html( $s1v ); ?></span>
				<span class="stat-label"><?php echo esc_html( $s1l ); ?></span>
			</div>
			<div class="stat-item animate animate-d2">
				<span class="stat-val"><?php echo esc_html( $s2v ); ?></span>
				<span class="stat-label"><?php echo esc_html( $s2l ); ?></span>
			</div>
			<div class="stat-item animate animate-d3">
				<span class="stat-val"><?php echo esc_html( $s3v ); ?></span>
				<span class="stat-label"><?php echo esc_html( $s3l ); ?></span>
			</div>
		</div>

	</div>
</section>
