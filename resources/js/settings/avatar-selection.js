/**
  * Avatar Selection Functions.
  * Requirements:
  * - Avatar <buttons> with the data-avatar=true and other data-attributes.
  * - A hidden input element with id=#selectedAvatarId.
  * - A submit button with the id=#submitButton.
  */
window.addEventListener("load", function() {
    // Should only run on pages with buttons with data-avatar=true attribute.
    const buttons = document.querySelectorAll("button[data-avatar='true']");
    // Variables for reading/validating/processing various form elements.
    const formAvatarIdInput = document.getElementById("selectedAvatarId");
    const formPlayerNameInput = document.getElementById("playerName");
    // Checking values...
    const formAvatarId = formAvatarIdInput ? parseInt(formAvatarIdInput.value) : 0;
    // Let the fun begin!
    if (buttons.length) {
        /**
         * Form validation function.
         *
         * Allows submission of aform only if a valid avatar is selected.
         * Reads selected avatarId from a hidden #selectedAvatarId input.
         * If an #playerName input is on the same page, then it's value is also
         * take under consideration for validation.
         */
        function updateSubmitButtonState() {
            const nameInput = document.getElementById("playerName");
            const avatarIdInput = document.getElementById("selectedAvatarId");
            const submitButton = document.getElementById("submitButton");
            const avatarId = parseInt(avatarIdInput.value);
            if (nameInput) {
                const nameValue = nameInput.value;
                if (nameValue.length >= 2 && !isNaN(avatarId) && avatarId > 0) {
                    submitButton.disabled = false;
                } else {
                    submitButton.disabled = true;
                }
            } else {
                if (!isNaN(avatarId) && avatarId > 0) {
                    submitButton.disabled = false;
                } else {
                    submitButton.disabled = true;
                }
            }
        }
        /**
         * Avatar handler function.
         */
        function handleAvatarState(btn) {
            // Get the selected avatar id:
            const avatar = btn.getAttribute("data-avatar-id");
            const input = document.getElementById("selectedAvatarId");
            input.value = avatar;
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

        // Form initialization:
        // Reset playerAvatarInput to either the filled or default state (0) &
        // set the proper classes to the initialized avatar buttons.
        if (formAvatarId === 0) {
            updateSubmitButtonState();
        } else {
            for (const btn of buttons) {
                const avatarId = btn.getAttribute("data-avatar-id");
                if (parseInt(avatarId) === formAvatarId) {
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
        if (formPlayerNameInput) {
            formPlayerNameInput.addEventListener("input", updateSubmitButtonState);
        }
        // Add event listeners to the avatar buttons.
        for (const btn of buttons) {
            btn.addEventListener("click", () => handleAvatarState(btn));
        }
    }
});
