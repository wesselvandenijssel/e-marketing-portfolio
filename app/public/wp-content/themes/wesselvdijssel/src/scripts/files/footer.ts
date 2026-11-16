const footerToggles = document.querySelectorAll<HTMLButtonElement>(
	".footer__menu-fold-button",
);

footerToggles.forEach((footerToggle) =>
	footerToggle.addEventListener("click", () => {
		const footerFolded =
			footerToggle.previousElementSibling?.querySelector<HTMLElement>(
				".folded",
			);

		footerToggle.style.visibility = "hidden";
		footerToggle.setAttribute("aria-expanded", "true");

		if (!footerFolded) return;

		footerFolded.slideDown(400);

		// The button is hidden, so move focus to the first revealed link instead of losing it
		footerFolded.querySelector<HTMLElement>("a, button")?.focus();
	}),
);
