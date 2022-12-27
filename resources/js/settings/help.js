/*
 * Help & Tooltips Functions.
 */
window.addEventListener("load", function () {
	const tooltipTriggerList = [].slice.call(
		document.querySelectorAll("[data-bs-toggle=\"tooltip\"]")
	);
	tooltipTriggerList.map(function (tooltipTriggerEl) {
		// eslint-disable-next-line no-undef
		return new bootstrap.Tooltip(tooltipTriggerEl);
	});
});
