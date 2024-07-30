<template>
    <div>
        <div v-if="batteries.length === 0" class="form-inline">
            <label class="mr-sm-2">You do not have any battery yet, please create new one </label>
            <a href="/batteries/create" class="btn btn-primary">Create Battery</a>
        </div>
        <div v-if="batteries.length">
            <div class="row">
                <div class="col-sm-6">
                    <div v-if="finishedTests.length" class="form-inline">
                        <label class="mr-1">Displaying results for</label>
                        <select class="form-control" v-model="localSelectedTestId">
                            <option v-for="finishedTest in finishedTests" :value="finishedTest.id">{{finishedTest.title}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 text-right">
                    <button class="btn btn-success" v-b-modal="'send_email_modal'">
                        <i class="fa fa-fw fa-mail-bulk"></i> Email test/battery for client completion
                    </button>
                </div>
            </div>
        </div>
        <b-modal size="xl" ref="send_email_modal" id="send_email_modal" title="Email test/battery for client completion" @ok="handleSendBattery">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form">
                        <div v-if="errorMsg.length" role="alert" class="alert alert-danger">
                            {{errorMsg}}
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Select test/battery to email</label>
                            <div>
                                <select v-model="selectedBatteryId" class="form-control">
                                    <option v-for="battery in batteries" :value="battery.id">{{battery.name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Email Headline</label>
                            <div>
                                <input type="text" class="form-control" v-model="emailHeadline" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Email Text</label>
                            <div>
                                <textarea class="form-control" v-model="emailText" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Email Bottom Text</label>
                            <div>
                                <textarea class="form-control" v-model="emailFooterText" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="form-group" v-if="lastEmailBattery.id && false">
                            <strong><i>Last email has been sent to clent at: {{lastEmailBattery.created_at}}</i></strong>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <client-battery-email-preview
                        :headline="emailHeadline"
                        :body-text="emailText"
                        :footer-text="emailFooterText"></client-battery-email-preview>
                </div>
            </div>
        </b-modal>
        <b-modal ok-only ref="email_send_success" id="email_send_success" title="Email Successfully Sent!">
            <div class="form">
                <h5>{{client.first_name}}  should receive the email momentarily.</h5>
            </div>
        </b-modal>
    </div>
</template>

<script>

import {mapActions, mapMutations, mapState} from 'vuex';
    import axios from 'axios';
import ClientBatteryEmailPreview from "./ClientBatteryEmailPreview";

    export default {
        components: {ClientBatteryEmailPreview},
        props: {
        },
        data: function() {
            return {
                selectedBatteryId: 0,
                onAjaxRequesting: false,
                errorMsg: "",
                isLoaded: false,
                emailText: "",
                emailFooterText: "",
                emailHeadline: '',
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
            ...mapActions('userDashboard', ['sendEmailBattery']),
            ...mapMutations('userDashboard', ['setSelectedTestId']),
            handleSendBattery: async function () {
                const data = {
                    clientId: this.selectedClient,
                    batteryId: this.selectedBatteryId,
                    emailContent: this.emailText,
                    emailFooterContent: this.emailFooterText,
                    emailHeadline: this.emailHeadline
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
            ...mapState('userDashboard', ['batteries', 'selectedClient', 'finishedTests', 'selectedTestId', 'client', 'user']),
            localSelectedTestId: {
                get: function () {
                    return this.selectedTestId;
                },
                set: function (testId) {
                    this.setSelectedTestId(testId);
                }
            }
        },
        watch: {
            client: function () {
                this.emailHeadline = `Dear ${this.client.first_name},`;
                this.emailText = 'Please complete the questionnaire(s) as soon as possible, using the below link.';
                this.emailFooterText = `Thank you,\n${this.user.first_name} ${this.user.last_name} `;
            }
        }
    }
</script>
