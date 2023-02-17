<template>
  <div>
    <div class="card mb-4">
      <div class="card-header pb-0 mb-2">
        <div class="row flex d-flex">
          <div class="col-6">
            <h5><b>Categories</b></h5>
          </div>
          <div class="col-6 d-flex justify-content-end">
            <div class="col-lg-4">
              <router-link :to="{ name: 'Add Category' }">
                <soft-button variant="gradient" color="success" full-width
                  >Add Category
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
                  class="text-uppercase text-secondary text-xxs font-weight-bolder"
                >
                  No
                </th>
                <th
                  class="text-uppercase text-secondary text-xxs font-weight-bolder"
                >
                  Category
                </th>
                <th
                  class="text-uppercase text-secondary text-xxs font-weight-bolder"
                >
                  Action
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-if="this.categories.length == 0">
                <td colspan="3">
                  <p class="align-middle text-center text-sm">No Data</p>
                </td>
              </tr>
              <tr v-for="data in categories" :key="data.id">
                <td>
                  <div class="d-flex px-3 py-1">
                    <p class="align-middle text-center text-sm">
                      {{ this.nomer++ }}
                    </p>
                  </div>
                </td>
                <td>
                  <div class="d-flex px-3 py-1">
                    <p class="text-xs font-weight-bold mb-0">
                      {{ data.Category }}
                    </p>
                  </div>
                </td>
                <td>
                  <div class="d-flex px-3 py-1">
                    <router-link
                      :to="{ name: 'Edit Category', params: { id: data.id } }"
                    >
                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </router-link>
                    <a
                      class="link ml-4"
                      href="javascript:;"
                      @click.prevent="destroy(data.id)"
                    >
                      <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { onMounted, ref } from "vue";
// import SoftAvatar from "@/components/SoftAvatar.vue";
// import SoftBadge from "@/components/SoftBadge.vue";
import SoftButton from "@/components/SoftButton.vue";
// import SoftPaginationItem from "../../components/SoftPaginationItem.vue";

export default {
  setup() {
    let categories = ref([]);
    let nomer = 1;

    onMounted(() => {
      axios
        .get("http://localhost:8000/api/categories")
        .then((response) => {
          categories.value = response.data.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    });

    function destroy(id) {
      if (confirm("Do you really want to delete?")) {
        axios
          .delete(`http://localhost:8000/api/categories/${id}`)
          .then(() => {
            categories.value.splice(categories.value.indexOf(id), 1);
          })
          .catch((error) => {
            console.log(error.response.data);
          });
      }
    }

    return {
      categories,
      nomer,
      destroy,
    };
  },

  components: {
    // SoftAvatar,
    // SoftBadge,
    SoftButton,
    // SoftPaginationItem,
  },
};
</script>
