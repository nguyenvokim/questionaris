import {getCurrentInstance} from "vue";

export const useStore = () => {
    const app = getCurrentInstance();

    if (app) {
        return app.proxy.$root.$store;
    }
}

export const useBvModal = () => {
    const app = getCurrentInstance();

    if (app) {
        return app.proxy.$root.$bvModal;
    }
}
