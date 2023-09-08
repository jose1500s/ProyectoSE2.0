<script>
// Componentes
import AppLayout from "@/Layouts/AppLayout.vue";

// PrimeVue
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Button from "primevue/button";
import Toolbar from "primevue/toolbar";
import Dialog from "primevue/dialog";
import Dropdown from "primevue/dropdown";
import InputNumber from "primevue/inputnumber";
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import MultiSelect from 'primevue/multiselect';
import Toast from "primevue/toast";
import { FilterMatchMode, FilterService } from "primevue/api";
import ToggleButton from 'primevue/togglebutton';

export default {
  components: {
    AppLayout,
    DataTable,
    Column,
    Button,
    Toolbar,
    Dialog,
    Dropdown,
    InputNumber,
    InputText,
    Textarea,
    MultiSelect,
    Toast,
    ToggleButton,
  },
  props: {
    usuarios: Array,
    roles: Object,
    permisos: Array,
    // t_permisos: Array,
  },
  data() {
    return {
      productDialog: false,
      nombre: null,
      descripcion: null,
      editDialog: false,
      deleteProductDialog: false,
      deleteProductsDialog: false,
      selectedProducts: null,
      permissionDialog: false,
      checked: true,
      modulo: null,
      registrar: null,
      consultar: null,
      editar: null,
      eliminar: null,
      noDataMessage: "No se encontraron datos",
      RolSeleccionado: null,
      PermisosSeleccionados: false,
      PermisosDisponibles: false,
      PermisosActivos: [],
      activado: true,
    };
  },
  methods: {
    openNew() {
      this.product = {};
      this.submitted = false;
      this.productDialog = true;
    },
    registrarRol() {
      this.submmited = true;

      if(this.nombre == null || this.descripcion == null){
        this.$toast.add({
          severity: "error",
          summary: "Error",
          detail: "Todos los campos son obligatorios: " + this.descripcion,
          life: 3000,
        });
        return false;
      } else {
        const data = {
          nombre: this.nombre,
          descripcion: this.descripcion,
        };
        this.$inertia.post("/registrar-Rol", data, {
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
    editarRol() {
      this.submitted = true;

      if(this.product.id == 0 || this.product.name == null || this.product.description == null){
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
          descripcion: this.product.description,
        };
        this.$inertia.post(`/editar-Rol`, data, {
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

      const data = {
        id: this.product.id,
      }

      axios.post('verificar-Rol', data, {
        preserveState: true,
        preserveScroll: true,
      }).then(response => {
        if(response.data){
          this.deleteProductDialog = true;
        } else {
            this.product = {};
            this.$toast.add({
              severity: "warn",
              summary: "Advertencia",
              detail: "No se puede eliminar el rol, ya que tiene uno o más usuarios asociados",
              life: 3000,
            });
        }
      });
    },
    eliminarRol() {
      const data = {
        id: this.product.id,
      };
      this.$inertia.post(`/eliminar-Rol`, data, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          this.deleteProductDialog = false;
          this.product = {};
          this.$toast.add({
            severity: "success",
            summary: "Exitoso",
            detail: "Eliminado exitosamente",
            life: 3000,
          });
        },
      });
    },
    confirmDeleteSelected () {
      this.deleteProductsDialog = true;
    },
    eliminarRoles() {
      const data = {
        id: this.selectedProducts.map((item) => item.id),
      };
      this.$inertia.post(`/eliminar-Roles`, data, {
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
    async PermissionProduct(product) {
      this.product = { ...product };

      var contador = 0;
      
      this.$page.props.roles.forEach((rol) => {
        if(product.id == rol.id){

          const permiso = contador;

          product = rol;

          console.log(permiso);
        }

        contador++;
      });

      const data = {
        id: product.id,
      };
      
      axios.post('/obtener-Permisos', data, {
        preserveState: true,
        preserveScroll: true,
      }).then(response => {
        this.PermisosActivos = response.data;
      });

      this.permissionDialog = true;

    },
    cambiarPermiso(id_rol, product){
      if(product.estado == true){
        this.agregarPermiso(id_rol, product.id);
      } else if(product.estado == false){
        this.removerPermiso(id_rol, product.id);
      }

    },
    agregarPermiso(id_rol, id_permiso){
      const data = {
        id_rol: id_rol,
        id_permiso: id_permiso,
      }

      this.$inertia.post("/agregar-Permiso", data, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          this.productDialog = false;
          this.$toast.add({
            severity: "success",
            summary: "Exito",
            detail: "Permiso agregado",
            life: 1000,
          });
        },
      });
    },
    removerPermiso(id_rol, id_permiso){
      const data = {
        id_rol: id_rol,
        id_permiso: id_permiso,
      }

      this.$inertia.post("/remover-Permiso", data, {
        preserveSatte: true,
        preserveScroll: true,
        onSuccess: () => {
          this.productDialog = false;
          this.$toast.add({
            severity: "success",
            summary: "Exito",
            detail: "Permiso removido",
            life: 1000,
          });
        },
      });
    },
    hasPermission(permiso){
      return this.product.some(permission => permission.name === permiso);
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

  <!-- Dialog para registrar Roles -->
  <Dialog v-model:visible="productDialog" :breakpoints="{ '960px': '75vw', '640px': '85vw' }" :style="{ width: '25vw' }"
    header="Nuevo Registro" :modal="true" class="p-fluid" :closable="true">
    <div class="field">
      <form @submit.prevent="registrarRol">
        
        <div class="field col-12 md:col-3">
          <label for="minmax">Nombre</label>
          <InputText inputId="minmax" v-model="nombre" :min="0" :max="10000" :showButtons="true" />
        </div>

        <div class="field col-12 md:col-3">
          <label for="minmax">Descripción</label>
          <InputText inputId="minmax" v-model="descripcion" :min="0" :max="10000" :showButtons="true" />
        </div>
        
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

      <!-- Tabla Roles -->
      <DataTable :value="roles" :paginator="true" class="p-datatable-customers" :rows="7" ref="dt"
         v-model:selection="selectedProducts" :emptyMessage="noDataMessage" stripedRows
        sortMode="multiple" removableSort>
        <Column selectionMode="multiple" style="width: 3rem" :exportable="false"></Column>
        <Column field="id" header="ID" :sortable="true" hidden></Column>
        <Column field="name" header="Nombre" :sortable="true"></Column>
        <Column field="description" header="Descripción" :sortable="true"></Column>
        <Column :exportable="false" style="min-width: 8rem" class="p-6">
          <template #body="slotProps">
            <!-- <Button v-if="slotProps.data.name == 'Administrador'" disabled icon="pi pi-wrench" class="p-button-rounded p-button-primary !mr-2"
              @click="PermissionProduct(slotProps.data)" /> -->
              <div v-if="slotProps.data.name == 'Administrador'">
                <Button disabled icon="pi pi-wrench" class="p-button-rounded p-button-primary !mr-2"
                  @click="PermissionProduct(slotProps.data)" />
                <Button disabled icon="pi pi-pencil" class="p-button-rounded p-button-success !mr-2"
                  @click="editProduct(slotProps.data)" />
                <Button disabled icon="pi pi-trash" class="p-button-rounded p-button-warning"
              @click="confirmDeleteProduct(slotProps.data)" />
              </div>
              <div v-else>
                <Button icon="pi pi-wrench" class="p-button-rounded p-button-primary !mr-2"
              @click="PermissionProduct(slotProps.data)" />
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

      <!-- Dialog para editar Roles -->
      <Dialog header="Editar Usuario" v-model:visible="editDialog" :breakpoints="{ '960px': '75vw', '75vw': '85vw' }"
        :style="{ width: '25vw' }" :modal="true" :closable="true" :dismissableMask="false">
        <div class="p-fluid p-formgrid p-grid">
          <form @submit.prevent="editarRol">
            <InputText id="id" v-model.trim="product.id" hidden /> 

            <div class="p-field p-col-12 p-md-6">
              <label for="name">Nombre</label>
              <InputText id="name" v-model.trim="product.name" />
            </div>
            <div class="p-field p-col-12 p-md-6">
              <label for="name">Descripción</label>
              <InputText id="description" v-model.trim="product.description" />
            </div>

            <Button type="submit" label="Guardar" icon="pi pi-check" class="!mt-3" />
          </form>
        </div>
      </Dialog>

      <!-- Dialog para confirmar la eliminación de un Rol -->
      <Dialog v-model:visible="deleteProductDialog" :style="{ width: '450px' }" header="Confirmar" :modal="true">
        <div class="confirmation-content flex justify-center items-center">
          <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
          <span v-if="product">¿Confirma eliminar el registro <b>{{ product.name }}</b>?</span>
        </div>
        <template #footer>
          <Button label="No" icon="pi pi-times" class="p-button-text" @click="deleteProductDialog = false" />
          <Button label="Si" icon="pi pi-check" class="p-button-text" @click="eliminarRol" />
        </template>
      </Dialog>

      <!-- Dialog para confirmar la eliminación de los roles seleccionados -->
      <Dialog v-model:visible="deleteProductsDialog" :style="{ width: '550px' }" header="Confirm" :modal="true">
        <div class="confirmation-content flex items-center justify-center">
          <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
          <span>
            ¿Confirma eliminar los registros seleccionados?
          </span>
        </div>
        <template #footer>
          <Button label="No" icon="pi pi-times" class="p-button-text" @click="deleteProductsDialog = false" />
          <Button label="Yes" icon="pi pi-check" class="p-button-text" @click="eliminarRoles" />
        </template>
      </Dialog>

      <!-- Dialog para la asignación de permisos -->
      <Dialog v-model:visible="permissionDialog" :breakpoints="{ '960px': '75vw', '640px': '85vw' }" :style="{ width: '70vw' }"
    header="Permisos" :modal="true" class="p-fluid"  :closable="true">
        <div class="field">
          <DataTable :value="PermisosActivos" class="p-datatable-customers" ref="dt"
             :emptyMessage="noDataMessage" stripedRows
            sortMode="multiple" removableSort>
            <Column field="id" header="ID" :sortable="true" hidden></Column>
            <!-- <Column :field="product.id" header="Rol ID" :sortable="true"></Column> -->
            <Column field="name" header="Modulo" :sortable="true"></Column>
            <Column field="consultar" header="Consultar" :sortable="true">
              <template #body="slotProps">
                  <ToggleButton v-if="slotProps.data.registrar.estado == false && slotProps.data.editar.estado == false && slotProps.data.eliminar.estado == false" v-model="slotProps.data.consultar.estado" onLabel="Activado" offLabel="Desactivado" onIcon="pi pi-check" offIcon="pi pi-times" class="w-9rem p-button-sm tg-button" @change="cambiarPermiso(product.id, slotProps.data.consultar)"/>
                  <ToggleButton v-else disabled v-model="slotProps.data.consultar.estado" onLabel="Activado" offLabel="Desactivado" onIcon="pi pi-check" offIcon="pi pi-times" class="w-9rem p-button-sm tg-button" @change="cambiarPermiso(product.id, slotProps.data.consultar)"/>
              </template>
            </Column>
            <Column field="registrar" header="Registrar" :sortable="true">
              <template #body="slotProps">
                <ToggleButton v-if="slotProps.data.consultar.estado == true" v-model="slotProps.data.registrar.estado" onLabel="Activado" offLabel="Desactivado" onIcon="pi pi-check" offIcon="pi pi-times" class="w-9rem p-button-sm tg-button" @change="cambiarPermiso(product.id, slotProps.data.registrar)"/>
                <ToggleButton v-else disabled v-model="slotProps.data.consultar.estado" onLabel="Activado" offLabel="Desactivado" onIcon="pi pi-check" offIcon="pi pi-times" class="w-9rem p-button-sm tg-button" @change="cambiarPermiso(product.id, slotProps.data.consultar)"/>
              </template>
            </Column>
            <Column field="editar" header="Editar" :sortable="true">
              <template #body="slotProps">
                  <ToggleButton v-if="slotProps.data.consultar.estado == true" v-model="slotProps.data.editar.estado" onLabel="Activado" offLabel="Desactivado" onIcon="pi pi-check" offIcon="pi pi-times" class="w-9rem p-button-sm tg-button" @change="cambiarPermiso(product.id, slotProps.data.editar)"/>
                  <ToggleButton v-else disabled v-model="slotProps.data.editar.estado" onLabel="Activado" offLabel="Desactivado" onIcon="pi pi-check" offIcon="pi pi-times" class="w-9rem p-button-sm tg-button" @change="cambiarPermiso(product.id, slotProps.data.editar)"/>
              </template>
            </Column>
            <Column field="eliminar" header="Eliminar" :sortable="true">
              <template #body="slotProps">
                  <ToggleButton v-if="slotProps.data.consultar.estado == true" v-model="slotProps.data.eliminar.estado" onLabel="Activado" offLabel="Desactivado" onIcon="pi pi-check" offIcon="pi pi-times" class="w-9rem p-button-sm tg-button" @change="cambiarPermiso(product.id, slotProps.data.eliminar)"/>
                  <ToggleButton v-else disabled v-model="slotProps.data.eliminar.estado" onLabel="Activado" offLabel="Desactivado" onIcon="pi pi-check" offIcon="pi pi-times" class="w-9rem p-button-sm tg-button" @change="cambiarPermiso(product.id, slotProps.data.eliminar)"/>
              </template>
            </Column>
          
            <!-- Mensaje en caso de que no se encuentren datos -->
            <template #empty>
              <div class="flex justify-center align-middle text-xl">
                <h2>No se encontraron datos</h2>  
              </div>
            </template>
          </DataTable>
        
          <!-- <ToggleButton v-model="checked" onLabel="I confirm" offLabel="I reject" onIcon="pi pi-check" offIcon="pi pi-times" class="w-9rem" />
          <ToggleButton v-model="checked" /> -->
          
        </div>
      </Dialog>

    </div>
  </section>
  
</template>

<style type="text/css">
.tg-button{
  min-width: 120px;
  max-width: 200px;
}

.contenedor__tg-button{
  width: 100%;
}

/* ::-webkit-scrollbar{
  background-color: #DADADA;
  width: 7px;
  height: 6px;
}

::-webkit-scrollbar-thumb{
  background-color: #4BBFFC;
  border-radius: 10px;
} */
</style>