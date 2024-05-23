<template>
  <section style="background-color: #eee;">
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-md-12 col-xl-10">
          <div class="card shadow-0 border rounded-3">
            <div class="card-body" style="padding-bottom: 3px;">
              <div class="row">
                <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                  <div class="bg-image hover-zoom ripple rounded ripple-surface">
                    <img src="../assets/image/05.png" class="w-100" />
                    <a href="#!">
                      <div class="hover-overlay">
                        <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6 mb-.2">
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
                <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                  <div class="d-flex flex-row align-items-center ">
                    <h4 class=" me-1 mt-3 "
                      style="color: #7367F0; font-size: 14px; padding-left: 90px; padding-top: 20px;">$499.99</h4>
                    <!-- <span class="text-danger"><s>$25.99</s></span> -->
                  </div>
                  <!-- <h6 class="text-success">Free shipping</h6> -->
                  <div class="d-flex flex-column justify-center mt-2 button2">
                    <AddToCardButton color="#F8F8F8" text="Wishlist" colorText="#5E5873" width="167px" height="38px"
                      raduis="5px">
                      <Heart class="heart" />
                    </AddToCardButton>
                    <AddToCardButton class="addtocard" color="#7367F0" text="Add To Cart" colorText="#ffffff"
                      width="167px" height="38px" raduis="5px">
                      <ShopOutline />
                    </AddToCardButton>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</template>

<script setup>
import AddToCardButton from './basic/AddToCardButton.vue'
import CartIcon from './basic/CartIcon.vue'
import Heart from './basic/Heart.vue'
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