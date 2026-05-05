<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php get_template_part( 'template-parts/section-banner' ); ?>

<nav id="nav" class="nav" role="navigation" aria-label="Main navigation">
	<div class="container nav-inner">

		<a class="nav-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php bloginfo( 'name' ); ?> — Home">
			<?php
			if ( has_custom_logo() ) {
				the_custom_logo();
			} else {
				?>
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>"
					alt="<?php bloginfo( 'name' ); ?>" height="57" width="auto">
				<?php
			}
			?>
		</a>

		<ul class="nav-links" role="list">
			<li><a href="#services" class="nav-link">Services</a></li>
			<li><a href="#about" class="nav-link">About</a></li>
			<li><a href="#gallery" class="nav-link">Gallery</a></li>
			<li><a href="#team" class="nav-link">Team</a></li>
			<li><a href="#contact" class="nav-link">Contact</a></li>
		</ul>

		<a href="#contact" class="btn btn-primary nav-cta">Book Now</a>

		<button id="burger" class="hamburger" aria-label="Open menu" aria-expanded="false" aria-controls="mobNav">
			<span aria-hidden="true"></span>
			<span aria-hidden="true"></span>
			<span aria-hidden="true"></span>
		</button>

	</div>
</nav>

<div id="mobNav" class="mob-nav" aria-label="Mobile navigation" aria-hidden="true">
	<button class="mob-nav__close mob-link" aria-label="Close menu">&#10005;</button>
	<ul role="list">
		<li><a href="#services" class="mob-link">Services</a></li>
		<li><a href="#about" class="mob-link">About</a></li>
		<li><a href="#gallery" class="mob-link">Gallery</a></li>
		<li><a href="#team" class="mob-link">Team</a></li>
		<li><a href="#contact" class="mob-link">Contact</a></li>
	</ul>
	<a href="#contact" class="btn btn-primary mob-link mob-cta">Book Now</a>
</div>
