<template>
    <b-modal id="invite-user" ref="invite-user" title="Invite User" ok-title="Send Invitation Email" @ok.prevent="handleSendEmail" size="lg">
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
                        <b-form-select v-model="role" :options="roleOptions"></b-form-select>
                    </div>
                </div>
            </div>
        </div>
    </b-modal>
</template>

<script>

import {computed, defineComponent, ref} from "vue";
import {OrgRole} from "../../const";
import useUserManager from "../../composable/useUserManager";
import DisplayFormError from "../../common/DisplayFormError.vue";
import {useBvModal} from "../../composable/root";

export default defineComponent({
    components: {DisplayFormError},
    setup() {
        const bvModal = useBvModal()
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

        const roleOptions = computed(() => {
            return [
                { value: OrgRole.Supervisor, text: 'Supervisor'},
                { value: OrgRole.Member, text: 'Practitioner'},
            ]
        })

        return {
            handleSendEmail,
            firstName,
            lastName,
            email,
            role,
            roleOptions,
            isLoading,
            errors,
        }
    },
})

</script>
