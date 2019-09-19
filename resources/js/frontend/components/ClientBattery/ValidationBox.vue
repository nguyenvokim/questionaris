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
                                <datepicker v-model="birthDate" placeholder="Select Birth Date" :input-class="'form-control'"></datepicker>
                            </div>
                            <div class="form-group">
                                <button @click="startValidate" class="btn btn-success">Login</button>
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
                birthDate: Date.now(),
                errorMsg: ""
            }
        },
        async mounted() {
            this.$nextTick(() => {

            })
        },
        methods: {
            ...mapActions({
                validateClient: 'clientBattery/validateClient'
            }),
            ...mapMutations({
                setInitAnswers: 'clientBattery/setInitAnswers',
                setCurrentDisplayTestId: 'clientBattery/setCurrentDisplayTestId',
            }),
            startValidate: async function () {
                const response = await this.validateClient({
                    personal_code: this.personalCode,
                    birth_date: format(this.birthDate, 'yyyy-MM-dd')
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
                                    resultTemplate[test.id][question.id] = 0;
                                    break;
                                case CONST.QUESTION_TYPE_TEN_OPTION:
                                    resultTemplate[test.id][question.id] = 0;
                                    break;
                            }
                        })
                    })
                    this.setInitAnswers(resultTemplate);
                }
            }
        },
        computed: {
            ...mapState({
                client: (state) => state.clientBattery.client,
                clientBattery: (state) => state.clientBattery.clientBattery,
                tests: (state) => state.clientBattery.tests,
                battery: (state) => state.clientBattery.battery,
            })
        }
    }
</script>
