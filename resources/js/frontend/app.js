
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import '../bootstrap';
import '../plugins';
import Vue from 'vue';
import Datepicker from 'vuejs-datepicker';
import BootstrapVue from 'bootstrap-vue';

window.Vue = Vue;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.use(BootstrapVue)

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('custom-select-list', require('./components/CustomSelectList').default);
Vue.component('datepicker', Datepicker);
Vue.component('user-dashboard', require('./components/UserDashboard/UserDashboard').default);
Vue.component('client-battery', require('./components/ClientBattery/ClientBattery').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import store from './store';

const app = new Vue({
    el: '#app',
    store
});