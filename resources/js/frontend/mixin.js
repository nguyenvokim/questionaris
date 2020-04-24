import { format, compareAsc, parse } from 'date-fns';

export default {
    methods: {
        displayDate(date) {
            return format(new Date(date), 'dd-MM-yyyy');
        }
    }
}