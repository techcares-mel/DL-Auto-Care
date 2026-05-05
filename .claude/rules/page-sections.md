# Page Sections

All sections live in `wordpress-theme/template-parts/`. Loaded via `get_template_part()` in `front-page.php`. Every key element must have `.animate` (or a variant) — see `animations.md`.

---

## 0 — Holiday Banner (`section-banner.php`)

Rendered in `header.php` **before** the `<nav>`. Only shown when enabled in WP Admin → Settings → Holiday Banner.

- Fixed position at top of viewport (`position: fixed; top: 0; z-index: 300; width: 100%`)
- JS adjusts nav `top` and body `padding-top` to actual rendered banner height on load + resize
- **Types**: info (green `#7ED321`), warning (amber `#f5a623`), closed (red `#d0021b`)
- **Dismissible**: optional ✕ button; dismissed state stored in `localStorage` keyed by message hash
- **Auto-hide**: if an end date is set, PHP hides banner after that date (`current_time('Y-m-d')`)
- **Admin fields** (Settings → Holiday Banner):
  - Enable / Disable toggle
  - Banner type (info / warning / closed)
  - Message text — keep under 100 chars for single-line display
  - Start date (optional — leave blank to show immediately when enabled)
  - End date (optional — banner auto-hides after this date)
  - Allow visitors to dismiss (checkbox)
- Admin page shows a live colour preview of the banner below the form

---

## 1 — Navigation (`header.php`)

- `position: fixed; top: 0; z-index: 200`
- When WP admin bar visible: `.admin-bar .nav { top: 32px; }`
- When banner is active: JS sets `nav.style.top = banner.offsetHeight + 'px'`
- Logo: `the_custom_logo()` or fallback `assets/images/logo.png` (height 57px)
- Centre links (desktop): Services · About · Gallery · Team · Contact — smooth-scroll `#` anchors
- Right: "Book Now" primary pill → `#contact`
- Mobile (≤768px): hamburger → full-screen overlay (`position: fixed; inset: 0`) with large links + close button

---

## 2 — Hero (`section-hero.php`)

- Height: `100svh` (fallback `100vh`)
- Background: `dl_gallery_image1` Customizer image (fallback `assets/images/image1.webp`), `object-fit: cover`, dark gradient overlay
- Content (left-aligned):
  - Eyebrow pill: address from `dl_contact_address` Customizer setting
  - Headline line 1: `dl_hero_headline1` (default: "Done With")
  - Headline line 2: `dl_hero_headline2` (default: "Satisfaction.") — rendered in green `<em>`
  - Sub-headline: `dl_hero_sub`
  - Buttons: "Get a Quote" (primary → `#contact`) + "Our Services" (ghost → `#services`)
  - Tag pills: hardcoded service highlights
- Scroll indicator: bouncing chevron at bottom-centre
- Hero elements animate on load via CSS `@keyframes heroIn` with staggered delays

---

## 3 — Marquee (`section-marquee.php`)

- Green background (`var(--g)`), infinite horizontal scroll strip
- 10 service names, duplicated for seamless CSS marquee loop
- Hardcoded (rarely changes; no CMS needed)

---

## 4 — Services (`section-services.php`)

- Anchor: `id="services"`
- **Dynamic**: `WP_Query` on `service` CPT, ordered by `menu_order` then `date ASC`
- First post → wide "featured" card (`grid-column: span 3`)
- Remaining posts → standard service cards in 3-col → 2-col → 1-col grid
- Each card: `_service_number` meta (ghost background via CSS `::before { content: attr(data-n) }`), post title, `_service_description` meta
- Last card is always the static CTA "Not Sure What You Need?" card (hardcoded)
- Empty state: message pointing client to WP Admin → Services → Add New

**CPT slug**: `service` | **Meta**: `_service_number`, `_service_description`

---

## 5 — Statement Band (`section-statement.php`)

- Green background (`var(--g)`), 2-column layout (text left, stats right)
- "Quality work. Honest price. Every time." — hardcoded brand promise
- 3 stats: 500+ cars, 15 yrs, 5★ — hardcoded
- Static section — no CMS fields needed

---

## 6 — About (`section-about.php`)

- Anchor: `id="about"`
- 2-column desktop → stacked mobile
- Image: `dl_gallery_image2` Customizer (fallback `assets/images/image2.webp`), `aspect-ratio: 3/4`, green top accent via `::after`
- Body from Customizer: `dl_about_p1`, `dl_about_p2` (two paragraphs)
- 3 stat pills from Customizer: `dl_about_stat{1-3}_v` (value) + `dl_about_stat{1-3}_l` (label)
- Buttons: "Book a Service" (primary) + phone number (ghost, `href="tel:..."`)

---

## 7 — Gallery / Bento (`section-gallery.php`)

- Anchor: `id="gallery"`
- 12-col CSS Grid, `grid-template-rows: 360px 360px`
- Row 1: main image `c7 r2` (spans 2 rows), text card `c3`, green number cell `c2`
- Row 2: secondary image `c5`, text card `c3`, green text card `c4`
- Images from Customizer: `dl_gallery_image1` (large), `dl_gallery_image2` (medium)
- Image hover: `transform: scale(1.05)` on the `<img>`
- Text cells: hardcoded labels (rarely change)
- Mobile: single-column stack, fixed cell heights

---

## 8 — Testimonials (`section-testimonials.php`)

- Anchor: `id="testimonials"`
- **Dynamic**: `WP_Query` on `testimonial` CPT, `menu_order` then `date ASC`
- Desktop: 3-column grid | Mobile: CSS scroll-snap horizontal carousel
- Each card: 5 stars, `_testimonial_quote`, avatar initial circle, post title (customer name), `_testimonial_suburb`
- Empty state: friendly message pointing to WP Admin → Testimonials → Add New

**CPT slug**: `testimonial` | **Meta**: `_testimonial_quote`, `_testimonial_suburb` | **Post title**: customer name

---

## 9 — Team (`section-team.php`)

- Anchor: `id="team"`
- Section headline: "The People Behind the Work"
- **Dynamic**: `WP_Query` on `team_member` CPT, `menu_order` then `date ASC`
- Grid: 4 columns desktop → 2 columns tablet/mobile
- Each card:
  - Photo: WordPress Featured Image, `aspect-ratio: 1/1`, `object-fit: cover center top`
  - Placeholder SVG person shown if no featured image set
  - Name: post title (Syne bold)
  - Role: `_team_job_title` meta (green, uppercase, small caps style)
- Card hover: green border + `translateY(-4px)` lift
- Empty state: message pointing to WP Admin → Team → Add New

**CPT slug**: `team_member` | **Meta**: `_team_job_title` | **Featured Image**: team member photo

---

## 10 — Contact (`section-contact.php`)

- Anchor: `id="contact"`
- Background: `var(--sg)` light green
- 2-column desktop → stacked mobile
- Left: eyebrow "Get In Touch", headline "Ready to Book?", sub-text, CTA buttons
  - "Call [phone]" → `href="tel:..."` using `dl_contact_phone` Customizer value
  - "Get Directions" → `dl_contact_maps_url` Customizer value
- Right: 4 info cards (📍 address, 📞 phone, 🕐 hours, 🔧 specialties)
  - Address, phone, hours from Customizer settings

---

## 11 — Footer (`footer.php`)

- Background: `#1a2c0e` (dark green)
- 3-column grid: brand (logo + tagline) + Navigate links + Services links
- Logo: `the_custom_logo()` fallback to `assets/images/logo.png` (height 48px)
- Copyright bar: dynamic year `date('Y')` + address from `dl_contact_address` Customizer
