/***
 * Main JavaScript - Bootstrap with no Vue dependency for Taxidiotes.
 *
 * As most of the site is not a Vue app and as we do care about saving precious
 * bytes of bandwidth for our visitors , we are not going to require Vue.js on
 * all of our pages. Instead, we will just load Bootsrap!
 *
 * In detail: All the pages of the site require Bootstrap. Only the main board
 * requires Vue.js for now. For that reason, at this point, we are only loading
 * Bootstrap on our app.js, which is the one included in our default "layout"
 * component (@see /views/components/layout.blade.php ).
 */

require('./bootstrap');

