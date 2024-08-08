<template>
    <b-form-select name="role" v-model="localValue" :options="options"></b-form-select>
</template>
<script>
import {computed, defineComponent} from "vue";
import {OrgRole} from "../../const";

export default defineComponent({
    props: {
        value: String,
    },
    setup(props, { emit }) {
        const localValue = computed({
            get: () => props.value,
            set: (val) => {
                emit('input', val);
            }
        })

        const options = computed(() => {
            return [
                { value: OrgRole.Supervisor, text: 'Supervisor'},
                { value: OrgRole.Member, text: 'Practitioner'},
            ]
        })

        return {
            localValue,
            options,
        }
    }
})
</script>
