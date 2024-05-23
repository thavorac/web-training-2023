<template>
    <div class="menu-bar">
        <ul>
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">about us</a>
                <div class="sub-menu-1" >
                   <ul>
                        <li><a href="#">Mission</a></li>
                        <li><a href="#">Vision</a></li>
                        <li><a href="#">Team</a></li>
                        <li><a href="#">Leader</a></li>
                        <li><a href="#">Congrat</a></li>
                   </ul>
                   <ul>
                        <li><a href="#">Mission</a></li>
                        <li><a href="#">Vision</a></li>
                        <li><a href="#">Team</a></li>
                        <li><a href="#">Leader</a></li>
                        <li><a href="#">Congrat</a></li>
                   </ul>
                </div>

            </li>
            <li><a href="#">service</a>
                <div class="sub-menu-1">
                   <ul>
                        <li><a href="#">Mission</a></li>
                        <li><a href="#">Vision</a></li>
                        <li><a href="#">Team</a></li>
                        <li><a href="#">Leader</a></li>
                        <li><a href="#">Congrat</a></li>
                   </ul>
                </div>
            </li>
            <li><a href="#">women</a>
                <div class="sub-menu-1">
                   <ul>
                        <li><a href="#">Mission</a></li>
                        <li><a href="#">Vision</a></li>
                        <li><a href="#">Team</a></li>
                        <li><a href="#">Leader</a></li>
                        <li><a href="#">Congrat</a></li>
                   </ul>
                </div>
            </li>
            <li><a href="#">boy</a>
                <div class="sub-menu-1">
                   <ul>
                        <li><a href="#">Mission</a></li>
                        <li><a href="#">Vision</a></li>
                        <li><a href="#">Team</a></li>
                        <li><a href="#">Leader</a></li>
                        <li><a href="#">Congrat</a></li>
                   </ul>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>


export default{
    name : 'ListCategories',  
    data() {
      return{

      }
    }
}
</script>

<style scope>
    .menu-bar{
        background : rgb(0,100,0);
        text-align : center;
    }
    .menu-bar ul{
        display: inline-flex;
        list-style: none;
        color: #fff;
    }
    .menu-bar ul li{
        width : 120px;
        margin : 15px;
        padding : 15px;
    }
    .menu-bar ul li a{
        text-decoration: none;
        color: #fff;
    }
    .active,  .menu-bar ul li:hover{
        background: #2bab0d;
        border-radius: 3px;
    }
    .sub-menu-1{
        display: none;
    }
    .menu-bar ul li:hover .sub-menu-1{
        display: block;
        position: absolute;
        background: rgb(0,100,0);
        margin-top: 15px;
        margin-left: -15px;
    } 
    .menu-bar ul li:hover .sub-menu-1 ul {
        display: block;
        margin: 10px;
    }
    .menu-bar ul li:hover .sub-menu-1 ul li{
        width: 150px;
        padding: 10px;
        border-bottom: 1px doted #fff;
        background: transparent;
        border-radius: 0;
        text-align: left;
    }
    .menu-bar ul li:hover .sub-menu-1 ul li:last-child{
        border-bottom: none;
    }
    .menu-bar ul li:hover .sub-menu-1 ul li a:hover{
        color: #b2ff00;
    }

    

</style>
