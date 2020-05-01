import CONST from '../../const';

export default {
    methods: {
        isViewDassType: function (testId) {
            return this.dassTypeTests.includes(testId);
        },
        isViewSidaType: function (testId) {
            return this.sidasTypeTests.includes(testId);
        },
        isViewK10Type: function (testId) {
            return this.k10TypeTests.includes(testId);
        },
    },
    computed: {
        dassTypeTests: function () {
            return [
                CONST.TEST_DASS_21_ID,
            ];
        },
        sidasTypeTests: function () {
            return [
                CONST.TEST_SIDAS_ID
            ]
        },
        k10TypeTests: function () {
            return [
                CONST.TEST_K10,
                CONST.TEST_K10_PLUS
            ]
        }
    }
}