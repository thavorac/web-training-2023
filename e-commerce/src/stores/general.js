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
        { id: "5", name: "LYli" },
        { id: "6", name: "Nita" },
        { id: "7", name: "Soriya" },
        { id: "8", name: "Dara" },
      ],
      advertisement: {
        title: "KIMONOS, CAFTANS & PAREOS",
        description: "Poolside glam included From $4.99",
        image: new URL("../assets/image/left.png", import.meta.url),
        category: "Summer Essentials",
        discount: "40%",
        until: "19 Jul-30",
      },
      feature_products: [
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
      products: [
        {
          id: 1,
          name: "Mango",
          description: "Kimono & Caftan - Black - Regular fit",
          averageRate: 5,
          totalRate: 289,
          sellPrice: 290,
          discountPercentage: 10,
          image: "....",
        },
        {
          id: 2,
          name: "Zara",
          description: "Midi top- Daily fit",
          averageRate: 5,
          totalRate: 523,
          sellPrice: 145,
          discountPercentage: 7,
          image: "....",
        },
        {
          id: 3,
          name: "Uniqlo",
          description: "Midi atlas Slim fit - bohemian",
          averageRate: 5,
          totalRate: 86,
          sellPrice: 156,
          discountPercentage: 8,
          image: "....",
        },
        {
          id: 4,
          name: "Mango dress",
          description: "Kimono & Caftan - Colorful - Night club fit",
          averageRate: 5,
          totalRate: 121,
          sellPrice: 487,
          discountPercentage: 15,
          image: "....",
        },
      ],
      promotions: [
        {
          id: 1,
          name: "Never-Ending Summer",
          url: {
            title: "Exlopre all category",
            url: "https://.......",
          },
          description: "Throwback Shirts & all-day dressed",
          image: "...",
        },
        {
          id: 2,
          name: "The most famous sport brands",
          url: {
            title: "Exlopre all category",
            url: "https://.......",
          },
          description: "Throwback Shirts & all-day dressed",
          image: "...",
        },
        {
          id: 3,
          name: "The Pinky Barbie Edition",
          url: {
            title: "Exlopre all category",
            url: "https://.......",
          },
          description: "Lets play dress up",
          image: "...",
        },
        {
          id: 4,
          name: "Best Sellers Everyone Love",
          url: {
            title: "Exlopre all category",
            url: "https://.......",
          },
          description: "poolside glam include",
          image: "...",
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
