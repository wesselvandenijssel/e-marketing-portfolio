document.querySelectorAll<HTMLElement>(".github-activity__scroll").forEach((scroller) => {
	scroller.scrollLeft = scroller.scrollWidth;
});
