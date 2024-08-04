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
import {defineComponent} from 'vue'
import useUserDashboard from "../composable/useUserDashboard";
import {useRouter} from "vue-router/composables";
import {RouteName} from "../const";

export default defineComponent({
    setup() {
        const routers = useRouter()
        const {
            setSelectedClient,
            setSelectedTestId,
            loadRecentTest,
            user,
            recentTests,
        } = useUserDashboard();

        const handleClickTest = (test) => {
            routers.push({
                name: RouteName.ClientTestResult,
                params: {
                    clientId: test.client.id,
                    testId: test.test.id,
                }
            })
        }

        return {
            setSelectedClient,
            setSelectedTestId,
            loadRecentTest,
            user,
            recentTests,
            handleClickTest,
        }
    },
    mounted() {
        this.loadRecentTest();
    },
})
</script>
