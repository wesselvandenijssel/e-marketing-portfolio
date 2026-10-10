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
    - het bureau staat nu vanaf juni 2023
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
  - **Tegenstrijdigheid:** LinkedIn zegt "bij het bureau sinds juni 2023" en noemt geen aparte stage. De site heeft ook "Stage webdevelopment" bij het bureau (september 2023 – mei 2024). Die regel is blijven staan.
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

## D-049: Correcties van Wessel: geen stage bij het bureau, Flexercise, minor, Schoolmaaltijden

- **Datum:** 2026-10-07
- **Correctie:** Wessel liep geen stage bij het bureau. Verwijderd of herschreven:
  - **Ervaring:** de regel "Stage webdevelopment" bij het bureau (september 2023 – mei 2024) is weg
  - **SCX Solar:** de rol, de samenvatting en de Yoast-beschrijving noemen geen stage meer. De rol is nu "Als front-end developer bij [het bureau]…".
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

## D-050: Eigen projecten, Flexercise-testsite, logboek en oude cv's

- **Datum:** 2026-10-07
- **Bronnen:** het logboek (logboek.wesselvandenijssel.nl), SalaryPerSecond, RideLoop, de Flexercise-testsite en drie oude cv's van Wessel.
- **Nieuwe projecten:**
  - **SalaryPerSecond (409)** en **RideLoop (410):** nieuwe projectcategorie "Eigen project". De inhoud komt van de sites zelf:
    - SalaryPerSecond: Tailwind CSS, versie 2.0 sinds augustus 2025
    - RideLoop: een eigen WordPress-thema, Google Maps, Google Places en OpenStreetMap
  - **Flexercise Treatments (411):** een testversie van de nieuwe site, met een eigen WordPress-thema. Valt onder de categorie "Website".
  - **Sortering:** de nieuwe projecten hebben een datum net vóór de klantcases, zodat die bovenaan blijven. Home toont vaste projecten en verandert dus niet.
- **Ervaring:**
  - **Omschrijvingen:**
    - Social Brothers: HTML, SCSS, JS/TS, Twig, Svelte. Wessel was front-end developer van Schoolmaaltijden.
    - Het BUREAU: PHP en Laravel, voor echte externe klanten
    - Fiverr: freelance ontwerpwerk
    - het bureau: ook Shopify-webshops, volgens het logboek
    - Flexercise: de testsite, met een link naar het project
  - **HBO-ICT:** een link naar het logboek.
  - **Skills:** aangevuld met Laravel, Twig en Svelte.
  - **Tools:** aangevuld met Figma en Adobe Creative Cloud.
- **Beschermd, Aanvullende kennis (330):** het logboek en de eigen projecten als manieren van leren.
- **Oude cv's niet gebruikt als download:** ze bevatten een huisadres en een telefoonnummer, en ze zijn verouderd.
  - De profieltekst noemt een eigen F1-simulator. Die staat nog niet op de site, omdat niet duidelijk is of dat nog klopt.
  - RideLoop en de videomap "motorrijden" wijzen op motorrijden als hobby, maar dat is niet bevestigd.

## D-051: Antwoorden van Wessel verwerkt

- **Datum:** 2026-10-07
- **Bevestigd door Wessel:**
  - Hij heeft een eigen F1-simulator en rijdt motor. Beide staan nu in de hobbytekst op Over mij, met een link naar RideLoop.
  - De LinkedIn-regel "Manager sociale media, Instagram" gaat over zijn baan bij Flexercise Treatments. De periode uit D-049 klopt dus.
- **RideLoop:** periode mei – juni 2026.
- **Flexercise:** het werk bestond vooral uit social media-content voor Instagram, LinkedIn, TikTok en Facebook. Dat staat nu op Ervaring en bij het project.

## D-052: Stagedossier Social Brothers verwerkt

- **Datum:** 2026-10-07
- **Bron:** het stagedossier van Wessel (mbo Webdeveloper, Grafisch Lyceum Utrecht): stageverslag 1 en 2 en het eindverslag. De beoordelingen, de urenverantwoording en de feedbackformulieren zijn niet gebruikt. Namen van collega's en begeleiders staan niet op de site. De tijdelijke uitgepakte kopie is verwijderd.
- **Ervaring:** de Social Brothers-regel heet nu "Stage junior WordPress-developer". De omschrijving noemt:
  - **werk:** Gutenberg-blokken met ACF, WooCommerce, WPML, Gravity Forms en Yoast
  - **livegangen:** Schoolmaaltijden (als front-end developer) en onder meer Aafje, Mezaldi en SNB
  - **eindopdracht:** een WordPress-handboek van 42 pagina's voor klanten, dat daarna standaard bij de oplevering van een website ging
  - **presentatie:** de HoloLens 2-presentatie op de Tech Doe dag
- **Schoolmaaltijden:** de rol noemt dezelfde functietitel.
- **Geen projectpagina's voor het handboek en Mezaldi.** handboek.wesselvandenijssel.nl is offline, en mezaldi.com stuurt door naar een ander domein. De huidige inhoud is dus niet te controleren.

## D-053: Nieuw cv als pdf, met downloadknop

- **Datum:** 2026-10-07
- **Beslissing:** een nieuw cv van één A4, op basis van de inhoud van de site. Het volgt de huisstijl: Public Sans, navy en blauw.
  - **Op verzoek van Wessel:** met telefoonnummer en foto. De foto is een vierkante uitsnede van het nieuwe portret.
  - **Contact:** alleen woonplaats Utrecht, zonder adres en zonder geboortedatum.
  - **Pdf met echte tekst,** gemaakt in Chromium (Playwright), zodat recruitersystemen hem kunnen lezen.
- **Op de site:** media 417, `/wp-content/uploads/2026/10/cv-wessel-van-den-ijssel.pdf`. Ervaring heeft bij "Mijn cv" een korte tekst en de primaire knop "Download mijn cv", die in een nieuw tabblad opent.
- **Bron om later bij te werken:** `~/Desktop/Portfolio/CV/` met `cv.html`, `foto.jpg` en de pdf. De bron staat bewust niet in het thema of de repo, omdat het telefoonnummer erin staat.
- **Mezaldi:** in de tekst over Social Brothers staat nu "Mezaldi (nu Mezaldy)". Wessel bevestigde de nieuwe naam.

## D-054: Cv bijgewerkt: simracen, geen Portugees

- **Datum:** 2026-10-07
- **Beslissing:**
  - **Hobby:** in het cv staat nu "Formule 1, simracen in mijn eigen simulator en karting". Dat koos Wessel.
  - **Talen:** Portugees is weg uit het cv en uit de talenlijst op Ervaring. Wessel spreekt geen Portugees; de taal kwam uit zijn LinkedIn-export.
- **Opmaak:** de hobbyregel loopt nu over twee regels. Zodat het cv op één pagina past, is de ruimte in de zijbalk iets kleiner (3,4 mm) en de foto iets kleiner (32 mm).
- **Bestand:** de pdf op de site (media 417) is vervangen. De URL blijft hetzelfde.

## D-055: Certificaten met controlelinks

- **Datum:** 2026-10-07
- **Bron:** het certificatenoverzicht op LinkedIn dat Wessel plakte. Dat overzicht was afgekapt na "Cursus online marketing".
- **Ervaring, "Meer certificaten en talen":** elke naam linkt nu naar de controlepagina, en opent in een nieuw tabblad:
  - Google Ads Measurement en Google Ads Search (Skillshop, 2026)
  - Claude Code in Action (Anthropic, 2026)
  - vier Soofos-cursussen (2025)
  - "Basisprincipes van online marketing (Google)" heeft nog geen link
- **Gecontroleerd:**
  - Skillshop en Skilljar geven 200
  - Soofos geeft een Cloudflare-controle aan scripts (403). Een gewone browser komt daar wel langs.
- **Beschermd, Aanvullende kennis (330):** aangevuld met Google Ads Search en Claude Code in Action.
- **Cv:**
  - Google Ads Search en Claude Code in Action staan erbij, met klikbare links
  - de hobby's staan nu onderaan de rechterkolom, zodat de zijbalk op één pagina past
  - de pdf op de site is vervangen, de URL blijft hetzelfde

## D-056: Rustigere en speelsere footer

- **Datum:** 2026-10-07
- **Aanleiding:** Wessel vond de footer te vol. Hij mocht ook speelser.
- **Rustiger:**
  - Footermenu's tonen alleen hoofditems (`depth => 1` in `footer-column.php`). Navigatie heeft nu 5 links in plaats van 10.
  - Kolomtitels zijn kleine, blauwe labels in hoofdletters (`#00a3e0` op navy, 5,38:1). De introkolom houdt een grote naam.
  - Op mobiel staan Navigatie en Informatie naast elkaar, met Contact eronder.
  - De copyright staat nu in het navy vlak, met een dunne scheidingslijn erboven.
- **Speelser:**
  - een lichtblauwe cirkel met een ring, rechtsboven, die langzaam zweeft
  - "wesselvandenijssel" als groot outline-woordmerk onderaan, half afgesneden
  - een ronde knop "Terug naar boven" (`#page`), die bij hover omhoog schuift
  - menulinks krijgen bij hover een pijltje, en het e-mailadres een blauwe onderstreping die beweegt
  - Bij `prefers-reduced-motion` staan de zweefanimatie en de bewegingen uit.
  - De cirkel en het woordmerk zijn `aria-hidden`.
- **Fout voorkomen:** het bestaande anker-script (`randomness.ts`) doet `querySelector(href)`. Daarom wijst de knop naar `#page` en niet naar `#`; dat gaf een JS-fout.
- **Hoofdmenu:** het item "Home" staat er niet meer in. Dat was niet door deze wijziging; het item zelf ontbreekt in menu 3. De footer volgt het menu.

## D-057: Mobiele check en verbeteringen

- **Datum:** 2026-10-07
- **Check:** 30 openbare URL's op 320, 375 en 414 px, als mobiel apparaat met touch. Gecontroleerd op:
  - overloop en elementen buiten beeld
  - tekst kleiner dan 12px en invoervelden kleiner dan 16px
  - tikdoelen kleiner dan 24px
  - kapotte afbeeldingen, JS-fouten en het aantal h1's
  - Het mobiele menu is getest: openen, submenu, een link volgen en sluiten.
- **Opgelost:**
  - **SalaryPerSecond op 320px:** het feitenblok liep 3px over. Het grid is nu `minmax(0, 1fr)` en lange links breken af.
  - **"Menu"-label onder de hamburger:** van 11 naar 12px, in navy.
  - **`btn--read-more`** ("Terug naar projecten", "Lees verder"): 4px padding boven en onder, zodat het tikdoel minstens 24px hoog is.
  - **Sociale iconen** op de auteurspagina en in het auteursvak: minimaal 32 × 32px.
  - **Toestemmingsvinkje** in het formulier: 20 × 20px, met een navy accentkleur.
- **Op verzoek van Wessel:**
  - **Hero:** de portretfoto is op mobiel 170px breed (was 260) en op tablet 220px, met minder ruimte tussen foto en tekst. De Home-hero is op 390px nu 672px hoog (was ongeveer 830).
  - **Contactformulier:** de kaart is lichtblauw (`$hue-accent-light`) in plaats van wit. De velden blijven wit.
  - **Auteursfoto** in het auteursvak:
    - hij werd naast de bio samengedrukt tot ongeveer 16px. Nu `flex-shrink: 0` en 80px.
    - het formaat is "Avatar" (128px) in plaats van "Author thumb", zodat hij scherp is op retina
- **Niet aangepast (uitzondering in WCAG 2.5.8):** links in lopende tekst, en footer- en menulinks met genoeg ruimte ertussen.

## D-058: Homepage gericht op wie Wessel wil leren kennen

- **Datum:** 2026-10-07
- **Aanleiding:** de homepage praatte vooral vanuit Wessel. Hij wil dat bezoekers zich aangesproken voelen, vooral bedrijven die via LinkedIn op de site komen.
  - Bijsturing 1: Wessel bouwt meestal geen websites voor bezoekers van zijn site.
  - Bijsturing 2: hij werkt met plezier bij het bureau en is niet op zoek naar een andere baan.
  - De toon is daarom neutraal: laten zien wat hij kan, en uitnodigen om kennis te maken of te sparren. Geen verkooppraat en geen sollicitatie.
- **Opbouw van Home:**
  - **Hero:** de ondertitel is "Front-end developer voor WordPress en Shopify". De tekst zegt wat hij bouwt en eindigt met "Op deze site zie je wat ik bouw, hoe ik werk en wat ik leer." De knoppen zijn "Bekijk mijn projecten" en "Download mijn cv".
  - **"Wat ik meebreng":** WordPress en Shopify, snelheid en SEO, tracking en marketing, en werken in een team (Git, pull requests, code reviews, CI/CD).
  - **"Resultaten bij Rentwereld":** een nieuw statistiekenblok op navy: 22% lagere kosten per lead, 4,4% conversie, en binnen 1 jaar alle belangrijke zoektermen op pagina 1. Bron: de case van het bureau.
  - **Uitgelichte projecten:** Rentwereld, Schoolmaaltijden en Van Aalsburg. Précon is vervangen door Schoolmaaltijden.
  - **"Ervaring in het kort":** het bureau, Social Brothers, HBO-ICT met de minor, en certificaten. Met de knop "Bekijk mijn ervaring".
  - **CTA:** "Benieuwd naar mijn werk of wil je sparren? Stuur me een bericht.", met "Neem contact op" en "Download mijn cv".
  - **Yoast:** een nieuwe titel en beschrijving.
- **Andere pagina's in dezelfde toon:**
  - Over mij (CTA): "Wil je kennismaken of sparren over front-end en marketing?"
  - Projecten (CTA): "Vragen over een project? Stuur me een bericht."
  - Contact (intro): "een project" is weggehaald
  - Blogbericht (slotzin): "Wil je sparren over SEO en techniek?"

## D-059: Case "Deze portfolio-website" (GitHub-repository)

- **Datum:** 2026-10-07
- **Beslissing:** project 425 beschrijft deze site zelf, met een link naar de openbare repository `wesselvandenijssel/e-marketing-portfolio`. De categorie is Eigen project, de periode september – oktober 2026.
  - **Inhoud:**
    - het thema, de huisstijl volgens WCAG
    - het beschermde deel met een eigen rol, en zonder lekken
    - de Motion-animaties, de deploy met GitHub Actions en de tests met Playwright
  - **AI-gebruik:** de rol vermeldt Claude Code als AI-assistent, met een link naar Gebruik van AI.
  - **Afbeelding:** een screenshot van de nieuwe homepage.
  - De site staat nog niet live. Daarom linkt het websiteveld naar GitHub.

## D-060: Blok "GitHub-activiteit"

- **Datum:** 2026-10-07
- **Beslissing:** een nieuw ACF-blok `github-activity` met een titel en een GitHub-gebruikersnaam.
  - **Data:** `src/functions/github.php` haalt de openbare kalender op (`github.com/users/<naam>/contributions`, zonder token). Per dag worden datum, niveau en aantal uitgelezen.
  - **Cache:** 12 uur in een transient. Als het ophalen mislukt, 1 uur. Lukt het ophalen niet, dan verbergt het blok zich.
  - **Weergave:**
    - het totaal van het afgelopen jaar, met de kalender als heatmap in de merkkleuren
    - een legenda en de knop "Bekijk mijn GitHub"
    - tooltips in het Nederlands, zoals "32 bijdragen op 7 oktober 2026"
  - **Toegankelijk:** de kalender is `role="img"` met een aria-label met het totaal.
  - **Formaat:** de vakjes zijn 11, 13 of 18px, afhankelijk van de breedte, en passen vanaf 980px zonder scrollen. Op mobiel scrolt de kalender horizontaal, en `github-activity.ts` scrolt naar de nieuwste week.
- **Plaats:** op Ervaring, na Tools. Op 7 oktober 2026 waren het 4.560 bijdragen in het afgelopen jaar.

## D-061: HTML-validatie: achtergrondblok en list-rollen

- **Datum:** 2026-10-07
- **Meldingen van de W3C-validator:**
  - **"Section lacks heading":** het achtergrondblok wikkelde zijn inhoud in een eigen `<section>` zonder kop. Het is een wrapper, dus nu een `<div>`. De blokken erin zijn zelf nog wel een `<section>` met een kop. Geen enkele stylesheet of script gebruikt `section.background`.
  - **"The list role is unnecessary":** `role="list"` stond op `<ul>` en `<ol>` die al een native lijst zijn. Weggehaald bij statistics, timeline, gallery en project-details (tools en afbeeldingen).
- **Gecontroleerd:**
  - op Home, Over mij, Ervaring, Projecten en Blog staat geen `<section>` meer zonder kop, en geen `role="list"`
  - de achtergrondkleuren blijven werken

## D-062: JSON-LD opgeschoond en aangevuld

- **Datum:** 2026-10-08
- **Probleem:** `header.php` laadde `json-ld.php` van het base-theme en zette daarna de payload nog een keer neer. Elke pagina had zo twee identieke Organization-blokken, naast de graph van Yoast. Die blokken bevatten:
  - 61 Google-reviews (5 sterren) van het bureau, uit `uploads/review_data.xml`
  - een contactpunt "customer service" met een leeg telefoonnummer
- **Beslissing:**
  - **Oude output weg:** `json-ld.php` is verwijderd, en de include en de extra script-tag in `header.php` ook. Yoast is nu de enige bron, met één graph per pagina.
  - **`src/functions/schema.php`:** een filter op `wpseo_schema_person` voegt de waarden uit de optie `wesselvandenijssel_person_schema` toe aan de Person-node. Die optie staat in de database, zodat de naam van de werkgever niet in de themacode staat. Daarin:
    - functietitel, e-mail, woonplaats (Utrecht) en werkgever
    - opleiding: affiliatie Hogeschool Utrecht, alumnus van het Grafisch Lyceum Utrecht
    - 17 onderwerpen (`knowsAbout`) en de talen nl, en en de
    - 8 certificaten met hun controlelinks (`hasCredential`)
    - LinkedIn en GitHub in `sameAs`
  - **Yoast:** de persoonsafbeelding is het portret (353) in plaats van de lege Gravatar.
  - **Paginatypes:** Over mij is een AboutPage en Contact een ContactPage.
- **Reviews uitgezet:**
  - `review_settings` → `enabled` = false
  - de cronjob `fetch_google_reviews_event` is weggehaald. Die haalde elke dag de reviews van het bureau op.
  - **Op 2026-10-08 verwijderd, met akkoord van Wessel:** alle velden van `review_settings` zijn leeggemaakt (client ID, client secret, refresh token, API-URL, account- en locatie-ID, reviewlink), en `uploads/review_data.xml` is gewist. De databasebackups van vóór die datum in `app/sql/` bevatten de gegevens nog wel. Die staan niet in git (`/app/*` staat in `.gitignore`), maar deel ze niet.
- **Gecontroleerd:** Home, Over mij, een project, het blogbericht, de auteurspagina en Contact hebben één geldige graph. Het blogbericht is een Article, de auteurspagina een ProfilePage. Het beschermde deel geeft geen schema uit, want het stuurt door naar de login.

## D-063: Reviews en ongebruikte bedrijfsvelden verwijderd

- **Datum:** 2026-10-08
- **Beslissing (op verzoek van Wessel):** de hele reviewfunctie van het base-theme is weg:
  - `src/functions/reviews/` (Google-koppeling, cronjob, XML-opslag)
  - `get_review_stars()` en `_review-stars.scss`
  - de optiepagina Reviews met de veldgroep `review_settings`
  - de 20 lege optierijen `options_review_settings*` in de database (backup vooraf in `app/sql/`)
- **Ook weg:** de velden Awards, Oprichter en Oprichtingsjaar in Basisgegevens. Alleen het verwijderde `json-ld.php` gebruikte ze, en ze waren nooit ingevuld.

## D-064: Reply-mail, snelheid en SEO-aanvullingen

- **Datum:** 2026-10-08
- **Reply-mail:** `{form_fields}`, `{reply_heading}` en `{reply_footer}` in `src/functions/gravity-forms.php` geven nu een mail in de huisstijl: navy kop met naam en functie, antwoorden in een lichtblauw blok, handtekening met e-mail, LinkedIn en de site. Het consent-veld toont "Akkoord" in plaats van de ruwe deelvelden. Het SVG-logo is eruit, omdat Gmail en Outlook geen SVG tonen. De tekst van de melding staat in alinea's en noemt de reactietermijn van 2 werkdagen.
- **Fancybox:** laadt niet meer op elke pagina. Galerij, content-image (met video) en project-details zetten het script zelf in de wachtrij als ze een lightbox renderen.
- **Logo:** `get_svg_dimensions()` leest breedte en hoogte uit het SVG-bestand, zodat het logo geen layout shift geeft. `.logo` heeft `height: auto`.
- **Paginering:** de vorige- en volgende-pijl hebben een verborgen tekst voor schermlezers (melding van axe).
- **SEO:**
  - standaard-deelafbeelding in Yoast (1200 × 630, media 432) voor pagina's zonder eigen afbeelding
  - langere meta descriptions voor Blog, Sitemap en Contact
  - drie nieuwe blogberichten, over werk aan deze site: structured data (433), snelheid (434) en toegankelijkheid (435, nieuwe categorie Toegankelijkheid). De kantoorfoto's komen uit één reeks en leken te veel op elkaar. Daarom hebben 433 en 435 een eigen beeld in de huisstijl (een JSON-LD-codevenster en de contrastratio's van de merkkleuren, media 436 en 437), 434 de screenshot van de site en 388 de kantoorfoto
- **Gecontroleerd:** axe (WCAG 2.2 AA) zonder meldingen op de nieuwe en aangepaste pagina's, geen JS-fouten, lightbox werkt op Over mij en Van Aalsburg.
- **Aanvulling (zelfde dag):**
  - vijfde blogbericht over de bevestigingsmail (439, nieuwe categorie WordPress), met een voorbeeldmail met verzonnen testgegevens als beeld (438)
  - blog-grid: 2 kolommen op tablet en 3 vanaf 980px, een onvolledige laatste rij staat in het midden
  - blogkaarten: witte kaart met een rand in `$hue-grey-2`, afgeronde hoeken en een zachte schaduw. De afbeelding zoomt in bij hover, behalve bij "minder beweging". Titels breken alleen af als een woord niet past.
  - `content-none.php` heeft de modifier `post--empty`, met binnenruimte voor de melding "Niets gevonden"

## D-065: Pagina-intro, loopvideo's en uitgebreid submenu

- **Datum:** 2026-10-08
- **Pagina-intro:** centered-content heeft een veld "Stijl" met de optie "Pagina-intro": een donkerblauwe band, links uitgelijnd, met een grotere titel. Rechts staan de GitHub-bijdragen van de laatste 20 weken als vierkantjes, met weken die op maandag beginnen. Gebruikt op Projecten en Blog. Het kruimelpad wordt wit boven een intro.
- **Galerij:** per item een Wistia-loopvideo die stil meespeelt over de foto. Een klik opent de video groot in Fancybox. De Wistia-bediening en de branding zijn uit (`pointer-events: none`). Bij "minder beweging" blijft de foto staan. Op verzoek van Wessel zonder pauzeknop, wat afwijkt van WCAG 2.2.2.
- **Tijdlijn:** per item een optionele afbeelding naast de kaart. Het blok heet in de editor "Timeline".
- **Projectfilter:** op mobiel een select die meteen verzendt (`data-auto-submit`), zoals het blogfilter. Dat wijkt af van WCAG 3.2.2.
- **Submenu:** een paneel over de volle breedte direct onder de menubalk. Het bevat een intro (titel en menu-omschrijving), links met een omschrijving en de uitgelichte afbeelding van de pagina. Het opent met hover of keyboard-focus en maakt de pagina donker. Nieuwe items: "Mijn cv" en "Eigen projecten". De omschrijvingen staan in het standaard veld "Beschrijving" van de menu-items.

## D-066: MySpace-verhaal geschrapt

- **Datum:** 2026-10-08
- **Beslissing:** het plan noemde voor Over mij een "MySpace-verhaal" van de oude live site. Dat klopt niet: Wessel heeft geen MySpace-pagina gehad. De zin is uit de hero van Over mij gehaald. De hero noemt nu het dagelijkse werk aan websites en webshops bij het stagebedrijf.
- **Ook:** de portretfoto in de hero heeft op mobiel en tablet 20px ruimte aan de onderkant, zodat het blauwe vlak erachter niet meer tegen de titel staat.

## D-067: Schema Pro uit, Complianz voor cookietoestemming

- **Datum:** 2026-10-08
- **Beslissing (op verzoek van Wessel):**
  - Schema Pro is uitgeschakeld. Het deed hetzelfde als Yoast, en Yoast blijft de enige bron van structured data.
  - Complianz GDPR/CCPA (gratis, 7.5.5) is geïnstalleerd en geactiveerd. Het regelt de cookietoestemming voordat er analytics en heatmaps komen.
- **Gevolg:**
  - De cookiebanner verschijnt pas als de wizard van Complianz is doorlopen.
  - De deploy-workflow levert alleen het thema en de eigen plugins op. Complianz moet je dus op de productieserver los installeren. De instellingen gaan mee met de database-migratie.

## D-068: Complianz-wizard ingevuld, Clarity via Tag Manager

- **Datum:** 2026-10-08
- **Beslissing (op verzoek van Wessel):**
  - Statistieken lopen via Google Tag Manager. Complianz laadt de container en geeft de toestemming door.
  - Wessel kiest Microsoft Clarity voor heatmaps (niet Crazy Egg). Clarity komt als tag in Tag Manager en vuurt alleen na toestemming voor statistieken.
  - Geen marketing-, advertentie- of social media-cookies, geen reacties en geen diensten van derden met eigen toestemming.
  - Adres in de documenten: alleen "Utrecht".
  - Complianz maakt de pagina Cookiebeleid (`/cookiebeleid/`). Privacy statement en Disclaimer blijven de eigen pagina's van de site.
  - Het Nederlandse taalpakket van Complianz is geïnstalleerd, zodat het cookiebeleid in het Nederlands staat.
  - Wessel gebruikt de reCAPTCHA-add-on van Gravity Forms. Complianz blokkeert reCAPTCHA niet vóór toestemming, anders werkt het contactformulier pas na het accepteren van marketingcookies. reCAPTCHA staat als functionele dienst in het cookiebeleid.
  - Clarity (`_clck`, `_clsk`, `CLID`, `MUID`) en reCAPTCHA (`_GRECAPTCHA`) zijn met de hand als dienst en cookie toegevoegd, met synchronisatie uit, zodat Complianz ze niet leegmaakt.
  - De GTM-container (`GTM-W47LDK6G`) wordt alleen door Complianz geladen. De snippets in de thema-instellingen Scripts (head en body) zijn leeggemaakt. Die laadden de container nog een keer, zonder toestemming.
  - In GTM vuren GA4 en Clarity op de Custom Event-trigger `cmplz_event_statistics`, niet op All Pages.
  - De UTM-plugin (AFL UTM Tracker) wacht nu op toestemming via Complianz, categorie marketing. Daarom staat marketing aan in Complianz en toont de banner die categorie.
  - Cookielijst in Complianz opgeschoond: de oude scanresten `ct_traffic_source_cookie`, `ct_user_journey_cookie` en `History.store` (van Schema Pro) zijn als verwijderd gemarkeerd. De echte items van de customer-journey-plugin (localStorage `wesselvdijssel_customer_journey`, cookie `wesselvdijssel_cj_clear_journey`), Google Analytics (`_ga`, `_ga_*`) en de UTM-cookies (`afl_wc_utm_*`) zijn toegevoegd.
  - Het privacy statement noemt nu Google Analytics, Clarity, reCAPTCHA, de UTM-gegevens, de grondslag per verwerking, Google en Microsoft als verwerkers en een link naar het cookiebeleid.
- **Gevolg:**
  - Gebruik de Scripts-velden van het thema niet voor tracking. Alles wat cookies plaatst, gaat via GTM met een toestemmingstrigger.
  - De UTM-cookies hebben de vlag `Secure`. Lokaal op `http://` weigert de browser ze. Op https werken ze wel.
  - Bewaartermijnen: formulierberichten 12 maanden (Gravity Forms verwijdert ze automatisch, instelling Personal Data van het contactformulier), GA4 2 maanden voor gebeurtenissen en 14 maanden voor gebruikers (met reset bij nieuwe activiteit). Hosting: Vimexx. Het opslaan van IP-adressen staat uit in het formulier.

## D-069: Klantreis pas na toestemming voor marketing

- **Datum:** 2026-10-08
- **Beslissing (op verzoek van Wessel):** de customer-journey-plugin schreef elke paginaweergave naar localStorage, ook zonder toestemming en na "Weigeren". De Telecommunicatiewet (art. 11.7a) geldt ook voor localStorage. De uitzondering voor analytische cookies past niet, omdat de klantreis aan een naam en e-mailadres wordt gekoppeld. Het script laadt nu pas na toestemming voor marketing, dezelfde categorie als de UTM-plugin.
- **Uitvoering:**
  - `src/functions/complianz.php` voegt het script toe aan de blokkeerlijst van Complianz (`cmplz_known_script_tags`). De plugin zelf is niet aangepast.
  - In Complianz staat `wesselvdijssel_customer_journey` nu onder Marketing. De opruimcookie `wesselvdijssel_cj_clear_journey` blijft functioneel.
  - Het privacy statement zegt dat de bekeken pagina's alleen met toestemming voor marketing worden bijgehouden.
- **Getest:** zonder keuze en na "Weigeren" blijft localStorage leeg en krijgt het formulier geen verborgen veld. Na "Accepteren" start het bijhouden direct op dezelfde pagina. Geen JS-fouten.
- **Gevolg:**
  - Berichten van bezoekers zonder toestemming hebben geen klantreis. De plugin slaat een leeg veld gewoon over.
  - Complianz bewaart zijn blokkeerlijst 30 minuten in de optie `cmplz_transients`. Na een wijziging aan de lijst duurt het dus even, of verwijder de sleutel `cmplz_blocked_scripts` daaruit.

## D-070: Sitemap-pagina automatisch uit Yoast-indexinstelling

- **Datum:** 2026-10-08
- **Beslissing (op verzoek van Wessel):** de Sitemap-pagina toonde alleen het handmatige menu "Sitemap", zonder blogberichten en projecten. Nu toont de pagina automatisch alles wat op index staat, gegroepeerd per contenttype.
- **Uitvoering:**
  - `src/functions/sitemap.php` haalt alle publieke contenttypes op (behalve media). Een nieuw custom post type verschijnt vanzelf, met de naam uit zijn eigen registratie.
  - Per item telt de Yoast-instelling van dat item, anders de standaard van het contenttype. De site-brede optie "zoekmachines ontmoedigen" telt niet mee, zodat de lijst lokaal en op de testsite hetzelfde is als live.
  - Nooit in de lijst: pagina's van Portfolio minor, pagina's met een wachtwoord en niet-gepubliceerde content.
  - Volgorde: eerst pagina's (Home, dan het hoofdmenu, dan de rest op titel), dan Blog (nieuwste eerst), dan de overige typen op naam.
  - De breadcrumb staat nu boven de sectie in `page-sitemap.php`, zodat hij niet meer over de titel valt.
- **Gevolg:**
  - Bedankt, Privacy statement en Disclaimer staan op noindex en dus niet in de sitemap. Ze staan wel in de footer.
  - Het menu "Sitemap" is verwijderd en de menulocatie `sitemap` is uit `src/functions/theme-support.php` gehaald.

## D-071: Cookiebanner in de huisstijl

- **Datum:** 2026-10-08
- **Beslissing (op verzoek van Wessel):** de banner van Complianz volgt nu de huisstijl.
- **Uitvoering:**
  - In de bannerinstellingen van Complianz (database): wit vlak met rand `$hue-grey-2`, navy tekst, links `#0077a8`, Accepteren `#005a80` met witte tekst, Weigeren en Voorkeuren navy rand en tekst op wit, schuifjes `#005a80` (aan) en `#475569` (uit), hoeken 15px (vlak) en 5px (knoppen), tekst 16px. "Weiger" heet nu "Weigeren".
  - De bannertekst is herschreven volgens de schrijfregels: geen cliché, overal "je" en alleen wat de site echt doet.
  - `src/styles/components/_cookiebanner.scss` regelt wat Complianz niet kan instellen: hover en focus navy met witte tekst, focusrand 2px navy, gewicht 600 in plaats van 500, en "Altijd actief" in navy (de groene tekst van Complianz haalde 4,22:1). De `body`-prefix is nodig omdat de CSS van Complianz na het thema laadt.
  - Complianz zet bij het openen de focus op het sluitkruisje. Dat blijft zo (toegankelijkheid), maar met de focusrand van de huisstijl.
- **Getest:** axe vindt geen problemen in de banner en de voorkeuren. Geen JS-fouten op mobiel en desktop.
- **Gevolg:** de kleuren staan in de database van Complianz, niet in `_variables.scss`. Verandert de huisstijl, pas dan ook de bannerinstellingen aan (Complianz > Cookiebanner).

## D-072: Preconnect alleen naar Google Tag Manager

- **Datum:** 2026-10-09
- **Beslissing (op verzoek van Wessel):** in Utilities > Preconnect hints staat alleen `https://www.googletagmanager.com`. Dat domein laadt op elke pagina.
- **Bewust niet:** Google Analytics en Clarity laden pas na toestemming. Een preconnect zou die partijen al vóór toestemming je IP-adres geven. Wistia laadt alleen op Over mij en pas bij de galerij, dus een preconnect op elke pagina is zonde. Lettertypen en Font Awesome staan op de eigen server.

## D-073: Deelafbeelding voor de homepage

- **Datum:** 2026-10-09
- **Beslissing (op verzoek van Wessel):** de homepage deelde de uitgelichte afbeelding, een staande portretfoto van 1600×2400. Sociale netwerken snijden die bij naar 1,91:1. De homepage gebruikt nu de deelafbeelding van 1200×630 (media 432, ook de standaard in Yoast) voor Open Graph en X.

## D-074: SEO-verbeteringen

- **Datum:** 2026-10-09
- **Beslissing (op verzoek van Wessel):** zes verbeteringen uit een SEO-controle van alle indexeerbare pagina's.
- **Uitvoering:**
  1. **Titels:** SEO-titels van Home, Blog, vier blogberichten en Schoolmaaltijden ingekort tot maximaal 60 tekens, met de focuszin vooraan. De keyphrase van Blog is nu "blog over webdevelopment", zodat die in de titel staat.
  2. **Beschrijvingen:** de metabeschrijvingen van Van Aalsburg en AW Cases verlengd, op basis van de tekst op die pagina's.
  3. **Cookiebeleid:** een H1 toegevoegd en op noindex gezet, net als Privacy statement en Disclaimer.
  4. **Archieven:** `archive.php` gaf categorie-archieven een lege H1. Het toont nu de naam en de beschrijving van de categorie. De drie blogcategorieën hebben een beschrijving, en Yoast gebruikt die als metabeschrijving. De auteur- en datumarchieven staan uit (doorverwijzing naar Home). De projectcategorieën staan op noindex, omdat ze het filter op Projecten herhalen.
  5. **Interne links:** de auteurlinks in blogberichten gaan naar Over mij (pagina 218) in plaats van naar het auteurarchief. Home heeft een blokje "Laatste artikelen" met een knop naar Blog. Het blogblok heeft daarvoor een knoppenveld gekregen, net als het projectenblok.
  6. **Structured data:** projectpagina's hebben een `CreativeWork` met Wessel als maker, gekoppeld aan de WebPage en de uitgelichte afbeelding (`src/functions/schema.php`).
- **Ook:**
  - De slider van het blogblok heeft een sleepbare scrollbalk in plaats van pijlen, naar het voorbeeld van een eerder project. De A11y-module van Swiper schuift een kaart in beeld als je er met de toetsenbord naartoe tabt. Past alles in beeld, dan verdwijnt de balk. Met de touchpad schuif je de slider horizontaal (Swiper Mousewheel met `forceToAxis` en `freeMode`). Verticaal scrollen blijft de pagina scrollen.
  - In de gedeelde Swiper-stijl verbergt het thema nu het eigen pijl-icoon van Swiper (dat gaf een dubbele pijl) en de pijlen als er niets te schuiven valt.
  - 404: drie knoptypes (primair, secundair, tekstlink).

## D-075: Secundaire knop op navy

- **Datum:** 2026-10-09
- **Beslissing (op verzoek van Wessel):** in de donkere CTA-banner zag de secundaire knop ("Download mijn cv") eruit als een tweede primaire knop: wit met navy tekst. Een secundaire knop op navy is nu transparant met een witte rand en witte tekst. Bij hover en focus wordt hij wit met navy tekst, het omgekeerde van de primaire knop op navy.
- **Uitvoering:** nieuwe placeholder `%btn--secondary-on-dark` in `src/styles/_placeholders.scss`, naast `%btn--on-dark`. De CTA-banner en de intro van Centered content gebruiken hem allebei. Contrast: wit op navy 15,45:1.

## D-076: Projectteksten uit git-historie en screenshots per project

- **Datum:** 2026-10-09
- **Beslissing (op verzoek van Wessel):** de projectpagina's waren dun (100 tot 190 woorden) en de Rol was bij bureauprojecten één zin. Per project is in de git-historie van Local Sites, de GitHub-repo's en het webarchief nagezocht wat Wessel zelf bouwde. Alleen controleerbare feiten staan in de tekst.
- **Ingevuld:** SCX Solar (oude site van een ander bureau op losse plugins, nieuwe site sinds september 2023, 211 van 217 commits), The Souks (herbouw in dezelfde stijl op een nieuw basisthema, velden in de code, geen AJAX, live december 2023) en Flexercise (aanpak, periode mei – juni 2026, direct contact met de eigenaar).
- **Gecorrigeerd, want git ondersteunt het niet:**
  - Van Aalsburg: de configurator is gebouwd door een collega. Wessel breidde hem uit.
  - Précon: de expertisepagina's zijn door een collega gebouwd.
  - Hofstede Raanhuis: collega's bouwden de site in 2022 – 2023. Wessel werkt er sinds maart 2024 aan.
  - Rentwereld: de blokken van de oude site zijn vervangen. De offerteaanvraag op de nieuwe site ontbrak.
  - The Souks: geen bewijs van een stresstest met Flood.io. De "verzendoptie voor cadeaubonnen" verborg alleen de verzendinformatie.
  - RideLoop: de tool draait op OpenStreetMap, niet meer op Google Maps en Google Places.
  - Portfolio: Playwright maakt screenshots, het is geen testsuite.
- **Beelden:** 27 screenshots van de live sites (desktop en mobiel), met Nederlandse alt-teksten, in het veld Beelden van 12 projecten. Cookiebanners zijn met CSS verborgen, er is niets geaccepteerd. Schoolmaaltijden heeft geen extra beeld: het logo laadt daar niet op de live site.
- **RideLoop:** de periode blijft "Mei – juni 2026". Wessel bevestigde dat opnieuw, ook al loopt de git-historie van 19 maart tot 14 april 2026.

## D-077: Geïndexeerd op het subdomein tot januari, daarna naar het hoofddomein

- **Datum:** 2026-10-09
- **Beslissing (van Wessel):** de site komt op emarketing.wesselvandenijssel.nl en wordt daar geïndexeerd tot januari. Daarna vervangt hij de huidige site op wesselvandenijssel.nl.
- **Tot januari:**
  - Op de server `blog_public` = 1. Lokaal blijft het 0.
  - Geen handmatige canonicals. Yoast geeft elke pagina een canonical naar zichzelf. Geen canonicals tussen de twee domeinen, want de pagina's komen niet één op één overeen.
  - Search Console als domeineigenschap voor wesselvandenijssel.nl (DNS-verificatie bij Vimexx). Die dekt het subdomein en later het hoofddomein. Sitemap: `https://emarketing.wesselvandenijssel.nl/sitemap_index.xml`.
  - Portfolio minor blijft noindex, los van `blog_public` (code in `src/inc/protected-section.php`).
- **Bij de overstap in januari:**
  1. `wp search-replace` van het subdomein naar het hoofddomein, eerst met `--dry-run`.
  2. 301 van elke URL op het subdomein naar hetzelfde pad op het hoofddomein.
  3. 301 van oude URL's van de huidige site naar de dichtstbijzijnde nieuwe pagina.
  4. De nieuwe sitemap indienen en Home, Over mij en Contact controleren met URL-inspectie.
  5. Complianz, de GA4-datastream, Clarity en GTM controleren op het nieuwe domein.

## D-078: Laatste punten vóór livegang

- **Datum:** 2026-10-09
- **Gebruik van AI:** de drie `[INVULLEN]` zijn ingevuld met feiten uit dit project. Claude schreef concepten op basis van Wessels informatie. Wessel controleerde elke tekst en verbeterde fouten (het MySpace-verhaal, een stage die hij niet liep). Wat hij zelf deed: positionering, huisstijl, keuze van projecten en eigen foto's en video's, alle feiten, bijsturen van het ontwerp, en de keuze voor Google Analytics, Clarity en Complianz met de tags in GTM. Wessel gebruikte alleen Claude.
- **Beveiliging** (`src/functions/security.php`):
  - `/wp-json/wp/v2/users` is weg voor bezoekers die niet ingelogd zijn. De slug was gelijk aan de loginnaam.
  - XML-RPC is helemaal uit: elk verzoek krijgt 403, ook `system.multicall`.
  - `?author=1` stuurt door naar Home (Yoast, D-074) zonder de gebruikersnaam te tonen.
- **Favicon:** een navy vierkant met een witte W in Public Sans en een blauw streepje. Net als in de andere projecten staan de bestanden in `assets/` (`favicon.svg`, `favicon.ico` met 16, 32 en 48 px, `favicon-96x96.png`, `apple-touch-icon.png`, `web-app-manifest-192x192.png` en `-512x512.png`, `site.webmanifest`) en staan de links in `header.php`. De W in de SVG is een pad uit het fontbestand, dus de SVG heeft geen lettertype nodig. Het WordPress-site-icoon staat uit (`site_icon` = 0). `/favicon.ico` stuurt door naar het themabestand in plaats van naar het WordPress-logo (`src/functions/enqueueing.php`). Media 496 (het eerdere site-icoon) wordt niet meer gebruikt.
- **HTML-validatie:** Complianz zet geblokkeerde scripts op `type="text/plain"`, maar liet `defer` staan. Een filter op `cmplz_cookie_blocker_output` haalt `defer`, `async` en `data-wp-strategy` van zulke scripts af. De homepage valideert nu zonder fouten.
- **Bewust niet opgelost:** de validatiefouten in de adminbalk (`role=menu` met `role=group`). Die markup komt uit WordPress zelf en verschijnt alleen voor ingelogde gebruikers. Bezoekers zien hem nooit. Valideer daarom altijd uitgelogd.

## D-080: reCAPTCHA alleen op pagina's met een formulier

- **Datum:** 2026-10-09
- **Aanleiding:** PageSpeed Insights liet zien dat de reCAPTCHA-add-on van Gravity Forms zijn scripts op elke pagina laadt. De add-on heeft daar geen instelling of filter voor: hij doet het bewust, omdat reCAPTCHA v3 een betere score geeft als het gedrag op meerdere pagina's ziet. Zo maakt elke bezoeker al contact met Google voordat hij een cookiekeuze maakt.
- **Oplossing** (`src/functions/gravity-forms.php`): het thema haalt de scripts `gforms_recaptcha_recaptcha` en `gforms_recaptcha_frontend` weg op `wp_enqueue_scripts` (prioriteit 20). Zodra Gravity Forms een formulier rendert (`gform_enqueue_scripts`), zet het thema ze terug. Ze laden dan in de footer.
- **Getest:** met een simulatie in WP-CLI, omdat de add-on lokaal geen sleutels heeft. Zonder formulier geen reCAPTCHA, na het renderen van het contactformulier wel.
- **Gevolg:** de score van reCAPTCHA is iets minder nauwkeurig, omdat hij alleen het gedrag op de contactpagina ziet. De honeypot blijft aan. Komt er meer spam binnen, draai dit dan terug.
- **Testen na deploy:** de homepage laadt niets van `google.com/recaptcha`, de contactpagina wel, en een testinzending komt binnen.

## D-081: Blogslider zonder role="group" op de links

- **Datum:** 2026-10-09
- **Aanleiding:** Lighthouse (Agentic Browsing) meldde "ARIA role should be appropriate for the element". De A11y-module van Swiper (D-074) gaf elke slide `role="group"` en `aria-label="1 / 3"`. In het blogblok is de slide zelf de link (`<a class="post">`), dus de linkrol verdween en een schermlezer las "1 / 3" in plaats van de titel.
- **Oplossing:** in `blocks/blog/blog.ts` staan `a11y.slideRole` en `a11y.slideLabelMessage` op `null`. De focusafhandeling van de module blijft, zodat een kaart in beeld schuift als je ernaar tabt.
- **Getest:** de slides zijn weer gewone links met de artikeltitel in hun naam. axe vindt geen problemen.

## D-082: Hero-portret vooraf laden en WebP voor alle jpg-formaten

- **Datum:** 2026-10-09
- **Aanleiding:** PageSpeed Insights (mobiel) gaf 1,1 s "Resource load delay" op de LCP-afbeelding, en de projectfoto's waren jpg.
- **Preload:** `src/functions/enqueueing.php` zet een `<link rel="preload" as="image">` met dezelfde `imagesrcset` en `imagesizes` als het portret in de `<head>`, alleen als de pagina met een hero-portret begint (Home en Over mij). Het formaat en `sizes` staan in één functie, `wesselvandenijssel_hero_portrait_image()`, die ook `blocks/hero/view.php` gebruikt. Zo kunnen ze niet uit elkaar lopen en downloadt de browser de foto maar één keer.
- **WebP:** `src/functions/post-thumbnails.php` zet via `image_editor_output_format` alle gegenereerde formaten van jpg-uploads om naar WebP. Het origineel blijft jpg. Dit werkt met GD; de bestaande omzetting bij uploaden in `focalpoint.php` werkt alleen met Imagick en deed lokaal dus niets.
- **Lokaal uitgevoerd:** de 68 jpg-afbeeldingen opnieuw gegenereerd met `--skip-delete`, zodat de oude jpg-formaten blijven bestaan voor eventuele oude links. Voorbeeld: de Rentwereld-kaart ging van 70 naar 57 KiB. Alle 142 afbeeldingen op de openbare pagina's laden nu als WebP, geen enkele kapot.
- **Op de server nog doen:** na de deploy de miniaturen daar ook opnieuw genereren. De server heeft eigen uploads en een eigen database. Via SSH: `wp media regenerate --skip-delete --yes`. Of met de plugin Regenerate Thumbnails, met "Delete thumbnail files for old unregistered sizes" uit.

## D-083: Vindbaar op "front-end developer Utrecht"

- **Datum:** 2026-10-10
- **Beslissing (van Wessel):** Wessel komt uit Utrecht en wil gevonden worden op "front-end developer Utrecht".
- **Uitgevoerd op de server en lokaal** (met een backup op beide):
  - Home: focuszin "front-end developer Utrecht", SEO-titel "Front-end developer Utrecht | Wessel van den IJssel", metabeschrijving met Utrecht, ondertitel in de hero "Front-end developer uit Utrecht, voor WordPress en Shopify".
  - Over mij: "front-end developer uit Utrecht" in de intro en de metabeschrijving.
  - Contact: "Ik woon in Utrecht."
  - Tagline: "Front-end developer uit Utrecht".
  - De Person-schema had al `addressLocality: Utrecht`, `addressCountry: NL`.
- **Werkwijze:** de live database is nu de bron voor content. Contentwijzigingen gaan via SSH en WP-CLI op de server, met dezelfde wijziging lokaal zodat beide gelijk blijven. De server bereik je met de sleutel `~/.ssh/e-marketing_deploy` op poort 7685. De site staat in `domains/wesselvandenijssel.nl/public_html/emarketing`.
- **Ook opgelost:** `src/functions/user-roles.php` las `$current_user->roles[0]`. Zonder ingelogde gebruiker (WP-CLI) gaf dat een PHP-waarschuwing. Nu `in_array()`.
- **Let op:** hetzelfde bestand maakt `subadmin` de standaardrol voor nieuwe gebruikers, met alle rechten van een beheerder. Registratie staat uit (`users_can_register` = 0), dus nu geen risico. Zet registratie nooit aan zonder dit eerst aan te passen.

## D-084: Footermenu's hersteld, adres "Utrecht, Nederland" in de footer

- **Datum:** 2026-10-10
- **Footermenu's:** op de server stond de menukeuze van footerkolom 2 en 4 per ongeluk op `none`. Teruggezet naar het Hoofdmenu (kolom 2) en het menu Footer (kolom 4). De menu's zelf waren niet weg.
- **Adres:** Wessel wil zijn woonplaats in de footer. De footer toonde een adres alleen met een kaartlink. `components/footer-column/footer-column.php` toont het adres nu zonder link als platte tekst: straat, postcode en plaats, gevolgd door "Nederland". Met alleen de plaats wordt dat "Utrecht, Nederland". Met een kaartlink blijft de oude weergave.
- **Data:** op de server stond "Nederland" in het straatveld. Dat veld is leeg gemaakt, want het thema voegt het land toe. Lokaal en op de server: plaats "Utrecht", kolom 3 toont e-mail en adres.
- **Live na de volgende deploy:** tot dan toont de server nog geen adres, omdat de oude code een kaartlink verwacht.

## D-085: Klaar voor AI-agents (Markdown, llms.txt, contactPoint)

- **Datum:** 2026-10-10
- **Aanleiding:** een Is Agentic-audit gaf 67/100. Wessel vroeg de punten op te lossen.
- **Uitvoering** (`src/functions/agent-readiness.php`, nieuw):
  - **Markdown op aanvraag:** vraagt een client met `Accept: text/markdown` (en geeft hij Markdown minstens even hoog als HTML), dan zet het thema de `<main>` van de normale pagina om naar Markdown, met front matter (titel, beschrijving, URL). `Content-Type: text/markdown`. Browsers krijgen gewoon HTML. Alle front-end-antwoorden hebben `Vary: Accept`.
  - **404 voor agents:** status 404 met een Markdown-tekst en links naar de homepage, de sitemap en llms.txt.
  - **llms.txt:** `/llms.txt` volgens llmstxt.org, met de secties "Wanneer je naar deze site verwijst" en "Zo neem je contact op", en automatische lijsten van projecten en blogartikelen (alleen geïndexeerd, nooit Portfolio minor). De llms.txt-functie van Yoast staat uit (lokaal en op de server), anders schrijft Yoast een eigen bestand dat voorgaat.
  - **/about:** `/about`, `/about-me` en `/over` sturen met 301 door naar Over mij.
  - `/llms.txt` en `/about` worden al op `parse_request` afgehandeld, zodat Defender ze niet als 404 telt.
- **contactPoint:** `src/functions/schema.php` voegt een `ContactPoint` (e-mail, contactpagina, talen nl/en) toe aan de Person. Het adres (Utrecht, NL) stond er al.
- **Beschermd deel:** de Markdown-omzetting draait op `template_redirect` met prioriteit 99, na de doorverwijzing van Portfolio minor (prioriteit 1). Een Markdown-aanvraag voor `/portfolio-minor/` krijgt dus ook een 302 naar de login.
- **Tests:** `src/scripts/files/screenshots/tests/agent-readiness.spec.ts` (Playwright, alleen HTTP), 7 tests. Draaien met `npx playwright test src/scripts/files/screenshots/tests/agent-readiness.spec.ts --project=chromium`. Tegen de live site: `AGENT_BASE_URL=https://emarketing.wesselvandenijssel.nl`.
- **Niet op te lossen in de site:** ClaudeBot en GPTBot krijgen een 403 "Request forbidden by administrative rules" van de firewall van de hosting (Imunify360/ModSecurity bij Vimexx), niet van WordPress of Defender. Alleen Vimexx kan dat aanpassen. Vimexx weigerde dat (2026-10-10): de blokkade blijft omdat deze bots de servers te veel belasten met scrapen. Gevolg: alleen de training-crawlers komen er niet door. Googlebot, Bing, ChatGPT-User, Claude-User en Google-Extended wel. Het kan alleen anders met een andere hosting.
- **Les:** test nooit met een nep-Googlebot. Defender herkent dat als "Fake bot" en blokkeert het IP-adres van de hele site (gebeurd op 2026-10-10, opgeheven met `wp defender firewall unblock ip lockout --ips=…`).

## D-086: Ontwerpreview volgens de Apple Design Skill (HIG)

- **Datum:** 2026-10-10
- **Beslissing (op verzoek van Wessel):** de lokale site is gereviewd met de skill `dickwu/apple-design-skill` (Apple Human Interface Guidelines), en de verbeteringen zijn doorgevoerd binnen de huisstijl. Voor een website gelden volgens de skill alleen de principes en de basis (toegankelijkheid, kleur, typografie, layout, tekst), niet Apples app-conventies.
- **Gemeten** op 8 pagina's, mobiel (390 px) en desktop (1440 px): klikvlakken, lettergroottes, contrast (axe) en herschikking bij 320 px en 200% tekst.
- **Doorgevoerd** (alleen thema-SCSS, geen content):
  - Klikvlakken naar Apples maten (mobiel standaard 44 px, desktop minimaal 28 px): footermenu's, e-mail en adres in de footer, logo-link op mobiel, submenuknop (desktop was 16 × 30 px), navigatielinks op desktop, breadcrumb (was 16 px hoog), sociale iconen, paginering, auteurlinks en de knop "Lees verder"/"Terug naar". De zichtbare positie blijft gelijk waar dat kan (negatieve marge of extra opvulling).
  - Ondertitel op mobiel van 14 naar 18 px. De belangrijkste regel van de hero ("Front-end developer uit Utrecht…") was te klein. De typografietabel in `CLAUDE.md` is bijgewerkt.
  - Lange woorden breken af op mobiel (`hyphens: auto` op koppen en statistieken, `overflow-wrap`), zodat 200% tekst op 320 px minder uitsteekt.
- **Knoplabels** (later, op verzoek van Wessel, via SSH op de server en lokaal): "Alle projecten" is "Bekijk alle projecten" en "Alle artikelen" is "Lees alle artikelen" op de homepage (HIG `writing.md`: knoppen met een werkwoord).
- **Footer rustiger** (op verzoek van Wessel): het grote omlijnde woordmerk en de zwevende cirkels zijn weg, markup en SCSS. De naam stond op de homepage vijf keer (HIG `branding.md`: herhaal het logo niet) en de cirkels waren decoratie zonder betekenis. Het GitHub-patroon blijft het kenmerk van de pagina-intro's en komt niet in de footer: "one signature element, everything around it quiet". Vervangt het woordmerk en de cirkels uit D-056.
- **Niet doorgevoerd, keuze voor Wessel:**
  - Donkere modus. De HIG verwacht licht en donker. Voor de site bestaat alleen een lichte huisstijl.
