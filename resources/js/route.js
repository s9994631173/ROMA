import { createWebHashHistory, createRouter } from "vue-router";
import App from './App.vue';
import authComponent from './components/auth/authComponent.vue';
import adminComponent from './components/admin/adminComponent.vue'

const routes = [
    {
        path: '/',
        component: App
    },
    {
        path: '/login',
        component: authComponent
    },
    {
        path: '/admin',
        component: adminComponent,
        children: [
            {
                path: 'cc',
                component: () => import('./components/admin/childs/ccComponent.vue')
            },
            {
                path: 'export',
                component: () => import('./components/admin/childs/exportComponent.vue')
            },
            {
                path: 'guide',
                component: () => import('./components/admin/childs/guideComponent.vue')
            },
            {
                path: 'insurance',
                component: () => import('./components/admin/childs/insuranceComponent.vue')
            },
            {
                path: 'og',
                component: () => import('./components/admin/childs/ogComponent.vue')
            },
            {
                path: 'pack',
                component: () => import('./components/admin/childs/packComponent.vue')
            }
        ]
    }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

export default router