<template>
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
          <select v-model="selected" class="btn mb-0 bg-outline-success col-12">
            <option disabled value="" selected>Please select one</option>
            <option></option>
          </select>
        </div>
        <div class="mt-4">
          <soft-button variant="gradient" color="success" full-width
            >Add Product</soft-button
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SoftInput from "../components/SoftInput.vue";
import SoftButton from "../components/SoftButton.vue";

export default {
  components: {
    SoftInput,
    SoftButton,
  },
  data() {
    return {
      product: [],
      validation: [],
    };
  },
};
</script>
