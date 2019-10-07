<template>
    <div class="custom_datepicker_wrapper">
        <div>
            <datepicker
                    :selected="handleSelectedDate"
                    ref="datepicker"
                    :typeable="true"
                    :input-class="'form-control zero_width inline_block'"
                    v-model="value"
            />
        </div>
        <div class="input_box">
            <input ref="mainInput" @change="checkValidDate" @blur="hideDatepicker" :placeholder="placeholder" :name="name" @click="showDatepicker" type="text" :value="displayDate()" :class="`${inputClass} inline_block`" />
        </div>
    </div>
</template>

<script>
    import { format, compareAsc, parse } from 'date-fns';
    export default {
        components: {},
        props: {
            initValue: {
                type: String,
                default: null
            },
            format: {
                type: String,
                default: 'yyyy-MM-dd'
            },
            name:  {
                type: String,
                default: ''
            },
            placeholder: {
                type: String,
                default: 'Please select date'
            },
            inputClass: {
                type: String,
                default: 'form-control'
            }
        },
        data: function() {
            return {
                value: null
            }
        },
        created() {
            if (this.initValue) {
                this.value = parse(this.initValue, this.format, Date.now());
            }
        },
        mounted() {
        },
        methods: {
            hideDatepicker: function() {
                this.$refs.datepicker.close();
            },
            showDatepicker: function () {
                this.$refs.datepicker.showCalendar();
            },
            handleSelectedDate: function (newDate) {
                console.log(newDate);
            },
            displayDate: function () {
                if (!this.value) {
                    return '';
                }
                return format(this.value, this.format);
            },
            checkValidDate: function () {
                const newValue = this.$refs.mainInput.value;
                const dateValue = parse(newValue, this.format, 0);
                if (this.isValidDate(dateValue)) {
                    this.$emit('input', dateValue);
                } else {
                    this.$emit('input', null);
                }
            },
            isValidDate: function (d) {
                return d instanceof Date && !isNaN(d);
            }
        },
        computed: {

        },
        watch: {
            value: function (newVal, oldVal) {
                this.$emit('input', newVal);
            }
        }
    }
</script>
