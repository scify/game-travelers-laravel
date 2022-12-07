window.addEventListener("load", function() {
    // Get a reference to all the buttons with the 'keyAssigner' data-role
    const keyAssigners = document.querySelectorAll('[data-role="keyAssigner"]');
    if (keyAssigners.length) {
        for (const keyAssigner of keyAssigners) {
            keyAssigner.addEventListener("click", () => {
                keyAssigner.textContent = 'όρισε πλήκτρο';
                keyAssigner.classList.add('active');
                // When a button is clicked, ask the user to press a key on their keyboard
                window.addEventListener('keydown', event => {
                    // When a key is pressed, get its key value
                    const key = event.key;
                    const code = event.code;
                    console.log(key);
                    console.log(code);
                    // Set the button text to the key value
                    keyAssigner.textContent = code;
                    keyAssigner.classList.remove('active');
                });
            });
        }
    }
});
