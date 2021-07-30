<template>
    <div class="padding_8" v-if="detailTestResults.length">
        <div class="test_dass" v-if="isViewDassType(selectedTestId)">
            <table class="table table-striped" v-if="firstDetailTestResult.config">
                <tr>
                    <th>
                        Date
                        <button class="btn btn-transparent float-right" @click="toggleSort">
                            <i v-if="sort === CONST.SORT_UP" class="fa fa-caret-up"></i>
                            <i v-if="sort === CONST.SORT_DOWN" class="fa fa-caret-down"></i>
                        </button>
                    </th>
                    <th class="text-center" v-for="item in firstDetailTestResult.config.summaryOptions">
                        {{item.name}}
                    </th>
                    <th class="text-center">Total</th>
                </tr>
                <tr v-for="detailTestResult in sortedDetailTestResults">
                    <td>
                        <button @click="showDetailTestResult(detailTestResult.id)" class="btn btn-transparent text-primary">
                            <i class="fa fa-fw fa-search"></i>
                            {{displayCreatedDate(detailTestResult.created_at)}}
                        </button>
                    </td>
                    <td class="text-center" v-for="(item, index) in detailTestResult.config.summaryOptions">
                        {{item.score}}<br/>
                        {{getScoreDescription(index, item.score)}}
                    </td>
                    <td class="text-center">{{detailTestResult.config.score}}</td>
                </tr>
            </table>
        </div>
        <div class="test_sida" v-if="isViewSidaType(selectedTestId)">
            <table class="table table-striped" v-if="firstDetailTestResult.config">
                <tr>
                    <th>
                        Date
                        <button class="btn btn-transparent float-right" @click="toggleSort">
                            <i v-if="sort === CONST.SORT_UP" class="fa fa-caret-up"></i>
                            <i v-if="sort === CONST.SORT_DOWN" class="fa fa-caret-down"></i>
                        </button>
                    </th>
                    <th class="text-center small">Frequency of thoughts</th>
                    <th class="text-center small">Control over thoughts</th>
                    <th class="text-center small">How close to attempt</th>
                    <th class="text-center small">Tormented by thoughts</th>
                    <th class="text-center small">Interference with activities</th>
                    <th class="text-center">Total</th>
                </tr>
                <tr v-for="detailTestResult in sortedDetailTestResults">
                    <td>
                        <button @click="showDetailTestResult(detailTestResult.id)" class="btn btn-transparent text-primary">
                            <i class="fa fa-fw fa-search"></i>
                            {{displayCreatedDate(detailTestResult.created_at)}}
                        </button>
                    </td>
                    <td class="text-center" v-for="testResultQuestion in detailTestResult.test_result_questions">
                        {{testResultQuestion.score}}
                    </td>
                    <td class="text-center">{{detailTestResult.config.score}}</td>
                </tr>
            </table>
        </div>
        <div class="test_k10" v-if="isViewK10Type(selectedTestId)">
            <table class="table table-striped" v-if="firstDetailTestResult.config">
                <tr>
                    <th>
                        Date
                        <button class="btn btn-transparent float-right" @click="toggleSort">
                            <i v-if="sort === CONST.SORT_UP" class="fa fa-caret-up"></i>
                            <i v-if="sort === CONST.SORT_DOWN" class="fa fa-caret-down"></i>
                        </button>
                    </th>
                    <th class="text-center">Score</th>
                </tr>
                <tr v-for="detailTestResult in sortedDetailTestResults">
                    <td>
                        <button @click="showDetailTestResult(detailTestResult.id)" class="btn btn-transparent text-primary">
                            <i class="fa fa-fw fa-search"></i>
                            {{displayCreatedDate(detailTestResult.created_at)}}
                        </button>
                    </td>
                    <td class="text-center">{{detailTestResult.config.score}}</td>
                </tr>
            </table>
        </div>
        <b-modal size="lg" ref="test_result_detail" id="test_result_detail" ok-only title="Test completion details">
            <div v-if="clientDetailTestResult.id">
                <client-test-result-detail
                        :key="clientDetailTestResult.id"
                        :test="clientDetailTestResult"
                        :test-id="clientDetailTestResult.id"
                        :questions="clientDetailTestResult.test_result_questions"
                        :view-only="true"
                        :result-score="clientDetailTestResult.config.score"
                />
            </div>
        </b-modal>
    </div>
</template>

<script>

    import { mapActions, mapState, mapMutations } from 'vuex';
    import ClientTestResultDetail from '../ClientBattery/Test';
    import { format, compareAsc, parse } from 'date-fns';
    import CONST from '../../const';
    import userDashboardMixin from './userDashboardMixin';

    export default {
        components: {ClientTestResultDetail},
        mixins: [userDashboardMixin],
        props: {
        },
        data: function() {
            return {
                CONST: CONST,
                firstDetailTestResult: {},
                dassStressLevels: [
                    [
                        {
                            from: 0,
                            to: 4,
                            text: 'Normal'
                        },
                        {
                            from: 5,
                            to: 6,
                            text: 'Mild'
                        },
                        {
                            from: 7,
                            to: 10,
                            text: 'Moderate'
                        },
                        {
                            from: 11,
                            to: 13,
                            text: 'Severe'
                        },
                        {
                            from: 14,
                            to: 9999,
                            text: 'Extremely Severe'
                        },
                    ],
                    [
                        {
                            from: 0,
                            to: 3,
                            text: 'Normal'
                        },
                        {
                            from: 4,
                            to: 5,
                            text: 'Mild'
                        },
                        {
                            from: 6,
                            to: 7,
                            text: 'Moderate'
                        },
                        {
                            from: 8,
                            to: 9,
                            text: 'Severe'
                        },
                        {
                            from: 10,
                            to: 9999,
                            text: 'Extremely Severe'
                        },
                    ],
                    [
                        {
                            from: 0,
                            to: 7,
                            text: 'Normal'
                        },
                        {
                            from: 8,
                            to: 9,
                            text: 'Mild'
                        },
                        {
                            from: 10,
                            to: 12,
                            text: 'Moderate'
                        },
                        {
                            from: 13,
                            to: 16,
                            text: 'Severe'
                        },
                        {
                            from: 14,
                            to: 9999,
                            text: 'Extremely Severe'
                        },
                    ],
                ],
                sort: CONST.SORT_DOWN,
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
            ...mapActions('userDashboard', ['loadClientTestResult', 'loadClientDetailTestResult']),
            ...mapMutations('userDashboard', ['setClientDetailTestResult']),
            showDetailTestResult: function (testResultId) {
                this.setClientDetailTestResult({id: 0});
                this.loadClientDetailTestResult(testResultId);
                this.$refs.test_result_detail.show();
            },
            getScoreDescription: function (index, score) {
                const dassStressLevel = this.dassStressLevels[index];
                const foundLevel = dassStressLevel.find((level) => {
                    return level.to >= score && level.from <= score;
                });
                if (foundLevel) {
                    return foundLevel.text;
                } else {
                    return '';
                }
            },
            displayCreatedDate: function (createdAt) {
                return format(new Date(createdAt), 'dd-MM-yyyy');
            },
            toggleSort: function () {
                if (this.sort === CONST.SORT_DOWN) {
                    this.sort = CONST.SORT_UP;
                } else {
                    this.sort = CONST.SORT_DOWN;
                }
            }
        },
        computed: {
            ...mapState('userDashboard', ['detailTestResults', 'selectedTestId', 'selectedClient', 'clientDetailTestResult']),
            sortedDetailTestResults: function () {
                if (!this.detailTestResults) {
                    return [];
                }
                const detailTestResults = [...this.detailTestResults];
                return detailTestResults.sort((a, b) => {
                    const dateA = new Date(a.created_at);
                    const dateB = new Date(b.created_at);
                    if (this.sort === 'up') {
                        return compareAsc(dateA, dateB);
                    } else {
                        return compareAsc(dateB, dateA);
                    }
                });
            }
        }
    }
</script>
