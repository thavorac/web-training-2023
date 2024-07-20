<template>
  <div class="container-fluid ">
    <!-- <AddToCardButton color="#0000FF" colorText="#FFFFFF" width="300px" height="100px" text="Shop Now"></AddToCardButton> -->
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-6">
          <form class="shadow-lg p-3 bg-white rounded" action="" method="post">
            <h1>Forgot password</h1>
            <p>Enter your email adress to reacquisition to your password.</p>
            <div class="container">
              <label for="uname"><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="uname" required>

              <label for="psw"><b>New Password</b></label>
              <input type="password" placeholder="Enter Password" name="psw" required>

              <label for="cpsw"><b>Confirm new Password</b></label>
              <input type="password" placeholder="Enter confirm Password" name="cpsw" required>



            </div>

            <div class="container">
              <RouterLink to="/sign-in">
                <button type="button" class="cancelbtn">Cancel</button>
              </RouterLink>
              <button type="submit" class="float-end">Save</button>
            </div>
            <span class="psw">Don't have an account?<RouterLink to="/sign-up">Sign Up</RouterLink></span>
          </form>
        </div>
      </div>
    </div>
  </div>

</template>


<script>
import { RouterLink } from 'vue-router';

// import AddToCardButton from "./basic/AddToCardButton.vue";
export default {
  name: 'Forgotpassword',
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

h1,
p {
  text-align: center;
}

button {
  background-color: #04AA6D;
  color: white;
  width: auto;
  padding: 10px 18px;
  //   padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  //   width: 100%;
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
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  // float: right;
  margin-left: 135px;
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
<template>
  <div class="container-fluid ">
    <!-- <AddToCardButton color="#0000FF" colorText="#FFFFFF" width="300px" height="100px" text="Shop Now"></AddToCardButton> -->
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-6">
          <form class="shadow-lg p-3 bg-white rounded" action="" method="post">
            <h1>Forgot password</h1>
            <p>Enter your email adress to reacquisition to your password.</p>
            <div class="container">
              <label for="uname"><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="uname" required>

              <label for="psw"><b>New Password</b></label>
              <input type="password" placeholder="Enter Password" name="psw" required>

              <label for="cpsw"><b>Confirm new Password</b></label>
              <input type="password" placeholder="Enter confirm Password" name="cpsw" required>



            </div>

            <div class="container">
              <RouterLink to="/sign-in">
                <button type="button" class="cancelbtn">Cancel</button>
              </RouterLink>
              <button type="submit" class="float-end">Save</button>
            </div>
            <span class="psw">Don't have an account?<RouterLink to="/sign-up">Sign Up</RouterLink></span>
          </form>
        </div>
      </div>
    </div>
  </div>

</template>


<script>
import { RouterLink } from 'vue-router';

// import AddToCardButton from "./basic/AddToCardButton.vue";
export default {
  name: 'Forgotpassword',
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

h1,
p {
  text-align: center;
}

button {
  background-color: #04AA6D;
  color: white;
  width: auto;
  padding: 10px 18px;
  //   padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  //   width: 100%;
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
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  // float: right;
  margin-left: 135px;
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