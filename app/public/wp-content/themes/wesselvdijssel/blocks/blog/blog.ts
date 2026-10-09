import Swiper from "swiper";
import { A11y, FreeMode, Mousewheel, Scrollbar } from "swiper/modules";
import "swiper/css";
import "swiper/css/autoplay";

document.addEventListener("DOMContentLoaded", () => {
	const selects = document.querySelectorAll(
		".blog__filter-select",
	) as NodeListOf<HTMLSelectElement>;

	selects.forEach((select) => {
		select.addEventListener("change", () => {
			const form = select.closest("form");
			if (form) {
				form.submit();
			}
		});
	});
});

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
