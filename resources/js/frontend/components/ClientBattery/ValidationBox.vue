<template>
    <div class="row justify-content-center align-items-center">
        <div class="col col-sm-8 align-self-center">
            <div class="card">
                <div class="card-header">
                    <strong>Enter your personal code and birth date</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div v-if="errorMsg.length" role="alert" class="alert alert-danger">
                                {{errorMsg}}
                            </div>
                            <div class="form-group">
                                <label>Personal Code</label>
                                <input type="text" v-model="personalCode" placeholder="Enter personal code" maxlength="191" required="required" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Birth Date</label>
                                <custom-datepicker
                                        v-model="birthDate"
                                        format="dd-MM-yyyy"
                                        placeholder="dd-mm-yyyy"
                                        :input-class="'form-control'">
                                </custom-datepicker>
                            </div>
                            <div class="form-group">
                                <button @click="startValidate" class="btn btn-success">Start</button>
                            </div>
                        </div>
                    </div>
                </div>
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
        },
        data: function() {
            return {
                personalCode: "",
                birthDate: null,
                errorMsg: ""
            }
        },
        mounted() {
            document.addEventListener('keydown', this.handleKeyPress)
        },
        methods: {
            ...mapActions({
                validateClient: 'clientBattery/validateClient',
            }),
            ...mapMutations({
                setInitAnswers: 'clientBattery/setInitAnswers',
                setCurrentDisplayTestId: 'clientBattery/setCurrentDisplayTestId',
                setFocusAnswer: 'clientBattery/setFocusAnswer'
            }),
            startValidate: async function () {
                if (!this.birthDate) {
                    this.errorMsg = "Your birth date is not valid format";
                    setTimeout(() => {
                        this.errorMsg = "";
                    }, 6000);
                    return;
                }
                const response = await this.validateClient({
                    personalCode: this.personalCode,
                    birthDate: format(this.birthDate, 'yyyy-MM-dd'),
                    batteryId: this.batteryId
                });
                if (response.error) {
                    this.errorMsg = response.message;
                } else {
                    //build test result template
                    const resultTemplate = {};
                    this.setCurrentDisplayTestId(this.tests[0].id);
                    this.tests.forEach((test) => {
                        resultTemplate[test.id] = {};
                        test.questions.forEach((question) => {
                            switch (question.type) {
                                case CONST.QUESTION_TYPE_FOUR_OPTION:
                                    resultTemplate[test.id][question.id] = -1;
                                    break;
                                case CONST.QUESTION_TYPE_TEN_OPTION:
                                    resultTemplate[test.id][question.id] = -1;
                                    break;
                            }
                        })
                    })
                    this.setInitAnswers(resultTemplate);
                    this.setFocusAnswer({
                        testId: this.tests[0].id,
                        answerIndex: 0,
                        questionIndex: 0
                    });
                }
            },
            handleKeyPress: function (e) {
                if (e.keyCode === 13) { // Enter button
                    e.preventDefault();
                    this.startValidate();
                }
            }
        },
        computed: {
            ...mapState({
                client: (state) => state.clientBattery.client,
                clientBattery: (state) => state.clientBattery.clientBattery,
                tests: (state) => state.clientBattery.tests,
                battery: (state) => state.clientBattery.battery,
                batteryId: (state) => state.clientBattery.batteryId,
            })
        },
        destroyed: function () {
            document.removeEventListener('keydown', this.handleKeyPress);
        }
    }
</script>
