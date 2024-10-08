import { POST } from "~/constants/http";
import type { Payment } from "~/types/Payment/Index";
import useBasicError from "~/composables/useBasicError";

type PaymentInput = Omit<Payment, "id"> & {
  password: string;
};
export default function useCreatePayment() {
  const { $appFetch } = useNuxtApp();

  const { setError, resetError, errorMessage, error, violations } =
    useBasicError();

  return {
    errorMessage,
    error,
    violations,
    async createPayment(payment: PaymentInput) {
      try {
        resetError();
        const response = await $appFetch<Payment>("/payments/new", {
          method: POST,
          body: payment,
        });
        if (!response) {
          throw createError("Error while registering payment");
        }
        return response;
      } catch (e: any) {
        setError(e);
        throw e;
      }
    },
  };
}
