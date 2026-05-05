# Tech Stack & Implementation Constraints

## Stack
- **WordPress** on GoDaddy Managed WordPress hosting
- **Custom PHP theme** in `wordpress-theme/` — no page builder, no Elementor, no ACF required
- **CSS** in `wordpress-theme/style.css` — CSS custom properties for all tokens
- **JS** in `wordpress-theme/assets/js/main.js` — vanilla JS, no transpilation, no libraries
- **Google Fonts** — loaded via `wp_enqueue_style` in `functions.php`

The static `index.html` remains in the repo as a design reference / demo only.

## Zero Plugin Dependency Rule
The theme must work fully without any specific plugin installed. All CMS features use:
- `register_post_type()` — Custom Post Types
- `add_meta_box()` — admin fields for CPTs
- `customize_register` hook — Customizer panels for global settings
- `get_option()` / `update_option()` — Holiday Banner settings
- `add_options_page()` — Holiday Banner admin page

ACF (Advanced Custom Fields) is **not** required.

## WordPress Coding Standards
All code must follow these rules — no exceptions:

**Output escaping (use the right function for context):**
- HTML text: `esc_html()`
- HTML attributes: `esc_attr()`
- URLs: `esc_url()`
- Textarea content: `esc_textarea()`
- JS strings: `esc_js()`

**Input sanitization on save:**
- Single-line text: `sanitize_text_field()`
- Multi-line: `sanitize_textarea_field()`
- URLs: `esc_url_raw()`
- Keys/slugs: `sanitize_key()`

**Nonces** — every form submission must verify a nonce before saving data.

**Hooks:**
- Always use `wp_enqueue_scripts` to load CSS/JS — never hardcode `<link>` or `<script>` in templates
- Call `wp_head()` before `</head>` in `header.php`
- Call `wp_footer()` before `</body>` in `footer.php`
- Use `wp_body_open()` immediately after `<body>` in `header.php`

**Body & HTML tags:**
- `<html <?php language_attributes(); ?>>` on html element
- `<body <?php body_class(); ?>>` on body element
- `<meta charset="<?php bloginfo('charset'); ?>">` — no hardcoded charset

## Theme File Structure

```
wordpress-theme/
├── style.css                    ← WordPress theme header + all CSS
├── functions.php                ← Theme setup, CPTs, meta boxes, Customizer, Banner admin
├── front-page.php               ← Homepage template
├── header.php                   ← <html>, <head>, wp_head(), nav, mobile nav
├── footer.php                   ← Footer HTML, wp_footer(), </body>, </html>
├── 404.php                      ← Simple not-found page
├── assets/
│   ├── js/main.js               ← Nav, hamburger, IntersectionObserver, banner dismiss
│   └── images/                  ← logo.png, image1.webp, image2.webp (theme fallbacks)
└── template-parts/
    ├── section-banner.php       ← Holiday banner (conditional)
    ├── section-hero.php
    ├── section-marquee.php
    ├── section-services.php     ← WP_Query on 'service' CPT
    ├── section-statement.php
    ├── section-about.php
    ├── section-gallery.php
    ├── section-testimonials.php ← WP_Query on 'testimonial' CPT
    ├── section-team.php         ← WP_Query on 'team_member' CPT
    └── section-contact.php
```

## Deploy Workflow

```
Local edit → git push → GitHub Actions:
  1. PHP lint (syntax check all .php files)
  2. SFTP deploy → GoDaddy staging (only wordpress-theme/ folder)
→ Review on staging URL
→ GoDaddy "Push to Live" → Production
```

Required GitHub Secrets: `FTP_HOST`, `FTP_USER`, `FTP_PASS`, `FTP_PORT`

## Plugin Compatibility
- Always call `wp_head()` and `wp_footer()` so plugins can inject their assets
- Prefix all custom CSS classes that could conflict: banner uses `dl-banner__*` namespace
- Register theme features via `add_theme_support()` inside `after_setup_theme`
- Don't suppress the admin bar — offset the fixed nav: `.admin-bar .nav { top: 32px; }`
- Use `body_class()` so plugin-added body classes work correctly

## Performance Rules
- Enqueue JS with last argument `true` to place in footer
- `loading="lazy"` on all images below the fold
- `fetchpriority="high"` on hero image only
- Maximum 3 WP_Query calls per page load (services, testimonials, team)

## Accessibility Rules
- All `<img>` must have descriptive `alt` attributes
- Interactive elements keyboard-focusable; use green accent for `:focus-visible`
- WCAG AA: ≥ 4.5:1 body text, ≥ 3:1 large text
- Semantic HTML: `<nav>`, `<main>`, `<footer>`, `<section>`
- Hamburger: `aria-label="Open menu"`, `aria-expanded` toggled by JS

## CSS Reset / Base
```css
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
img, video { max-width: 100%; height: auto; display: block; }
html { scroll-behavior: smooth; }
```
