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
      <Button
        type="submit"
        class="mr-2 mb-2"
        :disabled="!isValid"
        :label="$t(`components.payment.createForm.ok`)"
        icon="pi pi-save"
        :loading="loading"
      />
    </template>
  </PaymentForm>
</template>
<script setup lang="ts">
import useCreatePayment from "~/composables/api/payment/useCreatePayment";
import type { PaymentInput } from "~/types/Payment/Input";
import emitter from '@/utils/eventBus';
const { createPayment, violations } = useCreatePayment();

const loading = ref<boolean>(false);

const submit = async (state: PaymentInput) => {
  try {
    loading.value = true;
    await createPayment(state);
    emitter.emit('loadPayments');
    await navigateTo("/payments");
  } catch (e) {
    logger.info(e);
  } finally {
    loading.value = false;
  }
};

const navigateToList = () => {
  return navigateTo("/payments/");
};
</script>

<style scoped lang="scss"></style>
