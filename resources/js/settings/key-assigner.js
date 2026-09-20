/* Key Assigner Functions
 * Handles the input for buttons which allow each player via their own personal
 * settings, to set custom keys for Navigation and Selection for the Switcher.
 * These functions require and use the array SwitcherKeys.allowedList from keys.js,
 * which includes a list of all the keys which are relatively safe to use.
 */

import { log } from '@/lib/debug.js';
import { SwitcherKeys, storedKey } from '@/lib/keys.js';
import { trans } from '@/lib/lang.js';

(function () {
    'use strict';

    window.addEventListener('load', function () {
        const keyAssigners = document.querySelectorAll("button[data-role='keyAssigner']");
        const keyAssignersInputs = document.querySelectorAll("input[data-role='keyAssignerInput']");
        let returnKey = 'Error';
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
            if (!keyAssignersInputs) {
                return;
            }
            for (const resetInput of keyAssignersInputs) {
                if (resetInput.value) {
                    const resetInputId = resetInput.getAttribute('id');
                    const keyAssignerButton = document.querySelector(`[data-sets-input=${resetInputId}]`);
                    if (keyAssignerButton) {
                        keyAssignerButton.classList.remove('invalid');
                        keyAssignerButton.dataset.keySelected = resetInput.value;
                        // An active assigner keeps its text during a partial reset.
                        if (resetActive || !keyAssignerButton.classList.contains('active')) {
                            keyAssignerButton.textContent = resetInput.value;
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
                keyAssignerText === trans('messages.switcher.set_button_invalid') ||
                keyAssignerText === trans('messages.switcher.set_button')
            ) {
                keyAssignerText = keyAssigner.dataset.keySelected;
            }
            keyAssigner.textContent = trans('messages.switcher.set_button_invalid');
            if (!keyAssigner.classList.contains('invalid')) {
                keyAssigner.classList.add('invalid');
                timeoutId = setTimeout(() => {
                    keyAssigner.classList.remove('invalid');
                    keyAssigner.textContent = keyAssignerText;
                }, 1200);
            } else {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => {
                    keyAssigner.classList.remove('invalid');
                    keyAssigner.textContent = keyAssignerText;
                }, 1200);
            }
        }

        if (keyAssigners.length) {
            for (const keyAssigner of keyAssigners) {
                resetKeyAssigners();
                // Add click events to all buttons in order to set-up keyup events.
                keyAssigner.addEventListener('click', () => {
                    /** Removes active assignerKeyUpHandler events. */
                    function assignerClickHandler(event) {
                        // Should not abort if the click is on the actual trigger.
                        if (event.target !== keyAssigner) {
                            // console.log("event logged");
                            event.stopPropagation();
                            // console.log("aborted");
                            keyAssigner.classList.remove('active');
                            keyAssigner.textContent = keyAssigner.dataset.keyDefault;
                            // Revert to default though :(
                            resetKeyAssigners(true);
                            window.removeEventListener('keyup', assignerKeyUpHandler);
                            window.removeEventListener('click', assignerClickHandler);
                        }
                    }

                    /** KeyUp event listener for Key Assigner. */
                    function assignerKeyUpHandler(event) {
                        const allowedList = SwitcherKeys.allowedList;
                        // Override the default behavior of keys.
                        event.preventDefault();
                        // When a key is pressed, store it in the form the
                        // switcher and the board read it back (@see keys.js).
                        const pressedKey = storedKey(event);
                        if (pressedKey !== null) {
                            if (allowedList.includes(pressedKey)) {
                                log(`Key accepted: ${pressedKey}`);
                                returnKey = pressedKey;
                            } else {
                                keyAssigner.classList.add('invalid');
                                log(`Not accepted key ${pressedKey}.`);
                                invalidateKeyAssigner(keyAssigner);
                                return false;
                            }
                        }
                        if (returnKey.includes('Enter')) {
                            if (keyAssigner.classList.contains('first-trigger')) {
                                keyAssigner.classList.remove('first-trigger');
                                return false;
                            }
                        }
                        if (returnKey === 'Error') {
                            log('Error!');
                            returnKey = keyAssigner.dataset.keySelected;
                        }
                        const setInputId = keyAssigner.dataset.setsInput;
                        const setInput = document.getElementById(setInputId);
                        // If this assigner's data-sets-input value is either
                        // controlManualSelectionButton or controlManualNavigationButton
                        // we make sure that they are not set to the same Key.
                        let otherAssigner = false;
                        switch (setInputId) {
                            case 'controlManualSelectionButton':
                                otherAssigner = document.querySelector(
                                    "button[data-sets-input='controlManualNavigationButton']",
                                );
                                break;
                            case 'controlManualNavigationButton':
                                otherAssigner = document.querySelector(
                                    "button[data-sets-input='controlManualSelectionButton']",
                                );
                                break;
                        }
                        if (otherAssigner) {
                            if (returnKey === otherAssigner.dataset.keySelected) {
                                if (returnKey !== 'Space' && returnKey !== 'Enter') {
                                    invalidateKeyAssigner(keyAssigner);
                                    invalidateKeyAssigner(otherAssigner);
                                    return false;
                                }
                                // The same key has been assigned to both Key
                                // Assigners. We don't allow this unless the key
                                // in question is either Space or Enter in which
                                // case the other assigner reverts to the
                                // unassigned key.
                                log('Switching Other Key Assigner.');
                                otherAssigner.dataset.keySelected = returnKey === 'Space' ? 'Enter' : 'Space';
                                otherAssigner.textContent = returnKey === 'Space' ? 'Enter' : 'Space';
                                const setOtherInputId = otherAssigner.dataset.setsInput;
                                const setOtherInput = document.getElementById(setOtherInputId);
                                setOtherInput.value = returnKey === 'Space' ? 'Enter' : 'Space';
                            }
                        }

                        // Removing click event listeners.
                        window.removeEventListener('click', assignerClickHandler);

                        keyAssigner.textContent = returnKey;
                        keyAssigner.dataset.keySelected = returnKey;
                        setInput.value = returnKey;
                        keyAssigner.classList.remove('active');
                        // Removes self.
                        window.removeEventListener('keyup', assignerKeyUpHandler);
                    }
                    // Set keyAssigner to active
                    keyAssigner.textContent = trans('messages.switcher.set_button');
                    keyAssigner.classList.add('active', 'first-trigger');
                    // Cancel the whole thing by a single click of the mouse:
                    window.addEventListener('click', assignerClickHandler);
                    // When a button is clicked, ask user to press a key:
                    window.addEventListener('keyup', assignerKeyUpHandler);
                });
            }
        }
    });
})();
