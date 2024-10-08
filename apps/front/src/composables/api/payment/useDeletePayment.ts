import type { Payment } from "~/types/Payment/Index";
import { DELETE } from "~/constants/http";
import useBasicError from "~/composables/useBasicError";

export default function useDeletePayment() {
  const { $appFetch } = useNuxtApp();

  const { setError, resetError, errorMessage } = useBasicError();
  return {
    errorMessage,
    deletePayment: async (user: Payment) => {
      try {
        resetError();
        const response = await $appFetch("/payments/" + user.id, {
          method: DELETE,
        });
        if (!response) {
          throw createError("Error while deleting payment");
        }
        return response;
      } catch (e: any) {
        await setError(e);
        throw e;
      }
    },
  };
}
