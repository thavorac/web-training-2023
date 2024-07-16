<script setup lang="ts">
// =============================== function delete =======================================
// ================================= Fetch API Delete ==================================
import Swal from 'sweetalert2';
import { ref } from 'vue';

// Define the Category interface
interface Category {
    id: number;
    name: string;
    description: string;
    createdAt?: string;
    updatedAt?: string;
}

const categories = ref<Category[]>([]);

const deleteCategory = async (categoryId: number) => {
    // Optimistically update the categories
    const previousCategories = [...categories.value];
    categories.value = categories.value.filter(category => category.id !== categoryId);

    try {
        const response = await fetch(`http://localhost/api/categories/${categoryId}`, {
            method: 'DELETE'
        });

        if (!response.ok) {
            throw new Error('Failed to delete category');
        }

        // Assuming the response contains a success message
        const data = await response.json();
        console.log('Category deleted:', data);

    } catch (error) {
        // Revert back to the previous categories state if delete fails
        categories.value = previousCategories;
        console.error('Error deleting category:', error);

        Swal.fire(
            "Error!",
            "There was a problem deleting the category.",
            "error"
        );
    }
};

// ================================= Action Delete ==================================

const confirmDelete = (categoryId: number) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            deleteCategory(categoryId).then(() => {
                Swal.fire(
                    "Deleted!",
                    "Your category has been deleted.",
                    "success"
                );
            });
        }
    });
};

</script>
