# Plan: portfoliosite Wessel van den IJssel (Datapunt 9)

Status: **goedgekeurd op 2026-09-28**. De antwoorden op de open vragen staan onderaan en gaan voor op de tekst van het plan.

Dit plan staat vast. Wijzigingen komen in [decisions.md](decisions.md), de voortgang in [progress.md](progress.md).

## Uitgangssituatie (onderzoek 2026-09-28)

1. **De site draait zonder thema.** WordPress verwijst nog naar `base-theme`, maar de map heet nu `wesselvdijssel`. Stap 0 is dus: database-export maken en daarna `wp theme activate wesselvdijssel`. Het commando `wp` in de shell werkt niet omdat de Homebrew-PHP stuk is. Gebruik de PHP van Local.
2. **De live site gaat over een developer.** Er staat "Full Stack Webdeveloper student at Hogeschool Utrecht", met een stack van React, TypeScript, PHP, Node.js, WordPress en Shopify. De berichten (`post`–`post4`) en `projects/test2` zijn testcontent. De oude lokale site `wessel-van-den-ijssel` bevat vooral het stagelogboek bij het stagebedrijf. Er is geen CV en er zijn geen echte projecten. Ontbrekende content wordt `[INVULLEN: ...]`.
3. **Er zit nog veel branding van het base-theme in de site.**
   - In het thema: 57 bestanden, waaronder `style.css`, de oude text domain en de oude PHP-prefixes.
   - In de database: de oude standaard-sitenaam, `admin_email`, de bedrijfsnaam en het e-mailadres in de thema-opties, en de subfooter.
   - In Gravity Forms: beide notificaties gaan naar het adres van het stagebedrijf.

Bruikbaar van de live site:
- info@wesselvandenijssel.nl
- LinkedIn `/in/wessel-van-den-ijssel/`
- GitHub `wesselvandenijssel`
- opleiding HU
- tech stack
- de teksten over MySpace en video-editing (Over-pagina)

## Sitemap

### Publiek

| Pagina | Status | URL |
|---|---|---|
| Home | bestaat (ID 8) | `/` |
| Over mij | nieuw | `/over-mij/` |
| Ervaring (CV) | nieuw | `/ervaring/` |
| Projecten | nieuw, met CPT `project` + taxonomie `project_category` | `/projecten/`, losse projecten op `/projecten/<slug>/` |
| Blog | bestaat (ID 136), instellen als berichtenpagina | `/blog/` |
| Contact | bestaat (ID 12) | `/contact/` |
| Bedankt, Privacy statement, Disclaimer | bestaan (ID 14, 16, 18), subpagina's van Contact | zie antwoord 5 |
| Sitemap | bestaat (ID 22) | `/sitemap/` |
| Gebruik van AI | nieuw, APA-vermelding + footerlink | `/gebruik-van-ai/` |

Projecten wordt een gewone pagina met het projectgrid-blok, geen CPT-archief (`has_archive => false`). Zo kun je hem met blokken en Yoast beheren.

### Beschermd: "Portfolio minor"

Een hoofdpagina `/portfolio-minor/` met 10 subpagina's:
- samenvatting portfolio
- Voice Card en reflectie
- motivatie en persoonlijke groei
- nulmeting / 1-meting / eindmeting
- leervragen en leerdoelen
- toegepaste theorie
- bijdrage aan het team (360 graden feedback, certificaten)
- persoonlijke bijdrage per datapunt
- aanvullende kennis
- conclusie en verder leren

## Blokken

De set blijft klein: 6 blokken uit het thema, plus 6 die gekopieerd of aangepast worden. Een aparte FAQ-module is niet nodig. De accordeon-layout zit al in de flexibele content van het base-theme.

| Blok | Bron | Aanpassing |
|---|---|---|
| hero | base-theme | optie "portretfoto" toevoegen, idee van `designer-intro` (van-der-donk) |
| content-image, centered-content, contact, blog, background | base-theme | alleen de branding |
| icon-boxes (skills, tools, diensten) | flexercise `icon-boxes` | generiek, geen dependencies |
| timeline (werk, opleiding, datapunten) | vink-schilderwerken `timeline` | oude stijl: `block.json` toevoegen, `clone_titles_block_title`, velden voor periode en organisatie |
| projects + CPT `project` | structuur van bureau-tromp `cases`, categoriefilter van damsteegtwaterwerken `projects`, CPT uit damsteegtwaterwerken | de zware delen van damsteeg (zoeken, chips, 3 componenten) blijven weg |
| cta-banner | damsteegtwaterwerken `cta-banner` | titel, afbeelding en knoppen |
| quote-slider (testimonials, 360 graden) | flexercise `quote-slider` | Swiper zit al in het thema |
| logo-banner (tools, certificaten) | damsteegtwaterwerken `logo-banner` | statisch grid |
| statistics (meetmomenten, resultaten) | damsteegtwaterwerken `statistics` | count-up bij scrollen |
| gallery (certificaten, projectbeelden) | damsteegtwaterwerken `gallery` | Fancybox zit al in het thema |

Een skills-blok met voortgangsbalken bestaat in geen enkel project. Het wordt niet gebouwd, want icon-boxes en statistics dekken dat af.

## Blokken per pagina

- **Home:** hero (portret) · icon-boxes "wat ik doe" · projects (3 nieuwste) · content-image "kort over mij" · quote-slider · logo-banner (tools) · blog (3 nieuwste) · cta-banner
- **Over mij:** hero · content-image (MySpace-verhaal, van de live site) · content-image (video-editing, van de live site) · icon-boxes (vaardigheden) · cta-banner
- **Ervaring:** hero · timeline (werk) · timeline (opleiding: HU, minor E-marketing) · logo-banner (certificaten) · cta-banner met CV-download
- **Projecten:** hero · projects (alles, met filter) · cta-banner
- **Los project** (`single-project.php`): kop met afbeelding, content-image, statistics (resultaten), gallery
- **Contact:** contact (GF-formulier)
- **Bedankt, Disclaimer, Privacy statement, Gebruik van AI:** centered-content
- **Portfolio minor:**
  - de hoofdpagina gebruikt icon-boxes als inhoudsopgave
  - de subpagina's gebruiken centered-content en content-image met accordeons
  - meetmomenten: statistics
  - 360 graden feedback: quote-slider
  - certificaten: gallery
  - bijdrage per datapunt: timeline

## Aanpak login-gedeelte

**Inloggen met een WordPress-account en een eigen rol**, niet het WordPress-paginawachtwoord. Een paginawachtwoord geldt niet automatisch voor subpagina's en is één gedeeld wachtwoord.

Alle logica komt in `src/inc/protected-section.php`, met commentaar en een `require` in `functions.php`:

1. **Rol `portfolio_beoordelaar`** met de capability `read_portfolio_minor`. Deze rol komt niet in wp-admin en ziet geen adminbalk.
2. **Toegangscheck** op de hoofdpagina en alle subpagina's, op basis van de parent. Zonder rechten ga je naar een login in eigen stijl, via `wp-login.php` met `redirect_to`.
3. **Nergens lekken:**
   - de REST API geeft deze pagina's niet terug aan gasten
   - ze staan niet in de zoekresultaten, feeds of menu's voor gasten
   - ze staan niet in de Yoast-sitemap
   - ze krijgen `noindex, nofollow` via Yoast en een `X-Robots-Tag`-header
   - geen Open Graph-tags
4. **Geen cache:** `nocache_headers()` op beschermde pagina's. WP Rocket staat uit. Gaat hij aan, dan worden deze pagina's uitgesloten.
5. **Test:** als uitgelogde bezoeker de pagina, `/wp-json/wp/v2/pages`, `/feed/`, `?s=` en `sitemap_index.xml` controleren.

## Volgorde van werken

Na elke stap volgt een commit.

0. `wp db export`, thema activeren, de oude branding uit thema en database halen, grep en dry-run rapporteren
1. CPT `project`, beschermd gedeelte, rol
2. Blokken kopiëren en opschonen (per blok de bron in de header van `config.php`)
3. Merkstijl in `_variables.scss`. Kleuren en fonts staan op `[INVULLEN]`. De oude site gebruikte Public Sans en blauw `#006BE6` / navy `#00244D`, als voorstel.
4. Pagina's, menu's, formulier en Yoast via WP-CLI
5. Content invullen met `[INVULLEN]` waar feiten ontbreken, daarna de kwaliteitscheck

## Antwoorden op de open vragen (2026-09-28)

| # | Vraag | Antwoord | Gevolg voor het plan |
|---|---|---|---|
| 1 | Positionering: hoe wil je jezelf noemen? | **Front-end developer** | Hero, SEO-titels, tagline en Person-schema gebruiken "front-end developer". Zie D-001 over de eis "online marketer". |
| 2 | Mag de stage bij het stagebedrijf op je CV, met klantnamen? | **Ja** | Het stagebedrijf en klantnamen mogen als CV-content op Ervaring en bij projecten. Dit zijn uitzonderingen op de branding-check en de dry-run. Het thema zelf blijft vrij van de oude branding. |
| 3 | Toegang voor docenten: één gedeeld account of een account per beoordelaar? | **1 account** | Eén gebruiker met de rol `portfolio_beoordelaar`. Het wachtwoord komt nooit in de repo of in `docs/`. |
| 4 | Text domain `wesselvandenijssel` terwijl de map `wesselvdijssel` blijft? | **Ja** | Text domain en prefixes worden `wesselvandenijssel`. De map blijft `wesselvdijssel`. |
| 5 | Bedankt, Privacy statement en Disclaimer naar root? Testberichten weg? | **Pagina's niet verplaatsen, testberichten wel weg** | Bedankt blijft op `/contact/bedankt/`. De GF-bevestiging stuurt door naar die pagina. De 7 testberichten worden verwijderd in stap 0. |
| 6 | Plugins: `afl-wc-utm` uit? | **Nee** | Alle plugins blijven zoals ze zijn, ook `afl-wc-utm` en de `wesselvdijssel-*`-plugins. |
