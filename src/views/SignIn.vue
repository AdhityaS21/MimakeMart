<template>
  <div class="container top-0 position-sticky z-index-sticky">
    <div class="row">
      <div class="col-12">
        <navbar
          is-blur="blur blur-rounded my-3 py-2 start-0 end-0 mx-4 shadow"
          btn-background="bg-gradient-success"
          :dark-mode="true"
        />
      </div>
    </div>
  </div>
  <main class="mt-0 main-content main-content-bg">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="mx-auto col-xl-4 col-lg-5 col-md-6 d-flex flex-column">
              <div class="mt-8 card card-plain">
                <div class="pb-0 card-header text-start">
                  <h3 class="font-weight-bolder text-success text-gradient">
                    Welcome back
                  </h3>
                  <p class="mb-0">Enter your email and password to sign in</p>
                </div>
                <div class="card-body">
                  <form role="form" class="text-start" @submit.prevent="SignIn">
                    <soft-alert
                      color="danger"
                      dismissible
                      v-if="validation.status"
                      >Email or Password Incorrect</soft-alert
                    >
                    <label>Email</label>
                    <soft-input
                      id="email"
                      type="email"
                      placeholder="Email"
                      name="email"
                      v-model="user.email"
                      isRequired
                    />
                    <soft-alert
                      color="danger"
                      dismissible
                      v-bind:isValid="validation.email"
                      >Email Field Cannot Empty</soft-alert
                    >
                    <label>Password</label>
                    <soft-input
                      id="password"
                      type="password"
                      placeholder="Password"
                      name="password"
                      v-model="user.password"
                      isRequired
                    />
                    <soft-alert
                      color="danger"
                      dismissible
                      v-bind:isValid="validation.password"
                      >Password Field Cannot Empty</soft-alert
                    >
                    <soft-switch id="rememberMe" name="rememberMe" checked>
                      Remember me
                    </soft-switch>
                    <div class="text-center">
                      <soft-button
                        class="my-4 mb-2"
                        variant="gradient"
                        color="success"
                        full-width
                        type="submit"
                        :disabled="isLoading"
                      >
                        <div v-if="!isLoading">Sign In</div>
                        <div v-else>
                          <progress-spinner size="20px" strokeWidth="3" />
                        </div>
                      </soft-button>
                    </div>
                  </form>
                </div>
                <div class="px-1 pt-0 text-center card-footer px-lg-2">
                  <p class="mx-auto mb-4 text-sm">
                    Don't have an account?
                    <router-link
                      :to="{ name: 'Sign Up' }"
                      class="text-success text-gradient font-weight-bold"
                      >Sign up</router-link
                    >
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div
                class="top-0 oblique position-absolute h-100 d-md-block d-none me-n8"
              >
                <div
                  class="bg-cover oblique-image position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                  :style="{
                    backgroundImage:
                      'url(' +
                      require('@/assets/img/curved-images/curved9.jpg') +
                      ')',
                  }"
                ></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script>
import { ref } from "vue";
import Navbar from "@/examples/PageLayout/Navbar.vue";
import SoftInput from "@/components/SoftInput.vue";
import SoftSwitch from "@/components/SoftSwitch.vue";
import SoftButton from "@/components/SoftButton.vue";
import SoftAlert from "@/components/SoftAlert.vue";
const body = document.getElementsByTagName("body")[0];
import { mapMutations } from "vuex";
import axios from "axios";
import ProgressSpinner from "lightvue/progress-spinner";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

export default {
  name: "SignIn",
  components: {
    Navbar,
    SoftInput,
    SoftSwitch,
    SoftButton,
    SoftAlert,
    ProgressSpinner,
  },
  data() {
    return {
      user: [],
      loggedIn: localStorage.getItem("loggedIn"),
      token: localStorage.getItem("token"),
      validation: [],
      isLoading: ref(false),
    };
  },
  created() {
    this.toggleEveryDisplay();
    this.toggleHideConfig();
    body.classList.remove("bg-gray-100");
  },
  beforeUnmount() {
    this.toggleEveryDisplay();
    this.toggleHideConfig();
    body.classList.add("bg-gray-100");
  },
  methods: {
    ...mapMutations(["toggleEveryDisplay", "toggleHideConfig"]),
    SignIn() {
      if (this.user.email && this.user.password) {
        this.isLoading = true;
        axios
          .get("http://localhost:8000/sanctum/csrf-cookie")
          .then((response) => {
            console.log(response),
              axios
                .post("http://localhost:8000/api/login", {
                  email: this.user.email,
                  password: this.user.password,
                })
                .then((res) => {
                  console.log(res);
                  if (res.data.success) {
                    localStorage.setItem("loggedIn", true),
                      localStorage.setItem("token", res.data.token),
                      (this.loggedIn = true);

                    this.isLoading = false;
                    return this.$router.push({ name: "Dashboard" });
                  }
                })
                .catch((error) => {
                  this.showError(error.response.data.message[0]);
                  this.isLoading = !this.isLoading;
                  this.user.email = "";
                  this.user.password = "";
                });
          });
      }

      if (!this.user.email) {
        this.validation.email = true;
      }

      if (!this.user.password) {
        this.validation.password = true;
      }
    },

    showError(message) {
      toast.error(message, {
        autoClose: 3000,
      });
    },
  },
  mounted() {
    if (this.loggedIn) {
      return this.$router.push({ name: "Dashboard" });
    }
  },
};
</script>
