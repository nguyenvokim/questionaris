<template>
    <div v-if="isShown">
        <div class="card mb-sm-2">
            <div class="card-body">
                <h2>Welcome back, {{user.first_name}}</h2>
            </div>
            <table class="table table-striped">
                <tr>
                    <th>Date</th>
                    <th>Client First Name</th>
                    <th>Client Last Name</th>
                    <th>Personal Code</th>
                    <th>Test Name</th>
                </tr>
                <tr v-for="test in recentTests">
                    <td>{{displayDate(test.updated_at)}}</td>
                    <td>
                        <button @click="handleClickTest(test.client.id)" type="button" class="btn btn-transparent">{{test.client.first_name}}</button>
                    </td>
                    <td>
                        <button @click="handleClickTest(test.client.id)" type="button" class="btn btn-transparent">{{test.client.last_name}}</button>
                    <td>{{test.client.personal_code}}</td>
                    <td>{{test.test.title}}</td>
                </tr>
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
            ...mapMutations('userDashboard', ['setSelectedClient']),
            ...mapActions('userDashboard', ['loadRecentTest']),
            handleClickTest(clientId) {
                this.setSelectedClient(clientId);
            }
        },
        computed: {
            ...mapState('userDashboard', ['recentTests', 'user', 'selectedClient']),
            isShown() {
                return this.user.id && !this.selectedClient
            }
        }
    }
</script>