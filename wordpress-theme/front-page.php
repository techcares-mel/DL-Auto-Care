<?php
/**
 * Homepage template — loads all section parts in order.
 */

get_header();
?>
<main id="main" role="main">
	<?php get_template_part( 'template-parts/section-hero' ); ?>
	<?php get_template_part( 'template-parts/section-marquee' ); ?>
	<?php get_template_part( 'template-parts/section-services' ); ?>
	<?php get_template_part( 'template-parts/section-statement' ); ?>
	<?php get_template_part( 'template-parts/section-about' ); ?>
	<?php get_template_part( 'template-parts/section-gallery' ); ?>
	<?php get_template_part( 'template-parts/section-testimonials' ); ?>
	<?php get_template_part( 'template-parts/section-team' ); ?>
	<?php get_template_part( 'template-parts/section-contact' ); ?>
</main>
<?php
get_footer();
