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
        { id: "5", name: "LYli"},
        { id: "6", name: "Nita"},
        { id: "7", name: "Soriya"},
        { id: "8", name: "Dara"},

      ],
      advertisement: {
        title: "KIMONOS, CAFTANS & PAREOS",
        description: "Poolside glam included From $4.99",
        image: new URL("../assets/image/left.png",import.meta.url),
        category: "Summer Essentials",
        discount: "40%",
        until: "19 Jul-30",
      },
      products: [
        {
          id: 1,
          name: "DEAL OF the day",
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
