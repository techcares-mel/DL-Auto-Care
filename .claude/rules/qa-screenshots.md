# QA & Screenshot Workflow

After every major section is built, take a screenshot and compare it against `wise.design__ref=godly.png` before moving to the next section.

## How to Take a Screenshot

Start a local server, then screenshot using Puppeteer or the browser:

```bash
# Start server (Python)
python -m http.server 8080

# Or PowerShell
npx serve . --port 8080
```

Then use Puppeteer via Node to capture:

```js
// screenshot.js — run with: node screenshot.js
const puppeteer = require('puppeteer');
(async () => {
  const browser = await puppeteer.launch();
  const page = await browser.newPage();
  await page.setViewport({ width: 1440, height: 900 });
  await page.goto('http://localhost:8080');
  await page.screenshot({ path: 'screenshot-desktop.png', fullPage: true });
  await page.setViewport({ width: 390, height: 844 });
  await page.screenshot({ path: 'screenshot-mobile.png', fullPage: true });
  await browser.close();
})();
```

If Puppeteer is not available, open `http://localhost:8080` in Chrome, use DevTools → **Cmd+Shift+P → "Capture full size screenshot"**.

Then read the screenshot file with the Read tool to view it visually for comparison.

## Checkpoints

Run a screenshot at each milestone before continuing:

| # | Milestone | Desktop check | Mobile check |
|---|-----------|---------------|--------------|
| 1 | Hero section complete | ✓ | ✓ |
| 2 | Services card grid complete | ✓ | ✓ |
| 3 | About section complete | ✓ | ✓ |
| 4 | Bento gallery complete | ✓ | ✓ |
| 5 | Testimonials + Contact + Footer complete | ✓ | ✓ |
| 6 | Final polish pass | ✓ | ✓ |

## What to Check at Each Checkpoint

Compare the screenshot side-by-side against `wise.design__ref=godly.png`:

**Typography**
- [ ] Headlines are heavy (weight 700–800) and feel oversized — if they look "normal sized", increase them
- [ ] Letter-spacing is tight on display text (`-0.03em`)
- [ ] Body copy is readable (min 1rem, 1.65 line-height)

**Colour & Contrast**
- [ ] Background is truly dark (`#0d0d0d`) — not grey or off-black
- [ ] Green accent `#7ED321` is vivid and used on highlights, numbers, borders, pills
- [ ] Text is white/near-white on dark backgrounds, never light grey on dark grey (fails WCAG AA)

**Cards & Grid**
- [ ] Cards have generous internal padding (32px), rounded corners (24px), subtle dark surface
- [ ] Grid uses mixed card sizes — not a uniform grid of identical rectangles
- [ ] Card hover state visible: green border + slight lift

**Spacing**
- [ ] Sections have breathing room — section padding ≥ 120px desktop, ≥ 64px mobile
- [ ] No content touches the viewport edge on mobile (container padding-inline: 24px)

**Animations**
- [ ] Scroll down slowly — all key elements animate in (fade up) as they enter viewport
- [ ] No elements stuck at `opacity: 0` after scrolling past them (check `threshold` value)
- [ ] Hero elements animate on load with staggered delays

**Mobile (390px)**
- [ ] Nav collapses to hamburger, hamburger opens overlay
- [ ] All grids stack to single column
- [ ] Font sizes remain readable (not too small, not overflowing)
- [ ] Testimonials are a horizontal scroll carousel
- [ ] No horizontal overflow on the page

**Overall Feel**
- [ ] Bold, dark, modern — matches Wise's confident brand energy
- [ ] Does NOT look like a generic template or Bootstrap site
- [ ] Green accent used consistently but not overused
- [ ] Sufficient visual hierarchy: hero → sections → cards → body copy
