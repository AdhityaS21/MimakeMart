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
              <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <soft-avatar
                        :img="img1"
                        size="sm"
                        border-radius="lg"
                        class="me-3"
                        alt="user1"
                      />
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">John Michael</h6>
                      <p class="text-xs text-secondary mb-0">
                        john@creative-tim.com
                      </p>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">Manager</p>
                </td>
                <td class="align-middle text-center text-sm">
                  <p class="text-xs font-weight-bold mb-0">100</p>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">100</p>
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
import SoftAvatar from "@/components/SoftAvatar.vue";
// import SoftBadge from "@/components/SoftBadge.vue";
import SoftButton from "@/components/SoftButton.vue";
// import SoftPaginationItem from "../../components/SoftPaginationItem.vue";
import img1 from "../../assets/img/team-2.jpg";
import img2 from "../../assets/img/team-3.jpg";
import img3 from "../../assets/img/team-4.jpg";
import img4 from "../../assets/img/team-3.jpg";
import img5 from "../../assets/img/team-2.jpg";
import img6 from "../../assets/img/team-4.jpg";

export default {
  data() {
    return {
      img1,
      img2,
      img3,
      img4,
      img5,
      img6,
    };
  },
  components: {
    SoftAvatar,
    // SoftBadge,
    SoftButton,
    // SoftPaginationItem,
  },
};
</script>
