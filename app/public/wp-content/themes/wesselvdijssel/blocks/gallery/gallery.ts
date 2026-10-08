type WistiaPlayer = HTMLElement & {
	play: () => void;
	pause: () => void;
};

const loops = document.querySelectorAll<HTMLElement>("[data-wistia-loop]");
const reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

let playerScript: Promise<void> | null = null;

/**
 * Loads the Wistia player script once, the first time a loop video comes into view
 *
 * @returns Promise that resolves when the script has loaded
 */
function loadPlayerScript(): Promise<void> {
	if (!playerScript) {
		playerScript = new Promise((resolve, reject) => {
			const script = document.createElement("script");
			script.src = "https://fast.wistia.com/player.js";
			script.async = true;
			script.addEventListener("load", () => resolve());
			script.addEventListener("error", () => reject());
			document.head.appendChild(script);
		});
	}

	return playerScript;
}

/**
 * Creates a muted, looping Wistia player without controls inside the gallery tile
 *
 * @param wrapper - The gallery tile with the data-wistia-loop attribute
 * @returns The created player element
 */
function createPlayer(wrapper: HTMLElement): WistiaPlayer {
	const player = document.createElement("wistia-player") as WistiaPlayer;
	const attributes: Record<string, string> = {
		"media-id": wrapper.dataset.wistiaLoop ?? "",
		autoplay: "",
		muted: "",
		"silent-autoplay": "allow",
		"fit-strategy": "cover",
		"controls-visible-on-load": "false",
		"big-play-button": "false",
		playbar: "false",
		"play-bar-control": "false",
		"volume-control": "false",
		"fullscreen-control": "false",
		"settings-control": "false",
		"play-pause-control": "false",
	};

	Object.entries(attributes).forEach(([name, value]) => player.setAttribute(name, value));
	player.classList.add("gallery__loop-player");
	player.setAttribute("aria-hidden", "true");
	player.inert = true;

	player.addEventListener("play", () => wrapper.classList.add("gallery__link--playing"));
	wrapper.prepend(player);

	return player;
}

if (loops.length && !reducedMotion) {
	loops.forEach((wrapper) => {
		let player: WistiaPlayer | null = null;

		const observer = new IntersectionObserver(
			(entries) =>
				entries.forEach((entry) => {
					if (!entry.isIntersecting) {
						player?.pause();
						return;
					}

					if (player) {
						player.play();
						return;
					}

					loadPlayerScript()
						.then(() => {
							player = createPlayer(wrapper);
						})
						.catch(() => observer.disconnect());
				}),
			{ rootMargin: "200px 0px" },
		);

		observer.observe(wrapper);
	});
}

if (loops.length) {
	const lightboxObserver = new MutationObserver(() =>
		document.querySelectorAll<HTMLIFrameElement>('.f-iframe[src*="wistia"]').forEach((iframe) => {
			const box = iframe.parentElement;
			const trigger = Array.from(loops).find((loop) => loop.dataset.src === iframe.getAttribute("src"));

			if (box && trigger?.dataset.ratio && !box.style.getPropertyValue("--video-ratio")) {
				box.style.setProperty("--video-ratio", trigger.dataset.ratio);
			}
		}),
	);

	lightboxObserver.observe(document.body, { childList: true, subtree: true });
}
