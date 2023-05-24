<template>
  <div v-if="this.$route.name === 'Products'">
    <div class="card mb-4">
      <div class="card-header pb-0 mb-2">
        <div class="row flex d-flex">
          <div class="col-6">
            <h5><b>Products</b></h5>
          </div>
          <div class="col-6 d-flex justify-content-end">
            <div class="col-lg-4">
              <router-link :to="{ name: 'Add Product' }">
                <soft-button variant="gradient" color="success" full-width
                  >Add Product
                </soft-button>
              </router-link>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th
                  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                >
                  Product Name
                </th>
                <th
                  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"
                >
                  Price
                </th>
                <th
                  class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                >
                  Qty
                </th>
                <th
                  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"
                >
                  Category
                </th>
                <th
                  class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                >
                  Action
                </th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-if="this.products.length == 0">
                  <td colspan="3">
                    <p class="align-middle text-center text-sm">No Data</p>
                  </td>
                </tr>
              <tr v-for="data in products" :key="data.id">
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <soft-avatar
                        :img="data.Product_image"
                        size="lg"
                        border-radius="lg"
                        class="me-3"
                        alt="prod"
                      />
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <p class="text-xs font-weight-bold mb-0">{{ data.Product_Name }}</p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">{{ data.Pricesell }}</p>
                </td>
                <td class="align-middle text-center text-sm">
                  <p class="text-xs font-weight-bold mb-0">{{ data.Qty }}</p>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">{{ data.categories[0].Category }}</p>
                </td>
                <td class="align-middle text-center text-sm">
                  <div class="d-flex px-3 py-1">
                    <router-link
                      :to="{ name: 'Edit Product', params: { id: data.id } }"
                    >
                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </router-link>
                    <a
                      class="link ml-4"
                      href="javascript:;"
                      @click.prevent="openConfirm"
                    >
                      <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                    <lv-dialog header="Confirmation" v-model="displayConfirmation" :style="{ width: '350px' }" :modal="true">
                        <div class="confirmation-content">
                          <i class="light-icon-alert-triangle p-mr-3" style="font-size: 2rem;" />
                          <span>Are you sure want to proceed?</span>
                        </div>
                        <template #footer>
                          <lv-button label="No" icon="light-icon-x" @click="closeConfirmation" class="--text-button" />
                          <lv-button label="Yes" icon="light-icon-check" @click="closeConfirmation" class="--text-button" autofocus />
                        </template>
                      </lv-dialog>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <router-view></router-view>
</template>

<script>
import axios from "axios";
import { onMounted, ref } from "vue";
import SoftAvatar from "@/components/SoftAvatar.vue";
// import SoftBadge from "@/components/SoftBadge.vue";
import SoftButton from "@/components/SoftButton.vue";
// import SoftPaginationItem from "../../components/SoftPaginationItem.vue";
import useToast from "../../composable/useToast";
import { toast } from "vue3-toastify";
import LvDialog from "lightvue/dialog";
import LvButton from "lightvue/button";

export default {
  data() {
    return {
      displayConfirmation: false,
    };
  },

  components: {
    SoftAvatar,
    // SoftBadge,
    SoftButton,
    // SoftPaginationItem,
    LvButton,
    LvDialog
  },

  setup() {
    const { isShow, message } = useToast();
    let products = ref([]);

    onMounted(() => {
      axios
        .get("http://localhost:8000/api/products")
        .then((response) => {
          products.value = response.data.data;
          console.log(response.data.data)
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    });

    function destroy(id) {
      if (confirm("Do you really want to delete?")) {
        axios
          .delete(`http://localhost:8000/api/products/${id}`)
          .then(() => {
            products.value.splice(products.value.indexOf(id), 1);
          })
          .catch((error) => {
            console.log(error.response.data);
          });
      }
    }

    if(isShow.value){
      toast.success(message.value, {
        autoClose: 3000,
      })
    }

    return {
      products,
      destroy,
    };
  },
  methods: {
    openConfirm(){
      this.displayConfirmation = true;
    },
    closeConfirmation(){
      this.displayConfirmation = false;
    }
  }
};
</script>