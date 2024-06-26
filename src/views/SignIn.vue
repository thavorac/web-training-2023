<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap');
@import url('https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Alice&display=swap');
</style>

<template>
    <section
        style="background-color: #b7c3e1; font-size:20px;background-image: url('https://thumbs.dreamstime.com/z/summer-vacation-swimming-background-theme-water-sports-seashells-loose-sand-sunglasses-clothes-underwater-goggles-over-70771842.jpg?w=992'); background-repeat: no-repeat, repeat; background-position: center;background-size: cover;"
        class="section product">
        <div style="border-radius:7px;width:550px; border:1px solid white;background-color:white;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); "
            class="container">

            <h1 style="font-family: 'Alice', serif; font-weight:700;color:black;padding-top:23px;"
                class="h2 section-title text-center">Login Form</h1>

            <div style="width: 500px; text-align:center; margin-left:20px;font-family: 'EB Garamond', serif;">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam odio neque non cum laborum? Sint
                    exercitationem ipsam consectetur error .</p>
            </div>


            <!-- Pills navs -->

            <div class="content" style="margin-top: 70px;">
                <ul style="width:500px; margin:0px auto;gap:18px;" class="nav nav-pills nav-justified mb-3" id="ex1"
                    role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab"
                            aria-controls="pills-login" aria-selected="true"
                            style="width:196px; height:45px; padding:13px 29px 16px; font-size:12px;background-color:#e3ebf7; color:#285192;font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; margin-left:40px;font-weight: 670;">Login</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="/sign-up" role="tab"
                            aria-controls="pills-register" aria-selected="false"
                            style="width:196px; height:45px;color: #0000003C; font-size:12px; background-color:#F7F7F7;  padding: 13px 29px 16px;font-weight: 800;">Register</a>
                    </li>
                </ul>
                <!-- Pills navs -->

                <!-- Pills content -->
                <div class="tab-content " style="width:416px; margin:0px auto;">
                    <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                        <form>
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input
                                    style=" font-size:12px; padding:10px 24px 8px 10px; width:416px; height:36px;margin:0px 0px 24px;margin-top: 23px; "
                                    type="email" id="loginName" class="form-control" placeholder="Email or username" />

                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="loginPassword" class="form-control"
                                    style=" font-size:12px; padding:10px 24px 8px 10px; width:416px; height:36px;margin:0px 0px 24px; "
                                    placeholder="Password" />

                            </div>

                            <!-- 2 column grid layout -->
                            <div style="color: #4F4F4F; font-size:16px; padding: 0px 0px 0px 2.4px; " class="row mb-4">
                                <div class="col-md-6 d-flex justify-content-center">
                                    <!-- Checkbox -->
                                    <div class="form-check mb-3 mb-md-0">
                                        <input class="form-check-input" type="checkbox" value="" id="loginCheck"
                                            checked />
                                        <label class="form-check-label" for="loginCheck"> Remember me </label>
                                    </div>
                                </div>

                                <div class="col-md-6 d-flex justify-content-center">
                                    <!-- Simple link -->
                                    <a href="#!">Forgot password?</a>
                                </div>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block mb-4 text-center"
                                style="color: #FFFFF; font-size:12px; background-color:#3B71CA; padding:10px 24px 8px; width:416px; height:36px;margin:0px 0px 24px;border:none;text-align:center; font-weight: 500; margin-top:23px;">Sign
                                in</button>

                            <!-- Register buttons -->
                            <div style="style=color: #4F4F4F; font-size:16px;margin:0px 0px 16px; display:flex;margin-left: 121px; gap: 10px;"
                                class="text-center">
                                <p>Not a member?</p>
                                <span> <a href="/sign-up">Register</a></span>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                        <form>
                            <div class="text-center mb-3">
                                <p>Sign up with:</p>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-facebook-f"></i>
                                </button>

                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-google"></i>
                                </button>

                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-twitter"></i>
                                </button>

                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-github"></i>
                                </button>
                            </div>

                            <p class="text-center">or:</p>

                            <!-- Name input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="registerName" class="form-control" />
                                <label class="form-label" for="registerName">Name</label>
                            </div>

                            <!-- Username input -->
                            <div class="form-outline mb-4">
                                <input type="text" id="registerUsername" class="form-control" />
                                <label class="form-label" for="registerUsername">Username</label>
                            </div>

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" id="registerEmail" class="form-control" />
                                <label class="form-label" for="registerEmail">Email</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="registerPassword" class="form-control" />
                                <label class="form-label" for="registerPassword">Password</label>
                            </div>

                            <!-- Repeat Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" id="registerRepeatPassword" class="form-control" />
                                <label class="form-label" for="registerRepeatPassword">Repeat password</label>
                            </div>

                            <!-- Checkbox -->
                            <div class="form-check d-flex justify-content-center mb-4">
                                <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" checked
                                    aria-describedby="registerCheckHelpText" />
                                <label class="form-check-label" for="registerCheck">
                                    I have read and agree to the terms
                                </label>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block mb-3">Sign in</button>
                        </form>
                    </div>
                </div>
                <!-- Pills content -->
            </div>

        </div>
    </section>
</template>