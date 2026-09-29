import Swiper from "swiper";
import { A11y, Keyboard, Navigation } from "swiper/modules";
import "swiper/css";
import "swiper/css/a11y";

const initQuoteSliders = (): void => {
	const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

	document.querySelectorAll<HTMLElement>(".quote-slider__slider.swiper").forEach((slider) => {
		const prevButton = slider.querySelector<HTMLButtonElement>(".quote-slider__button--prev");
		const nextButton = slider.querySelector<HTMLButtonElement>(".quote-slider__button--next");

		if (!prevButton || !nextButton) return;
		if (slider.querySelectorAll<HTMLElement>(".swiper-slide").length < 2) return;

		new Swiper(slider, {
			modules: [A11y, Keyboard, Navigation],
			slidesPerView: 1,
			spaceBetween: 20,
			rewind: true,
			speed: reduceMotion ? 0 : 400,
			navigation: {
				prevEl: prevButton,
				nextEl: nextButton,
				addIcons: false,
			},
			keyboard: {
				enabled: true,
				onlyInViewport: true,
			},
			a11y: {
				enabled: true,
				prevSlideMessage: prevButton.getAttribute("aria-label") ?? "",
				nextSlideMessage: nextButton.getAttribute("aria-label") ?? "",
				firstSlideMessage: slider.dataset.labelFirst ?? "",
				lastSlideMessage: slider.dataset.labelLast ?? "",
				slideLabelMessage: slider.dataset.labelSlide ?? "{{index}} / {{slidesLength}}",
			},
		});
	});
};

initQuoteSliders();
