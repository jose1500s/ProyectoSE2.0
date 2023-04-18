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
                  d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
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
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M14.75 15c.966 0 1.75.784 1.75 1.75l-.001.962c.117 2.19-1.511 3.297-4.432 3.297c-2.91 0-4.567-1.09-4.567-3.259v-1c0-.966.784-1.75 1.75-1.75h5.5Zm0 1.5h-5.5a.25.25 0 0 0-.25.25v1c0 1.176.887 1.759 3.067 1.759c2.168 0 2.995-.564 2.933-1.757V16.75a.25.25 0 0 0-.25-.25Zm-11-6.5h4.376a4.007 4.007 0 0 0-.095 1.5H3.75a.25.25 0 0 0-.25.25v1c0 1.176.887 1.759 3.067 1.759c.462 0 .863-.026 1.207-.077a2.743 2.743 0 0 0-1.173 1.576l-.034.001C3.657 16.009 2 14.919 2 12.75v-1c0-.966.784-1.75 1.75-1.75Zm16.5 0c.966 0 1.75.784 1.75 1.75l-.001.962c.117 2.19-1.511 3.297-4.432 3.297l-.169-.002a2.755 2.755 0 0 0-1.218-1.606c.387.072.847.108 1.387.108c2.168 0 2.995-.564 2.933-1.757V11.75a.25.25 0 0 0-.25-.25h-4.28a4.05 4.05 0 0 0-.096-1.5h4.376ZM12 8a3 3 0 1 1 0 6a3 3 0 0 1 0-6Zm0 1.5a1.5 1.5 0 1 0 0 3a1.5 1.5 0 0 0 0-3ZM6.5 3a3 3 0 1 1 0 6a3 3 0 0 1 0-6Zm11 0a3 3 0 1 1 0 6a3 3 0 0 1 0-6Zm-11 1.5a1.5 1.5 0 1 0 0 3a1.5 1.5 0 0 0 0-3Zm11 0a1.5 1.5 0 1 0 0 3a1.5 1.5 0 0 0 0-3Z" />
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
                  d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
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
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
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
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 48 48">
                <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                  <path
                    d="M14 6a2 2 0 0 0-2 2v28a2 2 0 0 0 2 2h11v2H14a4 4 0 0 1-4-4V8a4 4 0 0 1 4-4h20a4 4 0 0 1 4 4v28a4 4 0 0 1-4 4h-3v-2h3a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2H14Z" />
                  <path
                    d="M18 11a1 1 0 0 1 1-1h10a1 1 0 1 1 0 2H19a1 1 0 0 1-1-1Zm-4 6a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H15a1 1 0 0 1-1-1Zm0 4a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H15a1 1 0 0 1-1-1Zm0 4a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H15a1 1 0 0 1-1-1Zm14 10a2 2 0 1 0 0-4a2 2 0 0 0 0 4Zm0 2a4 4 0 1 0 0-8a4 4 0 0 0 0 8Z" />
                  <path d="M27 35h-2v9l3-1.5l3 1.5v-9h-2v5.764l-1-.5l-1 .5V35Z" />
                </g>
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
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
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
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24">
                <path fill="currentColor"
                  d="M21.004 7.975V6c0-2.206-1.794-4-4-4h-10c-2.206 0-4 1.794-4 4v1.998l-.076.004A1 1 0 0 0 2 9v2a1 1 0 0 0 1 1h.004v6c0 .735.403 1.372.996 1.72V21a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1h10v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1.276A1.994 1.994 0 0 0 21.004 18v-6a1 1 0 0 0 1-1V9.062a1.006 1.006 0 0 0-.072-.455c-.203-.487-.635-.604-.928-.632zM19.006 18H5.004v-5h14.001l.001 5zM11.004 7v4h-6V7h6zm8 0v4h-6V7h6zm-12-3h10c.736 0 1.375.405 1.722 1H5.282c.347-.595.986-1 1.722-1z" />
                <circle cx="7.5" cy="15.5" r="1.5" fill="currentColor" />
                <circle cx="16.5" cy="15.5" r="1.5" fill="currentColor" />
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
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
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
                      " white="" :href="route('usuario.equivalencia')">
              <!-- :href="route('posts.index')" :active="route().current('post.index')" -->
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
              </svg>
              <span class="ml-4"> Equivalencia </span>
              </Link>
            </li>

          </ul>
        </div>

        <div class="footerSideBarResponsive mt-8">
          <div class="avatar flex justify-center">
            <div id="divFoto" v-if="$page.props.jetstream.managesProfilePhotos"
                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition w-[25%] h-[60px]">
                    <img class="h-full w-full rounded-full object-cover" :src="$page.props.user.profile_photo_url"
                      :alt="$page.props.user.name">
                  </div>

                  <Avatar v-else-if="$page.props.user.name.split(' ').length > 1"
                    :label="$page.props.user.name.charAt(0) + $page.props.user.name.split(' ')[1].charAt(0)" class="mr-2"
                    size="large" style="background-color: #2196f3; color: #ffffff" />

                  <Avatar v-else-if="$page.props.user.name.split(' ').length == 1"
                    :label="$page.props.user.name.charAt(0)" class="mr-2" size="large"
                    style="background-color: #2196f3; color: #ffffff" />
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
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
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
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24">
                    <path fill="currentColor"
                      d="M14.75 15c.966 0 1.75.784 1.75 1.75l-.001.962c.117 2.19-1.511 3.297-4.432 3.297c-2.91 0-4.567-1.09-4.567-3.259v-1c0-.966.784-1.75 1.75-1.75h5.5Zm0 1.5h-5.5a.25.25 0 0 0-.25.25v1c0 1.176.887 1.759 3.067 1.759c2.168 0 2.995-.564 2.933-1.757V16.75a.25.25 0 0 0-.25-.25Zm-11-6.5h4.376a4.007 4.007 0 0 0-.095 1.5H3.75a.25.25 0 0 0-.25.25v1c0 1.176.887 1.759 3.067 1.759c.462 0 .863-.026 1.207-.077a2.743 2.743 0 0 0-1.173 1.576l-.034.001C3.657 16.009 2 14.919 2 12.75v-1c0-.966.784-1.75 1.75-1.75Zm16.5 0c.966 0 1.75.784 1.75 1.75l-.001.962c.117 2.19-1.511 3.297-4.432 3.297l-.169-.002a2.755 2.755 0 0 0-1.218-1.606c.387.072.847.108 1.387.108c2.168 0 2.995-.564 2.933-1.757V11.75a.25.25 0 0 0-.25-.25h-4.28a4.05 4.05 0 0 0-.096-1.5h4.376ZM12 8a3 3 0 1 1 0 6a3 3 0 0 1 0-6Zm0 1.5a1.5 1.5 0 1 0 0 3a1.5 1.5 0 0 0 0-3ZM6.5 3a3 3 0 1 1 0 6a3 3 0 0 1 0-6Zm11 0a3 3 0 1 1 0 6a3 3 0 0 1 0-6Zm-11 1.5a1.5 1.5 0 1 0 0 3a1.5 1.5 0 0 0 0-3Zm11 0a1.5 1.5 0 1 0 0 3a1.5 1.5 0 0 0 0-3Z" />
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
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
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
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
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
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 48 48">
                    <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                      <path
                        d="M14 6a2 2 0 0 0-2 2v28a2 2 0 0 0 2 2h11v2H14a4 4 0 0 1-4-4V8a4 4 0 0 1 4-4h20a4 4 0 0 1 4 4v28a4 4 0 0 1-4 4h-3v-2h3a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2H14Z" />
                      <path
                        d="M18 11a1 1 0 0 1 1-1h10a1 1 0 1 1 0 2H19a1 1 0 0 1-1-1Zm-4 6a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H15a1 1 0 0 1-1-1Zm0 4a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H15a1 1 0 0 1-1-1Zm0 4a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H15a1 1 0 0 1-1-1Zm14 10a2 2 0 1 0 0-4a2 2 0 0 0 0 4Zm0 2a4 4 0 1 0 0-8a4 4 0 0 0 0 8Z" />
                      <path d="M27 35h-2v9l3-1.5l3 1.5v-9h-2v5.764l-1-.5l-1 .5V35Z" />
                    </g>
                  </svg>

                  <span class="ml-3"> Titulados</span>
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
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
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
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24">
                    <path fill="currentColor"
                      d="M21.004 7.975V6c0-2.206-1.794-4-4-4h-10c-2.206 0-4 1.794-4 4v1.998l-.076.004A1 1 0 0 0 2 9v2a1 1 0 0 0 1 1h.004v6c0 .735.403 1.372.996 1.72V21a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1h10v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1.276A1.994 1.994 0 0 0 21.004 18v-6a1 1 0 0 0 1-1V9.062a1.006 1.006 0 0 0-.072-.455c-.203-.487-.635-.604-.928-.632zM19.006 18H5.004v-5h14.001l.001 5zM11.004 7v4h-6V7h6zm8 0v4h-6V7h6zm-12-3h10c.736 0 1.375.405 1.722 1H5.282c.347-.595.986-1 1.722-1z" />
                    <circle cx="7.5" cy="15.5" r="1.5" fill="currentColor" />
                    <circle cx="16.5" cy="15.5" r="1.5" fill="currentColor" />
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
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
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
                      " white="" :href="route('usuario.equivalencia')">
                  <!-- :href="route('posts.index')" :active="route().current('post.index')" -->
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                  </svg>
                  <span class="ml-4"> Equivalencia </span>
                  </Link>
                </li>
              </ul>
              <div class="a absolute bottom-0 w-[95%] h-auto ">
                <div class="avatar flex justify-center">

                  <div id="divFoto" v-if="$page.props.jetstream.managesProfilePhotos"
                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition w-[25%] h-[60px]">
                    <img class="h-full w-full rounded-full object-cover" :src="$page.props.user.profile_photo_url"
                      :alt="$page.props.user.name">
                  </div>

                  <Avatar v-else-if="$page.props.user.name.split(' ').length > 1"
                    :label="$page.props.user.name.charAt(0) + $page.props.user.name.split(' ')[1].charAt(0)" class="mr-2"
                    size="large" style="background-color: #2196f3; color: #ffffff" />

                  <Avatar v-else-if="$page.props.user.name.split(' ').length == 1"
                    :label="$page.props.user.name.charAt(0)" class="mr-2" size="large"
                    style="background-color: #2196f3; color: #ffffff" />

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
</main></template>

<style scoped></style>