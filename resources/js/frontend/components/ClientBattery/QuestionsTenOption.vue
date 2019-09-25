<template>
    <div class="question_ten_block">
        <h5 class="question_ten_title">{{question.title}}</h5>
        <div class="question_content">
            <div class="start_text">{{question.config.startText}}</div>
            <div class="answers">
                <label v-for="(label, index) in labels" @click="selectAnswer(scores[index])">
                    <div class="title">{{label}}</div>
                    <div class="answer_box" v-bind:class="getCssClass(scores[index], index)">
                        <div class="answer_ele"></div>
                    </div>
                </label>
            </div>
            <div class="end_text">{{question.config.endText}}</div>
        </div>
    </div>
</template>

<script>

    import { mapActions, mapState, mapMutations } from 'vuex';
    import clientBatteryMixing from './clientBatteryMixing';
    import CONST from '../../const';


    export default {
        components: {},
        mixins: [clientBatteryMixing],
        props: {
            question: Object,
            index: Number,
            viewOnly: {
                type: Boolean,
                default: false
            },
            initScore: {
                type: Number,
                default: -1
            }
        },
        data: function() {
            return {
                scores: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                labels: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                score: -1,
            }
        },
        async mounted() {
            if (this.question.config.isReverser) {
                this.scores = [10, 9, 8, 7, 6, 5, 4, 3, 2, 1, 0]
            }
            if (this.initScore !== -1) {
                this.score = this.initScore;
            } else {
                if (this.answers[this.question.test_id] && this.answers[this.question.test_id][this.question.id] !== -1) {
                    this.score = this.answers[this.question.test_id][this.question.id]
                }
            }
        },
        methods: {
            ...mapActions({
            }),
            ...mapMutations({
                setAnswer: 'clientBattery/setAnswer',
                setFocusAnswer: 'clientBattery/setFocusAnswer'
            }),
        },
        computed: {
            ...mapState({
                answers: state => state.clientBattery.answers,
                focusAnswer: state => state.clientBattery.focusAnswer
            })
        }
    }
</script>
