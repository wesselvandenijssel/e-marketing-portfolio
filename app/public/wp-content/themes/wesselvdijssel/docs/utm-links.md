# UTM-links

Vaste afspraken voor links naar de site, zodat je in GA4 (Acquisitie > Verkeersacquisitie) en bij formulierinzendingen (UTM-plugin) ziet waar bezoekers vandaan komen.

## Afspraken

| Parameter | Waarde | Wanneer |
| --- | --- | --- |
| `utm_source` | `linkedin`, `github`, `cv`, `email` | het platform of document |
| `utm_medium` | `social` (bericht), `profile` (profiellink), `pdf` (cv), `signature` (e-mailhandtekening) | het soort plek |
| `utm_campaign` | `blog-<slug>`, `profiel`, `cv-2026` | wat je promoot |

- Altijd kleine letters, geen spaties.
- Zet nooit UTM-parameters op links binnen de eigen site. Dan begint GA4 een nieuwe sessie en raak je de echte bron kwijt.
- In januari verhuist de site naar wesselvandenijssel.nl. De 301 van het subdomein naar het hoofddomein houdt de parameters vast, dus oude links blijven meten. Nieuwe links maak je vanaf dan met het hoofddomein.

## Kant-en-klare links

### Cv (staat al in de pdf)

```
https://emarketing.wesselvandenijssel.nl/?utm_source=cv&utm_medium=pdf&utm_campaign=cv-2026
```

### LinkedIn-profiel (website-veld en uitgelichte link)

```
https://emarketing.wesselvandenijssel.nl/?utm_source=linkedin&utm_medium=profile&utm_campaign=profiel
```

### GitHub-profiel (website-veld)

```
https://emarketing.wesselvandenijssel.nl/?utm_source=github&utm_medium=profile&utm_campaign=profiel
```

### E-mailhandtekening

```
https://emarketing.wesselvandenijssel.nl/?utm_source=email&utm_medium=signature&utm_campaign=profiel
```

### LinkedIn-berichten per blogartikel

| Artikel | Link |
| --- | --- |
| Een bevestigingsmail die past bij je website | `https://emarketing.wesselvandenijssel.nl/wordpress/bevestigingsmail-gravity-forms/?utm_source=linkedin&utm_medium=social&utm_campaign=blog-bevestigingsmail` |
| Structured data: zo vertel je Google wie je bent | `https://emarketing.wesselvandenijssel.nl/seo/structured-data-vertel-google-wie-je-bent/?utm_source=linkedin&utm_medium=social&utm_campaign=blog-structured-data` |
| Een snellere website: laad alleen wat een pagina nodig heeft | `https://emarketing.wesselvandenijssel.nl/seo/snellere-website-laad-alleen-wat-nodig-is/?utm_source=linkedin&utm_medium=social&utm_campaign=blog-snellere-website` |
| Toegankelijk bouwen begint bij contrast | `https://emarketing.wesselvandenijssel.nl/toegankelijkheid/toegankelijk-bouwen-begint-bij-contrast/?utm_source=linkedin&utm_medium=social&utm_campaign=blog-toegankelijk-bouwen` |
| SEO verbeteren begint in de code | `https://emarketing.wesselvandenijssel.nl/seo/seo-verbeteren-begint-in-de-code/?utm_source=linkedin&utm_medium=social&utm_campaign=blog-seo-in-de-code` |

Nieuw artikel: neem de URL van het artikel en zet erachter `?utm_source=linkedin&utm_medium=social&utm_campaign=blog-<kort-onderwerp>`.

## Waar je het terugziet

- **GA4:** Rapporten > Acquisitie > Verkeersacquisitie, dimensie "Sessiebron/-medium" of "Sessiecampagne". Alleen voor bezoekers die statistieken accepteren.
- **Formulierinzendingen:** de UTM-plugin bewaart de bron bij elke inzending, alleen als de bezoeker marketingcookies accepteert.
- **Leads per bron:** in GA4 een verkenning met de dimensie "Sessiebron/-medium" en het key event `generate_lead`.

## Experiment: contactbanner op projectpagina's

Thema-instellingen > Projecten > "Contactbanner tonen". Daar pas je ook de titel en de knoppen aan. Staat uit tot na de nulmeting (zie D-089).

Meten van klikken op de banner, in GTM:

- **Trigger:** Klik - Alleen links, sommige klikken: `Click Element` komt overeen met CSS-selector `.project-cta a`, en `Cookie - toestemming statistieken` is gelijk aan `allow`.
- **Tag:** GA4-gebeurtenis `project_cta_click`, parameter `link_text` = `{{Click Text}}`.
- Zet `Click Element` en `Click Text` aan bij de ingebouwde variabelen.
