<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Carousel from 'primevue/carousel';
import Galleria from 'primevue/galleria';
import Gallery from '@/Components/Galeria.vue';
import { defineProps } from 'vue';

defineProps({
    canResetPassword: Boolean,
    status: String,

});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>


<template>
    <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

    <section class="bg-white">
        <div class="lg:grid lg:min-h-screen lg:grid-cols-12">
          <aside
            class="relative block h-16 lg:order-last lg:col-span-5 lg:h-full xl:col-span-6"
          >
          <Gallery :images="images" />
            
          </aside>
      
          <main
            aria-label="Main"
            class="flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:py-12 lg:px-16 xl:col-span-6"
          >
            <div class="max-w-xl lg:max-w-3xl">
              <a class="block text-blue-200" href="/">
                <img src="images/UPQLOGOREDONDO.png" alt="" width="60" height="60">
                <span class="sr-only">Home</span>
                
              </a>
      
              <h1
                class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl"
              >
                Servicios Estudiantiles 🐦
              </h1>
      
              <p class="mt-4 leading-relaxed text-gray-500">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem aperiam perferendis accusantium repellat ex architecto reiciendis laborum, maxime!
              </p>
              <form @submit.prevent="submit" class="mt-8 grid grid-cols-6 gap-6">
                
                <div class="col-span-6">
                  <div>
                    <InputLabel for="email" value="Correo electrónico" />
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
      
                <div class="col-span-6">
                  <InputLabel for="password" value="Contraseña" />
                    <TextInput
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-full"
                        required
                        autocomplete="current-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>
      
                <div class="col-span-6 sm:flex sm:items-center sm:gap-4">
                  <PrimaryButton 
                    class="inline-block shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Acceder
                  </PrimaryButton> 
      
                  <p class="mt-4 text-sm text-gray-500 sm:mt-0">
                        <Link v-if="canResetPassword" :href="route('register')" class="text-gray-700 underline">
                            Registrarse
                        </Link>
                  </p>
                  <p class="mt-4 text-sm text-gray-500 sm:mt-0">
                        <Link v-if="canResetPassword" :href="route('password.request')" class="text-gray-700 underline">
                            ¿Olvidaste tu contraseña?
                        </Link>
                  </p>
                </div>
              </form>
          </div>
        </main>
      </div>
    </section>
</template>