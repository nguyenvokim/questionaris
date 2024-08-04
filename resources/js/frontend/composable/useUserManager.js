import axios from "axios";

export default () => {
    const sendInviteMail = async ({ firstName, lastName, email, role }) => {
        await axios.post('/api/userManager/inviteUser', { firstName, lastName, email, role })
    }

    return {
        sendInviteMail
    }
}
