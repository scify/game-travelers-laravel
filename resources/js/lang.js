/**
 * Retrieves the translation for a given key via window.Laravel.translations,
 * an object which contains localization strings from Laravel's /lang folders.
 *
 * @author {Pavlos Isaris}
 * @source {https://github.com/scify/Crowdsourcing-Platform/blob/master/resources/assets/js/lang.js}
 * @param {string} key - The key of the string to retrieve the translation for.
 * @param {Object} [replace={}] - Placeholders and replacement values.
 * @return {string} Retrieved translation with placeholders.
 *
 * @example
 * window.trans("messages.app_name")
 * // returns the translation for "app_name" in "lang/??/messages"
 */
(function () {
	"use strict";
	const trans = function (key, replace = {}) {
		let translation = key
			.split(".")
			.reduce((t, i) => t[i] || null, window.Laravel.translations);
		for (const placeholder in replace) {
			translation = translation.replace(
				`:${placeholder}`,
				replace[placeholder]
			);
		}
		return translation;
	};
	window.trans = trans;
})();
