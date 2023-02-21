<template>
  <div class="py-4 container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0 mb-2">
            <div class="row flex d-flex">
              <div class="col-6" v-if="category.id == 0">
                <h5><b>Add Category</b></h5>
              </div>
              <div class="col-6" v-if="category.id > 0">
                <h5><b>Edit Category</b></h5>
              </div>
            </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="row flex d-flex mx-4 mb-2">
              <form @submit.prevent="store">
                <div class="px-2">
                  <label>Category</label>
                  <soft-input
                    id="category"
                    type="text"
                    placeholder="Category"
                    name="category"
                    v-model="category.category_name"
                  />
                  <soft-alert color="danger" v-if="category.validation"
                    >Category Field Cannot Empty</soft-alert
                  >
                </div>
                <div class="mt-4" v-if="category.id == 0">
                  <soft-button variant="gradient" color="success" full-width
                    >Add Category</soft-button
                  >
                </div>
                <div class="mt-4" v-if="category.id > 0">
                  <soft-button variant="gradient" color="success" full-width
                    >Update Category</soft-button
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
import axios from "axios";
import { useRouter, useRoute } from "vue-router";
import SoftInput from "../components/SoftInput.vue";
import SoftButton from "../components/SoftButton.vue";
import SoftAlert from "../components/SoftAlert.vue";

export default {
  components: {
    SoftInput,
    SoftButton,
    SoftAlert,
  },

  setup() {
    const route = useRoute();
    const router = useRouter();
    const category = reactive({
      category_name: "",
      id: route.params.id ? route.params.id : "",
      validation: false,
    });

    if (route.params.id) {
      onMounted(() => {
        axios
          .get(`http://localhost:8000/api/categories/${route.params.id}`)
          .then((response) => {
            category.category_name = response.data.data.Category;
            category.id = response.data.data.id;
          })
          .catch((error) => {
            console.log(error.response.data);
          });
      });
    }

    function store() {
      let name = category.category_name;

      if (name != "") {
        if (!route.params.id) {
          axios
            .post("http://localhost:8000/api/categories", { category: name })
            .then((response) => {
              if (response.data.success) {
                return router.push({ name: "Categories" });
              } else {
                return;
              }
            });
        } else {
          axios
            .put(`http://localhost:8000/api/categories/${route.params.id}`, {
              category: name,
            })
            .then((response) => {
              if (response.data.success) {
                return router.push({ name: "Categories" });
              } else {
                return;
              }
            });
        }
      } else {
        category.validation = true;
      }
    }
    return {
      category,
      store,
    };
  },
  methods: {},
};
</script>
