# Mobile & Responsive Design

The website must be fully functional and visually polished on all screen sizes. Mobile-first mindset.

## Breakpoints

```css
/* Base styles: mobile (≤480px) */

@media (min-width: 481px)  { /* tablet portrait */ }
@media (min-width: 769px)  { /* tablet landscape / small desktop */ }
@media (min-width: 1025px) { /* desktop */ }
@media (min-width: 1280px) { /* large desktop */ }
```

Design at these reference widths: 375px (iPhone SE), 390px (iPhone 14), 768px (iPad), 1280px (desktop).

## Typography

All display and headline font sizes must use `clamp()` — never fixed `px` at smaller sizes:

```css
.hero-headline    { font-size: clamp(2.5rem, 9vw, 7.5rem); }
.section-headline { font-size: clamp(1.75rem, 5vw, 3.5rem); }
.card-title       { font-size: clamp(1rem, 2.5vw, 1.25rem); }
```

## Layout Shifts

| Section | Desktop | Tablet (≤768px) | Mobile (≤480px) |
|---------|---------|-----------------|-----------------|
| Navigation | horizontal, all links visible | horizontal, hide centre links, keep logo + CTA | hamburger |
| Hero | centred or left-aligned | centred | centred, reduced padding |
| Services grid | 3 columns | 2 columns | 1 column |
| About | 2 columns (image + text) | stacked (image top) | stacked |
| Bento grid | multi-area CSS grid | 2 columns | 1 column |
| Testimonials | 3-up row | 2-up | CSS scroll-snap horizontal carousel |
| Contact | side-by-side headline + buttons | stacked | stacked |
| Footer | 4 columns | 2 columns | 1 column |

## Navigation (Mobile)

```css
/* Hide desktop nav links below 768px */
@media (max-width: 768px) {
  .nav-links { display: none; }
  .hamburger { display: flex; }
}
```

- Hamburger: 3-line icon, `44px × 44px` tap target
- On click: full-screen overlay (`position: fixed; inset: 0; background: var(--color-bg); z-index: 200`)
- Overlay contains large nav links (`font-size: 2rem`) and a close button
- Overlay open/close toggled by adding/removing `.open` class via JS — animate with `opacity` + `transform`

## Touch Targets

Every interactive element (button, link, nav item) must have a minimum tap target of `44px × 44px`. Add `padding` if the visual element is smaller.

## Images

```css
img {
  max-width: 100%;
  height: auto;
  display: block;
}
```

Use `loading="lazy"` on all images below the fold (everything except the hero background).

## Testimonials Carousel (Mobile)

```css
.testimonials-track {
  display: flex;
  gap: 16px;
  overflow-x: auto;
  scroll-snap-type: x mandatory;
  -webkit-overflow-scrolling: touch;
  scrollbar-width: none; /* hide scrollbar */
}
.testimonials-track::-webkit-scrollbar { display: none; }

.testimonial-card {
  flex: 0 0 85vw;
  scroll-snap-align: start;
}
```

## Rules
- Never use `vw` units for font sizes without `clamp()` — it causes text to become too small on mobile
- Never hardcode `height` on layout containers — use `min-height` or let content dictate height
- Test scroll animations on mobile; `threshold: 0.12` in Intersection Observer ensures animations still fire on small screens
- Container `max-width: 1200px` must always have `padding-inline: 24px` so content never touches screen edges on mobile
