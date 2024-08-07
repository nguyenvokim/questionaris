
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
import store from './store';
import {router} from "./route";
import CountrySelect from "./common/CountrySelect.vue";
import ProfessionSelect from "./common/ProfessionSelect.vue";


Vue.use(BootstrapVue)
Vue.use(Clipboard);
Vue.component('apexchart', VueApexCharts);
Vue.component('custom-select-list', require('./components/CustomSelectList').default);
Vue.component('datepicker', Datepicker);
Vue.component('client-battery', require('./components/ClientBattery/ClientBattery').default);
Vue.component('button-copy', require('./common/ButtonCopy').default);
Vue.component('delete-battery', require('./standalone/DeleteBattery').default);
Vue.component('custom-datepicker', require('./common/CustomDatepicker').default);
Vue.component('search-client-box', require('./components/SearchClientBox').default);
Vue.component('hash-guard', require('./components/HashGuard').default);
Vue.component('country-select', CountrySelect);
Vue.component('profession-select', ProfessionSelect);

Vue.mixin(require('./mixin').default);
let vueConfig = {
    el: '#app',
    store
}

if (window.useVueRoute) {
    Vue.use(VueRouter);
    vueConfig['router'] = router;
}
const app = new Vue(vueConfig);

window.Vue = app;
