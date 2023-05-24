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
  // import { toast } from "vue3-toastify";
  import "vue3-toastify/dist/index.css";
  
  export default {
    components: {
      RolesTable,
    },

    setup(){
      // toast.success("Serach", {
      //   autoClose: 3000,
      // });
    },

    mounted(){
      //this.$emit.on("message", (msg) => {console.log(msg)});
    },

    // watch: {
    //   messages: function() {
    //     toast.success(this.messages, {
    //     autoClose: 3000,
    //     });
    //   }
    // }
  };
  </script>
  