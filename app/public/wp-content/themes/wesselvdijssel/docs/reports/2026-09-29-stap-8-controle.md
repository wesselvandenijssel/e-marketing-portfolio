# Stap 8: eindcontrole

- **Datum:** 2026-09-29
- **Status:** Klaar
- **Commit:** geen (D-029)

De test liep tegen de echte `dist/` (de watcher is op 29-09 om 14:02 opnieuw gestart), met WP_DEBUG aan (`WP_DEBUG_LOG` true, `WP_DEBUG_DISPLAY` false).

## Testresultaten

| Test | Resultaat |
|---|---|
| **Publieke pagina's** (24 URL's: alle pagina's en projecten, zoeken, filter, 404, login) op 390, 820 en 1440px | Geen overloop, precies 1 h1, alle afbeeldingen met alt-tekst, geen JS-fouten. Eén melding in de eerste run (`ERR_NETWORK_CHANGED`) bleek een netwerkhapering. |
| **Portfolio minor** (12 pagina's), ingelogd, op 3 breedtes | Geen problemen |
| **Interne links** (26) | Geen kapotte links |
| **Loginpagina** | Stak op mobiel 62px uit en had te weinig contrast. Beide zijn opgelost (D-036). |
| **Formulier** | Zonder vinkje geblokkeerd. Met vinkje doorgestuurd naar `/contact/bedankt/`. Melding aan info@wesselvandenijssel.nl en bevestiging aan de afzender (Mailpit). Het IP-adres blijft leeg. De testinzendingen zijn verwijderd. |
| **Beveiliging, uitgelogd** | 17 van de 17 tests geslaagd: 302 naar login (ook voor niet-bestaande subpagina's), `?page_id` en `?p` geven 404, REST 401/400, 0 treffers in zoeken, feed, oEmbed, beide sitemaps en de REST-lijst |
| **Beheer** (dashboard, lijsten, blokeditor voor Home, een project en een portfoliopagina, 4 thema-instellingen, formuliereditor, menu's) | Alles 200, geen console-fouten, alle blokken met een preview, geen PHP-melding op het scherm |
| **PHP-log van het thema** | 3 meldingen gevonden en opgelost (D-036). Na de fix geen nieuwe meldingen. |
| **PHP-log van plugins** | Deprecations onder PHP 8.5 in Yoast, WP Migrate DB Pro en lh-multipart-email. Die worden niet aangepast. |
| **`php -l`, branding-check** | Alle PHP-bestanden in orde, 0 treffers |

De tijdelijke test-admin is weer verwijderd. Nu bestaan alleen `wesselvandenijssel` (beheerder) en `beoordelaar` (rol portfolio_beoordelaar).

## Wat klaar is

- Thema opgeschoond, eigen branding, text domain `wesselvandenijssel`
- Huisstijl: palet, contrast WCAG 2.2 AA, Public Sans zelf gehost
- 14 blokken en 4 nieuwe componenten, herkomst in `blocks.md`
- Publieke pagina's met Yoast, alt-teksten en de je-vorm:
  - Home, Over mij, Ervaring, Projecten (8 projecten), Blog en Contact
  - Bedankt, Privacy statement, Disclaimer, Sitemap, Gebruik van AI en 404
- Contactformulier met toestemming, honeypot, doorsturen en meldingen
- Portfolio minor: 12 privépagina's, beoordelaarsaccount, afgeschermd tegen alle lekroutes
- Menu met knop "Portfolio (login)" en een footer met intro, contact, LinkedIn, juridische links en copyright
- Deploy-workflow met repository secrets. De droge run is groen.

## Wat Wessel nog moet doen

### Inhoud (`[INVULLEN]` op de site)

| Waar | Aantal | Wat |
|---|---|---|
| Over mij | 3 | merk IK, wat je leert in de minor, hobby's |
| Ervaring | 5 | startjaar HBO-ICT, school en einddatum van de minor, omschrijving van de minor, cv-knop |
| Contact | 1 | reactietermijn |
| Privacy statement | 3 | bewaartermijn, hostingpartij, cookies controleren |
| Gebruik van AI | 3 | eigen teksten, eigen keuzes, andere AI-tools |
| Blog | 1 | eerste blogbericht |
| Project SCX Solar, The Souks | 1 + 1 | resultaat |
| Portfolio minor (12 pagina's) | 142 | alle inhoud |

### Bestanden

- Echt cv als pdf (`Professioneel CV A4.pdf` in Downloads is een lege template)
- Betere portretfoto (de huidige is 400 × 400 px)
- Eventueel Voice Card, certificaten uit de minor en bewijsstukken

### Livegang

1. Commits en push naar `master`, alleen als je daarom vraagt (D-029).
2. Op de server:
   - de database migreren naar emarketing.wesselvandenijssel.nl (daar staat nu lumie)
   - het thema `wesselvdijssel` activeren
   - `blog_public` op 1 zetten
3. Het beoordelaarsaccount op productie opnieuw aanmaken, met een nieuw wachtwoord.
4. Controleren dat WP Rocket (als het aan gaat) ingelogde gebruikers en `/portfolio-minor/` niet cachet.
