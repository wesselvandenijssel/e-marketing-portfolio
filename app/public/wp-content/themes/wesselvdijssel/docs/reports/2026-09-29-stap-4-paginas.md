# Stap 4: openbare pagina's

- **Datum:** 2026-09-29
- **Status:** klaar. Waar feiten ontbreken, staat `[INVULLEN]`.
- **Commit:** nog niet (D-007).

## Pagina's

| Pagina | URL | Opbouw |
|---|---|---|
| Home (8) | `/` | Hero met portret (naam, "Front-end developer", pitch, 2 knoppen) · Wat ik voor je doe (4 icoonblokken) · Uitgelichte projecten (Rentwereld, Van Aalsburg, Précon) · CTA naar Contact |
| Over mij (218) | `/over-mij/` | Hero met portret · Mijn merk IK `[INVULLEN]` · Waarom ik goed ben als online marketing consultant · Mijn passie · Mijn persoonlijke kant · CTA |
| Ervaring (219) | `/ervaring/` | Tijdlijn Werk (front-end developer sinds 2023, stage sep 2023 – mei 2024) · Tijdlijn Opleiding (HBO-ICT Duaal HU, minor E-marketing) · Skills (6) · Tools · Certificaten (4, galerij) · Cv `[INVULLEN]` |
| Projecten (220) | `/projecten/` | Intro · Projectgrid met filter (Webshop, Website) · CTA |
| Project (8×) | `/projecten/<slug>/` | Uitgelichte afbeelding · gegevens (opdrachtgever, periode, website, tools) · De opdracht · Mijn rol · Aanpak · Resultaat (met bron) · Beelden |
| Blog (136) | `/blog/` | Berichtenpagina (`page_for_posts`) |
| Contact (12) | `/contact/` | h1, intro, e-mail, LinkedIn en GitHub · formulier |
| Bedankt (14) | `/contact/bedankt/` | Bedankt-tekst, knoppen naar Home en Projecten, noindex |
| Privacy statement (16) | `/contact/privacy-statement/` | Klopt met het formulier en de plugins (D-025) |
| Disclaimer (18) | `/contact/disclaimer/` | Algemeen, plus projecten en resultaten, links en auteursrecht |
| Sitemap (22) | `/sitemap/` | Sitemapmenu met alle publieke pagina's |
| Gebruik van AI (225) | `/gebruik-van-ai/` | Waarvoor AI is gebruikt, met APA-vermeldingen van Claude en Claude Code |
| 404 | elke onbekende URL | Tekst in de je-vorm, met knoppen naar Home, Projecten en Contact |

**Projecten:**
- **Website:** Rentwereld, Précon, Hofstede Raanhuis, SCX Solar, Jan van Sundert en AW Cases.
- **Webshop:** The Souks.
- **Beide:** Van Aalsburg, met extra beeld van de webshop.

De bronnen en regels staan in D-024.

**Menu's:**
- **Hoofdmenu:** Home, Over mij, Ervaring, Projecten, Blog en Contact.
- **Footer:** de kolom "Navigatie" toont het hoofdmenu.
- **Subfooter:** Sitemap, Privacy statement, Disclaimer en Gebruik van AI.
- **Sitemapmenu:** alle publieke pagina's.

## Code

- **Nieuwe veldgroep:** `src/functions/acf/post-types/project.php`, met vaste projectvelden.
- **Nieuw component:** `components/project-details/` (php + scss).
- **`single-project.php`:** toont de projectgegevens en gebruikt het formaat `Hero 900` voor de uitgelichte afbeelding.
- **`404.php`:** nieuwe terugvaltekst met knoppen. De `onclick`-knop is weg.
- **`_content-layout.scss`:** links in lijsten zijn onderstreept en gekleurd. Zonder dat waren ze niet als link te herkennen (WCAG 1.4.1).

## Formulier (Gravity Forms, formulier 1)

- **Velden:**
  - Naam, E-mailadres en Bericht (verplicht)
  - Telefoon (optioneel)
  - een toestemmingsvinkje met een link naar de privacyverklaring
- **Instellingen:** de honeypot staat aan en het IP-adres wordt niet opgeslagen.
- **Bevestiging:** doorsturen naar Bedankt.
- **Mails:**
  - de melding gaat naar info@wesselvandenijssel.nl, onderwerp "Nieuw bericht via wesselvandenijssel.nl"
  - de afzender krijgt een bevestiging in de je-vorm

## Controles

- **Statuscodes:** alle 15 publieke URL's geven 200, ook het filter en drie projectpagina's. Een onbekende URL geeft 404.
- **Screenshots:** gemaakt van 10 pagina's op 1440 en 390 px. Er is geen horizontale overloop en er zijn geen console-fouten.
- **Iconen:** in de kit gecontroleerd per webfont. Alle gebruikte iconen staan in de regular-font (D-026).
- **Formuliertest (Playwright + Mailpit):**
  - Zonder vinkje: melding "Geef toestemming om je bericht te versturen."
  - Met vinkje: doorsturen naar `/contact/bedankt/`, en beide mails komen aan.
  - Het IP-adres blijft leeg.
  - De testinzendingen zijn verwijderd.
- **Yoast:**
  - Titels en beschrijvingen staan per pagina.
  - Bedankt, Privacy statement en Disclaimer staan op noindex. Die laatste twee stonden daar al op.
  - Het schema geeft een persoon.
  - Verouderde indexables van de bestaande pagina's zijn verwijderd, zodat Yoast de nieuwe waarden gebruikt.
- **Build en lint:**
  - `php -l` op de nieuwe en gewijzigde bestanden: in orde.
  - Productiebuild: in orde.
  - Stylelint van het nieuwe component: in orde.
  - Branding-check van het thema: 0 treffers.
  - Het component heeft geen commentaar (D-020).
- **Foutlog:** geen nieuwe meldingen van de site. Een GF-warning over het toestemmingsveld is opgelost met een omschrijving bij het veld.
- **Testcontent van stap 2:** verwijderd, met de losse testbestanden.

## Deploy

- **`REMOTE_PATH`:** gevonden en ingesteld (D-027). De droge run is groen, met thema, Font Awesome-kit en beide plugins.
- **Nog niet live:**
  - Op de server draait nu lumie.
  - Voor livegang zijn nodig: de commits, een push naar `master`, de database-migratie, de themaactivatie en `blog_public` op 1.

## Open voor Wessel

Zie de lijst in [progress.md](../progress.md), onder "Open punten voor Wessel".
