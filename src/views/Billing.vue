<template>
  <div class="container-fluid mt-4">
    <div class="row">
      <div class="col-lg-8 col-sm-8">
        <nav-pill />
        <div class="row">
          <div class="col-lg-12">
            <div class="row mt-0">
              <!-- <div class="col-xl-6 mb-xl-0 mb-4">
                <master-card />
              </div>
              <div class="col-xl-6">
                <div class="row">
                  <div class="col-md-6">
                    <default-info-card
                      icon="text-white fas fa-landmark"
                      title="Salary"
                      description="Belong Interactive"
                      value="+$2000"
                    />
                  </div>
                  <div class="col-md-6">
                    <default-info-card
                      icon="text-white fab fa-paypal"
                      title="Paypal"
                      description="Freelance Payment"
                      value="$455.00"
                    />
                  </div>
                </div>
              </div> -->
              <div class="col-md-12">
                <payment-methods-card />
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
import NavPill from "./components/NavPill.vue";
// import MasterCard from "@/examples/Cards/MasterCard.vue";
// import DefaultInfoCard from "@/examples/Cards/DefaultInfoCard.vue";
import PaymentMethodsCard from "./components/PaymentMethodsCard.vue";
import InvoiceCard from "./components/InvoiceCard.vue";

export default {
  name: "Billing",
  components: {
    NavPill,
    // MasterCard,
    // DefaultInfoCard,
    PaymentMethodsCard,
    InvoiceCard,
  },
  mounted() {
    setTooltip();
  },
};
</script>
