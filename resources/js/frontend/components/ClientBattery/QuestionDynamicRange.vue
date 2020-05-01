<template>
    <div class="question_dymamic_range" v-bind:class="{gray: index % 2 === 1}">
        <div class="title">
            {{question.title}}
        </div>
        <div class="item">
            <select :disabled="viewOnly" class="form-control" @change="handleChange" v-model="score">
                <option v-for="scoreEle in scores" :value="scoreEle">{{scoreEle}}</option>
            </select>
        </div>
    </div>
</template>

<script>

    import { mapActions, mapState, mapMutations } from 'vuex';
    import selectAnswerMixing from './selectAnswerMixing'
    import CONST from '../../const';


    export default {
        components: {},
        mixins: [selectAnswerMixing],
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
                score: 0,
            }
        },
        async mounted() {
            if (this.initScore !== -1) {
                this.score = this.initScore;
            } else {
                if (this.answers[this.question.test_id]) {
                    this.score = this.answers[this.question.test_id][this.question.id]
                }

            }
        },
        methods: {
            ...mapActions({
            }),
            ...mapMutations('clientBattery', ['setFocusAnswer', 'setAnswer']),
            handleChange: function () {
                this.selectAnswer(this.score);
            }
        },
        computed: {
            ...mapState('clientBattery', ['answers', 'focusAnswer']),
            scores: function () {
                const arr = [];
                for (let i = this.question.config.start; i <= this.question.config.end; i++) {
                    arr.push(i);
                }
                return arr;
            }
        }
    }
</script>
