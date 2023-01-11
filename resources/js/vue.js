/**
 * Vue.js dependency for Taxidiotes.
 *
 * This is the main Vue.js dependency for Taxidiotes. It loads Vue.js and
 * set-ups the environment for the Vue app. As most of the site does not require
 * Vue at this point, this is not included on the site's default layout and
 * therefore has to be requested to be loaded seperately.
 *
 */
import Vue from "vue";

window.Vue = Vue;

/*
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
	"ExampleComponent",
	require("./components/ExampleComponent.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
	el: "#app",
});
