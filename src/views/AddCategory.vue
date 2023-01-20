<template>
  <div class="card mb-4">
    <div class="card-header pb-0 mb-2">
      <div class="row flex d-flex">
        <div class="col-6">
          <h5><b>Add Category</b></h5>
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
</template>

<script>
import { reactive } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
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
    const category = reactive({
      category_name: "",
      validation: false,
    });
    const router = useRouter();

    function store() {
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
    return {
      category,
      router,
      store,
    };
  },
  data() {
    return {};
  },
};
</script>
