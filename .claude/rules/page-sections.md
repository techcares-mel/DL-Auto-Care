# Page Sections

Build these sections in order inside `index.html`. Every section must have `class="animate"` on its key elements — see `animations.md`.

## 1 — Navigation (sticky)

- Position: `sticky top-0`, `z-index: 100`
- Background: `rgba(13,13,13,0.85)` with `backdrop-filter: blur(12px)` when scrolled
- Left: `DLAUto logo.png` (height 40px)
- Centre (desktop): links — Services, About, Gallery, Contact — smooth-scroll anchors
- Right: "Book Now" primary pill button → scrolls to `#contact`
- Mobile (`≤768px`): hamburger icon; tap opens full-screen dark overlay nav with large links

## 2 — Hero

- Height: `100svh` (fallback `100vh`)
- Background: `image1.webp` as `object-fit: cover` with `opacity: 0.35` overlay on a dark base, OR dark bg with a radial green glow (`radial-gradient`) on one side
- Content centred or left-aligned:
  - Eyebrow pill: "Braybrook VIC 3019 · Smash & Mechanical"
  - **Headline** (display size): "Done With Satisfaction."
  - Sub-headline: "Melbourne's trusted smash & mechanical repair specialists."
  - Two buttons: "Get a Quote" (primary) + "Our Services" (ghost)
- Animated scroll-down indicator at bottom centre (CSS bounce animation)

## 3 — Services

- Anchor: `id="services"`
- Section headline: "What We Fix"
- **Grid**: 3 columns desktop → 2 tablet → 1 mobile; `gap: 16px`
- Six cards (dark surface, green accent number or icon):
  1. Smash Repair — panel beating, dent removal, paint matching
  2. Mechanical Repair — engine, suspension, brakes, servicing
  3. Spray Painting — full resprays, spot repairs, colour matching
  4. Windscreen Repair — chip & crack repair, full replacement
  5. Wheel & Tyre — alignment, balancing, tyre replacement
  6. Log Book Service — manufacturer-scheduled servicing
- Each card: bold number (01–06) in green, card title, short 1-sentence description

## 4 — About

- Anchor: `id="about"`
- Two-column desktop (image left, text right) → stacked mobile (image on top)
- **Left**: `image2.webp` as a tall card (`aspect-ratio: 3/4`, `object-fit: cover`, `border-radius: 24px`)
- **Right**:
  - Eyebrow label: "About Us"
  - Headline: "We Take Pride in Every Job"
  - Body: 2–3 sentences about quality, satisfaction guarantee, experienced Melbourne team
  - Three stat pills in a row (or column on mobile):
    - "15+ Years Experience"
    - "500+ Cars Repaired"
    - "100% Satisfaction"

## 5 — Gallery (Bento Grid)

- Anchor: `id="gallery"`
- Section headline: "Our Work"
- CSS Grid bento layout with `grid-template-areas` — mix of large, medium, and small cells
- Suggested layout (desktop):
  ```
  "big   big   small1"
  "big   big   small2"
  "med1  med2  small2"
  ```
- Cells:
  - `big`: `image1.webp` (engine work close-up)
  - `med1`: `image2.webp` (shop/team)
  - `med2`: dark card with green text "Panel Beating & Smash Repair"
  - `small1`: green bg card — "Spray Painting"
  - `small2`: dark card — "Engine & Mechanical"
- All image cells: `overflow: hidden`; image scales `1.05` on hover (`transition: transform 0.4s ease`)
- Mobile: single column stack

## 6 — Testimonials

- Anchor: `id="testimonials"`
- Dark section, headline: "What Our Customers Say"
- Three cards, horizontal row desktop → swipeable carousel (CSS scroll-snap) on mobile
- Each card: 5 green stars, quote text (2–3 sentences), customer first name + suburb

Sample quotes (placeholder, user can update):
- *"DL Auto Care had my car looking brand new after a nasty dent. Fast, affordable, and they kept me updated the whole time."* — Michael T., Braybrook
- *"Honest mechanics who don't overcharge. My log book service was done same day."* — Sarah K., Footscray
- *"The spray paint match was perfect — couldn't tell there was ever any damage."* — James L., Sunshine

## 7 — Contact / CTA

- Anchor: `id="contact"`
- Full-width section, background: `var(--color-card-green)` or a dark green gradient
- Large headline: "Ready to Book?"
- Details block:
  - 📍 1 Lacy Street, Braybrook VIC 3019
  - 📞 0423 310 713
- Two buttons: "Call Us Now" (`href="tel:0423310713"`) + "Get Directions" (links to Google Maps)
- Optional: Google Maps embed `<iframe>` below the CTA

## 8 — Footer

- Logo (white/green version, height 36px)
- Tagline: "Done With Satisfaction"
- Two link columns: Navigation (Services, About, Gallery, Contact) + Services (Smash Repair, Mechanical, Spray Painting, Windscreen)
- Bottom bar: "© 2025 DL Auto Care Pty Ltd · 1 Lacy Street, Braybrook VIC 3019"
