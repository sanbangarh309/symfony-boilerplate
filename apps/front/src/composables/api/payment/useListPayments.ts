import type { Payment } from "~/types/Payment/Index";
import { GET } from "~/constants/http";
import useAppFetch from "~/composables/useAppFetch";

interface Locations {
  name: string;
}

export default async function useListPayments() {
  return useAppFetch<Array<Payment>>(() => "/payments", {
    key: "listPayments",
    method: GET,
    lazy: true,
  });
}

export async function getLocations(paymentId: number) { console.log('fetch locationsssss', paymentId)
  return useAppFetch<Array<Locations>>(() => `/payments/locations/${paymentId}`, {
    key: "listLocations",
    method: GET,
    lazy: true,
  });
}
