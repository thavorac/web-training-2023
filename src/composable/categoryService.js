// services/categoryService.js
import axios from 'axios';

export const getCategories = async () => {
    try {
        const response = await axios.get('http://localhost/api/categories');
        return response.data.data;
    } catch (error) {
        console.error("Error fetching categories:", error);
        throw error;
    }
};
