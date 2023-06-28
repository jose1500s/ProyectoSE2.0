<script>
// componentes
import AppLayout from "@/Layouts/AppLayout.vue";
import GraficaReingreso from "./GraficaReingreso.vue";

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
import axios from "axios";
import readXlsxFile from "read-excel-file";

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
    GraficaReingreso,
    Toast,
    ConfirmDialog,
    Toolbar,
    Dropdown,
    InputNumber,
  },
  props: {
    reingresos: Array,
  },
  setup() { },
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
    openImportExcel() {
      this.importExcelDialog = true;
      // cada que se abra se resetea el valor del array de datosExcel para que no se repitan los datos
      this.datosExcel = [];
    },
    exportCSV() {
      this.$refs.dt.exportCSV();
    },
    limpiarFiltros() {
      // limpia/eliminar los filtros realizados en la  tabla y volver a mostrar todos los datos
      this.filters.carrera.value = null;
      this.filters.proceso.value = null;
      this.filters.periodo.value = null;
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
      link.download = "GraficaReingreso.png";
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
      if(this.RIhombres == 0 && this.RImujeres == 0){
        this.$toast.add({
          severity: "error",
          summary: "Error",
          detail: "No se puede registrar un reingreso con 0 hombres y 0 mujeres, ingrese un numero de solicitudes valido en hombres y/o mujeres",
          life: 3000,
        });
        return false;
      }
      if (
        this.RIcarrera == null ||
        this.RIcuatrimestre == null ||
        this.RIgeneracion == 0 ||
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
      } else{
        const data = {
          carrera: this.RIcarrera,
          cuatrimestre: this.RIcuatrimestre,
          hombres: this.RIhombres,
          mujeres: this.RImujeres,
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
      if(this.product.hombres == 0 && this.product.mujeres == 0){
        this.$toast.add({
          severity: "error",
          summary: "Error",
          detail: "No se puede editar un reingreso con 0 hombres y 0 mujeres, ingrese un numero de solicitudes valido en hombres y/o mujeres",
          life: 3000,
        });
        return false;
      }
      if (
        this.product.id == null ||
        this.product.carrera == null ||
        this.product.cuatrimestre == null ||
        this.product.generacion == 0 ||
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
          hombres: this.product.hombres,
          mujeres: this.product.mujeres,
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
    subirExcel() {
      const input = document.getElementById("inputExcel");

      // si el archivo no es .xlsx no se sube y mandar un mensaje de error
      if (input.files[0].type != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
        this.$toast.add({
          severity: "error",
          summary: "Error",
          detail: "El archivo debe ser .xlsx",
          life: 6000,
        });
        return false;
      } else {
        readXlsxFile(input.files[0]).then((rows) => {
          //mandar a datosExcel los datos apartir de la psicion 1 del array
          this.datosExcel = rows.slice(1);
          // mandar a columnasExcel las columnas del archivo
          this.columnasExcel = rows[0];
          console.log(this.datosExcel)
          console.log(this.columnasExcel)
          // si el archivo no tiene las columnas 'carrera', 'cuatrimestre', 'hombres', 'mujeres', 'solicitudes', 'generacion', 'tipo de baja' y 'periodo' no se sube y mandar un mensaje de error
          if (
            this.columnasExcel[1] != "Carrera" ||
            this.columnasExcel[2] != "Cuatrimestre" ||
            this.columnasExcel[3] != "Hombres" ||
            this.columnasExcel[4] != "Mujeres" ||
            this.columnasExcel[5] != "Solicitudes" ||
            this.columnasExcel[6] != "Generacion" ||
            this.columnasExcel[7] != "Tipo de baja" ||
            this.columnasExcel[8] != "Periodo"

          ) {
            this.wrongFormatExcel = true;
            this.$toast.add({
              severity: "error",
              summary: "Error",
              detail: "Formato de archivo incorrecto",
              life: 5000,
            });
            return false;
          } else {
            this.wrongFormatExcel = false;
          }

        });
      }
    },
    importarExcel() {
      const datosInsertar = []
      for (let i = 0; i < this.datosExcel.length; i++) {
        datosInsertar.push({
          carrera: this.datosExcel[i][1],
          cuatrimestre: this.datosExcel[i][2],
          hombres: this.datosExcel[i][3],
          mujeres: this.datosExcel[i][4],
          solicitudes: this.datosExcel[i][5],
          generacion: this.datosExcel[i][6],
          tipo_baja: this.datosExcel[i][7],
          periodo: this.datosExcel[i][8],
        });
      }

      const data = {
        datos: datosInsertar,
      };

      this.$inertia.post("/importar-excel-reingreso", data, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          this.importExcelDialog = false;
          this.$toast.add({
            severity: "success",
            summary: "Exito",
            detail: "Importado exitosamente",
            life: 3000,
          });
        },
      });

    },
  },
  data() {
    return {
      datosExcel: [],
      columnasExcel: [],
      filters: {
        carrera: { value: null, matchMode: FilterMatchMode.IN },
        proceso: { value: null, matchMode: FilterMatchMode.IN },
        periodo: { value: null, matchMode: FilterMatchMode.IN },
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
      periodosLista: [
        { name: "SEP-DIC " + new Date().getFullYear(), code: "SEP-DIC" + new Date().getFullYear() },
        { name: "ENE-ABR " + new Date().getFullYear(), code: "ENE-MAR" + new Date().getFullYear() },
        { name: "MAY-AGO " + new Date().getFullYear(), code: "ABR-JUN" + new Date().getFullYear() },
      ],
      procesosLista: [
        { name: "1er Proceso", code: "1er Proceso" },
        { name: "2do Proceso", code: "2do Proceso" },
        { name: "3er Proceso", code: "3er Proceso" },
      ],
      periodosLista: [
        { name: "SEP-DIC " + new Date().getFullYear(), code: "SEP-DIC" + new Date().getFullYear() },
        { name: "ENE-ABR " + new Date().getFullYear(), code: "ENE-MAR" + new Date().getFullYear() },
        { name: "MAY-AGO " + new Date().getFullYear(), code: "ABR-JUN" + new Date().getFullYear() },
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
      RIgeneracion: 0,
      RIbajas: null,
      RIperiodo: null,
      RIhombres: 0,
      RImujeres: 0,
      editDialog: false,
      deleteProductDialog: false,
      selectedProducts: null,
      deleteProductsDialog: false,
      columnasPreviewExcel: [
        { name: "ID", code: "0" },
        { name: "Carrera", code: "1" },
        { name: "Cuatrimestre", code: "2" },
        { name: "Hombres", code: "3" },
        { name: "Mujeres", code: "4" },
        { name: "Solicitudes", code: "5" },
        { name: "Generacion", code: "6" },
        { name: "Tipo de baja", code: "7" },
        { name: "Periodo", code: "8" },
      ],
      importExcelDialog: false,
      wrongFormatExcel: false,
    };
  },
};
</script>

<template>
  <!-- new button -->
  <Toolbar class="mb-4">
    <template #start>
      <Button label="Nuevo Registro" icon="pi pi-plus" class="p-button-success !mr-2" @click="openNew" />
      <Button label="Eliminar" icon="pi pi-trash" class="p-button-danger" @click="confirmDeleteSelected"
        :disabled="!selectedProducts || !selectedProducts.length" />

      <Button class="!ml-3" icon="pi pi-external-link" label="Exportar Excel" @click="exportCSV($event)" />

      <!-- button dialog para importar excel-->
      <Button label="Importar Excel" icon="pi pi-upload" class="!ml-2" @click="openImportExcel" />
    </template>
  </Toolbar>

  <!-- Dialog para importar excel -->
  <Dialog v-model:visible="importExcelDialog" :breakpoints="{ '1260px': '75vw', '640px': '85vw' }"
    :style="{ width: '45vw' }" header="Importar Excel" :modal="true" class="p-fluid">


    <!-- aqui selecciona el archivo de excel -->
    <div class="border border-dashed border-gray-500 relative">
      <input type="file" id="inputExcel" @change="subirExcel" multiple
        class="cursor-pointer relative block opacity-0 w-full h-full p-20 z-50">
      <div class="text-center p-10 absolute top-0 right-0 left-0 m-auto">
        <h4>
          Arrastra y suelta el archivo aquí
          <br />ó
        </h4>
        <p class="">
          Selecciona un archivo de excel
        </p>
      </div>
    </div>

    <!-- preview del documento subido en el array datosExcel -->
    <DataTable v-if="datosExcel.length > 0" :value="datosExcel">
      <Column v-for="columna in columnasPreviewExcel" :key="columna.code" :field="columna.code" :header="columna.name" />
    </DataTable>

    <div class="max-w-[50%] m-auto p-7">
      <Button label="Importar" @click="importarExcel" id="btnImportarExcel"
        :disabled="datosExcel.length == 0 || wrongFormatExcel" />
    </div>


  </Dialog>

  <section class="bg-white" id="tablaIngreso">
    <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8 p-[20px]">
      <div class="text-center mb-5">
        <div class="flex gap-5 justify-center flex-wrap">
          <div>
            <Toast />
          </div>
          <!-- model para abrir grafica -->
          <Button label="Grafica" icon="pi pi-chart-bar" @click="openResponsive" />


          <MultiSelect v-model="filters.carrera.value" :options="carrerasLista" optionLabel="name" optionValue="code"
            placeholder="Carrera" display="chip" @change="filtroCarreras($event)" />

          <MultiSelect v-model="filters.periodo.value" :options="periodosLista" optionLabel="name" optionValue="code"
            placeholder="Periodo" display="chip" />


          <Button icon="pi pi-times" label="Limpiar" @click="limpiarFiltros()" />
        </div>
      </div>

      <DataTable exportFilename="Reingresos" :value="reingresos" :paginator="true" class="p-datatable-customers" :rows="7"
        ref="dt" v-model:filters="filters" v-model:selection="selectedProducts" :emptyMessage="noDataMessage" stripedRows
        sortMode="multiple" removableSort>
        <Column selectionMode="multiple" style="width: 3rem" :exportable="false"></Column>
        <Column field="id" header="ID" :sortable="true" hidden></Column>
        <Column field="carrera" header="Carrera" :sortable="true"></Column>
        <Column field="cuatrimestre" header="Cuatrimestre" :sortable="true"></Column>
        <Column field="hombres" header="Hombres" :sortable="true"></Column>
        <Column field="mujeres" header="Mujeres" :sortable="true"></Column>
        <Column field="solicitudes" header="Solicitudes" :sortable="true"></Column>
        <Column field="generacion" header="Generacion" :sortable="true"></Column>
        <Column field="tipo_baja" header="Tipo de baja" :sortable="true"></Column>
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

      <Dialog header="Gráfica dinámica" v-model:visible="displayResponsive"
        :breakpoints="{ '960px': '75vw', '75vw': '90vw' }" :style="{ width: '70vw' }">
        <!-- contenido del dialog/model desde aqui... -->
        <div class="w-full" id="contenedorGrafica">
          <GraficaReingreso :data="selectedProducts" />
        </div>
        <template #footer>
          <Button label="Cerrar" icon="pi pi-check" @click="closeResponsive" autofocus />
          <!-- boton para guardar la grafica como img -->
          <Button label="Guardar" icon="pi pi-save" @click="saveImage" />
        </template>
      </Dialog>

      <!-- Dialog para REGISTRAR -->
      <Dialog v-model:visible="productDialog" :style="{ width: '450px' }" header="Nuevo Registro" :modal="true"
        class="p-fluid">
        <div class="field">
          <form @submit.prevent="registrarRIngreso">
            <div class="field col-12 md:col-3 !mt-3">
              <label for="minmax">Carrera</label>
            <Dropdown v-model="RIcarrera" :options="carrerasLista" optionLabel="name" optionValue="code" :filter="true"
              placeholder="Carrera..." class="!mt-3" />
            </div>

            <div class="field col-12 md:col-3 !mt-3">
              <label for="minmax">Cuatrimestre</label>
            <Dropdown v-model="RIcuatrimestre" :options="cuatrimestresLista" optionLabel="name" optionValue="code"
              placeholder="Cuatrimestre..." class="!mt-3" />
            </div>
            
            <div class="field col-12 md:col-3">
              <label for="minmax">Hombres</label>
              <InputNumber inputId="minmax" v-model="RIhombres" mode="decimal" :min="0" :max="10000" :showButtons="true" />
            </div>

            <div class="field col-12 md:col-3">
              <label for="minmax">Mujeres</label>
              <InputNumber inputId="minmax" v-model="RImujeres" mode="decimal" :min="0" :max="10000" :showButtons="true" />
            </div>


            <div class="field col-12 md:col-3 !mt-3">
              <label for="minmax">Generacion</label>
              <InputNumber inputId="minmax" v-model="RIgeneracion" mode="decimal" :min="0" :max="10000"
                :showButtons="true" />
            </div>

            <div class="field col-12 md:col-3 !mt-3">
              <label for="minmax">Tipo de baja</label>
            <Dropdown v-model="RIbajas" :options="listaBajas" optionLabel="name" optionValue="code"
              placeholder="Tipo de baja..." class="!mt-3" />
            </div>

            <div class="field col-12 md:col-3 !mt-3">
              <label for="minmax">Periodo</label>
            <Dropdown v-model="RIperiodo" :options="periodosLista" optionLabel="name" optionValue="code"
              placeholder="Periodo..." class="!mt-3" />
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

      <!-- Dialog para eliminar el/los productos seleccionados de la tabla -->
      <Dialog v-model:visible="deleteProductsDialog" :style="{ width: '550px' }" header="Confirm" :modal="true">
        <div class="confirmation-content flex items-center justify-center">
          <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
          <span> ¿Confirma eliminar los registros seleccionados? </span>
        </div>
        <template #footer>
          <Button label="No" icon="pi pi-times" class="p-button-text" @click="deleteProductsDialog = false" />
          <Button label="Si" icon="pi pi-check" class="p-button-text" @click="deleteSelectedProducts" />
        </template>
      </Dialog>

      <!-- Dialog para editar el producto toma los valores del producto seleccionado -->
      <Dialog header="Editar Re Ingreso" v-model:visible="editDialog" :breakpoints="{ '960px': '75vw', '75vw': '85vw' }"
        :style="{ width: '25vw' }" :modal="true" :closable="true" :dismissableMask="false">
        <div class="p-fluid p-formgrid p-grid">
          <form @submit.prevent="editarRIngreso">

            <div class="p-field p-col-12 p-md-12">
              <label for="carrera">Carrera</label>
              <InputText id="carrera" v-model="product.carrera" />
            </div>

            <div class="p-field p-col-12 p-md-12">
              <label for="carrera">Cuatrimestre</label>
              <InputText id="cuatrimestre" v-model="product.cuatrimestre" />
            </div>

            <div class="p-field p-col-12 p-md-12">
              <label for="carrera">Hombres</label>
              <InputText id="hombres" v-model="product.hombres" />
            </div>

            <div class="p-field p-col-12 p-md-12">
              <label for="carrera">Mujeres</label>
              <InputText id="mujeres" v-model="product.mujeres" />
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
