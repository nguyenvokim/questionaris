
const state = {
    roleUsers: [],
    selectedRoleUser: null,
}

const mutations = {
    setRoleUsers(state, payload) {
        state.roleUsers = payload;
    },

    setSelectedRoleUser(state, payload) {
        state.selectedRoleUser = payload;
    }
}

export default {
    namespaced: true,
    state,
    mutations
}
