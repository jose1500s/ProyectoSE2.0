<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <Head title="Forgot Password" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

    <section class="bg-white">
        <div class="lg:grid lg:min-h-screen lg:grid-cols-12">
          <aside
            class="relative block h-16 lg:order-last lg:col-span-5 lg:h-full xl:col-span-6"
          >
            <img
              alt="Pattern"
              src="images/ingreso.jpg"
              class="absolute inset-0 h-full w-full object-cover"
            />
          </aside>
      
          <main
            aria-label="Main"
            class="flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:py-12 lg:px-16 xl:col-span-6"
          >
            <div class="max-w-xl lg:max-w-3xl">
              <a class="block text-blue-600" href="/">
                <img src="images/UPQLOGOREDONDO.png" alt="" width="60" height="60">
                <span class="sr-only">Home</span>
                
              </a>
      
              <h1
                class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl"
              >
                Servicios Escolares 🐦
              </h1>
      
              <p class="mt-4 leading-relaxed text-gray-500">
                ¿Olvidaste tu contraseña? No hay problema. Solo dejanos tu direccion de correo electronico y te enviaremos un email para resetear tu contraseña.
              </p>
              <form @submit.prevent="submit" class="mt-8 grid grid-cols-6 gap-6">
                
                <div class="col-span-6">
                  <div>
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"
                        required
                        autofocus
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
                 
                </div>
      
                <div class="col-span-6 sm:flex sm:items-center sm:gap-4">
                  <PrimaryButton 
                    class="inline-block shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Enviar correo de recuperacion
                  </PrimaryButton> 
                </div>
              </form>
          </div>
        </main>
      </div>
    </section>
</template>
