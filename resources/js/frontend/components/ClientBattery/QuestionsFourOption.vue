<template>
    <div class="question_four_block" v-bind:class="{gray: index % 2 === 1}">
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
                scores: [0, 1, 2, 3],
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
