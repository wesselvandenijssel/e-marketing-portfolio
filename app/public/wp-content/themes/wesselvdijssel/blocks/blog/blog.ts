import Swiper from "swiper";
import { A11y, FreeMode, Mousewheel, Scrollbar } from "swiper/modules";
import "swiper/css";
import "swiper/css/autoplay";

new Swiper(".blog__grid.swiper", {
	modules: [A11y, FreeMode, Mousewheel, Scrollbar],
	slidesPerView: "auto",
	spaceBetween: 10,
	freeMode: true,
	a11y: {
		slideRole: null,
		slideLabelMessage: null,
	},
	mousewheel: {
		forceToAxis: true,
	},
	scrollbar: {
		el: ".blog__swiper-scrollbar",
		draggable: true,
	},

	breakpoints: {
		740: {
			spaceBetween: 20,
		},

		980: {
			spaceBetween: 40,
		},
	},
});
