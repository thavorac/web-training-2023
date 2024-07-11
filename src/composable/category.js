import axios from 'axios';

const API_BASE_URL = 'http://localhost/api'; // Replace with your actual API base URL

export const fetchCategories = async () => {
    try {
        return await axios.get(`${API_BASE_URL}/categories`);
    } catch (error) {
        console.error('Error fetching categories:', error);
        throw error;
    }
};

export const fetchCategoryById = async (categoryId) => {
    try {
        return await axios.get(`${API_BASE_URL}/categories/${categoryId}`);
    } catch (error) {
        console.error('Error fetching category by id:', error);
        throw error;
    }
};

export const updateCategory = async (categoryId, data) => {
    try {
        return await axios.patch(`${API_BASE_URL}/categories/${categoryId}`, data);

    } catch (error) {
        console.error('Error updating category:', error);
        throw error;
    }
};

export const deleteCategory = async (categoryId) => {
    try {
        return await axios.delete(`${API_BASE_URL}/categories/${categoryId}`);
    } catch (error) {
        console.error('Error deleting category:', error);
        throw error;
    }
};
