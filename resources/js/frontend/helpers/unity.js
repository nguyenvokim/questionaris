import {format} from "date-fns";

export const displayDate = (date) => {
    return format(new Date(date), 'dd-MM-yyyy');
}

export const roleDisplayMap = {
    SUPERVISOR: 'Supervisor',
    MEMBER: 'Practitioner'
}

export const userInviteStatusDisplayMap = {
    PENDING: 'Pending',
    APPROVED: 'Approved'
}
