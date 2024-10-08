<template>
  <div class="grid">
    <div class="col-12">
      <form @submit.prevent.stop="submit">
        <div class="field col-12">
          <span class="p-float-label">
            <InputText
              id="payment-amount"
              v-model="state.amount"
              type="text"
              :placeholder="$t('components.payment.form.amount')"
              :class="{ 'p-invalid': violations.amount }"
            />
            <label for="payment-amount">{{
              $t("components.payment.form.amount")
            }}</label>
          </span>
          <small class="p-error">{{ violations.amount }}</small>
        </div>
        <div class="field col-12">
          <span class="p-float-label">
            <InputText
              id="payment-label"
              v-model="state.label"
              type="text"
              :placeholder="$t('components.payment.form.label')"
              :class="{ 'p-invalid': violations.label }"
            />
            <label for="payment-label">{{
              $t("components.payment.form.label")
            }}</label>
          </span>
          <small class="p-error">{{ violations.label }}</small>
        </div>
        <div class="field col-12">
          <span class="p-float-label">
            <InputText
              id="payment-label"
              v-model="state.latitude"
              type="text"
              :placeholder="$t('components.payment.form.latitude')"
              :class="{ 'p-invalid': violations.latitude }"
            />
            <label for="payment-label">{{
              $t("components.payment.form.latitude")
            }}</label>
          </span>
          <small class="p-error">{{ violations.latitude }}</small>
        </div>
        <div class="field col-12">
          <span class="p-float-label">
            <InputText
              id="payment-label"
              v-model="state.longitude"
              type="text"
              :placeholder="$t('components.payment.form.longitude')"
              :class="{ 'p-invalid': violations.longitude }"
            />
            <label for="payment-label">{{
              $t("components.payment.form.longitude")
            }}</label>
          </span>
          <small class="p-error">{{ violations.longitude }}</small>
        </div>

        <div>
          <slot name="buttons" :is-valid="isValid" :cancel="cancel">
            <Button
              type="button"
              severity="danger"
              class="mr-2 mb-2"
              @click="cancel"
            >
              {{ $t("components.payment.form.buttonCancel") }}
            </Button>
            <Button type="submit" :disabled="!isValid" class="mr-2 mb-2">
              {{ $t("components.payment.form.ok") }}
            </Button>
          </slot>
        </div>
      </form>
    </div>
  </div>
</template>
<script setup lang="ts">
import type { Payment } from "~/types/Payment/Index";

interface State extends Omit<Payment, "id"> {}
interface Props {
  defaultValue?: State;
  violations?: {
    [K in keyof State]?: string;
  } & {
    password?: string;
  };
}
const props = withDefaults(defineProps<Props>(), {
  defaultValue() {
    return {
        amount: "",
        label: "",
        latitude: "",
        longitude: "",
        createdAt: "",
        localization: "",
};
  },
  violations() {
    return {};
  },
});
const state = reactive({ ...props.defaultValue })
const password = ref("");
const passwordConfirm = ref("");

const isPasswordConfirmed = computed(
  () => password.value === passwordConfirm.value,
);

const isPasswordEmpty = computed(() => !password.value);
const securedPassword = computed(() =>
  isPasswordConfirmed && isPasswordEmpty ? password.value : "",
);
const isValid = isPasswordConfirmed;

interface EventEmitter {
  (
    e: "submit",
    value: Omit<Payment, "id"> & {
      password: string;
    },
  ): void;
  (e: "cancel"): void;
}

const emits = defineEmits<EventEmitter>();
const submit = () => {
  emits("submit", { ...state });
};
const cancel = () => {
  emits("cancel");
};
</script>

<style scoped lang="scss"></style>
