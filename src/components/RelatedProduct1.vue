<template>
    <div class="container rounded-2" style="width: 296px; height: 280px;background-color: #ddd; ">
        <div class="row">
            <div class="col-sm-12 parents pt-2">
                <div>
                    <h5 style="color: #5E5873;">Apple Watch Series 5</h5>
                    <p style="text-align: center; margin-bottom: 0px; color: #6E6B7B;">by Apple</p>
                </div>
                <div>
                     <img :src="image" width="220" height="157" alt="">
                </div>
                <div class="text" style="width: 211.43px; height: 81px;">
                    <div class="stars" style="display: flex;justify-content: center;align-items: center;">
                         <slot/>
                    </div>
                    <!-- <img src="../assets/image/stars.png" alt=""/> -->
                    <p style="color: red; font-weight: 500; font-size: 18px; margin-top: 10px; text-align: center; margin-bottom: 0px;">$374.00</p>
                        <!-- <p>Built-in cellular lets you receive calls...</p> -->
                </div>
            </div>
        </div>
    </div>

</template>

<script>

export default {
    name: 'RelatedProduct1',
    props : ["image"],
    data(){
        return {

        }
    }
}
</script>


<style scoped>
.parents{
    display: flex;
    flex-direction:column;
    justify-content: center;
    align-items: center;
    /* margin-top: 25px; */
    /* gap: 19px; */
}

</style>