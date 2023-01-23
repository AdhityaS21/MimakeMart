<template>
  <div class="py-4 container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0 mb-2">
            <div class="row flex d-flex">
              <div class="col-6">
                <h5><b>Add Product</b></h5>
              </div>
            </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="row flex d-flex mx-4 mb-2">
              <form @submit.prevent="addProduct">
                <div class="px-2">
                  <label>Product Name</label>
                  <soft-input
                    id="product-name"
                    type="text"
                    placeholder="Product Name"
                    name="product-name"
                    v-model="product.name"
                  />
                  <label>Price</label>
                  <soft-input
                    id="price"
                    type="number"
                    placeholder="Price"
                    name="price"
                    v-model="product.price"
                  />
                  <label>Qty</label>
                  <soft-input
                    id="qty"
                    type="number"
                    placeholder="Qty"
                    name="qty"
                    v-model="product.qty"
                  />
                  <label>Category</label>
                  <select
                    v-model="category"
                    class="form-control mb-0 bg-outline-success col-12"
                  >
                    <option disabled value="0" selected>
                      Please Select Category
                    </option>
                    <option
                      v-for="data in categories"
                      :key="data.id"
                      :value="data.id"
                    >
                      {{ data.id }}. {{ data.Category }}
                    </option>
                  </select>
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
import SoftInput from "../components/SoftInput.vue";
import SoftButton from "../components/SoftButton.vue";
import axios from "axios";

export default {
  components: {
    SoftInput,
    SoftButton,
  },
  data() {
    return {
      product: [],
      validation: [],
      category: 0,
      categories: [],
    };
  },
  methods: {
    getCategories() {
      axios.get("http://localhost:8000/api/categories").then((response) => {
        this.categories = response.data.data;
      });
    },
    addProduct() {},
  },
  created() {
    this.getCategories();
  },
};
</script>
