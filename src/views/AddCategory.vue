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
                <div class="mt-4">
                  <soft-button variant="gradient" color="success" full-width
                    >Add Product</soft-button
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
import { reactive } from "vue";
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

    if (!route.params.id) {
      const category = reactive({
        category_name: "",
        id: 0,
        validation: false,
      });

      return {
        category,
        store,
      };
    } else {
      const category = reactive({
        category_name: "",
        id: 1,
        validation: false,
      });

      axios
        .get(`http://localhost:8000/api/categories/${route.params.id}`)
        .then((response) => {
          category.category_name = response.data.data.Category;
          category.id = response.data.data.id;
          console.log(response);
        })
        .catch((error) => {
          console.log(error.response.data);
        });

      return {
        category,
        store,
      };
    }

    function store() {
      const category = reactive({
        category_name: "",
        id: 0,
        validation: false,
      });
      const router = useRouter();

      if (category.category_name != "") {
        let name = category.category_name;

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
        category.validation = true;
      }
    }
  },
};
</script>
