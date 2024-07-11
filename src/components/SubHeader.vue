<script setup>
import { ref, onMounted } from 'vue';

const dropdown = ref(null);

const handleClick = (event) => {
    const dropdownToggle = dropdown.value.querySelector('.dropdown-toggle');
    const dropdownMenu = dropdown.value.querySelector('.dropdown-menu');

    if (!dropdown.value.contains(event.target)) {
        dropdownMenu.classList.remove('show');
    } else if (event.target === dropdownToggle) {
        dropdownMenu.classList.toggle('show');
    }
};

onMounted(() => {
    document.addEventListener('click', handleClick);
});
</script>

<template>
    <div class="container-fluid ">
        <div class="row pt-4 h-20">
            <div class="col-md-3">
                <span class="d-flex gap-4 cursor-pointer">
                    <RouterLink class="text-decoration-none text-dark " to="/">Homepage</RouterLink>
                    <slot></slot>
                    <a class="text-decoration-none text-indigo-600" href="">Electronic</a>
                    <slot></slot>
                    <a class="text-decoration-none text-dark" href="">Customization</a>
                </span>
            </div>
        </div>
        <div class="row justify-content-between" style="background-color: #E9E9E9;">
            <div class="col-md-4 pt-4" style="height: 89px;">
                <div class="row text-dark">
                    <div class="col-6">
                        <h5 class="ms-5">Electronic</h5>
                    </div>
                    <div class="col-6">
                        <span class="text-muted">110 items</span>
                    </div>
                </div>
            </div>
            <div class="col-md-2 offset-md-4 col-sm-4 p-4"> <!-- Added space after 'offset-md-4' -->
                <div class="dropdown" ref="dropdown">
                    <button class="btn border border-secondary dropdown-toggle text-dark" type="button"
                        id="dropdownMenuButton2" aria-expanded="false">
                        Sort by order
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                        <li><a class="dropdown-item active" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                        <li><a class="dropdown-item" href="#">Separated link</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const dropdown = ref(null);

const handleClick = (event) => {
    const dropdownToggle = dropdown.value.querySelector('.dropdown-toggle');
    const dropdownMenu = dropdown.value.querySelector('.dropdown-menu');

    if (!dropdown.value.contains(event.target)) {
        dropdownMenu.classList.remove('show');
    } else if (event.target === dropdownToggle) {
        dropdownMenu.classList.toggle('show');
    }
};

onMounted(() => {
    document.addEventListener('click', handleClick);
});
</script>

<template>
    <div class="container-fluid ">
        <div class="row pt-4 h-20">
            <div class="col-md-3">
                <span class="d-flex gap-4 cursor-pointer">
                    <RouterLink class="text-decoration-none text-dark " to="/">Homepage</RouterLink>
                    <slot></slot>
                    <a class="text-decoration-none text-indigo-600" href="">Electronic</a>
                    <slot></slot>
                    <a class="text-decoration-none text-dark" href="">Customization</a>
                </span>
            </div>
        </div>
        <div class="row justify-content-between" style="background-color: #E9E9E9;">
            <div class="col-md-4 pt-4" style="height: 89px;">
                <div class="row text-dark">
                    <div class="col-6">
                        <h5 class="ms-5">Electronic</h5>
                    </div>
                    <div class="col-6">
                        <span class="text-muted">110 items</span>
                    </div>
                </div>
            </div>
            <div class="col-md-2 offset-md-4 col-sm-4 p-4"> <!-- Added space after 'offset-md-4' -->
                <div class="dropdown" ref="dropdown">
                    <button class="btn border border-secondary dropdown-toggle text-dark" type="button"
                        id="dropdownMenuButton2" aria-expanded="false">
                        Sort by order
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                        <li><a class="dropdown-item active" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                        <li><a class="dropdown-item" href="#">Separated link</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
