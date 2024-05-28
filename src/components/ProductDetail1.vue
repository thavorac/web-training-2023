<template>
    <div class="container border" style="background-color: white;">
        <div class="row">
            <div class="col-sm-3">
                <img style="margin-top: 130px;" src="../assets/image/01.png" alt="">
            </div>
            <div class="col-sm-8 mt-2">
                <div class="col-md-6 col-lg-6 col-xl-6">
                    <h5 style="color: #5E5873;">Quant ruybi shirts</h5>
                    <span style="color: #6E6B7B;">By <span
                            style="color: #6E6B7B; margin: 0px;font-weight:bold;">Apple</span></span>
                    <h4 class=" me-1 mt-2 " style="color: #7367F0; font-size: 16px; font-weight: normal; margin: 0px;">
                        $499.99</h4>
                    <!-- <span>
                            <div>
                                <slot/>
                            </div>
                        </span> -->
                    <p style="padding-top: 5px;  margin: 0px;">Available - <span class="inStock">{{ text }}</span></p>
                    <p class="text mb-4 mb-md-0 mt-1" style="width: 539px; color: #6E6B7B;">
                        GPS, Always-On Retina display, 30% larger screen,
                        Swimproof, ECG app, Electrical and optical heart
                        sensors, Built-in compass, Elevation, Emergency SOS,
                        Fall Detection, S5 SiP with up to 2x faster 64-bit
                        dual-core processor, watchOS 6 with Activity trends,
                        cycle tracking, hearing health innovations, and the
                        App Store on your wrist
                    </p>
                    <ButtonShipping style="padding-top: 7px;" text="Free Shipping">
                        <ShopIcon></ShopIcon>
                    </ButtonShipping>
                    <ButtonShipping style="padding-top: 10px;" text="EMI options available">
                        <Shipping></Shipping>
                    </ButtonShipping>
                    <hr style="border:1px solid #EBE9F1; width: 535px; height: 1px; margin-top: 15px;">
                    <p style="color: #5E5873; font-weight: 600;">Colors</p>
                    <div class="color1">
                        <div class="dot1" style="border-color:red ;">
                            <span class="dot" style="background-color: red;"></span>
                        </div>
                        <div class="dot1" style="border-color:blue ;">
                            <span class="dot" style="background-color: blue;"></span>
                        </div>
                        <div class="dot1" style="border-color:gray;">
                            <span class="dot" style="background-color: gray;"></span>
                        </div>
                        <div class="dot1" style="border-color:green;">
                            <span class="dot" style="background-color: green;"></span>
                        </div>
                        <div class="dot1" style="border-color:yellow;">
                            <span class="dot" style="background-color: yellow;"></span>
                        </div>
                    </div>
                    <hr style="border:1px solid #EBE9F1; width: 535px; height: 1px;">
                    <div class="button mb-4 gap-2">
                        <AddToCardButton class="addtocard" color="#7367F0" text="Add To Cart" colorText="#ffffff"
                            width="155px" height="38px" raduis="2px">
                            <ShopOutline />
                        </AddToCardButton>
                        <AddToCardButton color="#fffff" text="Wishlist" colorText="#7367F0" width="118px" height="38px"
                            raduis="3px" border="1px solid #7367F0">
                            <Heart class="heart" />
                        </AddToCardButton>
                        <button
                            style="border: 1px solid #7367F0; background-color: white; color: #EBE9F1 ; border-radius: 3px; height: 38px;">
                            <Share></Share>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import ButtonShipping from './basic/ButtonShipping.vue';
import ShopIcon from './basic/ShopIcon.vue';
import Shipping from './basic/Shipping.vue';
import AddToCardButton from './basic/AddToCardButton.vue';
import Heart from './basic/Heart.vue';
import ShopOutline from './basic/ShopOutline.vue';
import Share from './basic/Share.vue';

</script>

<style scoped>
.inStock {
    color: #28C76F;
    font-size: 14px;
    padding-top: 9px;
}

.color {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    gap: 7px;
    position: absolute;
    /* position: relative; */
}

.button {
    width: 338px;
    height: 38px;
    display: flex;
    font-size: 14px;
    gap: 20px;
}

.color,
.dot {
    height: 20px;
    width: 20px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block;
    position: relative;
    left: 1.7px;
    top: 1.6px;

    /* margin-left: 7px; */
}

.dot1 {
    height: 27px;
    width: 27px;
    /* background-color: ; */
    border: 2px #bbb solid;
    border-radius: 50%;
    display: inline-block;
    margin-left: 7px;
    /* padding: 10px; */
}

.heart {
    color: #82868B;
}
</style>