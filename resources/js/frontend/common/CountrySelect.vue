<template>

</template>
<script>
import {computed, defineComponent} from "vue";

export default defineComponent({
    setup(props, { emit }) {
        const localValue = computed({
            get: () => props.value,
            set: (val) => {
                emit('value', val)
            }
        })
    }
})
</script>
