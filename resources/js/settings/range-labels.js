/*
 * Range Labels Functions.
 */
window.addEventListener('load', function() {
    const rangeElements = document.querySelectorAll('[type="range"]');
    if (rangeElements.length > 0) {
      for (let i = 0; i < rangeElements.length; i++) {
        const element = rangeElements[i];
        const elementId = element.getAttribute('id');
        const label = document.querySelector(`[for="${elementId}"]`);

        if (parseInt(element.value) === 1) {
          label.textContent = `${element.value} δευτερόλεπτο`;
        } else {
          label.textContent = `${element.value} δευτερόλεπτα`;
        }
        element.addEventListener('change', event => {
          if (parseInt(element.value) === 1) {
            label.textContent = `${element.value} δευτερόλεπτο`;
          } else {
            label.textContent = `${element.value} δευτερόλεπτα`;
          }
        });
      }
    }

});
