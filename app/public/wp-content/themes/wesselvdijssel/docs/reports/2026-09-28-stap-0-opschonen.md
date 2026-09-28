# Stap 0: backup, thema activeren, branding opschonen

- **Datum:** 2026-09-28
- **Status:** Klaar. De blokkades zijn opgelost na de antwoorden van Wessel, zie "Afronding" onderaan.
- **Commit:** geen (D-007)

## Wat er is gedaan

### Backup

- `app/sql/2026-09-28-voor-stap-0.sql` (1,7 megabyte). Git negeert `app/sql/`.

### Thema geactiveerd

- `wp theme activate wesselvdijssel`. Het oude `stylesheet`/`template` was `base-theme`, een map die niet meer bestaat.
- Menu-locaties zijn overgenomen: primary en primary_mobile → menu 3, sitemap → menu 4.
- Direct na de activatie gaf de homepage 200.

### Database

- blogname: "Wessel van den IJssel". blogdescription: "Front-end developer". current_theme is aangepast.
- `admin_email` en `new_admin_email` zijn nu info@wesselvandenijssel.nl. `adminhash` (een openstaande wijziging naar het oude bureau-adres) is verwijderd.
- Thema-opties:
    - de bedrijfsnaam, het e-mailadres en de mail-link gaan naar Wessel
- Yoast: `website_name` en `company_name` zijn nu "Wessel van den IJssel". De keuze tussen persoon en organisatie volgt in stap 4.
- Het logo in de thema-opties was het logo van het stagebedrijf (bijlage 58). Het is nu een tijdelijk tekstlogo (bijlage 160).
- Gravity Forms, formulier 1:
    - de beheerdersmelding gaat naar info@wesselvandenijssel.nl en komt van info@wesselvandenijssel.nl
    - de reply-mail heeft from info@, fromName "Wessel van den IJssel" en reply-to info@
- De 7 testberichten (ID 105 en 141–146) zijn definitief verwijderd. Er staan nu 0 berichten.

## Controles

De technische opties die blijven staan, zijn niet zichtbaar op de site en horen bij plugins:

- `gf_telemetry_data`
- `acf_site_health`
- `auto_core_update_notified`
- `external_updates-*`
- `wpmdb_*`

### Overige controles

- **`php -l`:** alle 80 PHP-bestanden in het thema zijn syntactisch in orde (PHP 8.5.3 van Local).
- **Build:** niet nodig. Er is geen SCSS of TypeScript gewijzigd. `login.css` wordt direct geladen en gaat niet door webpack.

- **Foutlog** (`wp-content/debug.log`, in UTC):
    - Nieuw: de fatal van blokkade 1.
    - Bekend: de melding `_load_textdomain_just_in_time` voor `wesselvandenijssel`. Die kwam vóór de wijziging ook al voor de oude text domain, dus het thema laadt vertalingen al te vroeg. Wordt opgelost in stap 1.
    - Ruis: deprecations van WP Migrate DB Pro en Yoast onder PHP 8.5.

## Afronding na de antwoorden van Wessel

Antwoorden: 1 ja (plugin bewust aan, D-008), 2 ja (hernoemen, wachtwoord blijft, D-009), 3 ja (media weg), 4 Wessel regelt `local-site.json` (D-010).

### Wijzigingen

- **Extra backup:** `app/sql/2026-09-28-stap-0-voor-gebruiker-en-media.sql`.
- **Gebruiker 1:**
    - login `wesselvandenijssel`, naam "Wessel van den IJssel" (ook voor- en achternaam en nickname)
    - e-mail info@wesselvandenijssel.nl, auteur-slug `wesselvandenijssel`
    - `_new_email` is verwijderd, het wachtwoord is ongewijzigd
    - de login is met een directe `$wpdb->update` aangepast, omdat WordPress daar geen API voor heeft
- **Media:**
    - bijlagen 58 en 60 (twee logo's van het stagebedrijf) zijn definitief verwijderd
    - 5 losse afgeleiden van bijlage 60 in `uploads/2024/03/` zijn ook verwijderd (bewerkte versies en webp-kopieën). Er waren 0 verwijzingen naar in de database.
- **Extra oude naamgeving gevonden en verwijderd.** De eerste grep miste deze, omdat hij alleen op de volledige bureaunaam zocht:
    - `src/functions/theme-settings.php`: het adminmenu met de bureaunaam heet nu "Thema-instellingen", de slug met de oude prefix is nu `theme-settings`, en het menu-icoon (het bureaulogo als SVG) is `dashicons-admin-generic`. De ACF-data is onveranderd, want die hangt aan `post_id`, niet aan de slug.
    - `src/functions/acf/loader/theme-init.php`:
        - de functie voor de blokcategorie heet nu `wesselvandenijssel_block_category`
        - de blokcategorie met de bureaunaam heet nu "Themablokken"
        - het blokicoon (het bureaulogo) is dashicon `layout`
        - de oude categorie-slug is nu `block-elements`. Die bestond niet als geregistreerde categorie, dus dit lost meteen een oude fout op.
    - `json-ld.php`: de oude prefix van functies, variabelen en het schema-filter is nu `wesselvandenijssel_`.
- **Scherminstellingen:** twee usermeta onder de oude menunaam zijn verwijderd (`closedpostboxes_*` en `metaboxhidden_*` van de review-instellingen).
- **Yoast:** de auteur-indexable (ID 18) wees nog naar de oude auteur-URL en is bijgewerkt. `wp yoast index --reindex` weigert op een niet-productieomgeving.

### Controles na de afronding

Alle resterende treffers staan in technische plugin-opties en zijn niet zichtbaar (zie de lijst hierboven). Er is ook één nieuwe: `external_updates-wesselvdijssel-customer-journey`, van de plugin die nu aan staat.

- **Pagina's:** deze gaven allemaal 200, zonder treffers op de oude branding in de HTML:
    - `/`
    - `/contact/`
    - `/contact/bedankt/`
    - `/contact/privacy-statement/`
    - `/contact/disclaimer/`
    - `/sitemap/`
    - `/blog/`
    - `/author/wesselvandenijssel/`
    - `/wp-login.php`
- **`php -l`:** alle PHP-bestanden in het thema zijn syntactisch in orde.
- **Foutlog na de afronding:** geen fatals of warnings uit het thema. Er staan twee bekende meldingen:
    - de melding `_load_textdomain_just_in_time`, die er al was en in stap 1 wordt opgelost
    - één melding "Cron reschedule … action_scheduler_run_queue invalid_schedule", van een plugin met Action Scheduler, niet van het thema

## WP-CLI in deze omgeving

`wp` in de shell gebruikt de kapotte Homebrew-PHP. Werkende aanroep:

```bash
L="$HOME/Library/Application Support/Local"
SOCK="$L/run/BYKSypxtD/mysql/mysqld.sock"
export PATH="$L/lightning-services/mysql-8.0.35+4/bin/darwin-arm64/bin:$PATH"   # for wp db export
cd "~/Local Sites/e-marketing/app/public"
"$L/lightning-services/php-8.5.3+1/bin/darwin-arm64/bin/php" \
  -d mysqli.default_socket="$SOCK" -d display_errors=stderr \
  /Applications/Local.app/Contents/Resources/extraResources/bin/wp-cli/wp-cli.phar <command> 2>/dev/null
```

Of gebruik de "Open site shell" van Local.
