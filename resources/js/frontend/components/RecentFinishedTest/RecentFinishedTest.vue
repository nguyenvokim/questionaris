<template>
    <div>
        <div class="card mb-sm-2">
            <div class="card-body">
                <h4>{{user.first_name}}, here are your most recently completed tests</h4>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Client First Name</th>
                    <th>Client Last Name</th>
                    <th>Personal Code</th>
                    <th>Test Name</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="test in recentTests" @click="handleClickTest(test)">
                    <td>{{displayDate(test.updated_at)}}</td>
                    <td>
                        {{test.client.first_name}}
                    </td>
                    <td>
                        {{test.client.last_name}}
                    </td>
                    <td>{{test.client.personal_code}}</td>
                    <td>{{test.test.title}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
    import {mapState, mapActions, mapMutations} from 'vuex'
    export default {
        mounted() {
            this.loadRecentTest();
        },
        methods: {
            ...mapMutations('userDashboard', ['setSelectedClient', 'setSelectedTestId']),
            ...mapActions('userDashboard', ['loadRecentTest']),
            handleClickTest(test) {
                this.$router.push(`/detail/${test.client.id}/${test.test.id}`)
            }
        },
        computed: {
            ...mapState('userDashboard', ['recentTests', 'user', 'selectedClient', 'clients']),
        }
    }
</script>
