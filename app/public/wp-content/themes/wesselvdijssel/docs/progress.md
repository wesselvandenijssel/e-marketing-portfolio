# Voortgang

Stand van zaken per stap uit [plan.md](plan.md). Keuzes staan in [decisions.md](decisions.md), rapporten in [reports/](reports/).

Status: `Gepland` · `Bezig` · `Klaar` · `Geblokkeerd`

| Stap | Onderwerp | Status | Datum klaar | Commit | Rapport |
|---|---|---|---|---|---|
| 0 | Backup, thema activeren, branding opschonen | Klaar | 2026-09-28 | geen (D-007) | [stap 0](reports/2026-09-28-stap-0-opschonen.md) |
| 1 | CPT `project`, beschermd gedeelte, rol | Klaar (D-018, D-031) | 2026-09-29 | geen (D-029) | [stap 1 + 5](reports/2026-09-29-stap-5-portfolio-minor.md) |
| 2 | Blokken kopiëren en opschonen | Klaar | 2026-09-29 | geen (D-029) | [stap 2](reports/2026-09-29-stap-2-blokken.md) |
| 3 | Merkstijl in `_variables.scss` | Klaar (vóór stap 1–2, D-011) | 2026-09-28 | geen (D-013) | [stap 3](reports/2026-09-28-stap-3-huisstijl.md) |
| 4 | Pagina's, menu's, formulier, Yoast | Klaar (met INVULLEN-punten) | 2026-09-29 | geen (D-029) | [stap 4](reports/2026-09-29-stap-4-paginas.md) |
| 5 | Content en kwaliteitscheck | Klaar, met INVULLEN-punten (D-035) | 2026-09-29 | geen (D-029) | [stap 7](reports/2026-09-29-stap-7-content-seo.md) |
| 6 | Menu en footer (extra opdracht) | Klaar (D-033) | 2026-09-29 | geen (D-029) | [stap 6](reports/2026-09-29-stap-6-menu-footer.md) |
| 7 | Eindcontrole | Klaar (D-036) | 2026-09-29 | geen (D-029) | [stap 8](reports/2026-09-29-stap-8-controle.md) |
| – | Scrollanimaties (extra opdracht) | Klaar (D-037) | 2026-09-29 | geen (D-029) | [animaties](reports/2026-09-29-animaties.md) |

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
- [x] `src/inc/protected-section.php`: rol, toegangscheck, geen lekken via REST, feeds, zoeken, sitemap of OG, noindex, geen cache (D-031)
- [x] Beoordelaarsaccount `beoordelaar` aangemaakt (wachtwoord niet in de repo)
- [x] Getest als uitgelogde bezoeker en als beoordelaar
- [x] Melding over vertalingen die te vroeg laden opgelost (D-032)

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

- [x] Nieuwe pagina's: Over mij, Ervaring, Projecten, Gebruik van AI. Home, Contact, Bedankt, Privacy statement en Disclaimer zijn opnieuw gevuld.
- [x] Portfolio minor + 11 subpagina's met vaste opbouw en `[INVULLEN]` (D-031)
- [x] Blog (ID 136) ingesteld als berichtenpagina
- [x] Hoofdmenu, sitemapmenu, footerkolom "Navigatie" en de link naar Gebruik van AI in de subfooter
- [x] Formulier: Telefoon optioneel, toestemmingsvinkje, honeypot, doorsturen naar Bedankt, meldingen naar info@, geen IP-adres (D-025)
- [x] 8 projecten met velden, beelden en categorieën (D-023, D-024)
- [x] 404-pagina in de je-vorm, met knoppen
- [x] Yoast: focus-keyphrase, SEO-titel en metabeschrijving per publieke pagina en per project; Bedankt op noindex; de site als persoon

## Stap 5: content en kwaliteitscheck

- [x] Content per pagina, met de live site als basis en `[INVULLEN]` waar feiten ontbreken
- [x] Nederlandse alt-teksten bij alle afbeeldingen
- [x] Yoast bij alle publieke pagina's en projecten
- [x] Gebruik van AI, met APA-vermelding
- [x] Getest op mobiel (390), tablet (820) en desktop (1440): geen overloop, 1 h1 per pagina, geen JS-fouten
- [x] Formulier, melding en redirect getest (stap 4)
- [x] Beschermd deel uitgelogd getest (stap 5)
- [x] PHP-foutlog en console gecontroleerd

## Open punten voor Wessel

1. **`[INVULLEN]` op de site:**
   - Portfolio minor: 12 pagina's met samen zo'n 150 plekken. Dit is het bewijs voor de beoordeling.
   - Gebruik van AI: 3 plekken (verplichte pagina)
   - Over mij: concepttekst merk IK nalezen (D-047)
   - RideLoop: klopt de periode "Mei – juni 2026"? Git zegt 19 maart – 14 april 2026 (D-076)
2. **Tracking:** controleer in Clarity of er opnames binnenkomen nu GTM is gepubliceerd (D-068).
3. **Server (D-027):** op emarketing.wesselvandenijssel.nl staat nu lumie. Nodig voor live:
   - database-migratie (met search-replace van de domeinnaam), themaactivatie, `blog_public` = 1
   - https, want de UTM-cookies hebben de vlag `Secure` (D-068)
   - plugins los installeren: Complianz met Nederlands taalpakket, de reCAPTCHA-add-on van Gravity Forms met sleutels, AFL UTM Tracker
   - daarna de sleutel `cmplz_blocked_scripts` uit de optie `cmplz_transients` halen (D-069)
   - `WP_DEBUG` uit, en mail via SMTP zodat formuliermails aankomen
4. **Na livegang testen:** contactformulier met mail en doorverwijzing naar `/bedankt`, cookiebanner (weigeren en accepteren), Portfolio minor als uitgelogde bezoeker.
5. **Beoordelaar:** geef de docenten de URL `/portfolio-minor/`, de login `beoordelaar` en het wachtwoord. Op de productieserver maak je het account opnieuw aan, met een nieuw wachtwoord.
6. **Cv:** klaar (D-053). Pas `~/Desktop/Portfolio/CV/cv.html` aan en vraag om een nieuwe pdf als er iets verandert.
7. **Foto:** opgelost (D-041). Voor een hero met video: stuur de Wistia-embedcode.
