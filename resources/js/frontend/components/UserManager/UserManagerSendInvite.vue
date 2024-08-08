<template>
    <b-modal id="invite-user" ref="invite-user" title="Invite User" size="lg">
        <display-form-error v-if="errors" :errors="errors" />
        <div class="form">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" v-model="firstName" placeholder="Enter first name" maxlength="191" required="required" class="form-control">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" v-model="lastName" placeholder="Enter last name" maxlength="191" required="required" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" v-model="email" placeholder="Enter email" maxlength="191" required="required" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Select role</label>
                        <org-role-select v-model="role" />
                    </div>
                </div>
            </div>
        </div>
        <template #modal-footer>
            <div class="d-flex justify-content-end">
                <common-button variant="secondary" @click.prevent="handleClose" class="mr-2">
                    Cancel
                </common-button>
                <common-button variant="primary" @click.prevent="handleSendEmail" :loading="isLoading">
                    Send Invitation Email
                </common-button>
            </div>
        </template>
    </b-modal>
</template>

<script>

import {computed, defineComponent, ref} from "vue";
import {OrgRole} from "../../const";
import useUserManager from "../../composable/useUserManager";
import DisplayFormError from "../../common/DisplayFormError.vue";
import {useBvModal, useBvToast} from "../../composable/root";
import CommonButton from "../../common/CommonButton.vue";
import OrgRoleSelect from "../../common/form/OrgRoleSelect.vue";

export default defineComponent({
    components: {OrgRoleSelect, CommonButton, DisplayFormError},
    setup() {
        const bvModal = useBvModal()
        const bvToast = useBvToast()
        const {
            sendInviteMail
        } = useUserManager()

        const isLoading = ref(false);
        const firstName = ref('');
        const lastName = ref('');
        const email = ref('');
        const role = ref(OrgRole.Supervisor);
        const errors = ref(null);

        const handleSendEmail = async () => {
            if (isLoading.value) {
                return
            }
            try {
                isLoading.value = true
                await sendInviteMail({
                    firstName: firstName.value,
                    lastName: lastName.value,
                    email: email.value,
                    role: role.value,
                })
                bvToast.toast('Email has been sent successfully.', {
                    title: 'Successful',
                    variant: 'success',
                    solid: true,
                });
                bvModal.hide('invite-user');
            } catch (e) {
                if (e?.response?.status === 422) {
                    errors.value = e.response.data.errors
                    setTimeout(() => {
                        errors.value = null
                    }, 10000)
                }
            } finally {
                isLoading.value = false
            }
        }

        const handleClose = () => {
            bvModal.hide('invite-user');
        }

        return {
            handleClose,
            handleSendEmail,
            firstName,
            lastName,
            email,
            role,
            isLoading,
            errors,
        }
    },
})

</script>
