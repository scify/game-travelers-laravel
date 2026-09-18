/*
 * Help & Tooltips Functions.
 */
import { Tooltip } from 'bootstrap';

window.addEventListener('load', function () {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll("[data-bs-toggle='tooltip']"));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new Tooltip(tooltipTriggerEl);
    });
});
