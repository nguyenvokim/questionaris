import {RouteName} from "./const";
import UserDashboard from "./views/UserDashboard.vue";
import VueRouter from "vue-router";
import RecentFinishedTest from "./views/RecentFinishedTest.vue";
import UserManager from "./views/UserManager.vue";

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
    },
    {
        path: '/userManager',
        component: UserManager,
        name: RouteName.UserManager,
    }
]
export const router = new VueRouter({
    mode: 'history',
    routes
})
