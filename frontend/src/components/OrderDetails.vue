<template>
  <div v-if="order">
    <h2>Order Details</h2>
    <p><strong>Order ID:</strong> {{ order.uuid }}</p>
    <p><strong>Amount:</strong> {{ order?.amount }}</p>
    <!-- Add more fields as needed -->
    <v-btn @click="downloadPdf">Download PDF</v-btn>
  </div>
</template>

<script setup lang="ts">
import { onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { useOrderStore } from '@/store';

const route = useRoute();
const orderStore = useOrderStore();
const order = orderStore.order;

const downloadPdf = () => {
  window.open(`https://pet-shop.buckhill.com.hr/api/v1/order/${order.uuid}/download`);
};

onMounted(() => {
  const id = route.params.id as string;
  orderStore.fetchOrder(id);
});
</script>

<style scoped>

</style>