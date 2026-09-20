/**
 * Debug tools for the board, on only where Blade turned debug on
 * (window.Laravel.debug, true in a local installation with APP_DEBUG).
 *
 * A logger that stays silent otherwise, an event bus the board publishes its
 * progress on, and the tools a test or the debug strip drive the game with.
 * They act through the same keyboard events a switch sends, never through the
 * component's internals.
 */
import axios from 'axios';

const listeners = new Map();

export function enabled() {
    return window.Laravel?.debug === true;
}

export function log(...args) {
    if (enabled()) {
        console.log(...args);
    }
}

/** Subscribes to an event; returns the function that unsubscribes. */
export function on(event, handler) {
    if (!listeners.has(event)) {
        listeners.set(event, new Set());
    }
    listeners.get(event).add(handler);
    return () => listeners.get(event).delete(handler);
}

/** Resolves with the payload of the next occurrence of the event. */
export function once(event) {
    return new Promise((resolve) => {
        const off = on(event, (payload) => {
            off();
            resolve(payload);
        });
    });
}

export function emit(event, payload) {
    log(`[${event}]`, payload);
    for (const handler of listeners.get(event) ?? []) {
        handler(payload);
    }
}

/** A real keyboard event, so the test takes the same path as a switch press. */
export function press(key) {
    // Both values, because a named key is read from the code (@see keys.js).
    const pressed = key === 'Space' ? { key: ' ', code: 'Space' } : { key, code: key };
    window.dispatchEvent(new KeyboardEvent('keydown', { ...pressed, bubbles: true, cancelable: true }));
}

const wait = (ms) => new Promise((resolve) => window.setTimeout(resolve, ms));

/**
 * Builds the tools the board publishes as window.travelersDebug.
 *
 * @param {() => object} state A snapshot of the game as the board sees it.
 * @param {() => {select: string, navigate: string}} keys The player's keys.
 * @param {(muted: boolean) => void} setVolumes Silences or restores the board's audio.
 * @param {string|null} stateUrl The route that stages the game row, or null when the route does not exist.
 */
export function createDebugTools({ state, keys, setVolumes, stateUrl }) {
    return {
        state,
        press,
        on,
        once,
        roll() {
            press(keys().select);
        },
        // Moves like a player would: navigate to the target when the player has a
        // navigate key, otherwise wait for the scanning selector to reach it; then select.
        async move() {
            const deadline = Date.now() + 30000;
            while (Date.now() < deadline) {
                const s = state();
                if (s.gamePhase !== 2 || s.newPosition < 0) {
                    return false;
                }
                const usesNavigateKey = s.autoMove === 2 && s.movementMode !== 1;
                if (!s.ignoreInput && s.blueShown && s.blueIndex === s.newPosition) {
                    press(keys().select);
                    return true;
                }
                if (usesNavigateKey && !s.ignoreInput && s.blueIndex >= 0) {
                    press(keys().navigate);
                }
                await wait(usesNavigateKey ? 150 : 50);
            }
            return false;
        },
        // New sounds start silent; a narration already playing keeps its volume.
        mute(muted = true) {
            setVolumes(muted);
            return muted;
        },
        // Writes the given fields to the game row and reloads, since the board reads the row on load.
        setState(fields) {
            const data = Object.fromEntries(
                Object.entries(fields).filter(([, value]) => value !== null && value !== ''),
            );
            return axios
                .post(stateUrl, data, { headers: { Accept: 'application/json' } })
                .then(() => window.location.reload())
                .catch((error) => alert(error.response?.data?.message ?? error));
        },
    };
}
