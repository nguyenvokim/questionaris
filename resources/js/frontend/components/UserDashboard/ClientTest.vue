<template>
    <div class="padding_8" v-if="loaded">
        <div v-if="finishedTests.length">
<!--            <h5>Tests completed by this client</h5>-->
<!--            <div class="row">-->
<!--                <div :key="finishedTest.id" v-for="finishedTest in finishedTests" class="col-sm-4 col-md-3">-->
<!--                    <a v-bind:class="{'font-weight-bold': finishedTest.id === selectedTestId}" href="javascript:void(0)" @click="assignTestId(finishedTest.id)">{{finishedTest.title}}</a>-->
<!--                </div>-->
<!--            </div>-->
            <client-tes-result v-if="selectedTestId" :key="selectedTestId"></client-tes-result>
            <client-test-result-chart :key="`chart_${selectedTestId}`"></client-test-result-chart>
        </div>
        <div v-if="!finishedTests.length">
            <h5>This client has not completed any tests yet!</h5>
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
            await this.loadClientTestsInfo(this.selectedClient);
            this.loaded = true;
            this.$nextTick(() => {
                if (!this.selectedTestId && this.finishedTests.length > 0) {
                    this.setSelectedTestId(this.finishedTests[0].id);
                }
            })
        },
        methods: {
            ...mapActions('userDashboard', ['loadClientTestsInfo']),
            ...mapMutations('userDashboard', ['setSelectedTestId', 'setDetailTestResults']),
            assignTestId: function (testId) {
                this.setSelectedTestId(testId);
            }
        },
        computed: {
            ...mapState('userDashboard', ['selectedClient', 'client', 'finishedTests', 'selectedTestId'])
        }
    }
</script>
