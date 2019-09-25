
import axios from  'axios';

const state = {
    clients: [],
    batteries: [],
    selectedClient: 0,
    activatingClientBattery: {},
    client: {},
    finishedTests: [],
    detailTestResults: [],
    selectedTestId: 0,
    clientDetailTestResult: {}
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
    },
    loadClientTestsInfo: async function({state, commit}, clientId) {
        return axios.get(`/api/dashboard/clientTestsInfo/${clientId}`).then((response) => {
            commit('setClientTestsInfo', response.data);
            return response;
        })
    },
    loadClientTestResult: async function({state, commit}, data) {
        return axios.get(`/api/dashboard/clientTestResults/${data.clientId}/${data.testId}`).then((response) => {
            commit('setDetailTestResults', response.data);
            return response;
        })
    },
    loadClientDetailTestResult: async function({state, commit}, id) {
        return axios.get(`/api/dashboard/clientDetailTestResult/${id}`).then((response) => {
            commit('setClientDetailTestResult', response.data);
            return response;
        })
    },
    sendEmailBattery: async function({state, commit}, data) {
        return axios.post('/api/dashboard/sendEmailBattery', data).then((response) => {
            return response.data;
        }).catch((error) => {
            return error.response.data;
        });
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
    },
    setClientTestsInfo: function (state, {client, finishedTests, detailTestResults}) {
        state.client = client;
        state.finishedTests = finishedTests;
        state.detailTestResults = detailTestResults;
    },
    setDetailTestResults: function (state, data) {
        state.detailTestResults = data;
    },
    setSelectedTestId: function (state, testId) {
        state.selectedTestId = testId;
    },
    setClientDetailTestResult: function (state, data) {
        state.clientDetailTestResult = data;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}