<template>
    <div class="py-4 container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0 mb-2">
              <div class="row flex d-flex">
                <div class="col-6" v-if="user.id == 0">
                  <h5><b>Add User</b></h5>
                </div>
                <div class="col-6" v-if="user.id > 0">
                  <h5><b>Edit User</b></h5>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="row flex d-flex mx-4 mb-2">
                <form @submit.prevent="store">
                  <div class="px-2">
                    <label>Name</label>
                    <soft-input
                      id="name"
                      type="text"
                      placeholder="Name"
                      name="name"
                      v-model="user.name"
                    />
                    <soft-alert color="danger" v-if="user.validation"
                      >Name Field Cannot Empty</soft-alert
                    >
                    <label>Email</label>
                    <soft-input
                      id="email"
                      type="email"
                      placeholder="Email"
                      name="email"
                      v-model="user.email"
                    />
                    <soft-alert color="danger" v-if="user.validation"
                      >Email Field Cannot Empty</soft-alert
                    >
                    <label>Password</label>
                    <soft-input
                      id="password"
                      type="password"
                      placeholder="Password"
                      name="password"
                      v-model="user.password"
                    />
                    <soft-alert color="danger" v-if="user.validation"
                      >Password Field Cannot Empty</soft-alert
                    >
                    <label>Role</label>
                    <select
                      v-model="user.role_id"
                      class="form-control mb-0 bg-outline-success col-12"
                      name="role_id"
                    >
                      <option disabled value="0" selected>
                        Please Select Role
                      </option>
                      <option
                        v-for="data in roles"
                        :key="data.id"
                        :value="data.id"
                      >
                        {{ data.id }}. {{ data.role }}
                      </option>
                    </select>
                    <soft-alert color="danger" v-if="user.validation"
                      >Role Field Cannot Empty</soft-alert
                    >
                  </div>
                  <div class="mt-4" v-if="user.id == 0">
                    <soft-button variant="gradient" color="success" full-width
                      >Add User</soft-button
                    >
                  </div>
                  <div class="mt-4" v-if="user.id > 0">
                    <soft-button variant="gradient" color="success" full-width
                      >Update User</soft-button
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
      const user = reactive({
        id: route.params.id ? route.params.id : "",
        name: "",
        email: "",
        password: "",
        role_id: "",
        validation: false,
      });
  
      if (route.params.id) {
        onMounted(() => {
          axios
            .get(`http://localhost:8000/api/users/${route.params.id}`)
            .then((response) => {
              user.id = response.data.data.id;
              user.name = response.data.data.name;
              user.email = response.data.data.email;
              user.password = response.data.data.password;
              user.role_id = response.data.data.level_id;
            })
            .catch((error) => {
              console.log(error.response.data);
            });
        });
      }
  
      function store() {
        let name = user.name;
        let email = user.email;
        let password = user.password;
        let role = user.role_id;
  
        if (name != "" || email != "" || password != "") {
          if (!route.params.id) {
            axios
              .post("http://localhost:8000/api/users", {
                name: name,
                email: email,
                password: password,
                level_id: role,
              })
              .then((response) => {
                if (response.data.success) {
                  return router.push({ name: "Users" });
                } else {
                  return;
                }
              });
          } else {
            axios
              .put(`http://localhost:8000/api/users/${route.params.id}`, {
                name: name,
                email: email,
                password: password,
                level_id: role,
              })
              .then((response) => {
                if (response.data.success) {
                  return router.push({ name: "Users" });
                } else {
                  return;
                }
              });
          }
        } else {
          user.validation = true;
        }
      }
  
      return {
        user,
        store,
      };
    },
  
    data() {
      return {
        validation: [],
        roles: [],
      };
    },
    methods: {
      getRoles() {
        axios.get("http://localhost:8000/api/roles").then((response) => {
          this.roles = response.data.data;
        });
      },
    },
    created() {
      this.getRoles();
    },
  };
  </script>
  