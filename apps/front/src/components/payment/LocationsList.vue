<template>
  <Dialog
    :visible="modelValue"
    modal
    header="Locations List"
    :style="{ width: '25rem' }"
    :closable="false"
  >
    <div class="flex items-center gap-4 mb-4">
      <Listbox
        v-model="selectedLocation"
        :options="locations"
        optionLabel="name"
        class="w-full md:w-56"
      >
        <template #item="slotProps">
          <div @click="setLocation(slotProps.option.name)">
            {{ slotProps.option.name }}
          </div>
        </template>
      </Listbox>
    </div>
    <div class="flex justify-end gap-2">
      <Button
        type="button"
        label="Cancel"
        severity="secondary"
        @click="closeModal"
      ></Button>
      <Button type="button" @click="saveLocation" :label="$t(`components.payment.list.setLocation`)" icon="pi pi-save" :loading="loading" />
    </div>
  </Dialog>
</template>

<script lang="ts" setup>
import { ref, defineProps, defineEmits } from "vue";
import Listbox from "primevue/listbox";
import useUpdatePayment from "~/composables/api/payment/useUpdatePayment";
const { updatePayment } = useUpdatePayment();
import type { Payment } from "~/types/Payment/Index";

const props = defineProps<{
  modelValue: boolean;
  locations: object;
  payment: Payment;
}>();

const loading = ref(false);

const emit = defineEmits<{
  (e: "update:modelValue", value: boolean): void;
}>();

const selectedLocation = ref(null);

const setLocation = async (location: string) => {
  selectedLocation.value = location;
};

const refreshPayments = async () => {
  emit("update-payments");
};

// Close modal and emit event
const closeModal = () => {
  emit("update:modelValue", false); // This tells the parent to close the modal
};

const saveLocation = async () => {
    loading.value = true;
  try {
    props.payment.localization = selectedLocation.value.name;
    await updatePayment(props.payment.id, props.payment);
    refreshPayments();
    closeModal();
  } catch (e) {
    logger.error(e);
    throw e;
  } finally {
    loading.value = false;
  }
};
</script>
