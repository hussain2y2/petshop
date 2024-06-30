import { defineStore } from 'pinia';
import api from '@/utils/api'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    token: localStorage.getItem('token') || '',
  }),
  actions: {
    setToken(token: string) {
      this.token = token;
      localStorage.setItem('token', token);
    },
    clearToken() {
      this.token = '';
      localStorage.removeItem('token');
    },
  },
});

export const useOrderStore = defineStore('order', {
  state: () => ({
    orders: [],
    order: null,
  }),
  actions: {
    async fetchOrders() {
      const response = await api.get('/user/orders');
      this.orders = response.data.data;
    },
    async fetchOrder(id: string) {
      const response = await api.get(`/order/${id}`);
      this.order = response.data;
    },
  },
});