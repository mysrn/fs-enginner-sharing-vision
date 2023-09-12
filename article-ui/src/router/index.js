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
      path: '/published',
      name: 'published',
      component: () => import('../views/PublishView.vue')
    },
    {
      path: '/drafts',
      name: 'drafts',
      component: () => import('../views/DraftsView.vue')
    },
    {
      path: '/trashed',
      name: 'trashed',
      component: () => import('../views/TrashedView.vue')
    },
    {
      path: '/all',
      name: 'all',
      component: () => import('../views/AllArticleView.vue')
    },
  ]
})

export default router
