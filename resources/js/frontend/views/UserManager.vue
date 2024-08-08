<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-content-center">
                <div>
                    <h4 class="card-title mb-0"><small class="text-muted">Manager Users</small></h4>
                </div>
                <div>
                    <common-button @click.prevent="showPopupSendInvite" variant="success">
                        <i class="fa fa-plus-circle"></i> Invite User
                    </common-button>
                </div>
            </div>
            <div class="mt-4">
                <b-tabs>
                    <b-tab title="Users" active>
                        <user-manage-user />
                    </b-tab>
                    <b-tab title="Invitations Sent">
                        <user-manager-invite />
                    </b-tab>
                </b-tabs>
            </div>
        </div>
        <user-manager-send-invite />
    </div>
</template>
<script>
import {defineComponent, ref} from 'vue'
import {useBvModal} from "../composable/root";
import UserManagerSendInvite from "../components/UserManager/UserManagerSendInvite.vue";
import CommonButton from "../common/CommonButton.vue";
import UserManagerInvite from "../components/UserManager/UserManagerInvite.vue";
import UserManageUser from "../components/UserManager/UserManageUser.vue";

export default defineComponent({
    components: {UserManageUser, UserManagerInvite, CommonButton, UserManagerSendInvite},
    setup(_, context) {
        const country = ref('AU');
        const bvModal = useBvModal();
        const showPopupSendInvite = () => {
            bvModal.show('invite-user')
        }
        return {
            country,
            showPopupSendInvite,
        }
    }
})

</script>
