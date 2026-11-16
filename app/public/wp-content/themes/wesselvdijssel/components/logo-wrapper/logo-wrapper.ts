import Swiper from "swiper";
import { Autoplay } from "swiper/modules";
import "swiper/css";
import "swiper/css/autoplay";

const reducedMotion = window.matchMedia(
	"(prefers-reduced-motion: reduce)",
).matches;

document
	.querySelectorAll<HTMLElement>('.logo-wrapper[data-swiper="default"]')
	.forEach((logoWrapper) => {
		const swiper = new Swiper(logoWrapper, {
			modules: [Autoplay],

			slidesPerView: 2,

			loop: true,

			speed: reducedMotion ? 400 : 5000,

			autoplay: reducedMotion
				? false
				: {
						delay: 0,
						pauseOnMouseEnter: true,
					},

			spaceBetween: 40,

			breakpoints: {
				739: {
					slidesPerView: 3,
				},
				980: {
					slidesPerView: 1,
				},
			},
		});

		if (reducedMotion) return;

		logoWrapper.addEventListener("focusin", () => swiper.autoplay.stop());
		logoWrapper.addEventListener("focusout", () => swiper.autoplay.start());
	});
