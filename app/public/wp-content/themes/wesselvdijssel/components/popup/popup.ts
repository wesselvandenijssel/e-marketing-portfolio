/**
 * Opens the popup as a modal <dialog>; the browser traps focus, closes it on Escape and returns focus to the trigger
 *
 * @param popupName	The data-popup attribute associated with the popup
 */
const openPopup = (popupName: string) => {
	if (!popupName) return;

	const popup = document.querySelector<HTMLDialogElement>(
		`dialog.popup[data-popup="${CSS.escape(popupName)}"]`,
	);

	if (!popup || popup.open) return;

	popup.showModal();
	document.body.classList.add("no-scroll");
};

/**
 * Closes the given popup
 *
 * @param popup The popup dialog element
 */
const closePopup = (popup: HTMLDialogElement) => {
	if (popup.open) popup.close();
};

document.querySelectorAll<HTMLElement>(".show-popup").forEach((showPopupButton) =>
	showPopupButton.addEventListener("click", () =>
		openPopup(showPopupButton.dataset.popup ?? ""),
	),
);

document.querySelectorAll<HTMLDialogElement>("dialog.popup").forEach((popup) => {
	popup
		.querySelector(".popup__close")
		?.addEventListener("click", () => closePopup(popup));

	// A click on the dialog element itself (not its content) is a click on the backdrop
	popup.addEventListener("click", (e) => {
		if (e.target === popup) closePopup(popup);
	});

	// Fires for every way of closing, including the native Escape handling
	popup.addEventListener("close", () => {
		if (!document.querySelector("dialog.popup[open]"))
			document.body.classList.remove("no-scroll");
	});
});
