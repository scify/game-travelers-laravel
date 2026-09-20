/**
 * Avatar Selection Functions.
 * Requirements:
 * - Avatar <buttons> with the data-avatar=true and other data-attributes.
 * - A hidden input element with id=#selectedAvatarId.
 * - A submit button with the id=#submitButton.
 */

import { log } from '@/lib/debug.js';

window.addEventListener('load', function () {
    let btnId;
    // Should only run on pages with avatarsContainer & for related buttons.
    const avatarsContainer = document.getElementById('avatarsContainer');
    // Let the fun begin!

    if (avatarsContainer) {
        const buttons = avatarsContainer.querySelectorAll("button[data-avatar='true']");

        if (buttons) {
            // Variables for reading/validating/processing various form elements.
            const idInput = document.getElementById('avatarsContainerInput');
            const nameInput = document.getElementById('playerNameInput');
            const initialFormIdValue = idInput ? Number.parseInt(idInput.value) : 0;

            function updateUserMenuButton(idValue) {
                const userMenuButtonImage = document.getElementById('userMenuButtonImage');
                const userMenuButtonLabel = document.getElementById('userMenuButtonLabel');
                log('Updating User Menu Button');
                // Update User Menu if needed:
                if (userMenuButtonImage && !Number.isNaN(idValue)) {
                    if (idValue > 0) {
                        log(idValue);
                        const selectedButton = avatarsContainer.querySelector(`img[data-player-id='${idValue}']`);
                        userMenuButtonImage.setAttribute('alt', 'Ενημερωμένο');
                        userMenuButtonImage.setAttribute('src', selectedButton.getAttribute('src'));
                        userMenuButtonLabel.textContent = selectedButton.dataset.playerName;
                    }
                }
            }

            /**
             * Form validation function.
             *
             * Allows submission of a form only if a valid avatar is selected.
             * Reads selected id value from a hidden #avatarsContainerInput input.
             * If an #playerNameInput input is on the same page, then it's value is
             * also take under consideration for validation.
             */

            function updateSubmitButtonState() {
                const submitButton = document.getElementById('submitButton');
                const secondaryButton = document.getElementById('secondaryButton');
                const idValue = idInput ? Number.parseInt(idInput.value) : 0;

                // Nothing to update if (primary) Submit Button does not exist.
                if (!submitButton) {
                    return false;
                }
                // If nameInput, then we are on the create new profile page.
                if (nameInput) {
                    const nameValue = nameInput.value;
                    submitButton.disabled = !(nameValue.length >= 2 && !Number.isNaN(idValue) && idValue > 0);
                    // If !nameInput, then we are updating/selectin player.
                } else if (!Number.isNaN(idValue) && idValue > 0) {
                    updateUserMenuButton(idValue);
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

            /**
             * Clears the rejection the server rendered on the name field.
             *
             * The message, the styling and the invalid state all describe a
             * name that is no longer in the box, so they go together on the
             * first edit and the next submit decides again.
             */
            function clearNameError() {
                const nameGroup = document.getElementById('nameGroup');
                const nameError = document.getElementById('alert');
                nameGroup?.classList.remove('is-invalid');
                nameInput.removeAttribute('aria-invalid');
                nameInput.removeAttribute('aria-describedby');
                if (nameError) {
                    nameError.hidden = true;
                }
            }

            /**
             * Avatar handler function.
             */

            function handleAvatarState(btn) {
                let id;
                // Get the button's role:
                const role = btn.dataset.role;
                if (role && role === 'player') {
                    id = btn.dataset.playerId;
                } else {
                    id = btn.dataset.avatarId;
                }
                // Get the selected avatar id and update the linked input field:
                idInput.value = id;
                // Add the faded class to all avatars:
                for (const b of buttons) {
                    b.classList.remove('selected');
                    b.classList.add('faded');
                    b.setAttribute('aria-checked', 'false');
                }
                // Add the selected class to the clicked avatar:
                btn.classList.remove('faded');
                btn.classList.add('selected');
                btn.setAttribute('aria-checked', 'true');
                updateSubmitButtonState();
            }

            // Form initialization:
            // Reset playerAvatarInput to either the filled or default state (0) &
            // set the proper classes to the initialized avatar buttons.
            if (initialFormIdValue === 0) {
                updateSubmitButtonState();
                // Animate on (initial) load!
                // animateAvatarButtons(buttons);
            } else {
                for (const btn of buttons) {
                    const btnRole = btn.dataset.role;
                    if (btnRole === 'player') {
                        btnId = btn.dataset.playerId;
                    } else {
                        btnId = btn.dataset.avatarId;
                    }
                    if (Number.parseInt(btnId) === initialFormIdValue) {
                        btn.classList.remove('faded');
                        btn.classList.add('selected');
                        btn.setAttribute('aria-checked', 'true');
                    } else {
                        btn.classList.add('faded');
                        btn.classList.remove('selected');
                        btn.setAttribute('aria-checked', 'false');
                    }
                }
                updateSubmitButtonState();
            }

            // Add event listeners:
            // Add an event listener to playerName input to trigger form validation.
            if (nameInput) {
                nameInput.addEventListener('input', function () {
                    updateSubmitButtonState();
                    clearNameError();
                });
            }
            // Add event listeners to the avatar buttons.
            for (const btn of buttons) {
                btn.addEventListener('click', () => handleAvatarState(btn));
            }
        }
    }
});
