<template>
    <div class="container-fluid ">
        <!-- <AddToCardButton color="#0000FF" colorText="#FFFFFF" width="300px" height="100px" text="Shop Now"></AddToCardButton> -->
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="img_bg"></div>
                </div>
                <div class="col-6">
                    <form class="shadow-lg p-3 bg-white rounded" action="" method="post">
                        <div class="imgcontainer">
                            <img src="/src/assets/image/acc.jpg" alt="Avatar" class="avatar">
                        </div>
                        <div class="container">
                            <label for="uname"><b>Username</b></label>
                            <input type="text" placeholder="Enter Username" name="uname" required>

                            <label for="psw"><b>Password</b></label>
                            <input type="password" placeholder="Enter Password" name="psw" required>

                            <button type="submit">Login</button>
                            <label>
                                <input type="checkbox" checked="checked" name="remember"> Remember me
                            </label>
                        </div>

                        <div class="container">
                            <RouterLink to="/">
                                <button type="button" class="cancelbtn">Cancel</button>
                            </RouterLink>
                            <RouterLink to="/forgot-password">
                                <span class="psw"><a href="#">Forgot password?</a></span>
                            </RouterLink>
                        </div>
                    </form>
                    <span class="sp ms-44">Don't have an account?<RouterLink to="/sign-up">Sign Up</RouterLink>
                    </span>
                </div>
            </div>
        </div>
    </div>

</template>


<script setup>
import { RouterLink } from 'vue-router';
import SignIn from './basic/SignIn.vue';
import ArrowLeft from './icons/ArrowLeft.vue';

</script>

<style scoped lang="scss">
.container {
    width: 100%;
    height: 100%;
    margin-top: 20px;
}

.img_bg {
    background-image: url("/src/assets/image/signin.jpg");
    /* The image used */
    background-position: center;
    /* Center the image */
    height: 500px;
    width: 500px;
    margin-top: 100px;
    background-repeat: no-repeat;
    /* Do not repeat the image */
    background-size: cover;
    /* Resize the background image to cover the entire container */
}

form {
    width: 85%;
}

.form-group .btn {
    width: 100%;
    margin-bottom: 10px;
}

.form-group {
    margin-top: 40px;
    // width: 80%;
}

body {
    font-family: Arial, Helvetica, sans-serif;
}

input[type=text],
input[type=password] {
    width: 100%;
    padding: 10px 20px;
    margin: 5px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #04AA6D;
    color: white;
    padding: 12px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 20px 0px 12px 0;
    padding-left: 190px;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
        display: block;
        float: none;
    }

    .cancelbtn {
        width: 100%;
    }
}
</style>