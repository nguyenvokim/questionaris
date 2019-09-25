<template>
    <button
            :id="id"
            :class="cssClass"
            v-clipboard="copyText"
            v-clipboard:success="clipboardSuccessHandler"
            v-clipboard:error="clipboardErrorHandler">
        <slot></slot>
        <span v-if="!hasSlot">
            <i class="fa fa-copy fa-fw"></i> Copy Text
        </span>
        <b-tooltip :disabled="true" ref="tooltip" :target="id">
            <span v-text="successTextFinal"></span>
        </b-tooltip>
    </button>
</template>

<script>

    export default {
        components: {},
        props: {
            cssClass: {
                type: String,
                default: 'btn btn-primary'
            },
            copyText:  {
                type: String,
                default: ''
            },
            successText: {
                type: String,
                default: ''
            },
            failedText: {
                type: String,
                default: ''
            }
        },
        data: function() {
            return {
            }
        },
        mounted() {
        },
        methods: {
            clipboardSuccessHandler: function () {
                this.$refs.tooltip.$emit('open');
                setTimeout(() => {
                    this.$refs.tooltip.$emit('close');
                }, 2000);
            },
            clipboardErrorHandler: function () {
                this.$refs.tooltip.$emit('open');
                setTimeout(() => {
                    this.$refs.tooltip.$emit('close');
                }, 2000);
            }
        },
        computed: {
            hasSlot: function () {
                return !!this.$slots.default
            },
            successTextFinal: function () {
                if (this.successText && this.successText.length) {
                    return this.successText;
                };
                return "Success copy to your clipboard";
            },
            id: function () {
                const randomId = Math.random().toString(36).slice(-6);
                return randomId;
            }
        }
    }
</script>
