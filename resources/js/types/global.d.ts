/**
 * What Blade publishes on window before the scripts run, and the two globals
 * the scripts publish themselves.
 *
 * @see resources/views/components/layout/footer-scripts.blade.php
 * @see resources/views/components/switcher.blade.php
 * @see resources/views/components/settingsScripts.blade.php
 */
import type { createDebugTools } from '@/lib/debug.js';

/** Sound files by folder and, where a folder has them, sub-folder; leaves hold the file name. */
export interface AudioTree {
    [name: string]: AudioTree | string;
}

/** Translation strings by file and key, nested like the lang/ arrays. */
export interface Translations {
    [key: string]: Translations | string;
}

export interface PlayerAudio {
    /** Between 0 and 1; 0.2 unless the page sets it. */
    playerMusicVolume: number;
    /** Between 0 and 1; 1 unless the page sets it. */
    playerSoundVolume: number;
    /** The player's own audio folder, or false on pages without a player. */
    playerUrl: string | false;
    /** The route that saves the volumes, or false on pages without a player. */
    updateVolumesUrl: string | false;
    /** The player's own sound files, or false when there are none. */
    playerAudioFiles: AudioTree | false;
}

export interface Laravel {
    baseUrl: string;
    locale: string;
    translations: Translations;
    audioFiles: AudioTree;
    playerAudio: PlayerAudio;
    /** True only in a local installation with APP_DEBUG. */
    debug: boolean;
}

/**
 * The player's controls on the game setup pages; the settings pages publish
 * only the music fields.
 */
export interface Switcher {
    /** 1 automatic scanning, 2 manual navigation. */
    controlMode?: 1 | 2;
    /** Seconds between two scanning steps. */
    scanningSpeed?: number;
    automaticSelectionButton?: string;
    manualSelectionButton?: string;
    manualNavigationButton?: string;
    /** A narration to play when the page loads, as a sound key. */
    audio?: string;
    /** Music to start when the page loads, as a sound key. */
    music?: string;
    musicVolume?: number;
}

declare global {
    interface Window {
        Laravel: Laravel;
        Switcher?: Switcher;
        /** For the inline Blade scripts; modules import from 'bootstrap' instead. */
        bootstrap: typeof import('bootstrap');
        /** On the board, in debug mode only. */
        travelersDebug?: ReturnType<typeof createDebugTools>;
    }
}
