<template>
  <div>
    <b-card>
      <b-form inline @submit.stop.prevent>
        <label class="sr-only" for="inline-form-input-search">{{
          $t('common.search')
        }}</label>
        <b-input
          id="inline-form-input-search"
          v-model="filters.search"
          class="mb-2 mr-sm-2 mb-sm-0"
          style="min-width: 50%"
          type="text"
          :placeholder="$t('common.search')"
          autofocus
          trim
          :debounce="debounce"
          @update="onSearch"
        ></b-input>
        <label class="sr-only" for="inline-form-select-role">{{
          $t('common.user.role')
        }}</label>
        <b-form-select
          id="inline-form-select-role"
          v-model="filters.role"
          class="mb-2 mr-sm-2 mb-sm-0"
          :options="rolesAsSelectOptions(true)"
          @change="onSearch"
        >
        </b-form-select>
      </b-form>
    </b-card>
    <b-card class="mt-3">
      <b-table
        hover
        :responsive="true"
        :no-local-sorting="true"
        :sort-by="boostrapTableSortBy"
        :sort-desc="isDesc"
        :items="items"
        :fields="fields"
        :busy="isLoading"
        @sort-changed="onSort"
      >
        <template #cell(localization)="data">
          <b-button
            v-if="!data.localization"
            size="sm"
            variant="primary"
            @click="updateLocation"
          >
            {{ $t('common.payments.localization.buttonLabel') }}
          </b-button>
          <span v-else>{{ data.localization }}</span>
        </template>
        <template #table-busy>
          <div class="text-center my-2">
            <b-spinner class="align-middle" variant="primary"></b-spinner>
          </div>
        </template>
      </b-table>
      <b-pagination
        v-model="currentPage"
        :per-page="itemsPerPage"
        :total-rows="count"
        align="center"
        @change="onPaginate"
        @click.native="$scrollToTop"
      />
    </b-card>
  </div>
</template>

<script>
import { Form } from '@/mixins/form'
import { List, defaultItemsPerPage, calculateOffset } from '@/mixins/list'
import { Roles } from '@/mixins/roles'
import { AMOUNT } from '@/enums/filters/payments-sort-by'
import { PaymentsQuery } from '@/graphql/payments/payments.query'
import { UpdateLocationMutation } from '@/graphql/payments/update_location.mutation'
import { Images } from '@/mixins/images'

export default {
  mixins: [Form, List, Roles, Images],
  layout: 'dashboard',
  async asyncData(context) {
    try {
      const result = await context.app.$graphql.request(PaymentsQuery, {
        search: context.route.query.search || '',
        role: context.route.query.role || null,
        sortBy: context.route.query.sortBy || null,
        sortOrder: context.route.query.sortOrder || null,
        limit: defaultItemsPerPage,
        offset: calculateOffset(
          context.route.query.page || 1,
          defaultItemsPerPage
        ),
      })
      return {
        items: result.payments.items,
        count: result.payments.count,
      }
    } catch (e) {
      context.error(e)
    }
  },
  data() {
    return {
      filters: {
        search: this.$route.query.search || '',
        role: this.$route.query.role || null,
      },
      fields: [
        {
          key: 'createdAt',
          label: this.$t('common.payments.date_time.label'),
          sortable: false,
        },
        {
          key: 'amount',
          label: this.$t('common.payments.amount.label'),
          sortable: true,
        },
        {
          key: 'label',
          label: this.$t('common.payments.payment_label.label'),
          sortable: false,
        },
        {
          key: 'localization',
          label: this.$t('common.payments.localization.label'),
          sortable: false,
        },
      ],
      sortByMap: {
        amount: AMOUNT,
      },
    }
  },
  methods: {
    async doSearch() {
      this.isLoading = true
      this.updateRouter()
      try {
        const result = await this.$graphql.request(PaymentsQuery, {
          search: this.filters.search,
          role: this.filters.role,
          sortBy: this.sortBy,
          sortOrder: this.sortOrder,
          limit: this.itemsPerPage,
          offset: this.offset,
        })
        this.items = result.users.items
        this.count = result.users.count
        this.isLoading = false
      } catch (e) {
        this.$nuxt.error(e)
      }
    },
    async updateLocation() {
      const result = await this.$graphql.request(UpdateLocationMutation, {
        id: '93124f0f-7e51-11ef-97f5-0242ac120007',
        latitude: '29.969513',
        longitude: '76.878281',
      })
      console.log('result', result)
    },
  },
}
</script>
