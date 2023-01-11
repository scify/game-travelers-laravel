/**
 * Switcher Controller aka Διακόπτης 0.1.0
 *
 */

// Settings Initialisation.

// Control mode.
let controlMode = 2; // Automatic (default: [1]) or Manual [2].

// Automatic scanning speed.
// Sensible defaults are used if values haven't been set via the Blade template:
let scanningSpeed = 2; // Default automatic scanning switch in seconds [2].

// Assigned keys.
// Reminder: event.keyCode and event.which are deprecated, therefore we are
// relying on the much (less) accurate event.key and event.code, which both
// have benefits and drawbacks (@see /resources/js/settings/key-assigner.js).
//
// Note: These definitions (Επιλογή / Πλοήγηση) make me dizzy:
// Επιλογή or selectionButton selects something aka executes something aka it
// is the "GOTO" button and makes much more sense to me if it defaults to Enter.
// For codes @see https://www.toptal.com/developers/keycode/for/enter
let selectionButton = "Enter"; // Default key for "Selection" (Επιλογή) [Enter].
// Πλοήγηση or navigationButton moves something, does not select and does not
// execute. It is something like a CURSOR key. It makes much more sense to
// make it use Space. You can test those buttons in action if you want to.
// For codes @see https://www.toptal.com/developers/keycode/for/Space
let navigationButton = "Space"; // Default key for "Navigation" (Πλοήγηση) [Space].

// Override default values with the ones from the Blade template:
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

	// iterate through elements and check tabindex values
	for (let i = 0; i < switcherElements.length; i++) {
		const element = switcherElements[i];
		const tabindex = element.getAttribute("data-tabindex");
		if (!isNaN(tabindex) && parseInt(tabindex) === +tabindex) {
			validSwitcherElements.push(element);
		}
	}

	// sort elements by tabindex value
	validSwitcherElements.sort((a, b) => {
		return (
			a.getAttribute("data-tabindex") - b.getAttribute("data-tabindex")
		);
	});

	// remove switcher classes from all elements (just in case):
	for (let i = 0; i < validSwitcherElements.length; i++) {
		validSwitcherElements[i].classList.remove(classFocus);
		validSwitcherElements[i].classList.remove(classActive);
	}

	let intervalId;
	if (validSwitcherElements.length > 0) {
		if (controlMode === 1) {
			let currentFocusIndex = -1;
			// Automatic mode (default).
			// Selection Button (default: Enter) clicks a highlighted option.
			intervalId = setInterval(() => {
				// remove events and classes from the previous element
				if (currentFocusIndex >= 0) {
					validSwitcherElements[
						currentFocusIndex
					].removeEventListener("keydown", handleSwitchKey);
					validSwitcherElements[currentFocusIndex].blur();
					validSwitcherElements[currentFocusIndex].classList.remove(
						classFocus
					);
				}

				// move to next element
				currentFocusIndex =
					(currentFocusIndex + 1) % validSwitcherElements.length;

				// focus on next element and add the class
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
		// @todo: Tab should be handled a little bit different, but for now...
		const escapeList = ["Escape", "Tab"];
		// @todo: Add more buttons to the Forbidden list?
		const forbiddenList = ["Escape", "Tab", "ShiftLeft"];
		let helpText, helpButtons;
		// Note that even if extremely useful, event.keyCode is deprecated.
		// Instead we parse the event.key (@see key-assigner.js).
		if (event.key.length) {
			const charCode = event.key.charCodeAt(0);
			if (event.key.length > 1 && charCode < 128) {
				// Named attribute (e.g. Enter)
				if (escapeList.indexOf(event.code) !== -1) {
					event.preventDefault();
					var newDiv = document.createElement("div");
					newDiv.setAttribute("id", "escapeModal");
					newDiv.setAttribute("tabindex", "-1");
					newDiv.setAttribute("class", "modal fade");
					newDiv.setAttribute("data-bs-backdrop", "static");
					newDiv.setAttribute("data-bs-keyboard", "false");
					newDiv.setAttribute("data-bs-focus", "false");
					if (controlMode === 1) {
						helpText = `<p>Για προσωρινή διακοπή της αυτόματης σάρωσης επιλέξτε «Διακοπή». Αν επιλέξετε «Συνέχεια» η αυτόματη σάρωση θα συνεχιστεί.</p><p>Υπενθυμίζεται ότι η επιλογή της υποδεδειγμένης ενέργειας πραγματοποιείται με το πάτημα του πλήκτρου <strong>${selectionButton}</strong>.</p>`;
						helpButtons = `<button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="clearInterval(${intervalId});return false">Διακοπή</button><button type="button" class="btn btn-primary" data-bs-dismiss="modal">Συνέχεια</button>`;
					} else {
						helpText = `<p>Η μετάβαση στην επόμενη διαθέσιμη επιλογή γίνεται με το πλήκτρο <strong>${navigationButton}</strong>.</p> <p>Η επικύρωση της υποδεδειγμένης επιλογής γίνεται με το πλήκτρο <strong>${selectionButton}</strong>.</p>`;
						helpButtons =
							"<button type='button' class='btn btn-primary' data-bs-dismiss='modal'>Συνέχεια</button>";
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
				if (forbiddenList.indexOf(event.code) !== -1) {
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