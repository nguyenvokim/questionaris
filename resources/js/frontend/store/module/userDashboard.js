
import axios from  'axios';

const state = {
    clients: [],
    batteries: [],
    selectedClient: 0,
    activatingClientBattery: {}
};
const getters = {

};

const actions = {
    loadInitDashboard: async function ({state, commit}) {
        return axios.get('/api/dashboard').then((response) => {
            commit('setInitDashboardData', response.data);
            return response;
        })
    },
    createUserBattery: async function ({state, commit}, data) {
        return axios.post('/api/dashboard/createdClientBattery', data).then((response) => {
            if (!response.data.errors) {
                commit('setActivatingClientBattery', response.data);
            }
            return response.data;
        }).catch((error) => {
            return error.response.data;
        });
    },
    loadActivatingClientBattery: async function({state, commit}, clientId) {
        return axios.get(`/api/dashboard/activatingClientBattery/${clientId}`).then((response) => {
            commit('setActivatingClientBattery', response.data);
            return response;
        })
    }
};

const mutations = {
    setInitDashboardData: function (state, {clients, batteries}) {
        state.clients = clients;
        state.batteries = batteries;
    },
    setSelectedClient: function (state, selectedClient) {
        state.selectedClient = selectedClient;
    },
    setActivatingClientBattery: function (state, activatingClientBattery) {
        state.activatingClientBattery = activatingClientBattery;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}