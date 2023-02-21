<template>
    <div class="py-4 container-fluid" v-if="this.$route.name === 'Users'">
      <div class="row">
        <div class="col-12">
          <users-table />
        </div>
      </div>
    </div>
    <router-view />
  </template>
  
  <script>
  import UsersTable from './UsersTable.vue';
  
  export default {
    components: {
      UsersTable,
    },
  };
  </script>
  