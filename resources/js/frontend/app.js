
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
import VueApexCharts from 'vue-apexcharts';
import Clipboard from 'v-clipboard';
import VueRouter from 'vue-router';
import VueCompositionAPI from '@vue/composition-api'
import UserDashboard from "./components/UserDashboard/UserDashboard.vue";

Vue.use(VueCompositionAPI)
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

const RecentFinishedTest = require('./components/RecentFinishedTest/RecentFinishedTest').default;

Vue.use(BootstrapVue)
Vue.use(Clipboard);
Vue.component('apexchart', VueApexCharts);
Vue.component('custom-select-list', require('./components/CustomSelectList').default);
Vue.component('datepicker', Datepicker);
Vue.component('user-dashboard', UserDashboard);
Vue.component('client-battery', require('./components/ClientBattery/ClientBattery').default);
Vue.component('button-copy', require('./common/ButtonCopy').default);
Vue.component('delete-battery', require('./standalone/DeleteBattery').default);
Vue.component('custom-datepicker', require('./common/CustomDatepicker').default);
Vue.component('search-client-box', require('./components/SearchClientBox').default);
Vue.component('recent-finished-test', RecentFinishedTest);
Vue.component('hash-guard', require('./components/HashGuard').default);

let router = null;
if (window.useVueRoute) {
    Vue.use(VueRouter);
    const routes = [
        {
            path: '/',
            component: RecentFinishedTest,
            name: RouteName.Dashboard,
        },
        {
            path: '/detail/:clientId/:testId',
            component: UserDashboard,
            name: RouteName.ClientTestResult,
        }
    ]
    router = new VueRouter({
        base: 'dashboard#/',
        mode: 'hash',
        routes
    })
}

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import store from './store';
import {RouteName} from "./const";
import Ro from "vuejs-datepicker/dist/locale/translations/ro";

Vue.mixin(require('./mixin').default);
let vueConfig = {
    el: '#app',
    store
}
if (window.useVueRoute) {
    vueConfig['router'] = router;
}
const app = new Vue(vueConfig);
