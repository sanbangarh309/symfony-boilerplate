import { gql } from 'graphql-request'

export const PaymentFragment = gql`
  fragment PaymentFragment on Payment {
    id
    userName
    amount
    label
    latitude
    longitude
    localization
    createdAt
  }
`
