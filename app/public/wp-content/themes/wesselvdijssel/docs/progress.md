# Voortgang

Stand van zaken per stap uit [plan.md](plan.md). Keuzes staan in [decisions.md](decisions.md), rapporten in [reports/](reports/).

Status: `Gepland` · `Bezig` · `Klaar` · `Geblokkeerd`

| Stap | Onderwerp | Status | Datum klaar | Commit | Rapport |
|---|---|---|---|---|---|
| 0 | Backup, thema activeren, branding opschonen | Klaar | 2026-09-28 | geen (D-007) | [stap 0](reports/2026-09-28-stap-0-opschonen.md) |
| 1 | CPT `project`, beschermd gedeelte, rol | Deels (CPT klaar, D-018) | | | |
| 2 | Blokken kopiëren en opschonen | Klaar | 2026-09-29 | geen (D-029) | [stap 2](reports/2026-09-29-stap-2-blokken.md) |
| 3 | Merkstijl in `_variables.scss` | Klaar (vóór stap 1–2, D-011) | 2026-09-28 | geen (D-013) | [stap 3](reports/2026-09-28-stap-3-huisstijl.md) |
| 4 | Pagina's, menu's, formulier, Yoast | Klaar (met INVULLEN-punten) | 2026-09-29 | geen (D-029) | [stap 4](reports/2026-09-29-stap-4-paginas.md) |
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

- [x] Nieuwe pagina's: Over mij, Ervaring, Projecten, Gebruik van AI. Home, Contact, Bedankt, Privacy statement en Disclaimer zijn opnieuw gevuld.
- [ ] Portfolio minor + 10 subpagina's (hoort bij stap 1: het beschermde gedeelte)
- [x] Blog (ID 136) ingesteld als berichtenpagina
- [x] Hoofdmenu, sitemapmenu, footerkolom "Navigatie" en de link naar Gebruik van AI in de subfooter
- [x] Formulier: Telefoon optioneel, toestemmingsvinkje, honeypot, doorsturen naar Bedankt, meldingen naar info@, geen IP-adres (D-025)
- [x] 8 projecten met velden, beelden en categorieën (D-023, D-024)
- [x] 404-pagina in de je-vorm, met knoppen
- [x] Yoast: focus-keyphrase, SEO-titel en metabeschrijving per publieke pagina en per project; Bedankt op noindex; de site als persoon

## Stap 5: content en kwaliteitscheck

- [ ] Content per pagina (live site als basis, `[INVULLEN]` waar feiten ontbreken)
- [ ] Nederlandse alt-teksten
- [ ] Mobiel, tablet en desktop testen, formulier testen, beschermd deel uitgelogd testen, foutlog en console controleren

## Open punten voor Wessel

1. **`[INVULLEN]` op de site:**
   - Over mij: je merk IK, wat je leert in de minor, hobby's
   - Ervaring: het startjaar van HBO-ICT, de school en einddatum van de minor, en de omschrijving van de minor
   - Contact: de reactietermijn
   - Privacy statement: de bewaartermijn en de hostingpartij
   - Gebruik van AI: controleren en aanvullen
   - Projecten: het resultaat van SCX Solar en van The Souks
2. **Cv:** op Ervaring is nog geen downloadknop. `Professioneel CV A4.pdf` in je Downloads is een lege template.
3. **Foto:** er is een betere portretfoto nodig. De huidige is 400 × 400 px, uit je oude site.
4. **Server (D-027):** op emarketing.wesselvandenijssel.nl staat nu lumie. Ook ontbreken daar de database-migratie, de themaactivatie en `blog_public` = 1.
5. **Watcher:** herstart je webpack-watcher, zie het rapport van stap 2.
6. **Commits (D-029):** er wordt niets gecommit tot je daarom vraagt. Stap 0 tot en met 4 staan nog als wijzigingen klaar.
