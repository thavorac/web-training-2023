import { ref, computed } from "vue";
import { defineStore } from "pinia";

export const useImageloadStore = defineStore("imageload",{
    state: ()=>{
        return{
            advertising:{
                title: "KIMONOS, CAFTANS & PAREOS",
                description: "Poolside glam included From $4.99",
                image: "../assets/image/left.png",
                category: "Summer Essentials",
                discount: "40%",
                until: "19 Jul-30",
            }
        }
    }
})