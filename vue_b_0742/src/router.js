//import vue router
import { createRouter, createWebHistory } from 'vue-router'
//define a routes
const routes = [
    {
    path: '/',
    name: 'beranda',
    component: () => import('@/components/DashboardLayout.vue'),
        children:[
            {
                path: "/departemen",
                name: "departemen.index",
                component: () =>
                import('@/views/Departemen/indexPage.vue'),
            },
            {
                path: "/departemen/create",
                name: "departemen.create",
                component: () =>
                import('@/views/Departemen/createPage.vue'),
            },
        ],
    },
]
//create router
const router = createRouter({
history: createWebHistory(),
routes // config routes
})
export default router;