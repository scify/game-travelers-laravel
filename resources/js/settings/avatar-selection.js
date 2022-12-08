/*
 * Avatar Selection Functions.
 */
window.addEventListener("load", function() {
    // Should only run on pages with buttons with data-avatar=true attribute.
    const buttons = document.querySelectorAll("button[data-avatar='true']");
    // Variables for reading and parsing various form elements.
    const playerNameInput = document.getElementById("playerName");
    const playerAvatarIdInput = document.getElementById("selectedAvatarId");
    const submitButton = document.getElementById("submitButton");

    if (buttons.length) {
        /** Enables Submit Button on profileNewStep1 view. */
        function updateSubmitButtonState() {
            const nameInput = document.getElementById("playerName");
            const avatarIdInput = document.getElementById("selectedAvatarId");
            const avatarId = parseInt(avatarIdInput.value);
            const submit = document.getElementById("submit");
            if (nameInput) {
                const nameValue = nameInput.value;
                if (playerName.length >= 2 && !isNaN(playerAvatarId) && playerAvatarId > 0) {
                    submit.disabled = false;
                } else {
                    submit.disabled = true;
                }
            } else {
                if (!isNaN(avatarId) && avatarId > 0) {
                    submit.disabled = false;
                } else {
                    submit.disabled = true;
                }
            }
        }
        // Reset playerAvatarInput to either the filled or default state (0)
        filledAvatarId = parseInt(playerAvatarIdInput.value);
        if (filledAvatarId === 0) {
            updateSubmitButtonState();
        } else {
            for (const btn of buttons) {
                const avatarId = btn.getAttribute("data-avatar-id");
                if (parseInt(avatarId) === filledAvatarId) {
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
        // Add listeners to the buttons
        playerNameInput.addEventListener('input', updateSubmitButtonState);
        for (const btn of buttons) {
            btn.addEventListener("click", function() {
                // Get the selected avatar id:
                const avatarId = btn.getAttribute("data-avatar-id");
                const input = document.getElementById("playerAvatarId");
                input.value = avatarId;
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
            })
        }
    }
});
