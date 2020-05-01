<template>
    <div id="form_battery">
        <validation-box v-if="!client.id && !isFinished"></validation-box>
        <div class="row justify-content-center align-items-center" v-if="client.id && !isFinished">
            <div class="col col-sm-12 col-md-10 align-self-center">
                <div class="card">
                    <div class="card-header">
                        <h2>{{battery.name}}</h2>
                    </div>
                    <div class="card-body">
                        <div v-for="test in tests" v-if="currentDisplayTestId === test.id">
                            <div class="test_description" v-html="test.description"></div>
                            <test :key="test.id"
                                  :test="test"
                                  :test-id="test.id"
                                  :questions="test.questions"
                            />
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-dark" @click="prevTest" v-if="currentTestIndex !== 0">
                            <i class="fa fa-fw fa-caret-left"></i> Back
                        </button>
                        <button class="btn btn-success" @click="nextTest" v-if="currentTestIndex !== tests.length - 1">
                            <i class="fa fa-fw fa-caret-right"></i> Next
                        </button>
                        <button class="btn btn-primary" @click="sendAnswer" v-if="currentTestIndex === tests.length - 1">
                            <i class="fa fa-fw fa-save"></i> Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center align-items-center" v-if="isFinished">
            <div class="col col-sm-12 col-md-10 align-self-center">
                <div class="card">
                    <div class="card-header">
                        <h2>THANK YOU</h2>
                    </div>
                    <div class="card-body">
                        <h5>Your responses have been saved</h5>
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
            batteryId: {
                type: Number,
                default: 0
            }
        },
        data: function() {
            return {
                isLoaded: false,
                isFinished: false,
                onRequestSaving: false,
                testIndex: 0
            }
        },
        async mounted() {
            this.setBatteryId(this.batteryId);
            this.$nextTick(() => {

            });
            document.addEventListener('keydown', this.handleKeyPress)
        },
        methods: {
            ...mapActions('clientBattery', ['validateClient', 'sendSaveAnswer']),
            ...mapMutations('clientBattery', ['setCurrentDisplayTestId', 'setBatteryId', 'setFocusAnswer']),
            nextTest: function () {
                if (this.currentTestIndex !== -1 && this.tests[this.currentTestIndex + 1]) {
                    this.setCurrentDisplayTestId(this.tests[this.currentTestIndex + 1].id);
                    this.$nextTick(() => {
                        this.setFocusOnCurrentTest();
                    });
                }
            },
            prevTest: function () {
                if (this.currentTestIndex !== -1 && this.tests[this.currentTestIndex - 1]) {
                    this.setCurrentDisplayTestId(this.tests[this.currentTestIndex - 1].id);
                    this.$nextTick(() => {
                        this.setFocusOnCurrentTest();
                    });
                }
            },
            checkIsHiddenQuestion: function(testId, questionId) {
                const test = this.tests.find(t => {
                    return t.id == testId;
                });
                if (!test) {
                    return false;
                }
                if (!test.config.hiddenQuestionIds) {
                    return false;
                }
                return test.config.hiddenQuestionIds.includes(parseInt(questionId));
            },
            sendAnswer: function () {
                //Validate answers got all response
                if (this.onRequestSaving) {
                    return;
                }
                let allQuestionGotAnswer = true;
                Object.keys(this.answers).forEach((testId) => {
                    Object.keys(this.answers[testId]).forEach((questionId) => {
                        const isHiddenQuestion = this.checkIsHiddenQuestion(testId, questionId);
                        if (!isHiddenQuestion && this.answers[testId][questionId] === -1) {
                            allQuestionGotAnswer = false;
                        }
                    })
                });
                if (!allQuestionGotAnswer) {
                    this.$refs.notice_modal.show();
                    return;
                }
                this.onRequestSaving = true;
                this.sendSaveAnswer({
                    clientId: this.client.id,
                    testResultData: this.answers
                }).then(() => {
                    this.isFinished = true;
                    this.onRequestSaving = false;
                })
            },
            handleKeyPress: function (e) {
                const test = this.tests[this.currentTestIndex];
                if (!test) {
                    return;
                }
                const question = test.questions[this.focusAnswer.questionIndex];
                if (e.keyCode === 9) { // Tab button
                    e.preventDefault();
                    if (this.isAbleToJumpQuestion(question, test.questions[this.focusAnswer.questionIndex + 1])) {
                        this.setFocusAnswer({
                            ...this.focusAnswer,
                            answerIndex: 0,
                            questionIndex: this.focusAnswer.questionIndex + 1
                        })
                    }
                }
                if (e.keyCode === 40) { // Key down
                    e.preventDefault();
                    if (this.isAbleToJumpQuestion(question, test.questions[this.focusAnswer.questionIndex + 1])) {
                        this.setFocusAnswer({
                            ...this.focusAnswer,
                            questionIndex: this.focusAnswer.questionIndex + 1
                        })
                    }
                }
                if (e.keyCode === 38) { // Key up
                    e.preventDefault();
                    if (this.isAbleToJumpQuestion(question, test.questions[this.focusAnswer.questionIndex - 1])) {
                        this.setFocusAnswer({
                            ...this.focusAnswer,
                            questionIndex: this.focusAnswer.questionIndex - 1
                        })
                    }
                }
            },
            isAbleToJumpQuestion: function(fromQuestion, toQuestion) {
                if (!toQuestion) return false;

                return true;
            },
            setFocusOnCurrentTest: function () {
                this.setFocusAnswer({
                    testId: this.currentDisplayTestId,
                    answerIndex: 0,
                    questionIndex: 0
                });
            }
        },
        computed: {
            ...mapState('clientBattery', [
                'client',
                'clientBattery',
                'tests',
                'battery',
                'answers',
                'currentDisplayTestId',
                'focusAnswer',
            ]),
            currentTestIndex: function () {
                return this.tests.findIndex((test) => {
                    return test.id === this.currentDisplayTestId;
                });
            }
        },
        destroyed: function () {
            document.removeEventListener('keydown', this.handleKeyPress);
        }
    }
</script>
