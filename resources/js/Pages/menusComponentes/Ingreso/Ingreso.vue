<script>
// componentes
import AppLayout from "@/Layouts/AppLayout.vue";
import GraficaIngreso from "./GraficaIngreso.vue";
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
    GraficaIngreso,
  },
  props: {
    ingresos: Array,
    admisiones: Array,
    datosCarrerasFiltro: Array,
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
    hideDialog() {
      this.productDialog = false;
      this.submitted = false;
    },
    registrarAdmision() {
      this.submitted = true; // esto es para que se muestre el mensaje de error en el formulario
      // validar los campos del formulario, que no esten vacios y si estan mandar un mensaje y no enviar el formulario, los campos son: carrerasModel, aspirantes, examinados, noAdmitidos y selectedPeriodo
      if (
        this.carreras == null ||
        this.aspirantes == 0 ||
        this.examinados == 0 ||
        this.noAdmitidos == 0 ||
        this.periodos == null
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
          carreras: this.carreras,
          aspirantes: this.aspirantes,
          examinados: this.examinados,
          noAdmitidos: this.noAdmitidos,
          periodos: this.periodos,
        };
        this.$inertia.post("/registro-Admision", data, {
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
    editarAdmision() {
      // editarl usando el dialog de editar producto
      this.submitted = true; // esto es para que se muestre el mensaje de error en el formulario
      // validar los campos del formulario, que no esten vacios y si estan mandar un mensaje y no enviar el formulario, los campos son: carrerasModel, aspirantes, examinados, noAdmitidos y selectedPeriodo
      if (
        this.product.id == 0 ||
        this.product.carrera == null ||
        this.product.aspirantes == 0 ||
        this.product.examinados == 0 ||
        this.product.no_admitidos == 0 ||
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
          aspirantes: this.product.aspirantes,
          examinados: this.product.examinados,
          no_admitidos: this.product.no_admitidos,
          periodo: this.product.periodo,
        };
        this.$inertia.post(`/editar-Admision/${this.product.id}`, data, {
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
      this.$inertia.post(`/eliminar-Admision/${this.product.id}`, data2, {
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
      this.$inertia.post("/eliminar-Admisiones", data, {
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
          // si el archivo no tiene las columnas 'carrera', 'aspirantes', 'examinados', 'no admitidos' y 'periodo' no se sube y mandar un mensaje de error
          if (
            this.columnasExcel[1] != "Carrera" ||
            this.columnasExcel[2] != "Aspirantes" ||
            this.columnasExcel[3] != "Examinados" ||
            this.columnasExcel[4] != "No Admitidos" ||
            this.columnasExcel[5] != "Periodo"
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
          aspirantes: this.datosExcel[i][2],
          examinados: this.datosExcel[i][3],
          no_admitidos: this.datosExcel[i][4],
          periodo: this.datosExcel[i][5],
        })
      }

      const data = {
        datos: datosInsertar,
      };

      this.$inertia.post("/importar-excel-admisiones", data, {
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
        carrera: { value: null, matchMode: FilterMatchMode.IN },
        periodo: { value: null, matchMode: FilterMatchMode.IN },
        globlal: { value: null, matchMode: FilterMatchMode.CONTAINS },
      },
      datosFiltrados: [],
      datosExcel: [],
      columnasExcel: [],
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

      periodosLista: [
        { name: "SEP-DIC " + new Date().getFullYear(), code: "SEP-DIC" + new Date().getFullYear() },
        { name: "ENE-MAR " + new Date().getFullYear(), code: "ENE-MAR" + new Date().getFullYear() },
        { name: "ABR-JUN " + new Date().getFullYear(), code: "ABR-JUN" + new Date().getFullYear() },
        { name: "JUL-SEP " + new Date().getFullYear(), code: "JUL-SEP" + new Date().getFullYear() },
      ],
      columnasPreviewExcel: [
        { name: "ID", code: "0" },
        { name: "Carrera", code: "1" },
        { name: "Aspirantes", code: "2" },
        { name: "Examinados", code: "3" },
        { name: "No Admitidos", code: "4" },
        { name: "Periodo", code: "5" },
      ],
      carreras: null,
      periodos: null,
      aspirantes: 0,
      examinados: 0,
      noAdmitidos: 0,
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
      <form @submit.prevent="registrarAdmision">
        <!-- select con opciones -->
        <Dropdown v-model="carreras" :options="carrerasLista" optionLabel="name" optionValue="code" :filter="true"
          placeholder="Carrera..." />

        <div class="field col-12 md:col-3">
          <label for="minmax">Aspirantes</label>
          <InputNumber inputId="minmax" v-model="aspirantes" mode="decimal" :min="0" :max="10000" :showButtons="true" />
        </div>

        <div class="field col-12 md:col-3">
          <label for="minmax">Examinados</label>
          <InputNumber inputId="minmax" v-model="examinados" mode="decimal" :min="0" :max="10000" :showButtons="true" />
        </div>

        <div class="field col-12 md:col-3">
          <label for="minmax">No Admitidos</label>
          <InputNumber inputId="minmax" v-model="noAdmitidos" mode="decimal" :min="0" :max="10000" :showButtons="true" />
        </div>

        <div class="field col-12 md:col-3 mt-3">
          <Dropdown v-model="periodos" :options="periodosLista" optionLabel="name" optionValue="code"
            placeholder="Periodo" />
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
          <MultiSelect v-model="filters.carrera.value" :options="carrerasLista" optionLabel="name" optionValue="code"
            placeholder="Carrera" display="chip" @change="filtroCarreras($event)" />

          <MultiSelect v-model="filters.periodo.value" :options="periodosLista" optionLabel="name" optionValue="code"
            placeholder="Periodo" display="chip" />

          <Button icon="pi pi-times" label="Limpiar" @click="limpiarFiltros()" />
        </div>
      </div>
   
      <DataTable exportFilename="Admisiones" :value="ingresos" :paginator="true"  class="p-datatable-customers" :rows="7"
        ref="dt" v-model:filters="filters" v-model:selection="selectedProducts" :emptyMessage="noDataMessage" stripedRows
        sortMode="multiple" removableSort 
        >

        <Column selectionMode="multiple" style="width: 3rem" :exportable="false"></Column>

        <Column field="id" header="ID" :sortable="true" hidden></Column>
        <Column field="carrera" header="Carrera" :sortable="true"></Column>
        <Column field="aspirantes" header="Aspirantes" :sortable="true"></Column>
        <Column field="examinados" header="Examinados" :sortable="true"></Column>
        <Column field="no_admitidos" header="No Admitidos" :sortable="true"></Column>
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
          <GraficaIngreso :data="selectedProducts" />
        </div>
        <template #footer>
          <Button label="Cerrar" icon="pi pi-check" @click="closeResponsive" autofocus />
          <!-- boton para guardar la grafica como img -->
          <Button label="Guardar" icon="pi pi-save" @click="saveImage" />
        </template>
      </Dialog>

      <!-- Dialog para editar el producto toma los valores del producto seleccionado -->
      <Dialog header="Editar Admision" v-model:visible="editDialog" :breakpoints="{ '960px': '75vw', '75vw': '85vw' }"
        :style="{ width: '25vw' }" :modal="true" :closable="true" :dismissableMask="false">
        <div class="p-fluid p-formgrid p-grid">
          <form @submit.prevent="editarAdmision">
            <InputText id="id" v-model.trim="product.id" hidden />

            <div class="p-field p-col-12 p-md-6">
              <label for="carrera">Carrera</label>
              <InputText id="name" v-model.trim="product.carrera" />
            </div>
            <div class="p-field p-col-12 p-md-6">
              <label for="aspirantes">Aspirantes</label>
              <InputText id="name" v-model.trim="product.aspirantes" />
            </div>
            <div class="p-field p-col-12 p-md-6">
              <label for="examinados">Examinados</label>
              <InputText inputId="minmax" v-model.trim="product.examinados" mode="decimal" :min="0" :max="10000"
                :showButtons="true" />
            </div>
            <div class="p-field p-col-12 p-md-6">
              <label for="no_admitidos">No Admitidos</label>
              <InputText inputId="minmax" v-model.trim="product.no_admitidos" mode="decimal" :min="0" :max="10000"
                :showButtons="true" />
            </div>
            <div class="p-field p-col-12 p-md-6">
              <label for="periodo">Periodo</label>
              <InputText id="name" v-model.trim="product.periodo" required="true" />
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