import { createWebHashHistory, createRouter } from "vue-router";
import App from './App.vue';
import authComponent from './components/auth/authComponent.vue';
import adminComponent from './components/admin/adminComponent.vue'
import appComponent from './components/app/appComponent.vue'

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
    },
    {
        path: '/app',
        component: appComponent,
        children: [
            {
                path: 'cc',
                component: () => import('./components/app/childs/ccComponent.vue')
            },
            {
                path: 'export',
                component: () => import('./components/app/childs/exportComponent.vue')
            },
            {
                path: 'guide',
                component: () => import('./components/app/childs/guideComponent.vue')
            },
            {
                path: 'insurance',
                component: () => import('./components/app/childs/insuranceComponent.vue')
            },
            {
                path: 'og',
                component: () => import('./components/app/childs/ogComponent.vue')
            },
            {
                path: 'pack',
                component: () => import('./components/app/childs/packComponent.vue')
            }
        ]
    }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

export default router