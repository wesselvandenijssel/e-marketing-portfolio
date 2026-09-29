# Beslissingen

Log van keuzes en afwijkingen van [plan.md](plan.md). Nieuwste onderaan. Verwijder nooit een regel. Een vervangen beslissing krijgt "Vervangen door D-xxx".

Format per beslissing: datum, beslissing, reden, gevolg.

## D-001: Positionering "front-end developer"

- **Datum:** 2026-09-28
- **Beslissing:** Wessel presenteert zich op de publieke site als front-end developer (antwoord 1).
- **Reden:** keuze van Wessel. Het sluit aan op de live site en zijn opleiding aan de HU.
- **Gevolg:** hero, SEO-titels, tagline en Person-schema gebruiken "front-end developer".
- **Risico:** de opdracht (Datapunt 9) zegt dat het publieke deel "Wessel promoot als online marketer". Wessel heeft dat risico zelf afgewogen. Dit wordt niet opnieuw voorgesteld.

## D-002: Het stagebedrijf en klantnamen mogen als CV-content

- **Datum:** 2026-09-28
- **Beslissing:** de stage bij het stagebedrijf en klantnamen (zoals SCX Solar en Rentwereld) mogen op de pagina Ervaring en bij projecten staan (antwoord 2).
- **Reden:** het is echte werkervaring. Het gaat niet om branding van het thema.
- **Gevolg:** het thema, de opties, de formulieren en de login blijven vrij van de oude branding. Treffers in de content van Ervaring en van `project`-posts zijn toegestaan. De rapporten van de branding-check en de dry-run vermelden ze als uitzondering. Voer een search-replace op de oude bureaunaam nooit uit over alle tabellen, alleen gericht.

## D-003: Eén gedeeld beoordelaarsaccount

- **Datum:** 2026-09-28
- **Beslissing:** er komt één WordPress-gebruiker met de rol `portfolio_beoordelaar` (antwoord 3).
- **Gevolg:** de inloggegevens deelt Wessel zelf met de docenten. Het wachtwoord komt nooit in git, `docs/` of de rapporten.

## D-004: Text domain wijkt af van de mapnaam

- **Datum:** 2026-09-28
- **Beslissing:** de text domain en de PHP-prefixes worden `wesselvandenijssel`. De themamap blijft `wesselvdijssel` (antwoord 4).
- **Gevolg:** in `style.css` staat `Text Domain: wesselvandenijssel`. `load_theme_textdomain()` gebruikt dezelfde naam.

## D-005: Pagina's blijven onder Contact, testberichten gaan weg

- **Datum:** 2026-09-28
- **Beslissing:** Bedankt, Privacy statement en Disclaimer blijven subpagina's van Contact. De 7 testberichten worden verwijderd (antwoord 5).
- **Gevolg:** de GF-bevestiging stuurt door naar de pagina Bedankt (`/contact/bedankt/`), niet naar `/bedankt`. Die eis uit `CLAUDE.md` geldt hier als "doorsturen naar de Bedankt-pagina". De testberichten worden in stap 0 verwijderd, na `wp db export`.

## D-006: Plugins blijven ongewijzigd

- **Datum:** 2026-09-28
- **Beslissing:** er worden geen plugins aan- of uitgezet (antwoord 6). Dat geldt ook voor `afl-wc-utm` en de `wesselvdijssel-*`-plugins.
- **Gevolg:** WP Rocket blijft uit. Gaat hij later toch aan, dan eerst de beschermde pagina's uitsluiten (zie het plan, login-gedeelte, punt 4).

## D-007: Eerste commit pas na stap 2 (commitdeel vervangen door D-029)

- **Datum:** 2026-09-28
- **Beslissing:** er wordt niets gecommit tot stap 2 klaar is. Ook de docs-commit uit de opdracht vervalt. Stap 0 start zonder commit.
- **Reden:** keuze van Wessel.
- **Gevolg:** stap 0 tot en met 2 krijgen `Klaar` zonder commit-hash. Na stap 2 volgt een voorstel voor de commits. Vanaf stap 3 geldt weer één commit per stap. `CLAUDE.md` bestaat alleen lokaal, want de root-`.gitignore` sluit het uit.

## D-008: De plugin customer-journey staat bewust aan

- **Datum:** 2026-09-28
- **Beslissing:** `wesselvdijssel-customer-journey` is actief. Wessel heeft hem zelf aangezet en regel 50 hersteld.
- **Gevolg:** dit is een aanvulling op D-006. De plugin blijft aan en wordt vanuit het thema niet aangepast.

## D-009: Gebruiker 1 hernoemd, login `wesselvandenijssel`

- **Datum:** 2026-09-28
- **Beslissing:** gebruiker 1 is aangepast:
  - de login ging van de oude bureaunaam naar `wesselvandenijssel`
  - de naam is "Wessel van den IJssel"
  - het e-mailadres is info@wesselvandenijssel.nl
  - de auteur-slug is `wesselvandenijssel`
- **Reden:** akkoord van Wessel. De loginnaam was vrij te kiezen. Er is gekozen voor dezelfde naam als de text domain.
- **Gevolg:** het wachtwoord is ongewijzigd. Inloggen gaat voortaan met `wesselvandenijssel` of met het e-mailadres. De auteur-URL is `/author/wesselvandenijssel/`, de oude auteur-URL geeft 404.

## D-010: `local-site.json` regelt Wessel zelf

- **Datum:** 2026-09-28
- **Beslissing:** Wessel laat Local `local-site.json` in de site-root opnieuw aanmaken.
- **Gevolg:** tot die tijd wijst `npm run dev-watch` (BrowserSync) naar `base-theme.local`. `npm run dev` en `npm run build` werken wel.

## D-011: Stap 3 (merkstijl) vóór stap 1 en 2

- **Datum:** 2026-09-28
- **Beslissing:** Wessel leverde de huisstijl aan. Stap 3 is uitgevoerd voordat stap 1 en 2 klaar waren.
- **Gevolg:** blokken die in stap 2 worden gekopieerd, gebruiken meteen het nieuwe palet en volgen de contrastregels in `CLAUDE.md`.

## D-012: Aanvullingen op de huisstijl

- **Datum:** 2026-09-28
- **Beslissing:** de volgende punten ontbraken in de brief of botsten met WCAG. Ze zijn zo ingevuld:
  1. **Foutkleur `#b42318`:** de oude `#f00` haalt maar 4.00:1 op wit. De nieuwe kleur haalt 5.92:1 of meer op elke lichte achtergrond.
  2. **Randen van invoervelden in `$hue-grey-1`:** `$hue-grey-2` haalt 1.23:1 op wit, te weinig voor een veldrand (minimaal 3:1). Grey-2 blijft voor decoratieve scheidingslijnen.
  3. **Secundaire en filterknoppen:** navy rand en navy tekst. De oude code gebruikte `$btn-primary` als tekstkleur, en dat zou `#00a3e0` op wit worden.
  4. **Editorpalet zonder `#00a3e0`:** het palet wordt ook voor tekstkleur gebruikt.
  5. **Hero:** navy-overlay van 65% onder de witte tekst.
  6. **Pagina en formulier:** de pagina-achtergrond is nu `$hue-light-1` (`main` was wit) en de formulierkaart wit, zoals de brief vraagt.
  7. **Focusring:** zichtbare keyboard-focus, 2px navy. De oude `%btn` had `outline: none`.
  8. **Subfooter:** van 12px naar 14px, de kleinste stijl in de typografietabel.
- **Reden:** WCAG 2.2 AA en de regels uit de brief.
- **Gevolg:** Wessel kan de foutkleur nog wijzigen. Een vervanger moet minimaal 4.5:1 halen op `#e5f6fc`.

## D-013: Geen commit voor de huisstijl

- **Datum:** 2026-09-28
- **Beslissing:** de opdracht vroeg om een commit "style: add brand colors and typography". Die is niet gemaakt, want D-007 geldt nog: eerst committen na stap 2.
- **Gevolg:** de commitboodschap staat klaar voor het commitvoorstel na stap 2. Commit eerder alleen als Wessel dat expliciet vraagt.

## D-014: Public Sans zelf hosten

- **Datum:** 2026-09-28
- **Beslissing:** Public Sans wordt zelf gehost, niet via Google Fonts. Dit vervangt de Google Fonts-aanpak uit stap 3.
- **Reden:** keuze van Wessel. Er gaat geen IP-adres naar Google, dus het privacy statement hoeft Google Fonts niet te noemen.
- **Gevolg:**
  - `PublicSans-Regular` en `PublicSans-SemiBold` (woff2 + woff) komen van het bureaublad (`~/Desktop/fonts/Public Sans/`) en staan nu in `src/fonts/`
  - de licentie staat in `src/fonts/LICENSE.txt`
  - `@font-face` staat in `components/_fonts.scss`, met een preload in `enqueueing.php`

## D-015: Formulier-toegankelijkheid opgelost vóór stap 4

- **Datum:** 2026-09-28
- **Beslissing:** drie formulierpunten zijn nu al opgelost, op verzoek van Wessel:
  - Telefoon is optioneel
  - de labels zijn zichtbaar
  - de foutsamenvatting van Gravity Forms is zichtbaar
- **Gevolg:** in stap 4 blijven voor het formulier over: de privacy-toestemming, de honeypot en het doorsturen naar Bedankt. De placeholders zijn gebleven naast de labels.

## D-016: Geen oude bureaunaam in Markdown

- **Datum:** 2026-09-28
- **Beslissing:** geen enkel `.md`-bestand in het project noemt nog de oude bureaunaam of de afkortingen ervan.
- **Reden:** keuze van Wessel.
- **Gevolg:**
  - De docs spreken van "het stagebedrijf", "de oude branding" of "het base-theme".
  - De zoekpatronen staan in `bin/check-branding.sh`, niet in `CLAUDE.md`.
  - De README's van de plugins `wesselvdijssel-widgets` en `wesselvdijssel-customer-journey` zijn wel aangepast. Wessel gaf daar expliciet toestemming voor, als uitzondering op het verbod op wijzigingen in pluginbestanden. Alleen de README's zijn aangepast, niet de PHP.
  - De globale `~/.claude/CLAUDE.md` valt buiten dit project en is niet aangeraakt.

## D-017: Deploy en Font Awesome-token zoals in het lumie-project

- **Datum:** 2026-09-28
- **Beslissing:** het Font Awesome-token komt niet in git. Het staat als repository secret in GitHub (Wessel koos repository secrets in plaats van een environment). De deploy-workflow is overgenomen uit lumie.
- **Gevolg:**
  - `.npmrc` staat in de `.gitignore` van het thema. Hij was nooit gecommit, want er zijn nog geen commits.
  - In de repository-root staan nu `.github/workflows/deploy.yml` en `.github/deploy-excludes.txt`, overgenomen uit lumie. De afwijkingen:
    - geen `environment: production`, want de secrets zijn repository secrets
    - de namen van thema en plugins
    - `docs/`, `bin/`, `README.md`, `playwright.config.ts` en de composer-bestanden gaan niet naar de server
    - een extra controle stopt de deploy als een plugin leeg uit de checkout komt
  - De trigger is een push naar `master`, zoals in lumie. Deze repo werkt nu op `main`, dus er gaat niets automatisch live tot er een `master`-branch is.
  - De root-`.gitignore` laat nu ook `wesselvdijssel-widgets` toe. Die ontbrak.
  - Het thema heeft nu ook lumie's `cleanup-screenshots.yml` en `approve-bot-workflow-runs.yml`. Workflows in de themamap draaien niet op GitHub, want alleen die in de root doen dat.
- **Opgelost (akkoord van Wessel):** de eigen `.git`-mappen van beide plugins zijn verplaatst naar `app/git-backups/` (genegeerd door git). Er waren geen niet-gepushte commits of stashes. De plugins komen nu als gewone bestanden in de repo (125 en 124 bestanden). `app/git-backups/` mag weg zodra alles gecommit is.

## D-018: CPT `project` gebouwd in stap 2

- **Datum:** 2026-09-29
- **Beslissing:** het CPT `project` en de taxonomie `project_category` zijn samen met het projectblok gebouwd, omdat het blok ze nodig heeft.
- **Gevolg:** van stap 1 is dit deel klaar. Het beschermde gedeelte, de rol en het beoordelaarsaccount staan nog open.

## D-019: Beeldformaten hersteld en aangevuld

- **Datum:** 2026-09-29
- **Beslissing:** het base-theme las de instelling voor beeldformaten uit `options`, maar die staat op `utilities`. Daardoor werd geen enkel eigen formaat aangemaakt. Dit is opgelost in `post-thumbnails.php` en `acf/clones/image.php`.
- **Gevolg:**
  - de nieuwe formaten `Portrait`, `Content`, `Avatar` en `Project card` zijn toegevoegd (zie blocks.md)
  - bestaande uploads krijgen de nieuwe formaten pas na `wp media regenerate`

## D-020: Commentaarbeleid

- **Datum:** 2026-09-29
- **Beslissing** (Wessel):
  - SCSS-bestanden bevatten geen commentaar. Alleen `/* stylelint-disable … */`-instructies blijven.
  - PHP- en TS-bestanden in `blocks/` en `components/` bevatten alleen de vaste kop: `// Exit if accessed directly.` achter de ABSPATH-regel, en in `view.php` `/** <Titel> Block Template. */`.
- **Gevolg:**
  - de herkomst van blokken staat in `docs/blocks.md`, niet meer als `Source:`-regel in `config.php`
  - lege SCSS-bestanden die alleen commentaar bevatten zijn verwijderd, met hun `@use`
  - de gecompileerde CSS en de screenshots zijn identiek aan die van vóór het strippen

## D-021: Iconen in Icoonblokken als `<i>`-element

- **Datum:** 2026-09-29
- **Beslissing:** het veld "icoon" (ACF Font Awesome) levert een `<i>`-element. Het blok toont dat element in een `aria-hidden`-span.
- **Reden:** iconen die een redacteur zelf kiest, kunnen niet via vaste codepoints in `_variables.scss`. Dit is een uitzondering op de regel "iconen via pseudo-elementen".

## D-022: Fouten uit het base-theme opgelost tijdens stap 2

- **Datum:** 2026-09-29
- **Beslissing:** drie fouten uit het base-theme zijn opgelost:
  - **Uploads zonder Imagick:** de WebP-omzetting in `focalpoint.php` crashte elke upload als Imagick ontbreekt. Nu blijft dan het origineel staan.
  - **Tijdlijn:** de algemene regel `.entry-content ol` gaf de tijdlijn nummers en een marge. De tijdlijnregel is nu specifieker.
  - **Editor-typografie:** de editor gebruikte een schreeflettertype. `admin.scss` zet nu Public Sans en navy op `.editor-styles-wrapper`.

## D-023: Projecten als pagina met blok, met vaste projectvelden

- **Datum:** 2026-09-29
- **Beslissing:** "Projecten" is een pagina (`/projecten/`) met het projectblok en een categoriefilter. Er is geen CPT-archief, en dat volgt het plan. Losse projecten hebben vaste velden:
  - opdrachtgever
  - periode
  - website
  - tools
  - opdracht
  - mijn rol
  - aanpak
  - resultaat
  - beelden
- **Gevolg:** de velden staan in `src/functions/acf/post-types/project.php` en worden getoond via het component `project-details` in `single-project.php`.

## D-024: Projectinhoud alleen uit bewijs

- **Datum:** 2026-09-29
- **Beslissing:** de 8 projecten komen uit:
  - de git-commits van Wessel in de Local-sites
  - zijn stagelogboek (september 2023 tot mei 2024)
  - de case-pagina's van het stagebedrijf
- **Gevolg:**
  - "Aanpak" noemt alleen wat uit commits en logboek blijkt.
  - Resultaatcijfers staan er als "Het team meldt …" en komen letterlijk uit de case. Er staat een link naar de bron bij.
  - Zonder case is het resultaat `[INVULLEN]`. Dat geldt voor SCX Solar en The Souks.
  - De projectbeelden zijn screenshots van de live websites, gemaakt op 29-09-2026.

## D-025: Formulier slaat geen IP-adres meer op

- **Datum:** 2026-09-29
- **Beslissing:** in formulier 1 staat "IP-adres niet opslaan" aan (`personalData.preventIP`).
- **Gevolg:** het formulier bewaart naam, e-mail, telefoon, bericht en toestemming. De plugins voegen daar twee dingen aan toe:
  - de customer-journey-plugin: de bekeken pagina's
  - Gravity Forms: de browser (user agent)

  UTM-gegevens slaat de UTM-plugin alleen op met toestemming, en die wordt nu niet gevraagd. Het privacy statement beschrijft dit. Of de twee tracking-plugins aan blijven, beslist Wessel. De opdracht zegt "alleen naam, e-mail, telefoon en bericht".

## D-026: Iconen in de stijl regular

- **Datum:** 2026-09-29
- **Beslissing:** icoonblokken gebruiken de stijl "regular".
- **Reden:** de Font Awesome-kit bevat per stijl maar een deel van de iconen. Zo heeft solid geen `cube` en `circle-play`.
- **Gevolg:** een nieuw icoon kan in de editor gekozen worden, maar werkt alleen als het in de kit staat. De kit is van het stagebedrijf en kan alleen via hun account worden uitgebreid.

## D-027: Deploydoel gevonden

- **Datum:** 2026-09-29
- **Beslissing:** `REMOTE_PATH` is `/home/<gebruiker>/domains/wesselvandenijssel.nl/public_html/emarketing` (subdomein als submap). De droge run is volledig groen.
- **Gevolg:**
  - Op die installatie staat nu een kopie van lumie, met het thema `lumie` actief.
  - Een deploy zet het thema en de plugins ernaast, maar activeert niets en zet geen database over.
  - `blog_public` moet daar op 1 staan. Lokaal staat hij op 0, waardoor de hele site op noindex staat.

## D-028: Tracking-plugins blijven aan

- **Datum:** 2026-09-29
- **Beslissing:** de plugins customer-journey en UTM blijven actief (keuze van Wessel).
- **Gevolg:** het privacy statement blijft zoals het is en beschrijft de extra gegevens: de bekeken pagina's, de browser en, met toestemming, UTM-gegevens. Dit wijkt af van de regel "alleen naam, e-mail, telefoon en bericht". Wessel heeft dat risico afgewogen. Pas het privacy statement aan als er een cookiebanner of statistieken bij komen.

## D-029: Niet committen tot Wessel erom vraagt

- **Datum:** 2026-09-29
- **Beslissing:** het commitvoorstel na stap 2 (branch `feature/blocks` met een PR) is afgewezen. Er wordt niets gecommit of gepusht tot Wessel daar zelf om vraagt.
- **Gevolg:** dit vervangt het commitdeel van D-007. Stappen krijgen `Klaar` zonder commit-hash.

## D-030: WooCommerce-concept verwijderd

- **Datum:** 2026-09-29
- **Beslissing:** de conceptpagina "Terugbetaal- en retourneringsbeleid" (ID 166) is verwijderd, na een backup (`app/sql/2026-09-29-voor-verwijderen-166.sql`).

## D-031: Beschermd gedeelte via status "Privé" en een eigen rol

- **Datum:** 2026-09-29
- **Beslissing:** "Portfolio minor" en de 11 subpagina's hebben de status Privé. Alleen beheerders en de rol `portfolio_beoordelaar` (capabilities `read` en `read_private_pages`) kunnen ze lezen.
- **Reden:** er waren twee opties.
  - **A. Een wachtwoord op de hoofdpagina.** Het wachtwoord geldt niet voor subpagina's, titels lekken via REST, zoeken en sitemaps, en je kunt geen toegang intrekken.
  - **B. Login met een rol.** Bij B dwingt WordPress zelf de afscherming af, overal. Dit is een verbetering op het plan, dat eigen filters noemde.

  Gekozen is B, met de status Privé van WordPress.
- **Gevolg:** `src/inc/protected-section.php` voegt toe:
  - een redirect naar de login voor elke URL onder `/portfolio-minor/`, ook als de pagina niet bestaat
  - noindex/nofollow in de meta en in de header
  - no-cache en `DONOTCACHEPAGE`
  - geen OG- of Twitter-tags
  - een tweede uitsluiting uit sitemaps en menu's
  - titels zonder "Privé:"
  - geen wp-admin en geen adminbalk voor de beoordelaar

  Het gedeelde account is `beoordelaar` (D-003). Het wachtwoord staat niet in de repo of in `docs/`.
- **Let op:** bestanden die je op deze pagina's uploadt (pdf, afbeeldingen) blijven bereikbaar via hun directe URL in `/wp-content/uploads/`. Zet daar geen cijfers of feedback in als je dat niet openbaar wilt.

## D-032: Vertalingen laden niet meer te vroeg

- **Datum:** 2026-09-29
- **Beslissing:** twee dingen zijn verplaatst naar een hook. `register_nav_menus()` staat nu op `init`. De veldgroepen van de clones (button, footer-column, title) en de page-settings (author, popups) staan nu op `acf/init`.
- **Gevolg:** de melding `_load_textdomain_just_in_time` voor `wesselvandenijssel` is weg. De homepagina is pixel-identiek, en de clones werken.

## D-033: Menu en footer

- **Datum:** 2026-09-29
- **Beslissing:**
  - **Hoofdmenu** (locaties `primary` en `primary_mobile`): Home, Over mij, Ervaring, Projecten, Blog, Contact, plus "Portfolio (login)". Die laatste is een aangepaste link naar `/portfolio-minor/` met de class `menu-button`, en ziet eruit als de primaire knop.
  - **Footermenu** (nieuw, "Footer"): Disclaimer, Privacy statement, Sitemap en Gebruik van AI.
  - **Sitemapmenu:** gekoppeld aan de locatie `sitemap`.
- **Reden:** een aangepaste link in plaats van een paginalink. Het beveiligingsfilter verbergt paginalinks naar het portfolio voor bezoekers zonder toegang, en de knop moet voor iedereen zichtbaar zijn.
- **Gevolg:** de footer heeft vier kolommen: intro, Navigatie, Contact (e-mail + LinkedIn) en Informatie (het footermenu). De subfooter toont "© [jaar] wesselvandenijssel".
  - **Nieuwe layout:** voor de intro is de layout "Tekst" toegevoegd aan de footerkolom-clone.
  - **Social media:** in de opties staat alleen LinkedIn. De placeholders voor Facebook en Instagram uit het base-theme zijn verwijderd.
  - **Bekende bug:** `header.php` leest `header['buttons']`, maar het veld heet `buttons_group`, dus header-knoppen uit de opties verschijnen nooit. Omdat de knop nu in het menu staat, is dit niet opgelost.

## D-034: Geen uitleg-commentaar in code

- **Datum:** 2026-09-29
- **Beslissing:** Wessel haalde ook uitleg-commentaar weg uit PHP buiten `blocks/` en `components/`: de kop van `src/inc/protected-section.php` en regels in `functions.php` en `theme-support.php`. Code in dit thema krijgt daarom alleen PHPDoc boven functies en de vaste bestandskoppen. Uitleg hoort in `docs/`.
- **Gevolg:** dit breidt D-020 uit naar alle code in het thema.
