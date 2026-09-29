const openPopup = (popupName: string) => {
	if (!popupName) return;

	const popups = document.querySelectorAll<HTMLElement>(
		`.popup[data-popup*='${popupName}']`
	);
	popups.forEach((el) => el.classList.add("popup--active"));

	document
		.querySelectorAll<HTMLElement>(`.popup-background`)
		.forEach((el) => el.classList.add("popup-background--active"));

	document.querySelector("body")?.classList.add("no-scroll");

	setTimeout(() => {
		document
			.querySelector<HTMLElement>(".popup-background")
			?.classList.add("popup-background--show");
	}, 10);
	setTimeout(() => {
		popups.forEach((el) => el.classList.add("popup--show"));

		const activePopup = document.querySelector<HTMLElement>(
			`.popup[data-popup*='${popupName}'].popup--active`
		);
		if (activePopup) {
			const firstFocusable = activePopup.querySelector<HTMLElement>(
				'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
			);
			if (firstFocusable) {
				firstFocusable.focus();
			} else {
				const closeButton =
					activePopup.querySelector<HTMLElement>(".popup__close");
				closeButton?.focus();
			}
		}
	}, 100);
};

const closePopup = () => {
	document
		.querySelectorAll<HTMLElement>(".popup")
		.forEach((el) => el.classList.remove("popup--active", "popup--show"));

	document
		.querySelectorAll<HTMLElement>(".popup-background")
		.forEach((el) =>
			el.classList.remove(
				"popup-background--active",
				"popup-background--show"
			)
		);

	document.querySelector("body")?.classList.remove("no-scroll");
};

const showPopupButtons = document.querySelectorAll<HTMLElement>(".show-popup");

showPopupButtons.forEach((showPopupButton) => {
	showPopupButton.addEventListener("click", () =>
		openPopup(showPopupButton.dataset.popup ?? "")
	);

	showPopupButton.addEventListener("keydown", (e) => {
		if (e.key === "Enter" || e.key === " ") {
			e.preventDefault();
			openPopup(showPopupButton.dataset.popup ?? "");
		}
	});
});

const closePopupButtons = document.querySelectorAll<HTMLElement>(
	".popup__close, .popup-background"
);

closePopupButtons.forEach((closePopupButton) => {
	closePopupButton.addEventListener("click", () => closePopup());

	if (closePopupButton.classList.contains("popup__close")) {
		closePopupButton.addEventListener("keydown", (e) => {
			if (e.key === "Enter" || e.key === " ") {
				e.preventDefault();
				closePopup();
			}
		});
	}
});

document.addEventListener("keydown", (e) => {
	if (e.key === "Escape") {
		const activePopup = document.querySelector(".popup--active");
		if (activePopup) {
			closePopup();
		}
	}
});
