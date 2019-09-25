<template>
    <div class="">
        <div class="question_four_block" v-if="test.config.isShowHeaderTable">
            <div class="title"></div>
            <div class="item">0 - Never</div>
            <div class="item">1 - Sometimes</div>
            <div class="item">2 - Often</div>
            <div class="item">3 - Almost Always</div>
        </div>
        <div class="" :key="question.id" v-for="(question, index) in questions">
            <questions-four-option
                    v-if="question.type === CONST.QUESTION_TYPE_FOUR_OPTION"
                    :question="question"
                    :index="index"
            />
            <div v-if="question.type === CONST.QUESTION_TYPE_TEN_OPTION">
                <questions-ten-option
                        :question="question"
                        :index="index"
                />
            </div>
        </div>
    </div>
</template>

<script>

    import { mapActions, mapState, mapMutations } from 'vuex';
    import { format, compareAsc } from 'date-fns';
    import CONST from '../../const';
    import QuestionsFourOption from './QuestionsFourOption';
    import QuestionsTenOption from './QuestionsTenOption';


    export default {
        components: {QuestionsFourOption, QuestionsTenOption},
        props: {
            questions: Array,
            testId: Number,
            test: Object,
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

        },
        computed: {
            ...mapState({
            })
        }
    }
</script>
