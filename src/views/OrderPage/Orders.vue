<template>
    <div class="container-fluid mt-4">
      <div class="row">
        <div class="col-lg-8 col-sm-8">
          <nav-pill />
          <div class="row">
            <div class="col-lg-12">
              <div class="row mt-0">
                <div class="col-md-12">
                  <menus />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <invoice-card />
        </div>
      </div>
    </div>
</template>

<script>
import setTooltip from "@/assets/js/tooltip.js";
import NavPill from "../components/NavPill.vue";
import Menus from "./Menus.vue";
import InvoiceCard from "../components/InvoiceCard.vue";

export default {
  name: "Orders",
  components: {
    NavPill,
    Menus,
    InvoiceCard,
  },
  mounted() {
    setTooltip();
  },
};
</script>