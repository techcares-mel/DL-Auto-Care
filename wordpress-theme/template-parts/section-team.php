<?php
/**
 * Team section — WP_Query on 'team_member' CPT.
 * Featured Image = photo. _team_job_title meta = role. Post title = name.
 */

$eyebrow  = dl_get( 'dl_team_eyebrow', 'Meet the Team' );
$headline = dl_get( 'dl_team_headline', 'The People Behind the Work' );

$team = new WP_Query( array(
	'post_type'      => 'team_member',
	'posts_per_page' => -1,
	'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
) );
?>
<section id="team" class="sec team-sec">
	<div class="container">

		<p class="eyebrow animate animate-d1"><?php echo esc_html( $eyebrow ); ?></p>
		<h2 class="sec-title animate"><?php echo esc_html( $headline ); ?></h2>

		<?php if ( $team->have_posts() ) : ?>
		<div class="team-grid">
			<?php
			$i = 0;
			while ( $team->have_posts() ) :
				$team->the_post();
				$i++;
				$job_title = get_post_meta( get_the_ID(), '_team_job_title', true );
				$delay     = min( $i, 6 );
			?>
			<article class="team-card animate animate-d<?php echo esc_attr( $delay ); ?>">
				<div class="team-photo">
					<?php if ( has_post_thumbnail() ) : ?>
					<?php
					the_post_thumbnail( 'medium', array(
						'alt'     => esc_attr( get_the_title() ),
						'loading' => 'lazy',
					) );
					?>
					<?php else : ?>
					<svg class="team-placeholder" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
						<circle cx="50" cy="38" r="22" fill="#c8dea8"/>
						<ellipse cx="50" cy="92" rx="36" ry="28" fill="#c8dea8"/>
					</svg>
					<?php endif; ?>
				</div>
				<div class="team-info">
					<h3><?php the_title(); ?></h3>
					<?php if ( $job_title ) : ?>
					<p><?php echo esc_html( $job_title ); ?></p>
					<?php endif; ?>
				</div>
			</article>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>

		<?php else : ?>
		<?php if ( current_user_can( 'edit_posts' ) ) : ?>
		<p class="empty-state">No team members added yet. Go to
			<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=team_member' ) ); ?>">
				WP Admin &rarr; Team &rarr; Add New
			</a>.
		</p>
		<?php endif; ?>
		<?php endif; ?>

	</div>
</section>
