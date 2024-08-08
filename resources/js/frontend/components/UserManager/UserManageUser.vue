<template>
    <div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Email</th>
                <th>Country</th>
                <th>Profession</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="roleUser in roleUsers" :key="roleUser.id">
                <td>{{roleUser.user.first_name}} {{roleUser.user.last_name}}</td>
                <td>{{ orgRoleDisplayMap[roleUser.role] }}</td>
                <td>{{ roleUser.user.email }}</td>
                <td>{{countryNameMap[roleUser.user.country]}}</td>
                <td>{{ professionDisplayMap[roleUser.user.profession] }}</td>
                <td>
                    <b-badge :variant="roleUser.status === OrgStatus.Active ? 'success' : 'danger'">
                        {{ roleUser.status }}
                    </b-badge>
                </td>
                <td>
                    <common-button :size="'sm'" variant="primary" @click="handleStartEditUser(roleUser)">
                        <i class="fa fa-edit" /> Edit
                    </common-button>
                </td>
            </tr>
            </tbody>
        </table>
        <user-manager-user-edit v-if="selectedRoleUser" :key="selectedRoleUser.id" />
    </div>
</template>

<script>
import {defineComponent, onMounted} from "vue";
import useUserManagerUser from "../../composable/useUserManagerUser";
import useApp from "../../composable/useApp";
import {OrgStatus} from "../../const";
import CommonButton from "../../common/CommonButton.vue";
import UserManagerUserEdit from "./UserManagerUserEdit.vue";

export default defineComponent({
    components: {UserManagerUserEdit, CommonButton},
    computed: {
        OrgStatus() {
            return OrgStatus
        }
    },
    setup() {

        const { roleUsers, fetchUsers, startEditUser, selectedRoleUser } = useUserManagerUser()
        const { orgRoleDisplayMap, countryNameMap, professionDisplayMap } = useApp()

        onMounted(() => {
            fetchUsers();
        })

        const handleStartEditUser = (roleUser) => {
            startEditUser(roleUser)
        }

        return {
            roleUsers,
            orgRoleDisplayMap,
            countryNameMap,
            professionDisplayMap,
            selectedRoleUser,
            handleStartEditUser,
        }
    }
})
</script>
