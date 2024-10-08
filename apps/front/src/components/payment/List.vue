<template>
  <div>
    <div
      v-show="usersPending"
      v-t="{ path: 'components.payment.list.pending' }"
    ></div>
    <div v-show="error">{{ error }}}</div>
    {{ errorDelete }}
    <DataTable :value="payments" stripedRows tableStyle="min-width: 50rem">
        <Column field="createdAt" :header="$t('components.payment.list.createdAt')"></Column>
        <Column field="amount" :header="$t('components.payment.list.amount')"></Column>
        <Column field="label" :header="$t('components.payment.list.label')"></Column>
        <Column field="localization" :header="$t('components.payment.list.action')">
          <template #body="slotProps">
            <Button v-if="!slotProps.data.localization" type="button" @click="openModal(slotProps.data)" :label="$t(`components.payment.list.identifyLocation`)" icon="pi pi-search" :loading="loading" />
            <span v-else v-text="slotProps.data.localization" />
          </template>
          
        </Column>
    </DataTable>
    <PaymentLocationsList v-model:modelValue="isModalVisible" :locations="locations" :payment="paymentObject" @update-payments="updatePayments" />
  </div>
</template>

<script setup lang="ts">
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import type { Payment } from "~/types/Payment/Index";
import useListPayments from "~/composables/api/payment/useListPayments";
import { getLocations } from "~/composables/api/payment/useListPayments";

const isModalVisible = ref<boolean>(false);
const locations = ref<{ name: string }[]>([]);
const paymentObject = ref<Payment>({} as Payment);

  const loading = ref(false);

const {
  data: payments,
  error,
} = await useListPayments() || { data: [] };

const openModal = async (payment: Payment) => {
  loading.value = true;
  const { data } = await getLocations(payment.id);
  locations.value = data?.value?.locations || []; // Update the reactive variable correctly
  isModalVisible.value = true; // Show the modal
  paymentObject.value = payment;
  loading.value = false;
};

const updatePayments = async () => {
  const {
  data: payments,
  error,
} = await useListPayments() || { data: [] };

  if (!error) {
    payments.value = payments.value;
  }
};

</script>

<style scoped lang="scss"></style>
