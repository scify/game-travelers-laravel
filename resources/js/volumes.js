/**
 * Saves a player's volume through the route the page provides in
 * window.Laravel.playerAudio (updateVolumesUrl and playerUrl).
 */
import axios from 'axios';
import { log } from './debug.js';

/**
 * @param {'music_volume'|'sound_volume'} field
 * @param {number} volume Between 0 and 1.
 */
export function saveVolume(field, volume) {
    const { updateVolumesUrl, playerUrl } = window.Laravel.playerAudio;
    if (!updateVolumesUrl || !playerUrl) {
        log(`No route to save ${field} on this page`);
        return;
    }
    const playerId = playerUrl.slice(playerUrl.lastIndexOf('/') + 1);
    axios
        .post(updateVolumesUrl, { player_id: playerId, [field]: volume })
        .then(() => log(`Saved ${field}: ${volume}`))
        .catch((error) => console.error(`Saving ${field} failed:`, error));
}
