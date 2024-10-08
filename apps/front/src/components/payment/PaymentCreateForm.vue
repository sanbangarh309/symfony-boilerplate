<template>
  <h1 v-t="{ path: 'components.payment.createForm.title' }"></h1>
  <PaymentForm
    class="card"
    :violations="violations"
    @submit="submit"
    @cancel="navigateToList"
  >
    <template #buttons="{ isValid, cancel }">
      <Button type="button" severity="danger" class="mr-2 mb-2" @click="cancel">
        {{ $t("components.payment.createForm.buttonCancel") }}
      </Button>
      <Button type="submit" :disabled="!isValid" class="mr-2 mb-2">
        {{ $t("components.payment.createForm.ok") }}
      </Button>
    </template>
  </PaymentForm>
</template>
<script setup lang="ts">
import useCreatePayment from "~/composables/api/payment/useCreatePayment";
import type { PaymentInput } from "~/types/Payment/Input";
const { createPayment, violations } = useCreatePayment();

const submit = async (state: PaymentInput) => {
  try {
    await createPayment(state);
    await navigateTo("/payments");
  } catch (e) {
    logger.info(e);
  }
};
const navigateToList = () => {
  return navigateTo("/payments/");
};
</script>

<style scoped lang="scss"></style>
