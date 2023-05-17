<script>
// componentes
import AppLayout from "@/Layouts/AppLayout.vue";
import GraficaIngreso from "@/Pages/menusComponentes/Ingreso/GraficaIngreso.vue";
// PrimeVue
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import InputText from "primevue/inputtext";
import Row from "primevue/row";
import Button from "primevue/button";
import { FilterMatchMode, FilterService } from "primevue/api";
import MultiSelect from "primevue/multiselect";
import Chart from "primevue/chart";
import Dialog from "primevue/dialog";
import Toast from "primevue/toast";
import ConfirmDialog from "primevue/confirmdialog";
import Toolbar from "primevue/toolbar";
import Dropdown from "primevue/dropdown";
import InputNumber from "primevue/inputnumber";
import GraficaIngresoVue from "../Ingreso/GraficaIngreso.vue";
export default {
  components: {
    AppLayout,
    DataTable,
    Column,
    InputText,
    Row,
    Button,
    MultiSelect,
    Chart,
    Dialog,
    GraficaIngreso,
    Toast,
    ConfirmDialog,
    Toolbar,
    Dropdown,
    InputNumber,
  },
  props: {
    titulados: Array,
  },
  setup() {
    //use
  },
  methods: {
    filtrarCarreras() {
      const carrera = [
        "Negocios",
        "Administracion",
        "Sistemas",
        "Automotriz",
        "Mecatronica",
        "Manufactura",
        "Telematica",
      ];
      return carrera;
    },
    //filtrar las generaciones
    filtrarGeneraciones() {
      const generacion = [
        "10",
        "11",
        "12",
        "13",
        "14",
        "15",
        "16",
        "17",
        "18",
        "19",
      ];
      return generacion;
    },
    exportCSV() {
      this.$refs.dt.exportCSV();
    },
    limpiarFiltros() {
      // limpia/eliminar los filtros realizados en la  tabla y volver a mostrar todos los datos
      this.filters.carrera.value = null;
      this.filters.generacion.value = null;
      this.$refs.dt.filter(this.filters, "Carrera");
      this.$refs.dt.filter(this.filters, "Generacion");
    },
    openResponsive() {
      this.displayResponsive = true;
    },
    closeResponsive() {
      this.displayResponsive = false;
    },
    saveImage() {
      // guardar la grafica como imagen en el escritorio
      const contenedorGrafica = document.getElementById("contenedorGrafica");
      const grafica = contenedorGrafica.getElementsByTagName("canvas")[0];
      const imagen = grafica.toDataURL("image/png");
      const link = document.createElement("a");
      link.download = "GraficaIngreso.png";
      link.href = imagen;
      link.click();
    },
    confirm1() {
      this.$confirm.require({
        message: "Are you sure you want to proceed?",
        header: "Confirmation",
        icon: "pi pi-exclamation-triangle",
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
    },
    openNew() {
      this.product = {};
      this.submitted = false;
      this.productDialog = true;
    },
    hideDialog() {
      this.productDialog = false;
      this.submitted = false;
    },
    registrarTitulacion() {
      this.submitted = true;
      if (
        this.carrera == null ||
        this.generacion == null ||
        this.total == 0 ||
        this.cedula == 0 ||
        this.cuatrimestre_egreso == null ||
        this.fecha_titulacion == null
      ) {
        // si alguno de los campos esta vacio, no enviar el formulario y mostrar un mensaje de error

        this.$toast.add({
          severity: "error",
          summary: "Error",
          detail: "Todos los campos son obligatorios",
          life: 3000,
        });
        return false;
      } else {
        const data = {
          carrera: this.carrera,
          generacion: this.generacion,
          total: this.total,
          cedula: this.cedula,
          cuatrimestre_egreso: this.cuatrimestre_egreso,
          fecha_titulacion: this.fecha_titulacion,
        };
        this.$inertia.post("/registro-Titulado", data, {
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
    editarTitulacion() {
      // editarl usando el dialog de editar producto
      this.submitted = true; // esto es para que se muestre el mensaje de error en el formulario
      // validar los campos del formulario, que no esten vacios y si estan mandar un mensaje y no enviar el formulario, los campos son: carrerasModel, aspirantes, examinados, noAdmitidos y selectedPeriodo
      if (
        this.product.id == 0 ||
        this.product.carrera == null ||
        this.product.generacion == null ||
        this.product.total == 0 ||
        this.product.cedula == 0 ||
        this.product.cuatrimestre_egreso == null ||
        this.product.fecha_titulacion == null
      ) {
        // si alguno de los campos esta vacio, no enviar el formulario y mostrar un mensaje de error
        this.$toast.add({
          severity: "error",
          summary: "Error",
          detail: "Todos los campos son obligatorios",
          life: 3000,
        });
        return false;
      } else {
        const data = {
          id: this.product.id,
          carrera: this.product.carrera,
          generacion: this.product.generacion,
          total: this.product.total,
          cedula: this.product.cedula,

          fecha_titulacion: this.product.fecha_titulacion,
        };
        this.$inertia.post(`/editar-Titulado/${this.product.id}`, data, {
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => {
            this.editDialog = false;
            this.$toast.add({
              severity: "success",
              summary: "Exito",
              detail: "Actualizado exitosamente",
              life: 3000,
            });
          },
        });
      }
    },
    editProduct(product) {
      this.product = { ...product }; // esto es para que se muestre los datos del producto en el formulario
      this.editDialog = true;
    },
    confirmDeleteProduct(product) {
      this.product = product;
      this.deleteProductDialog = true;
    },
    deleteProduct() {
      const data2 = {
        id: this.product.id,
      };
      this.$inertia.post(`/eliminar-Titulado/${this.product.id}`, data2, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          this.deleteProductDialog = false;
          this.product = {};
          this.$toast.add({
            severity: "success",
            summary: "Exito",
            detail: "Eliminado exitosamente",
            life: 3000,
          });
        },
      });
    },
    deleteSelectedProducts() {
      // tomar el id de todos los productos seleccionados
      const data = {
        id: this.selectedProducts.map((item) => item.id),
      };
      this.$inertia.post("/eliminar-Titulados", data, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          this.deleteProductsDialog = false;
          this.$toast.add({
            severity: "success",
            summary: "Exito",
            detail: "Eliminado exitosamente",
            life: 3000,
          });
        },
      });
    },
    confirmDeleteSelected() {
      this.deleteProductsDialog = true;
    },
  },
  data() {
    return {
      filters: {
        carrera: { value: null, matchMode: FilterMatchMode.IN },
        // Proceso: { value: null, matchMode: FilterMatchMode.IN },
        // periodo: { value: null, matchMode: FilterMatchMode.IN },
      },
      noDataMessage: "No se encontraron datos",
      displayResponsive: false,
      carrerasLista: [
        { name: "Manufactura", code: "Manufactura" },
        { name: "Mecatronica", code: "Mecatronica" },
        { name: "Negocios", code: "Negocios" },
        { name: "Procesos", code: "Procesos" },
        { name: "Pymes", code: "Pymes" },
        { name: "Sistemas", code: "Sistemas" },
        { name: "Telematica", code: "Telematica" },
      ],
      generacionLista: [
        { name: "10", code: "10" },
        { name: "11", code: "11" },
        { name: "12", code: "12" },
        { name: "13", code: "13" },
        { name: "14", code: "14" },
        { name: "15", code: "15" },
        { name: "16", code: "16" },
        { name: "17", code: "17" },
        { name: "18", code: "18" },
      ],
      carrera: null,
      generacion: null,
      total: 0,
      cedula: 0,
      cuatrimestre_egreso: null,
      fecha_titulacion: null,
      productDialog: false,
      editDialog: false,
      deleteProductDialog: false,
      selectedProducts: null,
      deleteProductsDialog: false,
    };
  },
};
</script>

<template>
  <Toolbar class="mb-4">
    <template #start>
      <Button
        label="Nuevo Registro"
        icon="pi pi-plus"
        class="p-button-success !mr-2"
        @click="openNew"
      />
      <Button
        label="Eliminar"
        icon="pi pi-trash"
        class="p-button-danger"
        @click="confirmDeleteSelected"
        :disabled="!selectedProducts || !selectedProducts.length"
      />
    </template>
  </Toolbar>

  <Dialog
    v-model:visible="productDialog"
    :breakpoints="{ '960px': '75vw', '640px': '85vw' }"
    :style="{ width: '25vw' }"
    header="Nuevo Registro"
    :modal="true"
    class="p-fluid"
  >
    <div class="field">
      <form @submit.prevent="registrarTitulacion">
        <!-- select con opciones -->
        <label for="minmax">Carrera</label>
        <Dropdown
          v-model="carrera"
          :options="carrerasLista"
          optionLabel="name"
          optionValue="code"
          :filter="true"
          placeholder="Selecciona..."
        />

        <div class="field col-12 md:col-3">
          <label for="minmax">Generacion</label>
          <Dropdown
            v-model="generacion"
            :options="generacionLista"
            optionLabel="name"
            optionValue="code"
            :filter="true"
            placeholder="Selecciona..."
          />
        </div>

        <div class="field col-12 md:col-3">
          <label for="minmax">Total</label>
          <InputNumber
            inputId="minmax"
            v-model="total"
            mode="decimal"
            :min="0"
            :max="10000"
            :showButtons="true"
          />
        </div>

        <!-- <div class="field col-12 md:col-3">
          <label for="minmax">Titulo electronico</label>
          <InputNumber inputId="minmax" v-model="titulo_electronico" mode="decimal" :min="0" :max="10000" :showButtons="true" />
        </div> -->

        <div class="field col-12 md:col-3">
          <label for="minmax">Cedula</label>
          <InputNumber
            inputId="minmax"
            v-model="cedula"
            mode="decimal"
            :min="0"
            :max="10000"
            :showButtons="true"
          />
        </div>

        <div class="field col-12 md:col-3">
          <label for="minmax">Cuatrimestre de egreso</label>
          <InputText v-model="cuatrimestre_egreso" />
        </div>

        <div class="field col-12 md:col-3">
          <label for="minmax">Fecha de titulacion</label>
          <InputText v-model="fecha_titulacion" />
        </div>

        <Button
          type="submit"
          id="btnRegisrar"
          class="flex items-center justify-center space-x-2 rounded-md border-2 border-blue-500 px-4 py-2 font-medium text-blue-600 transition hover:bg-blue-500 hover:text-white"
        >
          <span> Registrar </span>
          <span>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              fill="currentColor"
              class="h-6 w-6"
            >
              <path
                fill-rule="evenodd"
                d="M16.72 7.72a.75.75 0 011.06 0l3.75 3.75a.75.75 0 010 1.06l-3.75 3.75a.75.75 0 11-1.06-1.06l2.47-2.47H3a.75.75 0 010-1.5h16.19l-2.47-2.47a.75.75 0 010-1.06z"
                clip-rule="evenodd"
              />
            </svg>
          </span>
        </Button>
      </form>
    </div>
  </Dialog>

  <section class="bg-white" id="tablaTitulacion">
    <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8 p-[20px]">
      <div class="text-center mb-5">
        <div class="flex gap-5 justify-center flex-wrap">
          <div>
            <Toast />
          </div>
          <!-- model para abrir grafica -->
          <Button
            label="Grafica"
            icon="pi pi-chart-bar"
            @click="openResponsive"
          />
          <Dialog
            header="Grafica"
            v-model:visible="displayResponsive"
            :breakpoints="{ '960px': '75vw', '75vw': '90vw' }"
            :style="{ width: '70vw' }"
          >
            <!-- contenido del dialog/model desde aqui... -->
            <div class="w-full" id="contenedorGrafica">
              <GraficaIngreso :titulados="titulados" />
            </div>
            <template #footer>
              <Button
                label="Cerrar"
                icon="pi pi-check"
                @click="closeResponsive"
                autofocus
              />
              <!-- boton para guardar la grafica como img -->
              <Button label="Guardar" icon="pi pi-save" @click="saveImage" />
            </template>
          </Dialog>

          <Button
            icon="pi pi-external-link"
            label="Exportar Excel"
            @click="exportCSV($event)"
          />

          <!-- Filtros -->
          <MultiSelect
            v-model="filters.carrera.value"
            :options="filtrarCarreras()"
            placeholder="Carrera"
            display="chip"
          />

          <MultiSelect
            v-model="filters.carrera.value"
            :options="filtrarGeneraciones()"
            placeholder="Generacion"
            display="chip"
          />

          <Button
            icon="pi pi-times"
            label="Limpiar"
            @click="limpiarFiltros()"
          />
        </div>
      </div>

      <DataTable
        :value="titulados"
        :paginator="true"
        class="p-datatable-customers"
        :rows="7"
        ref="dt"
        v-model:filters="filters"
        v-model:selection="selectedProducts"
        :emptyMessage="noDataMessage"
        stripedRows
        sortMode="multiple"
        removableSort
      >
        <Column
          selectionMode="multiple"
          style="width: 3rem"
          :exportable="false"
        ></Column>

        <Column field="id" header="ID" :sortable="true" hidden></Column>
        <Column field="Carrera" header="Carrera" :sortable="true"></Column>
        <Column
          field="Generacion"
          header="Generacion"
          :sortable="true"
        ></Column>
        <Column field="Total" header="Total" :sortable="true"></Column>
        <Column field="cedula" header="Cedula" :sortable="true"></Column>
        <Column
          field="cuatrimestre_egreso"
          header="Cuatrimestre de egreso"
          :sortable="true"
        ></Column>
        <Column
          field="fecha_titulacion"
          header="Fecha de titulacion"
          :sortable="true"
        ></Column>
        <Column :exportable="false" style="min-width: 8rem" class="p-6">
          <template #body="slotProps">
            <Button
              icon="pi pi-pencil"
              class="p-button-rounded p-button-success !mr-2"
              @click="editProduct(slotProps.data)"
            />
            <Button
              icon="pi pi-trash"
              class="p-button-rounded p-button-warning"
              @click="confirmDeleteProduct(slotProps.data)"
            />
          </template>
        </Column>

        <!-- mensaje de no hay datos -->
        <template #empty>
          <div class="flex justify-center align-middle text-xl">
            <h2>No se encontraron datos</h2>
          </div>
        </template>
      </DataTable>

      <!-- Dialog para editar el producto toma los valores del producto seleccionado -->
      <Dialog
        header="Editar Titulados"
        v-model:visible="editDialog"
        :breakpoints="{ '960px': '75vw', '75vw': '85vw' }"
        :style="{ width: '25vw' }"
        :modal="true"
        :closable="true"
        :dismissableMask="false"
      >
        <div class="p-fluid p-formgrid p-grid">
          <form @submit.prevent="editarTitulacion">
            <InputText id="id" v-model.trim="product.id" hidden />
            <label for="minmax">Carrera</label>
            <Dropdown
              v-model="carrera"
              :options="carrerasLista"
              optionLabel="name"
              optionValue="code"
              :filter="true"
              placeholder="Selecciona..."
            />

            <div class="field col-12 md:col-3">
              <label for="minmax">Generacion</label>
              <Dropdown
                v-model="generacion"
                :options="generacionLista"
                optionLabel="name"
                optionValue="code"
                :filter="true"
                placeholder="Selecciona..."
              />
            </div>

            <div class="field col-12 md:col-3">
              <label for="minmax">Total</label>
              <InputNumber
                inputId="minmax"
                v-model="total"
                mode="decimal"
                :min="0"
                :max="10000"
                :showButtons="true"
              />
            </div>

            <div class="field col-12 md:col-3">
              <label for="minmax">Cedula</label>
              <InputNumber
                inputId="minmax"
                v-model="cedula"
                mode="decimal"
                :min="0"
                :max="10000"
                :showButtons="true"
              />
            </div>

            <div class="field col-12 md:col-3">
              <label for="minmax">Cuatrimestre de egreso</label>
              <InputText v-model="cuatrimestre_egreso" />
            </div>

            <div class="field col-12 md:col-3">
              <label for="minmax">Fecha de titulacion</label>
              <InputText v-model="fecha_titulacion" />
            </div>
            <Button
              type="submit"
              label="Guardar"
              icon="pi pi-check"
              class="!mt-3"
            />
          </form>
        </div>
      </Dialog>

      <!-- Dialog para eliminar un registro -->
      <Dialog
        v-model:visible="deleteProductDialog"
        :style="{ width: '450px' }"
        header="Confirmar"
        :modal="true"
      >
        <div class="confirmation-content flex justify-center items-center">
          <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
          <span v-if="product"
            >¿Confirma eliminar el registro <b>{{ product.carrera }}</b
            >?</span
          >
        </div>
        <template #footer>
          <Button
            label="No"
            icon="pi pi-times"
            class="p-button-text"
            @click="deleteProductDialog = false"
          />
          <Button
            label="Si"
            icon="pi pi-check"
            class="p-button-text"
            @click="deleteProduct"
          />
        </template>
      </Dialog>

      <!-- Dialog para eliminar el/los productos seleccionados de la tabla -->
      <Dialog
        v-model:visible="deleteProductsDialog"
        :style="{ width: '550px' }"
        header="Confirm"
        :modal="true"
      >
        <div class="confirmation-content flex items-center justify-center">
          <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
          <span> ¿Confirma eliminar los registros seleccionados? </span>
        </div>
        <template #footer>
          <Button
            label="No"
            icon="pi pi-times"
            class="p-button-text"
            @click="deleteProductsDialog = false"
          />
          <Button
            label="Yes"
            icon="pi pi-check"
            class="p-button-text"
            @click="deleteSelectedProducts"
          />
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