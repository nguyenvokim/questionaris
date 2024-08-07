<template>
    <b-form-select name="country" v-model="localValue" :options="countryOptions"></b-form-select>
</template>
<script>
import {computed, defineComponent} from "vue";
import countries from "../countries";

export default defineComponent({
    props: {
        value: String,
    },
    setup(props, { emit }) {
        const localValue = computed({
            get: () => props.value,
            set: (val) => {
                emit('value', val);
            }
        })

        const countryOptions = computed(() => {
            return countries.map((country) => {
                return {
                    value: country.code,
                    text: country.name,
                }
            })
        })

        return {
            localValue,
            countryOptions,
        }
    }
})
</script>
