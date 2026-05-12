<?php
/**
 * DL Auto Care — Theme Functions
 * Zero plugin dependency. All features use native WordPress APIs.
 */

// ── Theme Setup ───────────────────────────────────────────────────────────────
add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 57,
		'flex-height' => true,
		'flex-width'  => true,
	) );
} );

// ── Assets ────────────────────────────────────────────────────────────────────
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'dl-fonts',
		'https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Inter:wght@400;500;600&display=swap',
		array(),
		null
	);
	wp_enqueue_style(
		'dl-style',
		get_stylesheet_uri(),
		array( 'dl-fonts' ),
		filemtime( get_stylesheet_directory() . '/style.css' )
	);
	wp_enqueue_script(
		'dl-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		filemtime( get_template_directory() . '/assets/js/main.js' ),
		true
	);
} );

// ── Helper: get Customizer value with fallback ────────────────────────────────
function dl_get( $key, $default = '' ) {
	return get_theme_mod( $key, $default );
}

// ── Helper: should holiday banner show? ──────────────────────────────────────
function dl_should_show_banner() {
	if ( ! get_option( 'dl_banner_enabled' ) ) {
		return false;
	}
	$msg = get_option( 'dl_banner_message', '' );
	if ( '' === trim( $msg ) ) {
		return false;
	}
	$today = current_time( 'Y-m-d' );
	$start = get_option( 'dl_banner_start', '' );
	$end   = get_option( 'dl_banner_end', '' );
	if ( $start && $today < $start ) {
		return false;
	}
	if ( $end && $today > $end ) {
		return false;
	}
	return true;
}

// ── Body class: add has-banner when banner is active ─────────────────────────
add_filter( 'body_class', function ( $classes ) {
	if ( dl_should_show_banner() ) {
		$classes[] = 'has-banner';
	}
	return $classes;
} );

// ── Register Custom Post Types ────────────────────────────────────────────────
add_action( 'init', function () {

	// Services
	register_post_type( 'service', array(
		'labels'        => array(
			'name'          => 'Services',
			'singular_name' => 'Service',
			'add_new_item'  => 'Add New Service',
			'edit_item'     => 'Edit Service',
			'all_items'     => 'All Services',
		),
		'public'        => false,
		'show_ui'       => true,
		'show_in_menu'  => true,
		'menu_icon'     => 'dashicons-car',
		'menu_position' => 20,
		'supports'      => array( 'title', 'page-attributes' ),
		'rewrite'       => false,
		'show_in_rest'  => false,
	) );

	// Testimonials
	register_post_type( 'testimonial', array(
		'labels'        => array(
			'name'          => 'Testimonials',
			'singular_name' => 'Testimonial',
			'add_new_item'  => 'Add New Testimonial',
			'edit_item'     => 'Edit Testimonial',
			'all_items'     => 'All Testimonials',
		),
		'public'        => false,
		'show_ui'       => true,
		'show_in_menu'  => true,
		'menu_icon'     => 'dashicons-format-quote',
		'menu_position' => 21,
		'supports'      => array( 'title', 'page-attributes' ),
		'rewrite'       => false,
		'show_in_rest'  => false,
	) );

	// Team Members
	register_post_type( 'team_member', array(
		'labels'        => array(
			'name'          => 'Team',
			'singular_name' => 'Team Member',
			'add_new_item'  => 'Add New Team Member',
			'edit_item'     => 'Edit Team Member',
			'all_items'     => 'All Team Members',
		),
		'public'        => false,
		'show_ui'       => true,
		'show_in_menu'  => true,
		'menu_icon'     => 'dashicons-groups',
		'menu_position' => 22,
		'supports'      => array( 'title', 'thumbnail', 'page-attributes' ),
		'rewrite'       => false,
		'show_in_rest'  => false,
	) );
} );

// ── Meta Boxes ────────────────────────────────────────────────────────────────
add_action( 'add_meta_boxes', function () {
	add_meta_box( 'dl_service_details', 'Service Details', 'dl_service_meta_box', 'service', 'normal', 'high' );
	add_meta_box( 'dl_testimonial_details', 'Testimonial Details', 'dl_testimonial_meta_box', 'testimonial', 'normal', 'high' );
	add_meta_box( 'dl_team_details', 'Team Member Details', 'dl_team_meta_box', 'team_member', 'normal', 'high' );
} );

function dl_service_meta_box( $post ) {
	wp_nonce_field( 'dl_service_save', 'dl_service_nonce' );
	$number = get_post_meta( $post->ID, '_service_number', true );
	$desc   = get_post_meta( $post->ID, '_service_description', true );
	?>
	<table class="form-table">
		<tr>
			<th><label for="dl_service_number">Display Number</label></th>
			<td>
				<input type="text" id="dl_service_number" name="dl_service_number"
					value="<?php echo esc_attr( $number ); ?>" class="regular-text"
					placeholder="e.g. 01">
				<p class="description">Short label shown on the card (e.g. 01).</p>
			</td>
		</tr>
		<tr>
			<th><label for="dl_service_description">Description</label></th>
			<td>
				<textarea id="dl_service_description" name="dl_service_description"
					rows="4" class="large-text"><?php echo esc_textarea( $desc ); ?></textarea>
				<p class="description">One to two sentences describing the service.</p>
			</td>
		</tr>
	</table>
	<?php
}

function dl_testimonial_meta_box( $post ) {
	wp_nonce_field( 'dl_testimonial_save', 'dl_testimonial_nonce' );
	$quote  = get_post_meta( $post->ID, '_testimonial_quote', true );
	$suburb = get_post_meta( $post->ID, '_testimonial_suburb', true );
	?>
	<table class="form-table">
		<tr>
			<th><label for="dl_testimonial_quote">Quote</label></th>
			<td>
				<textarea id="dl_testimonial_quote" name="dl_testimonial_quote"
					rows="4" class="large-text"><?php echo esc_textarea( $quote ); ?></textarea>
				<p class="description">The customer review text.</p>
			</td>
		</tr>
		<tr>
			<th><label for="dl_testimonial_suburb">Suburb</label></th>
			<td>
				<input type="text" id="dl_testimonial_suburb" name="dl_testimonial_suburb"
					value="<?php echo esc_attr( $suburb ); ?>" class="regular-text"
					placeholder="e.g. Footscray">
				<p class="description">Customer&#8217;s suburb (shown on the card).</p>
			</td>
		</tr>
	</table>
	<p class="description" style="padding:0 12px"><strong>Customer name</strong> is the post title above.</p>
	<?php
}

function dl_team_meta_box( $post ) {
	wp_nonce_field( 'dl_team_save', 'dl_team_nonce' );
	$title = get_post_meta( $post->ID, '_team_job_title', true );
	?>
	<table class="form-table">
		<tr>
			<th><label for="dl_team_job_title">Job Title / Role</label></th>
			<td>
				<input type="text" id="dl_team_job_title" name="dl_team_job_title"
					value="<?php echo esc_attr( $title ); ?>" class="regular-text"
					placeholder="e.g. Lead Mechanic">
			</td>
		</tr>
	</table>
	<p class="description" style="padding:0 12px">
		<strong>Name</strong> is the post title above.
		Use <em>Featured Image</em> (bottom right of this page) for the team member&#8217;s photo.
	</p>
	<?php
}

// ── Save Meta ─────────────────────────────────────────────────────────────────
add_action( 'save_post_service', function ( $post_id ) {
	if ( ! isset( $_POST['dl_service_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( sanitize_key( $_POST['dl_service_nonce'] ), 'dl_service_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	update_post_meta(
		$post_id,
		'_service_number',
		sanitize_text_field( wp_unslash( isset( $_POST['dl_service_number'] ) ? $_POST['dl_service_number'] : '' ) )
	);
	update_post_meta(
		$post_id,
		'_service_description',
		sanitize_textarea_field( wp_unslash( isset( $_POST['dl_service_description'] ) ? $_POST['dl_service_description'] : '' ) )
	);
} );

add_action( 'save_post_testimonial', function ( $post_id ) {
	if ( ! isset( $_POST['dl_testimonial_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( sanitize_key( $_POST['dl_testimonial_nonce'] ), 'dl_testimonial_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	update_post_meta(
		$post_id,
		'_testimonial_quote',
		sanitize_textarea_field( wp_unslash( isset( $_POST['dl_testimonial_quote'] ) ? $_POST['dl_testimonial_quote'] : '' ) )
	);
	update_post_meta(
		$post_id,
		'_testimonial_suburb',
		sanitize_text_field( wp_unslash( isset( $_POST['dl_testimonial_suburb'] ) ? $_POST['dl_testimonial_suburb'] : '' ) )
	);
} );

add_action( 'save_post_team_member', function ( $post_id ) {
	if ( ! isset( $_POST['dl_team_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( sanitize_key( $_POST['dl_team_nonce'] ), 'dl_team_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	update_post_meta(
		$post_id,
		'_team_job_title',
		sanitize_text_field( wp_unslash( isset( $_POST['dl_team_job_title'] ) ? $_POST['dl_team_job_title'] : '' ) )
	);
} );

// ── WordPress Customizer ──────────────────────────────────────────────────────
add_action( 'customize_register', function ( $wp_customize ) {

	// ── Panel: Hero ──────────────────────────────────────────────────────────
	$wp_customize->add_panel( 'dl_hero_panel', array(
		'title'    => 'Hero Section',
		'priority' => 30,
	) );
	$wp_customize->add_section( 'dl_hero', array(
		'title' => 'Hero Text',
		'panel' => 'dl_hero_panel',
	) );

	$hero_fields = array(
		'dl_hero_headline1' => array( 'label' => 'Headline Line 1', 'default' => 'Done With' ),
		'dl_hero_headline2' => array( 'label' => 'Headline Line 2 (shown in green)', 'default' => 'Satisfaction.' ),
		'dl_hero_sub'       => array( 'label' => 'Sub-headline', 'default' => 'Melbourne\'s trusted smash & mechanical repair specialists.' ),
	);
	foreach ( $hero_fields as $id => $args ) {
		$wp_customize->add_setting( $id, array( 'default' => $args['default'], 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_control( $id, array( 'label' => $args['label'], 'section' => 'dl_hero', 'type' => 'text' ) );
	}

	// ── Panel: About ─────────────────────────────────────────────────────────
	$wp_customize->add_panel( 'dl_about_panel', array(
		'title'    => 'About Section',
		'priority' => 31,
	) );
	$wp_customize->add_section( 'dl_about', array(
		'title' => 'About Text & Stats',
		'panel' => 'dl_about_panel',
	) );

	$wp_customize->add_setting( 'dl_about_p1', array(
		'default'           => 'We\'re a family-run smash and mechanical repair workshop in Braybrook, serving Melbourne\'s west for over 15 years. Our experienced team treats every vehicle like their own.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'dl_about_p1', array(
		'label'   => 'Paragraph 1',
		'section' => 'dl_about',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'dl_about_p2', array(
		'default'           => 'From minor dents to full panel replacement, spray painting to log book servicing — we do it all with honesty and pride.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'dl_about_p2', array(
		'label'   => 'Paragraph 2',
		'section' => 'dl_about',
		'type'    => 'textarea',
	) );

	$stats = array(
		1 => array( 'v' => '500+', 'l' => 'Cars Repaired' ),
		2 => array( 'v' => '15 Yrs', 'l' => 'Experience' ),
		3 => array( 'v' => '5★', 'l' => 'Google Rating' ),
	);
	foreach ( $stats as $n => $defaults ) {
		$wp_customize->add_setting( "dl_about_stat{$n}_v", array( 'default' => $defaults['v'], 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_control( "dl_about_stat{$n}_v", array( 'label' => "Stat {$n} — Value", 'section' => 'dl_about', 'type' => 'text' ) );
		$wp_customize->add_setting( "dl_about_stat{$n}_l", array( 'default' => $defaults['l'], 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_control( "dl_about_stat{$n}_l", array( 'label' => "Stat {$n} — Label", 'section' => 'dl_about', 'type' => 'text' ) );
	}

	// ── Panel: Gallery / Images ──────────────────────────────────────────────
	$wp_customize->add_panel( 'dl_gallery_panel', array(
		'title'    => 'Gallery & Images',
		'priority' => 32,
	) );
	$wp_customize->add_section( 'dl_images', array(
		'title'       => 'Site Images',
		'panel'       => 'dl_gallery_panel',
		'description' => 'Upload your own photos here. They appear in the hero background, about section, and gallery grid.',
	) );

	$wp_customize->add_setting( 'dl_gallery_image1', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'dl_gallery_image1', array(
		'label'       => 'Main Image (Hero background & gallery)',
		'description' => 'Best: wide landscape photo of the workshop or a car being worked on.',
		'section'     => 'dl_images',
	) ) );

	$wp_customize->add_setting( 'dl_gallery_image2', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'dl_gallery_image2', array(
		'label'       => 'Secondary Image (About section & gallery)',
		'description' => 'Best: portrait/tall photo of the team or a mechanic at work.',
		'section'     => 'dl_images',
	) ) );

	// ── Panel: Contact & Hours ───────────────────────────────────────────────
	$wp_customize->add_panel( 'dl_contact_panel', array(
		'title'    => 'Contact & Hours',
		'priority' => 33,
	) );
	$wp_customize->add_section( 'dl_contact', array(
		'title' => 'Contact Details',
		'panel' => 'dl_contact_panel',
	) );

	$contact_fields = array(
		'dl_contact_address'        => array( 'label' => 'Street Address', 'default' => '2-3/9 Lacy St, Braybrook VIC 3019' ),
		'dl_contact_phone'          => array( 'label' => 'Phone Number', 'default' => '0423 310 713' ),
		'dl_contact_hours_weekday'  => array( 'label' => 'Weekday Hours', 'default' => 'Mon–Fri 8am–6pm' ),
		'dl_contact_hours_saturday' => array( 'label' => 'Saturday Hours', 'default' => 'Sat 8am–2pm' ),
		'dl_contact_maps_url'       => array( 'label' => 'Google Maps Directions URL', 'default' => 'https://maps.google.com/?q=2-3/9+Lacy+St+Braybrook+VIC+3019' ),
		'dl_contact_specialties'    => array( 'label' => 'Specialties (shown in contact box)', 'default' => 'Smash Repair · Mechanical · Spray Painting' ),
	);
	foreach ( $contact_fields as $id => $args ) {
		$wp_customize->add_setting( $id, array( 'default' => $args['default'], 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_control( $id, array( 'label' => $args['label'], 'section' => 'dl_contact', 'type' => 'text' ) );
	}

	// Contact section headings + Sunday label
	$wp_customize->add_setting( 'dl_contact_eyebrow', array( 'default' => 'Get In Touch', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'dl_contact_eyebrow', array( 'label' => 'Section Eyebrow', 'section' => 'dl_contact', 'type' => 'text' ) );
	$wp_customize->add_setting( 'dl_contact_headline', array( 'default' => 'Ready to Book?', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'dl_contact_headline', array( 'label' => 'Section Headline', 'section' => 'dl_contact', 'type' => 'text' ) );
	$wp_customize->add_setting( 'dl_contact_subtext', array(
		'default'           => 'Bring your car in or give us a call. We\'ll give you an honest assessment and a fair quote — no surprises.',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'dl_contact_subtext', array( 'label' => 'Sub-text', 'section' => 'dl_contact', 'type' => 'textarea' ) );
	$wp_customize->add_setting( 'dl_contact_sunday', array( 'default' => 'Sun Closed', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'dl_contact_sunday', array( 'label' => 'Sunday Hours Label', 'section' => 'dl_contact', 'type' => 'text' ) );

	// Google Maps embed URL (separate from directions link — use the iframe src)
	$wp_customize->add_setting( 'dl_contact_maps_embed', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( 'dl_contact_maps_embed', array(
		'label'       => 'Google Maps Embed URL',
		'description' => 'Get this from Google Maps → Share → Embed a map → copy the src value from the iframe code. Leave blank to hide the map.',
		'section'     => 'dl_contact',
		'type'        => 'url',
	) );

	// CF7 quote form ID
	$wp_customize->add_setting( 'dl_cf7_quote_form_id', array( 'default' => '', 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control( 'dl_cf7_quote_form_id', array(
		'label'       => 'Get a Quote — CF7 Form ID',
		'description' => 'After installing Contact Form 7, go to Contact → Contact Forms and paste the form ID number here.',
		'section'     => 'dl_contact',
		'type'        => 'number',
	) );

	// ── Hero: extra fields ───────────────────────────────────────────────────────
	$wp_customize->add_setting( 'dl_hero_eyebrow', array( 'default' => 'Smash & Mechanical', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'dl_hero_eyebrow', array( 'label' => 'Eyebrow (beside address)', 'section' => 'dl_hero', 'type' => 'text' ) );
	$wp_customize->add_setting( 'dl_hero_btn1_label', array( 'default' => 'Get a Quote', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'dl_hero_btn1_label', array( 'label' => 'Primary Button Label', 'section' => 'dl_hero', 'type' => 'text' ) );
	$wp_customize->add_setting( 'dl_hero_btn2_label', array( 'default' => 'Our Services', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'dl_hero_btn2_label', array( 'label' => 'Ghost Button Label', 'section' => 'dl_hero', 'type' => 'text' ) );
	$wp_customize->add_setting( 'dl_hero_tags', array(
		'default'           => 'Smash Repair, Spray Painting, Mechanical, Windscreen, Log Book',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'dl_hero_tags', array(
		'label'       => 'Hero Tag Pills',
		'description' => 'Comma-separated list of service highlights shown below the buttons.',
		'section'     => 'dl_hero',
		'type'        => 'text',
	) );

	// ── Panel: Marquee ───────────────────────────────────────────────────────────
	$wp_customize->add_panel( 'dl_marquee_panel', array( 'title' => 'Marquee Strip', 'priority' => 34 ) );
	$wp_customize->add_section( 'dl_marquee', array( 'title' => 'Marquee Items', 'panel' => 'dl_marquee_panel',
		'description' => 'Comma-separated service names that scroll across the green strip.' ) );
	$wp_customize->add_setting( 'dl_marquee_items', array(
		'default'           => 'Smash Repair, Spray Painting, Mechanical Repair, Windscreen Repair, Log Book Service, Panel Beating, Dent Removal, Wheel & Tyre, Engine Repair, Suspension',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'dl_marquee_items', array( 'label' => 'Service Names (comma-separated)', 'section' => 'dl_marquee', 'type' => 'textarea' ) );

	// ── Panel: Services Section ──────────────────────────────────────────────────
	$wp_customize->add_panel( 'dl_services_panel', array( 'title' => 'Services Section', 'priority' => 35 ) );
	$wp_customize->add_section( 'dl_services_sec', array( 'title' => 'Section Text & CTA Card', 'panel' => 'dl_services_panel' ) );
	$svc_fields = array(
		'dl_services_eyebrow'  => array( 'label' => 'Eyebrow', 'default' => 'What We Do' ),
		'dl_services_headline' => array( 'label' => 'Headline', 'default' => 'Our Services' ),
		'dl_services_cta_title'=> array( 'label' => 'CTA Card — Title', 'default' => 'Not Sure What You Need?' ),
		'dl_services_cta_desc' => array( 'label' => 'CTA Card — Description', 'default' => 'Give us a call — we\'ll help you figure out exactly what your car needs and give you an honest quote.' ),
		'dl_services_cta_btn'  => array( 'label' => 'CTA Card — Button Label', 'default' => 'Get in Touch' ),
	);
	foreach ( $svc_fields as $id => $args ) {
		$wp_customize->add_setting( $id, array( 'default' => $args['default'], 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_control( $id, array( 'label' => $args['label'], 'section' => 'dl_services_sec', 'type' => 'text' ) );
	}

	// ── Panel: Statement Band ────────────────────────────────────────────────────
	$wp_customize->add_panel( 'dl_statement_panel', array( 'title' => 'Statement Band', 'priority' => 36 ) );
	$wp_customize->add_section( 'dl_statement', array( 'title' => 'Promise & Stats', 'panel' => 'dl_statement_panel' ) );
	$wp_customize->add_setting( 'dl_statement_eyebrow', array( 'default' => 'Our Promise', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'dl_statement_eyebrow', array( 'label' => 'Eyebrow', 'section' => 'dl_statement', 'type' => 'text' ) );
	$wp_customize->add_setting( 'dl_statement_quote', array( 'default' => 'Quality work. Honest price. Every time.', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'dl_statement_quote', array( 'label' => 'Brand Promise Quote', 'section' => 'dl_statement', 'type' => 'text' ) );
	$stmt_stats = array(
		1 => array( 'v' => '500+', 'l' => 'Cars Repaired' ),
		2 => array( 'v' => '15 Yrs', 'l' => 'Experience' ),
		3 => array( 'v' => '5★', 'l' => 'Google Rating' ),
	);
	foreach ( $stmt_stats as $n => $d ) {
		$wp_customize->add_setting( "dl_statement_stat{$n}_v", array( 'default' => $d['v'], 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_control( "dl_statement_stat{$n}_v", array( 'label' => "Stat {$n} — Value", 'section' => 'dl_statement', 'type' => 'text' ) );
		$wp_customize->add_setting( "dl_statement_stat{$n}_l", array( 'default' => $d['l'], 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_control( "dl_statement_stat{$n}_l", array( 'label' => "Stat {$n} — Label", 'section' => 'dl_statement', 'type' => 'text' ) );
	}

	// ── About: extra fields ──────────────────────────────────────────────────────
	$wp_customize->add_setting( 'dl_about_eyebrow', array( 'default' => 'About Us', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'dl_about_eyebrow', array( 'label' => 'Eyebrow', 'section' => 'dl_about', 'type' => 'text' ) );
	$wp_customize->add_setting( 'dl_about_headline', array( 'default' => 'We Take Pride in Every Job', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'dl_about_headline', array( 'label' => 'Section Headline', 'section' => 'dl_about', 'type' => 'text' ) );
	$wp_customize->add_setting( 'dl_about_btn_label', array( 'default' => 'Book a Service', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'dl_about_btn_label', array( 'label' => 'Primary Button Label', 'section' => 'dl_about', 'type' => 'text' ) );

	// ── Gallery: section text ────────────────────────────────────────────────────
	$wp_customize->add_setting( 'dl_gallery_eyebrow', array( 'default' => 'Our Work', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'dl_gallery_eyebrow', array( 'label' => 'Gallery Section Eyebrow', 'section' => 'dl_images', 'type' => 'text' ) );
	$wp_customize->add_setting( 'dl_gallery_headline', array( 'default' => 'See the Results', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'dl_gallery_headline', array( 'label' => 'Gallery Section Headline', 'section' => 'dl_images', 'type' => 'text' ) );

	// ── Panel: Team Section ──────────────────────────────────────────────────────
	$wp_customize->add_panel( 'dl_team_panel', array( 'title' => 'Team Section', 'priority' => 37 ) );
	$wp_customize->add_section( 'dl_team_sec', array( 'title' => 'Section Headings', 'panel' => 'dl_team_panel' ) );
	$wp_customize->add_setting( 'dl_team_eyebrow', array( 'default' => 'Meet the Team', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'dl_team_eyebrow', array( 'label' => 'Eyebrow', 'section' => 'dl_team_sec', 'type' => 'text' ) );
	$wp_customize->add_setting( 'dl_team_headline', array( 'default' => 'The People Behind the Work', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'dl_team_headline', array( 'label' => 'Headline', 'section' => 'dl_team_sec', 'type' => 'text' ) );

	// ── Panel: Testimonials Section ──────────────────────────────────────────────
	$wp_customize->add_panel( 'dl_testimonials_panel', array( 'title' => 'Testimonials Section', 'priority' => 38 ) );
	$wp_customize->add_section( 'dl_testimonials_sec', array( 'title' => 'Section Headings', 'panel' => 'dl_testimonials_panel' ) );
	$wp_customize->add_setting( 'dl_testimonials_eyebrow', array( 'default' => 'Reviews', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'dl_testimonials_eyebrow', array( 'label' => 'Eyebrow', 'section' => 'dl_testimonials_sec', 'type' => 'text' ) );
	$wp_customize->add_setting( 'dl_testimonials_headline', array( 'default' => 'What Our Customers Say', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'dl_testimonials_headline', array( 'label' => 'Headline', 'section' => 'dl_testimonials_sec', 'type' => 'text' ) );

	// ── Panel: Footer ────────────────────────────────────────────────────────────
	$wp_customize->add_panel( 'dl_footer_panel', array( 'title' => 'Footer', 'priority' => 39 ) );
	$wp_customize->add_section( 'dl_footer_sec', array( 'title' => 'Footer Text', 'panel' => 'dl_footer_panel' ) );
	$wp_customize->add_setting( 'dl_footer_tagline', array(
		'default'           => 'Melbourne\'s trusted auto repair specialists. Honest advice, quality workmanship, every time.',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'dl_footer_tagline', array( 'label' => 'Footer Tagline', 'section' => 'dl_footer_sec', 'type' => 'text' ) );
} );

// ── Holiday Banner Admin Page ─────────────────────────────────────────────────
add_action( 'admin_menu', function () {
	add_options_page(
		'Holiday Banner',
		'Holiday Banner',
		'manage_options',
		'dl-banner',
		'dl_banner_page'
	);
} );

add_action( 'admin_init', function () {
	register_setting( 'dl_banner_group', 'dl_banner_enabled',     array( 'sanitize_callback' => 'absint' ) );
	register_setting( 'dl_banner_group', 'dl_banner_type',        array( 'sanitize_callback' => 'sanitize_key' ) );
	register_setting( 'dl_banner_group', 'dl_banner_message',     array( 'sanitize_callback' => 'sanitize_text_field' ) );
	register_setting( 'dl_banner_group', 'dl_banner_start',       array( 'sanitize_callback' => 'sanitize_text_field' ) );
	register_setting( 'dl_banner_group', 'dl_banner_end',         array( 'sanitize_callback' => 'sanitize_text_field' ) );
	register_setting( 'dl_banner_group', 'dl_banner_dismissible', array( 'sanitize_callback' => 'absint' ) );
} );

function dl_banner_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$enabled     = get_option( 'dl_banner_enabled', 0 );
	$type        = get_option( 'dl_banner_type', 'info' );
	$message     = get_option( 'dl_banner_message', '' );
	$start       = get_option( 'dl_banner_start', '' );
	$end         = get_option( 'dl_banner_end', '' );
	$dismissible = get_option( 'dl_banner_dismissible', 1 );

	$type_colors = array( 'info' => '#7ED321', 'warning' => '#f5a623', 'closed' => '#d0021b' );
	$preview_bg  = isset( $type_colors[ $type ] ) ? $type_colors[ $type ] : '#7ED321';
	$text_color  = ( 'info' === $type ) ? '#1c2610' : '#fff';
	?>
	<div class="wrap">
		<h1>&#127881; Holiday Banner</h1>
		<p>Display a small announcement strip at the top of your website — useful for public holiday closures, reduced hours, or special notices.</p>

		<form method="post" action="options.php">
			<?php settings_fields( 'dl_banner_group' ); ?>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row">Enable Banner</th>
					<td>
						<label>
							<input type="checkbox" name="dl_banner_enabled" value="1" <?php checked( 1, $enabled ); ?>>
							Show this banner on the website right now
						</label>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="dl_banner_type">Banner Colour</label></th>
					<td>
						<select id="dl_banner_type" name="dl_banner_type">
							<option value="info"    <?php selected( $type, 'info' ); ?>>&#128994; Green — general info / announcement</option>
							<option value="warning" <?php selected( $type, 'warning' ); ?>>&#128993; Amber — reduced hours / delays</option>
							<option value="closed"  <?php selected( $type, 'closed' ); ?>>&#128308; Red — closed / public holiday</option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="dl_banner_message">Message</label></th>
					<td>
						<input type="text" id="dl_banner_message" name="dl_banner_message"
							value="<?php echo esc_attr( $message ); ?>"
							class="large-text" maxlength="120"
							placeholder="e.g. Closed Friday 25 April for ANZAC Day. Reopening Saturday 8am.">
						<p class="description">Keep under 100 characters so it fits on one line. Current length: <strong id="dl-char-count"><?php echo esc_html( mb_strlen( $message ) ); ?></strong>/120</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="dl_banner_start">Start Date</label></th>
					<td>
						<input type="date" id="dl_banner_start" name="dl_banner_start"
							value="<?php echo esc_attr( $start ); ?>">
						<p class="description">Leave blank to show the banner as soon as it&#8217;s enabled.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="dl_banner_end">End Date</label></th>
					<td>
						<input type="date" id="dl_banner_end" name="dl_banner_end"
							value="<?php echo esc_attr( $end ); ?>">
						<p class="description">Leave blank to show indefinitely. The banner automatically disappears after this date.</p>
					</td>
				</tr>
				<tr>
					<th scope="row">Allow Visitors to Dismiss</th>
					<td>
						<label>
							<input type="checkbox" name="dl_banner_dismissible" value="1" <?php checked( 1, $dismissible ); ?>>
							Show a &#10005; close button so visitors can hide the banner
						</label>
						<p class="description">The browser remembers the dismissal — the banner won&#8217;t reappear for that visitor.</p>
					</td>
				</tr>
			</table>
			<?php submit_button( 'Save Banner Settings' ); ?>
		</form>

		<?php if ( $message ) : ?>
		<hr>
		<h2>Live Preview</h2>
		<div style="background:<?php echo esc_attr( $preview_bg ); ?>;color:<?php echo esc_attr( $text_color ); ?>;padding:11px 24px;border-radius:6px;font-family:-apple-system,BlinkMacSystemFont,sans-serif;font-size:14px;font-weight:600;display:flex;justify-content:center;align-items:center;gap:12px;max-width:900px;position:relative;">
			<span><?php echo esc_html( $message ); ?></span>
			<?php if ( $dismissible ) : ?>
			<span style="position:absolute;right:12px;background:rgba(0,0,0,.2);border-radius:50%;width:22px;height:22px;display:flex;align-items:center;justify-content:center;font-size:12px;cursor:default;" title="Visitors will see this close button">&#10005;</span>
			<?php endif; ?>
		</div>
		<p style="color:#666;font-size:12px;margin-top:8px;">Colour preview only — the real banner sits at the very top of your website.</p>
		<?php endif; ?>
	</div>
	<script>
	(function() {
		var input = document.getElementById('dl_banner_message');
		var counter = document.getElementById('dl-char-count');
		if (input && counter) {
			input.addEventListener('input', function() {
				counter.textContent = input.value.length;
			});
		}
	})();
	</script>
	<?php
}
