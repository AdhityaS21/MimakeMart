<template>
  <div class="py-4 container-fluid">
    <div class="row">
      <div class="col-12">
        <categories-table />
      </div>
    </div>
  </div>
</template>

<script>
import CategoriesTable from "./components/CategoriesTable.vue";

export default {
  components: {
    CategoriesTable,
  },
};
</script>
