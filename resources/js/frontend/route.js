import {RouteName} from "./const";
import UserDashboard from "./components/UserDashboard/UserDashboard.vue";
import VueRouter from "vue-router";
import RecentFinishedTest from "./components/RecentFinishedTest/RecentFinishedTest.vue";

const routes = [
    {
        path: '/dashboard',
        component: RecentFinishedTest,
        name: RouteName.Dashboard,
    },
    {
        path: '/dashboard/detail/:clientId/:testId',
        component: UserDashboard,
        name: RouteName.ClientTestResult,
    }
]
export const router = new VueRouter({
    mode: 'history',
    routes
})
