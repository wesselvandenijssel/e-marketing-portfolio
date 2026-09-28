# Stap 3: huisstijl (kleuren en typografie)

- **Datum:** 2026-09-28
- **Status:** Klaar. De stap is uitgevoerd vóór stap 1 en 2 (D-011).
- **Commit:** geen. De opdracht vroeg om "style: add brand colors and typography", maar dat staat on hold door D-007 en D-013.

## Wat er is gedaan

### Palet en fonts
- `src/styles/partials/_variables.scss`: het palet van Wessel, plus `$form-error: #b42318` en `$focus-color`. De oude base-theme-namen (`$text-color`, `$link-color`, `$btn-primary`, `$light-gray`, `$gray`) zijn nu aliassen van het palet.
- `src/styles/partials/_config.scss`: `$public-sans`, `$font-weight-regular` (400) en `$font-weight-bold` (600). `$open-sans` is weg.
- Public Sans 400 en 600, eerst via Google Fonts. Later in dezelfde stap vervangen door zelf hosten, zie "Aanvulling" onderaan.
- In 14 tekstregels zijn de font-weights omgezet (700 → 600, 500 → 400). De 14 Font Awesome-regels zijn ongewijzigd, omdat de weight daar de icoonstijl kiest.

### Basisstijl
- `_general.scss`:
  - pagina-achtergrond `$hue-light-1`
  - body in Public Sans, line-height 1.6
  - links in lopende tekst `#0077a8`, hover navy
  - keyboard-focus met een 2px navy outline
  - `strong`/`b` op 600
- `_titles.scss`: koppen op 600. h1/h2 line-height 1.2, h3/h4 1.3.
- `_header.scss`: `main` was wit en is nu `$hue-light-1`.

### Knoppen
In `_placeholders.scss` en `_buttons.scss`:
- De primaire knop is blauw met navy tekst. Bij hover en focus wordt hij navy met witte tekst.
- De secundaire knop en de filterknop hebben een navy rand en navy tekst.
- `outline: none` bij focus is vervangen door een zichtbare `:focus-visible`.

### Formulieren en Gravity Forms
In `_forms.scss`:
- De velden hebben een rand in `$hue-grey-1`. Bij focus komt daar een navy rand en een navy outline bij.
- De placeholder is `$hue-grey-1`.
- De stap-bolletjes en de upload-knop hebben navy tekst.
- Foutlabel, foutmelding en veldrand zijn `#b42318`, nu ook voor `select`.
- De formulierkaart in het contactblok is wit.

### Overige componenten
- **Accent-tekst wordt `#0077a8`:** zoeken, auteurslinks, social-hovers in blogberichten en paginering.
- **Wit op accent wordt navy:** slider-pijlen, paginering, het telefoonicoon op mobiel, de notificatiebalk en de social-iconen.
- **Randen:** de accordeon- en menuranden gebruiken nu `$hue-grey-2` in plaats van de oude achtergrondkleur.
- **Grijze tekst:** de navy van 50% in de blogkop (3.19:1) is nu `$hue-grey-1`.
- **Hero:** navy-overlay van 65% onder de witte tekst, en een witte focusring.
- **Footer:** een witte focusring. De subfooter ging van 12 naar 14px.
- **Editorpalet:** `custom-color-palette.php` en `_color-palette.scss` bevatten nu Navy, Blauw (tekst), Grijs, Lichtblauw, Lichtgrijs en Wit. `#00a3e0` zit er niet in.
- **Loginpagina:** navy achtergrond met witte links (9.84:1).
- **Site-logo:** het tijdelijke logo (bijlage 160) is navy.

### Documentatie
- `CLAUDE.md`: Colors, de regels, de contrasttabel (tekst op achtergrond, plus states en componenten) en Typography zijn ingevuld.

## Controles

- **Contrast:** gemeten met de WCAG 2.x-formule. Alle combinaties staan in `CLAUDE.md` › Contrast. Er zijn geen niet-decoratieve combinaties onder de norm.
- **Randgeval:** `#0077a8` op `#e5f6fc` is precies 4.5002:1. Het haalt de norm, maar zonder marge. Dit staat als regel in `CLAUDE.md`.
- **Productiebuild:** een build naar een tijdelijke map (Node 24) gaf "Compiled successfully", zonder ESLint- of Stylelint-fouten. De watcher van Wessel (PID 3815) heeft `dist/` zelf bijgewerkt.
- **Losse Stylelint-CLI:** 12 meldingen, allemaal ook aanwezig in het originele base-theme:
  - `@forward` in `_abstracts.scss`
  - namen van `%btn`-placeholders
  - `.scss`-extensie in `admin.scss`

  Mijn eigen meldingen in `_hero.scss` (volgorde) zijn opgelost. Deze meldingen laten de webpack-build niet falen.
- **`php -l`:** `enqueueing.php` en `custom-color-palette.php` zijn in orde.
- **Browser (Playwright, Chromium, 1440 en 390 px):**
  - Public Sans 400 en 600 zijn geladen (`document.fonts.check`).
  - Een lege verzending toont "Dit veld is vereist." in `rgb(180, 35, 24)` en rode veldranden.
  - Keyboard-focus op de verzendknop geeft een navy outline van 2px met 2px offset.
  - De pagina-achtergrond is `#f8fafc` en de formulierkaart wit.
- **PHP-foutlog:** geen nieuwe meldingen sinds de wijzigingen.

## Voor Wessel

1. **Foutkleur:** `#b42318` is mijn keuze (D-012). Wijzigen mag, maar de nieuwe kleur moet minimaal 4.5:1 halen op `#e5f6fc`.
2. **Google Fonts** stuurt het IP-adres van bezoekers naar Google. Noem dat in het privacy statement, of host Public Sans zelf. Zelf hosten is gangbaar, na de Duitse uitspraak over Google Fonts en de AVG.
3. **Logo:** er is nog geen definitief logo (SVG). Het site-logo en het login-logo zijn tijdelijke tekstlogo's.
4. **Voor stap 4, niet in deze stap opgelost:**
   - Telefoon staat op verplicht. De opdracht zegt optioneel.
   - De veldlabels zijn verborgen (`.gfield_label { display: none }`), dus alleen de placeholder beschrijft het veld.
   - De GF-foutsamenvatting (`.gform_validation_errors`) staat op `display: none`.

## Aanvulling (2026-09-28, na de antwoorden van Wessel)

Antwoorden: font zelf hosten (D-014), nog geen logo, formulierpunten oplossen (D-015), en de oude bureaunaam uit alle `.md`-bestanden halen (D-016). Daarmee zijn punt 1, 2 en 4 hierboven afgehandeld. Punt 3 (logo) blijft open.

### Font zelf gehost
- **Bestanden:** `PublicSans-Regular` en `PublicSans-SemiBold`, woff2 + woff, uit `~/Desktop/fonts/Public Sans/`. Ze staan in `src/fonts/`, met `LICENSE.txt` (SIL OFL 1.1 + CC0, uit de officiële Public Sans-repository).
- **`components/_fonts.scss`:** twee `font-face()`-regels (`font-display: swap`). De partial laadt als eerste in `components/_main.scss`.
- **`enqueueing.php`:**
  - Google Fonts en de preconnects zijn weg
  - er is een `wp_head`-preload voor beide woff2-bestanden (met `crossorigin`)

### Formulier (Gravity Forms, formulier 1)
- **Backup:** `app/sql/2026-09-28-voor-formulierfix.sql`.
- **Telefoon (veld 4):** `isRequired` staat nu op `false`.
- **`_forms.scss`:**
  - De labels zijn zichtbaar, links uitgelijnd en 600 dik. "(Vereist)" staat in `$hue-grey-1`, 400 dik.
  - De regel `.show-label` is weg, want labels zijn nu altijd zichtbaar.
  - `.gform_validation_errors` is zichtbaar, met een rode rand links, een witte achtergrond en rode tekst (6.57:1). Het lege GF-icoon is verborgen en er is een focusring.

### Markdown
- Alle `.md`-bestanden in het project, buiten de plugins, noemen de oude bureaunaam niet meer: de twee `CLAUDE.md`-bestanden, de README's, `docs/` en `.github`/`.claude`.
- De zoekpatronen staan in het nieuwe script `bin/check-branding.sh`. Met `WP=...` doet het script ook de database-dry-run.

### Controles
- **Browser (Playwright, 1440 en 390 px):**
  - Alleen verzoeken naar `e-marketing.local`, niets naar Google.
  - Geladen fonts: `PublicSans-Regular.woff2` en `PublicSans-SemiBold.woff2`. `document.fonts.check` gaf true voor 400 en 600.
  - Labels: "Naam (Vereist)", "E-mailadres (Vereist)", "Telefoon", "Bericht (Vereist)".
  - Een lege verzending gaf een zichtbare samenvatting: "Er was een probleem met je inzending. Controleer de onderstaande velden." Die kreeg de focus. Telefoon gaf geen fout.
- **`bin/check-branding.sh`:** 0 treffers in het thema. De dry-run vindt alleen de bekende technische plugin-opties.
- **`.md`-controle:** 0 treffers in 11 bestanden.
- **Productiebuild:** "Compiled successfully". `php -l` op `enqueueing.php` is in orde.
- **Foutlog:** geen nieuwe meldingen van de site. Eén warning (`labelPlacement`) kwam uit een eigen `wp eval`-inspectie, niet uit de site.
