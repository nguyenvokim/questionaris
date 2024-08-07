import {getCurrentInstance} from "vue";

export const useStore = () => {
    const app = getCurrentInstance();

    if (app) {
        return app.proxy.$root.$store;
    }
}

export const useBvModal = () => {
    const app = getCurrentInstance();
    return app.proxy.$root.$bvModal;
}

export const useBvToast = () => {
    const app = getCurrentInstance();
    return app.proxy.$root.$bvToast;
}

