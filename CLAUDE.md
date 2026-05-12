# DL Auto Care — Website

## Project
Marketing website for DL Auto Care Pty Ltd, Braybrook Melbourne.
- **`index.html`** — static HTML/CSS/JS demo (reference / design proof)
- **`wordpress-theme/`** — production WordPress theme (CMS, client-editable)

## Business
- **Name**: DL Auto Care Pty Ltd
- **Tagline**: "Done With Satisfaction"
- **Services**: Smash & Mechanical Repair (13 services)
- **Address**: 2-3/9 Lacy St, Braybrook VIC 3019
- **Phone**: 0423 310 713

## Assets
| File | Usage |
|------|-------|
| `DLAUto logo.png` | Site logo — also copy to `wordpress-theme/assets/images/logo.png` |
| `image1.webp` | Mechanic on engine — also copy to `wordpress-theme/assets/images/image1.webp` |
| `image2.webp` | Mechanic in DL Auto shirt — also copy to `wordpress-theme/assets/images/image2.webp` |
| `wise.design__ref=godly.png` | Design reference — **do not ship** |

## WordPress Stack
- **Hosting**: GoDaddy Managed WordPress (built-in staging environment)
- **Theme**: `wordpress-theme/` — custom PHP, no page builder, no ACF required
- **CMS**: Native WordPress CPTs + meta boxes + Customizer (zero plugin dependencies)
- **Holiday Banner**: WP Admin → Settings → Holiday Banner (date-ranged, dismissible)
- **Deploy**: `git push` → GitHub Actions (PHP lint + SFTP) → GoDaddy staging
- **Go Live**: GoDaddy Dashboard → "Push to Live" button

## Rules
- `design-system.md` — colours, typography, spacing tokens
- `page-sections.md` — all 10 section specs (includes Team + Holiday Banner)
- `animations.md` — scroll animation pattern (applies to both HTML demo + WP theme)
- `mobile.md` — responsive breakpoints and mobile rules
- `qa-screenshots.md` — screenshot checkpoints and comparison checklist
- `tech-stack.md` — WordPress implementation constraints and standards
