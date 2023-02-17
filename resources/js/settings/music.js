window.addEventListener("load", switcher);
function switcher() {
	// Music on page-load?
	if (
		typeof window.Switcher === "object" &&
		"music" in window.Switcher &&
		typeof window.Switcher.music === "string"
	) {
		let musicVolume = window.Switcher.musicVolume || 0.2; // Default volume
		console.log(`Switcher reports volume: ${musicVolume}`);
		const music = window.music(window.Switcher.music, musicVolume, true);

		if (music !== null) {
			window.addEventListener("keydown", (event) => {
				switch (event.key) {
					case "_":
						music.volume = Math.max(0, music.volume - 0.1);
						break;
					case "-":
						music.volume = Math.max(0, music.volume - 0.1);
						break;
					case "=":
						music.volume = Math.min(1, music.volume + 0.1);
						break;
					case "+":
						music.volume = Math.min(1, music.volume + 0.1);
						break;
				}
			});
		}
	}
}
