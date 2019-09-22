<template>
    <div class="question_four_block" v-bind:class="{gray: index % 2 === 1}">
        <div class="title">
            {{question.title}}
        </div>
        <div class="item" v-for="scoreEle in scores">
            <div class="answer_box" @click="selectAnswer(scoreEle)">
                <div class="answer_ele" v-bind:class="{active: score === scoreEle}"></div>
            </div>
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
                scores: [0, 1, 2, 3],
                score: -1
            }
        },
        async mounted() {
            if (this.initScore !== -1) {
                this.score = this.initScore;
            }
            console.log(this.score);
        },
        methods: {
            ...mapActions({
            }),
            ...mapMutations({
                setAnswer: 'clientBattery/setAnswer'
            }),
            selectAnswer: function (scoreEle) {
                if (this.viewOnly) {
                    return;
                }
                this.score = scoreEle;
                this.setAnswer({
                    testId: this.question.test_id,
                    questionId: this.question.id,
                    score: this.score
                });
            }
        },
        computed: {
            ...mapState({
            })
        }
    }
</script>
