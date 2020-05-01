export default {
    mounted() {
        document.addEventListener('keydown', this.handleKeyPress)
    },
    computed: {
    },
    methods: {
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
                    //Arrow left
                    e.preventDefault();
                    if (this.focusAnswer.answerIndex > 0) {
                        this.setFocusAnswer({
                            ...this.focusAnswer,
                            answerIndex: this.focusAnswer.answerIndex - 1
                        })
                    }
                }
                if (e.keyCode === 39) {
                    //Arrow right
                    e.preventDefault();
                    if (this.scores[this.focusAnswer.answerIndex + 1]) {
                        this.setFocusAnswer({
                            ...this.focusAnswer,
                            answerIndex: this.focusAnswer.answerIndex + 1
                        })
                    }
                }
                if (e.keyCode === 32) {
                    //Space
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