<template>
  <div class="py-4 container-fluid" v-if="this.$route.name === 'Products'">
    <div class="row">
      <div class="col-12">
        <products-table />
      </div>
    </div>
  </div>
  <router-view />
</template>

<script>
import ProductsTable from "./components/ProductsTable";

export default {
  components: {
    ProductsTable,
  },
};
</script>
