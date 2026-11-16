import Swiper from "swiper";
import { Autoplay } from "swiper/modules";
import "swiper/css";
import "swiper/css/autoplay";

const reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

document
	.querySelectorAll<HTMLElement>(".header__top-wrapper .swiper")
	.forEach((element) => {
		const swiper = new Swiper(element, {
			modules: [Autoplay],
			slidesPerView: 1,
			loop: true,
			speed: 400,
			spaceBetween: 0,
			autoplay: reducedMotion
				? false
				: {
					delay: 5000,
					pauseOnMouseEnter: true,
				},
			breakpoints: {
				740: {
					slidesPerView: 2,
				},
				980: {
					slidesPerView: "auto",
					spaceBetween: 25,
				},
			},
		});

		if (reducedMotion) return;

		element.addEventListener("focusin", () => swiper.autoplay.stop());
		element.addEventListener("focusout", () => swiper.autoplay.start());
	});
