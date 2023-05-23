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
import Calendar from 'primevue/calendar';


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
    GraficaIngresoVue,
    Calendar,
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
    
    filtrarPeriodo(){
      const periodos = [
        "ENE - ABR",
        "MAY - AGO",
        "SEP - DIC",
      ];
      return periodos;
    },
    filtrarAño(){
      const años = [
        2015,2016,2017,2018,2019,2020,2021,2022
      ];
      return años;
    },
    exportCSV() {
      this.$refs.dt.exportCSV();
    },
    limpiarFiltros() {
      // limpia/eliminar los filtros realizados en la  tabla y volver a mostrar todos los datos
      this.filters.carrera.value = null;
      this.filters.periodo.value = null;
      this.filters.año.value = null;
      this.$refs.dt.filter(this.filters, "Carrera");
      this.$refs.dt.filter(this.filters, "Periodo");
      this.$refs.dt.filter(this.filters, "Año");
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
        this.TITcarrera == null ||
        this.TITgeneracion == 0 ||
        this.TITperiodo == null ||
        this.TITaño == 0
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
          carrera: this.TITcarrera,
          generacion: this.TITgeneracion,
          hombre: this.TIThombre,
          mujer: this.TITmujer,
          periodo: this.TITperiodo,
          año: this.TITaño
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
        this.resetearVariables();
      }
    },
    editarTitulacion() {
      // editarl usando el dialog de editar producto
      this.submitted = true; // esto es para que se muestre el mensaje de error en el formulario
      // validar los campos del formulario, que no esten vacios y si estan mandar un mensaje y no enviar el formulario, los campos son: carrerasModel, aspirantes, examinados, noAdmitidos y selectedPeriodo
      if (
        this.TITcarrera == null ||
        this.TITgeneracion == 0 ||
        this.TITperiodo == null ||
        this.TITaño == 0
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
          carrera: this.TITcarrera,
          generacion: this.TITgeneracion,
          hombre: this.TIThombre,
          mujer: this.TITmujer,
          año: this.TITaño,
          periodo: this.TITperiodo
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
        this.resetearVariables();
      }
    },
    editProduct(product) {
      this.product = { ...product };
      this.TITaño = this.product.año;
      this.TITcarrera = this.product.carrera;
      this.TITgeneracion = this.product.generacion;
      this.TIThombre = this.product.hombre;
      this.TITmujer = this.product.mujer;
      this.TITperiodo = this.product.periodo;
       // esto es para que se muestre los datos del producto en el formulario
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
    //formatearFechaTitulacion() {
      // Tomar el valor actual de fecha_titulacion y guardarlo en una variable fecha_titulacion_sin_formato
      //const fecha_titulacion_sin_formato = this.TITfecha_titulacion;

      // Convertir la fecha sin formato en un objeto Date
      //const fecha = new Date(fecha_titulacion_sin_formato);

      // Obtener los componentes de la fecha (año, mes y día)
      //const year = fecha.getFullYear();
      //const month = fecha.getMonth() + 1; // Se suma 1 ya que los meses en JavaScript van de 0 a 11
      //const day = fecha.getDate();

      // Crear una cadena de texto con el formato deseado (yyyy-mm-dd)
      //const fecha_formateada = `${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;

      //this.TITfecha_titulacion = fecha_formateada;
    //},
    //formatearFechaCEgreso() {
      
    //  const fecha_egreso_sin_formato = this.TITcuatrimestre_egreso;

      // Convertir la fecha sin formato en un objeto Date
    //  const fecha = new Date(fecha_egreso_sin_formato);

      // Obtener los componentes de la fecha (año, mes y día)
     // const year = fecha.getFullYear();
    //  const month = fecha.getMonth() + 1; // Se suma 1 ya que los meses en JavaScript van de 0 a 11
    //  const day = fecha.getDate();

      // Crear una cadena de texto con el formato deseado (yyyy-mm-dd)
    //  const fecha_egreso_formateada = `${year}-${month.toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;

    //  this.TITcuatrimestre_egreso = fecha_egreso_formateada;
   // },
    resetearVariables(){
      this.TITcarrera = null;
      this.TITperiodo = null;
      this.TITgeneracion = 0;
      this.TIThombre = 0;
      this.TITmujer = 0;
      this.TITaño = 0;
    }

  },
  data() {
    return {
      filters: {
        carrera: { value: null, matchMode: FilterMatchMode.IN },
        periodo: { value: null, matchMode: FilterMatchMode.IN },
        año: { value: null, matchMode: FilterMatchMode.IN },
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
      periodosLista: [
        { name: "SEP - DIC", code: "SEP - DIC"},
        { name: "ENE - ABR", code: "ENE - ABR"},
        { name: "MAY - AGO", code: "MAY - AGO"},
      ],
      TITcarrera: null,
      TITgeneracion: 0,
      TIThombre: 0,
      TITmujer: 0,
      TITperiodo: null,
      TITaño: 0,
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
      <Button label="Nuevo Registro" icon="pi pi-plus" class="p-button-success !mr-2" @click="openNew" />
      <Button label="Eliminar" icon="pi pi-trash" class="p-button-danger" @click="confirmDeleteSelected"
        :disabled="!selectedProducts || !selectedProducts.length" />
    </template>
  </Toolbar>

  <Dialog v-model:visible="productDialog" :breakpoints="{ '960px': '75vw', '640px': '85vw' }" :style="{ width: '25vw' }"
    header="Nuevo Registro" :modal="true" class="p-fluid">
    <div class="field">
      <form @submit.prevent="registrarTitulacion">
        <!-- select con opciones -->
        <div class="field col-12 md:col-3">
              <Dropdown
                v-model="TITperiodo"
                :options="periodosLista"
                optionLabel="name"
                optionValue="code"
                placeholder="Periodo"
                class="!mt-3"
              />
            </div>

            <div class="field col-12 md:col-3">
          <label for="minmax">Año de egreso</label>
          <InputNumber inputId="minmax" v-model="TITaño" mode="decimal" :min="0" :max="10000" :showButtons="true" />
        </div>

        <label for="minmax">Carrera</label>
        <Dropdown v-model="TITcarrera" :options="carrerasLista" optionLabel="name" optionValue="code" :filter="true"
          placeholder="Carrera" />

          <div class="field col-12 md:col-3">
          <label for="minmax">Generación</label>
          <InputNumber inputId="minmax" v-model="TITgeneracion" mode="decimal" :min="0" :max="10000" :showButtons="true" />
        </div>

        <!-- <div class="field col-12 md:col-3">
          <label for="minmax">Titulo electronico</label>
          <InputNumber inputId="minmax" v-model="titulo_electronico" mode="decimal" :min="0" :max="10000" :showButtons="true" />
        </div> -->

        <div class="field col-12 md:col-3">
          <label for="minmax">Hombres</label>
          <InputNumber inputId="minmax" v-model="TIThombre" mode="decimal" :min="0" :max="10000" :showButtons="true" />
        </div>

        <div class="field col-12 md:col-3">
          <label for="minmax">Mujeres</label>
          <InputNumber inputId="minmax" v-model="TITmujer" mode="decimal" :min="0" :max="10000" :showButtons="true" />
        </div>

        <!--<div class="field col-12 md:col-3">
          <label for="minmax">Cuatrimestre de egreso</label>
          <Calendar v-model="TITcuatrimestre_egreso" dateFormat="yy/mm/dd" showIcon @date-select="formatearFechaCEgreso" />
        </div>

        <div class="field col-12 md:col-3">
          <label for="minmax">Fecha de titulación</label>
          <Calendar v-model="TITfecha_titulacion" dateFormat="yy/mm/dd" showIcon @date-select="formatearFechaTitulacion" />
        </div>-->

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

  <section class="bg-white" id="tablaTitulacion">
    <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8 p-[20px]">
      <div class="text-center mb-5">
        <div class="flex gap-5 justify-center flex-wrap">
          <div>
            <Toast />
          </div>
          <!-- model para abrir grafica -->
          <Button label="Grafica" icon="pi pi-chart-bar" @click="openResponsive" />
          <Dialog header="Grafica" v-model:visible="displayResponsive" :breakpoints="{ '960px': '75vw', '75vw': '90vw' }"
            :style="{ width: '70vw' }">
            <!-- contenido del dialog/model desde aqui... -->
            <div class="w-full" id="contenedorGrafica">
              <GraficaIngreso :titulados="titulados" />
            </div>
            <template #footer>
              <Button label="Cerrar" icon="pi pi-check" @click="closeResponsive" autofocus />
              <!-- boton para guardar la grafica como img -->
              <Button label="Guardar" icon="pi pi-save" @click="saveImage" />
            </template>
          </Dialog>

          <Button icon="pi pi-external-link" label="Exportar Excel" @click="exportCSV($event)" />

          <!-- Filtros -->
          <MultiSelect v-model="filters.carrera.value" :options="filtrarCarreras()" placeholder="Carrera"
            display="chip" />

          <MultiSelect v-model="filters.periodo.value" :options="filtrarPeriodo()" placeholder="Periodo"
            display="chip" />

            <MultiSelect v-model="filters.año.value" :options="filtrarAño()" placeholder="Año"
            display="chip" />

          <Button icon="pi pi-times" label="Limpiar" @click="limpiarFiltros()" />
        </div>
      </div>

      <DataTable :value="titulados" :paginator="true" class="p-datatable-customers" :rows="7" ref="dt"
        v-model:filters="filters" v-model:selection="selectedProducts" :emptyMessage="noDataMessage" stripedRows
        sortMode="multiple" removableSort>
        <Column selectionMode="multiple" style="width: 3rem" :exportable="false"></Column>

        <Column field="id" header="ID" :sortable="true" hidden></Column>
        <Column field="periodo_con_año" header="Periodo" :sortable="true"></Column>
        <Column field="carrera" header="Carrera" :sortable="true"></Column>
        <Column field="generacion" header="Generacion" :sortable="true"></Column>
        <Column field="hombre" header="Hombres" :sortable="true"></Column>
        <Column field="mujer" header="Mujeres" :sortable="true"></Column>
        <Column field="total" header="Total" :sortable="true"></Column>
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

      <!-- Dialog para editar el producto toma los valores del producto seleccionado -->
      <Dialog header="Editar Titulados" v-model:visible="editDialog" :breakpoints="{ '960px': '75vw', '75vw': '85vw' }"
        :style="{ width: '25vw' }" :modal="true" :closable="true" :dismissableMask="false">
        <div class="p-fluid p-formgrid p-grid">
          <form @submit.prevent="editarTitulacion">
            <InputText id="id" v-model.trim="product.id" hidden />
            <div class="field col-12 md:col-3">
              <label for="minmax">Periodo</label>
              <Dropdown v-model="TITperiodo" :options="periodosLista" optionLabel="name" optionValue="code"
                :filter="true" placeholder="Periodo" />
            </div>

            <div class="field col-12 md:col-3">
              <label for="minmax">Año</label>
              <InputNumber inputId="minmax" v-model="TITaño" mode="decimal" :min="0" :max="10000" :showButtons="true" />
            </div>
            <div class="field col-12 md:col-3">
              <label for="minmax">Carrera</label>
              <Dropdown v-model="TITcarrera" :options="carrerasLista" optionLabel="name" optionValue="code"
                :filter="true" placeholder="Carrera" />
            </div>
            
            <div class="field col-12 md:col-3">
              <label for="minmax">Generacion</label>
              <InputNumber inputId="minmax" v-model="TITgeneracion" mode="decimal" :min="0" :max="10000" :showButtons="true" />
            </div>

            <div class="field col-12 md:col-3">
              <label for="minmax">Hombres</label>
              <InputNumber inputId="minmax" v-model="TIThombre" mode="decimal" :min="0" :max="10000" :showButtons="true" />
            </div>

            <div class="field col-12 md:col-3">
              <label for="minmax">Mujeres</label>
              <InputNumber inputId="minmax" v-model="TITmujer" mode="decimal" :min="0" :max="10000" :showButtons="true" />
            </div>

            <Button type="submit" label="Guardar" icon="pi pi-check" class="!mt-3" />
          </form>
        </div>
      </Dialog>

      <!-- Dialog para eliminar un registro -->
      <Dialog v-model:visible="deleteProductDialog" :style="{ width: '450px' }" header="Confirmar" :modal="true">
        <div class="confirmation-content flex justify-center items-center">
          <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
          <span v-if="product">¿Confirma eliminar el registro <b>{{ product.periodo + " " + product.carrera }}</b>?</span>
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