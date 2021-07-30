<template>
    <span></span>
</template>

<script>
    import {mapMutations} from "vuex";

    export default {
        mounted() {
            window.onhashchange = () => {
                if (window.location.hash == '') {
                    this.setSelectedClient(0);
                }
            }
        },

        methods: {
            ...mapMutations('userDashboard', ['setSelectedClient'])
        },

        destroyed() {

        }
    }
</script>
