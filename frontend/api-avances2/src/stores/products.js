import { defineStore } from 'pinia';
import axios from 'axios';

export const useProductStore = defineStore('products', {
  state: () => ({
    products: [],
  }),
  actions: {
    async fetchProducts() {
      try {
        const response = await axios.get('/api/products');
        this.products = response.data;
      } catch (error) {
        console.error('Error fetching products', error);
      }
    },
    async addProduct(productData) {
      try {
        const response = await axios.post('/api/products', productData);
        this.products.push(response.data);
      } catch (error) {
        console.error('Error adding product', error);
      }
    },
    async deleteProduct(productId) {
      try {
        await axios.delete(`/api/products/${productId}`);
        this.products = this.products.filter(product => product.id !== productId);
      } catch (error) {
        console.error('Error deleting product', error);
      }
    },
  },
});
