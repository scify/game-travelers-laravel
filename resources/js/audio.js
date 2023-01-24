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
	 * Volume is set to 40%.
	 * @param audiofile One of the audio files available via Laravel.audioFiles in folder.subfolder.file (with no extension) format.
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
		var filename = folders.pop() + ".mp3";
		var folderPath = "/audio/" + folders.join("/");
		var audio = new Audio(folderPath + "/" + filename);
		window.travelersSounds.push({ audio: audio, file: filename });

		audio.onended = function () {
			window.travelersSounds = window.travelersSounds.filter(function (
				elem
			) {
				return elem.file !== filename;
			});
			if (callback && typeof callback === "function") {
				callback();
			}
		};
		audio.play();
	};
	window.sound = sound;
})();
