<template>
    <div v-if="selectedClient">
        <div class="card mb-sm-2">
            <div class="card-body">
                <h2>
                    <a class="text-dark" :href="`/clients/edit/${selectedClientData.id}`">
                        {{clientFullName}}
                    </a>
                    <button class="float-right btn btn-light" @click="handleBack">
                        <i class="fa fa-fw fa-backward"></i> Back
                    </button>
                </h2>
            </div>
        </div>
        <div class="card" v-if="clients.length > 0">
            <div class="card-header">
                <client-battery-assign :key="selectedClient"></client-battery-assign>
            </div>
            <client-test :key="selectedClient"></client-test>
        </div>
    </div>
</template>
<script>
import {computed, defineComponent} from 'vue'
import useUserDashboard from "../../composable/useUserDashboard";
import ClientTest from "./ClientTest.vue";
import ClientBatteryAssign from "./ClientBatteryAssign.vue";
import {useRouter} from "vue-router/composables";

export default defineComponent({
    components: {ClientTest, ClientBatteryAssign},
    setup() {
        const router = useRouter()
        const {
            setSelectedTestId,
            setSelectedClient,
            loadInitDashboard,
            loadRecentTest,
            clients,
            batteries,
            selectedClient,
            user,
            selectedClientData,
        } = useUserDashboard()
        const clientFullName = computed(() => {
            if (!selectedClientData.value) return '';
            return `Client: ${selectedClientData.value.first_name} ${selectedClientData.value.last_name}`
        })

        const handleBack = () => {
            setSelectedClient(0);
            router.back()
        }

        return {
            setSelectedTestId,
            setSelectedClient,
            loadInitDashboard,
            loadRecentTest,
            clients,
            batteries,
            selectedClient,
            user,
            selectedClientData,
            clientFullName,
            handleBack,
        }
    },
    async mounted() {
        await this.loadInitDashboard()
        const clientId = 3
        const testId = 4
        this.setSelectedTestId(Number(testId))
        this.setSelectedClient(Number(clientId))
    }
})
</script>
