<template>
  <div class="py-4 container-fluid">
    <div class="row">
      <div class="col-12">
        <products-table />
      </div>
    </div>
  </div>
</template>

<script>
import ProductsTable from "./components/ProductsTable";

export default {
  name: "products",
  components: {
    ProductsTable,
  },
};
</script>
