<template>
  <div class="py-4 container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0 mb-2">
            <div class="row flex d-flex">
              <div class="col-6" v-if="product.id == 0">
                <h5><b>Add Product</b></h5>
              </div>
              <div class="col-6" v-if="product.id > 0">
                <h5><b>Edit Product</b></h5>
              </div>
            </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="row flex d-flex mx-4 mb-2">
              <form @submit.prevent="store">
                <div class="px-2">
                  <label>Product Image</label>
                  <soft-input
                    id="product-name"
                    type="file"
                    placeholder="Product Image"
                    name="product_image"
                    v-on:change="onChange"
                  />
                  <soft-alert color="danger" v-if="product.validation"
                    >Product Image Field Cannot Empty</soft-alert
                  >
                  <label>Product Name</label>
                  <soft-input
                    id="product-name"
                    type="text"
                    placeholder="Product Name"
                    name="product_name"
                    v-model="product.product_name"
                  />
                  <soft-alert color="danger" v-if="product.validation"
                    >Product Name Field Cannot Empty</soft-alert
                  >
                  <label>Price</label>
                  <soft-input
                    id="price"
                    type="number"
                    placeholder="Price"
                    name="pricesell"
                    v-model="product.pricesell"
                  />
                  <soft-alert color="danger" v-if="product.validation"
                    >Price Field Cannot Empty</soft-alert
                  >
                  <label>Qty</label>
                  <soft-input
                    id="qty"
                    type="number"
                    placeholder="Qty"
                    name="qty"
                    v-model="product.qty"
                  />
                  <soft-alert color="danger" v-if="product.validation"
                    >Qty Field Cannot Empty</soft-alert
                  >
                  <label>Category</label>
                  <select
                    v-model="product.category_id"
                    class="form-control mb-0 bg-outline-success col-12"
                    name="category_id"
                  >
                    <option disabled value="0" selected>
                      Please Select Category
                    </option>
                    <option
                      v-for="data in categories"
                      :key="data.id"
                      :value="data.id"
                    >
                      {{ data.Category }}
                    </option>
                  </select>
                  <soft-alert color="danger" v-if="product.validation"
                    >Category Field Cannot Empty</soft-alert
                  >
                </div>
                <div class="mt-4" v-if="product.id == 0">
                  <soft-button variant="gradient" color="success" full-width
                    >Add Category</soft-button
                  >
                </div>
                <div class="mt-4" v-if="product.id > 0">
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
import SoftInput from "../../components/SoftInput.vue";
import SoftButton from "../../components/SoftButton.vue";
import SoftAlert from "../../components/SoftAlert.vue";
import axios from "axios";
import { useRouter, useRoute } from "vue-router";
import useToast from "../../composable/useToast";

export default {
  components: {
    SoftInput,
    SoftButton,
    SoftAlert
  },
  setup(){
    const { toggleToast } = useToast();
    const route = useRoute();
    const router = useRouter();
    const product = reactive({
      id: route.params.id ? route.params.id : "",
      product_image: "",
      product_name: "",
      pricesell: "",
      qty: "",
      category_id: "",
      validation: false,
    });

    if (route.params.id) {
      onMounted(() => {
        axios
          .get(`http://localhost:8000/api/products/${route.params.id}`)
          .then((response) => {
            product.id = response.data.data.id;
            product.product_name = response.data.data.Product_Name;
            product.pricesell = response.data.data.Pricesell;
            product.qty = response.data.data.Qty;
            product.category_id = response.data.data.Category_id;
          })
          .catch((error) => {
            console.log(error.response.data);
          });
      });
    }

    function store() {
      let image = product.product_image;
      let name = product.product_name;
      let pricesell = product.pricesell;
      let qty = product.qty;
      let category_id = product.category_id;
      const config = {
        headers: { 'content-type': 'multipart/form-data' }
      }

      if (image != "" || name != "" || pricesell != "" || qty != "" || category_id != "") {
        if (!route.params.id) {
          axios
            .post("http://localhost:8000/api/products", {
              product_image: image,
              product_name: name,
              pricesell: pricesell,
              qty: qty,
              category_id: category_id,
            }, config)
            .then((response) => {
              if (response.data.success) {
                console.log(response.data.data)
                toggleToast(true, response.data.message);
                return router.push({ name: "Products" });
              } else {
                return;
              }
            });
        } else {
          axios
            .put(`http://localhost:8000/api/products/${route.params.id}`, {
              product_image: image,
              product_name: name,
              pricesell: pricesell,
              qty: qty,
              category_id: category_id,
            }, config)
            .then((response) => {
              if (response.data.success) {
                toggleToast(true, response.data.message);
                return router.push({ name: "Products" });
              } else {
                return;
              }
            });
        }
      } else {
        product.validation = true;
      }
    }

    function onChange(e){
      console.log(e.target.files[0]);
      product.product_image = e.target.files[0];
      console.log(product.product_image);
    }

    return {
      product,
      store,
      onChange
    };
  },

  data() {
    return {
      validation: [],
      categories: [],
    };
  },
  methods: {
    getCategories() {
      axios.get("http://localhost:8000/api/categories").then((response) => {
        this.categories = response.data.data;
      });
    },
  },
  created() {
    this.getCategories();
  },
};
</script>
