<template>
    <div class="menu">
        <a href="#">Woman</a>
        <a href="#">Male</a>
        <a href="#">Mother-Child</a>
        <a href="#">Home & Furniture</a>
        <a href="#">Super market</a>
        <a href="#">Cosmetics</a>
        <a href="#">Shoe & Bag</a>
        <a href="#">Electronic</a>
        <a href="#">Sport&Outdoor</a>
        <a href="#">Best seller</a>
    </div>
</template>
<script>
    export default {
        name: 'MenuProduct',
        data(){
            return {
            }
        }

    };

</script>
<style>
.menu{
    width: 1440px;
    height: 52px;
    justify-content: space-between;
    padding: 16px;
    display: flex;
}
.menu a{
    color: black;
}
a:hover {
  color: rgba(255, 122, 0, 1);
  background: white

}
</style>