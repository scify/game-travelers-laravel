(function () {
	"use strict";
	// Experimental Audio Functions
	// Providing 2 channel-audio for Travelers via:
	// - window.music (music) &
	// - window.sound (sound narration & effects).
	// @todo: Old World, Solasta, SpellForce Conquest of Eo @IMPORTANT

	window.travelersSounds = [];

	/**
	 * Music
	 * Allows the playback of music via the HTMLAudioElement.
	 * Volume is set to 10% but can be adjusted with the optional audioVolume parameter (override by window.Laravel.playerAudio.playerMusicVolume)
	 * @param {string} audioFile One of the audio files available via Laravel.audioFiles in folder.subfolder.file (with no extension) format.
	 * @param {number|false} [volumeOverride=false] Optionally force set the volume to a certain level (float: 0 to 1, step 0.1).
	 * @param {boolean} [audioLoop=true] Audio loops by default. Set as false to disable.
	 *
	 * @example
	 * window.music("music.songFile")
	 * //  Plays the music on /audio/music/songFile.mp3
	 */
	const music = function (
		audioFile,
		volumeOverride = false,
		audioLoop = true
	) {
		if (!window.Laravel.audioFiles) {
			console.log("Music files not found");
			return;
		}
		const folders = audioFile.split(".");
		const found = folders.reduce(
			(obj, key) => obj && obj[key],
			window.Laravel.audioFiles
		);
		if (!found) {
			console.log("Sound file not found");
			return;
		}
		const filename = folders.pop() + ".mp3";
		const folderPath = "/audio/" + folders.join("/");
		const audio = new Audio(folderPath + "/" + filename);

		let audioVolume = 1;
		// Set the audioVolume according to player's wishes, if any.
		if (
			window.Laravel.playerAudio &&
			window.Laravel.playerAudio.playerMusicVolume !== undefined &&
			typeof window.Laravel.playerAudio.playerMusicVolume === "number" &&
			window.Laravel.playerAudio.playerMusicVolume >= 0 &&
			window.Laravel.playerAudio.playerMusicVolume <= 1
		) {
			audioVolume = window.Laravel.playerAudio.playerMusicVolume;
		}
		// Override volume settings no matter what:
		if (volumeOverride) {
			audioVolume = volumeOverride;
			console.log("Music audioVolume override");
		}
		console.log(`Music audioVolume is set to: ${audioVolume}`);

		audio.volume = audioVolume;
		audio.loop = audioLoop;
		audio.play().catch((error) => {
			console.error("Music audio playback failed: ", error);
		});
		return audio;
	};
	window.music = music;

	/**
	 * Sound
	 * Allows the playback of sounds (e.g. narrations) via the HTMLAudioElement.
	 * Allows playback of random files (see examples). Allows callbacks to be
	 * executed when the playback is finished. Optionally, you can interrupt any
	 * sounds that are already playing by passing interrupt as a third parameter.
	 * Volume level defaults to 1 (100%) unless:
	 * - the global window.Laravel.playerAudio.playerSoundVolume is set
	 * - the function is called with the optional volumeOverride parameter
	 *
	 * @param {string} audioFile One of the audio files available via window.Laravel.audioFiles in folder.subfolder.file format (with no extension).
	 * @param {Function} [callback=null] Optional callback function to be executed on audio.onended event.
	 * @param {boolean} [interrupt=false] Optionally interrupt previous playback if true.
	 * @param {number|false} [volumeOverride=false] Optionally force set the volume to a certain level (float: 0 to 1, step 0.1).
	 *
	 * @example
	 * window.sound("sounds.before_opponents_turn.dice")
	 * //  Plays the sound file on /audio/sounds/before_opponents_turn/dice.mp3
	 * @example
	 * window.sound("sounds.game_start.welcome_[1-3]")
	 * //  Plays one of these files in random:
	 * //  - /audio/sounds/game_start/welcome_1.mp3
	 * //  - /audio/sounds/game_start/welcome_2.mp3
	 * //  - /audio/sounds/game_start/welcome_3.mp3
	 * @example
	 * window.sound("sounds.game_start.welcome_1", null, true)
	 * // Stops any other sound(s) and immediately start playing welcome_1.mp3
	 * @example
	 * window.sound("sounds.game_start.welcome_2", null, false, 0.6)
	 * // Plays the sound file on /audio/sounds/game_start/welcome_2.mp3, forcing the volume to 0.6 (60%)
	 */
	const sound = function (
		audioFile,
		callback = null,
		interrupt = false,
		volumeOverride = false
	) {
		// Exit if no audioFiles are found.
		if (!window.Laravel.audioFiles) {
			console.log("Audio files not found");
			return;
		}
		// Prevent simultaneous playback.
		if (interrupt && window.travelersSounds.length > 0) {
			window.travelersSounds.forEach((sound) => {
				sound.audio.pause();
				sound.audio.currentTime = 0;
			});
			window.travelersSounds = [];
		}

		/** Checks for custom player files, based on the audioFile provided. */
		function getPlayerAudioFile(audioFile) {
			// Custom Player Audio Files Support
			if (window.Laravel.playerAudioFiles && window.Laravel.playerUrl) {
				const playerFolders = audioFile.split(".");
				// We are only interested in the last part (for now)...
				const lastPart = playerFolders[playerFolders.length - 1];
				// and only if that last part ends with a number (for now)...
				const lastMatchNumber = lastPart.match(/(\d+)/);
				if (lastMatchNumber) {
					const lastNumber = lastMatchNumber[1];
					const possibleMatches = [];
					for (let i = 1; i <= lastNumber + 20; i++) {
						playerFolders[playerFolders.length - 1] =
							lastPart.replace(lastNumber, i);
						const playerAudioFound = playerFolders.reduce(
							(obj, key) => obj && obj[key],
							window.Laravel.playerAudioFiles
						);
						if (playerAudioFound) {
							possibleMatches.push(playerAudioFound);
						}
					}
					if (possibleMatches.length > 0) {
						const randomPlayerIndex = Math.floor(
							Math.random() * possibleMatches.length
						);
						return possibleMatches[randomPlayerIndex];
					}
				} else {
					const playerAudioNoDigitFound = playerFolders.reduce(
						(obj, key) => obj && obj[key],
						window.Laravel.playerAudioFiles
					);
					if (playerAudioNoDigitFound) {
						return playerAudioNoDigitFound;
					}
				}
			}
			// If nothing found...
			return false;
		}

		// Almost Random Sound (tm) playback.
		const match = audioFile.match(/\[([0-9]+)-([0-9]+)]/);
		if (match) {
			let start = parseInt(match[1], 10);
			let end = parseInt(match[2], 10);
			if (isNaN(start) || isNaN(end)) {
				return;
			}
			if (start > end) {
				[start, end] = [end, start];
			}
			const randomNum = Math.floor(
				Math.random() * (end - start + 1) + start
			);
			audioFile = audioFile.replace(match[0], randomNum.toString());
			console.log(`Almost random sound(tm) chosen: ${audioFile}`);
		}
		// Check if Default sound exists.
		const folders = audioFile.split(".");
		const found = folders.reduce(
			(obj, key) => obj && obj[key],
			window.Laravel.audioFiles
		);
		if (!found) {
			console.log("Sound file not found");
			return;
		}
		// But, is there a custom player sound?
		const playerAudioFile = getPlayerAudioFile(audioFile);
		let filename, folderPath;
		if (playerAudioFile) {
			// Play the custom player sound...
			// e.g. /player/b5b72dd79161d837bef10dd3d54de385/welcome_1.mp3
			filename = playerAudioFile;
			folderPath = window.Laravel.playerUrl;
		} else {
			// Play the default sound...
			filename = folders.pop() + ".mp3";
			folderPath = "/audio/" + folders.join("/");
		}

		// Trying to play the requested audio file.
		// Note that there is no easy-way to handle exceptions on promise, so
		// this console.log is probably the only useful thing for debugging.
		console.log(`Playing audio: ${folderPath}/${filename}`);
		const audio = new Audio(folderPath + "/" + filename);
		window.travelersSounds.push({ audio: audio, file: filename });
		audio.onended = function () {
			window.travelersSounds = window.travelersSounds.filter(function (
				sound
			) {
				return sound.file !== filename;
			});
			if (callback && typeof callback === "function") {
				callback();
			}
		};
		// Set the audioVolume according to player's wishes, if any.
		let audioVolume = 1;
		if (
			window.Laravel.playerAudio &&
			window.Laravel.playerAudio.playerSoundVolume !== undefined &&
			typeof window.Laravel.playerAudio.playerSoundVolume === "number" &&
			window.Laravel.playerAudio.playerSoundVolume >= 0 &&
			window.Laravel.playerAudio.playerSoundVolume <= 1
		) {
			audioVolume = window.Laravel.playerAudio.playerSoundVolume;
		}
		// Override volume settings no matter what:
		if (volumeOverride) {
			audioVolume = volumeOverride;
		}
		console.log(`Sound audioVolume is set to: ${audioVolume}`);

		audio.volume = audioVolume;
		audio.play().catch((error) => {
			console.error("Sound audio playback failed: ", error);
		});
		return audio;
	};
	window.sound = sound;
})();
