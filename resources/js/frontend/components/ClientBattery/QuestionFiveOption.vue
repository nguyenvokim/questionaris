<template>
    <div class="question_five_block" v-bind:class="{gray: index % 2 === 1}">
        <div class="title">
            {{question.title}}
        </div>
        <div class="item" v-for="(scoreEle, index) in scores">
            <div class="answer_box" @click="selectAnswer(scoreEle)" v-bind:class="getCssClass(scoreEle, index)">
                <div class="answer_ele"></div>
            </div>
        </div>
    </div>
</template>

<script>

    import { mapActions, mapState, mapMutations } from 'vuex';
    import questionRatioMixing from './questionRatioMixing';
    import selectAnswerMixing from './selectAnswerMixing';
    import CONST from '../../const';


    export default {
        components: {},
        mixins: [questionRatioMixing, selectAnswerMixing],
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
                scores: [1, 2, 3, 4, 5],
                score: -1,
            }
        },
        async mounted() {
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
            ...mapMutations('clientBattery', ['setFocusAnswer', 'setAnswer'])
        },
        computed: {
            ...mapState('clientBattery', ['answers', 'focusAnswer'])
        }
    }
</script>
