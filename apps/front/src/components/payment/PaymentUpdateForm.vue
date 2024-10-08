<template>
  <div
    v-show="pendingData"
    v-t="{ path: 'components.payment.updateForm.pending' }"
  ></div>
  <h1 v-t="{ path: 'components.payment.updateForm.title', args: data }"></h1>
  <PaymentForm
    :default-value="data"
    :violations="violations"
    @submit="submit"
    @cancel="navigateToList"
  >
  </PaymentForm>
  {{ error }}
</template>

<script setup lang="ts">
import useGetPayment from "~/composables/api/payment/useGetPayment";
import useUpdatePayment from "~/composables/api/payment/useUpdatePayment";
import type { PaymentInput } from "~/types/Payment/Input";

interface Props {
  PaymentId: string;
}

const props = defineProps<Props>();

const { violations, updatePayment: updatePaymentApi } = useUpdatePayment();

const { data, error, pending: pendingData } = await useGetPayment(props.PaymentId);

const submit = async (value: PaymentInput) => {
  // If you need to copy the value, create a clone so it does not track reactivity
  //data.value = {...data.value, ...value};
  await updatePaymentApi(props.PaymentId, value);
  return navigateTo("/Payments/");
};
const navigateToList = () => {
  return navigateTo("/payments/");
};
</script>
<style scoped lang="scss"></style>
