/**
  * Dice Selection Functions.
  */
window.addEventListener("load", () => {
	const diceImages = document.querySelectorAll("img[data-role='dice']");
	if (diceImages.length) {
		for (const img of diceImages) {
			img.addEventListener("click", (event) => {
				const checkboxId = event.target.getAttribute("data-for");
				if (checkboxId) {
					const checkbox = document.getElementById(checkboxId);
					if (checkbox) {
						checkbox.checked = true;
					}
				}
			});
		}
	}
});
