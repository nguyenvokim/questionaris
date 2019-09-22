<template>
    <div class="padding_8" v-if="detailTestResults.length > 1">
        <div class="row justify-content-center align-items-center">
            <div class="col col-sm-12 col-md-8 align-self-center">
                <apexchart width="100%" type="line" :options="options" :series="series"></apexchart>
            </div>
        </div>
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
        },
        methods: {
            ...mapActions({
            }),
            ...mapMutations({
            }),
        },
        computed: {
            ...mapState({
                selectedTestId: (state) => state.userDashboard.selectedTestId,
                detailTestResults: (state) => state.userDashboard.detailTestResults,
            }),
            options: function () {
                const categories = this.detailTestResults.map((detailTestResult) => {
                    return detailTestResult.created_at.substring(0, 10);
                });
                return {
                    chart: {
                        id: 'vuechart-example'
                    },
                    xaxis: {
                        categories,
                        title: {
                            text: "Date"
                        }
                    },
                    yaxis: {
                        title: {
                            text: "Score"
                        }
                    },
                    grid: {
                        xaxis: {
                            lines: {
                                show: true
                            }
                        },
                        padding: {
                            left: 24
                        }
                    }
                }
            },
            series: function () {
                if (this.selectedTestId === 2) {
                    const data = this.detailTestResults.map((detailTestResult) => {
                        return detailTestResult.config.score;
                    });
                    return [
                        {
                            name: 'Score',
                            data
                        }
                    ]
                } else if (this.selectedTestId === 1) {
                    const firstData = this.detailTestResults[0].config.summaryOptions;
                    const series = firstData.map((data) => {
                        return {
                            name: data.name,
                            data: []
                        }
                    });
                    this.detailTestResults.forEach((detailTestResult) => {
                        detailTestResult.config.summaryOptions.forEach((data, key) => {
                            series[key].data.push(data.score);
                        })
                    });
                    return series;
                }
                return [{
                    name: 'series-1',
                    data: [30, 40, 45, 50, 49, 60, 70, 91]
                }]
            }

        }
    }
</script>
