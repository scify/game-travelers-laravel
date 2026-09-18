/**
 * Vue.js dependency for Taxidiotes.
 *
 * Only the board and the audio settings need Vue, so this entry is not part
 * of app.js: the layouts load it when a view sets $hasVue. The components are
 * mounted from Blade markup, so Vue compiles those templates in the browser
 * (see the alias in vite.config.js).
 */
import { createApp } from "vue";
import BoardComponent from "./components/BoardComponent.vue";
import CustomAudiosComponent from "./components/CustomAudiosComponent.vue";

createApp({})
	.component("board-component", BoardComponent)
	.component("custom-audios-component", CustomAudiosComponent)
	.mount("#app");
