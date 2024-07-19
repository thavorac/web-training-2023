<script setup>
import { RouterLink } from 'vue-router';

</script>

<template>
    <div>
        <RouterLink to="/electronic">Link to electronic</RouterLink>
        <div></div>
        <RouterLink to="/product-detail">link to Product Detail</RouterLink>
        <div></div>
        <RouterLink to="/main-page">Link to main-page</RouterLink>
        <RouterLink to="/advertising">Link to advertising</RouterLink>
        <RouterLink to="/buttonshop">Link to ButtonShop</RouterLink>
        <RouterLink to="/admin">Link to admin</RouterLink>
        <RouterLink to="/forgot-password">Link to forgot-password</RouterLink>
        <RouterLink to="/sign-in">Link to Signin</RouterLink>


        <RouterView />
    </div>
</template>