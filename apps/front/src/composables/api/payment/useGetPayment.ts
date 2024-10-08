import { GET } from "~/constants/http";
import type { Payment } from "~/types/Payment/Index";
import useAppFetch from "~/composables/useAppFetch";

export default async function useGetPayment(paymentId: string) {
  return useAppFetch<Payment>(() => "/users/" + paymentId, {
    key: "getUser" + paymentId,
    method: GET,
  });
}
  