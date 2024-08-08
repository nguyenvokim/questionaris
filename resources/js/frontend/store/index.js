import Vue from 'vue'
import Vuex from 'vuex'

import userDashboard from './module/userDashboard'
import clientBattery from './module/clientBattery'
import userManager from './module/userManager'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production';

export default new Vuex.Store({
    modules: {
        userDashboard,
        clientBattery,
        userManager,
    },
    strict: debug,
})
