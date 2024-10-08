<template>
  <div>
    <div>
      <NuxtLink to="/payments/add"
      
        ><Button>{{ $t("pages.payment.index.createButton") }}</Button></NuxtLink
      >
    </div>
    <List />
  </div>
</template>
<script setup lang="ts">
import List from "~/components/payment/List.vue";
</script>

<style scoped lang="scss"></style>
