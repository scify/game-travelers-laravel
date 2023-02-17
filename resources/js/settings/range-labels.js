/*
 * Range Labels Functions.
 */
window.addEventListener("load", function () {
	const rangeElements = document.querySelectorAll("input[type='range']");

	function handleVolumeSlider(rangeElement, audioConfirmation = true) {
		// Get input[type='range'] parameters directly from the element.
		const rangeMin = parseFloat(rangeElement.min);
		const rangeMax = parseFloat(rangeElement.max);
		const rangeStep = parseFloat(rangeElement.step);
		let rangeValue = rangeElement.value;
		const preventMinValue =
			rangeElement.dataset.preventMinValue === "true" || false;
		// Disallow minimum value if data-prevent-min-value=true:
		if (preventMinValue && rangeValue == rangeMin) {
			rangeValue = rangeMin + rangeStep;
			rangeElement.value = rangeValue;
		}
		// Play a sound via window.sound to the set volume:
		if (audioConfirmation) {
			if (typeof window.sound === "function" && window.sound !== null) {
				window.sound("fx.select", null, true, rangeValue);
			}
		}
		// Calculate the visual representation of the set volume.
		const rangePercent =
			((rangeValue - rangeMin) / (rangeMax - rangeMin)) * 100;
		// If min is not 0, then calcs are off hopefully by a step.
		if (rangeMin > 0) {
			rangeValue = rangeValue - rangeStep;
		}
		// Acquire the div which is used as the input's progress bar:
		const rangeElementId = rangeElement.getAttribute("id");
		const rangeProgressId = rangeElementId + "Progress";
		const progressElement = document.getElementById(rangeProgressId);
		// Set the width aka progress of the progress bar:
		const sliderProgress = rangePercent + "%";
		// Calculate the opacity of the bar based on the desired range:
		const opacityRangeMin = 0.1;
		const opacityRangeMax = 0.8;
		const opacityRange = opacityRangeMax - opacityRangeMin;
		const sliderOpacity =
			(rangePercent / 100) * opacityRange + opacityRangeMin;
		// Calculate the volume gauge height based on the desire range:
		const triangleHeightMin = 0.75;
		const triangleHeightMax = 4;
		const triangleHeightRange = triangleHeightMax - triangleHeightMin;
		const sliderHeight =
			(rangePercent / 100) * triangleHeightRange + triangleHeightMin;
		// Set CSS variables:
		progressElement.style.setProperty("--sliderProgress", sliderProgress);
		progressElement.style.setProperty("--sliderOpacity", sliderOpacity);
		progressElement.style.setProperty(
			"--sliderHeight",
			sliderHeight + "em"
		);
	}

	if (rangeElements.length) {
		for (let i = 0; i < rangeElements.length; i++) {
			const element = rangeElements[i];
			const elementId = element.getAttribute("id");
			const elementFunction = element.getAttribute("data-function");
			if (elementFunction === "volume-slider") {
				handleVolumeSlider(element, false);
				element.addEventListener("change", () => {
					handleVolumeSlider(element);
				});
			}
			// Scanning speed range inputs.
			if (elementId === "scanningSpeed") {
				const label = document.querySelector(`[for="${elementId}"]`);
				if (parseInt(element.value) === 1) {
					label.textContent = `${window.trans("messages.every")} ${
						element.value
					} ${window.trans("messages.second")}`;
				} else {
					label.textContent = `${window.trans("messages.every")} ${
						element.value
					} ${window.trans("messages.seconds")}`;
				}
				element.addEventListener("change", () => {
					if (parseInt(element.value) === 1) {
						label.textContent = `${window.trans(
							"messages.every"
						)} ${element.value} ${window.trans("messages.second")}`;
					} else {
						label.textContent = `${window.trans(
							"messages.every"
						)} ${element.value} ${window.trans(
							"messages.seconds"
						)}`;
					}
					const ruler = document.querySelector(
						`div[data-role="ruler"][data-value="${element.value}"]`
					);
					if (ruler) {
						ruler.classList.add("selected");
						// Remove the "selected" class after 2 seconds
						setTimeout(function () {
							ruler.classList.remove("selected");
						}, 2000);
					}
				});
			}
		}
	}
});
