import axios from "axios";

const baseUrl = "http://localhost:9000";
const fetchProducts = async () => {
  const response = await axios.get(`${baseUrl}/api/products`);
  let products = [];
  if (response) {
    products = response.data;
  }
  console.log("products", products);
  return products;
};

const addProductToCart = async (product_id, user_id = 17) => {
  const response = await axios.post(`${baseUrl}/api/carts`, {
    product_id,
    user_id,
  });

  if (response) {
    return response.data;
  }
};

const removeProductFromCart = async (product_id, user_id = 17) => {
  const response = await axios.delete(
    `${baseUrl}/api/carts?product_id=${product_id}&user_id=${user_id}`
  );

  if (response && response.data.message == "success") {
    return true;
  } else {
    return false;
  }
};

const getProductsFromCart = async (user_id = 17) => {
  const response = await axios.get(`${baseUrl}/api/carts?user_id=${user_id}`);
  return response.data;
};

export default {
  fetchProducts,
  addProductToCart,
  removeProductFromCart,
  getProductsFromCart,
};
