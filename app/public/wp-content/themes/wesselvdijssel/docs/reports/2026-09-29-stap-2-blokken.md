# Stap 2: blokken

- **Datum:** 2026-09-29
- **Status:** Klaar
- **Commit:** nog niet. Na deze stap volgt het commitvoorstel (D-007).

## Resultaat

Het thema heeft nu 14 blokken: 6 uit het base-theme en 8 nieuwe of uitgebreide. Het overzicht met de bron per blok staat in [blocks.md](../blocks.md).

| Nieuw of uitgebreid | Bron |
|---|---|
| hero (variant "Portret naast tekst") | base-theme + idee van van-der-donk `designer-intro` |
| icon-boxes | flexercise |
| timeline | vink-schilderwerken (oude stijl, omgezet naar block.json) |
| projects + CPT `project` + component `project-card` + `single-project.php` | bureau-tromp `cases` + damsteegtwaterwerken `projects` |
| statistics + component `statistic` | damsteegtwaterwerken |
| quote-slider + component `quote-slide` | flexercise |
| logo-banner | damsteegtwaterwerken |
| gallery | damsteegtwaterwerken |
| cta-banner | damsteegtwaterwerken |

Uit alle bronblokken is het volgende weggehaald:
- klantnamen, klantkleuren en klantfonts
- oude text domains en vaste teksten
- klantvelden, zoals de contactrij in de CTA, zoeken en chips in projects, de slider in logo-banner en de `motion`-package

Alle blokken gebruiken:
- de spacing van `general_section()`
- de paletvariabelen, met de contrastregels uit `CLAUDE.md`
- Public Sans in 400 en 600

## Toegankelijkheid

- **Slider:** echte `<button>`s met "Vorige" en "Volgende", bedienbaar met het toetsenbord. Bij één quote staan er geen pijlen.
- **Statistieken:** de eindwaarde staat in de HTML. Schermlezers horen "15 tot 25". Er is geen animatie als de bezoeker minder beweging wil.
- **Tijdlijn en statistieken:** echte lijsten (`<ol>`/`<ul>`).
- **Kopniveaus:** die volgen de titel van het blok.
- **Projectfilter:** echte links met `aria-current`. Het filter werkt zonder JavaScript.
- **Galerij:** links met een beschrijvende naam, en de lightbox via Fancybox.

## Ook aangepast

- **Beeldformaten (D-019):**
  - Een bug uit het base-theme zorgde dat er geen enkel eigen formaat werd aangemaakt. Die is opgelost.
  - Nieuw zijn `Portrait`, `Content`, `Avatar` en `Project card`.
- **Uploads zonder Imagick (D-022):** die crashen niet meer.
- **Editor (D-022):** gebruikt nu Public Sans en navy.
- **Commentaar (D-020):**
  - Alle commentaar is uit de SCSS gehaald. De Stylelint-instructies zijn gebleven.
  - Blokken en componenten hebben alleen nog de vaste bestandskop.
  - Vier SCSS-bestanden bevatten alleen commentaar. Die zijn verwijderd, samen met hun `@use`.
- **`post-thumbnails.php`:** de commentaren die in deze stap waren toegevoegd, zijn weer weg.

## Controles

- **`php -l`:** alle PHP-bestanden in het thema zijn in orde.
- **Linters:** ESLint en `tsc --noEmit` geven 0 fouten. Stylelint geeft dezelfde 12 meldingen als vóór deze stap. Die zitten in bestanden uit het base-theme.
- **Productiebuild:** "Compiled successfully". Er is één melding over de bundelgrootte, omdat `main` door Swiper net boven de 244 KB komt.
- **Branding:** `bin/check-branding.sh` geeft 0 treffers.
- **Testpagina `/bloktest-alle-blokken/`:**
  - **Frontend:** getest op 1440 en 390 px, met alle 14 blokken. Er zijn geen console-fouten en er is geen horizontale overloop.
  - **Interactie:** het filter "Categorie B" toont alleen Project 2. De losse projectpagina opent. De slider schuift met het toetsenbord door, met een focusring van 2px. De statistieken eindigen op de juiste waarden. De lightbox opent.
  - **Editor:** alle 14 blokken tonen een preview. De enige 404 komt van de notitie-API van WordPress, want reacties staan uit in het thema.
- **Na het weghalen van het commentaar:**
  - `main.css` is identiek. In `admin.css` zijn alleen lege regels weggevallen.
  - Screenshots van desktop en mobiel zijn pixel-identiek aan die van vóór het strippen.
- **Foutlog:** geen nieuwe meldingen uit het thema.

## Open voor Wessel

1. **Watcher:** herstart je webpack-watcher. Hij draait sinds 28-09 22:25 en neemt de nieuwe blokken niet mee: `dist/main.js` is nog van 18-09. De tests gebruikten daarom een aparte build.
2. **Testcontent opruimen** vóór stap 4:
   - de pagina "BLOKTEST alle blokken" (ID 183)
   - de projecten 180 tot en met 182
   - de categorieën 20 en 21
   - de afbeeldingen 171 tot en met 179
3. **Nieuwe beeldformaten:** bestaande uploads krijgen die pas na `wp media regenerate`.
4. **Commentaar elders:** in `src/functions/` en `src/styles/login.css` staan nog commentaren uit deze sessie, bijvoorbeeld in `enqueueing.php`, `focalpoint.php` en `custom-color-palette.php`. Die vallen buiten D-020.
