<template>
  <section style="background-color: #eee;">
    <div class="container justify-center py-5">
      <div class="d-flex flex-wrap">
        <div class="flex-grow-1 me-3">
          <div class="card shadow-0 border rounded-3">
            <div class="card-body" style="padding-bottom: 3px;">
              <div class="d-flex flex-wrap">
                <div class="col-12 col-lg-3 mb-4 mb-lg-0">
                  <div class="bg-image hover-zoom ripple rounded ripple-surface">
                    <img src="../assets/image/05.png" class="w-100" />
                    <a href="#!">
                      <div class="hover-overlay">
                        <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="col-12 col-lg-6 mb-2">
                  <h5 style="color: #5E5873;">Quant ruybi shirts</h5>
                  <span>By <span style="color: #7367F0;">Apple</span></span>
                  <div class="stars">
                    <slot></slot>
                  </div>
                  <div class="inStock">
                    {{ text }}
                  </div>
                  <div class="qty1">
                    <Qty1></Qty1>
                  </div>
                  <p class="text mb-4 mb-md-0 mt-2" style="color: #B9B9C3;">
                    Delivery by, Wed Apr 25
                  </p>
                  <p style="color: #28C76F;">5% off 1 offers Available</p>
                </div>
                <div class="col-12 col-lg-3 border-sm-start-none border-start">
                  <div class="d-flex flex-row align-items-center">
                    <h4 class="me-1 mt-3"
                      style="color: #7367F0; font-size: 14px; padding-left: 90px; padding-top: 20px;">
                      $499.99
                    </h4>
                  </div>
                  <div class="d-flex flex-column justify-content-center mt-2">
                    <AddToCardButton color="#F8F8F8" text="Wishlist" colorText="#5E5873" width="167px" height="38px"
                      raduis="5px" class="m-auto py-2">
                      <IconRemove class="w-5 h-5" />
                    </AddToCardButton>
                    <AddToCardButton class="addtocard m-auto" color="#7367F0" text="Add To Cart" colorText="#ffffff"
                      width="167px" height="38px" raduis="5px">
                      <ShopOutline />
                    </AddToCardButton>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- placeholder -->
        <div class="flex-shrink-0 col-md-4 d-flex flex-column">
          <div class="lg:w-96 md:w-8/12 w-full bg-gray-100 dark:bg-gray-900 h-full">
            <div
              class="flex flex-col lg:h-screen h-auto lg:px-8 md:px-7 px-4 lg:py-10 md:py-5 py-6 justify-between overflow-y-auto">
              <div>
                <p class="lg:text-3xl text-2xl font-black leading-6 text-gray-800 dark:text-white ">Summary</p>
                <div class="d-flex justify-content-between pt-3">
                  <p class="text-base leading-none text-gray-800 dark:text-white">Subtotal</p>
                  <p class="text-base leading-none text-gray-800 dark:text-white">$9,000</p>
                </div>
                <div class="d-flex justify-content-between pt-3">
                  <p class="text-base leading-none text-gray-800 dark:text-white">Shipping</p>
                  <p class="text-base leading-none text-gray-800 dark:text-white">$30</p>
                </div>
                <div class="d-flex justify-content-between pt-3">
                  <p class="text-base leading-none text-gray-800 dark:text-white">Tax</p>
                  <p class="text-base leading-none text-gray-800 dark:text-white">$35</p>
                </div>
              </div>
              <div>
                <hr>
              </div>
              <div>
                <div class="d-flex justify-content-between pb-2 lg:pt-5 pt-20">
                  <p class="text-2xl leading-normal text-gray-800 dark:text-white">Total</p>
                  <p class="text-2xl font-bold leading-normal text-right text-gray-800 dark:text-white">$10,240</p>
                </div>
                <button onclick="checkoutHandler1(true)"
                  class="text-base leading-none w-full py-3 bg-[#7367F0] border-gray-800 border focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 text-white dark:hover:bg-gray-700 font-bold">Place
                  Order</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</template>

<script setup>
import AddToCardButton from './basic/AddToCardButton.vue';
import IconRemove from './basic/IconRemove.vue';
import ShopOutline from './basic/ShopOutline.vue';
import Qty1 from './basic/Qty1.vue';
</script>

<style scoped>
@media (max-width: 767.98px) {
  .border-sm-start-none {
    border-left: none !important;
  }
}

.heart {
  /* margin-left: -40px; */
}

.button2 {
  gap: 10px;
  margin-left: 38px;
  /* padding-top: 20px; */
}

.inStock {
  color: #28C76F;
  font-size: 14px;
  padding-top: 9px;
}

.qty1 {
  margin-top: 10px;
  margin-bottom: -13px;
}

.stars {
  padding-top: 5px;
  margin-left: -3px;
}
</style>
