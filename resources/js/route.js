import { createWebHashHistory, createRouter } from "vue-router";
import App from './App.vue';
import authComponent from './components/auth/authComponent.vue';

const routes = [
    {
        path: '/',
        component: App
    },
    {
        path: '/login',
        component: authComponent
    }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

export default router