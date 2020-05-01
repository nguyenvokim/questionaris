<template>
    <div class="padding_8" v-if="detailTestResults && detailTestResults.length > 1">
        <div class="row justify-content-center align-items-center">
            <div class="col col-sm-12 col-md-8 align-self-center">
                <apexchart width="100%" type="line" :options="options" :series="series"></apexchart>
            </div>
        </div>
    </div>
</template>

<script>

    import { mapActions, mapState, mapMutations } from 'vuex';
    import { format, compareAsc } from 'date-fns';
    import userDashboardMixin from './userDashboardMixin';
    import CONST from '../../const';

    export default {
        components: {},
        props: {
        },
        mixins: [userDashboardMixin],
        data: function() {
            return {
                CONST,
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
            ...mapState('userDashboard', ['selectedTestId', 'detailTestResults', 'finishedTests']),
            currentTestName: function() {
                const test = this.finishedTests.find((test) => {
                    return test.id === this.selectedTestId;
                });
                if (test) {
                    return test.title;
                } else {
                    return '';
                }
            },
            options: function () {
                const categories = this.detailTestResults.map((detailTestResult) => {
                    return format(new Date(detailTestResult.created_at), 'dd-MM-yyyy');
                });
                return {
                    title: {
                        text: this.currentTestName,
                        align: 'center'
                    },
                    stroke: {
                        curve: 'smooth'
                    },
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
                            left: 24,
                            right: 16
                        }
                    },
                    markers: {
                        size: 6
                    },
                }
            },
            series: function () {
                if (this.isViewSidaType(this.selectedTestId) || this.isViewK10Type(this.selectedTestId)) {
                    const data = this.detailTestResults.map((detailTestResult) => {
                        return detailTestResult.config.score;
                    });
                    return [
                        {
                            name: 'Score',
                            data
                        }
                    ]
                } else if (this.isViewDassType(this.selectedTestId)) {
                    const firstData = this.detailTestResults[0].config.summaryOptions;
                    if (!firstData) {
                        return;
                    }
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
