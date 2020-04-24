<template>
    <div v-if="selectedClient">
        <div class="card mb-sm-2">
            <div class="card-body">
                <h2>
                    {{clientFullName}}
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
            <client-test-info :key="selectedClient"></client-test-info>
        </div>
    </div>
</template>

<script>

    import { mapActions, mapState, mapMutations, mapGetters } from 'vuex';
    import ClientBatteryAssign from './ClientBatteryAssign';
    import ClientTestInfo from './ClientTestInfo';

    export default {
        components: {ClientTestInfo, ClientBatteryAssign},
        props: {
        },
        data: function() {
            return {
                preSelectClientId: 0
            }
        },
        async mounted() {
            await this.loadInitDashboard();
            this.$nextTick(() => {
                // if (this.clients.length) {
                //     this.preSelectClientId = this.clients[0].id;
                //     this.viewClient()
                // }
            })
        },
        methods: {
            ...mapActions('userDashboard', ['loadInitDashboard']),
            ...mapMutations({
                setSelectedClient: 'userDashboard/setSelectedClient'
            }),
            getFullNameClient: function (client) {
                return `${client.first_name} ${client.last_name}`;
            },
            handleBack: function () {
                this.setSelectedClient(0);
            }
        },
        computed: {
            ...mapState('userDashboard', ['clients', 'batteries', 'selectedClient']),
            ...mapGetters('userDashboard', ['selectedClientData']),
            clientFullName: function () {
                if (!this.selectedClientData) return '';
                return `Client: ${this.selectedClientData.first_name} ${this.selectedClientData.last_name}`
            }
        }
    }
</script>
