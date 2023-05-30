<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import GraficaTituladosTotales from "@/Pages/menusComponentes/Titulo/GraficaTituladosTotales.vue";
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
        GraficaTituladosTotales,
    },
    props: {
        totales: Array,
    },
    setup() {},
    methods: {
        filtrarCuatri(){
            const cuatris=[
                "SEP-DIC",
                "ENE-ABR",
                "MAY-AGO"
            ];
            return cuatris;
        },
        exportCSV() {
            this.$refs.dt.exportCSV();
        },
        openResponsive() {
            this.displayResponsive = true;
        },
        closeResponsive() {
            this.displayResponsive = false;
        },
        openNew() {
            this.product = {};
            this.submitted = false;
            this.productDialog = true;
        },
        confirmDeleteSelected() {
            this.deleteProductsDialog = true;
        },
        registrarTotal() {
      this.submitted = true;
      if (
        this.TOTaño == 0 ||
        this.TOTgeneracion == 0 ||
        this.TOTperiodo == null
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
          generacion: this.TOTgeneracion,
          hombre: this.TOThombres,
          mujer: this.TOTmujeres,
          periodo: this.TOTperiodo,
          año: this.TOTaño
        };
        this.$inertia.post("/registro-Titulado-Total", data, {
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
      this.resetearVariables();
    },
    editarTotal() {
      this.submitted = true; 
      if (
        this.product.id == null ||
        this.TOTaño == 0 ||
        this.TOTgeneracion == 0 ||
        this.TOTperiodo == null
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
          generacion: this.TOTgeneracion,
          hombre: this.TOThombres,
          mujer: this.TOTmujeres,
          periodo: this.TOTperiodo,
          año: this.TOTaño
        };
        this.$inertia.post(`/editar-Titulado-Total/${this.product.id}`, data, {
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
      this.resetearVariables();
    },
    editProduct(product) {
      this.product = { ...product }; // esto es para que se muestre los datos del producto en el formulario
      this.TOTaño = this.product.año;
      this.TOTgeneracion = this.product.generacion;
      this.TOThombres = this.product.hombres;
      this.TOTmujeres = this.product.mujeres;
      this.TOTperiodo = this.product.periodo;
      this.editDialog = true;
    },
    limpiarFiltros() {
            // limpia/eliminar los filtros realizados en la  tabla y volver a mostrar todos los datos
            this.filters.periodo.value = null;
            this.filters.año.value = null;
            this.filters.generacion.value = null;
            this.$refs.dt.filter(this.filters, "periodo");
            this.$refs.dt.filter(this.filters, "año");
            this.$refs.dt.filter(this.filters, "generacion");
    },
    confirmDeleteProduct(product) {
      this.product = product;
      this.deleteProductDialog = true;
    },
    eliminarTotal() {
      const data = {
        id: this.product.id,
      };
      this.$inertia.post(`/eliminar-Titulado-Total/${this.product.id}`, data, {
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
      this.$inertia.post("/eliminar-Titulados-Total", data, {
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
    resetearVariables(){
      this.TOTaño = 0;
      this.TOTperiodo = null;
      this.TOTgeneracion = 0;
      this.TOThombres = 0;
      this.TOTmujeres = 0;
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
          // si el archivo no tiene las columnas 'carrera', 'aspirantes', 'examinados', 'no admitidos' y 'periodo' no se sube y mandar un mensaje de error
          if (
            this.columnasExcel[1] != "Periodo" ||
            this.columnasExcel[2] != "Año" ||
            this.columnasExcel[3] != "Generación" ||
            this.columnasExcel[4] != "Hombres" ||
            this.columnasExcel[5] != "Mujeres" ||
            this.columnasExcel[6] != "Total"
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
          periodo: this.datosExcel[i][1],
          año: this.datosExcel[i][2],
          generacion: this.datosExcel[i][3],
          hombres: this.datosExcel[i][4],
          mujeres: this.datosExcel[i][5],
          total: this.datosExcel[i][6],
        })
      }

      const data = {
        datos: datosInsertar,
      };

      this.$inertia.post("/importar-excel-titulados-generaciones", data, {
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
    checarDataGrafica(){
      console.log(this.selectedProducts);
    },

    },
    data(){
        return{
            filters: {
                periodo: {  value: null,matchMode: FilterMatchMode.IN},
                año: { value: null, matchMode: FilterMatchMode.CONTAINS },
                generacion: { value: null, matchMode: FilterMatchMode.CONTAINS },
            },
            periodosLista: [
                { name: "SEP-DIC", code: "SEP-DIC" },
                { name: "ENE-ABR", code: "ENE-ABR" },
                { name: "MAY-AGO", code: "MAY-AGO" },
            ],
            columnasPreviewExcel: [
        { name: "ID", code: "0"},
        { name: "Periodo", code: "1"},
        { name: "Año", code: "2"},
        { name: "Generación", code: "3"},
        { name: "Hombres", code: "4"},
        { name: "Mujeres", code: "5"},
        { name: "Total", code: "6"},
      ],
      datosFiltrados: [],
      datosExcel: [],
      columnasExcel: [],
            noDataMessage: "No se encontraron datos",
            displayResponsive: false,
            productDialog: false,
            editDialog: false,
            deleteProductDialog: false,
            selectedProducts: null,
            deleteProductsDialog: false,
            TOTperiodo: null,
            TOTgeneracion: 0,
            TOTaño: 0,
            TOThombres: 0,
            TOTmujeres: 0,
            importExcelDialog: false,
      wrongFormatExcel: false,
      file: null,
      fileContent: null,
      selectedProductsForChart: null,
        }
    }
}
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
        <Button class="!ml-2"
                    icon="pi pi-external-link"
                    label="Exportar Excel"
                    @click="exportCSV($event)"
                />
                <Button label="Importar Excel" icon="pi pi-upload" class="!ml-2" @click="openImportExcel" />
      </template>
    </Toolbar>
    <section class="bg-white" id="tablaIngreso">
    <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8 p-[20px]">
        <div class="text-center mb-5">
            <div class="flex gap-5 justify-center flex-wrap">
                <div>
                    <Toast />
                </div>
                <Button label="Gráfica" icon="pi pi-chart-bar" @click="openResponsive" />
                <Button label="Checar" icon="pi pi-chart-bar" @click="checarDataGrafica()" />
          <Dialog header="Gráfica dinámica" v-model:visible="displayResponsive"
        :breakpoints="{ '960px': '75vw', '75vw': '90vw' }" :style="{ width: '70vw' }">
        <!-- contenido del dialog/model desde aqui... -->
        <div class="w-full" id="contenedorGrafica">
          <GraficaTituladosTotales :data="selectedProducts" />
        </div>
        <template #footer>
          <Button label="Cerrar" icon="pi pi-check" @click="closeResponsive" autofocus />
          <!-- boton para guardar la grafica como img -->
          <Button label="Guardar" icon="pi pi-save" @click="saveImage" />
        </template>
      </Dialog>
                
                <MultiSelect
                v-model="filters.periodo.value"
                :options="filtrarCuatri()"
                    placeholder="Periodo"
                    display="chip"
                />
                <InputNumber
          v-model="filters.año.value"
                mode="decimal"
                :min="0"
                :max="10000"
                placeholder="Año"
                />
                <InputNumber
                v-model="filters.generacion.value"
                mode="decimal"
                :min="0"
                :max="100"
                placeholder="Generación"
                />
                
                <Button
                    icon="pi pi-times"
                    label="Limpiar"
                    @click="limpiarFiltros()"
                />
            </div>
        </div>
    </div>
    <DataTable
        :value="totales"
        :paginator="true"
        class="p-datatable-costumers"
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
        <Column field="periodo_con_año" header="Periodo" :sortable="true"></Column>
        <Column field="generacion" header="Generación" :sortable="true"></Column>
        <Column field="hombres" header="Hombres" :sortable="true"></Column>
        <Column field="mujeres" header="Mujeres" :sortable="true"></Column>
        <Column field="total" header="Total" :sortable="true"></Column>
        <Column :exportable="false" style="min-width: 8rem" class="p-6">
          <template #body="slotProps">
            <Button icon="pi pi-pencil" class="p-button-rounded p-button-success !mr-2"
              @click="editProduct(slotProps.data)" />
            <Button icon="pi pi-trash" class="p-button-rounded p-button-warning"
              @click="confirmDeleteProduct(slotProps.data)" />
          </template>
        </Column>
        <template #empty>
          <div class="flex justify-center align-middle text-xl">
            <h2>No se encontraron datos</h2>
          </div>
        </template>    
    </DataTable>
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
    <Dialog
        v-model:visible="productDialog"
        :breakpoints="{ '960px': '75vw', '640px': '85vw' }"
        :style="{ width: '35vw' }"
        header="Nuevo Registro"
        :modal="true"
        class="p-fluid"
      >
        <div class="field">
          <form @submit.prevent="registrarTotal">
            <!-- select con opciones -->
            <div class="field col-12 md:col-3">
            <Dropdown
                v-model="TOTperiodo"
                :options="periodosLista"
                optionLabel="name"
                optionValue="code"
                placeholder="Periodo"
                class="!mt-3"
              />
            </div>

            <div class="field col-12 md:col-3">
          <label for="minmax">Año de egreso</label>
          <InputNumber inputId="minmax" v-model="TOTaño" mode="decimal" :min="0" :max="10000" :showButtons="true" />
        </div>

        <div class="field col-12 md:col-3">
          <label for="minmax">Generación</label>
          <InputNumber inputId="minmax" v-model="TOTgeneracion" mode="decimal" :min="0" :max="10000" :showButtons="true" />
        </div>


            <div class="field col-12 md:col-3">
              <label for="minmax">Hombres</label>
              <InputNumber
                inputId="minmax"
                v-model="TOThombres"
                mode="decimal"
                :min="0"
                :max="10000"
                :showButtons="true"
              />
            </div>

            <div class="field col-12 md:col-3">
              <label for="minmax">Mujeres</label>
              <InputNumber
                inputId="minmax"
                v-model="TOTmujeres"
                mode="decimal"
                :min="0"
                :max="10000"
                :showButtons="true"
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
      <Dialog header="Editar Total" v-model:visible="editDialog" :breakpoints="{ '960px': '75vw', '75vw': '85vw' }" :style="{ width: '25vw' }" :modal="true" :closable="true" :dismissableMask="false">
        <div class="p-fluid p-formgrid p-grid">
          <form @submit.prevent="editarTotal">

            <InputText id="id" v-model="product.id" hidden />

            <div class="field col-12 md:col-3">
            <Dropdown
                v-model="TOTperiodo"
                :options="periodosLista"
                optionLabel="name"
                optionValue="code"
                placeholder="Periodo"
                class="!mt-3"
              />
            </div>

            <div class="p-field p-col-12 p-md-12">
              <label for="total_ingresos">Año</label>
              <InputNumber id="total_ingresos" v-model="TOTaño"  />
            </div>

            <div class="p-field p-col-12 p-md-12">
              <label for="total_ingresos">Generación</label>
              <InputNumber id="total_ingresos" v-model="TOTgeneracion"  />
            </div>

            <div class="p-field p-col-12 p-md-12">
              <label for="total_ingresos">Hombres</label>
              <inputNumber id="total_ingresos" v-model="this.TOThombres"  />
            </div>

            <div class="p-field p-col-12 p-md-12">
              <label for="total_ingresos">Mujeres</label>
              <inputNumber id="total_ingresos" v-model="this.TOTmujeres"  />
            </div>
            
            <Button type="submit" label="Guardar" icon="pi pi-check" class="!mt-3" />
          </form>
        </div>
      </Dialog>

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
      <Dialog v-model:visible="deleteProductDialog" :style="{ width: '450px' }" header="Confirmar" :modal="true">
        <div class="confirmation-content flex justify-center items-center">
          <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
          <span v-if="product">¿Confirma eliminar el registro <b>{{ product.periodo }}</b>?</span>
        </div>
        <template #footer>
          <Button label="No" icon="pi pi-times" class="p-button-text" @click="deleteProductDialog = false" />
          <Button label="Si" icon="pi pi-check" class="p-button-text" @click="eliminarTotal" />
        </template>
      </Dialog>


    </section>
</template>