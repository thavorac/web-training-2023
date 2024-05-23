<template>
    <div class="container" style="background-color: whitesmoke; width: 1067px; height: 388px; border-radius: 8px;">
        <div class="row row2"  >
                                <div class="col-sm-2">
                                    <ul>
                                        <li><a href="#"><b>SHOE & BAG</b></a></li>
                                        <li><a href="#">Casual Shoes</a></li>
                                        <li><a href="#">Boots</a></li>
                                        <li><a href="#">Sandals</a></li>
                                        <li><a href="#">Slippers</a></li>  
                                    </ul>

                                    <ul>
                                        <li><a href="#"><b>Luxury & designer</b></a></li>
                                        <li><a href="#">Towels</a></li>
                                        <li><a href="#">Bathroom Scales</a></li>
                                        <li><a href="#">Bath Mats</a></li>
                                        <li><a href="#">Shower Caps</a></li>  
                                    </ul>
                                </div>
                                <div class="col-sm-2">
                                    <ul>
                                        <li><a href="#"><b>Home Textile</b></a></li>
                                        <li><a href="#">Bedding</a></li>
                                        <li><a href="#">Pillows</a></li>
                                        <li><a href="#">Handkerchief Towels</a></li>
                                        <li><a href="#">Curtain</a></li>  
                                    </ul>
                                    <ul>
                                        <li><a href="#"><b>Luxury & designer</b></a></li>
                                        <li><a href="#">Towels</a></li>
                                        <li><a href="#">Bathroom Scales</a></li>
                                        <li><a href="#">Bath Mats</a></li>
                                        <li><a href="#">Shower Caps</a></li>  
                                    </ul>
                                </div>
                                <div class="col-sm-2">
                                    <ul>
                                        <li><a href="#"><b>Party Supplies</b></a></li>
                                        <li><a href="#">Event & Party</a></li>
                                        <li><a href="#">Christmas</a></li>
                                        <li><a href="#">Artificial Decorations</a></li>
                                        <li><a href="#">Wedding</a></li>  
                                    </ul>
                                    <ul>
                                        <li><a href="#"><b>Luxury & designer</b></a></li>
                                        <li><a href="#">Towels</a></li>
                                        <li><a href="#">Bathroom Scales</a></li>
                                        <li><a href="#">Bath Mats</a></li>
                                        <li><a href="#">Shower Caps</a></li>  
                                    </ul>
                                </div>
                                <div class="col-sm-2">
                                    <ul>
                                        <li><a href="#"><b>Clothes</b></a></li>
                                        <li><a href="#">Bottoms</a></li>
                                        <li><a href="#">Women's Clothing</a></li>
                                        <li><a href="#">T-Shirts and Tops</a></li>
                                        <li><a href="#">Dresses</a></li>  
                                        <li><a href="#">Outerwear</a></li>
                                        <li><a href="#">Formal Wear</a></li>
                                        <li><a href="#">Casual Wear</a></li>
                                        <li><a href="#">Seasonal Collections</a></li>
                                        <li><a href="#">Sports Bras</a></li> 
                                        <li><a href="#">Workout Tops</a></li> 
                                        <li><a href="#">Fall Wardrobe</a></li>  
                                    </ul>
                                </div>
                                <div class="col-sm-4 pt-4 ps-5">
                                    <img src="../assets/image/image-363.png" alt="image">
                                </div>
                            </div>
    </div>
</template>

<script>
export default{
    name : 'ListMenu',
    data(){
        return {

        }
    }
}
</script>

<style scoped>

    /* .container{
        width: 1067px;
        height: 38px;
        border-radius: 8px;
    } */
    img{
        width: 278px;
        height: 340px;
    }
    .row1{
        background : rgb(0,100,0);
        text-align : center;
    }
    .row1 ul{
        display: inline-flex;
        list-style: none;
        color: #fff;
    }
    .row1 ul li{
        width : 120px;
        margin : 15px;
        padding : 15px;
    }
    .row1 ul li a{
        text-decoration: none;
        color: #fff;
    }
    .active,  .row1 ul li:hover{
        background: #2bab0d;
        border-radius: 3px;
    }
    .row2{
        display: none;
    }
    .row2 ul{
        display: block;
        list-style: none;
        /* color: #fff; */
    }
    .row2 ul li{
        width : 180px;
        /* margin : 15px; */
        padding-top : 15px; 
        line-height: 1;
    }
    .row2 ul li a{
        text-decoration: none;
        color: #0a0909;
    }
    .row2 ul li:hover{
        color: red;
        /* border-radius: 3px; */
    }
    .row2{
        display: flex;
    }
   .row1 ul li:hover .row2{
        display: block;
        position: absolute;
        background: rgb(0,100,0);
        margin-top: 40px;
        /* margin-left: -15px; */
    } 
     /* 
    .row1 ul li:hover .row2 ul {
        display: block;
        margin: 10px;
    }
    .row1 ul li:hover .row2 ul li{
        width: 150px;
        padding: 10px;
        border-bottom: 1px doted #fff;
        background: transparent;
        border-radius: 0;
        text-align: left;
    }
    .row1 ul li:hover .row2 ul li:last-child{
        border-bottom: none;
    }
    .row1 ul li:hover .row2 ul li a:hover{
        color: #b2ff00;
    } */
</style>