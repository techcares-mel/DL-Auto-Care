# Design System

Reference: `wise.design__ref=godly.png` — match Wise's bold, dark, card-based marketing aesthetic.

## Colour Tokens

```css
--color-bg:           #0d0d0d;   /* page background */
--color-surface:      #1a1a1a;   /* card / section backgrounds */
--color-card-dark:    #141414;
--color-card-green:   #1c2e0a;
--color-green:        #7ED321;   /* primary accent — match logo green */
--color-green-dark:   #4a8a0e;
--color-white:        #f5f5f5;
--color-muted:        #888888;
```

Define all tokens as CSS custom properties on `:root`. Never hardcode hex values elsewhere — always reference a token.

## Typography

Load from Google Fonts:
```html
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
```

| Role | Font | Weight | Size (desktop) |
|------|------|--------|----------------|
| Display / Hero | Syne | 800 | `clamp(3rem, 9vw, 7.5rem)` |
| Section headline | Syne | 700 | `clamp(2rem, 5vw, 3.5rem)` |
| Card title | Inter | 600 | 1.25rem |
| Body | Inter | 400 | 1rem |
| Caption / label | Inter | 500 | 0.875rem |

- Letter-spacing on display text: `-0.03em`
- Line-height on headlines: `1.05`
- Line-height on body: `1.65`

## Spacing

Base unit: `8px`. All spacing values must be multiples of 8.

| Token | Value |
|-------|-------|
| Section vertical padding (desktop) | 120px |
| Section vertical padding (mobile) | 64px |
| Card padding | 32px |
| Card gap in grid | 16px |
| Container max-width | 1200px |
| Container horizontal padding | 24px |

## Component Styles

**Cards**
- `border-radius: 24px`
- Background: `var(--color-surface)` or `var(--color-card-dark)`
- Hover: `border: 1px solid var(--color-green)` + `transform: translateY(-4px)`
- Transition: `0.25s ease`

**Buttons**
- Primary (filled): green bg, dark text, `border-radius: 999px`, `padding: 14px 28px`, font-weight 600
- Ghost (outline): transparent bg, `border: 2px solid var(--color-white)`, white text, same radius
- Hover on primary: darken bg to `var(--color-green-dark)`
- Minimum tap target: 44px height

**Pills / Tags**
- `border-radius: 999px`
- `padding: 6px 16px`
- Small caps label style, `font-size: 0.8rem`, `font-weight: 600`
- Dark bg with green text, or green bg with dark text
