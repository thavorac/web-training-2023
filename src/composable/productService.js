import axios from 'axios';

export async function getProductsByCategoryId(categoryId) {
    const response = await axios.get(`http://localhost:80/api/categories/${categoryId}/products`);
    // console.log(response);
    return response;
}
