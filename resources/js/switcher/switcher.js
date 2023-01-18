/**
 * Switcher Controller aka Διακόπτης 0.1.0
 * @see ../../views/layout/footer-scripts.blade.php
 * @see ../lang.js
 */

// Blurs any items with focus.
window.onpageshow = function (e) {
	if (e.persisted) {
		const allElements = document.querySelectorAll("*");
		for (let i = 0; i < allElements.length; i++) {
			allElements[i].blur();
		}
		switcher();
	}
};

window.addEventListener("load", switcher);

function switcher() {
	// Settings Initialisation
	let controlMode,
		scanningSpeed,
		automaticSelectionButton,
		manualSelectionButton,
		manualNavigationButton;

	if (window.Switcher instanceof Object) {
		controlMode =
			!isNaN(parseInt(window.Switcher.controlMode)) &&
			(parseInt(window.Switcher.controlMode) === 1 ||
				parseInt(window.Switcher.controlMode) === 2)
				? parseInt(window.Switcher.controlMode)
				: 1;
		scanningSpeed =
			!isNaN(parseInt(window.Switcher.scanningSpeed)) &&
			parseInt(window.Switcher.scanningSpeed) >= 1 &&
			parseInt(window.Switcher.scanningSpeed) <= 10
				? parseInt(window.Switcher.scanningSpeed)
				: 2;
		automaticSelectionButton =
			window.Switcher.automaticSelectionButton !== undefined &&
			window.SwitcherKeys.allowedList.includes(
				window.Switcher.automaticSelectionButton
			)
				? window.Switcher.automaticSelectionButton
				: "Space";
		manualSelectionButton =
			window.Switcher.manualSelectionButton !== undefined &&
			window.SwitcherKeys.allowedList.includes(
				window.Switcher.manualSelectionButton
			)
				? window.Switcher.manualSelectionButton
				: "Space";
		manualNavigationButton =
			window.Switcher.manualNavigationButton !== undefined &&
			window.SwitcherKeys.allowedList.includes(
				window.Switcher.manualNavigationButton
			)
				? window.Switcher.manualNavigationButton
				: "Enter";
	} else {
		// Default parameters if window.Switcher has nothing.
		controlMode = 1;
		scanningSpeed = 2;
		automaticSelectionButton = "Space";
		manualSelectionButton = "Space";
		manualNavigationButton = "Enter";
	}
	let selectionButton =
		controlMode === 1 ? automaticSelectionButton : manualSelectionButton;
	let navigationButton = manualNavigationButton;

	// Configuration
	// Add delay for CSS transitions on top of the defined scanningSpeed. This
	// value for now is hardcoded, as all the CSS transitions are set to 300ms.
	const transitionSpeed = 300; // in milisecconds
	const classFocus = "switcher-focus"; // Focus switcher CSS class
	const classActive = "switcher-active"; // Active switcher CSS class
	const switcherElements = document.querySelectorAll(
		"[data-tabindex]:not([disabled])"
	);
	const validSwitcherElements = [];

	// Switcher enabled.
	console.log(
		`Switcher enabled (mode: ${controlMode}, s: ${selectionButton}, n: ${navigationButton})`
	);

	function removeSwitcherClasses() {
		var elements = document.getElementsByClassName(classFocus);
		for (var i = 0; i < elements.length; i++) {
			elements[i].classList.remove(classFocus);
		}
	}

	// If no switcher elements are found, then return (exit).
	if (switcherElements.length == 0) {
		console.log("No elements found with data-tabindex attribute");
		return;
	}

	// Iterate through elements and check data-tabindex values.
	for (let i = 0; i < switcherElements.length; i++) {
		const element = switcherElements[i];
		const tabindex = element.getAttribute("data-tabindex");
		if (!isNaN(tabindex) && parseInt(tabindex) === +tabindex) {
			validSwitcherElements.push(element);
		}
	}
	// Sort valid elements by data-tabindex value.
	validSwitcherElements.sort((a, b) => {
		return (
			a.getAttribute("data-tabindex") - b.getAttribute("data-tabindex")
		);
	});
	// Remove any left-over switcher classes from all elements:
	for (let i = 0; i < validSwitcherElements.length; i++) {
		validSwitcherElements[i].classList.remove(classFocus);
		validSwitcherElements[i].classList.remove(classActive);
	}

	let intervalId;
	if (validSwitcherElements.length > 0) {
		this.document.body.classList.add("switcher");
		if (controlMode === 1) {
			// Automatic mode (default).
			// Selection Button (default: Enter) clicks a highlighted option.
			// On start select the first element and add the listener:
			let currentFocusIndex = 0;
			validSwitcherElements[currentFocusIndex].focus();
			validSwitcherElements[currentFocusIndex].classList.add(classFocus);
			validSwitcherElements[currentFocusIndex].addEventListener(
				"keydown",
				handleSwitchKey
			);
			// On interval, move to next element remove/add listeners:
			intervalId = setInterval(() => {
				// Remove events and classes from the previous element.
				if (currentFocusIndex >= 0) {
					validSwitcherElements[
						currentFocusIndex
					].removeEventListener("keydown", handleSwitchKey);
					validSwitcherElements[currentFocusIndex].blur();
					validSwitcherElements[currentFocusIndex].classList.remove(
						classFocus
					);
				}
				// Move to the next element.
				currentFocusIndex =
					(currentFocusIndex + 1) % validSwitcherElements.length;
				// Focus on next element and add switcher class.
				validSwitcherElements[currentFocusIndex].addEventListener(
					"keydown",
					handleSwitchKey
				);
				validSwitcherElements[currentFocusIndex].focus();
				validSwitcherElements[currentFocusIndex].classList.add(
					classFocus
				);
			}, scanningSpeed * 1000 + transitionSpeed);
		} else {
			// Manual mode.
			// Select the first option by default.
			let currentFocusIndex = 0;
			validSwitcherElements[currentFocusIndex].focus();
			validSwitcherElements[currentFocusIndex].classList.add(classFocus);
			// Note: Keydown for immediate reponse, instead of the keyup used
			// on key-assigner.js.
			window.addEventListener("keydown", handleSwitchKey);
		}
	}

	function switcherModal() {
		let helpText, helpButtons;
		var escapeModal = document.getElementById("escapeModal");
		if (!escapeModal) {
			var newDiv = document.createElement("div");
			newDiv.setAttribute("id", "escapeModal");
			newDiv.setAttribute("tabindex", "-1");
			newDiv.setAttribute("class", "modal fade");
			if (controlMode === 1) {
				// Automatic help
				helpText = `
<p>
${window.trans("messages.switcher.help_automatic")}
</p>
<p>
${window.trans("messages.switcher.help_automatic_button_select")}
<kbd>${selectionButton}</kbd>.
</p>`;
				helpButtons = `
<button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="clearInterval(${intervalId});return false">
${window.trans("messages.switcher.break")}
</button>
<button type="button" class="btn btn-primary" data-bs-dismiss="modal">
${window.trans("messages.switcher.continue")}
</button>`;
			} else {
				helpText = `
<p>
${window.trans("messages.switcher.help_manual_button_navigate")}
<kbd>${navigationButton}</kbd>.
</p>
<p>
${window.trans("messages.switcher.help_manual_button_select")}
<kbd>${selectionButton}</kbd>.
</p>`;
				helpButtons = `
<button type='button' class='btn btn-primary' data-bs-dismiss='modal'>
${window.trans("messages.switcher.continue")}
</button>`;
			}

			newDiv.innerHTML = `
<div class="modal-dialog modal-dialog-centered"><div class="modal-content">
<div class="modal-body">
${helpText}
</div>
<div class="modal-footer">
${helpButtons}
</div>
</div></div>`;
			document.body.appendChild(newDiv);
			escapeModal = newDiv;
		}
		console.log("before");
		var bsEscapeModal =
			// eslint-disable-next-line no-undef
			bootstrap.Modal.getOrCreateInstance(escapeModal, {
				keyboard: false,
				focus: false,
				backdrop: "static",
			});
		bsEscapeModal.show();
		escapeModal.addEventListener("hidden.bs.modal", function () {
			removeSwitcherClasses();
		});
		return false;
	}

	function handleSwitchKey(event) {
		const allowedList = window.SwitcherKeys.allowedList;
		const escapeList = window.SwitcherKeys.escapeList;
		let returnKey;
		// Note that even if extremely useful, event.keyCode is deprecated.
		// Instead we parse the event.key (@see key-assigner.js).
		if (event.key.length) {
			const charCode = event.key.charCodeAt(0);
			if (event.key.length > 1 && charCode < 128) {
				// Key is "named" (e.g. LeftAlt):
				if (escapeList.indexOf(event.code) !== -1) {
					event.preventDefault();
					switcherModal();
					return false;
				}
				if (allowedList.indexOf(event.code) !== -1) {
					console.log("Key Code accepted.");
					returnKey = event.code;
				} else {
					console.log("Not accepted key code.");
					return false;
				}
			} else {
				if (allowedList.indexOf(event.key) !== -1) {
					if (charCode === 32) {
						console.log("Space accepted");
						returnKey = "Space";
					} else {
						console.log("Key accepted.");
						returnKey = event.key;
					}
				} else {
					console.log(`Not accepted key ${event.key}.`);
					return false;
				}
			}
		}
		if (controlMode === 1) {
			// Automatic mode.
			if (returnKey === selectionButton) {
				event.preventDefault();
				clearInterval(intervalId); // stop the interval
				this.classList.remove(classFocus);
				this.classList.add(classActive);
				this.click();
				return;
			}
		} else {
			// Manual mode.
			event.preventDefault();
			let currentFocusIndex = 0;
			let nextFocusIndex = 0;
			for (let i = 0; i < validSwitcherElements.length; i++) {
				if (validSwitcherElements[i].classList.contains(classFocus)) {
					currentFocusIndex = i;
					if (currentFocusIndex == validSwitcherElements.length - 1) {
						nextFocusIndex = 0;
					} else {
						nextFocusIndex = currentFocusIndex + 1;
					}
				}
			}
			// Part 1. Navigate to the next element.
			if (returnKey === navigationButton) {
				validSwitcherElements[currentFocusIndex].classList.remove(
					classFocus
				);
				validSwitcherElements[currentFocusIndex].blur();
				validSwitcherElements[nextFocusIndex].focus();
				validSwitcherElements[nextFocusIndex].classList.add(classFocus);
			}
			// Part 2. Select the current element.
			if (returnKey === selectionButton) {
				event.preventDefault();
				// Find the currently highlighted button and click it.
				validSwitcherElements[currentFocusIndex].classList.remove(
					classFocus
				);
				validSwitcherElements[currentFocusIndex].classList.add(
					classActive
				);
				window.removeEventListener("keydown", handleSwitchKey);
				validSwitcherElements[currentFocusIndex].click();
				return;
			}
		}
	}
}
