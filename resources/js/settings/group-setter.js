/*
 * Group Setters Functions.
 */

import { trans } from '@/lib/lang.js';

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
                const enableBtns = enableEl.getElementsByTagName('button');
                if (enableBtns) {
                    for (const enableBtn of enableBtns) {
                        enableBtn.disabled = false;
                        const keySelected = enableBtn.dataset.keySelected;
                        enableBtn.textContent = keySelected ? keySelected : enableBtn.dataset.keyDefault;
                    }
                }
                const disableEl = document.getElementById(disables);
                disableEl.classList.remove('opacity-100');
                disableEl.classList.add('opacity-50');
                const disableBtns = disableEl.getElementsByTagName('button');
                if (disableBtns) {
                    for (const disableBtn of disableBtns) {
                        disableBtn.disabled = true;
                        disableBtn.textContent = trans('messages.switcher.set_button');
                    }
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
