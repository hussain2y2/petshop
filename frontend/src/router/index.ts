import { createRouter, createWebHistory } from 'vue-router';
import LoginPage from '@/pages/LoginPage.vue';
import OrdersPage from '@/pages/OrdersPage.vue';
import OrderPage from '@/pages/OrderPage.vue';
import { useAuthStore } from '@/store';

const routes = [
  { path: '/', name: 'login', component: LoginPage },
  { path: '/orders', name: 'orders', component: OrdersPage },
  { path: '/order/:id', name: 'order', component: OrderPage },
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
