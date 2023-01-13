/**
 * Switcher Controller aka Διακόπτης 0.1.0
 * @see ../../views/layout/footer-scripts.blade.php
 * @see ../lang.js
 */

console.log(window.SwitcherKeys);

// Settings Initialisation.
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
	// Set defaults if window.Switcher has nothing interesting.
	controlMode = 1;
	scanningSpeed = 2;
	automaticSelectionButton = "Space";
	manualSelectionButton = "Space";
	manualNavigationButton = "Enter";
}

// Assigned keys.
// Reminder: event.keyCode and event.which are deprecated, therefore we are
// relying on the much (less) accurate event.key and event.code, which both
// have benefits and drawbacks (@see /resources/js/settings/key-assigner.js).
//
// Επιλογή or selectionButton selects something aka executes something aka it
// is the "GOTO" button. It defaults to [Enter].
// For codes @see https://www.toptal.com/developers/keycode/for/enter
let selectionButton =
	controlMode === 1 ? automaticSelectionButton : manualSelectionButton;
// Πλοήγηση or navigationButton moves something, does not select and does not
// execute. It is something like a CURSOR key. It defaults to [Space].
// For codes @see https://www.toptal.com/developers/keycode/for/Space
let navigationButton = manualNavigationButton;

// Override default values with the ones from the Blade template, if available:
if (typeof window.Switcher !== "undefined") {
	controlMode = parseInt(window.Switcher.controlMode);
	if (isNaN(controlMode) || (controlMode !== 1 && controlMode !== 2)) {
		controlMode = 1;
	}
	scanningSpeed = parseInt(window.Switcher.scanningSpeed);
	if (isNaN(scanningSpeed) || scanningSpeed < 1 || scanningSpeed > 8) {
		scanningSpeed = 2;
	}
}
if (typeof window.controlMode !== "undefined") {
	controlMode = parseInt(window.controlMode);
	if (isNaN(controlMode)) {
		controlMode = 1;
	}
}
if (typeof window.scanningSpeed !== "undefined") {
	scanningSpeed = parseInt(window.scanningSpeed);
	if (isNaN(scanningSpeed)) {
		scanningSpeed = 2;
	}
}
// @todo: handle the keys - so far it works with the default ones.

// Configuration
// Add delay for CSS transitions on top of the defined scanningSpeed. This value
// for now is hardcoded, as all the CSS transitions are set to 300ms.
const transitionSpeed = 300; // in milisecconds
const classFocus = "switcher-focus"; // Focus switcher CSS class
const classActive = "switcher-active"; // Active switcher CSS class

window.addEventListener("load", function () {
	const switcherElements = document.querySelectorAll("[data-tabindex]");
	const validSwitcherElements = [];

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
		if (controlMode === 1) {
			// Automatic mode (default).
			this.document.body.classList.add("switcher");
			let currentFocusIndex = -1;
			// Selection Button (default: Enter) clicks a highlighted option.
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
			// Navigation Button (default: Space) moves to next option.
			// Selection Button (default: Enter) clicks a highlighted option.
			// Note: Keydown for immediate reponse, instead of the keyup used
			// on key-assigner.js.
			window.addEventListener("keydown", handleSwitchKey);
		}
	}

	function handleSwitchKey(event) {
		let whichkey;
		let helpText, helpButtons;
		// Note that even if extremely useful, event.keyCode is deprecated.
		// Instead we parse the event.key (@see key-assigner.js).
		if (event.key.length) {
			const charCode = event.key.charCodeAt(0);
			if (event.key.length > 1 && charCode < 128) {
				// Named attribute (e.g. Enter)
				if (window.SwitcherKeys.escapeList.indexOf(event.code) !== -1) {
					event.preventDefault();
					var newDiv = document.createElement("div");
					newDiv.setAttribute("id", "escapeModal");
					newDiv.setAttribute("tabindex", "-1");
					newDiv.setAttribute("class", "modal fade");
					newDiv.setAttribute("data-bs-backdrop", "static");
					newDiv.setAttribute("data-bs-keyboard", "false");
					newDiv.setAttribute("data-bs-focus", "false");
					if (controlMode === 1) {
						// Automatic help
						helpText = `
<p>
${window.trans("messages.switcher.help_automatic")}
</p>
<p>
${window.trans("messages.switcher.help_automatic_button_select")}
<strong>${selectionButton}</strong>.
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
<strong>${navigationButton}</strong>.
</p>
<p>
${window.trans("messages.switcher.help_manual_button_select")}
<strong>${selectionButton}</strong>.
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

					var escapeModal = document.getElementById("escapeModal");
					var bsEscapeModal =
						// eslint-disable-next-line no-undef
						bootstrap.Modal.getOrCreateInstance(escapeModal);
					bsEscapeModal.show();
					escapeModal.addEventListener(
						"hidden.bs.modal",
						function () {
							removeSwitcherClasses();
							bsEscapeModal.dispose();
						}
					);
					return false;
				}
				if (
					window.SwitcherKeys.forbiddenList.indexOf(event.code) !== -1
				) {
					return false;
				}
				whichkey = event.code;
			} else {
				if (charCode === 32) {
					whichkey = "Space";
				} else {
					whichkey = event.key;
				}
			}
		}
		if (controlMode === 1) {
			// Automatic mode.
			if (whichkey === selectionButton) {
				event.preventDefault();
				clearInterval(intervalId); // stop the interval
				this.click();
				this.classList.remove(classFocus);
				this.classList.add(classActive);
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
					console.log(
						`Current: ${currentFocusIndex}, Next: ${nextFocusIndex} out of ${validSwitcherElements.length}`
					);
					break;
				}
			}
			// Part 1. Navigate to the next element.
			if (whichkey === navigationButton) {
				validSwitcherElements[currentFocusIndex].classList.remove(
					classFocus
				);
				validSwitcherElements[currentFocusIndex].blur();
				validSwitcherElements[nextFocusIndex].focus();
				validSwitcherElements[nextFocusIndex].classList.add(classFocus);
			}
			// Part 2. Select the current element.
			if (whichkey === selectionButton) {
				event.preventDefault();
				// Find the currently highlighted button and click it.
				validSwitcherElements[currentFocusIndex].classList.remove(
					classFocus
				);
				validSwitcherElements[currentFocusIndex].classList.add(
					classActive
				);
				validSwitcherElements[currentFocusIndex].click();
				window.removeEventListener("keydown", handleSwitchKey);
			}
		}
	}
});
