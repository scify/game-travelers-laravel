/*
 * Range Labels Functions.
 */

import { music, sound } from '@/lib/audio.js';
import { trans } from '@/lib/lang.js';
import { saveVolume } from '@/lib/volumes.js';

window.addEventListener('load', function () {
    const rangeElements = document.querySelectorAll("input[type='range']");

    function handleVolumeSlider(rangeElement, audioConfirmation = true, backgroundMusic = null) {
        // Get input[type='range'] parameters directly from the element.
        const rangeMin = Number.parseFloat(rangeElement.min);
        const rangeMax = Number.parseFloat(rangeElement.max);
        const rangeStep = Number.parseFloat(rangeElement.step);
        let rangeValue = Number.parseFloat(rangeElement.value);
        if (backgroundMusic === null) {
            saveVolume('sound_volume', rangeValue);
        } else {
            saveVolume('music_volume', rangeValue);
        }
        const preventMinValue = rangeElement.dataset.preventMinValue === 'true' || false;
        // Disallow minimum value if data-prevent-min-value=true:
        if (preventMinValue && rangeValue === rangeMin) {
            rangeValue = rangeMin + rangeStep;
            rangeElement.value = String(rangeValue);
        }
        // Update the element's data-music-volume for volume if it is set.
        if (backgroundMusic !== null && rangeElement.dataset.musicVolume !== undefined) {
            rangeElement.dataset.musicVolume = String(rangeValue);
            // Change the actual music volume
            if (rangeValue >= 0.0 && rangeValue <= 1.0) {
                backgroundMusic.volume = rangeValue;
            }
        }

        // Play a sound via window.sound to the set volume:
        if (audioConfirmation) {
            if (typeof window.sound === 'function') {
                sound('fx.select', null, true, rangeValue);
            }
        }
        // Calculate the visual representation of the set volume.
        const rangePercent = ((rangeValue - rangeMin) / (rangeMax - rangeMin)) * 100;
        // If min is not 0, then calculations are off hopefully by a step.
        /*
		if (rangeMin > 0) {
			rangeValue = rangeValue - rangeStep;
		}
		*/
        // Acquire the div which is used as the input's progress bar:
        const rangeElementId = rangeElement.getAttribute('id');
        const rangeProgressId = rangeElementId + 'Progress';
        const progressElement = document.getElementById(rangeProgressId);
        // Set the width aka progress of the progress bar:
        const sliderProgress = rangePercent + '%';
        // Calculate the opacity of the bar based on the desired range:
        const opacityRangeMin = 0.1;
        const opacityRangeMax = 0.8;
        const opacityRange = opacityRangeMax - opacityRangeMin;
        const sliderOpacity = (rangePercent / 100) * opacityRange + opacityRangeMin;
        // Calculate the volume gauge height based on the desire range:
        const triangleHeightMin = 0.75;
        const triangleHeightMax = 4;
        const triangleHeightRange = triangleHeightMax - triangleHeightMin;
        const sliderHeight = (rangePercent / 100) * triangleHeightRange + triangleHeightMin;
        // Set CSS variables:
        progressElement.style.setProperty('--slider-progress', sliderProgress);
        progressElement.style.setProperty('--slider-opacity', sliderOpacity.toString());
        progressElement.style.setProperty('--slider-height', sliderHeight + 'em');
    }

    if (rangeElements.length) {
        for (const element of rangeElements) {
            const elementId = element.getAttribute('id');
            const elementFunction = element.dataset.function;
            /* Volume Sliders */
            if (elementFunction === 'volume-slider') {
                // Initialise music playback:
                const musicData = element.dataset.music;
                const musicVolumeData = element.dataset.musicVolume;
                let backgroundMusic = null;
                if (
                    musicData !== null &&
                    musicData !== undefined &&
                    musicVolumeData !== null &&
                    musicVolumeData !== undefined
                ) {
                    element.value = musicVolumeData;
                    backgroundMusic = music(musicData, Number.parseFloat(musicVolumeData), true);
                    // Bind keydown events for music:
                    window.addEventListener('keydown', (event) => {
                        let volumeKeyDown = false;
                        switch (event.key) {
                            case '_':
                                backgroundMusic.volume = Math.max(0, backgroundMusic.volume - 0.1);
                                volumeKeyDown = true;
                                break;
                            case '-':
                                backgroundMusic.volume = Math.max(0, backgroundMusic.volume - 0.1);
                                volumeKeyDown = true;
                                break;
                            case '=':
                                backgroundMusic.volume = Math.min(1, backgroundMusic.volume + 0.1);
                                volumeKeyDown = true;
                                break;
                            case '+':
                                backgroundMusic.volume = Math.min(1, backgroundMusic.volume + 0.1);
                                volumeKeyDown = true;
                                break;
                        }
                        if (volumeKeyDown) {
                            element.dataset.musicVolume = backgroundMusic.volume.toFixed(1);
                            element.value = backgroundMusic.volume.toFixed(1);
                            element.dispatchEvent(new Event('change'));
                        }
                    });
                }
                // Initialise volume slider:
                handleVolumeSlider(element, false, backgroundMusic);
                // Bind change events on slider:
                element.addEventListener('change', () => {
                    handleVolumeSlider(element, true, backgroundMusic);
                });
            }
            /* Scanning Speed Range Inputs */
            if (elementId === 'scanningSpeed') {
                const label = document.querySelector(`[for="${elementId}"]`);
                if (Number.parseInt(element.value) === 1) {
                    label.textContent = `${trans('messages.every')} ${element.value} ${trans('messages.second')}`;
                } else {
                    label.textContent = `${trans('messages.every')} ${element.value} ${trans('messages.seconds')}`;
                }
                element.addEventListener('change', () => {
                    if (Number.parseInt(element.value) === 1) {
                        label.textContent = `${trans('messages.every')} ${element.value} ${trans('messages.second')}`;
                    } else {
                        label.textContent = `${trans('messages.every')} ${element.value} ${trans('messages.seconds')}`;
                    }
                    const ruler = document.querySelector(`div[data-role="ruler"][data-value="${element.value}"]`);
                    if (ruler) {
                        ruler.classList.add('selected');
                        // Remove the "selected" class after 2 seconds
                        setTimeout(function () {
                            ruler.classList.remove('selected');
                        }, 2000);
                    }
                });
            }
        }
    }
});
