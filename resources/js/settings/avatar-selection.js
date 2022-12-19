/**
  * Avatar Selection Functions.
  * Requirements:
  * - Avatar <buttons> with the data-avatar=true and other data-attributes.
  * - A hidden input element with id=#selectedAvatarId.
  * - A submit button with the id=#submitButton.
  */
window.addEventListener("load", function() {
    // Should only run on pages with avatarsContainer & for related buttons.
    const avatarsContainer = document.getElementById("avatarsContainer");
    // Let the fun begin!

    if (avatarsContainer.length) {
        const buttons = avatarsContainer.querySelectorAll(`button[data-avatar="true"]`);

        if (buttons.length) {
            // Variables for reading/validating/processing various form elements.
            const idInput = document.getElementById("avatarsContainerInput");
            const nameInput = document.getElementById("playerNameInput");
            const initialFormIdValue = idInput ? parseInt(idInput.value) : 0;
            /**
             * Form validation function.
             *
             * Allows submission of a form only if a valid avatar is selected.
             * Reads selected id value from a hidden #avatarsContainerInput input.
             * If an #playerNameInput input is on the same page, then it's value is
             * also take under consideration for validation.
             */
            function updateSubmitButtonState() {
                const submitButton = document.getElementById("submitButton");
                const secondaryButton = document.getElementById("secondaryButton");
                var idValue = idInput ? parseInt(idInput.value) : 0;
                // Nothing to update if (primary) Submit Button does not exist.
                if (!submitButton) {
                    return false;
                }
                // If nameInput, then we are on the create new profile page.
                if (nameInput) {
                    const nameValue = nameInput.value;
                    if (
                        nameValue.length >= 2 && !isNaN(idValue) && idValue > 0) {
                        submitButton.disabled = false;
                    } else {
                        submitButton.disabled = true;
                    }
                // If !nameInput, then we are just updating an existing profile.
                } else {
                    if (!isNaN(idValue) && idValue > 0) {
                        submitButton.disabled = false;
                        if (secondaryButton) {
                            secondaryButton.disabled = false;
                        }
                    } else {
                        submitButton.disabled = true;
                        if (secondaryButton) {
                            secondaryButton.disabled = true;
                        }
                    }
                }
            }
            /**
             * Avatar handler function.
             */
            function handleAvatarState(btn) {
                // Get the button's role:
                const role = btn.getAttribute("data-role");
                if (role && role === "player") {
                    var id = btn.getAttribute("data-player-id");
                } else {
                    var id = btn.getAttribute("data-avatar-id");
                }
                // Get the selected avatar id and update the linked input field:
                idInput.value = id;
                // Add the faded class to all avatars:
                for (const b of buttons) {
                    b.classList.remove("selected");
                    b.classList.add("faded");
                    b.setAttribute("aria-checked", "false");
                }
                // Add the selected class to the clicked avatar:
                btn.classList.remove("faded");
                btn.classList.add("selected");
                btn.setAttribute("aria-checked", "true");
                updateSubmitButtonState();
            };

            function animateAvatarButtons(buttons) {
                const reducedMotionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
                if (reducedMotionQuery.media !== 'not all' && !reducedMotionQuery.matches) {
                    for (let i = 0; i < buttons.length; i++) {
                        let anBtn = buttons[i];
                        const anDelay = 300+i * 50;
                        setTimeout(() => {
                            anBtn.style.transform = "scale(1)";
                            anBtn.style.transition = "0.2s linear";
                            requestAnimationFrame(() => {
                                anBtn.style.transform = "scale(1.2)";
                            });
                            setTimeout(() => {
                                anBtn.style.transform = 'scale(1)';
                            }, anDelay);
                        }, anDelay);
                    }
                }
            };

            // Form initialization:
            // Reset playerAvatarInput to either the filled or default state (0) &
            // set the proper classes to the initialized avatar buttons.
            if (initialFormIdValue === 0) {
                updateSubmitButtonState();
                // Animate on (initial) load!
                // animateAvatarButtons(buttons);
            } else {
                for (const btn of buttons) {
                    var btnRole = btn.getAttribute("data-role");
                    if (btnRole === "player") {
                        var btnId = btn.getAttribute("data-player-id");
                    } else {
                        var btnId = btn.getAttribute("data-avatar-id");
                    }
                    if (parseInt(btnId) === initialFormIdValue) {
                        btn.classList.remove("faded");
                        btn.classList.add("selected");
                        btn.setAttribute("aria-checked", "true");
                    } else {
                        btn.classList.add("faded");
                        btn.classList.remove("selected");
                        btn.setAttribute("aria-checked", "false");
                    }
                }
                updateSubmitButtonState();
            }

            // Add event listeners:
            // Add an event listener to playerName input to trigger form validation.
            if (nameInput) {
                nameInput.addEventListener("input", updateSubmitButtonState);
            }
            // Add event listeners to the avatar buttons.
            for (const btn of buttons) {
                btn.addEventListener("click", () => handleAvatarState(btn));
            }
        }
    }
});
