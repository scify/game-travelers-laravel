/*
 * Help & Tooltips Functions.
 */
import { Tooltip } from 'bootstrap';

window.addEventListener('load', function () {
    document.querySelectorAll("[data-bs-toggle='tooltip']").forEach((element) => new Tooltip(element));
});
