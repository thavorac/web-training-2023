<template>
   
      <!-- <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <img src="https://i.imgur.com/DJZ5Dnk.jpg" /> Vue Store
            </a>
          </li>
        </ul>
      </nav> -->
     
        <div class="container container-space container-1" style="width: 928px; height: 509px;">
          <div class="row">
            <div class="col-md-6">
              <img class="img-thumbnail" :src="bannerImage" alt="" />
              <div class="product-thumbnails">
                <ul>
                  <li v-for="(image, index) in productImages" :class="{ 'thumbnail-active': activeClass === index }" :key="index">
                    <img @click="currentThumbnail(image.imageUrl, index)" :src="image.imageUrl" alt="" />
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-4">
              <h1 class="my-4">{{ productTitle }} - {{ productPrice }}</h1>
              <h3 class="my-3">
                <svg width="36" height="36" viewBox="0 0 24 24">
                  <path
                    d="M17,18C15.89,18 15,18.89 15,20A2,2 0 0,0 17,22A2,2 0 0,0 19,20C19,18.89 18.1,18 17,18M1,2V4H3L6.6,11.59L5.24,14.04C5.09,14.32 5,14.65 5,15A2,2 0 0,0 7,17H19V15H7.42A0.25,0.25 0 0,1 7.17,14.75C7.17,14.7 7.18,14.66 7.2,14.63L8.1,13H15.55C16.3,13 16.96,12.58 17.3,11.97L20.88,5.5C20.95,5.34 21,5.17 21,5A1,1 0 0,0 20,4H5.21L4.27,2M7,18C5.89,18 5,18.89 5,20A2,2 0 0,0 7,22A2,2 0 0,0 9,20C9,18.89 8.1,18 7,18Z"
                  />
                </svg>
                {{ cart }}
              </h3>
              <h4 v-if="stockAvailability">Stock Available</h4>
              <h4 v-else>Oops!! Out Of Stock</h4>
              <h3 class="my-3">Details</h3>
              <ul>
                <li v-for="(detail, index) in productChecks" :key="index">{{ detail }}</li>
              </ul>
              <button type="button" class="btn btn-outline-primary btn-lg btn-block btn-custom-color" @click="addToCart">
                ADD TO CART
              </button>
            </div>
          </div>
        </div>

  </template>
  
  <script>
  export default {
    name: 'ProductDetail',
    data() {
      return {
        productTitle: 'Round Neck Vue Logo T-Shirt',
        productPrice: '$20',
        productChecks: [
          '100% cotton on the neckline',
          'certified and safe',
          'ash in color',
          'Smooth in quality'
        ],
        bannerImage: 'https://i.imgur.com/Nmuu6Jh.jpg',
        productImages: [
          {
            id: 3435,
            imageUrl: 'https://i.imgur.com/Nmuu6Jh.jpg'
          },
          {
            id: 3436,
            imageUrl: 'https://i.imgur.com/VFcTYyU.jpg'
          },
          {
            id: 3437,
            imageUrl: 'data:image/jpeg;base64,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'
          },
         
          
        ],
        cart: 0,
        stockAvailability: true,
        activeClass: 0
      }
    },
    methods: {
      addToCart() {
        this.cart += 1
      },
      currentThumbnail(image, index) {
        this.bannerImage = image
        this.activeClass = index
      }
    }
  }
  </script>
  

<style scoped>
.container-space {
  margin-top: 2rem;
}
.product-thumbnails {
  display: flex;
  margin-top: 2rem;
}
.product-thumbnails > ul {
  display: flex;
  list-style: none;
  padding-left: 0;
}
.product-thumbnails > li {
  margin-right: 10px;
}
.product-thumbnails > ul > li > img {
  width: 100px;
  cursor: pointer;
}
.thumbnail-active {
  border: 2px solid #000;
}
.nav-link > img {
  width: 30px;
  border-radius: 8px;
  margin-right: 10px;
}
.btn-custom-color {
  border: 2px solid #4fc08d;
  color: #4fc08d;
}
.btn-custom-color:hover {
  border: 2px solid #4fc08d;
  background-color: #4fc08d;
  color: #ffffff;
}
.container-1{
    background-color: #4fc08d;
}

</style>