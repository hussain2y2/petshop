<template>
  <v-data-table :items="orders" :headers="headers">
    <template v-slot:[`item.action`]="{ item }">
      <v-btn @click="viewOrder(item.uuid)">View</v-btn>
    </template>
  </v-data-table>
</template>

<script setup lang="ts">
import { onMounted } from 'vue';
import { useOrderStore } from '@/store';
import { useRouter } from 'vue-router';

const orderStore = useOrderStore();
const router = useRouter();
const orders = orderStore.orders;

const headers = [
  { text: 'Order ID', value: 'uuid' },
  { text: 'Amount', value: 'amount' },
  { text: 'Action', value: 'action' },
];

const viewOrder = (id: string) => {
  router.push({ name: 'order', params: { id } });
};

onMounted(() => {
  orderStore.fetchOrders();
});
</script>

<style scoped>

</style>