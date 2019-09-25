export default {
    mounted() {
        document.addEventListener('keydown', this.handleKeyPress)
    },
    computed: {
    },
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
        },
        getCssClass: function (scoreEle, answerIndex) {
            if (this.score === scoreEle) {
                return {
                    active: true
                }
            };
            if (this.viewOnly) return {};
            return  {
                focus: this.question.test_id === this.focusAnswer.testId && this.index === this.focusAnswer.questionIndex && answerIndex === this.focusAnswer.answerIndex
            };
        },
        handleKeyPress: function (e) {
            if (this.question.test_id === this.focusAnswer.testId && this.index === this.focusAnswer.questionIndex) {
                if (e.keyCode === 37) {
                    e.preventDefault();
                    if (this.focusAnswer.answerIndex > 0) {
                        this.setFocusAnswer({
                            ...this.focusAnswer,
                            answerIndex: this.focusAnswer.answerIndex - 1
                        })
                    }
                }
                if (e.keyCode === 39) {
                    e.preventDefault();
                    if (this.scores[this.focusAnswer.answerIndex + 1]) {
                        this.setFocusAnswer({
                            ...this.focusAnswer,
                            answerIndex: this.focusAnswer.answerIndex + 1
                        })
                    }
                }
                if (e.keyCode === 32) {
                    e.preventDefault();
                    this.selectAnswer(this.scores[this.focusAnswer.answerIndex]);
                }
            }
        }
    },
    destroyed: function () {
        document.removeEventListener('keydown', this.handleKeyPress);
    }
}