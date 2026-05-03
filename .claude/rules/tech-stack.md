# Tech Stack & Implementation Constraints

## Stack

- **HTML5** — single `index.html` file
- **CSS3** — either embedded `<style>` or a linked `style.css`; CSS custom properties for all tokens
- **Vanilla JS** — either embedded `<script>` or a linked `script.js`; no transpilation required
- **Google Fonts** — loaded via `<link>` in `<head>`

No frameworks, no build tools, no package managers, no CDN JS libraries (no jQuery, no GSAP, no AOS, no Bootstrap).

## What IS Allowed

- CSS Grid and Flexbox (use both freely)
- CSS custom properties (`var(--token)`)
- CSS `@keyframes` and `transition`
- Native browser APIs: `IntersectionObserver`, `scroll`, `matchMedia`
- `<picture>` and `srcset` for responsive images
- Google Fonts `<link>` tag
- Google Maps `<iframe>` embed for the contact section

## File Structure

```
DL Auto/
├── index.html            ← main deliverable
├── style.css             ← optional external stylesheet
├── script.js             ← optional external JS
├── DLAUto logo.png       ← logo — reference as src="DLAUto logo.png"
├── image1.webp           ← mechanic on engine
├── image2.webp           ← DL Auto Care mechanic
├── wise.design__ref=godly.png  ← design reference only, do not ship
└── CLAUDE.md
```

All asset paths in HTML must be relative (e.g., `src="image1.webp"`, not absolute paths).

## Head Tags (Required)

```html
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="DL Auto Care Pty Ltd — Smash & Mechanical Repair. 1 Lacy Street, Braybrook VIC 3019. Call 0423 310 713.">
<meta property="og:title" content="DL Auto Care — Done With Satisfaction">
<meta property="og:description" content="Melbourne's trusted smash & mechanical repair specialists.">
<meta property="og:image" content="image2.webp">
<title>DL Auto Care — Smash & Mechanical Repair, Braybrook VIC</title>
<link rel="icon" href="DLAUto logo.png">
```

## Performance Rules

- Lazy-load all images below the fold: `loading="lazy"` on `<img>` tags
- Hero background image may be set via CSS `background-image` for the overlay technique, or as an `<img>` with `fetchpriority="high"`
- No render-blocking JS: place `<script>` tags before `</body>` or use `defer`
- No unused CSS — write only what is needed for the sections being built

## Accessibility Rules

- All `<img>` tags must have descriptive `alt` attributes
- Interactive elements (buttons, links) must be keyboard-focusable — do not suppress `:focus` outline entirely; style it with the green accent instead
- Colour contrast must meet WCAG AA: ≥ 4.5:1 for body text, ≥ 3:1 for large text
- Nav must include `<nav>` landmark; main content in `<main>`; footer in `<footer>`
- Hamburger button: `aria-label="Open menu"`, `aria-expanded` toggled by JS

## Smooth Scroll

```css
html { scroll-behavior: smooth; }
```

All anchor `href="#section-id"` links benefit from this automatically.

## CSS Reset / Base

Include a minimal reset at the top of the stylesheet:

```css
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
img, video { max-width: 100%; height: auto; display: block; }
```
