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
    reingresos: Array,
  },
  setup() {},
  methods: {
    filtrarCarreras() {
      // filtar del arreglo ingresos.carrera, todos los que se repiten
      // y retornar un arreglo con los nombres de las carreras sin repetir
      // const carreras = this.reingresos.map(item => item.carrera);
      // const carrerasFiltradas = [...new Set(carreras)];
      // return carrerasFiltradas;

      const carreras = [
        "Negocios",
        "Administración",
        "Sistemas",
        "Automotriz",
        "Mecatrónica",
        "Manufactura",
        "Telemática",
      ];
      return carreras;
    },
    filtrarProcesos() {
      // filtar del arreglo ingresos.carrera, todos los que se repiten
      // y retornar un arreglo con los nombres de las carreras sin repetir
      // const procesos = this.reingresos.map(item => item.Proceso);
      // const procesosFiltradas = [...new Set(procesos)];
      // return procesosFiltradas;

      const procesos = ["1er Proceso", "2do Proceso", "3er Proceso"];
      return procesos;
    },
    filtrarFecha() {
      // filtar del arreglo ingresos.carrera, todos los que se repiten
      // y retornar un arreglo con los nombres de las carreras sin repetir
      // const fechas = this.reingresos.map(item => item.fecha);
      // const fechasFiltradas = [...new Set(fechas)];
      // return fechasFiltradas;

      const fechas = ["SEP-DIC"];
      return fechas;
    },
    exportCSV() {
      this.$refs.dt.exportCSV();
    },
    limpiarFiltros() {
      // limpia/eliminar los filtros realizados en la  tabla y volver a mostrar todos los datos
      this.filters.carrera.value = null;
      this.filters.Proceso.value = null;
      this.filters.fecha.value = null;
      this.$refs.dt.filter(this.filters, "carrera");
      this.$refs.dt.filter(this.filters, "Proceso");
      this.$refs.dt.filter(this.filters, "fecha");
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
    confirmDeleteSelected() {
      this.deleteProductsDialog = true;
    },
    hideDialog() {
      this.productDialog = false;
      this.submitted = false;
    },
    editProduct(product) {
      this.product = { ...product }; // esto es para que se muestre los datos del producto en el formulario
      this.editDialog = true;
    },
    confirmDeleteProduct(product) {
      this.product = product;
      this.deleteProductDialog = true;
    },
    saveProduct() {
      this.submitted = true;

      this.$toast.add({
        severity: "success",
        summary: "Successful",
        detail: "Product Updated",
        life: 3000,
      });
      this.productDialog = false;
    },
    registrarRIngreso() {
      this.submitted = true;
      if (
        this.RIcarrera == null ||
        this.RIcuatrimestre == null ||
        this.RIgeneracion == null ||
        this.RIbajas == null ||
        this.RIperiodo == null
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
          carrera: this.RIcarrera,
          cuatrimestre: this.RIcuatrimestre,
          generacion: this.RIgeneracion,
          bajas: this.RIbajas,
          periodo: this.RIperiodo,
        };
        this.$inertia.post("/registrar-RIngresos", data, {
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
    editarRIngreso() {
      this.submitted = true;
      if (
        this.product.id == null ||
        this.product.carrera == null ||
        this.product.cuatrimestre == null ||
        this.product.generacion == null ||
        this.product.tipo_baja == null ||
        this.product.periodo == null

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
          cuatrimestre: this.product.cuatrimestre,
          generacion: this.product.generacion,
          bajas: this.product.tipo_baja,
          periodo: this.product.periodo,
          
        };
        this.$inertia.post(`/editar-RIngresos/${this.product.id}`, data, {
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => { 
            this.editDialog = false;
            this.$toast.add({
              severity: "success",
              summary: "Exito",
              detail: "Editado exitosamente",
              life: 3000,
            });
          },
        });
      }
    },
    eliminarRIngresos() {
      const data = {
        id: this.product.id,
      };
      this.$inertia.post(`/eliminar-RIngreso/${this.product.id}`, data, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          this.deleteProductDialog = false;
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
      this.$inertia.post(`/eliminar-RIngresos/${this.product.id}`, data, {
        preserveState: true,
        preserveScroll: true,

        onSuccess: () => {
          this.deleteProductsDialog = false;
          // reiniciar el arreglo de productos seleccionados para que se vuelva a desactivar el boton de eliminar
          this.selectedProducts = [];
          this.$toast.add({
            severity: "success",
            summary: "Exito",
            detail: "Eliminado exitosamente",
            life: 3000,
          });
        },
      });
    },
  },
  data() {
    return {
      filters: {
        carrera: { value: null, matchMode: FilterMatchMode.IN },
        Proceso: { value: null, matchMode: FilterMatchMode.IN },
        fecha: { value: null, matchMode: FilterMatchMode.IN },
      },
      carrerasLista: [
        { name: "Manufactura", code: "Manufactura" },
        { name: "Mecatronica", code: "Mecatronica" },
        { name: "Negocios", code: "Negocios" },
        { name: "Procesos", code: "Procesos" },
        { name: "Pymes", code: "Pymes" },
        { name: "Sistemas", code: "Sistemas" },
        { name: "Telematica", code: "Telematica" },
      ],
      sexoLista: [
        { name: "Masculino", code: "Masculino" },
        { name: "Femenino", code: "Femenino" },
      ],
      periodosLista: [{ name: "SEP-DIC", code: "SEP-DIC" }],
      procesosLista: [
        { name: "1er Proceso", code: "1er Proceso" },
        { name: "2do Proceso", code: "2do Proceso" },
        { name: "3er Proceso", code: "3er Proceso" },
      ],
      cuatrimestresLista: [
        { name: 1, code: 1 },
        { name: 2, code: 2 },
        { name: 3, code: 3 },
        { name: 4, code: 4 },
        { name: 5, code: 5 },
        { name: 6, code: 6 },
        { name: 7, code: 7 },
        { name: 8, code: 8 },
        { name: 9, code: 9 },
        { name: 10, code: 10 },
      ],
      listaBajas: [
        { name: "BT", code: "BT" },
        { name: "BV", code: "BV" },
        { name: "BAC", code: "BAC" },
        { name: "BAD", code: "BAD" },
      ],
      noDataMessage: "No se encontraron datos",
      displayResponsive: false,
      productDialog: false,
      RIcarrera: null,
      RIcuatrimestre: null,
      RIgeneracion: null,
      RIbajas: null,
      RIperiodo: null,
      editDialog: false,
      deleteProductDialog: false,
      selectedProducts: null,
      deleteProductsDialog: false,
    };
  },
};
</script>

<template>
  <!-- new button -->
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

  <section class="bg-white" id="tablaIngreso">
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
            :breakpoints="{ '960px': '75vw', '640px': '90vw' }"
            :style="{ width: '70vw' }"
          >
            <!-- contenido del dialog/model desde aqui... -->
            <div class="w-full" id="contenedorGrafica">
              <GraficaIngreso :ingresos="reingresos" />
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

          <MultiSelect
            v-model="filters.carrera.value"
            :options="filtrarCarreras()"
            placeholder="Carrera"
            display="chip"
          />

          <MultiSelect
            v-model="filters.Proceso.value"
            :options="filtrarProcesos()"
            placeholder="Proceso"
            display="chip"
          />

          <MultiSelect
            v-model="filters.fecha.value"
            :options="filtrarFecha()"
            placeholder="Fecha"
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
        :value="reingresos"
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
        <Column field="carrera" header="Carrera" :sortable="true"></Column>
        <Column
          field="cuatrimestre"
          header="Cuatrimestre"
          :sortable="true"
        ></Column>
        <Column
          field="generacion"
          header="Generacion"
          :sortable="true"
        ></Column>
        <Column
          field="tipo_baja"
          header="Tipo de baja"
          :sortable="true"
        ></Column>
        <Column field="periodo" header="Periodo" :sortable="true"></Column>
        <Column :exportable="false" style="min-width: 8rem" class="p-6">
          <template #body="slotProps">
            <Button icon="pi pi-pencil" class="p-button-rounded p-button-success !mr-2"
              @click="editProduct(slotProps.data)" />
            <Button icon="pi pi-trash" class="p-button-rounded p-button-warning"
              @click="confirmDeleteProduct(slotProps.data)" />
          </template>
        </Column>
        <!-- mensaje de no hay datos -->
        <template #empty>
          <div class="flex justify-center align-middle text-xl">
            <h2>No se encontraron datos</h2>
          </div>
        </template>
      </DataTable>

      <!-- Dialog para REGISTRAR -->
      <Dialog
        v-model:visible="productDialog"
        :style="{ width: '450px' }"
        header="Nuevo Registro"
        :modal="true"
        class="p-fluid"
      >
        <div class="field">
          <form @submit.prevent="registrarRIngreso">
            <Dropdown
              v-model="RIcarrera"
              :options="carrerasLista"
              optionLabel="name"
              optionValue="code"
              :filter="true"
              placeholder="Carrera..."
              class="!mt-3"
            />

            <Dropdown
              v-model="RIcuatrimestre"
              :options="cuatrimestresLista"
              optionLabel="name"
              optionValue="code"
              placeholder="Cuatrimestre..."
              class="!mt-3"
            />

            <div class="field col-12 md:col-3 !mt-3">
              <label for="minmax">Generacion</label>
              <InputNumber
                inputId="minmax"
                v-model="RIgeneracion"
                mode="decimal"
                :min="0"
                :max="10000"
                :showButtons="true"
              />
            </div>

            <Dropdown
              v-model="RIbajas"
              :options="listaBajas"
              optionLabel="name"
              optionValue="code"
              placeholder="Tipo de baja..."
              class="!mt-3"
            />

            <Dropdown
              v-model="RIperiodo"
              :options="periodosLista"
              optionLabel="name"
              optionValue="code"
              placeholder="Periodo..."
              class="!mt-3"
            />
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
            label="Si"
            icon="pi pi-check"
            class="p-button-text"
            @click="deleteSelectedProducts"
          />
        </template>
      </Dialog>

      <!-- Dialog para editar el producto toma los valores del producto seleccionado -->
      <Dialog header="Editar Re Ingreso" v-model:visible="editDialog" :breakpoints="{ '960px': '75vw', '75vw': '85vw' }" :style="{ width: '25vw' }" :modal="true" :closable="true" :dismissableMask="false">
        <div class="p-fluid p-formgrid p-grid">
          <form @submit.prevent="editarRIngreso">

            <InputText id="id" v-model="product.id"  />
        
            <div class="p-field p-col-12 p-md-12">
              <label for="carrera">Carrera</label>
              <InputText id="carrera" v-model="product.carrera" />
            </div>

            <div class="p-field p-col-12 p-md-12">
              <label for="carrera">Cuatrimestre</label>
              <InputText id="cuatrimestre" v-model="product.cuatrimestre" />
            </div>

            <div class="p-field p-col-12 p-md-12">
              <label for="carrera">Generacion</label>
              <InputText id="generacion" v-model="product.generacion" />
            </div>

            <div class="p-field p-col-12 p-md-12">
              <label for="carrera">Tipo de Baja</label>
              <InputText id="tipo_baja" v-model="product.tipo_baja" />
            </div>

            <div class="p-field p-col-12 p-md-12">
              <label for="carrera">Periodo</label>
              <InputText id="periodo" v-model="product.periodo" />
            </div>
            
            <Button type="submit" label="Guardar" icon="pi pi-check" class="!mt-3" />
          </form>
        </div>
      </Dialog>

      <!-- Dialog para eliminar un registro -->
      <Dialog v-model:visible="deleteProductDialog" :style="{ width: '450px' }" header="Confirmar" :modal="true">
        <div class="confirmation-content flex justify-center items-center">
          <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
          <span v-if="product">¿Confirma eliminar el registro <b>{{ product.carrera }}</b>?</span>
        </div>
        <template #footer>
          <Button label="No" icon="pi pi-times" class="p-button-text" @click="deleteProductDialog = false" />
          <Button label="Si" icon="pi pi-check" class="p-button-text" @click="eliminarRIngresos" />
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
  height: 100% !important;
}
</style>
