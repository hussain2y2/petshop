<template>
  <v-container>
    <v-form @submit.prevent="login">
      <v-text-field v-model="email" label="Email" required></v-text-field>
      <v-text-field v-model="password" label="Password" type="password" required></v-text-field>
      <v-btn type="submit">Login</v-btn>
    </v-form>
  </v-container>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import api from '@/utils/api';
import { useAuthStore } from '@/store';
import { useRouter } from 'vue-router';

const email = ref('');
const password = ref('');
const authStore = useAuthStore();
const router = useRouter();

const login = async () => {
  try {
    const response = await api.post('/admin/login', { email: email.value, password: password.value });
    authStore.setToken(response.data.token);
    router.push({ name: 'orders' });
  } catch (error) {
    console.error(error);
  }
};
</script>

<style scoped>

</style>