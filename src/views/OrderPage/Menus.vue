<template>
    <div class="card">
        <div class="card-header pb-0 p-3">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <h5 class="mb-0"><b>Menu's</b></h5>
                </div>
                <div class="col-6 text-end">
                    <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" />
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
                  class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                >
                  Action
                </th>
                <th class="text-secondary opacity-7"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-if="this.menus.value == 0">
                  <td colspan="3">
                    <p class="align-middle text-center text-sm">No Data</p>
                  </td>
                </tr>
              <tr v-for="data in menus" :key="data.id">
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
  </template>
  
  <script>
  // import SoftButton from "@/components/SoftButton.vue";
  import img1 from "@/assets/img/logos/mastercard.png";
  import img2 from "@/assets/img/logos/visa.png";
  import { ref } from "vue";
  
  export default {
    name: "Menus",
    // components: {
    //   SoftButton,
    // },
    data() {
      return {
        img1,
        img2,
      };
    },
    setup() {
        let menus = ref([]);
        menus.value = 0;

        return {
            menus,
        }
    }
  };
  </script>
  