# Voortgang

Stand van zaken per stap uit [plan.md](plan.md). Keuzes staan in [decisions.md](decisions.md), rapporten in [reports/](reports/).

Status: `Gepland` · `Bezig` · `Klaar` · `Geblokkeerd`

| Stap | Onderwerp | Status | Datum klaar | Commit | Rapport |
|---|---|---|---|---|---|
| 0 | Backup, thema activeren, branding opschonen | Klaar | 2026-09-28 | geen (D-007) | [stap 0](reports/2026-09-28-stap-0-opschonen.md) |
| 1 | CPT `project`, beschermd gedeelte, rol | Deels (CPT klaar, D-018) | | | |
| 2 | Blokken kopiëren en opschonen | Klaar | 2026-09-29 | nog niet (D-007) | [stap 2](reports/2026-09-29-stap-2-blokken.md) |
| 3 | Merkstijl in `_variables.scss` | Klaar (vóór stap 1–2, D-011) | 2026-09-28 | geen (D-013) | [stap 3](reports/2026-09-28-stap-3-huisstijl.md) |
| 4 | Pagina's, menu's, formulier, Yoast | Gepland | | | |
| 5 | Content en kwaliteitscheck | Gepland | | | |

## Stap 0: backup, thema activeren, branding opschonen

- [x] `wp db export` → `app/sql/2026-09-28-voor-stap-0.sql`
- [x] `wp theme activate wesselvdijssel`
- [x] Thema: `style.css`, text domain, PHP-prefixes, `package.json`, `README.md`, login-logo, `screenshot.png`. `composer.json` bevatte niets.
- [x] Database: sitenaam, tagline, `admin_email`, thema-opties (bedrijfsnaam, e-mail, telefoon en adres leeg, subfooter), Yoast-naam, logo
- [x] Gravity Forms: notificaties naar het adres van Wessel
- [x] 7 testberichten verwijderen
- [x] Controle: branding-grep (0 treffers) en `wp search-replace --dry-run`, zie het rapport
- [x] `php -l` (80 bestanden in orde). Build niet nodig.
- [x] Homepage en bestaande pagina's laden (allemaal 200, geen oude branding in de HTML). Foutlog gecontroleerd. De 500-fout door de plugin is buiten deze sessie hersteld.
- [x] Gebruiker 1 hernoemd naar login `wesselvandenijssel` (D-009)
- [x] Media 58 en 60 plus de losse afgeleiden verwijderd
- [x] Extra oude naamgeving verwijderd: adminmenu, blokcategorie, blokicoon, `json-ld.php`, Yoast-auteur-URL

## Stap 1: CPT `project`, beschermd gedeelte, rol

- [x] CPT `project` + taxonomie `project_category` (`has_archive => false`, slug `projecten`) (D-018)
- [ ] `src/inc/protected-section.php`: rol, toegangscheck, geen lekken via REST, feeds, zoeken, sitemap of OG, noindex, geen cache
- [ ] Beoordelaarsaccount aanmaken (wachtwoord niet in de repo)
- [ ] Test als uitgelogde bezoeker

## Stap 2: blokken kopiëren en opschonen

- [x] hero: optie portretfoto
- [x] icon-boxes (flexercise)
- [x] timeline (vink-schilderwerken)
- [x] projects + filter + CPT (bureau-tromp / damsteegtwaterwerken)
- [x] cta-banner (damsteegtwaterwerken)
- [x] quote-slider (flexercise)
- [x] logo-banner (damsteegtwaterwerken)
- [x] statistics (damsteegtwaterwerken)
- [x] gallery (damsteegtwaterwerken)
- [x] Getest op de testpagina `/bloktest-alle-blokken/`: frontend desktop en mobiel, editor, filter, slider, lightbox

## Stap 3: merkstijl

- [x] Kleuren in `_variables.scss`, de oude base-theme-namen als alias
- [x] Public Sans 400/600, zelf gehost uit `src/fonts/`, met preload (D-014)
- [x] Knoppen, links, focus, formulieren, GF-meldingen, hero, footer, paginering, sliders, socials, notificatiebalk en loginpagina
- [x] Editorpalet in de merkkleuren, zonder `#00a3e0`
- [x] Brand Guidelines en contrasttabel ingevuld in `CLAUDE.md`
- [x] Tijdelijk site-logo en login-logo in navy/wit. Het definitieve logobestand ontbreekt nog.
- [x] Productiebuild zonder fouten. Screenshots van Contact (normaal, foutstaat, mobiel) en Home.

## Stap 4: pagina's, menu's, formulier, Yoast

- [ ] Nieuwe pagina's: Over mij, Ervaring, Projecten, Gebruik van AI, Portfolio minor + 10 subpagina's
- [ ] Blog (ID 136) instellen als berichtenpagina
- [ ] Hoofdmenu en footermenu (met de link naar Gebruik van AI)
- [x] Formulier: Telefoon optioneel, zichtbare labels, zichtbare foutsamenvatting (D-015)
- [ ] Formulier: privacy-toestemming, honeypot, doorsturen naar Bedankt
- [ ] Yoast: focus-keyphrase, SEO-titel en metabeschrijving per publieke pagina

## Stap 5: content en kwaliteitscheck

- [ ] Content per pagina (live site als basis, `[INVULLEN]` waar feiten ontbreken)
- [ ] Nederlandse alt-teksten
- [ ] Mobiel, tablet en desktop testen, formulier testen, beschermd deel uitgelogd testen, foutlog en console controleren

## Open punten voor Wessel

1. `local-site.json` in de site-root opnieuw laten aanmaken door Local (D-010).
2. Log voortaan in met `wesselvandenijssel` of met info@wesselvandenijssel.nl (D-009).
3. Er is nog geen logo. Het site-logo en het login-logo blijven voorlopig tekstlogo's.
4. Contactgegevens: telefoonnummer en adres zijn leeg. Vul ze in of laat ze leeg.
5. Foutkleur `#b42318` is een eigen keuze (D-012). Akkoord?
6. De plugin-README's zijn opgeschoond (D-016). De PHP van `wesselvdijssel-widgets` heeft nog de oude Plugin URI, Author URI en update-server van het stagebedrijf. Aanpassen, of zo laten omdat de updates via die server lopen?
7. `app/git-backups/` (de oude `.git`-mappen van de plugins) mag weg zodra na stap 2 alles gecommit is (D-017).
8. Repository secrets aanmaken in GitHub (Settings → Secrets and variables → Actions): `FONTAWESOME_TOKEN`, `SSH_HOST`, `SSH_USER`, `SSH_PORT`, `SSH_PRIVATE_KEY`, `SSH_KNOWN_HOSTS` en `REMOTE_PATH`.
9. Je webpack-watcher (sinds 28-09 22:25) ziet geen nieuwe bestanden. Herstart hem (`npm run dev-watch`), anders missen de nieuwe blokken hun CSS en JS op de site.
10. Testcontent opruimen vóór stap 4: pagina `BLOKTEST alle blokken`, 3 `BLOKTEST`-projecten, 2 `BLOKTEST`-categorieën en 9 `BLOKTEST`-afbeeldingen.
11. De conceptpagina "Terugbetaal- en retourneringsbeleid" (ID 166) komt van WooCommerce. Mag die weg?
