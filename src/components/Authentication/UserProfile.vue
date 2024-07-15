<script setup lang="ts">
import { computed } from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

const store = useStore();
const user = computed(() => store.getters.getUser);
const router = useRouter();

if (!store.getters.isAuthenticated) {
  router.push('/user-profile'); // Redirect to login if not authenticated
}
</script>
<template>
    <div class="container-fluid">
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="../../assets/image/profile.avif" alt="Admin"
                                        class="rounded-circle p-1 bg-primary" width="170">
                                    <div v-if="user"  class="mt-3 pl-5">
                                        <h4>{{ user.last_name }} {{ user.first_name }}</h4>
                                        <ul class="list-unstyled mb-4 pl-5">
                                            <li class="mb-3 text-start"><a href="#!"><i class="far fa-envelope display-25 me-3 text-secondary"></i>{{ user.email }}</a></li>
                                            <li class="mb-3 text-start"><a href="#!"><i class="fas fa-mobile-alt display-25 me-3 text-secondary"></i>{{ user.phone_number }}</a></li>
                                            <li class="text-start"><a href="#!"><i class="fas fa-map-marker-alt display-25 me-3 text-secondary"></i>{{ user.address }}</a></li>
                                        </ul>
                                    </div>
                                    <div v-else class="alert alert-warning" role="alert">
                                        No user profile found. Please log in.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div v-if="user" class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ user.last_name }} {{ user.first_name }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ user.email }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ user.phone_number }}
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Gender</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <p>{{ user.gender }}</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Date of Birth</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <p>{{ user.date_of_birth }}</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <p>{{ user.address }}</p>
                                    </div>
                                </div>
                                
                            </div>
                            <div v-else class="alert alert-warning" role="alert">
                                        No user profile found. Please log in.
                                    </div>
                            <div class="row px-3 pb-3">
                                <div class="col-sm-3">
                                    <router-link to="/Homepage" class="mr-2">
                                        <button type="button" class="btn btn-primary">Cancel</button>
                                    </router-link>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
body {
    background: #f7f7ff;
    margin-top: 20px;
}

.container-fluid {
    background-color: whitesmoke;
    min-height: 715px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: 100% 100%;
    position: relative;
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16), 0px 3px 6px rgba(0, 0, 0, 0.23);
    height: 500px;
}

.me-2 {
    margin-right: .5rem !important;
}
</style>