import { Payment } from "~/types/Payment/Index";
// This is used for form communication
type PaymentInput = Omit<Payment, "id"> & {
  password: string;
};
