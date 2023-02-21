<template>
    <div class="py-4 container-fluid" v-if="this.$route.name === 'Roles'">
      <div class="row">
        <div class="col-12">
          <roles-table />
        </div>
      </div>
    </div>
    <router-view />
  </template>
  
  <script>
  import RolesTable from './RolesTable.vue';
  
  export default {
    components: {
      RolesTable,
    },
  };
  </script>
  