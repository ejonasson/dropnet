
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require ('./bootstrap.js');

/**
 * Register some global URLs that we can easily reference within our components
 */
window.SiteUrls = require('./utilities/SiteUrls');

console.log(SiteUrls)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('sequence-editor', require('./components/Sequence'));
Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});
