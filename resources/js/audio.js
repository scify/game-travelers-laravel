(function () {
	"use strict";
	// Experimental Audio Functions
	// @todo: Make these functions work via:
	// @link https://github.com/goldfire/howler.js
	// as audio.play is not a reliable method to play sound or music in all
	// browsers, especially when permissions is requested.
	// @todo: old world, solasta @IMPORTANT
	/**
	 * Music
	 * Allows the playback of music via the HTMLAudioElement.
	 * Volume is set to 40%.
	 *
	 * @example
	 * window.music("music.movin_on")
	 * //  Plays the music on /audio/music/movin_on.mp3
	 */
	const music = function (audiofile) {
		if (!window.Laravel.audioFiles) {
			console.log("Music files not found");
			return;
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
		var filename = folders.pop() + ".mp3";
		var folderPath = "/audio/" + folders.join("/");
		var audio = new Audio(folderPath + "/" + filename);
		audio.volume = 0.3;
		audio.play();
	};
	window.music = music;
	/**
	 * Sound
	 * Allows the playback of sounds via the HTMLAudioElement.
	 * Uses 100% volume. Note that sounds should be equalized as there's no way
	 * to ensure consistency of different recordings volumes via JavaScript.
	 *
	 * @param audiofile One of the audio files available via Laravel.audioFiles in folder.subfolder.file (with no extension) format.
	 * @param callback Optional callback function to be executed on audio.onended.
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
	 */
	const sound = function (audiofile, callback) {
		if (!window.Laravel.audioFiles) {
			console.log("Audio files not found");
			return;
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
		var filename = folders.pop() + ".mp3";
		var folderPath = "/audio/" + folders.join("/");
		var audio = new Audio(folderPath + "/" + filename);
		audio.onended = function () {
			if (callback && typeof callback === "function") {
				callback();
			}
		};
		audio.play();
	};
	window.sound = sound;
})();
