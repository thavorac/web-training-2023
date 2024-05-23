<template>
    <div class="container shadow rounded-2" style="width: 267.43px; height: 381px;">
        <div class="row">
            <div class="col-sm-12 parents">
                <div style="height: 221px;">
                     <!-- <img src="../assets/image/camera0.png" width="211.43" height="232" alt=""> -->
                     <img :src="camera0" width="211.43" height="232" alt="">
                </div>
                <div class="text" style="width: 211.43px; height: 81px;">
                    <h5>Apple Watch Series 5</h5>
                    <div class="stars">
                         <slot/>
                    </div>
                    <p style="color: red; font-weight: 500; font-size: 19px; margin-top: 10px;">$374.00
                        <span style="color: #ddd; font-size: 16px; font-weight: normal; margin-left: 20px;"><strike>$374.00</strike></span>
                    </p>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

export default {
    name: 'Sale',
    props : ["camera0"],
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
    margin-top: 25px;
    gap: 19px;
}

</style>