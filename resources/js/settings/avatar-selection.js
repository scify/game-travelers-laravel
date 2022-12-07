window.addEventListener("load", function() {
    // Functions for New Profile form, Step 1.
    const thisPage = document.getElementById("profileNewStep1");
    if (thisPage) {
        const buttons = document.querySelectorAll("button[data-avatar='true']");
        const playerNameInput = document.getElementById("playerName");
        const playerAvatarInput = document.getElementById("playerAvatarId");
        const submitButton = document.getElementById("submitButton");

        function updateSubmitButtonState() {
            const playerName = playerNameInput.value;
            const playerAvatarId = parseInt(playerAvatarInput.value);
            if (playerName.length >= 2 && !isNaN(playerAvatarId) && playerAvatarId > 0) {
                submitButton.disabled = false;
            } else {
                submitButton.disabled = true;
            }
        }

        if (buttons.length) {
            // Reset playerAvatarInput to either the filled or default state (0)
            filledAvatarId = parseInt(playerAvatarInput.value);
            if (filledAvatarId === 0) {
                updateSubmitButtonState();
            } else {
                console.log(playerAvatarInput.value);
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
    }
});
