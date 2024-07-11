<template>
    <div class="container-fluid ">
        <div class="bg-img">
            <div class="container position-absolute">
                <div class="row justify-content-end">
                    <div class="col-6 ">
                        <form class="shadow-lg p-3 bg-white rounded-4 float-end" action="" method="post">
                            <div class="imgcontainer">
                                <h4>Welcome to <span style="color: #779341;">Admin</span></h4>
                                <h1>Sign in</h1>
                            </div>
                            <div class="container">
                                <label for="uname"><b>Username</b></label>
                                <input type="text" placeholder="Enter Username" name="uname" required>

                                <label for="psw"><b>Password</b></label>
                                <input type="password" placeholder="Enter Password" name="psw" required>

                                <label>
                                    <input type="checkbox" checked="checked" name="remember"> Remember me
                                </label>
                            </div>
                            <div class="container">
                                <button type="submit">Login</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</template>


<script>
// import AddToCardButton from "./basic/AddToCardButton.vue";
export default {
    name: 'AdminLogin',
    data() {
        return {

        }
    },
    components: {
        // AddToCardButton,
    }
}
</script>

<style scoped lang="scss">
.container {
    width: 100%;
    height: 100%;
    margin-top: 20px;
}

// .img{
//     background-position: center; /* Center the image */
//     height: 500px;
//     width: 500px;
//     margin-top: 100px;
//     background-repeat: no-repeat; /* Do not repeat the image */
//     background-size: cover; /* Resize the background image to cover the entire container */
// }
.container-fluid {
    background-image: url("/src/assets/image/abstract-1264071_1920.png");
    min-height: 715px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: 100% 100%;

    position: relative;
}

form {
    width: 75%;
}

.form-group .btn {
    width: 100%;
    margin-bottom: 10px;
}

.form-group {
    margin-top: 30px;
    // width: 80%;
}

body {
    font-family: Arial, Helvetica, sans-serif;
}

input[type=text],
input[type=password] {
    width: 100%;
    padding: 10px 20px;
    margin: 10px 0;
    display: inline-block;
    border: 1px solid #4aafa3;
    box-sizing: border-box;
    //   border: none;
}

button {
    background-color: #779341;
    ;
    color: white;
    padding: 10px 20px;
    margin: 10px 0;
    margin-bottom: 30px;
    border: none;
    border-radius: 7px;
    float: right;
    cursor: pointer;
    width: 25%;
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
    padding-left: 10px;
    margin: 24px 0 12px 0;
}

.imgcontainer h1 {
    padding-top: 20px;
    padding-bottom: 10px;
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