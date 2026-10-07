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

## D-035: Blogpagina via home.php, teksten vertaald

- **Datum:** 2026-09-29
- **Beslissing:**
  - **`home.php`:** nieuw. Die toont de blokken van de berichtenpagina. Nadat Blog de berichtenpagina werd, gebruikte WordPress `index.php`, en daar bleef de pagina leeg.
  - **Blog-blok:** krijgt de lege staat "Er zijn nog geen berichten.". Het filter heet nu "Alle berichten".
  - **Teksten:** vaste teksten in het thema zijn in het Nederlands en in de je-vorm gezet: de reacties, "Naar de inhoud", "Menu openen", "Pagina %s" en de pagina zonder zoekresultaten, die nu ook een link naar Home heeft in plaats van een `onclick`-knop.
  - **Menu op tabletbreedte (740–979 px):** menu-items breken niet af, de tekst is 15px en de knop is compacter. Daardoor past het menu op één regel.
- **Gevolg:** de content-audit vindt geen placeholders, geen afbeeldingen zonder alt, geen verboden woorden of u-vorm, en geen Engelse teksten op de publieke pagina's.

## D-036: Eindcontrole, laatste meldingen opgelost

- **Datum:** 2026-09-29
- **Beslissing:** tijdens de eindcontrole zijn deze fouten opgelost:
  - **Loginpagina:** stak op mobiel 62px uit, door ontbrekende `box-sizing`. Ook had hij te weinig contrast, doordat links, "Taal" en "Wijzigen" in WordPress-blauw of grijs op navy stonden. De inlogknop heeft nu de merkkleuren.
  - **`login.php`:** gebruikt `login_headertext` in plaats van de verouderde `login_headertitle`.
  - **`gravity-forms.php`:** `$reply_footer_html` werd alleen gezet als er een telefoonnummer was, wat een warning gaf bij elke bevestigingsmail. De mailtekst staat nu in de je-vorm.
- **Niet opgelost (plugins, pluginbestanden worden niet aangepast):**
  - PHP 8.5-deprecations in Yoast SEO (`null` als array-index), WP Migrate DB Pro en lh-multipart-email (`mb_convert_encoding`)
  - deprecations van de WP-CLI-tool zelf

  Die verdwijnen bij updates van de plugins, of op een server met een oudere PHP-versie.

## D-037: Scrollanimaties met motion

- **Datum:** 2026-09-29
- **Beslissing:** het thema krijgt scrollanimaties in de stijl van damsteegtwaterwerken en van-der-donk, met de library `motion` 13.1.0 (dezelfde versie als van-der-donk). Alles staat in `src/scripts/files/animations.ts` en `src/styles/components/_animations.scss`.
  - **Koppen** (`.titles .main-title`, h2/h3 in `.content-layout`): elke regel schuift uit een masker omhoog, regel na regel (damsteegtwaterwerken, `text-animate.ts`).
  - **Tekst** (subtitel, alinea's, lijsten, knoppen): schuift 24px omhoog en faadt in.
  - **Groepen** (icon-boxes, projecten, statistieken, tijdlijn, galerij, logo's, blogoverzicht, projectdetails): elk item faadt omhoog, met een kleine vertraging per item.
  - **Losse elementen:** portretfoto, afbeelding bij content-image, contactformulier, quote-slider, blogslider.
  - **CTA-banner:** de kaart opent in de breedte met een `clip-path` terwijl je scrolt (van-der-donk, `image-banner`).
  - **Hero:** het blauwe vlak achter de portretfoto beweegt tot 40px mee met het scrollen.
- **Regels:**
  - de beginstand (onzichtbaar) geldt alleen als het script de klassen heeft gezet, dus zonder JavaScript is alles zichtbaar
  - bij `prefers-reduced-motion: reduce` draait er niets
  - header, footer en popups worden overgeslagen
  - Swiper-slides animeren niet los, omdat slides buiten beeld nooit in beeld komen
- **Gevolg:** `main.js` wordt ongeveer 20 KB groter.

## D-038: HTML-validatie, kopniveaus en sizes

- **Datum:** 2026-09-29
- **Beslissing:** fouten uit de W3C-validator op Home opgelost:
  - **`sizes` zonder `srcset`:** een filter op `wp_get_attachment_image_attributes` in `post-thumbnails.php` haalt `sizes` weg als een afbeelding geen `srcset` heeft. Dat geldt voor alle afbeeldingen, niet alleen de projectkaart.
  - **Sub- en suptitel:** `BlockTitle` maakt er een `<p>` van in plaats van een `<h3>`. Het zijn geen koppen, maar een regel onder of boven de titel.
  - **Kopniveaus:**
    - de titels van de footerkolommen zijn `<h2>` met de klasse `h4`
    - de zoekresultaten zijn `<h2>` met de klasse `h3`
    - "Over de auteur" is `<h2>` met de klasse `h4`
    - de tweede h1 op de auteurspagina is nu een h2
    - de blogkaart krijgt `heading_level`, net als de projectkaart
  - `.h3` en `.h4` hebben nu zelf `line-height: 1.3`, zodat een `<h2 class="h4">` er hetzelfde uitziet als een `<h4>`.
- **Gevolg:** geen overgeslagen kopniveaus en geen `sizes` zonder `srcset` meer op de 15 geteste URL's. Het uiterlijk is gelijk gebleven (zelfde grootte, regelhoogte en marge).

## D-039: Donkerblauwe knoppen met witte tekst, en iconen

- **Datum:** 2026-10-07
- **Beslissing:** Wessel vond navy tekst op `#00a3e0` slecht leesbaar. Navy haalt op die kleur maximaal 5,38:1, en wit maar 2,87:1. Daarom is `$hue-accent-dark: #005a80` toegevoegd, en `$btn-primary` wijst daar nu naar. De keuze van Wessel was donkerblauw met wit, niet navy met wit.
  - **Witte tekst op `#005a80` (7,57:1, AAA):**
    - primaire knoppen
    - de knop "Portfolio (login)" en de verzendknop van het formulier
    - het actieve filter en het huidige paginanummer
    - de sliderpijlen, de GF-stap, de uploadknop en de telefoonknop op mobiel
  - **Hover en focus:** navy met witte tekst (15,45:1).
  - **Op navy** (de donkere CTA-kaart en de socials in de footer): wit met navy. Bij hover worden ze transparant, met een witte rand. Anders verdween de knop bij hover tegen de navy achtergrond.
  - **Iconen:** primaire en secundaire knoppen en de verzendknop krijgen een pijl naar rechts op `::after`. Die schuift 4px op bij hover, behalve bij `prefers-reduced-motion`. Kiest de redacteur zelf een icoon (`<i>` in de knop), dan valt de pijl weg. "Portfolio (login)" krijgt het icoon `user`.
  - `#00a3e0` blijft voor vlakken, decoratie en de notificatiebalk.
- **Gevolg:** de kleurregels en contrasttabellen in `CLAUDE.md` zijn bijgewerkt. Het menu past met het extra icoon nog op één regel, ook op 740px.

## D-040: Submenu's in het hoofdmenu

- **Datum:** 2026-10-07
- **Beslissing:** Wessel koos voor twee submenu's:
  - Over mij ▸ Ervaring, Gebruik van AI
  - Projecten ▸ Websites, Webshops: eigen links naar `/projecten/?categorie=website` en `?categorie=webshop`, die het projectfilter direct op de juiste categorie zetten

  Bovenin blijven Home, Over mij, Projecten, Blog, Contact en de knop "Portfolio (login)" staan. Ervaring hoort nu onder Over mij en staat niet meer los.
- **Techniek:**
  - **Desktop en tablet (vanaf 740px):** het menu opent bij hover en bij `:focus-within`. Met de Tab-toets kom je zo bij alle subitems. Een onzichtbare strook tussen link en dropdown voorkomt dat het menu dichtklapt als je de muis beweegt. Het pijltje draait als het menu open is.
  - **Base-theme:** daar opende een submenu alleen bij een klik op een `<span>`. De ouderitems zijn hier links, dus dat werkte niet.
  - **Mobiel:** de toggle in `walker-menu.php` is een `<button>` met `aria-expanded` en het label "Submenu openen". Dat was een `<div>` die je niet met het toetsenbord kon bereiken. `menu-toggle.ts` houdt `aria-expanded` bij.
  - Het ouderitem is onderstreept als je op een subpagina bent (`current-menu-parent`).
- **Backup:** `wp db export` gaf eerst een leeg bestand, omdat mysqldump de socket van Local niet vond. De menuwijziging was toen al gedaan. Daarna is de backup gemaakt met `--socket`: `app/sql/2026-10-07-na-submenu.sql`. Gebruik die optie voortaan.

## D-041: Eigen foto's op de site

- **Datum:** 2026-10-07
- **Beslissing:** uit de map Portfolio van Wessel zijn 15 foto's gekozen en geplaatst (media 353–367):
  - **Home:**
    - de hero heeft een nieuwe portretfoto, die vervangt de oude van 400 × 400 px
    - de CTA-kaart heeft een kantoorfoto
  - **Over mij:**
    - de hero heeft een buitenfoto
    - "Mijn passie" en "Mijn persoonlijke kant" zijn nu content-image-blokken met een foto. De tekst is ongewijzigd.
    - het nieuwe galerijblok "Buiten het werk" heeft 9 foto's: karting, Formule 1, noorderlicht, bergen, bos en kust
  - **Ervaring:** het introblok is een content-image-blok met een kantoorfoto
  - **Uitgelichte afbeelding:** Home, Over mij en Ervaring hebben er een, voor Open Graph via Yoast
- **Privacy:**
  - **Metadata:** alle foto's zijn opnieuw opgeslagen zonder EXIF. Daarmee zijn ook de GPS-locaties van de vakantiefoto's weg.
  - **Formaat:** de foto's zijn verkleind tot maximaal 2400px.
  - **Bestandsnamen:** beschrijvend. De oude namen bevatten de naam van het stagebedrijf.
  - **Niet gebruikt:** foto's waarop het kenteken van de auto leesbaar is, foto's met het gezicht van iemand anders, en publieksfoto's met herkenbare gezichten.
  - **Alt-teksten:** in het Nederlands, en ze beschrijven alleen wat te zien is. Bij de kart en de sneeuwscooter staat niet dat Wessel de bestuurder is, want dat is op de foto niet te zien.
- **Video's:** ook de losse Live Photo-video's staan nu in `Portfolio/Videos`: `portret/` (4) en `vakanties/` (1). Het hero-blok met variant "Achtergrond" en type "Video" neemt een embedcode letterlijk over, dus een Wistia-embed past er direct in.
- **CTA-animatie:** de clip-path van D-037 sneed de titel af. De inset is nu begrensd op de padding van de kaart min 8px.

## D-042: Uitgesneden portret in de hero, hobbytekst uit Polarsteps

- **Datum:** 2026-10-07
- **Beslissing:**
  - **Hero:** het hero-blok heeft de nieuwe optie "Uitgesneden foto" (`cutout`), voor de variant "Portret naast tekst". Als die aan staat:
    - wordt de foto op ware grootte getoond (`full`) en niet bijgesneden tot 4:5
    - is er geen afgeronde kader
    - staat het blauwe vlak alleen achter het onderste deel, zodat het hoofd erboven uitsteekt. Het vlak beweegt niet mee met de parallax, anders zweeft de rechte onderrand van de foto in het blauw.
    - is de foto op desktop maximaal 400px breed
  - **Home:** gebruikt de uitgesneden foto (media 372, webp met transparantie, 204 KB). De uitgelichte afbeelding voor Open Graph blijft de gewone portretfoto (353), want een transparante foto werkt niet als deelafbeelding.
- **Uitsnijden:** gedaan met Apple Vision (de functie "onderwerp optillen" van macOS). Een stoelleuning werd als onderdeel van Wessel gezien. Die is met de hand weggehaald. Ook is de foto vlak onder de armen afgesneden.
- **Hobbytekst bij "Mijn persoonlijke kant":** op basis van de Polarsteps-export. Daarin zitten vier reizen. Alleen de Dolomieten en Hongarije GP zijn van het account van Wessel. Tenerife staat op het account van Isabel en Tromsø op dat van Wesley. Daarom staan in de tekst alleen dingen die Wessel zelf deed, en geen namen van reisgenoten:
  - waar hij in de reisverslagen bij naam genoemd wordt: aan het stuur op Tenerife, de drone in de Dolomieten, de drie dagen op het circuit in Hongarije
  - waar zijn eigen foto's het laten zien: het noorderlicht en de sneeuwscooter in Tromsø
- **Alt-teksten:** de kart (359) en de sneeuwscooter (361) noemen nu Wessel, na bevestiging van Wessel.

## D-043: Uitgesneden foto in de CTA op Home

- **Datum:** 2026-10-07
- **Beslissing:** het CTA-blok is gemaakt voor een uitgesneden persoon die op de onderrand van de kaart staat (`align-self: flex-end`, maximaal 235px hoog). De rechthoekige kantoorfoto (357) zweefde daardoor in het midden.
  - **Nieuwe foto:** op verzoek van Wessel een foto uit de kantoorserie van maart, waarop hij in de camera kijkt (379, webp, 87 KB).
  - **Uitsnijden:** de maskers voor het onderwerp en voor alleen de persoon zijn gecombineerd. Zo vallen bureau, laptop en monitor weg.
  - **Afsnijden:** de foto is op borsthoogte afgesneden, boven de handen. Een deel van de onderarm zat namelijk achter de laptop.
- **Eerdere probeersels, afgewezen door Wessel:** de foto met de duim omhoog (375) en de witte hoodie (377).
- **CSS:** de afbeelding in de CTA heeft vanaf 980px 24px ruimte erboven, zodat het haar niet tegen de bovenrand van de kaart komt.
- **Niet meer gebruikt:** media 357, 375 en 377 staan nog in de mediabibliotheek. Ze zijn niet verwijderd.

## D-044: Achtergrondblok voor ritme op de pagina's

- **Datum:** 2026-10-07
- **Beslissing:** het blok "Achtergrond" (`acf/background`) wordt vaker gebruikt, zodat de lichtgrijze pagina's afwisseling krijgen. Lichtblauw is voor secties met witte kaarten. Per pagina staat er hoogstens één navy sectie, als blikvanger.
  - **Home:** "Uitgelichte projecten" op lichtblauw
  - **Over mij:** "Waarom ik goed ben als online marketing consultant" op navy, de galerij "Buiten het werk" op lichtblauw
  - **Ervaring:** "Opleiding" op lichtblauw, "Tools" op navy
  - **Projecten:** het projectoverzicht op lichtblauw
- **CSS:** bij `has-navy-background-color` zijn tekst, links en de focusrand automatisch wit, en wordt de primaire knop wit met navy. Zo hoeft de redacteur geen tekstkleur te kiezen. Gewone links (`#0077a8`) zouden op navy maar 3,09:1 halen.
- **Gevolg:** de CTA-kaarten, de footer en de hero blijven zoals ze waren. Op Contact en Blog staat geen achtergrondblok: Contact heeft één blok, en Blog heeft nog geen berichten.

## D-045: Project Schoolmaaltijden, eerste blogbericht, media opgeruimd

- **Datum:** 2026-10-07
- **Project Schoolmaaltijden (387):**
  - Wessel werkte eraan bij de andere vestiging van Social Brothers.
  - **Ingevuld uit openbare bronnen:**
    - opdrachtgever: het Nederlandse Rode Kruis en het Jeugdeducatiefonds, in opdracht van OCW
    - de opdracht
    - tools: WordPress en WPML, te zien in de broncode van de site
    - de talen van de site: Nederlands, Engels, Arabisch en Turks
  - **Resultaat, met bron:**
    - Hart van Nederland meldde op 29 maart 2023 dat scholen zich via schoolmaaltijden.nl konden aanmelden
    - Omroep Brabant meldde op 26 mei 2023 dat er 1.302 scholen meededen
  - **Nog `[INVULLEN]`:** periode, rol en aanpak. Die staan nergens openbaar.
  - **Afbeelding:** een screenshot van de homepage (385), op 1600 × 1000 px zoals bij de andere projecten.
- **Blogbericht "SEO verbeteren begint in de code" (388):**
  - De voorbeelden komen uit de changelog van het standaardthema die Wessel meestuurde. De bureaunaam staat er niet in. De tekst spreekt van "het bureau waar ik werk".
  - Over de minor staat er alleen in wat vaststaat: de start in september 2026 en de interesse in SEO.
  - Nieuwe categorie: SEO. Uitgelichte afbeelding: de kantoorfoto 357, die dus niet is verwijderd.
  - Yoast-velden zijn ingevuld.
- **Single-template:**
  - **CSS:** gewone WordPress-koppen, alinea's en lijsten in `.single__content` krijgen marges en de pijl-bullets van `content-layout`. Zo kan Wessel berichten schrijven met gewone blokken.
  - **Auteursvak:**
    - de bio "Korte bio" en "Dit is de biografie" is vervangen door de intro uit de footer
    - de `#`-links naar Facebook en Instagram zijn leeggemaakt
    - de verwijzing naar het verwijderde logo (58) is weg
    - LinkedIn staat er nu als gewone user meta. De ACF-verwijzing wees naar een link-veld uit de thema-opties, dat een array verwacht.
- **Contact:** de reactietermijn is "binnen twee werkdagen". Op de Blog-pagina is de `[INVULLEN]` voor het eerste bericht weggehaald.
- **Media verwijderd:**
  - 208: het oude portret van 400 × 400 px
  - 375: de foto met de duim omhoog
  - 377: de hoodie
  - Vooraf is gecontroleerd dat ze nergens gebruikt werden: niet in content, metadata, opties, termmeta of usermeta.
- **Hobbytekst:** bevestigd door Wessel.

## D-046: Body-class "blog" verwijderd

- **Datum:** 2026-10-07
- **Probleem:** op `/blog/` kon je niet scrollen. WordPress geeft `<body>` op de berichtenpagina de class `blog`. Het blog-blok gebruikt dezelfde naam als BEM-blok (`.blog { overflow: hidden; }`), dus de hele pagina kreeg `overflow: hidden`. Ook de andere `.blog`-regels raakten de hele pagina. Daardoor stonden bijvoorbeeld de titels in de footer gecentreerd.
- **Oplossing:** een filter op `body_class` in `src/functions/cleanup.php` haalt de class `blog` weg. Geen enkele stylesheet of script gebruikt die body-class.
- **Gevolg:** `/blog/` scrollt weer op desktop en mobiel, en de footertitels staan weer links.

## D-047: LinkedIn-export en Voice Card verwerkt

- **Datum:** 2026-10-07
- **Bronnen:** de LinkedIn-export van Wessel (Profile.csv, Profile.pdf) en de Voice Card van 19 juli 2026. De geboortedatum, de postcode en de profielstatistieken zijn niet gebruikt.
- **Openbaar (LinkedIn):**
  - **Ervaring, Werk:**
    - MB effect staat nu vanaf juni 2023
    - nieuw: Social Brothers (stage, augustus 2022 – april 2023, met een link naar Schoolmaaltijden), race marshal bij The Official F1 Racing Centre (juni 2022 – heden), Het BUREAU (junior back-end developer, 2021–2022) en Fiverr (grafisch ontwerper, 2020–2022)
    - weggelaten: de archiefbijbanen uit 2019–2021, en "Manager sociale media, Instagram", omdat onduidelijk is voor welk account
  - **Ervaring, Opleiding:**
    - HBO-ICT van september 2023 tot augustus 2027 (verwacht)
    - de omschrijving van de minor komt uit de LinkedIn-samenvatting (tracking, GA4, GTM, conversie-optimalisatie)
    - nieuw: Grafisch Lyceum Utrecht (Webdeveloper, 2020–2023) en vmbo-tl bij O.R.S. Lek en Linge (2016–2020)
  - **Ervaring, nieuw blok "Meer certificaten en talen":** twee Google-certificaten en vier talen.
  - **Over mij:**
    - een concepttekst voor het merk IK op basis van de LinkedIn-samenvatting
    - wat Wessel in de minor leert
    - in de hobbytekst: race marshal sinds 2022
  - **Schoolmaaltijden:** periode 2022–2023. De rol is: tijdens de stage bij Social Brothers.
- **Beschermd (Voice Card):**
  - **Voice Card en reflectie (323):** uitleg, samenvatting, sterke punten, valkuilen, in balans en onder druk, leerstijl, ontwikkelpunten, een samenvatting van de competentiematrix (29 competenties) en de drie tips.
  - **De pdf staat niet in de mediabibliotheek.** Bestanden in `uploads/` zijn openbaar via hun URL, ook als de pagina beschermd is.
  - **Motivatie (324):** de opleiding en de koppeling met het werk, uit LinkedIn.
  - **Aanvullende kennis (330):** de certificaten.
  - Niets uit de Voice Card staat op openbare pagina's.
- **Open punten:**
  - **Tegenstrijdigheid:** LinkedIn zegt "MB effect sinds juni 2023" en noemt geen aparte stage. De site heeft ook "Stage webdevelopment MB effect, september 2023 – mei 2024". Die regel is blijven staan.
  - **Blijft `[INVULLEN]`:** de reflectie, de dialogen, waarom Wessel de Voice Card maakte, en de einddatum en onderwijsinstelling van de minor.
- **Fout gevonden en opgelost:** het nieuwe blok was een kopie van "Mijn cv", inclusief het ACF-blok-ID. ACF laadt velden per blok-ID, dus beide blokken toonden dezelfde inhoud. Het blok heeft nu een eigen ID. Een scan van alle pagina's vond geen andere dubbele blok-ID's.

## D-048: Yoast-teksten in het Nederlands

- **Datum:** 2026-10-07
- **Beslissing:** de Engelse standaardteksten in `wpseo_titles` zijn vertaald:
  - **Kruimelpad:**
    - "Archives for" is "Archief van"
    - "You searched for" is "Je zocht naar"
    - "Error 404: Page not found" is "Pagina niet gevonden"
  - **Paginatitels:**
    - auteur: "Berichten van …"
    - zoeken: "Je zocht naar …"
    - 404: "Pagina niet gevonden"
    - categorie: "Berichten over …"
    - tags en andere archieven: "Archief: …"
  - De socialtitels van de archieven zijn ook vertaald.
- **Aanleiding:** Wessel zag "Archives for" in het kruimelpad van de auteurspagina.

## D-049: Correcties van Wessel: geen stage bij MB effect, Flexercise, minor, Schoolmaaltijden

- **Datum:** 2026-10-07
- **Correctie:** Wessel liep geen stage bij MB effect. Verwijderd of herschreven:
  - **Ervaring:** de regel "Stage webdevelopment MB effect, september 2023 – mei 2024" is weg
  - **SCX Solar:** de rol, de samenvatting en de Yoast-beschrijving noemen geen stage meer. De rol is nu "Als front-end developer bij MB effect…".
  - **Rentwereld:** "sinds mijn stage in 2023" is nu "sinds 2023", en "Tijdens mijn stage een hero-blok…" is nu "Een hero-blok…"
  - Een zoekactie over alle content vond daarna alleen nog de stage bij Social Brothers. Die klopt.
- **Nieuw op Ervaring, Werk:**
  - Flexercise Treatments, bijbaan: beheer van de sociale content en grafische taken
  - De periode (oktober 2023 – augustus 2026) komt van de LinkedIn-regel "Manager sociale media". Die is dus aan Flexercise gekoppeld.
- **Minor E-marketing:** Hogeschool Utrecht, september 2026 – januari 2027.
- **Schoolmaaltijden:**
  - rol: front-end developer tijdens de stage bij Social Brothers
  - aanpak: het project vanaf scratch opgezet, en het ontwerp uit Figma nagebouwd
  - tools: aangevuld met Figma
- **Beschermd:**
  - **Voice Card (323):** waarom Wessel de Voice Card aanschafte. Bij de start van de minor stelde hij er zijn groepje mee samen, op basis van de leeruitkomsten, zodat er voor elk sterk punt iemand in het team zit.
  - **Bijdrage aan het team (328):** dezelfde informatie als inleiding. Wessels rol in het team blijft `[INVULLEN]`.
  - **Motivatie (324):** de kop "Relatie met mijn stage en werk" is nu "Relatie met mijn werk".
