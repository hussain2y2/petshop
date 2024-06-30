import { createRouter, createWebHistory } from 'vue-router';
import Login from '@/pages/Login.vue';
import Orders from '@/pages/Orders.vue';
import Order from '@/pages/Order.vue';
import { useAuthStore } from '@/store';

const routes = [
  { path: '/', name: 'login', component: Login },
  { path: '/orders', name: 'orders', component: Orders },
  { path: '/order/:id', name: 'order', component: Order },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

router.beforeEach((to, from, next) => {
  const authStore = useAuthStore();
  if (to.name !== 'login' && !authStore.token) {
    next({ name: 'login' });
  } else {
    next();
  }
});

export default router;
