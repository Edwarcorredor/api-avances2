<template>
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
      <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
        <div class="flex items-center space-x-6 rtl:space-x-reverse">
          <router-link to="/profile" class="text-sm text-blue-600 dark:text-blue-500 hover:underline">Perfil</router-link>
          <button @click="logout" class="text-sm text-blue-600 dark:text-blue-500 hover:underline">Cerrar Sesión</button>
        </div>
      </div>
    </nav>
  </template>
  
  <script>
  import { useAuthStore } from '../stores/auth';
  
  export default {
    setup() {
      const authStore = useAuthStore();
  
      const logout = () => {
        authStore.logout();
      };
  
      return {
        logout,
      };
    },
  };
  </script>
  