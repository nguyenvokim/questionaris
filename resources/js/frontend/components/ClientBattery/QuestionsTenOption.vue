<template>
    <div class="question_ten_block">
        <h5 class="question_ten_title">{{question.title}}</h5>
        <div class="question_content">
            <div class="start_text">{{question.config.startText}}</div>
            <div class="answers">
                <label v-for="(label, index) in labels" @click="selectAnswer(index)">
                    <div class="title">{{label}}</div>
                    <div class="answer_box">
                        <div class="answer_ele" v-bind:class="{active: score === scores[index]}"></div>
                    </div>
                </label>
            </div>
            <div class="end_text">{{question.config.endText}}</div>
        </div>
    </div>
</template>

<script>

    import { mapActions, mapState, mapMutations } from 'vuex';
    import { format, compareAsc } from 'date-fns';
    import CONST from '../../const';


    export default {
        components: {},
        props: {
            question: Object,
            index: Number
        },
        data: function() {
            return {
                scores: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                labels: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                score: -1
            }
        },
        async mounted() {
            if (this.question.config.isReverser) {
                this.scores = [10, 9, 8, 7, 6, 5, 4, 3, 2, 1, 0]
            }
        },
        methods: {
            ...mapActions({
            }),
            ...mapMutations({
                setAnswer: 'clientBattery/setAnswer'
            }),
            selectAnswer: function (index) {
                this.score = this.scores[index];
                this.setAnswer({
                    testId: this.question.test_id,
                    questionId: this.question.id,
                    score: this.score
                });
            }
        },
        computed: {
            ...mapState({
                answers: state => state.clientBattery.answers
            })
        }
    }
</script>
