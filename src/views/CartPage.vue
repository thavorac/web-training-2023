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
                                <tr v-for="item in data.cartItems" :key="item.id">
                                    <td>{{ item.id }}</td>
                                    <td>
                                        <img :src="item.image" width="60" height="60" class="img-fluid rounded" alt="">
                                    </td>
                                    <td>
                                        {{ item.name }}
                                    </td>
                                    <td>
                                        <i class="bi bi-plus-circle-fill" @click="data.incrementQ(item)"></i>

                                        {{ item.quantity }}
                                        <i class="bi bi-dash-circle-fill" @click="data.decrementQ(item)"></i>
                                    </td>
                                    <td>
                                        {{ item.price }}
                                    </td>
                                    <td>
                                        {{ item.price * item.quantity }}
                                    </td>
                                    <td>
                                        <i @click="data.removeFromCart(item)" class="bi bi-cart-x text-danger fx-bo">

                                        </i>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center" colspan="3">
                                        Total
                                    </th>
                                    <td>
                                        <span class="badge badge bg-danger tounded-pill">
                                            ${{ data.cartItems.reduce((acc, item) => acc += item.price * item.quantity,
                                                0)
                                            }}
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
import MenuHeader from '@/components/MenuHeader.vue';
import CategoriesHead from '@/components/CategoriesHead.vue';
import { useCartStore } from '@/stores/useCartStoreP';

const data = useCartStore();

</script>

<style scoped>
* {
    /* padding: 0px;
    margin: 0px; */
    /* box-sizing: border-box; */
}

i {
    cursor: pointer;
}
</style>