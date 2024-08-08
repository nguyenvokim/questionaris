<template>
    <span>{{ countryName }}</span>
</template>

<script>
import {computed, defineComponent} from "vue";
import useApp from "../../composable/useApp";

export default defineComponent({
    props: {
        countryCode: { type: String }
    },
    setup(props) {
        const { countryNameMap } = useApp()
        const countryName = computed(() => countryNameMap.value[props.countryCode])

        return {
            countryName
        }
    }
})

</script>
