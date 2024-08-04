<template>
    <b-alert variant="danger" show class="pl-0">
        <ul>
            <li v-for="(message, index) in errorMessages" :key="index">{{ message }}</li>
        </ul>
    </b-alert>
</template>
<script>

import {computed, defineComponent} from "vue";

export default defineComponent({
    props: {
        errors: {
            type: Object,
        }
    },
    setup(props) {
        const errorMessages = computed(() => {
            console.log(Object.values(props.errors).flat());
            return Object.values(props.errors).flat()
        })
        return {
            errorMessages,
        }
    }
})

</script>
