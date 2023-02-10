(function () {
	"use strict";
	// Experimental Audio Functions
	// Providing 2 channel-audio for Travelers via window.music (music),
	// window.sound (sound narration & effects).
	// @todo: Make these functions work via:
	// @link https://github.com/goldfire/howler.js
	// @todo: old world, solasta @IMPORTANT

	window.travelersSounds = [];

	/**
	 * Music
	 * Allows the playback of music via the HTMLAudioElement.
	 * Volume is set to 10% but can be adjusted with the optional audioVolume parameter.
	 * @param audioFile One of the audio files available via Laravel.audioFiles in folder.subfolder.file (with no extension) format.
	 * @param audioVolume Optional: Set the volume (defaults to 0.1), max: 1.0
	 * @param audioLoop Optional: Defaults to true. Set to false to disable loop.
	 *
	 * @example
	 * window.music("music.movin_on")
	 * //  Plays the music on /audio/music/movin_on.mp3
	 */
	const music = function (audioFile, audioVolume = 0.1, audioLoop = true) {
		if (!window.Laravel.audioFiles) {
			console.log("Music files not found");
			return;
		}
		var folders = audioFile.split(".");
		var found = folders.reduce(
			(obj, key) => obj && obj[key],
			window.Laravel.audioFiles
		);
		if (!found) {
			console.log("Sound file not found");
			return;
		}
		var filename = folders.pop() + ".mp3";
		var folderPath = "/audio/" + folders.join("/");
		var audio = new Audio(folderPath + "/" + filename);
		audio.volume = audioVolume;
		audio.loop = audioLoop;
		audio.play();
		return audio;
	};
	window.music = music;

	/**
	 * Sound
	 * Allows the playback of sounds (e.g. narrations) via the HTMLAudioElement.
	 * Uses 100% volume. Allows playback of random files (see examples). Allows
	 * callbacks to be executed when the playback is finished. Optionally, you
	 * can interrupt any sounds that are already playing by passing interrupt as
	 * a third parameter.
	 *
	 * @param audiofile One of the audio files available via window.Laravel.audioFiles in folder.subfolder.file format (with no extension).
	 * @param callback Optional callback function to be executed on audio.onended event.
	 * @param interrupt Optionally interrupt previous playback if true (defaults to false).
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
	 */
	const sound = function (audiofile, callback = null, interrupt = false) {
		/** Checks for custom player files, based on the audiofile provided. */
		function getPlayerAudioFile(audiofile) {
			// Custom Player Audio Files Support
			if (window.Laravel.playerAudioFiles && window.Laravel.playerUrl) {
				var playerFolders = audiofile.split(".");
				// We are only interested in the last part (for now)...
				var lastPart = playerFolders[playerFolders.length - 1];
				// and only if that last part ends with a number (for now)...
				var lastMatchNumber = lastPart.match(/(\d+)/);
				if (lastMatchNumber) {
					var lastNumber = lastMatchNumber[1];
					var possibleMatches = [];
					for (var i = 1; i <= lastNumber; i++) {
						var modifiedLastPart = lastPart.replace(lastNumber, i);
						playerFolders[playerFolders.length - 1] =
							modifiedLastPart;
						var playerAudioFound = playerFolders.reduce(
							(obj, key) => obj && obj[key],
							window.Laravel.playerAudioFiles
						);
						if (playerAudioFound) {
							possibleMatches.push(playerAudioFound);
						}
					}
					if (possibleMatches.length > 0) {
						var randomPlayerIndex = Math.floor(
							Math.random() * possibleMatches.length
						);
						return possibleMatches[randomPlayerIndex];
					}
				} else {
					var playerAudioNoDigitFound = playerFolders.reduce(
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

		if (!window.Laravel.audioFiles) {
			console.log("Audio files not found");
			return;
		}
		// Prevent simultaneous playblack.
		if (interrupt && window.travelersSounds.length > 0) {
			window.travelersSounds.forEach((sound) => {
				sound.audio.pause();
				sound.audio.currentTime = 0;
			});
			window.travelersSounds = [];
		}
		// Almost Random Sound (tm) playback.
		var match = audiofile.match(/\[([0-9]+)-([0-9]+)\]/);
		if (match) {
			var start = parseInt(match[1], 10);
			var end = parseInt(match[2], 10);
			if (isNaN(start) || isNaN(end)) {
				return;
			}
			if (start > end) {
				[start, end] = [end, start];
			}
			var randomNum = Math.floor(
				Math.random() * (end - start + 1) + start
			);
			audiofile = audiofile.replace(match[0], randomNum);
			console.log(`Trying to play: ${audiofile}`);
		}

		var folders = audiofile.split(".");
		var found = folders.reduce(
			(obj, key) => obj && obj[key],
			window.Laravel.audioFiles
		);
		if (!found) {
			console.log("Sound file not found");
			return;
		}
		// So, is there a custom player sound?
		var playerAudioFile = getPlayerAudioFile(audiofile);
		var filename, folderPath;
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
		// @todo remove console.logs from this file
		console.log(`Playing audio: ${folderPath}/${filename}`);
		var audio = new Audio(folderPath + "/" + filename);

		// console.log(folders.pop()); // e.g. game_start
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
		audio.play();
		return audio;
	};
	window.sound = sound;
})();
