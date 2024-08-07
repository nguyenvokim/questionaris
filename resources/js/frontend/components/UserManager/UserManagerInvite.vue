<template>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(invite) in invites" :key="invite.id">
            <td>{{ invite.id }}</td>
            <td>{{invite.first_name}} {{invite.last_name}}</td>
            <td>{{invite.email}}</td>
            <td>{{ roleDisplayMap[invite.role] }}</td>
            <td>
                <b-badge :variant="invite.status === UserInviteStatus.Approved ? 'success' : 'warning'">
                    {{ userInviteStatusDisplayMap[invite.status] }}
                </b-badge>
            </td>
            <td>
                <common-button :loading="btnLoadingState[invite.id]" @click="resendEmail(invite.id)" variant="primary" :disabled="invite.status === UserInviteStatus.Approved">
                    <i class="fas fa-paper-plane"></i> Re-send invite
                </common-button>
            </td>
        </tr>
        </tbody>
    </table>
</template>
<script>

import {defineComponent, onMounted, ref} from "vue";
import axios from "axios";
import {roleDisplayMap, userInviteStatusDisplayMap} from "../../helpers/unity";
import CommonButton from "../../common/CommonButton.vue";
import {UserInviteStatus} from "../../const";
import {useBvToast} from "../../composable/root";

export default defineComponent({
    components: {CommonButton},
    computed: {
        UserInviteStatus() {
            return UserInviteStatus
        },
        userInviteStatusDisplayMap() {
            return userInviteStatusDisplayMap
        },
        roleDisplayMap() {
            return roleDisplayMap
        }
    },
    setup() {

        const bvToast = useBvToast()
        const invites = ref([]);
        const btnLoadingState = ref({})

        const loadInvites = async () => {
            const { data } = await axios.get('/api/userManager/invites')
            invites.value = data

            btnLoadingState.value = invites.value.reduce((curr, invite) => {
                curr[invite.id] = false

                return curr
            }, {})
        }

        const resendEmail = async (id) => {
            if (btnLoadingState.value[id]) {
                return
            }

            try {
                btnLoadingState.value[id] = true
                await axios.post(`/api/userManager/invites/${id}/resend`)

                bvToast.toast('Email has been sent successfully.', {
                    title: 'Successful',
                    variant: 'success',
                    solid: true,
                });
            } finally {
                btnLoadingState.value[id] = false
            }
        }

        onMounted(async () => {
            loadInvites()
        })

        return {
            invites,
            resendEmail,
            btnLoadingState,

        }
    }
})

</script>
