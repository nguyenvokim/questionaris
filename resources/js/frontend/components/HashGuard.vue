<template>
    <span></span>
</template>

<script>
    import {mapMutations} from "vuex";

    export default {
        mounted() {
            window.onhashchange = () => {
                console.log("Hash change");
            }
        },

        methods: {
            ...mapMutations('userDashboard', ['setSelectedClient'])
        },

        destroyed() {

        }
    }
</script>
