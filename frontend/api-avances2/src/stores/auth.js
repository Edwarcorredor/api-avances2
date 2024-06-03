import { defineStore } from 'pinia';
import axios from '../axios'; // Importa la instancia configurada de axios
import router from '../router';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    token: localStorage.getItem('token') || null,
  }),
  actions: {
    async register(userData) {
      try {
        const response = await axios.post('/register', userData);
        this.user = response.data.user;
        this.token = response.data.token;
        localStorage.setItem('token', response.data.token);
        axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;
        router.push('/dashboard');
      } catch (error) {
        alert(error.response.data.message);
        console.error(error.response.data.message);
      }
    },
    async login(credentials) {
      try {
        const response = await axios.post('/login', credentials);
        this.user = response.data.user;
        this.token = response.data.token;
        localStorage.setItem('token', response.data.token);
        axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;
        router.push('/dashboard');
      } catch (error) {
        console.error(error.response.data.message);
      }
    },

    
    async logout() {
      try {
        await axios.get('/logout');
        this.user = null;
        this.token = null;
        localStorage.removeItem('token');
        delete axios.defaults.headers.common['Authorization'];
        router.push('/');
      } catch (error) {
        console.error(error.response.data.message);
      }
    },
  },
});
