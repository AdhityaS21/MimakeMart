<template>
  <div class="card h-100">
    <div class="card-header pb-0 p-3">
      <div class="row">
        <div class="d-flex align-items-center">
          <h5 class="mb-0"><b>Current Order</b></h5>
        </div>
        <div class="col-6 text-end"></div>
      </div>
    </div>
    <div class="card-body p-3 pb-0 mb-2">
      <ul class="list-group">
        <li
          class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg"
        >
          <ranking-list
            :item="[
              {
                title: 'Stripe',
                date: '+ $ 750',
                amount: '',
                icon: 'fa-arrow-up',
                color: 'success',
              },
            ]"
          />
        </li>
        <li
          class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg"
        >
          <div class="d-flex flex-column">
            <h6 class="text-dark mb-1 font-weight-bold text-sm">
              February, 10, 2021
            </h6>
            <span class="text-xs">#RV-126749</span>
          </div>
          <div class="d-flex align-items-center text-sm">
            $250
            <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4">
              <i class="fas fa-file-pdf text-lg me-1" aria-hidden="true"></i>
              PDF
            </button>
          </div>
        </li>
        <li
          class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg"
        >
          <div class="d-flex flex-column">
            <h6 class="text-dark mb-1 font-weight-bold text-sm">
              April, 05, 2020
            </h6>
            <span class="text-xs">#FB-212562</span>
          </div>
          <div class="d-flex align-items-center text-sm">
            $560
            <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4">
              <i class="fas fa-file-pdf text-lg me-1" aria-hidden="true"></i>
              PDF
            </button>
          </div>
        </li>
        <li
          class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg"
        >
          <div class="d-flex flex-column">
            <h6 class="text-dark mb-1 font-weight-bold text-sm">
              June, 25, 2019
            </h6>
            <span class="text-xs">#QW-103578</span>
          </div>
          <div class="d-flex align-items-center text-sm">
            $120
            <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4">
              <i class="fas fa-file-pdf text-lg me-1" aria-hidden="true"></i>
              PDF
            </button>
          </div>
        </li>
        <li
          class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg"
        >
          <div class="d-flex flex-column">
            <h6 class="text-dark mb-1 font-weight-bold text-sm">
              March, 01, 2019
            </h6>
            <span class="text-xs">#AR-803481</span>
          </div>
          <div class="d-flex align-items-center text-sm">$300</div>
        </li>
        <soft-button color="success" size="sm">Continue to Payment</soft-button>
      </ul>
    </div>
  </div>
</template>

<script>
import SoftButton from "@/components/SoftButton.vue";
import RankingList from "@/examples/Cards/RankingList.vue";

export default {
  name: "InvoiceCard",
  components: {
    SoftButton,
    RankingList,
  },
};
</script>
