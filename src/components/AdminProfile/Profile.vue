<script setup lang="ts">
import { computed } from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import ProductView from '../../views/CategoryView.vue';
const store = useStore();
const admin = computed(() => store.getters.getAdmin);
const router = useRouter();
const logoutHandler = () => {
  store.dispatch('logout');
  router.push('/login'); // Redirect to sign-in page after logout
};

if (!store.getters.isAuthenticated || !admin.value) {
  router.push('/login'); // Redirect to login if not authenticated or admin not found
}
</script>

<template>
  <ProductView :subtitle="'Admin Profile'">
    <div class="w-full selection:bg-gray-100 py-10 px-10 mt-10 rounded-lg bg-gray-200 shadow-md">
      <div class="w-full bg-white rounded-md p-2">
        <template v-if="admin">
          <div class="container-fluid">
            <div class="container">
              <div class="main-body">
                <div class="row">
                  <div class="col-lg-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                          <img src="../../assets/image/profile.avif" alt="Admin" class="rounded-circle p-1 bg-primary" width="170">
                          <div class="mt-3 pl-5">
                            <h4>{{ admin.name }}</h4>
                            <ul class="list-unstyled mb-4 pl-5">
                              <li class="mb-3 text-start"><i class="far fa-envelope display-25 me-3 text-secondary"></i>{{ admin.email }}</li>
                              <li class="mb-3 text-start"><i class="fas fa-mobile-alt display-25 me-3 text-secondary"></i>{{ admin.phone_number }}</li>
                              <li class="text-start"><i class="fas fa-map-marker-alt display-25 me-3 text-secondary"></i>{{ admin.address }}</li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-8">
                    <div class="card">
                      <div class="card-body">
                        <div class="row mb-3">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Full Name</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            {{ admin.name }}
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            {{ admin.email }}
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Phone</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            {{ admin.phone_number }}
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Gender</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            <p>{{ admin.gender }}</p>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Date of Birth</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            <p>{{ admin.date_of_birth }}</p>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Address</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            <p>{{ admin.address }}</p>
                          </div>
                        </div>
                      </div>
                      <div class="row pl-5 pb-3">
                      <div class="col-sm-2">
                        <router-link to="/Homepage" class="mr-2">
                          <button type="button" class="btn btn-primary">Back</button>
                        </router-link>
                      </div>
                      <div class="col-sm-2">
                        <a href="#" @click="logoutHandler">
                          <button type="button" class="btn btn-danger">Logout</button>
                      </a>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </template>
        <template v-else>
          <div class="alert alert-warning" role="alert">
            No admin profile found. Please log in as an admin.
          </div>
        </template>
      </div>
    </div>
  </ProductView>
</template>
