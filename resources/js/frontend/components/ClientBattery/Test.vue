<template>
    <div class="">
        <div class="" :key="question.id" v-for="(question, index) in questions">
            <questions-four-option v-if="question.type === CONST.QUESTION_TYPE_FOUR_OPTION" :question="question" :index="index"></questions-four-option>
            <div v-if="question.type === CONST.QUESTION_TYPE_TEN_OPTION">
                <questions-ten-option :question="question" :index="index"></questions-ten-option>
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
            testId: Number
        },
        data: function() {
            return {
                CONST: CONST
            }
        },
        async mounted() {
            console.log(this.questions);
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
