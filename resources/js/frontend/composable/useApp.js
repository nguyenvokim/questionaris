import {computed} from "vue";
import {OrgRole} from "../const";
import countries from "../countries";

export default () => {
    const orgRoleDisplayMap = computed(() => ({
        [OrgRole.Supervisor]: 'Supervisor',
        [OrgRole.Member]: 'Practitioner',
        [OrgRole.Master]: 'Master Account',
    }))

    const countryNameMap = computed(() => {
        return countries.reduce((curr, country) => {
            curr[country.code] = country.name

            return curr
        }, {})
    })

    const professionDisplayMap = computed(() => {
        return {
            0: 'Psychologist',
            1: 'Psychiatrist',
            2: 'Provisional Psychologist',
            3: 'Counsellor',
            4: 'Medical Practitioner',
            5: 'Occupational Therapist',
            6: 'Psychiatric Nurse',
            7: 'Social Worker',
            8: 'Student',
            9: 'Researcher',
            10: 'Practice Administrator',
            11: 'Other'
        }
    })

    return {
        orgRoleDisplayMap,
        countryNameMap,
        professionDisplayMap,
    }
}
