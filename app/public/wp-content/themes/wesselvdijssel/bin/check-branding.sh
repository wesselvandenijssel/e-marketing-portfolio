#!/usr/bin/env bash
# Checks the theme (and optionally the database) for leftovers of the original base-theme branding.
# The search patterns live here, not in the Markdown docs, so the docs never have to name the old brand.
#
# Usage:
#   bin/check-branding.sh              theme only
#   WP="wp" bin/check-branding.sh      theme + database dry-run (WP is the WP-CLI command to use)
#
# Exits with 1 when the theme still contains a match.

set -u
cd "$(dirname "$0")/.." || exit 2

excludes=(--exclude-dir=node_modules --exclude-dir=vendor --exclude-dir=dist --exclude-dir=.git --exclude-dir=bin --exclude=package-lock.json --exclude=composer.lock)
status=0

echo "== Theme: full names"
grep -rniI "mb effect\|mbeffect\|mb-effect\|mb_effect\|mbbma\|mb-bma\|mb bma" "${excludes[@]}" . && status=1

# Short prefixes the base-theme uses (mb_schema_*, mb-settings, "MB instellingen").
# PHP's own multibyte functions (mb_strlen, mb_substr, ...) are filtered out.
echo "== Theme: short prefixes"
grep -rnI "[\"'/_ -]mb[-_][a-z]\|\bMB\b" "${excludes[@]}" . | grep -v "mb_\(str\|sub\|convert\|internal\|check\|detect\|encode\)" && status=1

if [ -n "${WP:-}" ]; then
	# Dry-run only: shows where the database still holds old names, changes nothing.
	# Matches in plugin-owned technical options (telemetry, migration history) are expected.
	echo "== Database (dry-run)"
	for term in "MB effect" "mbeffect" "mbbma" "mb-bma"; do
		printf '%s: ' "$term"
		$WP search-replace "$term" "x" --dry-run --report-changed-only --precise 2>/dev/null | tail -n 1
	done
fi

[ "$status" -eq 0 ] && echo "No matches in the theme."
exit "$status"
