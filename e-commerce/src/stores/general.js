import { ref, computed } from "vue";
import { defineStore } from "pinia";

export const useGeneralStore = defineStore("general", {
  state: () => {
    return {
      categories: [
        { id: "1", name: "Male" },
        { id: "2", name: "Woman" },
        { id: "3", name: "Mother-child" },
        { id: "4", name: "Home & Furniture" },
      ],
      advertisement: {
        title: "KIMONOS, CAFTANS & PAREOS",
        description: "Poolside glam included From $4.99",
        image: "........",
        category: "Summer Essentials",
        discount: "20%",
        until: "19 Jul-30",
      },
      products: [
        {
          id: 1,
          title: "Tonny Black",
          description: "Shoulder bag-White-Plain",
          averageRate: 4,
          totalRate: 58,
          sellPrice: 231,
          discountPrice: 123,
          save: 101,
          timeRemain: 800,
        },
        {
          id: 2,
          title: "Tonny Black",
          description: "Shoulder bag-White-Plain",
          averageRate: 4,
          totalRate: 58,
          sellPrice: 231,
          discountPrice: 123,
          save: 101,
          timeRemain: 800,
        },
        {
          id: 3,
          title: "Tonny Black",
          description: "Shoulder bag-White-Plain",
          averageRate: 4,
          totalRate: 58,
          sellPrice: 231,
          discountPrice: 123,
          save: 101,
          timeRemain: 800,
        },
      ],
    };
  },
  actions: {
    createProduct(productDetail) {
      this.proudcts.push({
        id: this.products.length + 1,
        title: "Tonny Black",
        description: "Shoulder bag-White-Plain",
        averageRate: 4,
        totalRate: 58,
        sellPrice: 231,
        discountPrice: 123,
        save: 101,
        timeRemain: 800,
      });
    },
  },
});
