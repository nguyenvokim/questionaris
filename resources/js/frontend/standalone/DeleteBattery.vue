<template>
    <span>
        <button :class="btnClass" @click="handleDelete($event)">
            <i class="fa fa-plus rotate_45"></i> Delete
        </button>
    </span>
</template>

<script>
    import axios from 'axios';
    export default {
        components: {},
        props: {
            id: {
                type: Number,
                default: 0
            },
            size: {
                type: String,
                default: 'sm'
            },
            reloadAfterDelete: {
                type: Boolean,
                default: true
            },
            redirectLink: {
                type: String,
                default: null
            }
        },

        mounted() {
        },
        methods: {
            handleDelete: async function (e) {
                console.log(e);
                e.preventDefault();
                const result = await this.$bvModal.msgBoxConfirm("Are you sure you want to delete?");
                if (result) {
                    axios.delete(`/api/batteries/${this.id}`).then(() => {
                        if (this.reloadAfterDelete) {
                            window.location.reload();
                        } else if (this.redirectLink) {
                            window.location.href = this.redirectLink;
                        }
                    })
                }
            }
        },
        computed: {
            btnClass: function () {
                if (this.size === 'sm') {
                    return 'btn btn-sm btn-danger';
                } else {
                    return 'btn btn-danger';
                }
            }
        },
    }
</script>
