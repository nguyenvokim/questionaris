<template>
    <div class="padding_8" v-if="loaded">
        <div v-if="finishedTests.length">
            <h5>Test finished by this clients</h5>
            <div class="row">
                <div :key="finishedTest.id" v-for="finishedTest in finishedTests" class="col-sm-4 col-md-3">
                    <a v-bind:class="{'font-weight-bold': finishedTest.id === selectedTestId}" href="javascript:void(0)" @click="assignTestId(finishedTest.id)">{{finishedTest.title}}</a>
                </div>
            </div>
            <client-tes-result v-if="selectedTestId" :key="selectedTestId"></client-tes-result>
            <client-test-result-chart :key="`chart_${selectedTestId}`"></client-test-result-chart>
        </div>
        <div v-if="!finishedTests.length">
            <h5>Client did not finished any test yet</h5>
        </div>
    </div>
</template>

<script>

    import { mapActions, mapState, mapMutations } from 'vuex';
    import ClientTesResult from './ClientTesResult';
    import ClientTestResultChart from './ClientTestResultChart';


    export default {
        components: {ClientTesResult, ClientTestResultChart},
        props: {
        },
        data: function() {
            return {
                loaded: false
            }
        },
        async mounted() {
            this.setDetailTestResults([]);
            this.loadClientTestsInfo(this.selectedClient).then(() => {
                this.loaded = true;
                this.$nextTick(() => {
                    if (this.finishedTests.length > 0) {
                        this.setSelectedTestId(this.finishedTests[0].id);
                    }
                })
            });
        },
        methods: {
            ...mapActions({
                loadClientTestsInfo: 'userDashboard/loadClientTestsInfo'
            }),
            ...mapMutations({
                setSelectedTestId: 'userDashboard/setSelectedTestId',
                setDetailTestResults: 'userDashboard/setDetailTestResults'
            }),
            assignTestId: function (testId) {
                this.setSelectedTestId(testId);
            }
        },
        computed: {
            ...mapState({
                selectedClient: (state) => state.userDashboard.selectedClient,
                client: (state) => state.userDashboard.client,
                finishedTests: (state) => state.userDashboard.finishedTests,
                selectedTestId: (state) => state.userDashboard.selectedTestId,
            })
        }
    }
</script>
