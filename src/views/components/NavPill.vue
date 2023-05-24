<template>
  <div class="nav-wrapper position-relative end-0">
    <ul class="nav nav-pills nav-fill p-1" role="tablist">
      <li class="nav-item">
        <a
          class="nav-link mb-0 px-0 py-1 active active"
          data-bs-toggle="tab"
          role="tab"
          aria-selected="true"
          @click="getAllMenu"
          >All</a
        >
      </li>
      <li class="nav-item">
        <a
          class="nav-link mb-0 px-0 py-1"
          data-bs-toggle="tab"
          @click="getFoodMenu"
          role="tab"
          aria-selected="false"
          >Foods</a
        >
      </li>
      <li class="nav-item">
        <a
          class="nav-link mb-0 px-0 py-1"
          data-bs-toggle="tab"
          @click="getDrinkMenu"
          role="tab"
          aria-selected="false"
          >Drinks</a
        >
      </li>
      <li class="nav-item">
        <a
          class="nav-link mb-0 px-0 py-1"
          data-bs-toggle="tab"
          @click="getSnackMenu"
          role="tab"
          aria-selected="false"
          >Snacks</a
        >
      </li>
      <li class="nav-item">
        <a
          class="nav-link mb-0 px-0 py-1"
          data-bs-toggle="tab"
          @click="getOtherMenu"
          role="tab"
          aria-selected="false"
          >Others</a
        >
      </li>
    </ul>
  </div>
</template>

<script>
import setNavPills from "@/assets/js/nav-pills.js";
import { onMounted } from "vue";

export default {
  name: "nav-pill",
  mounted() {
    setNavPills();
  },

  setup() {
    onMounted(() => {
      console.log("This is all menu")
    });
  },

  methods: {
    getAllMenu(){
      console.log("This is all menu")
    },
    getFoodMenu(){
      console.log("This is all food")
    },
    getDrinkMenu(){
      console.log("This is all drink")
    },
    getSnackMenu(){
      console.log("This is all snack")
    },
    getOtherMenu(){
      console.log("This is all other")
    }
  }
};
</script>
