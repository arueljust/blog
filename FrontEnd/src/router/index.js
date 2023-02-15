import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/customer',
      name: 'index',
      component: () => import('../views/customer/index.vue')
    },
    {
      path: '/customer',
      name: 'create',
      component: () => import('../views/customer/create.vue')
    },
    {
      path: '/customer/:id',
      name: 'edit',
      component: () => import('../views/customer/edit.vue')
    },
  ]
})

export default router
