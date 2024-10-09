<template>
  <div>
    <DataTable :value="payments" stripedRows tableStyle="min-width: 50rem" key="id">
        <Column field="createdAt" :header="$t('components.payment.list.createdAt')"></Column>
        <Column field="amount" :header="$t('components.payment.list.amount')"></Column>
        <Column field="label" :header="$t('components.payment.list.label')"></Column>
        <Column field="localization" :header="$t('components.payment.list.action')">
          <template #body="slotProps">
            <Button
              :key="slotProps.data.id"
              v-if="!slotProps.data.localization"
              type="button"
              @click="openModal(slotProps.data)"
              :label="$t(`components.payment.list.identifyLocation`)"
              icon="pi pi-search"
              :loading="loading[slotProps.data.id]"
            />
            <span v-else v-text="slotProps.data.localization" />
          </template>
        </Column>
    </DataTable>
    <PaymentLocationsList v-model:modelValue="isModalVisible" :locations="locations" :payment="paymentObject" @update-payments="loadPayments" />
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
const payments = ref<Payment[]>([]);
const loading = ref<boolean[]>([]);
const error = ref<string | null>(null);

// Open modal and fetch locations
const openModal = async (payment: Payment) => {
  const paymentId = payment.id
  loading.value[paymentId] = true; // Set loading state for this specific index
  const { data } = await getLocations(paymentId);
  locations.value = data?.value?.locations || [];
  isModalVisible.value = true;
  paymentObject.value = payment; // Use the payment directly from the payments array
  loading.value[paymentId] = false; // Reset loading state after fetching
};

// Load the payments data
const loadPayments = async () => {
  const { data, error } = await useListPayments();
  payments.value = data?.value || [];
  loading.value = new Array(data?.value.length).fill(false);
};

// Load payments on component setup
await loadPayments();

</script>

<style scoped lang="scss"></style>
