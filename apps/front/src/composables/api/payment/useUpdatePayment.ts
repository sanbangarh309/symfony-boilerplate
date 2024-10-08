import { PUT } from "~/constants/http";
import type { Payment, PaymentInput } from "~/types/Payment/Index";
import useBasicError from "~/composables/useBasicError";

export default function useUpdatePayment() {
  const { $appFetch } = useNuxtApp();
  const { setError, resetError, errorMessage, violations } = useBasicError();
  return {
    errorMessage,
    violations,
    async updatePayment(paymentId: number, payment: PaymentInput) {
      try {
        resetError();
        const response = await $appFetch<Payment>("/payments/" + paymentId, {
          method: PUT,
          body: payment,
        });
        if (!response) {
          throw createError("Error while updating payment");
        }
        return response;
      } catch (e: any) {
        setError(e);
        throw e;
      }
    },
  };
}
