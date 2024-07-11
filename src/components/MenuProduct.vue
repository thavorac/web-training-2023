<script>
import ListMenu from './ListMenu.vue';
import ListMenu1 from './ListMenu1.vue';
import ListMenu2 from './ListMenu2.vue';
import ListMenu3 from './ListMenu3.vue';
export default {
  components: { ListMenu, ListMenu1, ListMenu2, ListMenu3, },
  name: "MenuProduct",
  data() {
    return {
      isActive: 'hidden',
      noHideValue: false,
      selectIndex: 1,
    };
  },
  methods: {
    mouseOver(index, value) {
      this.selectIndex = index;
      if (value) {
        if (index == 1) {
          this.isActive = "z-50 absolute top-56 left-10"
        }
        else if (index == 2) {
          this.isActive = "z-50 absolute top-56 left-30"
        }
        else if (index == 3) {
          this.isActive = "z-50 absolute top-56 right-40"
        }
        else if (index == 4) {
          this.isActive = "z-50 absolute top-56 right-5"
        }
      } else {
        this.isActive = "hidden"
      }
    },
    hidePanel() {
      if (!this.noHideValue) {
        this.mouseOver("hidden");
      }
    },
    noHide(value) {
      console.log(value);
      this.noHideValue = value;
    }
  },
}
</script>

<template>
  <div class="container-fluid ">
    <div class="row h-16">
      <div class="container">
        <div class="row mt-2">
          <div class="col-md-2"></div>
          <div class="col-md-8 d-flex justify-between align-items-center mt-2">
            <a class="no-underline text-slate-950  hover:text-orange-400 " @mouseover="() => mouseOver(1, true)"
              @mouseleave="hidePanel" href="#">Woman</a>
            <a class="no-underline text-slate-950 hover:text-orange-400" @mouseover="() => mouseOver(2, true)"
              @mouseleave="hidePanel" href="#">Cosmetics</a>
            <a class="no-underline text-slate-950 hover:text-orange-400" @mouseover="() => mouseOver(3, true)"
              @mouseleave="hidePanel" href="#">Shoe & Bag</a>
            <RouterLink class="no-underline text-slate-950 hover:text-orange-400" @mouseover="() => mouseOver(4, true)"
              @mouseleave="hidePanel" to="/electronic">Electronic
            </RouterLink>
            <a class="no-underline text-slate-950 hover:text-orange-400" href="#">Male</a>

            <div :class="isActive">
              <template v-if="selectIndex == 1">
                <list-menu @noHiden="noHide" />
              </template>
              <template v-else-if="selectIndex == 2">
                <list-menu-1 @noHiden="noHide" />
              </template>
              <template v-else-if="selectIndex == 3">
                <list-menu-2 @noHiden="noHide" />
              </template>
              <template v-else-if="selectIndex == 4">
                <list-menu-3 @noHiden="noHide" />
              </template>
            </div>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import ListMenu from './ListMenu.vue';
import ListMenu1 from './ListMenu1.vue';
import ListMenu2 from './ListMenu2.vue';
import ListMenu3 from './ListMenu3.vue';
export default {
  components: { ListMenu, ListMenu1, ListMenu2, ListMenu3, },
  name: "MenuProduct",
  data() {
    return {
      isActive: 'hidden',
      noHideValue: false,
      selectIndex: 1,
    };
  },
  methods: {
    mouseOver(index, value) {
      this.selectIndex = index;
      if (value) {
        if (index == 1) {
          this.isActive = "z-50 absolute top-56 left-10"
        }
        else if (index == 2) {
          this.isActive = "z-50 absolute top-56 left-30"
        }
        else if (index == 3) {
          this.isActive = "z-50 absolute top-56 right-40"
        }
        else if (index == 4) {
          this.isActive = "z-50 absolute top-56 right-5"
        }
      } else {
        this.isActive = "hidden"
      }
    },
    hidePanel() {
      if (!this.noHideValue) {
        this.mouseOver("hidden");
      }
    },
    noHide(value) {
      console.log(value);
      this.noHideValue = value;
    }
  },
}
</script>

<template>
  <div class="container-fluid ">
    <div class="row h-16">
      <div class="container">
        <div class="row mt-2">
          <div class="col-md-2"></div>
          <div class="col-md-8 d-flex justify-between align-items-center mt-2">
            <a class="no-underline text-slate-950  hover:text-orange-400 " @mouseover="() => mouseOver(1, true)"
              @mouseleave="hidePanel" href="#">Woman</a>
            <a class="no-underline text-slate-950 hover:text-orange-400" @mouseover="() => mouseOver(2, true)"
              @mouseleave="hidePanel" href="#">Cosmetics</a>
            <a class="no-underline text-slate-950 hover:text-orange-400" @mouseover="() => mouseOver(3, true)"
              @mouseleave="hidePanel" href="#">Shoe & Bag</a>
            <RouterLink class="no-underline text-slate-950 hover:text-orange-400" @mouseover="() => mouseOver(4, true)"
              @mouseleave="hidePanel" to="/electronic">Electronic
            </RouterLink>
            <a class="no-underline text-slate-950 hover:text-orange-400" href="#">Male</a>

            <div :class="isActive">
              <template v-if="selectIndex == 1">
                <list-menu @noHiden="noHide" />
              </template>
              <template v-else-if="selectIndex == 2">
                <list-menu-1 @noHiden="noHide" />
              </template>
              <template v-else-if="selectIndex == 3">
                <list-menu-2 @noHiden="noHide" />
              </template>
              <template v-else-if="selectIndex == 4">
                <list-menu-3 @noHiden="noHide" />
              </template>
            </div>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
    </div>
  </div>
</template>