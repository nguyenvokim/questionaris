<template>
    <div>
        <div v-if="batteries.length === 0" class="form-inline">
            <label class="mr-sm-2">You do not have any battery yet, please create new one </label>
            <a href="/batteries/create" class="btn btn-primary">Create Battery</a>
        </div>
        <div v-if="batteries.length">
            <div>
                <button class="btn btn-success" v-b-modal="'send_email_modal'">
                    <i class="fa fa-fw fa-mail-bulk"></i> Send email battery for client
                </button>
            </div>
        </div>
        <b-modal ref="send_email_modal" id="send_email_modal" title="Select battery to send" @ok="handleSendBattery">
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
                    <label class="col-form-label">Email Text</label>
                    <div>
                        <textarea class="form-control" v-model="emailText"></textarea>
                    </div>
                </div>
                <div class="form-group" v-if="lastEmailBattery.id">
                    <strong><i>Last email has been sent to clent at: {{lastEmailBattery.created_at}}</i></strong>
                </div>
            </div>
        </b-modal>
        <b-modal ok-only ref="email_send_success" id="email_send_success" title="Success">
            <div class="form">
                <h4>Email send to client success</h4>
            </div>
        </b-modal>
    </div>
</template>

<script>

    import { mapActions, mapState } from 'vuex';
    import axios from 'axios';

    export default {
        props: {
        },
        data: function() {
            return {
                selectedBatteryId: 0,
                onAjaxRequesting: false,
                errorMsg: "",
                isLoaded: false,
                emailText: "",
                lastEmailBattery: {},
            }
        },
        async mounted() {
            this.$nextTick(() => {
                if (this.batteries.length) {
                    this.selectedBatteryId = this.batteries[0].id;
                }
            })
            axios.get(`/api/dashboard/lastBatteryEmail/${this.selectedClient}`).then((response) => {
                this.lastEmailBattery = response.data;
            })
        },
        methods: {
            ...mapActions({
                sendEmailBattery: 'userDashboard/sendEmailBattery',
            }),
            handleSendBattery: async function () {
                const data = {
                    clientId: this.selectedClient,
                    batteryId: this.selectedBatteryId
                }
                const response = await this.sendEmailBattery(data);
                this.onAjaxRequesting = false;
                if (response.exception || response.error) {
                    this.message = response.message;
                } else {
                    this.$refs.send_email_modal.hide();
                    this.$refs.email_send_success.show();
                }
            }
        },
        computed: {
            ...mapState({
                batteries: (state) => state.userDashboard.batteries,
                selectedClient: (state) => state.userDashboard.selectedClient,
            })
        }
    }
</script>
