<?php
/**
 * 404 — Page not found.
 */

get_header();
?>
<main id="main" role="main" class="not-found-wrap">
	<div class="container not-found-inner">
		<p class="eyebrow">404</p>
		<h1>Page Not Found</h1>
		<p>The page you&#8217;re looking for doesn&#8217;t exist or has been moved.</p>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">Back to Home</a>
	</div>
</main>
<?php
get_footer();
