<template>
    <div class="padding_8" v-if="detailTestResults.length">
        <div class="test_dass" v-if="selectedTestId === 1">
            <table class="table table-striped" v-if="firstDetailTestResult.config">
                <tr>
                    <th>Date</th>
                    <th v-for="item in firstDetailTestResult.config.summaryOptions">
                        {{item.name}}
                    </th>
                    <th>Score</th>
                </tr>
                <tr v-for="detailTestResult in detailTestResults">
                    <td>
                        <button @click="showDetailTestResult(detailTestResult.id)" class="btn btn-transparent">
                            <i class="fa fa-fw fa-search"></i>
                            {{detailTestResult.created_at}}
                        </button>
                    </td>
                    <td v-for="item in detailTestResult.config.summaryOptions">
                        {{item.score}}
                    </td>
                    <td>{{detailTestResult.config.score}}</td>
                </tr>
            </table>
        </div>
        <div class="test_sida" v-if="selectedTestId === 2">
            <table class="table table-striped" v-if="firstDetailTestResult.config">
                <tr>
                    <th>Date</th>
                    <th>Score</th>
                </tr>
                <tr v-for="detailTestResult in detailTestResults">
                    <td>
                        <button @click="showDetailTestResult(detailTestResult.id)" class="btn btn-transparent">
                            <i class="fa fa-fw fa-search"></i>
                            {{detailTestResult.created_at}}
                        </button>
                    </td>
                    <td>{{detailTestResult.config.score}}</td>
                </tr>
            </table>
        </div>
        <b-modal size="lg" ref="test_result_detail" id="test_result_detail" ok-only title="Test result detail">
            <div v-if="clientDetailTestResult.id">
                <test-result
                        :key="clientDetailTestResult.id"
                        :test="clientDetailTestResult"
                        :test-id="clientDetailTestResult.id"
                        :questions="clientDetailTestResult.test_result_questions"
                />
            </div>
        </b-modal>
    </div>
</template>

<script>

    import { mapActions, mapState, mapMutations } from 'vuex';
    import TestResult from './TestResult';

    export default {
        components: {TestResult},
        props: {
        },
        data: function() {
            return {
                firstDetailTestResult: {}
            }
        },
        async mounted() {
            this.loadClientTestResult({
                clientId: this.selectedClient,
                testId: this.selectedTestId
            }).then(() => {
                this.firstDetailTestResult = this.detailTestResults[0];
            });
        },
        methods: {
            ...mapActions({
                loadClientTestResult: 'userDashboard/loadClientTestResult',
                loadClientDetailTestResult: 'userDashboard/loadClientDetailTestResult'
            }),
            ...mapMutations({
                setClientDetailTestResult: 'userDashboard/setClientDetailTestResult'
            }),
            showDetailTestResult: function (testResultId) {
                this.setClientDetailTestResult({id: 0});
                this.loadClientDetailTestResult(testResultId);
                this.$refs.test_result_detail.show();
            }
        },
        computed: {
            ...mapState({
                detailTestResults: (state) => state.userDashboard.detailTestResults,
                selectedTestId: (state) => state.userDashboard.selectedTestId,
                selectedClient: (state) => state.userDashboard.selectedClient,
                clientDetailTestResult: (state) => state.userDashboard.clientDetailTestResult,
            })
        }
    }
</script>
