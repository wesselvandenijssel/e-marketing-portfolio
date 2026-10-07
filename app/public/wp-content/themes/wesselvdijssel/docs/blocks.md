# Blokken en componenten

Overzicht van alle blokken in het thema: waarvoor ze dienen en waar ze vandaan komen. De herkomst staat hier en niet in de code, want blokken en componenten hebben alleen de vaste bestandskop als commentaar (D-020).

## Blokken (14)

| Blok | Titel in de editor | Bron | Waarvoor |
|---|---|---|---|
| `hero` | Hero | base-theme. De variant "Portret naast tekst" is nieuw, naar het idee van van-der-donk `designer-intro`. | Opening van Home en Over mij |
| `content-image` | Content met afbeelding | base-theme | Tekst met beeld links of rechts |
| `centered-content` | Gecentreerde content | base-theme | Tekstpagina's, accordeons (FAQ, reflecties) |
| `background` | Achtergrond | base-theme | Sectie met achtergrondkleur |
| `blog` | Blog | base-theme | Nieuwste of gekozen blogberichten |
| `contact` | Contactformulier | base-theme | Gravity Forms-formulier |
| `icon-boxes` | Icoonblokken | flexercise `icon-boxes` | Vaardigheden, tools, diensten; inhoudsopgave van Portfolio minor |
| `timeline` | Tijdlijn | vink-schilderwerken `timeline`, omgezet naar block.json | Werkervaring, opleiding, bijdrage per datapunt |
| `projects` | Projecten | bureau-tromp `cases` (opbouw) + damsteegtwaterwerken `projects` (categoriefilter) | Projectgrid met filter en paginering |
| `statistics` | Statistieken | damsteegtwaterwerken `statistics` | Resultaten, nulmeting / 1-meting / eindmeting |
| `quote-slider` | Quote slider | flexercise `quote-slider` | Testimonials, 360 graden feedback (alleen op beschermde pagina's) |
| `logo-banner` | Logo banner | damsteegtwaterwerken `logo-banner` | Tools, certificaten, opdrachtgevers |
| `gallery` | Galerij | damsteegtwaterwerken `gallery` | Certificaten en projectbeelden met lightbox |
| `cta-banner` | CTA banner | damsteegtwaterwerken `cta-banner` | Oproep naar Contact, licht of donker |
| `github-activity` | GitHub-activiteit | Nieuw (D-060) | Openbare GitHub-kalender met totaal, op Ervaring |

## Componenten

| Component | Bron | Gebruikt door |
|---|---|---|
| `project-card` | bureau-tromp `case` | `projects` |
| `quote-slide` | flexercise `quote-slide` | `quote-slider` |
| `statistic` | damsteegtwaterwerken `statistic` | `statistics` |
| `breadcrumb`, `footer-column`, `logo-wrapper`, `popup`, `post`, `socials` | base-theme | thema en blokken |

## Custom post type

- **`project`**: slug `projecten`, geen archief. De pagina Projecten toont het grid. Losse projecten gebruiken `single-project.php`.
- **Taxonomie `project_category`**: slug `projectcategorie`.
- **Bron:** de registratie van damsteegtwaterwerken, aangepast voor dit thema.

## Beeldformaten

Alleen deze formaten worden aangemaakt. De standaardformaten van WordPress staan op 0.

| Formaat | Afmeting | Gebruik |
|---|---|---|
| `Hero 900`, `Hero mobile` | 1920×900, 740×250 | Hero met beeld als achtergrond |
| `Portrait` | 640×800, bijgesneden | Hero met portret |
| `Project card` | 720×480, bijgesneden | Projectkaart |
| `Content` | max. 880×880 | Galerij, CTA-afbeelding |
| `Avatar` | 128×128, bijgesneden | Foto bij quote, thumbnails in de lightbox |
| `Post`, `Blog detail`, `Author thumb` | base-theme | Blog |
