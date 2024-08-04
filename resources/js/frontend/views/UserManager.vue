<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-content-center">
                <div>
                    <h4 class="card-title mb-0"><small class="text-muted">Manager Users</small></h4>
                </div>
                <div>
                    <a @click.prevent="showPopupSendInvite" class="btn btn-success">
                        <i class="fa fa-plus-circle"></i> Invite User
                    </a>
                </div>
            </div>
            <div class="mt-4">
                <b-tabs>
                    <b-tab title="Users" active>
                        <div>123</div>
                    </b-tab>
                    <b-tab title="Invitations Sent"></b-tab>
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

export default defineComponent({
    components: {UserManagerSendInvite},
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
