<template>
    <div>
        <MenuHeader></MenuHeader>
    </div>
    <!-- sticky top-0 -->
    <div>
        <CategoriesHead></CategoriesHead>
    </div>
    <div class="container">
        <div class="row my-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in cartItems" :key="item.id">
                                    <td>{{ item.id }}</td>
                                    <td>
                                        <img :src="item.image" width="60" height="60" class="img-fluid rounded" alt="">
                                    </td>
                                    <td>{{ item.name }}</td>
                                    <td>
                                        <i class="bi bi-plus-circle-fill" @click="incrementQ(item)"></i>
                                        {{ item.quantity }}
                                        <i class="bi bi-dash-circle-fill" @click="decrementQ(item)"></i>
                                    </td>
                                    <td>{{ item.price }}</td>
                                    <td>{{ item.price * item.quantity }}</td>
                                    <td>
                                        <i @click="removeFromCart(item)" class="bi bi-cart-x text-danger fx-bo"></i>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center" colspan="3">Total</th>
                                    <td>
                                        <span class="badge badge bg-danger rounded-pill">
                                            ${{ total }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import MenuHeader from '@/components/MenuHeader.vue';
import CategoriesHead from '@/components/CategoriesHead.vue';
import { useCartStore } from '@/stores/useCartStore';

const data = useCartStore();
const cartItems = ref([]);

const fetchProducts = async () => {
    try {
        const response = await axios.get('/api/products');
        cartItems.value = response.data;
    } catch (error) {
        console.error('Error fetching products:', error);
    }
};

onMounted(fetchProducts);

const incrementQ = (item) => {
    data.incrementQ(item);
};

const decrementQ = (item) => {
    data.decrementQ(item);
};

const removeFromCart = (item) => {
    data.removeFromCart(item);
};

const total = computed(() =>
    cartItems.value.reduce((acc, item) => acc + item.price * item.quantity, 0)
);
</script>

<style scoped>
i {
    cursor: pointer;
}
</style>
