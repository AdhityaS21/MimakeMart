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
                      isRequired
                    />
                    <soft-alert color="danger" v-if="role.validation"
                      >Role Name Field Cannot Empty</soft-alert
                    >
                  </div>
                  <div class="mt-4" v-if="role.id == 0">
                    <soft-button variant="gradient" color="success" full-width :disabled="isLoading"
                      >
                      <div v-if="!isLoading">Add Role</div>
                      <div v-else>
                          <progress-spinner size="20px" strokeWidth="3" />
                      </div>
                    </soft-button
                    >
                  </div>
                  <div class="mt-4" v-if="role.id > 0">
                    <soft-button variant="gradient" color="success" full-width :disabled="isLoading"
                      >
                      <div v-if="!isLoading">Update Role</div>
                      <div v-else>
                          <progress-spinner size="20px" strokeWidth="3" />
                      </div>
                    </soft-button
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
  import ProgressSpinner from "lightvue/progress-spinner";
  import useToast from "../../composable/useToast";
  
  
  export default {
    components: {
      SoftInput,
      SoftButton,
      SoftAlert,
      ProgressSpinner,
    },
    setup(){
      const { toggleToast } = useToast();
      const route = useRoute();
      const router = useRouter();
      const role = reactive({
        id: route.params.id ? route.params.id : "",
        role_name: "",
        validation: false,
      });
      let isLoading = false;
  
      if (route.params.id) {
        onMounted(() => {
          axios
            .get(`http://localhost:8000/api/roles/${route.params.id}`)
            .then((response) => {
              role.id = response.data.data.id;
              role.role_name = response.data.data.role;
            });
        });
      }
  
      function store() {
        let name = role.role_name;
  
        if (name != "") {
          isLoading = !isLoading;
          if (!route.params.id) {
            axios
              .post("http://localhost:8000/api/roles", {
                role_name: name,
              })
              .then((response) => {
                if (response.data.success) {
                  isLoading = !isLoading;
                  toggleToast(true, response.data.message);
                  return router.push({ name: "Roles" });
                } else {
                  isLoading = !isLoading;
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
                  isLoading = !isLoading;
                  toggleToast(true, response.data.message);
                  return router.push({ name: "Roles" });
                } else {
                  isLoading = !isLoading;
                  return;
                }
              });
          }
        }
      }
  
      return {
        role,
        store,
        isLoading,
        toggleToast,
      };
    },
  };
  </script>