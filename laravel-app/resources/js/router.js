import { createRouter, createWebHistory } from 'vue-router'

const routes = []

routes.push(
    {
        path: '/todo',
        name: 'todo',
        component: () => import('TodoList.vue'),
    },
)

// 存在しないパスは全てTOPへ
routes.push(
    {
        path: '/:catchAll(.*)',
        redirect: '/'
    }
)

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from) => {
    // URL直接入力の場合はTOPへ
    if (to.path !== '/' && from.name === undefined) {
        return '/'
    }
})

export default router
