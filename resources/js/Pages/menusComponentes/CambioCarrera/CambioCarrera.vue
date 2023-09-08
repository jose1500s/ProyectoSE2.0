<script>
// componentes
import AppLayout from "@/Layouts/AppLayout.vue";
import GraficaCambioCarrera from "@/Pages/menusComponentes/CambioCarrera/GraficaCambioCarrera.vue";
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
    Toast,
    ConfirmDialog,
    Toolbar,
    Dropdown,
    InputNumber,
    GraficaCambioCarrera,
  },
  props: {
    dataCambioCarreras: Array,
  },
  methods: {
    filtrarCarreras() {
      const carreras = [
        "Negocios",
        "Administracion",
        "Sistemas",
        "Automotriz",
        "Mecatronica",
        "Manufactura",
        "Telematica",
      ];
      return carreras;
    },
    filtrarProcesos() {
      // filtar del arreglo ingresos.carrera, todos los que se repiten
      // y retornar un arreglo con los nombres de las carreras sin repetir
      // const procesos = this.ingresos.map((item) => item.Proceso);
      // const procesosFiltradas = [...new Set(procesos)];
      // estaticos:
      const procesos = ["1er Proceso", "2do Proceso", "3er Proceso"];
      return procesos;
    },
    filtrarFecha() {
      // filtar del arreglo ingresos.carrera, todos los que se repiten
      // y retornar un arreglo con los nombres de las carreras sin repetir
      // const fechas = this.ingresos.map((item) => item.fecha);
      // const fechasFiltradas = [...new Set(fechas)];
      const fechas = ["SEP-DIC"];
      return fechas;
    },
    exportCSV() {
      this.$refs.dt.exportCSV();
    },
    limpiarFiltros() {
      // limpia/eliminar los filtros realizados en la  tabla y volver a mostrar todos los datos
      this.filters.carrera_actual.value = null;
      this.filters.carrera_nueva.value = null;
      this.filters.periodo.value = null;
      this.filters.year.value = 0;
      this.filters.matricula.value = null;
      this.filters.grupo.value = null;
      this.$refs.dt.filter(this.filters, "carrera");
      this.$refs.dt.filter(this.filters, "Proceso");
      this.$refs.dt.filter(this.filters, "year");
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
      link.download = "GraficaCambioCarrera.png";
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
    registrarCambioCarrera() {
      this.submitted = true; // esto es para que se muestre el mensaje de error en el formulario

      //verifica que no se pueda registrar si el la matricula ya esta registrada
      if (this.dataCambioCarreras.length > 0) {
        for (let i = 0; i < this.dataCambioCarreras.length; i++) {
          if (
            this.dataCambioCarreras[i].matricula == this.matriculas
          ) {
            this.$toast.add({
              severity: "error",
              summary: "Error",
              detail: "Ya existe un registro con la matricula",
              life: 3000,
            });
            return false;
          }
        }
      }
      //verificar que la carrera_actual y la carrera_nueva no sean la misma
      if (this.carrera_actual == this.carrera_nueva) {
        this.$toast.add({
          severity: "error",
          summary: "Error",
          detail: "La carrera actual y la carrera nueva no pueden ser la misma",
          life: 3000,
        });
        return false;
      }

      if (this.carrera_nueva == null) {
        //se le de un valor por defecto a carrera_nueva
        this.carrera_nueva = "Pendiente";
      }

      if (
        this.periodos == null ||
        this.year == 0 ||
        this.nombres == null ||
        this.matriculas == null ||
        this.carrera_actual == null ||
        this.carrera_nueva == null ||
        this.dictamen == null ||
        this.grupos == null ||
        this.carga_kardex == null
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
          nombres: this.nombres,
          matriculas: this.matriculas,
          carrera_actual: this.carrera_actual,
          carrera_nueva: this.carrera_nueva,
          dictamen: this.dictamen,
          carga_kardex: this.carga_kardex,
          grupos: this.grupos,
          periodos: this.periodos,
          year: this.year,
        };
        this.$inertia.post("/registro-cambio-carrera", data, {
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => {
            this.productDialog = false;
            this.nombres = null;
            this.matriculas = null;
            this.carrera_actual = null;
            this.carrera_nueva = null;
            this.dictamen = null;
            this.carga_kardex = null;
            this.grupos = null;
            this.periodos = null;
            this.year = 0;
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
    editarCambioCarrera() {
      // editarl usando el dialog de editar producto
      this.submitted = true; // esto es para que se muestre el mensaje de error en el formulario
      //verifica que no se pueda editar si la matricula ya esta registrada
      if (this.Amatricula != this.product.matricula){
        for (let i = 0; i < this.dataCambioCarreras.length; i++) {
          if (
            this.dataCambioCarreras[i].matricula == this.product.matricula
          ) {
            this.$toast.add({
              severity: "error",
              summary: "Error",
              detail: "Ya existe un registro con la matricula",
              life: 3000,
            });
            return false;
          }
        }
      }


      //verificar que la carrera_actual y la carrera_nueva no sean la misma
      if (this.Ecarrera_actual == this.Ecarrera_nueva) {
        this.$toast.add({
          severity: "error",
          summary: "Error",
          detail: "La carrera actual y la carrera nueva no pueden ser la misma",
          life: 3000,
        });
        return false;
      }

      if (
        this.product.id == 0 ||
        this.Eperiodo == null ||
        this.Eyear == 0 ||
        this.product.nombre == null ||
        this.product.matricula == null ||
        this.Ecarrera_actual == null ||
        this.Ecarrera_nueva == null ||
        this.Edictamen == null ||
        this.product.grupo == null ||
        this.Ecarga_kardex == null
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
          nombres: this.product.nombre,
          matricula: this.product.matricula,
          carrera_actual: this.Ecarrera_actual,
          carrera_nueva: this.Ecarrera_nueva,
          dictamen: this.Edictamen,
          carga_kardex: this.Ecarga_kardex,
          grupos: this.product.grupo,
          periodo: this.Eperiodo,
          year: this.Eyear,

        };
        this.$inertia.post(`/editar-cambio-carrera/${this.product.id}`, data, {
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => {
            this.editDialog = false;
            this.product = {};
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
      this.Eperiodo = product.periodo;
      this.Eyear = product.year;
      this.Ecarrera_actual = product.carrera_actual;
      this.Ecarrera_nueva = product.carrera_nueva;
      this.Edictamen = product.dictamen;
      this.Ecarga_kardex = product.carga_kardex;
      this.Amatricula = product.matricula;
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
      this.$inertia.post(`/eliminar-cambio-carrera/${this.product.id}`, data2, {
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
      this.$inertia.post("/eliminar-cambios-carrera", data, {
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
    openImportExcel() {
      this.importExcelDialog = true;
      // cada que se abra se resetea el valor del array de datosExcel para que no se repitan los datos
      this.datosExcel = [];
    },
    filtroCarreras() {
      let data = {
        carrera: this.filters.carrera.value,
      };
      axios
        .post("/obtener-filtro-carreras-admision", data)
        .then((response) => {
          this.datosFiltrados = response.data.datosCarrerasFiltro;
          this.admisionesTodosLosRegistros = response.data.admisiones;
          // Aquí puedes realizar otras operaciones con los datos recibidos
        })
        .catch((error) => {
          console.log(error);
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

          if (
            this.columnasExcel[1] != "Periodo" ||
            this.columnasExcel[2] != "Año" ||
            this.columnasExcel[3] != "Nombre" ||
            this.columnasExcel[4] != "Matricula" ||
            this.columnasExcel[5] != "Carrera Antigua" ||
            this.columnasExcel[6] != "Carrera Nueva" ||
            this.columnasExcel[7] != "Dictamen" ||
            this.columnasExcel[8] != "Grupo" ||
            this.columnasExcel[9] != "Carga Kardex"
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


      //Verificar que no se pueda importar si el la matricula ya esta registrada
      for (let i = 0; i < this.datosExcel.length; i++) {
        for (let j = 0; j < this.dataCambioCarreras.length; j++) {
          if (
            this.datosExcel[i][4] == this.dataCambioCarreras[j].matricula
          ) {
            //Guarda todos los registros del excel en un array donde la matricula ya esta registrada
            this.datosMostrar.push(this.dataCambioCarreras[j].matricula + " " );
            this.datosMostrarStatus = true;
          }
        }
      }

      if (this.datosMostrarStatus) {
        this.$toast.add({
          severity: "error",
          summary: "Error",
          detail: "Ya existen registros con la misma matricula " + this.datosMostrar,
          life: 5000,
        });
        this.datosMostrar = [];
        this.datosMostrarStatus = false;
        return false;
      }

      const datosInsertar = []
      for (let i = 0; i < this.datosExcel.length; i++) {
        datosInsertar.push({
          periodo: this.datosExcel[i][1],
          year: this.datosExcel[i][2],
          nombre: this.datosExcel[i][3],
          matricula: this.datosExcel[i][4],
          carrera_actual: this.datosExcel[i][5],
          carrera_nueva: this.datosExcel[i][6],
          dictamen: this.datosExcel[i][7],
          grupo: this.datosExcel[i][8],
          carga_kardex: this.datosExcel[i][9],
        });
      }

      const data = {
        datos: datosInsertar,
      };

      this.$inertia.post("/importar-excel-cambio-carrera", data, {
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
  mounted() { },
  data() {
    return {
      filters: {
        carrera_actual: { value: null, matchMode: FilterMatchMode.IN },
        carrera_nueva: { value: null, matchMode: FilterMatchMode.IN },
        periodo: { value: null, matchMode: FilterMatchMode.IN },
        year: { value: null, matchMode: FilterMatchMode.CONTAINS },
        matricula: { value: null, matchMode: FilterMatchMode.CONTAINS },
        grupo: { value: null, matchMode: FilterMatchMode.CONTAINS },
        globlal: { value: null, matchMode: FilterMatchMode.CONTAINS },
      },
      datosFiltrados: [],
      datosExcel: [],
      columnasExcel: [],
      datosMostrar: [],
      datosMostrarStatus: false,
      admisionesTodosLosRegistros: [],
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

      carrerasLista2: [
        { name: "Manufactura", code: "Manufactura" },
        { name: "Mecatronica", code: "Mecatronica" },
        { name: "Negocios", code: "Negocios" },
        { name: "Procesos", code: "Procesos" },
        { name: "Pymes", code: "Pymes" },
        { name: "Sistemas", code: "Sistemas" },
        { name: "Telematica", code: "Telematica" },
        { name: "Pendiente", code: "Pendiente"}
      ],

      periodosLista: [
        { name: "SEP-DIC ", code: "SEP-DIC" },
        { name: "ENE-ABR ", code: "ENE-ABR" },
        { name: "MAY-AGO ", code: "MAY-AGO" },
      ],
      yearLista: [
        { name: new Date().getFullYear() - 5, code: new Date().getFullYear() - 5 },
        { name: new Date().getFullYear() - 4, code: new Date().getFullYear() - 4 },
        { name: new Date().getFullYear() - 3, code: new Date().getFullYear() - 3 },
        { name: new Date().getFullYear() - 2, code: new Date().getFullYear() - 2 },
        { name: new Date().getFullYear() - 1, code: new Date().getFullYear() - 1 },
        { name: new Date().getFullYear(), code: new Date().getFullYear() },
        { name: new Date().getFullYear() + 1, code: new Date().getFullYear() + 1 },
        { name: new Date().getFullYear() + 2, code: new Date().getFullYear() + 2 },
        { name: new Date().getFullYear() + 3, code: new Date().getFullYear() + 3 },
        { name: new Date().getFullYear() + 4, code: new Date().getFullYear() + 4 },
        { name: new Date().getFullYear() + 5, code: new Date().getFullYear() + 5 },
      ],
      columnasPreviewExcel: [
        { name: "ID", code: "0" },
        { name: "Periodo", code: "1" },
        { name: "Año", code: "2" },
        { name: "Nombre", code: "3" },
        { name: "Matricula", code: "4" },
        { name: "Carrera Antigua", code: "5" },
        { name: "Carrera Nueva", code: "6" },
        { name: "Dictamen", code: "7" },
        { name: "Grupo", code: "8" },
        { name: "Carga Kardex", code: "9" },
      ],
      carga_kardex_lista: [
        { name: "EQUIVALENCIA CARGAGA", code: "EQUIVALENCIA CARGAGA" },
        { name: "HABLAR A TICS", code: "HABLAR A TICS" },
        { name: "PENDIENTE", code: "PENDIENTE" },
      ],
      dictamen_lista: [
        { name: "APROBADO", code: "APROBADO" },
        { name: "RECHAZADO", code: "RECHAZADO" },
        { name: "PENDIENTE", code: "PENDIENTE" },
      ],
      nombres: null,
      carrera_actual: null,
      carrera_nueva: null,
      dictamen: null,
      carga_kardex: null,
      grupos: null,
      periodos: null,
      matriculas: null,
      year: 0,
      productDialog: false,
      editDialog: false,
      deleteProductDialog: false,
      selectedProducts: null,
      deleteProductsDialog: false,
      importExcelDialog: false,
      wrongFormatExcel: false,
      file: null,
      fileContent: null,
      selectedProductsForChart: null,
      Eperiodo: null,
      Eyear: null,
      Ecarrera_actual: null,
      Ecarrera_nueva: null,
      Edictamen: null,
      Ecarga_kardex : null,
      Amatricula: null,
    };
  },
};
</script>

<template>
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

  <Dialog v-model:visible="productDialog" :breakpoits="{ '960px': '75vw', '640px': '85vw' }" :style="{ width: '25vw' }"
    header="Nuevo Registro" :modal="true" class="p-fluid">
    <div class="field">
      <form @submit.prevent="registrarCambioCarrera">
        <!-- select con opciones -->
        <div class="field col-12 md:col-3 mt-3">
          <label for="minmax">Periodo</label>
          <Dropdown v-model="periodos" :options="periodosLista" optionLabel="name" optionValue="code"
            placeholder="Periodo" />
        </div>

        <div class="field col-12 md:col-3 mt-3">
          <label for="minmax">Año</label>
          <Dropdown v-model="year" :options="yearLista" optionLabel="name" optionValue="code" placeholder="Año" />
        </div>

        <div class="field col-12 md:col-3 mt-3">
          <label for="minmax">Nombre</label>
          <InputText id="name" v-model.trim="nombres" />
        </div>

        <div class="field col-12 md:col-3 mt-3">
          <label for="minmax">Matricula</label>
          <InputText id="name" v-model.trim="matriculas" />
        </div>

        <div class="field col-12 md:col-3 mt-3">
          <label for="minmax">Carrera Actual</label>
          <Dropdown v-model="carrera_actual" :options="carrerasLista" optionLabel="name" optionValue="code" :filter="true"
            placeholder="Carrera..." />
        </div>

        <div class="field col-12 md:col-3 mt-3">
          <label for="minmax">Carrera A la que se cambia</label>
          <Dropdown v-model="carrera_nueva" :options="carrerasLista" optionLabel="name" optionValue="code" :filter="true"
            placeholder="Pendiente..." />
        </div>
        <div class="field col-12 md:col-3 mt-3">
          <label for="minmax">Dictamen</label>
          <Dropdown v-model="dictamen" :options="dictamen_lista" optionLabel="name" optionValue="code" :filter="true"
            placeholder="Dictamen..." />
        </div>
        <div class="field col-12 md:col-3 mt-3">
          <label for="minmax">Grupo</label>
          <InputText id="name" v-model.trim="grupos" />
        </div>
        <div class="field col-12 md:col-3 mt-3">
          <label for="minmax">Carga de kardex</label>
          <Dropdown v-model="carga_kardex" :options="carga_kardex_lista" optionLabel="name" optionValue="code"
            :filter="true" placeholder="Carga Kardex..." />
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
  <section class="bg-white" id="tablaIngreso">
    <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8 p-[20px]">
      <div class="text-center mb-5">
        <div class="flex gap-5 justify-center flex-wrap">
          <div>
            <Toast />
          </div>
          <!-- model para abrir grafica -->
          <Button label="Grafica" icon="pi pi-chart-bar" @click="openResponsive" />

          <!-- Filtros -->
          <MultiSelect v-model="filters.carrera_actual.value" :options="carrerasLista" optionLabel="name"
            optionValue="code" placeholder="Carrera Antigua" display="chip" @change="filtroCarreras($event)" />

          <MultiSelect v-model="filters.carrera_nueva.value" :options="carrerasLista2" optionLabel="name" optionValue="code"
            placeholder="Carrera Nueva" display="chip" @change="filtroCarreras($event)" />

          <MultiSelect v-model="filters.periodo.value" :options="periodosLista" optionLabel="name" optionValue="code"
            placeholder="Periodo" display="chip" />

          <MultiSelect v-model="filters.year.value" :options="yearLista" optionLabel="name" optionValue="code"
            placeholder="Año" display="chip" />

          <InputText v-model="filters.matricula.value" placeholder="Matricula" class="w-40" />

          <Button icon="pi pi-times" label="Limpiar" @click="limpiarFiltros()" />
        </div>
      </div>

      <DataTable exportFilename="Cambio De Carrera" :value="dataCambioCarreras" :paginator="true" class="p-datatable-customers"
        :rows="7" ref="dt" v-model:filters="filters" v-model:selection="selectedProducts" :emptyMessage="noDataMessage"
        stripedRows sortMode="multiple" removableSort>

        <Column selectionMode="multiple" style="width: 3rem" :exportable="false"></Column>

        <Column field="id" header="ID" :sortable="true" hidden></Column>
        <Column field="periodo" header="Periodo" :sortable="true"></Column>
        <Column field="year" header="Año" :sortable="true"></Column>
        <Column field="nombre" header="Nombre" :sortable="true"></Column>
        <Column field="matricula" header="Matricula" :sortable="true"></Column>
        <Column field="carrera_actual" header="Carrera Antigua" :sortable="true"></Column>
        <Column field="carrera_nueva" header="Carrera Nueva" :sortable="true"></Column>
        <Column field="dictamen" header="Dictamen" :sortable="true"></Column>
        <Column field="grupo" header="Grupo" :sortable="true"></Column>
        <Column field="carga_kardex" header="Carga Kardex" :sortable="true"></Column>
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
          <GraficaCambioCarrera :data="selectedProducts" />
        </div>
        <template #footer>
          <Button label="Cerrar" icon="pi pi-check" @click="closeResponsive" autofocus />
          <!-- boton para guardar la grafica como img -->
          <Button label="Guardar" icon="pi pi-save" @click="saveImage" />
        </template>
      </Dialog>

      <!-- Dialog para editar el producto toma los valores del producto seleccionado -->
      <Dialog header="Editar Matricula" v-model:visible="editDialog" :breakpoints="{ '960px': '75vw', '75vw': '85vw' }"
        :style="{ width: '25vw' }" :modal="true" :closable="true" :dismissableMask="false">
        <div class="p-fluid p-formgrid p-grid">
          <form @submit.prevent="editarCambioCarrera">
            <InputText id="id" v-model.trim="product.id" hidden />

            <div class="p-field p-col-12 p-md-6">
              <label for="periodo">Periodo</label>
              <Dropdown v-model="Eperiodo" :options="periodosLista" optionLabel="name" optionValue="code"
                placeholder="Periodo" />
            </div>

            <div class="p-field p-col-12 p-md-6">
              <label for="year">Año</label>
              <Dropdown v-model="Eyear" :options="yearLista" optionLabel="name" optionValue="code" placeholder="Año" />
            </div>

            <div class="p-field p-col-12 p-md-6">
              <label for="name">Nombre</label>
              <InputText id="name" v-model.trim="product.nombre" required="true" />
            </div>

            <div class="p-field p-col-12 p-md-6">
              <label for="matricula">Matricula</label>
              <InputText id="name" v-model.trim="product.matricula" required="true" />
            </div>

            <div class="p-field p-col-12 p-md-6">
              <label for="carrera_actual">Carrera Actual</label>
              <Dropdown v-model="Ecarrera_actual" :options="carrerasLista" optionLabel="name" optionValue="code"
                placeholder="Carrera..." />
            </div>

            <div class="p-field p-col-12 p-md-6">
              <label for="carrera_nueva">Carrera A la que se cambia</label>
              <Dropdown v-model="Ecarrera_nueva" :options="carrerasLista" optionLabel="name" optionValue="code"
                placeholder="Pendiente..." />
            </div>

            <div class="p-field p-col-12 p-md-6">
              <label for="dictamen">Dictamen</label>
              <Dropdown v-model="Edictamen" :options="dictamen_lista" optionLabel="name" optionValue="code"
                placeholder="Dictamen..." />
            </div>

            <div class="p-field p-col-12 p-md-6">
              <label for="grupo">Grupo</label>
              <InputText id="name" v-model.trim="product.grupo" required="true" />
            </div>

            <div class="p-field p-col-12 p-md-6">
              <label for="carga_kardex">Carga de kardex</label>
              <Dropdown v-model="Ecarga_kardex" :options="carga_kardex_lista" optionLabel="name" optionValue="code"
                placeholder="Carga Kardex..." />
            </div>


            <Button type="submit" label="Guardar" icon="pi pi-check" class="!mt-3" />
          </form>
        </div>
      </Dialog>

      <!-- Dialog para eliminar un registro -->
      <Dialog v-model:visible="deleteProductDialog" :style="{ width: '450px' }" header="Confirmar" :modal="true">
        <div class="confirmation-content flex justify-center items-center">
          <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
          <span v-if="product">¿Confirma eliminar el registro <b>{{ product.nombre }} </b> con matricula <b> {{
            product.matricula }}</b>?</span>
        </div>
        <template #footer>
          <Button label="No" icon="pi pi-times" class="p-button-text" @click="deleteProductDialog = false" />
          <Button label="Si" icon="pi pi-check" class="p-button-text" @click="deleteProduct" />
        </template>
      </Dialog>

      <!-- Dialog para eliminar el/los productos seleccionados de la tabla -->
      <Dialog v-model:visible="deleteProductsDialog" :style="{ width: '550px' }" header="Confirm" :modal="true">
        <div class="confirmation-content flex items-center justify-center">
          <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
          <span> ¿Confirma eliminar los registros seleccionados? </span>
        </div>
        <template #footer>
          <Button label="No" icon="pi pi-times" class="p-button-text" @click="deleteProductsDialog = false" />
          <Button label="Yes" icon="pi pi-check" class="p-button-text" @click="deleteSelectedProducts" />
        </template>
      </Dialog>
    </div>
  </section>
</template>

<style type="text/css" scoped>
.p-multiselect-label-container {
  max-width: 170px;
}

.p-dialog-footer {
  display: flex;
  justify-content: center;
  align-items: center;
}


#btnRegisrar {
  margin-top: 1.5rem;
  font-size: 1.1rem;
}
</style>