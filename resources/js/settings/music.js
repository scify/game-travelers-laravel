import { music } from '@/audio.js';
import { log } from '@/debug.js';

window.addEventListener('load', switcher);
function switcher() {
    // Music on page-load?
    if (
        typeof window.Switcher === 'object' &&
        'music' in window.Switcher &&
        typeof window.Switcher.music === 'string'
    ) {
        const musicVolume = window.Switcher.musicVolume ?? 0.2; // Default volume
        log(`Switcher reports volume: ${musicVolume}`);
        const backgroundMusic = music(window.Switcher.music, musicVolume, true);

        if (backgroundMusic !== null) {
            window.addEventListener('keydown', (event) => {
                switch (event.key) {
                    case '_':
                        backgroundMusic.volume = Math.max(0, backgroundMusic.volume - 0.1);
                        break;
                    case '-':
                        backgroundMusic.volume = Math.max(0, backgroundMusic.volume - 0.1);
                        break;
                    case '=':
                        backgroundMusic.volume = Math.min(1, backgroundMusic.volume + 0.1);
                        break;
                    case '+':
                        backgroundMusic.volume = Math.min(1, backgroundMusic.volume + 0.1);
                        break;
                }
            });
        }
    }
}
