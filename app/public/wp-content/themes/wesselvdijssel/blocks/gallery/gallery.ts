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

const PAUSED_KEY = "wesselvandenijssel-loops-paused";
const toggles = document.querySelectorAll<HTMLButtonElement>(".gallery__motion-toggle");
const tiles: Array<{ wrapper: HTMLElement; player: WistiaPlayer | null; inView: boolean }> = [];

/**
 * Reads whether the visitor paused the loop videos on an earlier page
 *
 * @returns True when the videos should stay paused
 */
function readPaused(): boolean {
	try {
		return localStorage.getItem(PAUSED_KEY) === "1";
	} catch {
		return false;
	}
}

/**
 * Remembers the paused state for the next page, when storage is available
 *
 * @param value - Whether the loop videos are paused
 */
function savePaused(value: boolean): void {
	try {
		localStorage.setItem(PAUSED_KEY, value ? "1" : "0");
	} catch {
		return;
	}
}

let paused = readPaused();

/**
 * Starts the loop video of a tile, creating the player the first time
 *
 * @param tile - The gallery tile and its player
 */
function startTile(tile: { wrapper: HTMLElement; player: WistiaPlayer | null }): void {
	if (tile.player) {
		tile.player.play();
		return;
	}

	loadPlayerScript()
		.then(() => {
			if (!tile.player) tile.player = createPlayer(tile.wrapper);
		})
		.catch(() => undefined);
}

/**
 * Updates the toggle buttons to match the paused state
 */
function renderToggles(): void {
	toggles.forEach((toggle) => {
		toggle.textContent = paused ? "Video's afspelen" : "Video's pauzeren";
		toggle.classList.toggle("gallery__motion-toggle--paused", paused);
	});
}

/**
 * Pauses or resumes every loop video and remembers the choice for the next page
 */
function togglePaused(): void {
	paused = !paused;
	savePaused(paused);

	tiles.forEach((tile) => {
		if (paused) tile.player?.pause();
		else if (tile.inView) startTile(tile);
	});

	renderToggles();
}

if (loops.length && !reducedMotion) {
	toggles.forEach((toggle) => {
		toggle.hidden = false;
		toggle.addEventListener("click", togglePaused);
	});
	renderToggles();

	loops.forEach((wrapper) => {
		const tile = { wrapper, player: null as WistiaPlayer | null, inView: false };
		tiles.push(tile);

		new IntersectionObserver(
			(entries) =>
				entries.forEach((entry) => {
					tile.inView = entry.isIntersecting;

					if (!entry.isIntersecting) tile.player?.pause();
					else if (!paused) startTile(tile);
				}),
			{ rootMargin: "200px 0px" },
		).observe(wrapper);
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
