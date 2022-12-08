/*
 * Key Assigner Functions.
 */
window.addEventListener("load", function() {
    // Get a reference to all the buttons with the 'keyAssigner' data-role
    const keyAssigners = document.querySelectorAll("[data-role='keyAssigner']");
    const keyAssignersInputs = document.querySelectorAll("[data-role='keyAssignerInput']");
    let returnKey = "Error";
    if (keyAssigners) {

        for (const keyAssigner of keyAssigners) {

            // Initialize button values on forms, if not properly set based on
            // the actual Inputs. Hopefully it works as intended.
            if (keyAssignersInputs) {
                for (const keyAssignerInput of keyAssignersInputs) {
                    if (keyAssignerInput.value) {
                        let keyAssignerInputId = keyAssignerInput.getAttribute("id");
                        let keyAssignerButton = document.querySelector(`[data-sets-input=${keyAssignerInputId}]`);
                        if (keyAssignerButton) {
                            keyAssignerButton.textContent = keyAssignerInput.value;
                            keyAssignerButton.setAttribute("data-key-selected", keyAssignerInput.value);
                        }
                    }
                }
            }
            // Add click events to all buttons in order to set-up keyup events.
            keyAssigner.addEventListener("click", () => {
                function abortByClick(event) {
                    // Abort only if the click is NOT triggered by clicking
                    // the actual keyAssigner.
                    if (event.target !== keyAssigner) {
                        event.stopPropagation();
                        console.log("aborted", event);
                        keyAssigner.classList.remove("active");
                        // Revert to default though :(
                        keyAssigner.textContent = keyAssigner.getAttribute("data-key-default");
                        // Cancel just one thing, not EVERYTHING.
                        window.removeEventListener("click", abortByClick);
                    }
                }
                keyAssigner.textContent = "όρισε πλήκτρο";
                keyAssigner.classList.add("active");
                // Cancel the whole thing by a single click of a button...
                window.addEventListener("click", abortByClick);
                // When a button is clicked, ask user to press a key
                window.addEventListener("keyup", event => {
                    // Override default browser's behavior for keys as e.g. Tab
                    // would cause the selection of the next input element.
                    event.preventDefault();
                    // If we still run an active click listener, abort it...
                    window.removeEventListener("click", abortByClick);
                    // When a key is pressed, get its key value.
                    // Note: Even if extremely useful, `event.which` and
                    // `event.keyCode` are deprecated. Instead we rely on
                    // `.key` and `.code`.
                    // @see https://www.toptal.com/developers/keycode/for/Space
                    if (event.key.length) {
                        const charCode = event.key.charCodeAt(0);
                        // Further reading:
                        // @see https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/charCodeAt
                        // @see https://stackoverflow.com/questions/67655744/get-key-value-of-key-pressed-with-javascriiipt/67656033#67656033
                        if(event.key.length > 1 && charCode < 128) {
                            // Named attribute (e.g. Enter)
                            // Note that some named keys should be excluded as
                            // they are used for controlling the browser (e.g.
                            // the Win key on Windows, the Cmd & Option keys on
                            // Mac, etc. etc. We might settle with a safe list.
                            // In case of error, we simply revert to the default
                            // key for each keyAssigner, passed via the
                            // data-key-default attribute.
                            // Forbidden list so far, contains buttons reserved
                            // for accessibility (Escape, Tab, ShiftLeft). Note
                            // that Space and Enter are also problematic...
                            const forbiddenList = ["Escape", "Tab", "ShiftLeft"];
                            if (forbiddenList.indexOf(event.code) !== -1) {
                                // Selected key is in the forbidden list!
                                // If we simply don't do anything in here,
                                // the key press will simply be ignored.
                                // If we return false, the key press will simply
                                // be ignored and we will keep on waiting for
                                // the next key press...
                                return false;
                            } else {
                                returnKey = event.code;
                            }
                        } else {
                            // Unicode character
                            if (charCode === 32) {
                                // Believe it or not, " " is indeed NOT a name
                                // attribute. And it's not a Spacebar, but
                                // simply "Space". Regardless, we convert this
                                // to a named character to make back-end's life
                                // easier.
                                returnKey = "Space";
                            } else {
                                returnKey = event.key;
                            }
                        }
                        // console.log('key: "', event.key, '" code: ', event.code, ' charcode: ', charCode);
                    }
                    if (returnKey === "Error") {
                        returnKey = keyAssigner.getAttribute("data-key-default");
                    }
                    // Sets and returns button's input to form.
                    keyAssigner.textContent = returnKey;
                    keyAssigner.setAttribute("data-key-selected", returnKey);
                    setInputId = keyAssigner.getAttribute("data-sets-input");
                    setInput = document.getElementById(setInputId);
                    setInput.value = returnKey;
                    keyAssigner.classList.remove('active');
                });
            });
        }
    }
});
