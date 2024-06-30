<template>
  <v-app>
    <v-app-bar app>
      <v-toolbar-title>Pet Shop</v-toolbar-title>
    </v-app-bar>
    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script setup lang="ts">
import { useAuthStore } from '@/stores';
const authStore = useAuthStore();
</script>

<style scoped>
@import '~vuetify/styles';
</style>