# Scroll Animations

Every visible section and its key child elements **must** animate in as the user scrolls. Use the Intersection Observer API — no external animation libraries.

## Base Pattern

Add this script once, before `</body>`:

```js
const observer = new IntersectionObserver(
  (entries) => entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); }),
  { threshold: 0.12 }
);
document.querySelectorAll('.animate').forEach(el => observer.observe(el));
```

## CSS Classes

```css
.animate {
  opacity: 0;
  transform: translateY(28px);
  transition: opacity 0.55s ease, transform 0.55s ease;
}
.animate.visible {
  opacity: 1;
  transform: translateY(0);
}

/* Stagger delays for grid children */
.animate-d1 { transition-delay: 0.08s; }
.animate-d2 { transition-delay: 0.16s; }
.animate-d3 { transition-delay: 0.24s; }
.animate-d4 { transition-delay: 0.32s; }
.animate-d5 { transition-delay: 0.40s; }
.animate-d6 { transition-delay: 0.48s; }

/* Fade-in only (no Y shift) — use for background images, wide containers */
.animate-fade {
  opacity: 0;
  transition: opacity 0.7s ease;
}
.animate-fade.visible { opacity: 1; }

/* Slide in from left */
.animate-left {
  opacity: 0;
  transform: translateX(-32px);
  transition: opacity 0.55s ease, transform 0.55s ease;
}
.animate-left.visible { opacity: 1; transform: translateX(0); }

/* Slide in from right */
.animate-right {
  opacity: 0;
  transform: translateX(32px);
  transition: opacity 0.55s ease, transform 0.55s ease;
}
.animate-right.visible { opacity: 1; transform: translateX(0); }
```

## Where to Apply

| Element | Class |
|---------|-------|
| Section eyebrow / label | `animate animate-d1` |
| Section headline | `animate` |
| Section body text | `animate animate-d1` |
| Each service card | `animate animate-d{n}` (stagger 1–6) |
| About image | `animate-left` |
| About text block | `animate-right` |
| Each bento grid cell | `animate animate-d{n}` |
| Each testimonial card | `animate animate-d{n}` |
| Contact headline | `animate` |
| Contact details + buttons | `animate animate-d1` |
| Footer columns | `animate animate-d{n}` |

## Hero Animations

The hero animates on page load (not scroll). Use CSS `@keyframes` with `animation-fill-mode: both`:

```css
@keyframes heroFadeUp {
  from { opacity: 0; transform: translateY(20px); }
  to   { opacity: 1; transform: translateY(0); }
}

.hero-eyebrow  { animation: heroFadeUp 0.6s ease 0.2s both; }
.hero-headline { animation: heroFadeUp 0.6s ease 0.4s both; }
.hero-sub      { animation: heroFadeUp 0.6s ease 0.55s both; }
.hero-buttons  { animation: heroFadeUp 0.6s ease 0.7s both; }
```

## Scroll Indicator (Hero)

```css
@keyframes bounce {
  0%, 100% { transform: translateY(0); }
  50%       { transform: translateY(8px); }
}
.scroll-indicator { animation: bounce 1.4s ease-in-out infinite; }
```

## Rules
- Do not use `animation: none` or remove `animate` classes on mobile — animations apply on all screen sizes
- `threshold: 0.12` means the animation fires when 12% of the element is visible — do not lower it below 0.08
- Never block the main thread: keep all animation logic in CSS, not JS transforms applied per-frame
