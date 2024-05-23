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
            <div class="container">
              <h1>Sign Up</h1>
              <p>Please fill in this form to create an account.</p>
              <hr>

              <label for="email"><b>Email</b></label>
              <input type="text" placeholder="Enter Email" name="email" required>

              <label for="number"><b>Phone Number</b></label>
              <input type="tel" placeholder="+855 324 XXX XXX " name="number" id="">

              <label for="psw"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="psw" required>

              <label for="psw-repeat"><b>Confirm Password</b></label>
              <input type="password" placeholder="confirm Password" name="psw-repeat" required>

              <label>
                <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
              </label>

              <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

              <div class="clearfix">
                <RouterLink to="/">
                  <button type="button" class="cancelbtn">Cancel</button>
                </RouterLink>
                <button type="submit" class="signupbtn">Sign Up</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</template>


<script setup>


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

body {
  font-family: Arial, Helvetica, sans-serif;
}

* {
  box-sizing: border-box
}

/* Full-width input fields */
input[type=text],
input[type=password],
input[type=tel] {
  width: 100%;
  padding: 5px;
  margin: 2px 0 22px 0;
  display: inline-block;
  border: 1px solid #ccc;
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity: 1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 10px 10px;
  border-radius: 7px;
  background-color: #f44336;
  float: left;
  width: 40%;
}

/* Float cancel and signup buttons and add an equal width */
.signupbtn {
  padding: 10px 10px;
  border-radius: 7px;
  float: right;
  width: 40%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {

  .cancelbtn,
  .signupbtn {
    width: 100%;
  }
}
</style>