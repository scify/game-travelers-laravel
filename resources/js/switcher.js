/**
 * Switcher Controller aka Διακόπτης 0.1.0
 * @see ../../views/layout/footer-scripts.blade.php
 * @see ../lang.js
 */

import { Modal } from 'bootstrap';
import { music, sound } from '@/lib/audio.js';
import { log } from '@/lib/debug.js';
import { SwitcherKeys } from '@/lib/keys.js';
import { saveVolume } from '@/lib/volumes.js';

// Blurs any items with focus.
window.onpageshow = function (e) {
    if (e.persisted) {
        const allElements = document.querySelectorAll('*');
        for (let i = 0; i < allElements.length; i++) {
            allElements[i].blur();
        }
        switcher();
    }
};

window.addEventListener('load', switcher);

function switcher() {
    // Settings Initialisation
    let controlMode, scanningSpeed, automaticSelectionButton, manualSelectionButton, manualNavigationButton;

    if (window.Switcher instanceof Object) {
        controlMode = window.Switcher.controlMode === 2 ? 2 : 1;
        scanningSpeed =
            Number.isInteger(window.Switcher.scanningSpeed) &&
            window.Switcher.scanningSpeed >= 1 &&
            window.Switcher.scanningSpeed <= 10
                ? window.Switcher.scanningSpeed
                : 2;
        automaticSelectionButton =
            window.Switcher.automaticSelectionButton !== undefined &&
            SwitcherKeys.allowedList.includes(window.Switcher.automaticSelectionButton)
                ? window.Switcher.automaticSelectionButton
                : 'Space';
        manualSelectionButton =
            window.Switcher.manualSelectionButton !== undefined &&
            SwitcherKeys.allowedList.includes(window.Switcher.manualSelectionButton)
                ? window.Switcher.manualSelectionButton
                : 'Space';
        manualNavigationButton =
            window.Switcher.manualNavigationButton !== undefined &&
            SwitcherKeys.allowedList.includes(window.Switcher.manualNavigationButton)
                ? window.Switcher.manualNavigationButton
                : 'Enter';
    } else {
        // Default parameters if window.Switcher has nothing.
        controlMode = 1;
        scanningSpeed = 2;
        automaticSelectionButton = 'Enter';
        manualSelectionButton = 'Enter';
        manualNavigationButton = 'Space';
    }
    const selectionButton = controlMode === 1 ? automaticSelectionButton : manualSelectionButton;
    const navigationButton = manualNavigationButton;

    // Configuration
    // Add delay for CSS transitions on top of the defined scanningSpeed. This
    // value for now is hardcoded, as all the CSS transitions are set to 300ms.
    const transitionSpeed = 300; // in milliseconds
    const classFocus = 'switcher-focus'; // Focus switcher CSS class
    const classActive = 'switcher-active'; // Active switcher CSS class
    const switcherElements = document.querySelectorAll('[data-tabindex]:not([disabled])');
    const validSwitcherElements = [];

    // Switcher enabled.
    log(`Switcher active (mode: ${controlMode} ${scanningSpeed}s, s: ${selectionButton}, n: ${navigationButton})`);
    // Audio (voice narration) on page-load?
    if (
        typeof window.Switcher === 'object' &&
        'audio' in window.Switcher &&
        typeof window.Switcher.audio === 'string'
    ) {
        sound(window.Switcher.audio);
    }
    // Music on page-load?
    const backgroundMusic =
        typeof window.Switcher === 'object' && 'music' in window.Switcher && typeof window.Switcher.music === 'string'
            ? music(window.Switcher.music, false, true)
            : null;

    function removeSwitcherClasses() {
        const elements = document.getElementsByClassName(classFocus);
        for (let i = 0; i < elements.length; i++) {
            elements[i].classList.remove(classFocus);
        }
    }

    // If no switcher elements are found, then return (exit).
    if (switcherElements.length === 0) {
        log('No elements found with data-tabindex attribute');
        return;
    }

    // Iterate through elements and check data-tabindex values.
    for (let i = 0; i < switcherElements.length; i++) {
        const element = switcherElements[i];
        const tabindex = element.dataset.tabindex;
        if (Number.parseInt(tabindex) === Number(tabindex)) {
            validSwitcherElements.push(element);
        }
    }
    // Sort valid elements by data-tabindex value.
    validSwitcherElements.sort((a, b) => {
        return a.dataset.tabindex - b.dataset.tabindex;
    });
    // Remove any left-over switcher classes from all elements:
    for (let i = 0; i < validSwitcherElements.length; i++) {
        validSwitcherElements[i].classList.remove(classFocus);
        validSwitcherElements[i].classList.remove(classActive);
    }

    // The position of the highlighted element, or -1 when nothing is highlighted.
    function currentIndex() {
        return validSwitcherElements.findIndex((element) => element.classList.contains(classFocus));
    }

    // Moves the highlight from one element to another, with the navigation sound.
    function moveFocus(fromIndex, toIndex) {
        validSwitcherElements[fromIndex].classList.remove(classFocus);
        validSwitcherElements[fromIndex].blur();
        validSwitcherElements[toIndex].focus();
        validSwitcherElements[toIndex].classList.add(classFocus);
        sound('fx.select');
    }

    // Marks the element active and clicks it once the sounds have played.
    function selectElement(index) {
        const element = validSwitcherElements[index];
        element.classList.remove(classFocus);
        element.classList.add(classActive);
        window.removeEventListener('keydown', handleSwitchKey);
        sound(
            'fx.navigate',
            function () {
                const narration = element.dataset.audioSelect;
                if (narration === undefined) {
                    element.click();
                } else {
                    sound(narration, function () {
                        element.click();
                    });
                }
            },
            true,
        );
    }

    // The scan's timer and the element it stands on. The help modal's buttons
    // stop and restart the scan, so both outlive the block that starts it.
    let intervalId = null;
    let scanIndex = 0;

    // Starts the automatic scan, unless it runs already or the mode is manual.
    function startScanning() {
        if (controlMode !== 1 || intervalId !== null) {
            return;
        }
        intervalId = setInterval(
            () => {
                const nextFocusIndex = (scanIndex + 1) % validSwitcherElements.length;
                validSwitcherElements[scanIndex].removeEventListener('keydown', handleSwitchKey);
                moveFocus(scanIndex, nextFocusIndex);
                validSwitcherElements[nextFocusIndex].addEventListener('keydown', handleSwitchKey);
                scanIndex = nextFocusIndex;
            },
            scanningSpeed * 1000 + transitionSpeed,
        );
    }

    // Stops the automatic scan and leaves the highlight where it stands.
    function stopScanning() {
        clearInterval(intervalId);
        intervalId = null;
    }

    if (validSwitcherElements.length > 0) {
        this.document.body.classList.add('switcher');
        if (controlMode === 1) {
            // Automatic mode (default).
            // Selection Button (default: Enter) clicks a highlighted option.
            // On start select the first element and add the listener:
            validSwitcherElements[scanIndex].focus();
            validSwitcherElements[scanIndex].classList.add(classFocus);
            validSwitcherElements[scanIndex].addEventListener('keydown', handleSwitchKey);
            startScanning();
        } else {
            // Manual mode.
            // Select the first option by default.
            const currentFocusIndex = 0;
            validSwitcherElements[currentFocusIndex].focus();
            validSwitcherElements[currentFocusIndex].classList.add(classFocus);
            // Note: Keydown for immediate response, instead of the keyup used
            // on key-assigner.js.
            window.addEventListener('keydown', handleSwitchKey);
        }
    }

    // The help modal answers a player who reached for Tab. Its two buttons own
    // the scan: one stops it, the other lets it carry on.
    const switcherModalEl = document.getElementById('switcherModal');
    if (switcherModalEl) {
        switcherModalEl.querySelector('#switcherModalBreak')?.addEventListener('click', stopScanning);
        switcherModalEl.querySelector('#switcherModalContinue')?.addEventListener('click', startScanning);
        switcherModalEl.addEventListener('hidden.bs.modal', function () {
            removeSwitcherClasses();
            // Whichever button closed it, the player keeps a highlight to act on.
            if (controlMode === 1) {
                validSwitcherElements[scanIndex].classList.add(classFocus);
            }
        });
    }

    function switcherModal() {
        const bsSwitcherModal = Modal.getOrCreateInstance(switcherModalEl, {
            keyboard: false,
            focus: false,
            backdrop: 'static',
        });
        sound('fx.modal');
        bsSwitcherModal.show();
        return false;
    }

    function handleSwitchKey(event) {
        const allowedList = SwitcherKeys.allowedList;
        const escapeList = SwitcherKeys.escapeList;
        let returnKey;
        // Note that even if extremely useful, event.keyCode is deprecated.
        // Instead, we parse the event.key (@see key-assigner.js).
        if (event.key.length) {
            const charCode = event.key.charCodeAt(0);
            // event.code checks
            if (event.key.length > 1 && charCode < 128) {
                // Key is "named" (e.g. LeftAlt):
                if (escapeList.indexOf(event.code) !== -1) {
                    event.preventDefault();
                    switcherModal();
                    return false;
                }
                if (allowedList.indexOf(event.code) !== -1) {
                    log('Key-code accepted.');
                    returnKey = event.code;
                } else {
                    log(`Not accepted key-code ${event.code}`);
                    return false;
                }
            } else {
                // event.key checks
                if (charCode === 32) {
                    // Space is one of the Unicode characters
                    // which is read as " ". To make our life
                    // easier, we simply convert it to "Space".
                    log('Space accepted');
                    returnKey = 'Space';
                } else {
                    if (allowedList.indexOf(event.key) !== -1) {
                        log('Key accepted.');
                        returnKey = event.key;
                    } else {
                        if (escapeList.indexOf(event.key) !== -1) {
                            event.preventDefault();
                            switcherModal();
                            return false;
                        }
                        if (event.key === '-' || event.key === '_') {
                            if (backgroundMusic !== null) {
                                backgroundMusic.volume = Math.max(0, backgroundMusic.volume - 0.1);
                                saveVolume('music_volume', backgroundMusic.volume);
                                return false;
                            }
                        }
                        if (event.key === '=' || event.key === '+') {
                            if (backgroundMusic !== null) {
                                backgroundMusic.volume = Math.min(1, backgroundMusic.volume + 0.1);
                                saveVolume('music_volume', backgroundMusic.volume);
                                return false;
                            }
                        }
                        log(`Not accepted key ${event.key}`);
                        return false;
                    }
                }
            }
        }
        const focusedIndex = currentIndex();
        if (controlMode === 1) {
            // Automatic mode.
            event.preventDefault();
            if (returnKey === selectionButton) {
                stopScanning();
                selectElement(Math.max(0, focusedIndex));
            }
        } else {
            // Manual mode. With nothing highlighted (after the escape modal), start from the first element.
            event.preventDefault();
            const currentFocusIndex = Math.max(0, focusedIndex);
            if (returnKey === navigationButton) {
                const nextFocusIndex = focusedIndex === -1 ? 0 : (focusedIndex + 1) % validSwitcherElements.length;
                moveFocus(currentFocusIndex, nextFocusIndex);
            }
            if (returnKey === selectionButton) {
                selectElement(currentFocusIndex);
            }
        }
    }
}
