import { gql } from 'graphql-request'
import { PaymentFragment } from '@/graphql/payments/payment.fragment'

export const PaymentsQuery = gql`
  query payments(
    $search: String
    $role: Role
    $sortBy: UsersSortBy
    $sortOrder: SortOrder
    $limit: Int!
    $offset: Int!
  ) {
    payments(
      search: $search
      role: $role
      sortBy: $sortBy
      sortOrder: $sortOrder
    ) {
      items(limit: $limit, offset: $offset) {
        ...PaymentFragment
      }
      count
    }
  }
  ${PaymentFragment}
`
