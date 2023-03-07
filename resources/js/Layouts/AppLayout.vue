<script >
import { ref } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import Banner from "@/Components/Banner.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { defineComponent } from "vue";
import Sidebar from "primevue/sidebar";
import Button from "primevue/button";
import Avatar from "primevue/avatar";

import { useConfirm } from "primevue/useconfirm";
import { useToast } from "primevue/usetoast";
import ConfirmDialog from "primevue/confirmdialog";
import Toast from "primevue/toast";


export default defineComponent({
  data() {
    return {
      visibleLeft: false,
    };
  },
  components: {
    Button,
    Sidebar,
    Avatar,
    Dropdown,
    DropdownLink,
    NavLink,
    ResponsiveNavLink,
    Banner,
    ApplicationMark,
    Head,
    Link,
    ConfirmDialog,
    Toast,
  },
  // recibir el array de user que viene del controlador
  props: {
    users: Array,
    title: String,
  },
  // metodo para cerrar sesion
  methods: {
    logout() {
      router.post(route("logout"));
    },
    // para ver el perfil del usuario
    showProfile() {
      router.get(route("profile.show"));
    },
  },
  setup() {
    const confirm = useConfirm();
    const toast = useToast();

    toast.add({
      severity: "info",
      summary: "Info Message",
      detail: "Message Content",
      life: 3000,
    });

    const confirm1 = () => {
      confirm.require({
        message: "Are you sure you want to proceed?",
        header: "Confirmation",
        icon: "pi pi-exclamation-triangle",
        accept: () => {
          toast.add({
            severity: "info",
            summary: "Confirmed",
            detail: "You have accepted",
            life: 3000,
          });
        },
        reject: () => {
          toast.add({
            severity: "error",
            summary: "Rejected",
            detail: "You have rejected",
            life: 3000,
          });
        },
      });
    };

    const confirm2 = () => {
      confirm.require({
        message: "Do you want to delete this record?",
        header: "Delete Confirmation",
        icon: "pi pi-info-circle",
        acceptClass: "p-button-danger",
        accept: () => {
          toast.add({
            severity: "info",
            summary: "Confirmed",
            detail: "Record deleted",
            life: 3000,
          });
        },
        reject: () => {
          toast.add({
            severity: "error",
            summary: "Rejected",
            detail: "You have rejected",
            life: 3000,
          });
        },
      });
    };

    const confirmPosition = (position) => {
      confirm.require({
        group: "positionDialog",
        message: "¿Desea cerrar sesión?",
        header: "Sesión",
        icon: "pi pi-info-circle",
        position: position,
        accept: () => {
          // logout
          router.post(route("logout"));
        },
        reject: () => {
          toast.add({
            severity: "info",
            summary: "Cancelado",
            detail: "Se canceló el cierre de sesión",
            life: 3000,
          });
        },
        acceptLabel: "Aceptar",
        rejectLabel: "Cancelar",
      });
    };

    const showTemplate = () => {
      confirm.require({
        group: "templating",
        header: "Terms and Conditions",
        message: "Do you accept that?",
        icon: "pi pi-question-circle",
        acceptIcon: "pi pi-check",
        rejectIcon: "pi pi-times",
        accept: () => {
          this.$toast.add({
            severity: "info",
            summary: "Confirmed",
            detail: "You have accepted",
            life: 3000,
          });
        },
        reject: () => {
          this.$toast.add({
            severity: "error",
            summary: "Rejected",
            detail: "You have rejected",
            life: 3000,
          });
        },
      });
    };

    return { confirm1, confirm2, confirmPosition, showTemplate };
  },
});
</script>

<template>

  <Head :title="title" />

 

  <!-- Boton para abrir el sideBar responsive (en dispositivos moviles) -->
  <div class="absolute top-1/2 z-40">
    <div class="fixed top-1/2">
      <Button icon="pi pi-arrow-right" @click="visibleLeft = true" class="mr-2" />
      <Sidebar v-model:visible="visibleLeft" :baseZIndex="10000">
        <Link href="/dashboard" class="px-8 text-left focus:outline-none">
        <img src="https://visionindustrial.com.mx/wp-content/uploads/2016/08/UPQ-logo.jpg" alt="LogoUPQ"
          class="h-20 mx-auto" />
        </Link>
        <div class="menus">
          <ul>

            <li>
              <Link class="
                      inline-flex
                      items-center
                      w-full
                      px-4
                      py-2
                      mt-1
                      text-base text-gray-900
                      transition
                      duration-500
                      ease-in-out
                      transform
                      rounded-lg
                      bg-gray-50
                      hover:bg-gray-200
                      focus:shadow-outline
                      hover:cursor-pointer
                    " white="" :href="route('usuario.ingreso')" active="">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
              </svg>

              <span class="ml-4"> Ingreso</span>
              </Link>
            </li>

            <li>
              <Link class="
                      inline-flex
                      items-center
                      w-full
                      px-4
                      py-2
                      mt-1
                      text-base text-gray-900
                      transition
                      duration-500
                      ease-in-out
                      transform
                      rounded-lg
                      bg-gray-50
                      hover:bg-gray-200
                      focus:shadow-outline
                      hover:cursor-pointer
                    " white="" :href="route('usuario.matricula')">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 4.5l15 15m0 0V8.25m0 11.25H8.25" />
              </svg>

              <span class="ml-4"> Matrícula</span>
              </Link>
            </li>

            <li>
              <Link class="
                      inline-flex
                      items-center
                      w-full
                      px-4
                      py-2
                      mt-1
                      text-base text-gray-900
                      transition
                      duration-500
                      ease-in-out
                      transform
                      rounded-lg
                      bg-gray-50
                      hover:bg-gray-200
                      focus:shadow-outline
                      hover:cursor-pointer
                    " white="" :href="route('usuario.bajas')">
              <!-- :href="route('posts.index')" :active="route().current('post.index')" -->
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
              </svg>

              <span class="ml-4"> Bajas</span>
              </Link>
            </li>

            <li>
              <Link class="
                      inline-flex
                      items-center
                      w-full
                      px-4
                      py-2
                      mt-1
                      text-base text-gray-900
                      transition
                      duration-500
                      ease-in-out
                      transform
                      rounded-lg
                      bg-gray-50
                      hover:bg-gray-200
                      focus:shadow-outline
                      hover:cursor-pointer
                    " white="" :href="route('usuario.egresados')">
              <!-- :href="route('posts.index')" :active="route().current('post.index')" -->
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
              </svg>

              <span class="ml-4"> Egresados</span>
              </Link>
            </li>
            <li>
              <Link class="
                      inline-flex
                      items-center
                      w-full
                      px-4
                      py-2
                      mt-1
                      text-base text-gray-900
                      transition
                      duration-500
                      ease-in-out
                      transform
                      rounded-lg
                      bg-gray-50
                      hover:bg-gray-200
                      focus:shadow-outline
                      hover:cursor-pointer
                    " white="" :href="route('usuario.titulados')">
              <!-- :href="route('posts.index')" :active="route().current('post.index')" -->
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
              </svg>

              <span class="ml-4"> Titulados</span>
              </Link>
            </li>

            <li>
              <Link class="
                      inline-flex
                      items-center
                      w-full
                      px-4
                      py-2
                      mt-1
                      text-base text-gray-900
                      transition
                      duration-500
                      ease-in-out
                      transform
                      rounded-lg
                      bg-gray-50
                      hover:bg-gray-200
                      focus:shadow-outline
                      hover:cursor-pointer
                    " white="" :href="route('usuario.becas')">
              <!-- :href="route('posts.index')" :active="route().current('post.index')" -->
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
              </svg>

              <span class="ml-4"> Becas</span>
              </Link>
            </li>

            <li>
              <Link class="
                      inline-flex
                      items-center
                      w-full
                      px-4
                      py-2
                      mt-1
                      text-base text-gray-900
                      transition
                      duration-500
                      ease-in-out
                      transform
                      rounded-lg
                      bg-gray-50
                      hover:bg-gray-200
                      focus:shadow-outline
                      hover:cursor-pointer
                    " white="" :href="route('usuario.transporte')">
              <!-- :href="route('posts.index')" :active="route().current('post.index')" -->
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
              </svg>

              <span class="ml-4"> Transporte</span>
              </Link>
            </li>

            <li>
              <Link class="
                      inline-flex
                      items-center
                      w-full
                      px-4
                      py-2
                      mt-1
                      text-base text-gray-900
                      transition
                      duration-500
                      ease-in-out
                      transform
                      rounded-lg
                      bg-gray-50
                      hover:bg-gray-200
                      focus:shadow-outline
                      hover:cursor-pointer
                    " white="" :href="route('usuario.cambio_de_carrera')">
              <!-- :href="route('posts.index')" :active="route().current('post.index')" -->
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
              </svg>

              <span class="ml-4"> Cambio de carrera</span>
              </Link>
            </li>
            <li>
              <Link class="
                      inline-flex
                      items-center
                      w-full
                      px-4
                      py-2
                      mt-1
                      text-base text-gray-900
                      transition
                      duration-500
                      ease-in-out
                      transform
                      rounded-lg
                      bg-gray-50
                      hover:bg-gray-200
                      focus:shadow-outline
                      hover:cursor-pointer
                    " white="" :href="route('usuario.segurofacultativo')">
              <!-- :href="route('posts.index')" :active="route().current('post.index')" -->
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
              </svg>

              <span class="ml-4"> Seguro facultativo</span>
              </Link>
            </li>

          </ul>
        </div>

        <div class="footerSideBarResponsive mt-8">
          <div class="avatar flex justify-center">
            <Avatar
                    v-if="$page.props.user.name.split(' ').length > 1"
                    :label="$page.props.user.name.charAt(0) + $page.props.user.name.split(' ')[1].charAt(0)"
                    class="mr-2"
                    size="large"
                    style="background-color: #2196f3; color: #ffffff"
                  />
            <Avatar
                    v-else-if="$page.props.user.name.split(' ').length == 1"
                    :label="$page.props.user.name.charAt(0)"
                    class="mr-2"
                    size="large"
                    style="background-color: #2196f3; color: #ffffff"
                  />
          </div>
          <h2 class="text-center">
            {{ $page.props.user.name }}
          </h2>
          <h2 class="text-center">
            {{ $page.props.user.email }}
          </h2>
          <div class="botones">
            <div>
              <Toast />
              <ConfirmDialog></ConfirmDialog>
              <ConfirmDialog group="templating">
                <template #message="slotProps">
                  <div class="flex p-4">
                    <i :class="slotProps.message.icon" style="font-size: 1.5rem"></i>
                    <p class="pl-2">{{ slotProps.message.message }}</p>
                  </div>
                </template>
              </ConfirmDialog>
              <ConfirmDialog group="positionDialog"></ConfirmDialog>

              <div class="card">
                <div class="grid flex-column">
                  <div class="p-col flex justify-center gap-5">
                    <!-- btn cerrar sesion con confirmacion -->
                    <Button @click="confirmPosition('bottomleft')" icon="pi pi-sign-out"
                      class="p-button-rounded p-button-secondary" />

                    <Button @click="showProfile()" icon="pi pi-cog" class="p-button-rounded p-button-secondary" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </Sidebar>
    </div>
  </div>

  <!-- sideBar empiezo -->
  <div class="absolute left-0 h-screen flex z-50">
    <div class="
        fixed
        h-screen
        top-0
        md:flex md:flex-shrink-0
        max-sm:hidden
        md:w-64
        border-r-2 border-gray-100
      ">
      <div class="flex flex-col w-64">
        <div class="
            flex flex-col flex-grow
            overflow-y-auto
            bg-white
            border-r border-gray-50
          ">
          <div class="flex flex-col items-center flex-shrink-0 px-4">
            <Link href="/dashboard" class="px-8 text-left focus:outline-none">
            <img src="https://visionindustrial.com.mx/wp-content/uploads/2016/08/UPQ-logo.jpg" alt="LogoUPQ" />
            </Link>
            <button class="hidden rounded-lg focus:outline-none focus:shadow-outline">
              <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                <path fill-rule="evenodd"
                  d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                  clip-rule="evenodd"></path>
                <path fill-rule="evenodd"
                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
              </svg>
            </button>
          </div>
          <div class="flex flex-col flex-grow px-4 mt-5">
            <nav class="flex-1 space-y-1 bg-white">
              <ul>

                <li>
                  <Link class="
                      inline-flex
                      items-center
                      w-full
                      px-4
                      py-2
                      mt-1
                      text-base text-gray-900
                      transition
                      duration-500
                      ease-in-out
                      transform
                      rounded-lg
                      bg-gray-50
                      hover:bg-gray-200
                      focus:shadow-outline
                      hover:cursor-pointer
                    " white="" :href="route('usuario.ingreso')" active="">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                  </svg>

                  <span class="ml-4"> Ingreso</span>
                  </Link>
                </li>

                <li>
                  <Link class="
                      inline-flex
                      items-center
                      w-full
                      px-4
                      py-2
                      mt-1
                      text-base text-gray-900
                      transition
                      duration-500
                      ease-in-out
                      transform
                      rounded-lg
                      bg-gray-50
                      hover:bg-gray-200
                      focus:shadow-outline
                      hover:cursor-pointer
                    " white="" :href="route('usuario.matricula')">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 4.5l15 15m0 0V8.25m0 11.25H8.25" />
                  </svg>

                  <span class="ml-4"> Matrícula</span>
                  </Link>
                </li>

                <li>
                  <Link class="
                      inline-flex
                      items-center
                      w-full
                      px-4
                      py-2
                      mt-1
                      text-base text-gray-900
                      transition
                      duration-500
                      ease-in-out
                      transform
                      rounded-lg
                      bg-gray-50
                      hover:bg-gray-200
                      focus:shadow-outline
                      hover:cursor-pointer
                    " white="" :href="route('usuario.bajas')">
                  <!-- :href="route('posts.index')" :active="route().current('post.index')" -->
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                  </svg>

                  <span class="ml-4"> Bajas</span>
                  </Link>
                </li>

                <li>
                  <Link class="
                      inline-flex
                      items-center
                      w-full
                      px-4
                      py-2
                      mt-1
                      text-base text-gray-900
                      transition
                      duration-500
                      ease-in-out
                      transform
                      rounded-lg
                      bg-gray-50
                      hover:bg-gray-200
                      focus:shadow-outline
                      hover:cursor-pointer
                    " white="" :href="route('usuario.egresados')">
                  <!-- :href="route('posts.index')" :active="route().current('post.index')" -->
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                  </svg>

                  <span class="ml-4"> Egresados</span>
                  </Link>
                </li>
                <li>
                  <Link class="
                      inline-flex
                      items-center
                      w-full
                      px-4
                      py-2
                      mt-1
                      text-base text-gray-900
                      transition
                      duration-500
                      ease-in-out
                      transform
                      rounded-lg
                      bg-gray-50
                      hover:bg-gray-200
                      focus:shadow-outline
                      hover:cursor-pointer
                    " white="" :href="route('usuario.titulados')">
                  <!-- :href="route('posts.index')" :active="route().current('post.index')" -->
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                  </svg>

                  <span class="ml-4"> Titulados</span>
                  </Link>
                </li>

                <li>
                  <Link class="
                      inline-flex
                      items-center
                      w-full
                      px-4
                      py-2
                      mt-1
                      text-base text-gray-900
                      transition
                      duration-500
                      ease-in-out
                      transform
                      rounded-lg
                      bg-gray-50
                      hover:bg-gray-200
                      focus:shadow-outline
                      hover:cursor-pointer
                    " white="" :href="route('usuario.becas')">
                  <!-- :href="route('posts.index')" :active="route().current('post.index')" -->
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                  </svg>

                  <span class="ml-4"> Becas</span>
                  </Link>
                </li>

                <li>
                  <Link class="
                      inline-flex
                      items-center
                      w-full
                      px-4
                      py-2
                      mt-1
                      text-base text-gray-900
                      transition
                      duration-500
                      ease-in-out
                      transform
                      rounded-lg
                      bg-gray-50
                      hover:bg-gray-200
                      focus:shadow-outline
                      hover:cursor-pointer
                    " white="" :href="route('usuario.transporte')">
                  <!-- :href="route('posts.index')" :active="route().current('post.index')" -->
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                  </svg>

                  <span class="ml-4"> Transporte</span>
                  </Link>
                </li>

                <li>
                  <Link class="
                      inline-flex
                      items-center
                      w-full
                      px-4
                      py-2
                      mt-1
                      text-base text-gray-900
                      transition
                      duration-500
                      ease-in-out
                      transform
                      rounded-lg
                      bg-gray-50
                      hover:bg-gray-200
                      focus:shadow-outline
                      hover:cursor-pointer
                    " white="" :href="route('usuario.cambio_de_carrera')">
                  <!-- :href="route('posts.index')" :active="route().current('post.index')" -->
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                  </svg>

                  <span class="ml-4"> Cambio de carrera</span>
                  </Link>
                </li>
                <li>
                  <Link class="
                      inline-flex
                      items-center
                      w-full
                      px-4
                      py-2
                      mt-1
                      text-base text-gray-900
                      transition
                      duration-500
                      ease-in-out
                      transform
                      rounded-lg
                      bg-gray-50
                      hover:bg-gray-200
                      focus:shadow-outline
                      hover:cursor-pointer
                    " white="" :href="route('usuario.segurofacultativo')">
                  <!-- :href="route('posts.index')" :active="route().current('post.index')" -->
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                  </svg>

                  <span class="ml-4"> Seguro facultativo</span>
                  </Link>
                </li>
              </ul>
              <div class="a absolute bottom-0 w-[95%] h-auto ">
                <div class="avatar flex justify-center">
                  <Avatar
                    v-if="$page.props.user.name.split(' ').length > 1"
                    :label="$page.props.user.name.charAt(0) + $page.props.user.name.split(' ')[1].charAt(0)"
                    class="mr-2"
                    size="large"
                    style="background-color: #2196f3; color: #ffffff"
                  />
            <Avatar
                    v-else-if="$page.props.user.name.split(' ').length == 1"
                    :label="$page.props.user.name.charAt(0)"
                    class="mr-2"
                    size="large"
                    style="background-color: #2196f3; color: #ffffff"
                  />
                </div>
                <h2 class="text-center">
                  {{ $page.props.user.name }}
                </h2>
                <h2 class="text-center">
                  {{ $page.props.user.email }}
                </h2>
                <div class="botones p-5">
                  <div>
                    <Toast />
                    <ConfirmDialog></ConfirmDialog>
                    <ConfirmDialog group="templating">
                      <template #message="slotProps">
                        <div class="flex p-4">
                          <i :class="slotProps.message.icon" style="font-size: 1.5rem"></i>
                          <p class="pl-2">{{ slotProps.message.message }}</p>
                        </div>
                      </template>
                    </ConfirmDialog>
                    <ConfirmDialog group="positionDialog"></ConfirmDialog>

                    <div class="card">
                      <div class="grid flex-column">
                        <div class="p-col flex justify-center gap-5">
                          <!-- btn cerrar sesion con confirmacion -->
                          <Button @click="confirmPosition('bottomleft')" icon="pi pi-sign-out"
                            class="p-button-rounded p-button-secondary" />

                          <Button @click="showProfile()" icon="pi pi-cog" class="p-button-rounded p-button-secondary" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Page Heading -->
  <header v-if="$slots.header" class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 md:ml-[260px]">
      <slot name="header" />
    </div>
  </header>

  <!-- Page Content -->
  <main class="h-sc ml-[244px] max-sm:m-auto  ">
    <slot />
  </main>
</template>

<style scoped>

</style>