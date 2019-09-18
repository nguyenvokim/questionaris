<template>
    <div v-if="selectedClient && isLoaded">
        <div v-if="batteries.length === 0" class="form-inline">
            <label class="mr-sm-2">You do not have any battery yet, please create new one </label>
            <a href="/batteries/create" class="btn btn-primary">Create Battery</a>
        </div>
        <div v-if="batteries.length">
            <div v-if="activatingClientBattery.id">
                Currently, <strong>{{activatingClientBattery.client.first_name}}</strong> already in change for battery <strong>{{activatingClientBattery.battery.name}}</strong><br/>
                Period from: {{activatingClientBattery.start_date}} to {{activatingClientBattery.end_date}}
            </div>
            <div v-if="!activatingClientBattery.id">
                <button class="btn btn-success" v-b-modal="'add_battery_modal'">
                    Launch battery for client
                </button>
            </div>
        </div>
        <b-modal ref="add_battery_modal" id="add_battery_modal" title="Launch battery for client" @ok="handleCreateBattery">
            <div class="form">
                <div v-if="errorMsg.length" role="alert" class="alert alert-danger">
                    {{errorMsg}}
                </div>
                <div class="form-group">
                    <label class="col-form-label">Select Battery</label>
                    <div>
                        <select v-model="selectedBatteryId" class="form-control">
                            <option v-for="battery in batteries" :value="battery.id">{{battery.name}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-form-label">Select Start Date</label>
                    <div>
                        <datepicker v-model="selectedStartDate" placeholder="Select Start Date" :input-class="'form-control'"></datepicker>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-form-label">Select End Date</label>
                    <div>
                        <datepicker v-model="selectedEndDate" placeholder="Select End Date" :input-class="'form-control'"></datepicker>
                    </div>
                </div>
            </div>
        </b-modal>
    </div>
</template>

<script>

    import { mapActions, mapState } from 'vuex';
    import { format, compareAsc } from 'date-fns'

    export default {
        props: {
        },
        data: function() {
            return {
                selectedStartDate: Date.now(),
                selectedEndDate: Date.now(),
                selectedBatteryId: 0,
                onAjaxRequesting: false,
                errorMsg: "",
                isLoaded: false,
            }
        },
        async mounted() {
            this.$nextTick(() => {
                if (this.batteries.length) {
                    this.selectedBatteryId = this.batteries[0].id;
                }
                this.loadActivatingClientBattery(this.selectedClient).then(() => {
                    this.isLoaded = true;
                });
            })
        },
        methods: {
            ...mapActions({
                createUserBattery: 'userDashboard/createUserBattery',
                loadActivatingClientBattery: 'userDashboard/loadActivatingClientBattery'
            }),
            handleCreateBattery: async function (bvModalEvt) {
                if (this.onAjaxRequesting) {
                    return;
                }
                bvModalEvt.preventDefault();
                this.onAjaxRequesting = true;
                const data = {
                    client_id: this.selectedClient,
                    battery_id: this.selectedBatteryId,
                    start_date: format(this.selectedStartDate, 'yyyy-MM-dd'),
                    end_date: format(this.selectedEndDate, 'yyyy-MM-dd'),
                };
                const response = await this.createUserBattery(data);
                this.onAjaxRequesting = false;
                if (response.errors) {
                    this.errorMsg = response.message;
                } else {
                    this.$refs.add_battery_modal.hide();
                }
            }
        },
        computed: {
            ...mapState({
                batteries: (state) => state.userDashboard.batteries,
                selectedClient: (state) => state.userDashboard.selectedClient,
                activatingClientBattery: (state) => state.userDashboard.activatingClientBattery,
            })
        }
    }
</script>
