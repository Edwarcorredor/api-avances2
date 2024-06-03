<template>

<NavbarHome />
  <div class="h-screen bg-black">
    <form class="max-w-sm mx-auto " @submit.prevent="register">
      <label class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">Registro de Usuario</label>
      <div class="mb-5">
        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Completo</label>
        <input v-model="nombre" type="text" id="nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="nombre ejemplo" required />
      </div>
      <div class="mb-5">
        <label for="correo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo Electronico</label>
        <input v-model="correo" type="email" id="correo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
      </div>
      <div class="mb-5">
        <label for="contrasena" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
        <input v-model="contrasena" type="password" id="contrasena" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
      </div>
      <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>
  </div>

</template>
  
  <script>
  import { useAuthStore } from '../stores/auth';
  import NavbarHome from '../components/NavbarHome.vue';
  import { ref } from 'vue';
  export default {
    components: {
    NavbarHome,
    },
    setup() {
      const authStore = useAuthStore();
      const nombre = ref('');
      const correo = ref('');
      const contrasena = ref('');
  
      const register = () => {
        authStore.register({
          nombre: nombre.value,
          correo: correo.value,
          contrasena: contrasena.value,
        });
      };
  
      return {
        nombre,
        correo,
        contrasena,
        register,
      };
    },
  };
  </script>
  