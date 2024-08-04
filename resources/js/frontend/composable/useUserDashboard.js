import {useStore} from "./root";
import {computed} from "vue";

export default () => {
    const store = useStore()

    const loadInitDashboard = async () => {
        await store.dispatch('userDashboard/loadInitDashboard')
    }

    const loadRecentTest = async () => {
        await store.dispatch('userDashboard/loadRecentTest')
    }

    const setSelectedTestId = (testId) => {
        store.commit('userDashboard/setSelectedTestId', testId)
    }

    const setSelectedClient = (client) => {
        store.commit('userDashboard/setSelectedClient', client)
    }

    //         ...mapState('userDashboard', ['clients', 'batteries', 'selectedClient', 'user']),
    //         ...mapGetters('userDashboard', ['selectedClientData']),
    const clients = computed(() => store.state.userDashboard.clients)
    const batteries = computed(() => store.state.userDashboard.batteries)
    const selectedClient = computed(() => store.state.userDashboard.selectedClient)
    const user = computed(() => store.state.userDashboard.user)
    const recentTests = computed(() => store.state.userDashboard.recentTests)
    const selectedClientData = computed(() => store.getters['userDashboard/selectedClientData'])

    return {
        loadInitDashboard,
        loadRecentTest,
        setSelectedClient,
        setSelectedTestId,
        clients,
        batteries,
        selectedClient,
        user,
        selectedClientData,
        recentTests,
    }
}
