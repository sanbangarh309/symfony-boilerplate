<template>
  <div>
    <PaymentCreateForm
      v-if="paymentId === 'add'"
      :paymentId="paymentId"
    />
    <PaymentUpdateForm
      v-else
      :paymentId="paymentId" 
    />
    <div v-if="!paymentId">Une erreur est survenue</div>
  </div>
</template>

<script setup lang="ts">

const route = useRoute();
const paymentId = route.params.id.toString();
</script>

<style scoped lang="scss"></style>
