<template>
    <b-modal id="edit-invite-user" :title="`Edit ${selectedRoleUser.user.first_name}`" size="lg">
        <div class="form">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Select role {{role}}</label>
                        <org-role-select v-model="role" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Account status</label>
                        <div>
                            <b-form-radio-group
                                id="role-status"
                                v-model="status"
                                :options="options"
                                name="status"
                            ></b-form-radio-group>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <template #modal-footer>
            <div class="d-flex justify-content-end">
                <common-button variant="secondary" @click.prevent="handleClose" class="mr-2">
                    Cancel
                </common-button>
                <common-button variant="primary" @click.prevent="handleSave" :loading="isLoading">
                    Save
                </common-button>
            </div>
        </template>
    </b-modal>
</template>

<script>

import {computed, defineComponent, ref} from "vue";
import DisplayFormError from "../../common/DisplayFormError.vue";
import {useBvModal, useBvToast} from "../../composable/root";
import CommonButton from "../../common/CommonButton.vue";
import useUserManagerUser from "../../composable/useUserManagerUser";
import OrgRoleSelect from "../../common/form/OrgRoleSelect.vue";
import {OrgStatus} from "../../const";
import axios from "axios";

export default defineComponent({
    components: {OrgRoleSelect, CommonButton, DisplayFormError},
    setup() {
        const bvModal = useBvModal()
        const bvToast = useBvToast()
        const isLoading = ref(isLoading)

        const { selectedRoleUser, fetchUsers } = useUserManagerUser()
        const role = ref(selectedRoleUser.value.role);
        const status = ref(selectedRoleUser.value.status);

        const handleSave = async () => {
            if (isLoading.value) {
                return
            }

            try {
                const params = {
                    status: status.value,
                    role: role.value
                }

                isLoading.value = true

                await axios.post(`/api/userManager/users/${selectedRoleUser.value.user.id}`, params)

                await fetchUsers()
                handleClose()
            } finally {
                isLoading.value = false
            }
        }

        const handleClose = () => {
            bvModal.hide('edit-invite-user');
        }

        const options = computed(() => {
            return [
                { text: 'Active', value: OrgStatus.Active },
                { text: 'De-active', value: OrgStatus.DeActive },
            ]
        })


        return {
            handleClose,
            handleSave,
            isLoading,
            role,
            status,
            selectedRoleUser,
            options,
        }
    },
})

</script>
