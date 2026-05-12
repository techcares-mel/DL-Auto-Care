<?php
/**
 * Fallback template — WordPress requires this file to exist.
 * The homepage is handled by front-page.php.
 * All other pages fall through to this template.
 */

get_header();
?>
<main id="main" role="main" style="min-height:60vh;display:flex;align-items:center;justify-content:center;padding:120px 24px;text-align:center;">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<h1><?php the_title(); ?></h1>
				<div><?php the_content(); ?></div>
			<?php endwhile; ?>
		<?php else : ?>
			<h1>Nothing here yet.</h1>
			<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">&larr; Back to Home</a></p>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
