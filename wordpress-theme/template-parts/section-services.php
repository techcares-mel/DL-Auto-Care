<?php
/**
 * Services section — WP_Query on 'service' CPT.
 * First post = featured wide card. Last card = static CTA (always shown).
 */

$services = new WP_Query( array(
	'post_type'      => 'service',
	'posts_per_page' => -1,
	'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
) );
?>
<section id="services" class="sec services-sec">
	<div class="container">

		<p class="eyebrow animate animate-d1">What We Do</p>
		<h2 class="sec-title animate">Our Services</h2>

		<div class="services-grid">

			<?php
			$i        = 0;
			$is_first = true;
			if ( $services->have_posts() ) : ?><?php
			while ( $services->have_posts() ) :
				$services->the_post();
				$i++;
				$number     = get_post_meta( get_the_ID(), '_service_number', true );
				$desc       = get_post_meta( get_the_ID(), '_service_description', true );
				$delay      = min( $i, 6 );
				$card_class = $is_first
					? 'service-card service-card--featured animate animate-d' . $delay
					: 'service-card animate animate-d' . $delay;
				$display_n  = $number ? $number : str_pad( $i, 2, '0', STR_PAD_LEFT );
			?>
			<article class="<?php echo esc_attr( $card_class ); ?>" data-n="<?php echo esc_attr( $display_n ); ?>">
				<h3><?php the_title(); ?></h3>
				<?php if ( $desc ) : ?>
				<p><?php echo esc_html( $desc ); ?></p>
				<?php endif; ?>
			</article>
			<?php
				$is_first = false;
			endwhile;
			wp_reset_postdata();
			?>

			<?php else : ?>
			<?php if ( current_user_can( 'edit_posts' ) ) : ?>
			<div class="service-card service-card--empty">
				<p>No services added yet.</p>
				<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=service' ) ); ?>">Add your first service &rarr;</a>
			</div>
			<?php endif; ?>
			<?php endif; ?>

			<!-- Static CTA card — always shown last -->
			<article class="service-card service-card--cta animate animate-d<?php echo esc_attr( min( $i + 1, 6 ) ); ?>">
				<h3>Not Sure What You Need?</h3>
				<p>Give us a call — we&#8217;ll help you figure out exactly what your car needs and give you an honest quote.</p>
				<a href="#contact" class="btn btn-primary" style="margin-top:auto">Get in Touch</a>
			</article>

		</div>
	</div>
</section>
