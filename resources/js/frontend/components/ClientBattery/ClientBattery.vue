<template>
    <div>
        <validation-box v-if="!client.id"></validation-box>
        <div class="row justify-content-center align-items-center" v-if="client.id">
            <div class="col col-sm-8 align-self-center">
                <div class="card">
                    <div class="card-header">
                        <h2>{{battery.name}}</h2>
                    </div>
                    <div class="card-body">
                        <div v-for="test in tests" v-if="currentDisplayTestId === test.id">
                            <div class="test_description" v-html="test.description"></div>
                            <test :key="test.id"
                                  :test-id="test.id"
                                  :questions="test.questions"
                            />
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-dark" @click="prevTest">
                            <i class="fa fa-fw fa-caret-left"></i> Back
                        </button>
                        <button class="btn btn-success" @click="nextTest">
                            <i class="fa fa-fw fa-caret-right"></i> Next
                        </button>
                        <button class="btn btn-primary" @click="sendAnswer">
                            <i class="fa fa-fw fa-save"></i> Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <b-modal ref="notice_modal" id="notice_modal" title="Ops!!!" ok-only>
            <h5>Please answer all the questions</h5>
        </b-modal>
    </div>
</template>

<script>

    import { mapActions, mapState, mapMutations } from 'vuex';
    import ValidationBox from './ValidationBox';
    import Test from './Test';
    export default {
        components: {ValidationBox, Test},
        props: {
        },
        data: function() {
            return {
                isLoaded: false
            }
        },
        async mounted() {
            this.$nextTick(() => {

            })
        },
        methods: {
            ...mapActions({
                validateClient: 'clientBattery/validateClient'
            }),
            ...mapMutations({
                setCurrentDisplayTestId: 'clientBattery/setCurrentDisplayTestId',
            }),
            nextTest: function () {
                const currentTestIndex = this.tests.findIndex((test) => {
                    return test.id === this.currentDisplayTestId;
                });
                if (currentTestIndex !== -1 && this.tests[currentTestIndex + 1]) {
                    this.setCurrentDisplayTestId(this.tests[currentTestIndex + 1].id);
                }
            },
            prevTest: function () {
                const currentTestIndex = this.tests.findIndex((test) => {
                    return test.id === this.currentDisplayTestId;
                });
                console.log(currentTestIndex);
                if (currentTestIndex !== -1 && this.tests[currentTestIndex - 1]) {
                    this.setCurrentDisplayTestId(this.tests[currentTestIndex - 1].id);
                }
            },
            sendAnswer: function () {
                this.$refs.notice_modal.show();
            }
        },
        computed: {
            ...mapState({
                client: (state) => state.clientBattery.client,
                clientBattery: (state) => state.clientBattery.clientBattery,
                tests: (state) => state.clientBattery.tests,
                battery: (state) => state.clientBattery.battery,
                answers: state => state.clientBattery.answers,
                currentDisplayTestId: state => state.clientBattery.currentDisplayTestId,
            })
        }
    }
</script>
