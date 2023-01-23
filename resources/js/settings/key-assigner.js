/* Key Assigner Functions
 * Handles the input for buttons which allow each player via their own personal
 * settings, to set custom keys for Navigation and Selection for the Switcher.
 * These functions require and use the array window.SwitcherKeys.allowedList,
 * which includes a list of all the keys which are relatively safe to use.
 */
(function () {
	"use strict";

	window.addEventListener("load", function () {
		const keyAssigners = document.querySelectorAll(
			"button[data-role='keyAssigner']"
		);
		const keyAssignersInputs = document.querySelectorAll(
			"input[data-role='keyAssignerInput']"
		);
		let returnKey = "Error";
		let timeoutId;

		/** Resets the Key Assigners on the webpage.
		 * Iterates through the actual form inputs and sets the values of the
		 * corresponding Key Assigners.
		 *
		 * @param {boolean} [resetActive=true]
		 * Defaults to true in order to also reset active Key Assigners. If set
		 * to false, Active Key Assigners are partially resetted (their text
		 * value remains unalatered).
		 */
		function resetKeyAssigners(resetActive = true) {
			if (!keyAssignersInputs) return;
			for (const resetInput of keyAssignersInputs) {
				if (resetInput.value) {
					let resetInputId = resetInput.getAttribute("id");
					let keyAssignerButton = document.querySelector(
						`[data-sets-input=${resetInputId}]`
					);
					if (keyAssignerButton) {
						keyAssignerButton.classList.remove("invalid");
						keyAssignerButton.setAttribute(
							"data-key-selected",
							resetInput.value
						);
						if (resetActive) {
							keyAssignerButton.textContent = resetInput.value;
						} else {
							if (
								!keyAssignerButton.classList.contains("active")
							) {
								keyAssignerButton.textContent =
									resetInput.value;
							}
						}
					}
				}
			}
		}

		/** Adds a visual alert (warning) to a Key Assigner if the key selected
		 * by the user is invalid. */
		function invalidateKeyAssigner(keyAssigner) {
			let keyAssignerText;
			keyAssignerText = keyAssigner.textContent;
			if (
				keyAssignerText ===
					window.trans("messages.switcher.set_button_invalid") ||
				keyAssignerText === window.trans("messages.switcher.set_button")
			) {
				keyAssignerText = keyAssigner.getAttribute("data-key-selected");
			}
			keyAssigner.textContent = window.trans(
				"messages.switcher.set_button_invalid"
			);
			if (!keyAssigner.classList.contains("invalid")) {
				keyAssigner.classList.add("invalid");
				timeoutId = setTimeout(() => {
					keyAssigner.classList.remove("invalid");
					keyAssigner.textContent = keyAssignerText;
				}, 1200);
			} else {
				clearTimeout(timeoutId);
				timeoutId = setTimeout(() => {
					keyAssigner.classList.remove("invalid");
					keyAssigner.textContent = keyAssignerText;
				}, 1200);
			}
		}

		if (keyAssigners.length) {
			for (const keyAssigner of keyAssigners) {
				resetKeyAssigners();
				// Add click events to all buttons in order to set-up keyup events.
				keyAssigner.addEventListener("click", () => {
					/** Removes active assignerKeyUpHandler events. */
					function assignerClickHandler(event) {
						// Should not abort if the click is on the actual trigger.
						if (event.target !== keyAssigner) {
							// console.log("event logged");
							event.stopPropagation();
							// console.log("aborted");
							keyAssigner.classList.remove("active");
							keyAssigner.textContent =
								keyAssigner.getAttribute("data-key-default");
							// Revert to default though :(
							resetKeyAssigners(true);
							window.removeEventListener(
								"keyup",
								assignerKeyUpHandler
							);
							window.removeEventListener(
								"click",
								assignerClickHandler
							);
						}
					}

					/** KeyUp event listener for Key Assigner. */
					function assignerKeyUpHandler(event) {
						const allowedList = window.SwitcherKeys.allowedList;
						// Override the default behavior of keys.
						event.preventDefault();
						// When a key is pressed, get its key value.
						// Note: Even if extremely useful, `event.which` and
						// `event.keyCode` are deprecated. Instead we rely on
						// `.key` and `.code`.
						// @see https://www.toptal.com/developers/keycode/for/Space
						if (event.key.length) {
							const charCode = event.key.charCodeAt(0);
							if (event.key.length > 1 && charCode < 128) {
								// Key is "named" (e.g. LeftAlt):
								if (allowedList.indexOf(event.code) !== -1) {
									returnKey = event.code;
									console.log("Key Code accepted.");
								} else {
									keyAssigner.classList.add("invalid");
									console.log("Not accepted key code.");
									invalidateKeyAssigner(keyAssigner);
									return false;
								}
							} else {
								// Key is equal to a unicode character:
								if (charCode === 32) {
									// Space is one of the unicode characters
									// which is read as " ". To make our life
									// easier, we simply convert it to "Space".
									console.log("Space accepted");
									returnKey = "Space";
								} else {
									if (allowedList.indexOf(event.key) !== -1) {
										console.log("Key accepted");
										returnKey = event.key;
									} else {
										keyAssigner.classList.add("invalid");
										console.log(
											`Not accepted key ${event.key}.`
										);
										invalidateKeyAssigner(keyAssigner);
										return false;
									}
								}
							}
						}
						if (returnKey.indexOf("Enter") !== -1) {
							if (
								keyAssigner.classList.contains("first-trigger")
							) {
								keyAssigner.classList.remove("first-trigger");
								return false;
							}
						}
						if (returnKey === "Error") {
							console.log("Error!");
							returnKey =
								keyAssigner.getAttribute("data-key-selected");
						}
						let setInputId =
							keyAssigner.getAttribute("data-sets-input");
						let setInput = document.getElementById(setInputId);
						// If this assigner's data-sets-input value is either
						// controlManualSelectionButton or controlManualNavigationButton
						// we make sure that they are not set to the same Key.
						let otherAssigner = false;
						switch (setInputId) {
							case "controlManualSelectionButton":
								otherAssigner = document.querySelector(
									"button[data-sets-input='controlManualNavigationButton']"
								);
								break;
							case "controlManualNavigationButton":
								otherAssigner = document.querySelector(
									"button[data-sets-input='controlManualSelectionButton']"
								);
								break;
						}
						if (otherAssigner) {
							if (
								returnKey ===
								otherAssigner.getAttribute("data-key-selected")
							) {
								if (
									returnKey !== "Space" &&
									returnKey !== "Enter"
								) {
									invalidateKeyAssigner(keyAssigner);
									invalidateKeyAssigner(otherAssigner);
									return false;
								}
								// The same key has been assigned to both Key
								// Assigners. We don't allow this unless the key
								// in question is either Space or Enter in which
								// case the other assigner reverts to the
								// unassigned key.
								console.log("Switching Other Key Assigner.");
								otherAssigner.setAttribute(
									"data-key-selected",
									returnKey === "Space" ? "Enter" : "Space"
								);
								otherAssigner.textContent =
									returnKey === "Space" ? "Enter" : "Space";
								let setOtherInputId =
									otherAssigner.getAttribute(
										"data-sets-input"
									);
								let setOtherInput =
									document.getElementById(setOtherInputId);
								setOtherInput.value =
									returnKey === "Space" ? "Enter" : "Space";
							}
						}

						// Removing click event listeners.
						window.removeEventListener(
							"click",
							assignerClickHandler
						);

						keyAssigner.textContent = returnKey;
						keyAssigner.setAttribute(
							"data-key-selected",
							returnKey
						);
						setInput.value = returnKey;
						keyAssigner.classList.remove("active");
						// Removes self.
						window.removeEventListener(
							"keyup",
							assignerKeyUpHandler
						);
					}
					// Set keyAssigner to active
					keyAssigner.textContent = window.trans(
						"messages.switcher.set_button"
					);
					keyAssigner.classList.add("active");
					keyAssigner.classList.add("first-trigger");
					// Cancel the whole thing by a single click of the mouse:
					window.addEventListener("click", assignerClickHandler);
					// When a button is clicked, ask user to press a key:
					window.addEventListener("keyup", assignerKeyUpHandler);
				});
			}
		}
	});
})();
