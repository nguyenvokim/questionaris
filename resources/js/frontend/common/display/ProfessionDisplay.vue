<template>
    <span>{{ professionName }}</span>
</template>

<script>
import {computed, defineComponent} from "vue";
import useApp from "../../composable/useApp";

export default defineComponent({
    props: {
        id: { type: Number }
    },
    setup(props) {
        const { professionDisplayMap } = useApp()
        const professionName = computed(() => professionDisplayMap.value[props.id])

        return {
            professionName
        }
    }
})

</script>
