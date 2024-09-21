/* script du composant slider */
window.addEventListener("load", () => {
	document.querySelectorAll(".slider").forEach((elem) => {
		const options = elem.getAttribute("data-options");
		sliderInit(elem, options);
	});
});

const sliderInit = (elem, options) => {
	const defaultWidth = 360;
	const defaultHeight = 240;

	const sizes = {
		width: elem.getAttribute("data-width")
			? elem.getAttribute("data-width")
			: defaultWidth,
		height: elem.getAttribute("data-height")
			? elem.getAttribute("data-height")
			: defaultHeight,
	};

	elem.style.height = sizes.height + "px";
	elem.style.width = sizes.width + "px";

	const viewport = document.createElement("div");
	viewport.classList.add("slider_viewport");
	elem.append(viewport);
	elem.querySelectorAll("img").forEach((img) => {
		const slide = document.createElement("div");
		slide.classList.add("slider_slide");
		slide.append(img);
		viewport.append(slide);
	});
	const nav = document.createElement("div");
	nav.classList.add("slider_nav");
	elem.append(nav);

	const prev = document.createElement("button");
	prev.classList.add("slider_nav_prev");
	prev.innerHTML = "";
	prev.addEventListener("click", () => {
		move(-1, elem);
	});
	nav.append(prev);

	const next = document.createElement("button");
	next.classList.add("slider_nav_next");
	next.innerHTML = "";
	next.addEventListener("click", () => {
		move(1, elem);
	});
	nav.append(next);
};

const move = (increment, slider) => {
	let current = Number(
		slider.getAttribute("data-current")
			? slider.getAttribute("data-current")
			: 0
	);
	current += increment;
	const slides = slider.querySelectorAll(".slider_slide");
	const total = slides.length;
	current = current % total;

	current = current >= 0 ? current : total + current;

	slider.setAttribute("data-current", current);
	const left = current * -100 + "%";
	const viewport = slider.querySelector(".slider_viewport");
	viewport.style.left = left;

	viewport.addEventListener("transitonend", transitionHandler);

	viewport.removeEventListener("transitonend", transitionHandler);
};

const transitionHandler = () => {};
