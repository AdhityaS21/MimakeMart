<template>
  <div class="py-4 container-fluid" v-if="this.$route.name === 'Categories'">
    <div class="row">
      <div class="col-12">
        <categories-table />
      </div>
    </div>
  </div>
  <router-view />
</template>

<script>
import CategoriesTable from "./components/CategoriesTable.vue";

export default {
  components: {
    CategoriesTable,
  },
};
</script>
