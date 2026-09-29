# Stap 6: menu en footer

- **Datum:** 2026-09-29
- **Status:** Klaar
- **Commit:** geen (D-029)

## Gedaan (WP-CLI + thema-opties)

- **Hoofdmenu (ID 3):**
  - de items Home, Over mij, Ervaring, Projecten, Blog, Contact en "Portfolio (login)"
  - toegewezen aan `primary` en `primary_mobile`
- **Footermenu (ID 25, nieuw):** Disclaimer, Privacy statement, Sitemap en Gebruik van AI.
- **Sitemapmenu (ID 4):** toegewezen aan `sitemap`.
- **Knop "Portfolio (login)":** een aangepaste link met de class `menu-button`, die de stijl van `%btn--primary` krijgt. Dat staat in `_navigation.scss`, met op mobiel 10 px marge.
- **Footer:**
  - intro (nieuwe footerlayout "Tekst")
  - Navigatie (hoofdmenu)
  - Contact (e-mail + LinkedIn)
  - Informatie (footermenu)
  - subfooter "© [jaar] wesselvandenijssel"
- **Social media:** alleen LinkedIn staat nog in de opties. De placeholders zijn weg.

## Controles

- **Desktop en mobiel (Playwright):**
  - De knop is navy op `#00a3e0` (5.38:1) en linkt naar `/portfolio-minor/`.
  - Het mobiele menu is getest in geopende stand.
  - De link naar Gebruik van AI is op beide breedtes zichtbaar.
  - Er zijn geen console-fouten.
- **Pagina's:** geven 200. `/portfolio-minor/` geeft 302 naar de login.
- **Code:** `php -l` en Stylelint zijn in orde, en de branding-check geeft 0 treffers.
- **Foutlog:** geen nieuwe meldingen.
