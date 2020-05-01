export default {
    methods: {
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
            const answerIndex = this.scores.indexOf(scoreEle);
            if (answerIndex !== this.selectAnswer.answerIndex || this.index !== this.focusAnswer.questionIndex) {
                this.setFocusAnswer({
                    ...this.focusAnswer,
                    answerIndex: answerIndex,
                    questionIndex: this.index
                })
            }
        }
    }
}