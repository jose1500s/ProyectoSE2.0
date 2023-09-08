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
    // permisos: Array,
    ningresos: Array,
  },
  setup() {},
  methods: {
    filtrarCarreras() {
      // filtar del arreglo ingresos.carrera, todos los que se repiten
      // y retornar un arreglo con los nombres de las carreras sin repetir
      // const carreras = this.ningresos.map(item => item.carrera);
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
      // const procesos = this.ningresos.map(item => item.Proceso);
      // const procesosFiltradas = [...new Set(procesos)];
      // return procesosFiltradas;

      const procesos = ["1er Proceso", "2do Proceso", "3er Proceso"];
      return procesos;
    },
    filtrarFecha() {
      // filtar del arreglo ingresos.carrera, todos los que se repiten
      // y retornar un arreglo con los nombres de las carreras sin repetir
      // const fechas = this.ningresos.map(item => item.fecha);
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
    registrarNIngreso() {
<<<<<<< HEAD
      this.submitted = true; 
=======
      this.submitted = true;
      if (this.NIhombres == 0 && this.NImujeres == 0) {
        this.$toast.add({
          severity: "error",
          summary: "Error",
          detail: "No se puede registrar un reingreso con 0 hombres y 0 mujeres, ingrese un numero de solicitudes valido en hombres y/o mujeres",
          life: 3000,
        });
        return false;
      }
>>>>>>> 110d6c1665173eac4f7eaa1c4347a0e9cf341702
      if (
        this.NIcarreras == null ||
        this.totalIngresos == 0 ||
        this.NIexaminados == 0 ||
        this.NIsexo == null ||
        this.NIgeneracion == 0 ||
        this.NIadmitidos == 0 ||
        this.NIinscritos == 0 ||
        this.NIprocesos == null ||
        this.NIperiodos == null
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
          carrera: this.NIcarreras,
          totalIngresos: this.totalIngresos,
          examinados: this.NIexaminados,
          sexo: this.NIsexo,
          generacion: this.NIgeneracion,
          admitidos: this.NIadmitidos,
          inscritos: this.NIinscritos,
          procesos: this.NIprocesos,
          periodos: this.NIperiodos,
        };
        this.$inertia.post("/registro-NIngreso", data, {
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
    editarNIngreso() {
<<<<<<< HEAD
      this.submitted = true; 
=======
      this.submitted = true;
      if (this.product.hombres == 0 && this.product.mujeres == 0) {
        this.$toast.add({
          severity: "error",
          summary: "Error",
          detail: "No se puede editar un reingreso con 0 hombres y 0 mujeres, ingrese un numero de solicitudes valido en hombres y/o mujeres",
          life: 3000,
        });
        return false;
      }
>>>>>>> 110d6c1665173eac4f7eaa1c4347a0e9cf341702
      if (
        this.product.id == null ||
        this.Ecarrera == null ||
        this.product.total_ingresos == 0 ||
        this.product.sexo == 0 ||
        this.product.generacion == 0 ||
        this.product.admitidos == 0 ||
        this.product.inscritos == 0 ||
<<<<<<< HEAD
        this.product.proceso == null ||
        this.product.periodo == null
=======
        this.Eproceso == null
>>>>>>> 110d6c1665173eac4f7eaa1c4347a0e9cf341702
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
          carrera: this.Ecarrera,
          totalIngresos: this.product.total_ingresos,
          examinados: this.product.examinados,
          sexo: this.product.sexo,
          generacion: this.product.generacion,
          admitidos: this.product.admitidos,
          inscritos: this.product.inscritos,
<<<<<<< HEAD
          procesos: this.product.proceso,
          periodos: this.product.periodo,
=======
          procesos: this.Eproceso,
>>>>>>> 110d6c1665173eac4f7eaa1c4347a0e9cf341702
        };
        this.$inertia.post(`/editar-NIngreso/${this.product.id}`, data, {
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
    editProduct(product) {
      this.product = { ...product }; // esto es para que se muestre los datos del producto en el formulario
      this.Ecarrera = product.carrera;
      this.Eproceso = product.proceso;
      this.editDialog = true;
    },
    confirmDeleteProduct(product) {
      this.product = product;
      this.deleteProductDialog = true;
    },
    eliminarNIngreso() {
      const data = {
        id: this.product.id,
      };
      this.$inertia.post("/eliminar-NIngreso", data, {
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
      this.$inertia.post("/eliminar-NIngresos", data, {
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
    confirmDeleteSelected() {
      this.deleteProductsDialog = true;
    },
<<<<<<< HEAD
=======
    hasPermission(permiso) {
      return this.$page.props.user.roles[0].permissions.some(permission => permission.name === permiso);
    },
    openImportExcel() {
      this.importExcelDialog = true;
      // cada que se abra se resetea el valor del array de datosExcel para que no se repitan los datos
      this.datosExcel = [];
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
          // si el archivo no tiene las columnas 'carrera', 'total_ingresos', 'generacion', 'hombres', 'mujeres', 'inscritos', 'proceso', 'periodo
          if (
            this.columnasExcel[1] != "Carrera" ||
            this.columnasExcel[2] != "Total Ingresos" ||
            this.columnasExcel[3] != "Generacion" ||
            this.columnasExcel[4] != "Hombres" ||
            this.columnasExcel[5] != "Mujeres" ||
            this.columnasExcel[6] != "Admitidos" ||
            this.columnasExcel[7] != "Inscritos" ||
            this.columnasExcel[8] != "Proceso" ||
            this.columnasExcel[9] != "Periodo"

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
          total_ingresos: this.datosExcel[i][2],
          generacion: this.datosExcel[i][3],
          hombres: this.datosExcel[i][4],
          mujeres: this.datosExcel[i][5],
          admitidos: this.datosExcel[i][6],
          inscritos: this.datosExcel[i][7],
          proceso: this.datosExcel[i][8],
          periodo: this.datosExcel[i][9],
        });
      }

      const data = {
        datos: datosInsertar,
      };

      this.$inertia.post("/importar-excel-ningresos", data, {
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
>>>>>>> 110d6c1665173eac4f7eaa1c4347a0e9cf341702
  },
  data() {
    return {
      filters: {
        carrera: { value: null, matchMode: FilterMatchMode.IN },
        Proceso: { value: null, matchMode: FilterMatchMode.IN },
        fecha: { value: null, matchMode: FilterMatchMode.IN },
      },
<<<<<<< HEAD
=======
      datosFiltrados: [],
      datosExcel: [],
      columnasExcel: [],
>>>>>>> 110d6c1665173eac4f7eaa1c4347a0e9cf341702
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
      noDataMessage: "No se encontraron datos",
      displayResponsive: false,
      productDialog: false,
      NIcarreras: null,
      totalIngresos: 0,
      NIexaminados: 0,
      NIsexo: null,
      NIgeneracion: null,
      NIadmitidos: 0,
      NIinscritos: 0,
      NIprocesos: null,
      NIperiodos: null,
      editDialog: false,
      deleteProductDialog: false,
      selectedProducts: null,
      deleteProductsDialog: false,
<<<<<<< HEAD
=======
      importExcelDialog: false,
      Ecarrera: null,
      Eproceso: null,
      columnasPreviewExcel: [
        { name: "ID", code: "0" },
        { name: "Carrera", code: "1" },
        { name: "Total Ingresos", code: "2" },
        { name: "Generacion", code: "3" },
        { name: "Hombres", code: "4" },
        { name: "Mujeres", code: "5" },
        { name: "Admitidos", code: "6" },
        { name: "Inscritos", code: "7" },
        { name: "Proceso", code: "8" },
        { name: "Periodo", code: "9" },
      ],
      procesosLista: [
        { name: "1er Proceso", code: "1er Proceso" },
        { name: "2do Proceso", code: "2do Proceso" },
        { name: "3er Proceso", code: "3er Proceso" },
      ],
>>>>>>> 110d6c1665173eac4f7eaa1c4347a0e9cf341702
    };
  },
};
</script>

<template>
  <!-- new button -->
  <Toolbar class="mb-4">
    <template #start>
<<<<<<< HEAD
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
=======
      <Button v-if="hasPermission('registrar_ingreso')" label="Nuevo Registro" icon="pi pi-plus"
        class="p-button-success !mr-2" @click="openNew" />
      <Button v-else disabled label="Nuevo Registro" icon="pi pi-plus" class="p-button-success !mr-2" @click="openNew" />
      <Button v-if="hasPermission('eliminar_ingreso')" label="Eliminar" icon="pi pi-trash" class="p-button-danger"
        @click="confirmDeleteSelected" :disabled="!selectedProducts || !selectedProducts.length" />
      <Button v-else disabled label="Eliminar" icon="pi pi-trash" class="p-button-danger" @click="confirmDeleteSelected"
        :disabled="!selectedProducts || !selectedProducts.length" />

      <!-- button dialog para importar excel-->
      <Button label="Importar Excel" icon="pi pi-upload" class="!ml-2" @click="openImportExcel" />
>>>>>>> 110d6c1665173eac4f7eaa1c4347a0e9cf341702
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
              <GraficaIngreso :ingresos="ningresos" />
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

<<<<<<< HEAD
      <DataTable
        :value="ningresos"
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
=======
      <DataTable exportFilename="Nuevo Ingresos" :value="ningresos" :paginator="true" class="p-datatable-customers"
        :rows="7" ref="dt" v-model:filters="filters" v-model:selection="selectedProducts" :emptyMessage="noDataMessage"
        stripedRows sortMode="multiple" removableSort>
        <Column selectionMode="multiple" style="width: 3rem" :exportable="false"></Column>
>>>>>>> 110d6c1665173eac4f7eaa1c4347a0e9cf341702
        <Column field="id" header="ID" :sortable="true" hidden></Column>
        <Column field="carrera" header="Carrera" :sortable="true"></Column>
        <Column
          field="total_ingresos"
          header="Total Ingresos"
          :sortable="true"
        ></Column>
        <Column field="sexo" header="Sexo" :sortable="true"></Column>
        <Column
          field="generacion"
          header="Generacion"
          :sortable="true"
        ></Column>
        <Column field="admitidos" header="Admitidos" :sortable="true"></Column>
        <Column field="inscritos" header="Inscritos" :sortable="true"></Column>
        <Column field="proceso" header="Proceso" :sortable="true"></Column>
        <Column field="periodo" header="Periodo" :sortable="true"></Column>
        <Column :exportable="false" style="min-width: 8rem" class="p-6">
          <template #body="slotProps">
            <Button v-if="hasPermission('editar_ingreso')" icon="pi pi-pencil"
              class="p-button-rounded p-button-success !mr-2" @click="editProduct(slotProps.data)" />
            <Button v-else disabled icon="pi pi-pencil" class="p-button-rounded p-button-success !mr-2"
              @click="editProduct(slotProps.data)" />
            <Button v-if="hasPermission('eliminar_ingreso')" icon="pi pi-trash" class="p-button-rounded p-button-warning"
              @click="confirmDeleteProduct(slotProps.data)" />
            <Button v-else disabled icon="pi pi-trash" class="p-button-rounded p-button-warning"
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

      <!-- Dialog para REGISTRAR  -->
      <Dialog
        v-model:visible="productDialog"
        :breakpoints="{ '960px': '75vw', '640px': '85vw' }"
        :style="{ width: '35vw' }"
        header="Nuevo Registro"
        :modal="true"
        class="p-fluid"
      >
        <div class="field">
          <form @submit.prevent="registrarNIngreso">
            <!-- select con opciones -->
            <Dropdown
              v-model="NIcarreras"
              :options="carrerasLista"
              optionLabel="name"
              optionValue="code"
              :filter="true"
              placeholder="Carrera..."
              class="!mt-3"
            />

            <div class="field col-12 md:col-3">
              <label for="minmax">Total Ingresos</label>
              <InputNumber
                inputId="minmax"
                v-model="totalIngresos"
                mode="decimal"
                :min="0"
                :max="10000"
                :showButtons="true"
              />
            </div>

            <div class="field col-12 md:col-3">
              <label for="minmax">Examinados</label>
              <InputNumber
                inputId="minmax"
                v-model="NIexaminados"
                mode="decimal"
                :min="0"
                :max="10000"
                :showButtons="true"
              />
            </div>

            <div class="field col-12 md:col-3">
              <Dropdown
                v-model="NIsexo"
                :options="sexoLista"
                optionLabel="name"
                optionValue="code"
                placeholder="Sexo"
                class="!mt-3"
              />
            </div>

            <div class="field col-12 md:col-3">
              <label for="minmax">Generacion</label>
              <InputNumber
                inputId="minmax"
                v-model="NIgeneracion"
                :min="0"
                :max="10000"
                :showButtons="true"
              />
            </div>

            <div class="field col-12 md:col-3">
              <label for="minmax">Admitidos</label>
              <InputNumber
                inputId="minmax"
                v-model="NIadmitidos"
                mode="decimal"
                :min="0"
                :max="10000"
                :showButtons="true"
              />
            </div>

            <div class="field col-12 md:col-3">
              <label for="minmax">Inscritos</label>
              <InputNumber
                inputId="minmax"
                v-model="NIinscritos"
                mode="decimal"
                :min="0"
                :max="10000"
                :showButtons="true"
              />
            </div>

            <Dropdown
              v-model="NIprocesos"
              :options="procesosLista"
              optionLabel="name"
              optionValue="code"
              placeholder="Proceso"
              class="!mt-3"
            />

            <div class="field col-12 md:col-3">
              <Dropdown
                v-model="NIperiodos"
                :options="periodosLista"
                optionLabel="name"
                optionValue="code"
                class="!mt-3"
                placeholder="Periodo"
              />
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
      <Dialog header="Editar Nuevo Ingreso" v-model:visible="editDialog" :breakpoints="{ '960px': '75vw', '75vw': '85vw' }" :style="{ width: '25vw' }" :modal="true" :closable="true" :dismissableMask="false">
        <div class="p-fluid p-formgrid p-grid">
          <form @submit.prevent="editarNIngreso">

            <InputText id="id" v-model="product.id" hidden />
        
            <div class="p-field p-col-12 p-md-12">
              <label for="carrera">Carrera</label>
<<<<<<< HEAD
              <InputText id="carrera" v-model="product.carrera" />
=======
              <Dropdown v-model="Ecarrera" :options="carrerasLista" optionLabel="name" optionValue="code" :filter="true"
                placeholder="Carrera..." class="!mt-3" />
>>>>>>> 110d6c1665173eac4f7eaa1c4347a0e9cf341702
            </div>

            
            <div class="p-field p-col-12 p-md-12">
              <label for="total_ingresos">Total Ingresos</label>
              <InputNumber id="total_ingresos" v-model="product.total_ingresos"  />
            </div>

            
            <div class="p-field p-col-12 p-md-12">
              <label for="total_ingresos">Sexo</label>
              <inputText id="total_ingresos" v-model="product.sexo"  />
            </div>

            <div class="p-field p-col-12 p-md-12">
              <label for="total_ingresos">Generacion</label>
              <InputNumber id="total_ingresos" v-model="product.generacion"  />
            </div>

            <div class="p-field p-col-12 p-md-12">
              <label for="total_ingresos">Admitidos</label>
              <InputNumber id="total_ingresos" v-model="product.admitidos"  />
            </div>

            <div class="p-field p-col-12 p-md-12">
              <label for="total_ingresos">Inscritos</label>
              <InputNumber id="total_ingresos" v-model="product.inscritos"  />
            </div>

            <div class="p-field p-col-12 p-md-12">
              <label for="total_ingresos">Proceso</label>
<<<<<<< HEAD
              <InputText id="total_ingresos" v-model="product.proceso"  />
=======
              <Dropdown v-model="Eproceso" :options="procesosLista" optionLabel="name" optionValue="code"
              placeholder="Proceso" class="!mt-3" />
>>>>>>> 110d6c1665173eac4f7eaa1c4347a0e9cf341702
            </div>

            <div class="p-field p-col-12 p-md-12">
              <label for="total_ingresos">Periodo</label>
              <InputText id="total_ingresos" v-model="product.periodo"  />
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
          <Button label="Si" icon="pi pi-check" class="p-button-text" @click="eliminarNIngreso" />
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

table.p-datatable-table {
  width: 100%;
}

</style>
