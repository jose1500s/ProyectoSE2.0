<script>
// componentes
import AppLayout from "@/Layouts/AppLayout.vue";
import GraficaSolicitudes from "./GraficaSolicitudes.vue";
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
    Toast,
    ConfirmDialog,
    Toolbar,
    Dropdown,
    InputNumber,
    GraficaSolicitudes,
  },
    props: {
        solicitudes: Array,
    },
    setup(){},
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
        filtrarRuta(){
            const rutas =[
                "Loma-Av. De La Luz",
                "Biblioteca Gómez Morin",
                "Libramiento Sur Poniente",
                "Constituyentes",
                "Pie De La Cuesta",
                "Bernardo Quintana",
            ];
            return rutas;
        },
        filtrarCuatri(){
            const cuatris = [
                "SEP-DIC 2014",
                "SEP-DIC 2015",
                "SEP-DIC 2016",
                "SEP-DIC 2017",
                "SEP-DIC 2018",
                "SEP-DIC 2019",
                "SEP-DIC 2020",
                "SEP-DIC 2021",
            ];
            return cuatris;
        },
        filtrarTurno(){
            const turnos = ["Matutino","Vespertino","Nocturno"];
            return turnos;
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
<<<<<<< HEAD
        saveImage() {
      // guardar la grafica como imagen en el escritorio
      const contenedorGrafica = document.getElementById("contenedorGrafica");
      const grafica = contenedorGrafica.getElementsByTagName("canvas")[0];
      const imagen = grafica.toDataURL("image/png");
      const link = document.createElement("a");
      link.download = "GraficaSolicitudes.png";
      link.href = imagen;
      link.click();
    },
        openImportExcel() {
      this.importExcelDialog = true;
      // cada que se abra se resetea el valor del array de datosExcel para que no se repitan los datos
      this.datosExcel = [];
    },
=======
>>>>>>> 8757f7016d5fa15e537193bb052d8f74a8e30551
        editarSolicitud() {
      this.submitted = true; 
      if (
        this.product.id == null ||
        this.product.solicitudes == 0 ||
        this.product.hombres == 0 ||
        this.product.mujeres == 0 ||
        this.product.carrera == null ||
        this.product.ruta == null ||
        this.product.cuatrimestre == null ||
        this.product.turno == null
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
          solicitudes: this.product.solicitudes,
          hombres: this.product.hombres,
          mujeres: this.product.mujeres,
          carrera: this.product.carrera,
          ruta: this.product.ruta,
          cuatrimestre: this.product.cuatrimestre,
          turno: this.product.turno,
        };
        this.$inertia.post(`/editar-solicitudes/${this.product.id}`, data, {
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
      this.editDialog = true;
    },
        limpiarFiltros() {
            // limpia/eliminar los filtros realizados en la  tabla y volver a mostrar todos los datos
            this.filters.carrera.value = null;
            this.filters.ruta.value = null;
            this.filters.cuatrimestre.value = null;
            this.filters.turno.value = null;
            this.$refs.dt.filter(this.filters, "carrera");
            this.$refs.dt.filter(this.filters, "ruta");
            this.$refs.dt.filter(this.filters, "cuatrimestre");
            this.$refs.dt.filter(this.filters, "turno");
        },
        registrarSolicitudes() {
      this.submitted = true;
      if (
        this.SOcarrera == null ||
        this.SOruta == null ||
        this.SOsolicitudes == 0 ||
        this.SOhombres == 0 ||
        this.SOmujeres == 0 ||
        this.SOcuatri == null ||
        this.SOturno == null
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
          carrera: this.SOcarrera,
          ruta: this.SOruta,
          solicitudes: this.SOsolicitudes,
          hombres: this.SOhombres,
          mujeres: this.SOmujeres,
          cuatrimestre: this.SOcuatri,
          turno: this.SOturno
        };
        this.$inertia.post("/registro-solicitudes", data, {
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
    confirmDeleteProduct(product) {
      this.product = product;
      this.deleteProductDialog = true;
    },
    eliminarSolicitud() {
      const data = {
        id: this.product.id,
      };
      this.$inertia.post("/eliminar-solicitud", data, {
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
      this.$inertia.post("/eliminar-solicitudes", data, {
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
    },
    data(){
        return {
            filters: {
                carrera: {  value: null,matchMode: FilterMatchMode.IN},
                ruta: {  value: null,matchMode: FilterMatchMode.IN},
                turno: {  value: null,matchMode: FilterMatchMode.IN},
                cuatrimestre: {  value: null,matchMode: FilterMatchMode.IN},
            },
            carrerasLista: [
                { name: "Manufactura", code: "Manufactura" },
                { name: "Mecatronica", code: "Mecatronica" },
                { name: "Negocios", code: "Negocios" },
                { name: "Procesos", code: "Procesos" },
                { name: "Pymes", code: "Pymes" },
                { name: "Sistemas", code: "Sistemas" },
                { name: "Redes", code: "Redes" },
            ],
            rutasLista: [
                { name: "Loma-Av. De La Luz", code: "Loma-Av. De La Luz" },
                { name: "Biblioteca Gómez Morin", code: "Biblioteca Gómez Morin" },
                { name: "Libramiento Sur Poniente", code: "Libramiento Sur Poniente" },
                { name: "Constituyentes", code: "Constituyentes" },
                { name: "Pie De La Cuesta", code: "Pie De La Cuesta" },
                { name: "Bernardo Quintana", code: "Bernardo Quintana" },
            ],
            turnosLista: [
                { name: "Matutino", code: "Matutino" },
                { name: "Vespertino", code: "Vespertino" },
                { name: "Nocturno", code: "Nocturno" },
            ],
            cuatrisLista: [
                { name: "SEP-DIC 2014", code: "SEP-DIC 2014" },
                { name: "SEP-DIC 2015", code: "SEP-DIC 2015" },
                { name: "SEP-DIC 2016", code: "SEP-DIC 2016" },
                { name: "SEP-DIC 2017", code: "SEP-DIC 2017" },
                { name: "SEP-DIC 2018", code: "SEP-DIC 2018" },
                { name: "SEP-DIC 2019", code: "SEP-DIC 2019" },
                { name: "SEP-DIC 2020", code: "SEP-DIC 2020" },
                { name: "SEP-DIC 2021", code: "SEP-DIC 2021" },
            ],
            noDataMessage: "No se encontraron datos",
            displayResponsive: false,
            productDialog: false,
            editDialog: false,
            deleteProductDialog: false,
            selectedProducts: null,
            deleteProductsDialog: false,
            SOcarrera: null,
            SOruta: null,
            SOsolicitudes: 0,
            SOhombres: 0,
            SOmujeres: 0,
            SOcuatri: null,
            SOturno: null,
        }
    }
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
                class="p-button-danger !mr-2"
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
<<<<<<< HEAD
                <!-- model para abrir grafica -->
                <Button label="Grafica" icon="pi pi-chart-bar" @click="openResponsive"/>
                
=======
                <Button
                    icon="pi pi-external-link"
                    label="Exportar Excel"
                    @click="exportCSV($event)"
                />

>>>>>>> 8757f7016d5fa15e537193bb052d8f74a8e30551
                <MultiSelect
                    v-model="filters.carrera.value"
                    :options="filtrarCarreras()"
                    placeholder="Carrera"
                    display="chip"
                />

                <MultiSelect
                    v-model="filters.ruta.value"
                    :options="filtrarRuta()"
                    placeholder="Ruta"
                    display="chip"
                />

                <MultiSelect
                    v-model="filters.cuatrimestre.value"
                    :options="filtrarCuatri()"
                    placeholder="Periodo"
                    display="chip"
                />

                <MultiSelect
                    v-model="filters.turno.value"
                    :options="filtrarTurno()"
                    placeholder="Turno"
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
        :value="solicitudes"
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
        <Column field="carrera" header="Carrera" :sortable="true"></Column>
        <Column field="ruta" header="Ruta" :sortable="true"></Column>
        <Column field="solicitudes" header="Solicitudes" :sortable="true"></Column>
        <Column field="hombres" header="Hombres" :sortable="true"></Column>
        <Column field="mujeres" header="Mujeres" :sortable="true"></Column>
        <Column field="seleccionados" header="Seleccionados" :sortable="true"></Column>
        <Column field="cuatrimestre" header="Cuatrimestre" :sortable="true"></Column>
        <Column field="turno" header="Turno" :sortable="true"></Column>
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
<<<<<<< HEAD



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
  
=======
>>>>>>> 8757f7016d5fa15e537193bb052d8f74a8e30551

        <Dialog
        v-model:visible="productDialog"
        :breakpoints="{ '960px': '75vw', '640px': '85vw' }"
        :style="{ width: '35vw' }"
        header="Nuevo Registro"
        :modal="true"
        class="p-fluid"
      >
        <div class="field">
          <form @submit.prevent="registrarSolicitudes">
            <!-- select con opciones -->
            <Dropdown
              v-model="SOcarrera"
              :options="carrerasLista"
              optionLabel="name"
              optionValue="code"
              :filter="true"
              placeholder="Carrera"
              class="!mt-3"
            />

            <div class="field col-12 md:col-3">
              <Dropdown
                v-model="SOruta"
                :options="rutasLista"
                optionLabel="name"
                optionValue="code"
                placeholder="Ruta"
                class="!mt-3"
              />
            </div>

            <div class="field col-12 md:col-3">
              <label for="minmax">Solicitudes</label>
              <InputNumber
                inputId="minmax"
                v-model="SOsolicitudes"
                mode="decimal"
                :min="0"
                :max="10000"
                :showButtons="true"
              />
            </div>

            <div class="field col-12 md:col-3">
              <label for="minmax">Hombres</label>
              <InputNumber
                inputId="minmax"
                v-model="SOhombres"
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
                v-model="SOmujeres"
                mode="decimal"
                :min="0"
                :max="10000"
                :showButtons="true"
              />
            </div>

            <div class="field col-12 md:col-3">
              <Dropdown
                v-model="SOcuatri"
                :options="cuatrisLista"
                optionLabel="name"
                optionValue="code"
                placeholder="Periodo"
                class="!mt-3"
              />
            </div>

            <div class="field col-12 md:col-3">
              <Dropdown
                v-model="SOturno"
                :options="turnosLista"
                optionLabel="name"
                optionValue="code"
                placeholder="Turno"
                class="!mt-3"
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

      <Dialog header="Gráfica dinámica" v-model:visible="displayResponsive"
        :breakpoints="{ '960px': '75vw', '75vw': '90vw' }" :style="{ width: '70vw' }">
        <!-- contenido del dialog/model desde aqui... -->
        <div class="w-full" id="contenedorGrafica">
          <GraficaSolicitudes :data="selectedProducts" />
        </div>
        <template #footer>
          <Button label="Cerrar" icon="pi pi-check" @click="closeResponsive" autofocus />
          <!-- boton para guardar la grafica como img -->
          <Button label="Guardar" icon="pi pi-save" @click="saveImage" />
        </template>
      </Dialog>

      <Dialog header="Editar Solicitud" v-model:visible="editDialog" :breakpoints="{ '960px': '75vw', '75vw': '85vw' }" :style="{ width: '25vw' }" :modal="true" :closable="true" :dismissableMask="false">
        <div class="p-fluid p-formgrid p-grid">
          <form @submit.prevent="editarSolicitud">

            <InputText id="id" v-model="product.id" hidden />
        
            <div class="p-field p-col-12 p-md-12">
              <label for="carrera">Carrera</label>
              <InputText id="carrera" v-model="product.carrera" />
            </div>

            
            <div class="p-field p-col-12 p-md-12">
              <label for="ruta">Ruta</label>
              <InputText id="ruta" v-model="product.ruta"  />
            </div>

            
            <div class="p-field p-col-12 p-md-12">
              <label for="total_ingresos">Solicitudes</label>
              <inputNumber id="total_ingresos" v-model="product.solicitudes"  />
            </div>

            <div class="p-field p-col-12 p-md-12">
              <label for="total_ingresos">Hombres</label>
              <inputNumber id="total_ingresos" v-model="product.hombres"  />
            </div>

            <div class="p-field p-col-12 p-md-12">
              <label for="total_ingresos">Mujeres</label>
              <inputNumber id="total_ingresos" v-model="product.mujeres"  />
            </div>

            <div class="p-field p-col-12 p-md-12">
              <label for="total_ingresos">Cuatrimestre</label>
              <InputText id="total_ingresos" v-model="product.cuatrimestre"  />
            </div>

            <div class="p-field p-col-12 p-md-12">
              <label for="total_ingresos">Turno</label>
              <InputText id="total_ingresos" v-model="product.turno"  />
            </div>
            
            <Button type="submit" label="Guardar" icon="pi pi-check" class="!mt-3" />
          </form>
        </div>
      </Dialog>

      <Dialog v-model:visible="deleteProductDialog" :style="{ width: '450px' }" header="Confirmar" :modal="true">
        <div class="confirmation-content flex justify-center items-center">
          <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem" />
          <span v-if="product">¿Confirma eliminar el registro <b>{{ product.cuatrimestre }}</b>?</span>
        </div>
        <template #footer>
          <Button label="No" icon="pi pi-times" class="p-button-text" @click="deleteProductDialog = false" />
          <Button label="Si" icon="pi pi-check" class="p-button-text" @click="eliminarSolicitud" />
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

table.p-datatable-table {
  width: 100%;
}

</style>