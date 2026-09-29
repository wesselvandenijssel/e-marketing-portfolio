# Extra: scrollanimaties

- **Datum:** 2026-09-29
- **Status:** Klaar
- **Commit:** geen (D-029)
- **Beslissing:** D-037

## Wat er is veranderd

- `package.json`: `motion` ^13.1.0
- Nieuw: `src/scripts/files/animations.ts` en `src/styles/components/_animations.scss`
- `src/styles/components/_main.scss`: laadt `animations`
- `blocks/hero/_hero.scss`: het blauwe vlak achter de portretfoto volgt `--portrait-shift`

## Controles

| Controle | Resultaat |
|---|---|
| ESLint, Stylelint | 0 fouten |
| Productiebuild (naar een tijdelijke map) | Gelukt. De bestaande waarschuwing over de bundelgrootte blijft. |
| Playwright: 14 URL's (alle pagina's, 2 projecten en 404) op 390, 820 en 1440px | Na het scrollen is elk geanimeerd element volledig zichtbaar. Geen overloop, geen console-fouten. |
| Zelfde test met `prefers-reduced-motion: reduce` | Er worden geen animatieklassen gezet, alles is direct zichtbaar |
| Projectfilter | Na het filteren zijn de zichtbare projecten volledig zichtbaar |
| CTA-banner en hero | De `clip-path` eindigt op `inset(0%)`, het vlak achter de foto op 40px |
| `tsc --noEmit` | Eén fout in de types van `framer-motion` (`HTMLWebViewElement` ontbreekt in TypeScript 5.9). Webpack meldt die niet en bouwt gewoon, net als bij van-der-donk. |
| `npm audit` | Meldt kwetsbaarheden in bestaande dev-dependencies. Niet aangepast. |

## Wat Wessel nog moet doen

- Herstart je webpack-watcher. `animations.ts` is een nieuw bestand en de glob pakt dat pas op na een herstart.
