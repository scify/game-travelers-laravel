window.addEventListener("load", switcher);
function switcher() {
	// Music on page-load?
	const music =
		typeof window.Switcher === "object" &&
		"music" in window.Switcher &&
		typeof window.Switcher.music === "string"
			? window.music(window.Switcher.music, "0.2", true)
			: null;
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
