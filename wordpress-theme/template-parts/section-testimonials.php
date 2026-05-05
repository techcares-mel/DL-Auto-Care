<?php
/**
 * Testimonials section — WP_Query on 'testimonial' CPT.
 * Desktop: 3-column grid. Mobile: CSS scroll-snap carousel.
 */

$testimonials = new WP_Query( array(
	'post_type'      => 'testimonial',
	'posts_per_page' => -1,
	'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
) );
?>
<section id="testimonials" class="sec testimonials-sec">
	<div class="container">

		<p class="eyebrow animate animate-d1">Reviews</p>
		<h2 class="sec-title animate">What Our Customers Say</h2>

		<?php if ( $testimonials->have_posts() ) : ?>
		<div class="testimonials-grid">
			<?php
			$i = 0;
			while ( $testimonials->have_posts() ) :
				$testimonials->the_post();
				$i++;
				$quote   = get_post_meta( get_the_ID(), '_testimonial_quote', true );
				$suburb  = get_post_meta( get_the_ID(), '_testimonial_suburb', true );
				$name    = get_the_title();
				$initial = mb_strtoupper( mb_substr( $name, 0, 1, 'UTF-8' ), 'UTF-8' );
				$delay   = min( $i, 6 );
			?>
			<article class="testimonial-card animate animate-d<?php echo esc_attr( $delay ); ?>">
				<div class="stars" aria-label="5 out of 5 stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
				<?php if ( $quote ) : ?>
				<blockquote>
					<p><?php echo esc_html( $quote ); ?></p>
				</blockquote>
				<?php endif; ?>
				<footer class="testimonial-footer">
					<div class="avatar" aria-hidden="true"><?php echo esc_html( $initial ); ?></div>
					<div class="testimonial-meta">
						<strong><?php echo esc_html( $name ); ?></strong>
						<?php if ( $suburb ) : ?>
						<span><?php echo esc_html( $suburb ); ?></span>
						<?php endif; ?>
					</div>
				</footer>
			</article>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>

		<?php else : ?>
		<?php if ( current_user_can( 'edit_posts' ) ) : ?>
		<p class="empty-state">No testimonials added yet. Go to
			<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=testimonial' ) ); ?>">
				WP Admin &rarr; Testimonials &rarr; Add New
			</a>.
		</p>
		<?php endif; ?>
		<?php endif; ?>

	</div>
</section>
