/*
 * Range Labels Functions.
 */
window.addEventListener("load", function() {
    const rangeElements = document.querySelectorAll(`input[type="range"]`);
    if (rangeElements.length) {
        for (let i = 0; i < rangeElements.length; i++) {
            const element = rangeElements[i];
            const elementId = element.getAttribute("id");
            const label = document.querySelector(`[for="${elementId}"]`);
            if (parseInt(element.value) === 1) {
                label.textContent = `${element.value} δευτερόλεπτο`;
            } else {
                label.textContent = `${element.value} δευτερόλεπτα`;
            }
            element.addEventListener("change", event => {
                if (parseInt(element.value) === 1) {
                    label.textContent = `${element.value} δευτερόλεπτο`;
                } else {
                    label.textContent = `${element.value} δευτερόλεπτα`;
                }
                const ruler = document.querySelector(`div[data-role="ruler"][data-value="${element.value}"]`);
                if (ruler) {
                    ruler.classList.add("selected");
                    // Remove the "selected" class after 2 seconds
                    setTimeout(function() {
                        ruler.classList.remove("selected");
                    }, 2000);
                }
            });
        }
    }
});
