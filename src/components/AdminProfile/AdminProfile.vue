<script setup></script>

<template>
    <div class="container p-0 m-0 ">
        <div class="row ms-4">
            <div class="col-xl-12 mt-2 mb-2">
                <p class="s1">Setting</p>
            </div>
        </div>
        <div class="row ms-4">
            <div class="col-xl-12">
                <p class="s2">Hi, Samantha. Welcome back to CAMEAGLE Admin!</p>
            </div>
        </div>
        <div class="flex flex-col md:flex-row gap-4 md:gap-8">
            <div class=" col-xl-3 mt-3" style="border-radius: 10px;
            background: #FFF; width: 400px;
            height: 532px;  ">
                <div class="row">
                    <div class="col-xl-12 text-center mt-5">
                        <p class="s3">Profile</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 d-flex justify-content-center mt-3 ">
                        <img style="width:50%;" src="../../assets/image/01.png" alt="Description of the image">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 mt-4 text-center">
                        <p class="s4">Admin Fullname</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <p class="s5">Account admin of CamEagle</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 w-20 d-flex justify-content-center mt-4">
                        <input style="border-radius: 8px;
                        background: #F60;" type="submit" value="Change Profile" class="btn btnRegister form-control"
                            data-bs-toggle="modal" data-bs-target="#editmodal">
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fs-3 text-success" id="exampleModalLabel">Change Profile</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <!-- body modal -->
                                <div class="modal-body">
                                    <form action="action.php" class="w-100" method="post">
                                        <div class="row">

                                            <div class="col-xl-5 mt-2">
                                                <label for="">First Name</label>
                                                <input class="form-control shadow-none  " type="text" name="firstname"
                                                    id="" placeholder="Enter your first name">
                                            </div>
                                            <div class="col-xl-5 mt-2">
                                                <label for="">Last Name</label>
                                                <input type="text" class="form-control shadow-none" name="lastname"
                                                    id="" placeholder="Enter your last name">
                                            </div>
                                            <div class="col-xl-12 mt-2">
                                                <label for="">Phone Number</label>
                                                <input class="form-control shadow-none" type="number" name="phone" id=""
                                                    placeholder="Enter your phone number">
                                            </div>
                                            <div class="col-xl-12 mt-2">
                                                <label for="">Email</label>
                                                <input class="form-control shadow-none" type="email" name="email" id=""
                                                    placeholder="Enter your email">
                                            </div>
                                            <div class="col-xl-12 mt-2">
                                                <label for="">Address</label>
                                                <input type="text" class="form-control shadow-none" name="address" id=""
                                                    placeholder="Enter your address">
                                            </div>
                                            <div class="col-xl-12 mt-2">
                                                <label for="">Password</label>
                                                <input type="password" class="form-control shadow-none" name="password"
                                                    id="" placeholder="Enter your password">
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary shadow-none"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-success shadow-none">Change</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="w-full md:w-2/5">
                <div class="bg-white rounded-md p-4 md:p-6 shadow-md">
                    <div class="infor">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-2">
                                <label for="">First Name</label>
                                <input type="text" disabled placeholder="Admin01"
                                    class="form-control placeholder-style  mt-2" required>
                            </div>
                            <div class="p-2">
                                <label for="">Last Name</label>
                                <input type="text" disabled placeholder="admin"
                                    class="form-control placeholder-style mt-2" required>
                            </div>
                        </div>
                        <div class="p-2">
                            <label for="">Phone Number</label>
                            <input type="number" disabled placeholder="093 21 19 43"
                                class="form-control placeholder-style  mt-2" required>
                        </div>
                        <div class="p-2">
                            <label for="">Email</label>
                            <input type="email" disabled placeholder="admin01@gmail.com"
                                class="form-control placeholder-style mt-2 " required>
                        </div>
                        <div class="p-2">
                            <label for="">Address</label>
                            <input type="text" disabled placeholder="#192 Teuk Lok "
                                class="form-control placeholder-style mt-2" required>
                        </div>
                        <div class="p-2">
                            <label for="">Password</label>
                            <input type="password" disabled placeholder="......."
                                class="form-control placeholder-style mt-2" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
* {
    padding: 0px;
    margin: 0px;
    box-sizing: border-box;
}

.s1 {
    /* width: 290px; */
    color: var(--Theme-Color-Dark, #464255);
    font-feature-settings: 'clig' off, 'liga' off;
    font-family: Inter;
    font-size: 30px;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
}

.s2 {
    width: 464px;
    color: #939393;
    font-feature-settings: 'clig' off, 'liga' off;
    font-family: Barlow;
    font-size: 18px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
}

.s3 {
    color: #939393;
    font-family: Inter;
    font-size: 30px;
    font-style: normal;
    font-weight: 500;
    line-height: 24px;
    /* 66.667% */
    letter-spacing: -0.54px;
}

.s4 {
    color: #939393;
    font-family: Inter;
    font-size: 30px;
    font-style: normal;
    font-weight: 500;
    line-height: 24px;
    /* 66.667% */
    letter-spacing: -0.54px;
}

.s5 {
    color: #939393;
    font-family: Inter;
    font-size: 13px;
    font-style: normal;
    font-weight: 400;
    line-height: 24px;
    /* 171.429% */
    letter-spacing: -0.21px;
}

.btnRegister {
    color: #FFF;
    font-family: Inter;
    font-size: 14px;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
    height: 51px;
    width: 267px;
}

.infor {
    padding: 30px;
}

label {
    color: var(--text-secondary, #5A5A5D);
    font-family: Inter;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 100%;
    /* 20px */
    text-transform: capitalize;
}

/* input::placeholder {
    color: #939393;
    font-family: Inter;
    font-size: 14px;
    font-style: normal;
    font-weight: 500;
    line-height: 24px;
   
    letter-spacing: -0.24px;
} */

.modal-backdrop {
    filter: blur(5px);
    /* Adjust the blur amount as needed */
    background-color: rgba(130, 130, 130, 0.229);
}

.placeholder-style::placeholder {
    padding: 5px 12px;
    margin: 5px;
}
</style>