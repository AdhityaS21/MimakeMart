<template>
  <div v-if="this.$route.name === 'Categories'">
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
                  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                >
                  No
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
              <tr v-if="this.categories.length == 0">
                <td colspan="3">
                  <p class="align-middle text-center text-sm">No Data</p>
                </td>
              </tr>
              <tr v-for="data in categories" :key="data.id">
                <td>
                  <div class="d-flex px-2 py-1">
                    <p class="align-middle text-center text-sm">
                      {{ data.id }}
                    </p>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">
                    {{ data.Category }}
                  </p>
                </td>
                <td class="align-middle text-center text-sm">
                  <a
                    href="javascript:;"
                    class="text-secondary font-weight-bold text-xs"
                    data-toggle="tooltip"
                    data-original-title="Edit user"
                    >Edit</a
                  >
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
// import SoftAvatar from "@/components/SoftAvatar.vue";
// import SoftBadge from "@/components/SoftBadge.vue";
import SoftButton from "@/components/SoftButton.vue";
// import SoftPaginationItem from "../../components/SoftPaginationItem.vue";

export default {
  setup() {
    let categories = ref([]);

    onMounted(() => {
      axios
        .get("http://localhost:8000/api/categories")
        .then((response) => {
          categories.value = response.data.data;
          console.log(categories);
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    });

    return {
      categories,
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
