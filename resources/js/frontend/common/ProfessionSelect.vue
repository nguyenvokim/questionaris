<template>
    <b-form-select name="profession" v-model="localValue" :options="options"></b-form-select>
</template>
<script>
import {computed, defineComponent} from "vue";

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

        const options = computed(() => {
            return [
                { value: 0, text: 'Psychologist' },
                { value: 1, text: 'Psychiatrist' },
                { value: 2, text: 'Provisional Psychologist' },
                { value: 3, text: 'Counsellor' },
                { value: 4, text: 'Medical Practitioner' },
                { value: 5, text: 'Occupational Therapist' },
                { value: 6, text: 'Psychiatric Nurse' },
                { value: 7, text: 'Social Worker' },
                { value: 8, text: 'Student' },
                { value: 9, text: 'Researcher' },
                { value: 10, text: 'Practice Administrator' },
                { value: 11, text: 'Other' }
            ]
        })

        return {
            localValue,
            options,
        }
    }
})
</script>
