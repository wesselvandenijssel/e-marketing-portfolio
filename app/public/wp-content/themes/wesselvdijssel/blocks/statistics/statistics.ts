
const COUNT_DURATION = 1500;

const formatDutch = (value: number, decimals: number): string => {
	const [integerPart, decimalPart] = Math.abs(value).toFixed(decimals).split(".");
	const sign = value < 0 ? "-" : "";
	const grouped = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

	return decimalPart ? `${sign}${grouped},${decimalPart}` : `${sign}${grouped}`;
};

const animateCount = (element: HTMLElement): void => {
	const finalText = element.dataset.finalText ?? element.textContent ?? "";
	const target = parseFloat(element.dataset.target ?? "");
	const start = parseFloat(element.dataset.start ?? "");
	const decimals = parseInt(element.dataset.decimals ?? "0", 10) || 0;
	const isRange = !Number.isNaN(start);

	if (Number.isNaN(target)) return;

	let startTime: number | null = null;

	const step = (timestamp: number): void => {
		if (startTime === null) startTime = timestamp;

		const progress = Math.min((timestamp - startTime) / COUNT_DURATION, 1);
		const eased = 1 - Math.pow(1 - progress, 3);

		if (progress < 1) {
			const end = formatDutch(target * eased, decimals);
			element.textContent = isRange ? `${formatDutch(start * eased, decimals)}-${end}` : end;
			window.requestAnimationFrame(step);
		} else {
			element.textContent = finalText;
		}
	};

	window.requestAnimationFrame(step);
};

const initStatistics = (): void => {
	const counts = document.querySelectorAll<HTMLElement>(".statistics .statistic__count[data-target]");

	if (!counts.length) return;
	if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;
	if (!("IntersectionObserver" in window)) return;

	const observer = new window.IntersectionObserver(
		(entries, observerInstance) => {
			entries.forEach((entry) => {
				if (!entry.isIntersecting) return;

				const element = entry.target as HTMLElement;
				observerInstance.unobserve(element);
				animateCount(element);
			});
		},
		{ threshold: 0.1 },
	);

	counts.forEach((element) => {
		element.dataset.finalText = element.textContent ?? "";
		const decimals = parseInt(element.dataset.decimals ?? "0", 10) || 0;
		const zero = formatDutch(0, decimals);
		element.textContent = element.dataset.start !== undefined ? `${zero}-${zero}` : zero;

		observer.observe(element);
	});
};

initStatistics();
