import { gql } from 'graphql-request'
import { PaymentFragment } from '@/graphql/payments/payment.fragment'

export const UpdateLocationMutation = gql`
  mutation updateLocation(
    $id: String!
    $latitude: String!
    $longitude: String!
  ) {
    updateLocation(
      payment: { id: $id }
      latitude: $latitude
      longitude: $longitude
    ) {
      ...PaymentFragment
    }
  }
  ${PaymentFragment}
`
