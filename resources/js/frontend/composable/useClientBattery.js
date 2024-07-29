import {useStore} from "./root";
import {computed} from "@vue/composition-api";

export default () => {
    const store = useStore()

    const client = computed(() => store.state.clientBattery.client)
    const clientBattery = computed(() => store.state.clientBattery.clientBattery)
    const tests = computed(() => store.state.clientBattery.tests)
    const battery = computed(() => store.state.clientBattery.battery)
    const batteryId = computed(() => store.state.clientBattery.batteryId)
    const answers = computed(() => store.state.clientBattery.answers)
    const currentDisplayTestId = computed(() => store.state.clientBattery.currentDisplayTestId)
    const focusAnswer = computed(() => store.state.clientBattery.focusAnswer)

    const validateClient = async ({ personalCode, birthDate, batteryId }) => {
        return await store.dispatch('clientBattery/validateClient', { personalCode, birthDate, batteryId })
    }

    const setInitAnswers = (resultTemplate) => {
        store.commit('clientBattery/setInitAnswers', resultTemplate)
    }

    const setCurrentDisplayTestId = (testId) => {
        store.commit('clientBattery/setCurrentDisplayTestId', testId)
    }

    const setFocusAnswer = ({testId, answerIndex, questionIndex}) => {
        store.commit('clientBattery/setFocusAnswer', {testId, answerIndex, questionIndex})
    }

    return {
        client,
        clientBattery,
        tests,
        battery,
        batteryId,
        answers,
        currentDisplayTestId,
        focusAnswer,
        validateClient,
        setInitAnswers,
        setCurrentDisplayTestId,
        setFocusAnswer,
    }
}
