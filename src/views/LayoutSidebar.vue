<template>
    <a-layout style="min-height: 100vh">
      <a-layout-sider :collapsed="collapsed" collapsible>
        <div class="logo" />
        <a-menu @click="onClickMenu" :selectedKeys="selectedKeys" theme="dark" mode="inline">
          <a-menu-item key="/getCategory">
            <PieChartOutlined />
            <span>Dashboard</span>
          </a-menu-item>
          <a-menu-item key="/getProducts">
            <DesktopOutlined />
            <span>Customer</span>
          </a-menu-item>
          <a-menu-item key="/getEmpoyee">
            <desktop-outlined />
            <span>Employee</span>
          </a-menu-item>
          <a-sub-menu key="/product">
            <template #title>
              <span>
                <TeamOutlined />
                <span>Product</span>
              </span>
            </template>
            <a-menu-item key="/product">Producct</a-menu-item>
            <a-menu-item key="/product-stock">Product Stock</a-menu-item>
            <a-menu-item key="/category-page">Category</a-menu-item>
            <!-- <a-menu-item key="/"></a-menu-item> -->
          </a-sub-menu>
          <!-- <a-sub-menu key="/getCategory">
            <template #title>
              <span>
                <team-outlined />
                <span>Category</span>
              </span>
            </template>
            <a-menu-item key="6">Team 1</a-menu-item>
            <a-menu-item key="8">Team 2</a-menu-item>
            <a-menu-item key="/"></a-menu-item>
          </a-sub-menu> -->
          <a-sub-menu key="/system">
            <template #title>
              <span>
                <team-outlined />
                <span>System</span>
              </span>
            </template>
            <a-menu-item key="/order-status">Order Status</a-menu-item>
            <a-menu-item key="/payment-method">Payment method</a-menu-item>
            <a-menu-item key="/role">Role</a-menu-item>
          </a-sub-menu>
          <!-- <a-menu-item key="9">
            <file-outlined />
            <span>File</span>
          </a-menu-item> -->
        </a-menu>
        
      </a-layout-sider>
     
      <a-layout>
        
        <a-layout-header style="background: #fff; padding: 0">
          <div style="display: flex; justify-content: space-between; padding: 5;">
            <div style="display: flex;">
              <div style="height: 40px; width: 40px; background-color: #888;"></div></div>
              <div>Brand Name</div>
            </div>
            <div style="display: flex;">
              
              <div style="height: 40px; width: 40px; background-color: #888; display: flex; justify-content: space-between; border-radius: 20px;"></div>
            </div>
        </a-layout-header>
        
        <a-layout-content style="margin: 0 16px">
   <!-- <a-breadcrumb style="margin: 16px 0">
            <a-breadcrumb-item>User</a-breadcrumb-item>
            <a-breadcrumb-item>Bill</a-breadcrumb-item>
          </a-breadcrumb>
          <div :style="{ padding: '24px', background: '#fff', minHeight: '360px' }">
            Bill is a cat.
          
          </div> -->
          <RouterView/>
          
        </a-layout-content>
      
      </a-layout>
    </a-layout>
  </template>
  <script setup>
  import { ref } from 'vue';
  import { RouterView } from 'vue-router';
  import { defineComponent } from 'vue';
  import { PieChartOutlined , DesktopOutlined, TeamOutlined } from '@ant-design/icons-vue';

  const collapsed = ref(false);
  const selectedKeys = ref(['1']);

  const onClickMenu = (event) => {
    console.log(event);

  }

  </script>
  <style scoped>
  #components-layout-demo-side .logo {
    height: 32px;
    margin: 16px;
    background: rgba(255, 255, 255, 0.3);
  }
  
  .site-layout .site-layout-background {
    background: #fff;
  }
  [data-theme='dark'] .site-layout .site-layout-background {
    background: #141414;
  }
  </style>