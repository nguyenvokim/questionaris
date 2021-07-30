<template>
    <div class="">
        <div class="question_four_block" v-if="showHeaderTestDASS21">
            <div class="title"></div>
            <div class="item">0 - Never</div>
            <div class="item">1 - Sometimes</div>
            <div class="item">2 - Often</div>
            <div class="item">3 - Almost Always</div>
        </div>
        <div class="question_five_block" v-if="showHeaderTestK10 || showHeaderTestK10Plus">
            <div class="title"><strong>In the past 4 weeks:</strong></div>
            <div class="item">None of the time</div>
            <div class="item">A little of the time</div>
            <div class="item">Some of the time</div>
            <div class="item">Most of the time</div>
            <div class="item">All of the time</div>
        </div>
        <div class="" :key="question.id" v-for="(question, index) in visibleQuestions">
            <questions-four-option
                    v-if="question.type === CONST.QUESTION_TYPE_FOUR_OPTION"
                    :question="question"
                    :index="question.index"
                    :view-only="viewOnly"
                    :init-score="question.score"
            />
            <question-five-option
                    v-if="question.type === CONST.QUESTION_TYPE_FIVE_OPTION"
                    :question="question"
                    :index="question.index"
                    :view-only="viewOnly"
                    :init-score="question.score"
            ></question-five-option>
            <div v-if="question.type === CONST.QUESTION_TYPE_TEN_OPTION">
                <questions-ten-option
                        :question="question"
                        :index="question.index"
                        :init-score="question.score"
                />
            </div>
            <div v-if="question.type === CONST.QUESTION_TYPE_DYNAMIC_RANGE_SELECTION">
                <question-dynamic-range
                        :question="question"
                        :index="question.index"
                        :view-only="viewOnly"
                        :init-score="question.score"
                />
            </div>
        </div>

        <template v-if="showHiddenQuestions">
            <div class="test_description mt-5" v-html="hiddenQuestionDescription"></div>
            <div class="" :key="question.id" v-for="(question, index) in hiddenQuestions">
                <questions-four-option
                        v-if="question.type === CONST.QUESTION_TYPE_FOUR_OPTION"
                        :question="question"
                        :index="question.index"
                        :view-only="viewOnly"
                        :init-score="question.score"
                />
                <question-five-option
                        v-if="question.type === CONST.QUESTION_TYPE_FIVE_OPTION"
                        :question="question"
                        :index="question.index"
                        :view-only="viewOnly"
                        :init-score="question.score"
                ></question-five-option>
                <div v-if="question.type === CONST.QUESTION_TYPE_DYNAMIC_RANGE_SELECTION">
                    <question-dynamic-range
                            :question="question"
                            :index="question.index"
                            :view-only="viewOnly"
                            :init-score="question.score"
                    />
                </div>
            </div>
        </template>
    </div>
</template>

<script>

    import { mapActions, mapState, mapMutations } from 'vuex';
    import { format, compareAsc } from 'date-fns';
    import CONST from '../../const';
    import QuestionsFourOption from './QuestionsFourOption';
    import QuestionsTenOption from './QuestionsTenOption';
    import QuestionFiveOption from './QuestionFiveOption';
    import QuestionDynamicRange from './QuestionDynamicRange';


    export default {
        components: {QuestionDynamicRange, QuestionFiveOption, QuestionsFourOption, QuestionsTenOption},
        props: {
            questions: Array,
            testId: Number,
            test: Object,
            viewOnly: {
                type: Boolean,
                default: false
            },
            resultScore: {
                type: Number,
                default: 0
            }
        },
        data: function() {
            return {
                CONST: CONST
            }
        },
        async mounted() {
            this.$nextTick(() => {

            })
        },
        methods: {
            ...mapActions({
            }),
            ...mapMutations({
            }),
            getInintalScore(score) {
                if (!this.viewOnly) {
                    return -1;
                }
                return score || -1;
            }
        },
        computed: {
            ...mapState('clientBattery', [
                'answers',
            ]),
            showHeaderTestDASS21: function() {
                return this.test.id === CONST.TEST_DASS_21_ID;
            },
            showHeaderTestK10: function () {
                return this.test.id === CONST.TEST_K10;
            },
            showHeaderTestK10Plus: function () {
                return this.test.id === CONST.TEST_K10_PLUS;
            },
            hadHiddenQuestion: function () {
                return this.test.config.hasHiddenQuestion === true;
            },
            hiddenQuestionIds: function () {
                if (!this.hadHiddenQuestion) {
                    return [];
                }
                return this.test.config.hiddenQuestionIds;
            },
            answer: function () {
                if (!this.answers[this.test.id]) {
                    return {};
                }
                return this.answers[this.test.id];
            },
            totalScore: function () {
                if (this.viewOnly) {
                    return this.resultScore;
                }
                //Could simple get total score of visibleQuestion, not sure
                if (!this.hadHiddenQuestion) {
                    return Object.keys(this.answer).reduce((total, questionId) => {
                        return total + this.answer[questionId];
                    }, 0)
                }
                return Object.keys(this.answer).reduce((total, questionId) => {
                    if (this.hiddenQuestionIds.includes(parseInt(questionId))) {
                        return total;
                    }
                    return total + this.answer[questionId];
                }, 0)
            },
            hiddenQuestionCondition: function () {
                if (!this.test.config.hiddenQuestionCondition) {
                    return {};
                }
                return this.test.config.hiddenQuestionCondition;
            },
            visibleQuestions: function () {
                const questions = this.questions.filter(question => {
                    if (!this.hadHiddenQuestion) {
                        return true;
                    }
                    let questionId = question.id;
                    if (question.question_id) {
                        questionId = question.question_id;
                    }
                    return !this.hiddenQuestionIds.includes(questionId);
                });
                let index = 0;
                return  questions.map(question => {
                    question.index = index;
                    index ++;
                    return question;
                })
            },
            hiddenQuestions: function () {
                const questions = this.questions.filter(question => {
                    if (!this.hadHiddenQuestion) {
                        return false;
                    }
                    let questionId = question.id;
                    if (question.question_id) {
                        questionId = question.question_id;
                    }
                    return this.hiddenQuestionIds.includes(questionId);
                });
                let startIndex = this.visibleQuestions.length;
                return  questions.map(question => {
                    question.index = startIndex;
                    startIndex ++;
                    return question;
                })
            },
            hiddenQuestionDescription: function () {
                if (!this.test.config.hiddenQuestionDescription) {
                    return '';
                }
                return this.test.config.hiddenQuestionDescription;
            },
            showHiddenQuestions: function () {
                if (!this.hadHiddenQuestion) {
                    return false;
                }
                if (this.hiddenQuestionCondition.type === 'SCORE') {
                    return this.totalScore >= this.hiddenQuestionCondition.value;
                }
                if (this.hiddenQuestionCondition.type === 'SCORE_LOWER') {
                    return this.totalScore < this.hiddenQuestionCondition.value;
                }

                return false;
            }
        }
    }
</script>
