
import axios from  'axios';

const state = {
    client: {},
    clientBattery: {},
    tests: [],
    battery: {},
    answers: {},
    currentDisplayTestId: -1,
    batteryId: 0,
    focusAnswer: {
        testId: 0,
        questionIndex: 0,
        answerIndex: 0
    }
};
const getters = {

};

const actions = {
    validateClient: async function ({state, commit}, data) {
        return axios.post('/api/clientBattery/validateClient', data).then((response) => {
            if (!response.data.error) {
                commit('setInitData', response.data);
            }
            return response.data;
        }).catch((error) => {
            return error.response.data;
        });
    },
    validateClientWithCode: async function ({state, commit}, data) {
        return axios.post('/api/clientBattery/validateClient', data).then((response) => {
            if (!response.data.error) {
                commit('setInitData', response.data);
            }
            return response.data;
        }).catch((error) => {
            return error.response.data;
        });
    },
    sendSaveAnswer: async function({state, commit}, data) {
        return axios.post('/api/clientBattery/save', data).then((response) => {
            return response.data;
        }).catch((error) => {
            return error.response.data;
        });
    }
};

const mutations = {
    setInitData: function (state, data) {
        state.client = data.client;
        state.clientBattery = data.clientBattery;
        state.tests = data.tests;
        state.battery = data.battery;
    },
    setInitAnswers: function (state, data) {
        state.answers = data;
    },
    setAnswer: function (state, {testId, questionId, score}) {
        state.answers[testId][questionId] = score;
    },
    setCurrentDisplayTestId: function (state, testId) {
        state.currentDisplayTestId = testId;
    },
    setBatteryId: function (state, batteryId) {
        state.batteryId = batteryId;
    },
    setFocusAnswer: function (state, data) {
        state.focusAnswer = data;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
