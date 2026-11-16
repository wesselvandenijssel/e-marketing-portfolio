const triggers = document.querySelectorAll<HTMLButtonElement>(
	".fold-content-trigger",
);

triggers.forEach((trigger) =>
	trigger.addEventListener("click", () => {
		const content = trigger.previousElementSibling;

		trigger.setAttribute("aria-expanded", "true");
		trigger.style.visibility = "hidden";

		if (!(content instanceof HTMLElement)) return;

		content.classList.add("fold-content--active");

		// The trigger is hidden, so move focus to the revealed text instead of losing it
		content.tabIndex = -1;
		content.focus({ preventScroll: true });
	}),
);
