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
    ingresos: Array,
  },
  setup() {},
  methods: {
    filtrarCarreras() {
      // filtar del arreglo ingresos.carrera, todos los que se repiten
      // y retornar un arreglo con los nombres de las carreras sin repetir
      const carreras = this.ingresos.map((item) => item.carrera);
      const carrerasFiltradas = [...new Set(carreras)];
      return carrerasFiltradas;
    },
    filtrarProcesos() {
      // filtar del arreglo ingresos.carrera, todos los que se repiten
      // y retornar un arreglo con los nombres de las carreras sin repetir
      const procesos = this.ingresos.map((item) => item.Proceso);
      const procesosFiltradas = [...new Set(procesos)];
      return procesosFiltradas;
    },
    filtrarFecha() {
      // filtar del arreglo ingresos.carrera, todos los que se repiten
      // y retornar un arreglo con los nombres de las carreras sin repetir
      const fechas = this.ingresos.map((item) => item.fecha);
      const fechasFiltradas = [...new Set(fechas)];
      return fechasFiltradas;
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
    saveProduct() {
      this.submitted = true; // esto es para que se muestre el mensaje de error en el formulario

      // validar los campos del formulario, que no esten vacios y si estan mandar un mensaje y no enviar el formulario, los campos son: carrerasModel, aspirantes, examinados, noAdmitidos y selectedPeriodo
      if (
        this.carrerasModel == null ||
        this.aspirantes == null ||
        this.examinados == null ||
        this.noAdmitidos == null ||
        this.selectedPeriodo == null
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
        // en
      }

      

      this.$toast.add({
        severity: "success",
        summary: "Successful",
        detail: "Product Updated",
        life: 3000,
      });
      this.productDialog = false;
    },
  },
  data() {
    return {
      filters: {
        carrera: { value: null, matchMode: FilterMatchMode.IN },
        Proceso: { value: null, matchMode: FilterMatchMode.IN },
        fecha: { value: null, matchMode: FilterMatchMode.IN },
      },
      noDataMessage: "No se encontraron datos",
      displayResponsive: false,
      productDialog: false,
      carreras: [
        { name: "Manufactura", code: "NY" },
        { name: "Mecatronica", code: "RM" },
        { name: "Negocios", code: "LDN" },
        { name: "Procesos", code: "IST" },
        { name: "Pymes", code: "PRS" },
        { name: "Sistemas", code: "PRS" },
        { name: "Telematica", code: "PRS" },
      ],
      periodos: [{ name: "SEP-DIC", code: "NY" }],
      carrerasModel: null,
      selectedPeriodo: null,
      aspirantes: 0,
      examinados: 0,
      noAdmitidos: 0,

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
        class="p-button-success mr-2"
        @click="openNew"
      />
      <!-- <Button label="Delete" icon="pi pi-trash" class="p-button-danger" @click="confirmDeleteSelected"
            :disabled="!selectedProducts || !selectedProducts.length" /> -->
    </template>
  </Toolbar>

  <Dialog
    v-model:visible="productDialog"
    :style="{ width: '450px' }"
    header="Nuevo Registro"
    :modal="true"
    class="p-fluid"
  >
    <div class="field">
      <!-- select con opciones -->
      <Dropdown
        v-model="carrerasModel"
        :options="carreras"
        optionLabel="name"
        optionValue="name"
        placeholder="Carrera..."
        :name="carreras"
      />
      <div class="field col-12 md:col-3">
        <label for="minmax">Aspirantes</label>
        <InputNumber
          inputId="minmax"
          v-model="aspirantes"
          mode="decimal"
          :min="0"
          :max="10000"
          :showButtons="true"
          :name="aspirantes"
        />
      </div>

      <div class="field col-12 md:col-3">
        <label for="minmax">Examinados</label>
        <InputNumber
          inputId="minmax"
          v-model="examinados"
          mode="decimal"
          :min="0"
          :max="10000"
          :showButtons="true"
          :name="examinados"
        />
      </div>

      <div class="field col-12 md:col-3">
        <label for="minmax">No Admitidos</label>
        <InputNumber
          inputId="minmax"
          v-model="noAdmitidos"
          mode="decimal"
          :min="0"
          :max="10000"
          :showButtons="true"
          :name="noAdmitidos"
        />
      </div>

      <div class="field col-12 md:col-3 mt-3">
        <Dropdown
          v-model="selectedPeriodo"
          :options="periodos"
          optionLabel="name"
          optionValue="name"
          placeholder="Periodo"
          :name="periodos"
        />
      </div>
    </div>

    <template #footer>
      <Button
        label="Cancel"
        icon="pi pi-times"
        class="p-button-text"
        @click="hideDialog"
      />
      <Button
        label="Save"
        icon="pi pi-check"
        class="p-button-text"
        @click="saveProduct"
      />
    </template>
  </Dialog>

  <section class="bg-white" id="tablaIngreso">
    <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8 p-[20px]">
      <div class="text-center mb-5">
        <div class="flex gap-5 justify-center flex-wrap">
          <div>
            <Toast />
            <!-- <ConfirmDialog group="templating"> 
              <template #message="slotProps">
                <div class="flex p-4">
                  <i :class="slotProps.message.icon" style="font-size: 1.5rem"></i>
                  <p class="pl-2">{{ slotProps.message.message }}</p>
                </div>
              </template>
            </ConfirmDialog>
            <ConfirmDialog group="positionDialog"></ConfirmDialog>  -->
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
              <GraficaIngreso :ingresos="ingresos" />
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
        :value="ingresos"
        :paginator="true"
        class="p-datatable-customers"
        :rows="7"
        ref="dt"
        v-model:filters="filters"
        :emptyMessage="noDataMessage"
        stripedRows
        sortMode="multiple"
        removableSort
      >
        <Column field="carrera" header="Carrera" :sortable="true"></Column>
        <Column
          field="aspirantes"
          header="Aspirantes"
          :sortable="true"
        ></Column>
        <Column
          field="examinados"
          header="Examinados"
          :sortable="true"
        ></Column>
        <Column
          field="no_admitidos"
          header="No Admitidos"
          :sortable="true"
        ></Column>
        <Column field="periodo" header="Periodo" :sortable="true"></Column>

        <!-- mensaje de no hay datos -->
        <template #empty>
          <div class="flex justify-center align-middle text-xl">
            <h2>No se encontraron datos</h2>
          </div>
        </template>
      </DataTable>
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
</style>
