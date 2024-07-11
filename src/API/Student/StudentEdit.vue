<template>
    <div>

    </div>
</template>

<script setup>

</script>
<!-- <template>
    <div class="container">
        <div class="card w-9/12 mt-3 ms-5">
            <div class="card-header">
                <h4>Add Product</h4>
            </div>
            <form action="">
                <div class="card-body">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" id="name" v-model="model.name" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="pricing">Pricing</label>
                    <input type="number" id="pricing" v-model="model.pricing" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="discount">Discount</label>
                    <input type="number" id="discount" v-model="model.discount" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="color">Color</label>
                    <input type="text" id="color" v-model="model.color" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="size">Size</label>
                    <input type="text" id="size" v-model="model.size" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="category_id">Category_id</label>
                    <input type="text" id="category_id" v-model="model.category_id" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="supplier_id">Supplier_id</label>
                    <input type="text" id="supplier_id" v-model="model.supplier_id" class="form-control">
                </div>
                <div class="mb-3">
                    <button type="button" @click="saveProduct" class="btn btn-primary">Save</button>
                    <a href="/reporte" class="btn btn-primary mt-5 ms-2">Back to Product View</a>

                </div>
            </div>
            </form> 
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';
import { useRoute } from 'vue-router';
const props = defineProps(['title']);
const route = useRoute();
const productId = route.params.id;

const successMessage = ref('');
const formData = ref({
  name: '',
  pricing: '',
  discount: '',
  color: '',
  size: '',
  brand: '',
  category_id: '',
  supplier_id: ''
});
//   const productId = 'YOUR_PRODUCT_ID'; // Replace with the actual product ID

const getProductAndEdit = async (productId) => {
  try {
    const response = await axios.get(`http://localhost/api/products/${productId}`);
    const product = response.data;
    console.log(product)
    // Populate form data with product details
    formData.value = {
      name: product.name,
      pricing: product.pricing,
      discount: product.discount,
      color: product.color,
      size: product.size,
      brand: product.brand,
      category_id: product.category_id,
      supplier_id: product.supplier_id
    };
  } catch (error) {
    console.error('Error fetching product:', error);
  }
};

const submitForm = async () => {
  try {
    let response;
    if (productId) {
      // Update existing product
      response = await axios.patch(`http://localhost/api/products/${productId}`, {...formData.value,"_method":"PATCH"});
    } else {
      // Create new product
      response = await axios.post('`http://localhost/api/products', {...formData.value,"_method":"PATCH"});
    }
    successMessage.value = response.data.message; // Assuming the response contains a success message
    // Clear form data after successful submission
    clearFormData();
  } catch (error) {
    console.error(error);
    // Handle error
  }
};

// Fetch product details when the component is mounted
onMounted(() => {
  getProductAndEdit(productId);

});

const clearFormData = () => {
  // Clear form data
  formData.value = {
    name: '',
    pricing: '',
    discount: '',
    color: '',
    size: '',
    brand: '',
    category_id: '',
    supplier_id: ''
  };
};
</script> -->
