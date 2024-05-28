<template>
  <section style="background-color: #eee;">
    <SearchButton class="py-3" />
    <div class="container py-1">
      <div class="row justify-content-center mb-3">
        <div class="col-md-12 col-xl-10">
          <div class="card shadow-0 border rounded-3">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12 col-lg-3 col-xl-3 mb-lg-0">
                  <div class="bg-image hover-zoom ripple rounded ripple-surface">
                    <img src="../assets/image/01.png" class="w-100" />
                    <a href="#!">
                      <div class="hover-overlay">
                        <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6 mb-.2">
                  <h5>Quant trident shirts</h5> <span>By <span style="color: #7367F0;">Apple</span></span>
                  <div>
                    <slot></slot>
                  </div>
                  <p class="text mb-4 mb-md-0 mt-2">
                    All‑new dual‑camera system. Take your photos from wide to ultra-wide.
                    A redesigned interface uses the new Ultra Wide camera to show you what’s
                    happening outside the frame and lets you capture it.
                  </p>
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
                    <!-- <button class="btn btn-primary btn-sm" type="button">Details</button> -->
                    <!-- <button class="btn btn-outline-primary btn-sm mt-2" type="button">
                    Add to wishlist
                  </button> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center mb-3">
        <div class="col-md-12 col-xl-10">
          <div class="card shadow-0 border rounded-3">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                  <div class="bg-image hover-zoom ripple rounded ripple-surface">
                    <img src="../assets/image/02.png" />
                    <a href="#!">
                      <div class="hover-overlay">
                        <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <h5>Quant olap shirts</h5>
                  <span>By <span style="color: #7367F0;">Apple</span></span>
                  <div>
                    <slot></slot>
                  </div>
                  <p class="text mb-4 mb-md-0 mt-2">
                    All‑new dual‑camera system. Take your photos from wide to ultra-wide.
                    A redesigned interface uses the new Ultra Wide camera to show you
                    what’s happening outside the frame and lets you capture it.
                  </p>
                </div>
                <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                  <div class="d-flex flex-row align-items-center ">
                    <h4 class=" me-1 mt-3 "
                      style="color: #7367F0; font-size: 14px; padding-left: 90px; padding-top: 20px;">$499.99</h4>
                    <!-- <span class="text-danger"><s>$25.99</s></span> -->
                  </div>
                  <h6
                    style="margin-left: 65px; padding-left: 8px; background-color: #CCFBE1; width: 105px; height: 20px; border-radius: 17px; color: #28C76F; font-size: 14px;">
                    Free shipping</h6>
                  <div class="d-flex flex-column justify-center mt-2 button2">
                    <AddToCardButton color="#F8F8F8" text="Wishlist" colorText="#5E5873" width="167px" height="38px"
                      raduis="5px">
                      <Heart class="heart" />
                    </AddToCardButton>
                    <AddToCardButton class="addtocard" color="#7367F0" text="Add To Cart" colorText="#ffffff"
                      width="167px" height="38px" raduis="5px">
                      <ShopOutline />
                    </AddToCardButton>
                    <!-- <button class="btn btn-primary btn-sm" type="button">Details</button> -->
                    <!-- <button class="btn btn-outline-primary btn-sm mt-2" type="button">
                    Add to wishlist
                  </button> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center mb-3">
        <div class="col-md-12 col-xl-10">
          <div class="card shadow-0 border rounded-3">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                  <div class="bg-image hover-zoom ripple rounded ripple-surface">
                    <img src="../assets/image/03.png" class="w-100" />
                    <a href="#!">
                      <div class="hover-overlay">
                        <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <h5>Quant ruybi shirts</h5>
                  <span>By <span style="color: #7367F0;">Apple</span></span>
                  <div>
                    <slot></slot>
                  </div>
                  <p class="text mb-4 mb-md-0 mt-2">
                    The all-in-one for all. If you can dream it,
                    you can do it on iMac. It’s beautifully designed,
                    incredibly intuitive and packed with powerful tools
                    that let you take any idea to the next level.
                  </p>
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
                    <!-- <button class="btn btn-primary btn-sm" type="button">Details</button> -->
                    <!-- <button class="btn btn-outline-primary btn-sm mt-2" type="button">
                    Add to wishlist
                  </button> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center mb-3">
        <div class="col-md-12 col-xl-10">
          <div class="card shadow-0 border rounded-3">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                  <div class="bg-image hover-zoom ripple rounded ripple-surface">
                    <img src="../assets/image/04.png" class="w-100" />
                    <a href="#!">
                      <div class="hover-overlay">
                        <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                      </div>
                    </a>
                  </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <h5>Quant ruybi shirts</h5>
                  <span>By <span style="color: #7367F0;">OneOdio</span></span>
                  <div>
                    <slot></slot>
                  </div>
                  <p class="text mb-4 mb-md-0 mt-2">
                    Omnidirectional detachable boom mic upgrades
                    the headphones into a professional headset for
                    gaming, business, podcasting and taking calls
                    on the go. Better pick up your voice.
                  </p>
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
                    <!-- <button class="btn btn-primary btn-sm" type="button">Details</button> -->
                    <!-- <button class="btn btn-outline-primary btn-sm mt-2" type="button">
                    Add to wishlist
                  </button> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row justify-content-center mb-3">
        <div class="col-md-12 col-xl-10">
          <div class="card shadow-0 border rounded-3">
            <div class="card-body">
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
                  <h5>Quant ruybi shirts</h5>
                  <span>By <span style="color: #7367F0;">Apple</span></span>
                  <div>
                    <slot></slot>

                  </div>
                  <p class="text mb-4 mb-md-0 mt-2">
                    Designed for those who defy limits
                    and change the world, the new MacBook
                    Pro is by far the most powerful notebook
                    we’ve ever made. With an immersive 16-inch
                    Retina display, super-fast processors,
                    next-generation graphics.
                  </p>
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
                    <!-- <button class="btn btn-primary btn-sm" type="button">Details</button> -->
                    <!-- <button class="btn btn-outline-primary btn-sm mt-2" type="button">
                    Add to wishlist
                  </button> -->
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

<script setup lang="ts">
import AddToCardButton from './basic/AddToCardButton.vue'
// import cart from './basic/cart.vue'
import CartIcon from './basic/CartIcon.vue';
import Heart from './basic/Heart.vue'
import ShopOutline from './basic/ShopOutline.vue';
import SearchButton from './basic/SearchButton.vue';
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
  margin-top: 0px;
  /* padding-top: 20px; */
}

h5 {
  color: #5E5873;
}
</style>