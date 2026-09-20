/*
 * Group Setters Functions.
 */

window.addEventListener('load', function () {
    // First, select all the input fields with the data-role="groupSetter" attribute
    const groupSetters = document.querySelectorAll("input[data-role='groupSetter']");
    if (groupSetters.length) {
        // Function

        function setGroupSetterStates(groupSetter) {
            const enables = groupSetter.dataset.enables;
            const disables = groupSetter.dataset.disables;
            if (groupSetter.checked) {
                const enableEl = document.getElementById(enables);
                enableEl.classList.remove('opacity-50');
                enableEl.classList.add('opacity-100');
                for (const enableBtn of enableEl.getElementsByTagName('button')) {
                    enableBtn.disabled = false;
                    enableBtn.textContent = enableBtn.dataset.keySelected || enableBtn.dataset.keyDefault;
                }
                const disableEl = document.getElementById(disables);
                disableEl.classList.remove('opacity-100');
                disableEl.classList.add('opacity-50');
                // The buttons keep showing their key; only the state changes.
                for (const disableBtn of disableEl.getElementsByTagName('button')) {
                    disableBtn.disabled = true;
                }
            }
        }

        for (const groupSetter of groupSetters) {
            setGroupSetterStates(groupSetter);
            // Add listener
            groupSetter.addEventListener('change', function () {
                setGroupSetterStates(groupSetter);
            });
        }
    }
});
