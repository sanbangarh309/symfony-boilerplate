export interface Payment {
  id: number;
  user_id: number;
  amount: number;
  label: string;
  latitude: string;
  longitude: string;
  localization: string;
  createdAt: string;
  updatedAt: string | null;
}

type PaymentInput = Omit<Payment, "id">


type LocationInput = {
  name: string;
}
