<template>
  <div>
    <DashboardNavbar />
    <div class="bg-black p-4">
      <h1 class="text-white text-center">Información del perfil</h1>
    </div>
    
    <div class="relative overflow-x-auto p-4">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">Campo</th>
            <th scope="col" class="px-6 py-3">Valor</th>
          </tr>
        </thead>
        <tbody>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              ID
            </th>
            <td class="px-6 py-4">{{ user.id }}</td>
          </tr>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              Nombre
            </th>
            <td class="px-6 py-4">{{ user.name }}</td>
          </tr>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              Email
            </th>
            <td class="px-6 py-4">{{ user.email }}</td>
          </tr>
          <tr class="bg-white dark:bg-gray-800">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              Fecha de Creación
            </th>
            <td class="px-6 py-4">{{ user.created_at }}</td>
          </tr>
          <tr class="bg-white dark:bg-gray-800">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              Última Actualización
            </th>
            <td class="px-6 py-4">{{ user.updated_at }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import { useAuthStore } from '../stores/auth.js';
import  {ref} from 'vue';
import DashboardNavbar from '../components/DashboardNavbar.vue';

export default {
  components: {
    DashboardNavbar,
  },
  setup() {
    const authStore = useAuthStore();
    const user = ref(authStore.user);

    return {
      user
    };
  },
};
</script>
