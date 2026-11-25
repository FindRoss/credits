# Credits (parent theme)

Shared theme for Counselor Credits and, later, Dual Credits. Right now only Counselor Credits uses it, directly.
When the second site starts, we create a child theme per site and move the "child-bound" items below out of here.

## Rule of thumb

- **Parent:** structure, components, behavior. Anything both sites would want identically.
- **Child:** brand values, site-specific copy and page content.
- **Plugin (not theme):** business logic, e.g. the handoff to the course platform, order hooks.

Keep brand values out of templates and CSS: colors and fonts come from `theme.json` presets, never hardcoded hex.

## Stays in the parent

- `style.css` components and layout: `.btn`, `.card`, `.step`, `.faq`, `.cta-band`, `.status-card`, etc.
- `functions.php`: theme supports (incl. WooCommerce), menu locations, parent stylesheet enqueue, `credits_logo()`
- `header.php` / `footer.php` structure, `index.php`
- Font loading mechanism (`fontFace` in `theme.json`)

## Child-bound (move when Dual Credits starts)

| Item | Where now | Note |
|---|---|---|
| Palette values | `theme.json` | Parent keeps the slugs; child overrides the colors |
| Fonts | `theme.json` | Same: child can swap families |
| Homepage content | `front-page.php` | Copy is counseling-licensure specific; Dual Credits gets its own |
| Footer legal text | `footer.php` | Names CounselorCredits and Partner University; make it a child override or a filter |
| Menu fallback links | `functions.php` | Anchors point at homepage sections; child-specific |
| Placeholder text | `front-page.php` | `[VERIFY…]`, `[PRICE PER CREDIT]`, `[REFUND POLICY]`: fill in, don't carry over |

## Open decisions

- Logo: text logo by default (`credits_logo()` splits a name ending in "Credits" and accents that word); an uploaded logo overrides it.
- Switching to a child later resets per-theme settings (custom logo, menu assignments). Re-set them after activating the child.
