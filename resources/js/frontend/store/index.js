import Vue from 'vue'
import Vuex from 'vuex'

import userDashboard from './module/userDashboard'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production';

export default new Vuex.Store({
    modules: {
        userDashboard
    },
    strict: debug,
})