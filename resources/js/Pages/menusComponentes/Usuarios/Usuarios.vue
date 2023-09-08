<script>
// Componentes

// PrimeVue
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Button from "primevue/button";
import Toolbar from "primevue/toolbar";
import Dialog from "primevue/dialog";
import Dropdown from "primevue/dropdown";
import InputNumber from "primevue/inputnumber";
import InputText from 'primevue/inputtext';
import MultiSelect from 'primevue/multiselect';
import Toast from "primevue/toast";
import { FilterMatchMode, FilterService } from "primevue/api";

export default {
  components: {
    DataTable,
    Column,
    Button,
    Toolbar,
    Dialog,
    Dropdown,
    InputNumber,
    InputText,
    MultiSelect,
    Toast,
  },
  props: {
    usuarios: Array,
    roles: Array,
    permisos: Array,
  },
  data() {
    return {
      productDialog: false,
      nombre: null,
      email: null,
      contra: null,
      repcontra: null,
      rol: null,
      editDialog: false,
      deleteProductDialog: false,
      selectedProducts: null,
      deleteProductsDialog: false,
      filters: {
        rol: { value: null, matchMode: FilterMatchMode.IN },
      }
    };
  },
  methods: {
    openNew() {
      this.product = {};
      this.submitted = false;
      this.productDialog = true;
    },
    hideDialog() {
      this.productDialog = false;
      this.submitted = false;
    },
    registrarUsuario() {
      this.submmited = true;

      if(this.nombre == null || this.email == null || this.rol == null){
        this.$toast.add({
          severity: "error",
          summary: "Error",
          detail: "Todos los campos son obligatorios",
          life: 3000,
        });
        return false;
      } else {
        const data = {
          nombre: this.nombre,
          email: this.email,
          // contra: this.contra,
          // repcontra: this.contra,
          rol: this.rol,
        };
        this.$inertia.post("/registrar-Usuario", data, {
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => {
            this.productDialog = false;
            this.$toast.add({
              severity: "success",
              summary: "Exito",
              detail: "Registro exitoso",
              life: 3000,
            });
          },
        });
      }
    },
    editProduct(product) {
      this.product = { ...product };
      this.editDialog = true;
    },
    editarUsuario() {
      this.submitted = true;

      if(this.product.id == 0 || this.product.name == null || this.product.email == null || this.product.rol == null){
        this.$toast.add({
          severity: "error",
          summary: "Error",
          detail: "Todos los campos son obligatorios: ",
          life: 3000,
        });
        return false;
      } else {
        const data = {
          id: this.product.id,
          nombre: this.product.name,
          email: this.product.email,
          rol: this.product.rol,
        };
        this.$inertia.post(`/editar-Usuario`, data, {
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => {
            this.editDialog = false;
            this.$toast.add({
              severity: "success",
              summary: "Exito",
              detail: "Modificado exitosamente",
              life: 3000,
            });
          }
        });
      }
    },
    confirmDeleteProduct(product) {
      this.product = product;
      this.deleteProductDialog = true;
    },
    eliminarUsuario() {
      const data = {
        id: this.product.id,
      };
      this.$inertia.post(`/eliminar-Usuario`, data, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          this.deleteProductDialog = false;
          this.product = {};
          this.$toast.add({
            severity: "success",
            summary: "Exitoso",
            detail: "Eliminado exitosamente",
          });
        },
      });
    },
    confirmDeleteSelected () {
      this.deleteProductsDialog = true;
    },
    eliminarUsuarios() {
      const data = {
        id: this.selectedProducts.map((item) => item.id),
      };
      this.$inertia.post(`/eliminar-Usuarios`, data, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          this.deleteProductsDialog = false;
          this.$toast.add({
            severity: "success",
            summary: "Exito",
            detail: "Eliminados exitosamente",
            life: 3000,
          });
        }
      })
    },
    filtrarRoles() {
      const roles = ['consulta'];
      return roles;
    },
    limpiarFiltros() {
      this.selectedProducts = null;
      this.filters.rol.value = null;
      this.$refs.dt.filter(this.filters, "rol");
    },
  }
};
</script>

<template>
    <Toolbar class="mb-4">
    <template #start>
      <Button label="Nuevo Registro" icon="pi pi-plus" class="p-button-success !mr-2" @click="openNew" />
      <Button label="Eliminar" icon="pi pi-trash" class="p-button-danger" @click="confirmDeleteSelected"
        :disabled="!selectedProducts || !selectedProducts.length" />
        <!-- <Button v-if="usuario.roles.includes('rol_admin')" label="Nuevo Registro" icon="pi pi-plus" class="p-button-success !mr-2" @click="openNew" />
      <Button v-if="usuario.roles.includes('rol_admin')" label="Eliminar" icon="pi pi-trash" class="p-button-danger" @click="confirmDeleteSelected" -->
    </template>
  </Toolbar>

  <!-- Dialog para registrar Usuarios -->
  <Dialog v-model:visible="productDialog" :breakpoints="{ '960px': '75vw', '640px': '85vw' }" :style="{ width: '25vw' }"
    header="Nuevo Registro" :modal="true" class="p-fluid">
    <div class="field">
      <form @submit.prevent="registrarUsuario">
        
        <div class="field col-12 md:col-3">
          <label for="minmax">Nombre Completo</label>
          <InputText inputId="minmax" v-model="nombre" :min="0" :max="10000" :showButtons="true" />
        </div>

        <div class="field col-12 md:col-3">
          <label for="minmax">Correo Electrónico</label>
          <InputText inputId="minmax" v-model="email" :min="0" :max="10000" :showButtons="true" />
        </div>

        <div class="p-field p-col-12 p-md-6">
              <label for="rol">Roles</label>
              <Dropdown v-model="rol" :options="roles" optionLabel="name" optionValue="code"
          placeholder="Rol..." />
            </div>

        <!-- <div class="field col-12 md:col-3">
          <label for="minmax">Contraseña</label>
          <InputText inputId="minmax" v-model="contra" :min="0" :max="10000" :showButtons="true" />
        </div>

        <div class="field col-12 md:col-3">
          <label for="minmax">Confirmar contraseña</label>
          <InputText inputId="minmax" v-model="repcontra" :min="0" :max="10000" :showButtons="true" />
        </div> -->

        <Button type="submit" id="btnRegisrar"
          class="flex items-center justify-center space-x-2 rounded-md border-2 border-blue-500 px-4 py-2 font-medium text-blue-600 transition hover:bg-blue-500 hover:text-white">
          <span> Registrar </span>
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
              <path fill-rule="evenodd"
                d="M16.72 7.72a.75.75 0 011.06 0l3.75 3.75a.75.75 0 010 1.06l-3.75 3.75a.75.75 0 11-1.06-1.06l2.47-2.47H3a.75.75 0 010-1.5h16.19l-2.47-2.47a.75.75 0 010-1.06z"
                clip-rule="evenodd" />
            </svg>
          </span>
        </Button>
      </form>
    </div>
  </Dialog>

  <section class="bg-white">
    <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8 p-[20px]">

      <!-- Filtros Usuarios -->
      <div class="text-center mb-5">
        <div class="flex gap-5 justify-center flex-wrap">
          <div>
            <Toast />
          </div>
          <!-- <MultiSelect class="w-full md:w-10rem" v-model="filters.rol.value" :options="filtrarRoles()" placeholder="Roles"
            display="chip" /> -->
            <MultiSelect v-model="filters.rol.value" :options="roles" optionLabel="name" optionValue="code" placeholder="Roles"
            display="chip" />

          <Button icon="pi pi-times" label="Limpiar" @click="limpiarFiltros()" />
        </div>
      </div>

      <!-- Tabla usuarios -->
      <DataTable :value="usuarios" :paginator="true" class="p-datatable-customers" :rows="7" ref="dt"
        v-model:filters="filters" v-model:selection="selectedProducts" stripedRows
        sortMode="multiple" removableSort>
        <Column selectionMode="multiple" style="width: 3rem" :exportable="false"></Column>

        <Column field="id" header="ID" :sortable="true" hidden></Column>
        <Column field="name" header="Nombre" :sortable="true"></Column>
        <Column field="email" header="Email" :sortable="true"></Column>
        <Column field="rol" header="Rol" :sortable="true"></Column>
        <Column :exportable="false" style="min-width: 8rem" class="p-6">
          <template #body="slotProps">
              <div v-if="slotProps.data.name == $page.props.user.name">
                <Button disabled icon="pi pi-pencil" class="p-button-rounded p-button-success !mr-2"
              @click="editProduct(slotProps.data)" />
            <Button disabled icon="pi pi-trash" class="p-button-rounded p-button-warning"
              @click="confirmDeleteProduct(slotProps.data)" />
              </div>
              <div v-else>
                <Button icon="pi pi-pencil" class="p-button-rounded p-button-success !mr-2"
              @click="editProduct(slotProps.data)" />
            <Button icon="pi pi-trash" class="p-button-rounded p-button-warning"
              @click="confirmDeleteProduct(slotProps.data)" />
              </div>
          </template>
        </Column>

        <!-- Mensaje en caso de que no se encuentren datos -->
        <template #empty>
          <div class="flex justify-center align-middle text-xl">
            <h2>No se encontraron datos</h2>
          </div>
        </template>
      </DataTable>

      <!-- Dialog para editar Usuarios -->
      <Dialog header="Editar Usuario" v-model:visible="editDialog" :breakpoints="{ '960px': '75vw', '75vw': '85vw' }"
        :style="{ width: '25vw' }" :modal="true" :closable="true" :dismissableMask="false">
        <div class="p-fluid p-formgrid p-grid">
          <form @submit.prevent="editarUsuario">
            <InputText id="id" v-model.trim="product.id" hidden /> 

            <div class="p-field p-col-12 p-md-6">
              <label for="name">Nombre</label>
              <InputText id="name" v-model.trim="product.name" />
            </div>
            <div class="p-field p-col-12 p-md-6">
              <label for="name">Correo</label>
              <InputText id="email" v-model.trim="product.email" />
            </div>

          <div class="p-field p-col-12 p-md-6">
              <label for="rol">Roles</label>
              <Dropdown id="rol" v-model.trim="product.rol" :options="roles" optionLabel="name" optionValue="name"
          placeholder="Roles..." />
            </div>
            <Button type="submit" label="Guardar" icon="pi pi-check" class="!mt-3" />
          </form>
        </div>
      </Dialog>

      <!-- Dialog para confirmar la eliminación del usuario -->
      <Dialog v-model:visible="deleteProductDialog" :style="{ width: '450px' }" header="Confirmar" :modal="true">
        <div class="confirmation-content flex justify-center items-center">
          <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
          <span v-if="product">¿Confirma eliminar el registro <b>{{ product.name }}</b>?</span>
        </div>
        <template #footer>
          <Button label="No" icon="pi pi-times" class="p-button-text" @click="deleteProductDialog = false" />
          <Button label="Si" icon="pi pi-check" class="p-button-text" @click="eliminarUsuario" />
        </template>
      </Dialog>

      <!-- Dialog para confirmar la eliminación de los usuarios seleccionados -->
      <Dialog v-model:visible="deleteProductsDialog" :style="{ width: '550px' }" header="Confirm" :modal="true">
        <div class="confirmation-content flex items-center justify-center">
          <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
          <span>
            ¿Confirma eliminar los registros seleccionados?
          </span>
        </div>
        <template #footer>
          <Button label="No" icon="pi pi-times" class="p-button-text" @click="deleteProductsDialog = false" />
          <Button label="Yes" icon="pi pi-check" class="p-button-text" @click="eliminarUsuarios" />
        </template>
      </Dialog>

    </div>
  </section>
</template>

<style type="text/css">
.p-multiselect-label-container {
  max-width: 170px;
}
.p-dialog-footer {
  display: flex;
  justify-content: center;
  align-items: center;
}
div#contenedorGrafica canvas {
  width: 100% !important;
  height: auto !important;
}
#btnRegisrar {
  margin-top: 1.5rem;
  font-size: 1.1rem;
}
</style>