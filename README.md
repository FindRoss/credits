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
| Homepage content | `patterns/home.php` (and the Home page itself) | Copy is counseling-licensure specific; Dual Credits gets its own |
| Footer legal text | `footer.php` | Names CounselorCredits and Partner University; make it a child override or a filter |
| Menu fallback links | `functions.php` | Anchors point at homepage sections; child-specific |
| Placeholder text | Home page content, `patterns/home.php` | `[VERIFY…]`, `[PRICE PER CREDIT]`, `[REFUND POLICY]`: fill in, don't carry over |

## Homepage

- A Page ("Home") set as the static homepage, with the **Homepage** pattern (`patterns/home.php`) inserted. `front-page.php` only wraps it.
- State dropdown and cards are shortcodes: `[credits_state_select]`, `[credits_state_cards]` (`inc/states.php`).
- The progress bar in the sample report is a Custom HTML block; change its `width` there.
- Page text lives in the database, not git.

## State pages

- `state` post type + `topup_status` taxonomy (Top-ups allowed / Allowed with conditions / Degree must already qualify): `inc/states.php`.
- Each state's body is built in the block editor from a pattern in `patterns/`: **State page: Illinois** (filled in) and **State page (blank template)** (placeholders). Insert one when creating a new State.
- `single-state.php` just wraps the content; `archive-state.php` is the `/states/` index: all 50 states (`credits_state_directory()`), linked where a published page has the same title.
- Homepage state cards: the planned list in `credits_fallback_states()`, with a link wherever a published state page has the same title. A ticked status moves a state to that group. The dropdown lists published states only (placeholder names until one exists).
- Tick a **Top-up status** on each state. Without one, it is linked only if its name is already in the planned list.
- The patterns hardcode `/states/` and CounselorCredits copy ("Partner University", legal line). Content is per-site.

- The state editor loads `style.css` (see the `block_editor_settings_all` filter in `inc/editor.php`). Keep block-page rules written as `.block-page <selector>` (with the space), because that prefix is stripped for the editor.
- Checkpoint: after 3 to 5 states, decide whether block patterns still work or whether fields (ACF Pro) + a PHP template would be better.

## Maybe move later

- **`inc/states.php` into a plugin** (maybe). Content stored in the theme's post type disappears from the admin if the theme is switched. If Dual Credits uses the same state model, or the site might change themes, move the post type and taxonomy to a small plugin. The templates and patterns can stay in the theme.
- **`patterns/state-*.php` into the child theme**, since their copy is CounselorCredits-specific. The parent could keep a generic structure only.
- Regenerating patterns: they were generated from one structure; if you change the layout, update both patterns together.

## Open decisions

- Logo: text logo by default (`credits_logo()` splits a name ending in "Credits" and accents that word); an uploaded logo overrides it.
- Switching to a child later resets per-theme settings (custom logo, menu assignments). Re-set them after activating the child.
