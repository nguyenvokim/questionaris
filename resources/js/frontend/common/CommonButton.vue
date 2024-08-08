<template>
    <b-button :size="size" class="position-relative" :variant="variant" v-on="$listeners">
        <span :class="{ hidden: loading }">
            <slot></slot>
        </span>
        <span class="loading" v-if="loading">
            <b-spinner small variant="light" />
        </span>
    </b-button>
</template>
<script>
import {defineComponent} from "vue";

export default defineComponent({
    props: {
        loading: {
            type: Boolean,
            default: false
        },
        variant: {
            type: String,
            default: 'success'
        },
        size: {
            type: String,
            default: ''
        }
    },
    setup(props) {
        return {

        }
    }
})
</script>

<style lang="scss" scoped>
.hidden {
    visibility: hidden;
}

.loading {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
}

.ani-loading {
    animation:spin 1s linear infinite;
}

@keyframes spin {
    from {
        transform:rotate(0deg);
    }
    to {
        transform:rotate(360deg);
    }
}
</style>
