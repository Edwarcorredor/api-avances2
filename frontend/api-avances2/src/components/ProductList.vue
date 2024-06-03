<template>
    <div>
      <h2>Products</h2>
      <ul>
        <li v-for="product in products" :key="product.id">
          {{ product.name }}
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import { useProductStore } from '../stores/products';
  import { onMounted } from 'vue';
  
  export default {
    setup() {
      const productStore = useProductStore();
      onMounted(() => {
        productStore.fetchProducts();
      });
  
      return {
        products: productStore.products,
      };
    },
  };
  </script>
  