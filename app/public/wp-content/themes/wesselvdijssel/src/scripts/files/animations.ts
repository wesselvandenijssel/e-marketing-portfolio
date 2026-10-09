import { animate, inView, scroll } from "motion";

const prefersReducedMotion = window.matchMedia(
	"(prefers-reduced-motion: reduce)",
).matches;

const EASE: [number, number, number, number] = [0.22, 1, 0.36, 1];
const IN_VIEW_MARGIN = "999px 0px -10% 0px";
const LINE_STAGGER = 0.1;
const ITEM_STAGGER = 0.08;

const HEADING_SELECTORS = [
	".titles .main-title",
	".content-layout > h2",
	".content-layout > h3",
].join(", ");

const COPY_SELECTORS = [
	".titles .subtitle",
	".titles .suptitle",
	".content-layout > p",
	".content-layout > ul",
	".content-layout > ol",
	".content-layout > .buttons",
	".hero__content .buttons",
].join(", ");

const GROUPS: [string, string][] = [
	[".icon-boxes__grid", ".icon-boxes__box"],
	[".projects__grid", ".projects__item"],
	[".statistics__grid", ".statistic"],
	[".timeline__list", ".timeline__item"],
	[".gallery__grid", ".gallery__item"],
	[".logo-wrapper:not(.swiper)", ".logo-wrapper__item"],
	[".blog__grid--overview", ".post"],
	[".project-details", ".project-details__section"],
];

const SINGLES = [
	".hero__portrait",
	".content-image__image-wrapper",
	".contact__form",
	".project-details__facts",
	".quote-slider__slider",
	".blog__grid--swiper",
	".logo-wrapper.swiper",
].join(", ");

/**
 * Checks whether an element sits in page content, not in the header, footer or a popup
 *
 * @param element - The candidate element
 * @returns Whether the element may be animated
 */
function isAnimatable(element: Element): boolean {
	return !element.closest("header, footer, .popup");
}

/**
 * Wraps every word in a masked span so each line can slide up, keeping inline elements intact
 *
 * @param node - The node whose text gets wrapped
 * @returns void
 */
function wrapWords(node: Node): void {
	if (node.nodeType === Node.TEXT_NODE) {
		const text = node.textContent ?? "";

		if (!text.trim()) return;

		const fragment = document.createDocumentFragment();

		text.split(/(\s+)/).forEach((part) => {
			if (!part) return;

			if (/^\s+$/.test(part)) {
				fragment.append(part);
				return;
			}

			const word = document.createElement("span");
			word.classList.add("text-reveal__word");
			word.textContent = part;

			const mask = document.createElement("span");
			mask.classList.add("text-reveal__mask");
			mask.append(word);

			fragment.append(mask);
		});

		node.parentNode?.replaceChild(fragment, node);
	} else {
		Array.from(node.childNodes).forEach(wrapWords);
	}
}

/**
 * Groups the masked words per rendered line, measured at reveal time
 *
 * @param heading - The split heading
 * @returns The words per line
 */
function getLines(heading: HTMLElement): HTMLElement[][] {
	const lines: HTMLElement[][] = [];
	let lineTop: number | null = null;

	heading
		.querySelectorAll<HTMLElement>(".text-reveal__mask")
		.forEach((mask) => {
			const word = mask.firstElementChild;

			if (!(word instanceof HTMLElement)) return;

			const top = Math.round(mask.getBoundingClientRect().top);

			if (lineTop === null || Math.abs(top - lineTop) > 2) {
				lines.push([]);
				lineTop = top;
			}

			lines[lines.length - 1].push(word);
		});

	return lines;
}

/**
 * Slides the lines of a heading up out of their masks, one after another
 *
 * @param heading - The split heading
 * @returns void
 */
function revealHeading(heading: HTMLElement): void {
	getLines(heading).forEach((line, index) => {
		animate(
			line,
			{ y: ["120%", "0%"], opacity: [0, 1] },
			{ duration: 0.9, delay: index * LINE_STAGGER, ease: EASE },
		);
	});
}

/**
 * Fades an element up into view
 *
 * @param element - The element to reveal
 * @param delay - Delay in seconds
 * @returns void
 */
function fadeUp(element: Element, delay = 0): void {
	animate(
		element,
		{ y: ["1.5rem", "0rem"], opacity: [0, 1] },
		{ duration: 0.8, delay, ease: EASE },
	);
}

/**
 * Masked line reveal for headings and a fade-in for copy
 *
 * @returns void
 */
function initText(): void {
	document.querySelectorAll<HTMLElement>(HEADING_SELECTORS).forEach((heading) => {
		if (!isAnimatable(heading)) return;

		wrapWords(heading);

		if (!heading.querySelector(".text-reveal__mask")) return;

		heading.classList.add("text-reveal");
		inView(heading, () => revealHeading(heading), { margin: IN_VIEW_MARGIN });
	});

	document.querySelectorAll<HTMLElement>(COPY_SELECTORS).forEach((copy) => {
		if (!isAnimatable(copy) || copy.closest(".reveal-item")) return;

		copy.classList.add("reveal-fade");
		inView(copy, () => fadeUp(copy), { margin: IN_VIEW_MARGIN });
	});
}

/**
 * Staggered fade-up for cards and list items, per group as it enters the viewport
 *
 * @returns void
 */
function initGroups(): void {
	GROUPS.forEach(([groupSelector, itemSelector]) => {
		document.querySelectorAll<HTMLElement>(groupSelector).forEach((group) => {
			if (!isAnimatable(group)) return;

			const items = Array.from(group.querySelectorAll<HTMLElement>(itemSelector));

			if (!items.length) return;

			items.forEach((item) => item.classList.add("reveal-item"));

			items.forEach((item, index) => {
				inView(item, () => fadeUp(item, (index % 4) * ITEM_STAGGER), {
					margin: IN_VIEW_MARGIN,
				});
			});
		});
	});

	document.querySelectorAll<HTMLElement>(SINGLES).forEach((element) => {
		if (!isAnimatable(element) || element.classList.contains("reveal-item")) return;

		element.classList.add("reveal-item");
		inView(element, () => fadeUp(element), { margin: IN_VIEW_MARGIN });
	});
}

/**
 * Opens the CTA card from a slightly inset clip-path to full size while it scrolls into view
 *
 * @returns void
 */
function initCtaClip(): void {
	document.querySelectorAll<HTMLElement>(".cta-banner__card").forEach((card) => {
		const style = window.getComputedStyle(card);
		const radius = style.borderRadius;
		const maxInset = Math.max(0, parseFloat(style.paddingLeft) - 8);

		scroll(
			(progress: number) => {
				const inset = (maxInset * (1 - progress)).toFixed(1);
				card.style.clipPath = `inset(0px ${inset}px round ${radius})`;
			},
			{ target: card, offset: ["start end", "start 0.6"] },
		);
	});
}

/**
 * Moves the accent shape behind the hero portrait slightly slower than the page
 *
 * @returns void
 */
function initPortraitParallax(): void {
	document.querySelectorAll<HTMLElement>(".hero__portrait").forEach((portrait) => {
		const hero = portrait.closest<HTMLElement>(".hero") ?? portrait;

		scroll(
			(progress: number) => {
				portrait.style.setProperty("--portrait-shift", `${(progress * 40).toFixed(1)}px`);
			},
			{ target: hero, offset: ["start start", "end start"] },
		);
	});
}

if (!prefersReducedMotion) {
	initText();
	initGroups();
	initCtaClip();
	initPortraitParallax();
}
