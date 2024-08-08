import {useBvModal, useStore} from "./root";
import {computed, nextTick} from "vue";
import axios from "axios";

export default () => {
    const store = useStore()
    const bvModal = useBvModal()

    const roleUsers = computed({
        get: () => store.state.userManager.roleUsers,
        set: (val) => {
            store.commit('userManager/setRoleUsers', val)
        }
    })

    const selectedRoleUser = computed({
        get: () => store.state.userManager.selectedRoleUser,
        set: (val) => {
            store.commit('userManager/setSelectedRoleUser', val)
        }
    })

    const fetchUsers = async () => {
        const { data } = await axios.get('/api/userManager/users')

        roleUsers.value = data
    }

    const startEditUser = async (roleUser) => {
        selectedRoleUser.value = roleUser
        await nextTick()
        bvModal.show('edit-invite-user')
    }


    return {
        selectedRoleUser,
        roleUsers,
        fetchUsers,
        startEditUser,
    }
}
