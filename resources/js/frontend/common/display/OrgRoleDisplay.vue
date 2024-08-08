<template>
    <span>{{ displayName }}</span>
</template>

<script>
import {computed, defineComponent} from "vue";
import useApp from "../../composable/useApp";

export default defineComponent({
    props: {
        role: { type: String }
    },
    setup(props) {
        const { orgRoleDisplayMap } = useApp()
        const displayName = computed(() => orgRoleDisplayMap.value[props.role])

        return {
            displayName
        }
    }
})

</script>
