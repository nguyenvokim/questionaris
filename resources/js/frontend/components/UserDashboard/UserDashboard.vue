<template>
    <div v-if="isLoaded">
        <div class="card mb-sm-2">
            <div class="card-body">
                <div class="form-inline" v-if="clients.length">
                    <label class="mr-sm-2">Select a client to view their dashboard: </label>
                    <select v-model="preSelectClientId" class="form-control mr-sm-2">
                        <option v-for="client in clients" :value="client.id">{{getFullNameClient(client)}}</option>
                    </select>
                    <button class="btn btn-primary" @click="viewClient">
                        <i class="fa fa-fw fa-eye"></i> View
                    </button>
                </div>
                <div class="form-inline" v-if="clients.length === 0">
                    <label class="mr-sm-2">You do not have any client yet, please create new one </label>
                    <a href="/clients/create" class="btn btn-primary">Create client</a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <client-battery-assign :key="selectedClient"></client-battery-assign>
            </div>
            <client-test-info :key="selectedClient"></client-test-info>
        </div>
    </div>
</template>

<script>

    import { mapActions, mapState, mapMutations } from 'vuex';
    import ClientBatteryAssign from './ClientBatteryAssign';
    import ClientTestInfo from './ClientTestInfo';

    export default {
        components: {ClientTestInfo, ClientBatteryAssign},
        props: {
        },
        data: function() {
            return {
                preSelectClientId: 0,
                isLoaded: false
            }
        },
        async mounted() {
            await this.loadInitDashboard();
            this.$nextTick(() => {
                this.isLoaded = true;
                if (this.clients.length) {
                    this.preSelectClientId = this.clients[0].id;
                    this.viewClient()
                }
            })
        },
        methods: {
            ...mapActions({
                loadInitDashboard: 'userDashboard/loadInitDashboard'
            }),
            ...mapMutations({
                setSelectedClient: 'userDashboard/setSelectedClient'
            }),
            getFullNameClient: function (client) {
                return `${client.first_name} ${client.last_name}`;
            },
            viewClient: function () {
                this.setSelectedClient(this.preSelectClientId);
            }
        },
        computed: {
            ...mapState({
                clients: (state) => state.userDashboard.clients,
                batteries: (state) => state.userDashboard.batteries,
                selectedClient: (state) => state.userDashboard.selectedClient
            })
        }
    }
</script>
