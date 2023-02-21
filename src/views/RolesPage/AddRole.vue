<template>
    <div class="py-4 container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0 mb-2">
              <div class="row flex d-flex">
                <div class="col-6" v-if="role.id == 0">
                  <h5><b>Add Role</b></h5>
                </div>
                <div class="col-6" v-if="role.id > 0">
                  <h5><b>Edit Role</b></h5>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="row flex d-flex mx-4 mb-2">
                <form @submit.prevent="store">
                  <div class="px-2">
                    <label>Role Name</label>
                    <soft-input
                      id="role-name"
                      type="text"
                      placeholder="Role Name"
                      name="role_name"
                      v-model="role.role_name"
                    />
                    <soft-alert color="danger" v-if="role.validation"
                      >Role Name Field Cannot Empty</soft-alert
                    >
                  </div>
                  <div class="mt-4" v-if="role.id == 0">
                    <soft-button variant="gradient" color="success" full-width
                      >Add Role</soft-button
                    >
                  </div>
                  <div class="mt-4" v-if="role.id > 0">
                    <soft-button variant="gradient" color="success" full-width
                      >Update Role</soft-button
                    >
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { reactive, onMounted } from "vue";
  import SoftInput from "../../components/SoftInput.vue";
  import SoftButton from "../../components/SoftButton.vue";
  import SoftAlert from "../../components/SoftAlert.vue";
  import axios from "axios";
  import { useRouter, useRoute } from "vue-router";
  
  export default {
    components: {
      SoftInput,
      SoftButton,
      SoftAlert
    },
    setup(){
      const route = useRoute();
      const router = useRouter();
      const role = reactive({
        id: route.params.id ? route.params.id : "",
        role_name: "",
        validation: false,
      });
  
      if (route.params.id) {
        onMounted(() => {
          axios
            .get(`http://localhost:8000/api/roles/${route.params.id}`)
            .then((response) => {
              role.id = response.data.data.id;
              role.role_name = response.data.data.role;
            })
            .catch((error) => {
              console.log(error.response.data);
            });
        });
      }
  
      function store() {
        let name = role.role_name;
  
        if (name != "") {
          if (!route.params.id) {
            axios
              .post("http://localhost:8000/api/roles", {
                role_name: name,
              })
              .then((response) => {
                if (response.data.success) {
                  return router.push({ name: "Roles" });
                } else {
                  return;
                }
              });
          } else {
            axios
              .put(`http://localhost:8000/api/roles/${route.params.id}`, {
                role_name: name,
              })
              .then((response) => {
                if (response.data.success) {
                  return router.push({ name: "Roles" });
                } else {
                  return;
                }
              });
          }
        } else {
          role.validation = true;
        }
      }
  
      return {
        role,
        store,
      };
    },
  };
  </script>
  