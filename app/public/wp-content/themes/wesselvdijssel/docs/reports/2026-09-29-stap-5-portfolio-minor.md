# Stap 5: login-gedeelte "Portfolio minor"

Dit is het beschermde deel van stap 1 uit het plan.

- **Datum:** 2026-09-29
- **Status:** Klaar. Alle inhoud is nog `[INVULLEN]`.
- **Commit:** geen (D-029)

## Keuze

Er zijn twee opties vergeleken (D-031):
- **A. Een wachtwoord op de hoofdpagina.** Het geldt niet voor subpagina's, titels lekken, en je kunt de toegang niet intrekken.
- **B. Login met een gebruikersrol.** Gekozen, met de status Privé van WordPress. WordPress dwingt de afscherming dan zelf af, overal. Het thema voegt alleen redirect, noindex, no-cache en blokkades toe.

## Wat er is gebouwd

- **`src/inc/protected-section.php`**, geladen vanuit `functions.php`. Het bevat:
  - de rol `portfolio_beoordelaar`: `read` en `read_private_pages`
  - `wesselvandenijssel_is_portfolio_page()` en `wesselvandenijssel_portfolio_page_ids()`
  - een redirect naar de login voor elke URL onder `/portfolio-minor/`, met het nette pad als `redirect_to`
  - `noindex, nofollow` (Yoast, core, `X-Robots-Tag`), `nocache_headers()` en `DONOTCACHEPAGE`
  - geen Open Graph- en Twitter-tags
  - een tweede uitsluiting uit de Yoast-sitemap, de core-sitemap en de menu's
  - geen "Privé:" in titels
  - voor de beoordelaar: na het inloggen direct naar het portfolio, geen wp-admin en geen adminbalk
- **Pagina's (status Privé, noindex/nofollow in Yoast):**
  - Portfolio minor (321), met een inhoudsopgave naar alle subpagina's
  - subpagina's 322 tot en met 332:
    - Samenvatting portfolio
    - Voice Card en reflectie
    - Motivatie en persoonlijke groei
    - Nulmeting, 1-meting en eindmeting
    - Leervragen en leerdoelen
    - Toegepaste theorie
    - Bijdrage aan het team
    - Persoonlijke bijdrage per datapunt
    - Aanvullende kennis
    - Conclusie en wat ik verder wil leren
    - Bewijs per leeruitkomst
- **Vaste opbouw per pagina:**
  - een h1 met een inleiding
  - secties met `[INVULLEN: …]`-aanwijzingen
  - waar dat past: accordeons (dialogen, leervragen, theorieën), een tijdlijn (metingen, 9 datapunten), een quote-slider (360 graden feedback) en een galerij (certificaten)
  - onderaan de knop "Terug naar het overzicht"
- **Account:** de gedeelde login `beoordelaar` (D-003), met e-mail info+beoordelaar@wesselvandenijssel.nl. Het wachtwoord staat niet in de repo of in `docs/`.
- **Ook opgelost (D-032):** de melding dat vertalingen te vroeg laden.

## Controles

**Als uitgelogde bezoeker:**

| Test | Resultaat |
|---|---|
| `/portfolio-minor/` en subpagina's | 302 naar `wp-login.php?redirect_to=<nette URL>` |
| Niet-bestaande subpagina | ook 302, dus paginanamen zijn niet te raden |
| `?page_id=321`, `?p=322` | 404 |
| REST `pages/321` | 401 |
| REST `pages?status=private` | 400 |
| REST-lijst en REST-search | 0 treffers |
| REST `users` (beoordelaar) | 0 |
| oEmbed | 404 |
| Zoeken `?s=leeruitkomst` | 0 |
| Feed | 0 |
| Yoast-sitemap, core-sitemap, HTML-sitemap, home en menu's | 0 |

**Als beoordelaar (Playwright, 1440 en 390 px):**
- Inloggen via de redirect brengt je terug op de gevraagde subpagina.
- De titel is zonder "Privé:".
- Meta en header geven `noindex, nofollow`, met `Cache-Control: no-cache, must-revalidate, max-age=0, no-store, private`.
- Er zijn 0 OG- en Twitter-tags, en er is geen adminbalk.
- `/wp-admin/` stuurt door naar `/portfolio-minor/`.
- De inhoudsopgave heeft 11 blokken.
- Er zijn geen console-fouten en er is geen overloop.

**Overig:**
- `php -l`: in orde.
- Branding-check: 0 treffers.
- Foutlog: geen nieuwe meldingen.

## Voor Wessel

1. **Inhoud:** vul de `[INVULLEN]`-blokken. Het aantal datapunten staat op 9; pas dat aan als het afwijkt.
2. **Toegang voor docenten:** deel de URL `/portfolio-minor/`, de login `beoordelaar` en het wachtwoord.
3. **Productie:**
   - Maak de rol en het account opnieuw aan. De rol ontstaat vanzelf zodra het thema actief is.
   - Kies een nieuw wachtwoord.
   - Zet WP Rocket nooit op caching voor ingelogde gebruikers.
4. **Uploads:** bestanden op deze pagina's zijn via hun directe URL bereikbaar. Plaats geen cijfers of persoonlijke feedback in bestanden die niet openbaar mogen worden.
