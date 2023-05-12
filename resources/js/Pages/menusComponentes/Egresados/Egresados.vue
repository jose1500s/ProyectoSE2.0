<script>
import AppLayout from "@/Layouts/AppLayout.vue";
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
  data() {
    return {
      filters: {
        carrera: { value: null, matchMode: FilterMatchMode.IN },
        generacion: { value: null, matchMode: FilterMatchMode.IN },
        año_egreso: { value: null, matchMode: FilterMatchMode.IN },        
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
      noDataMessage: "No se encontraron datos",
      cuatriLista: [
        { name: "SEP-DIC", code: "SEP-DIC" },
        { name: "ENE-ABR", code: "ENE-ABR" },
        { name: "MAY-AGO", code: "MAY-AGO" },
      ],
      carrera: null,
      generacion: null,
      negresados: null,
      año_egreso: null,
      cuatrimestre: null,
      hombres: 0,
      mujeres: 0,
      productDialog: false,
      editDialog: false,
      deleteProductDialog: false,
      selectedProducts: null,
      deleteProductsDialog: false,
    };
  },
  created() {},
  mounted() {},
  methods: {
    openNew() {
      this.product = {};
      this.submitted = false;
      this.productDialog = true;
    },
    hideDialog() {
      this.productDialog = false;
      this.submitted = false;
    },
    registrarEgreso() {
      this.submitted = true; // esto es para que se muestre el mensaje de error en el formulario
      // validar los campos del formulario, que no esten vacios y si estan mandar un mensaje y no enviar el formulario, los campos son: carrerasModel, aspirantes, examinados, noAdmitidos y selectedPeriodo
      if (
        this.carrera == null ||
        this.generacion == null ||
        this.negresados == null ||
        this.año_egreso == null ||
        this.cuatrimestre == null ||
        this.hombres == 0 ||
        this.mujeres == 0
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
          negresados: this.negresados,
          año_egreso: this.año_egreso,
          cuatrimestre: this.cuatrimestre,
          hombres: this.hombres,
          mujeres: this.mujeres,
        };
        this.$inertia.post("/registro-Egreso", data, {
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
    editarEgreso() {
      // editarl usando el dialog de editar producto
      this.submitted = true; // esto es para que se muestre el mensaje de error en el formulario
      // validar los campos del formulario, que no esten vacios y si estan mandar un mensaje y no enviar el formulario, los campos son: carrerasModel, aspirantes, examinados, noAdmitidos y selectedPeriodo
      if (
        this.product.id == 0 ||
        this.product.carrera == null ||
        this.product.generacion == null ||
        this.product.egresados == null ||
        this.product.año_egreso == null ||
        this.product.cuatrimestre == null ||
        this.product.hombres == 0 ||
        this.product.mujeres == 0
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
        const data2 = {
          id: this.product.id,
          carrera: this.product.carrera,
          generacion: this.product.generacion,
          egresados: this.product.egresados,
          año_egreso: this.product.año_egreso,
          cuatrimestre: this.product.cuatrimestre,
          hombres: this.product.hombres,
          mujeres: this.product.mujeres,
        };
        this.$inertia.post(`/editar-Egreso/${this.product.id}`, data2, {
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
      this.$inertia.post(`/eliminar-Egreso/${this.product.id}`, data2, {
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
      this.$inertia.post("/eliminar-Egresos", data, {
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

    // filtros

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
    filtrarAño() {
      const año = [
        "2014",
        "2015",
        "2016",
        "2017",
        "2018",
        "2019",
        "2020",
        "2021",
        "2022",
        "2023",
        "2024",
        "2025",
        "2026",
        "2027",
        "2028",
        "2029",
        "2030",
      ];
      return año;
    },
    filtrarGeneracion() {
      const generacion = [
        "1",
        "2",
        "3",
        "4",
        "5",
        "6",
        "7",
        "8",
        "9",
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
        "20",
      ];
      return generacion;
    },

    limpiarFiltros() {
      // limpia/eliminar los filtros realizados en la  tabla y volver a mostrar todos los datos
      this.filters.carrera.value = null;
      this.filters.año_egreso.value = null;
      this.filters.generacion.value = null;
      this.$refs.dt.filter(this.filters, "carrera");
      this.$refs.dt.filter(this.filters, "año");
      this.$refs.dt.filter(this.filters, "generacion");
    },
  },
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
  },
  props: {
    egresados: Array,
  },
  setup() {
    //use
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
    <!-- formulario de nuevo registro-->
    <Dialog
      v-model:visible="productDialog"
      :breakpoints="{ '960px': '75vw', '640px': '85vw' }"
      :style="{ width: '25vw' }"
      header="Nuevo Registro"
      :modal="true"
      class="p-fluid"
    >
      <div class="field">
        <form @submit.prevent="registrarEgreso">
          <!-- select con opciones -->
          <div class="field col-12 md:col-3">
            <label for="minmax">Carrera</label>
            <Dropdown
              v-model="carrera"
              :options="carrerasLista"
              optionLabel="name"
              optionValue="code"
              :filter="true"
              placeholder="Seleccione"
            />
          </div>

          <div class="field col-12 md:col-3">
            <label for="minmax">Generación</label>
            <InputText
              inputId="minmax"
              v-model="generacion"
              mode="decimal"
              :min="1"
              :max="20"
              :showButtons="true"
            />
          </div>

          <div class="field col-12 md:col-3">
            <label for="minmax">Nº de Egresados</label>
            <InputText
              inputId="minmax"
              v-model="negresados"
              mode="decimal"
              :min="0"
              :max="10000"
              :showButtons="true"
            />
          </div>

          <div class="field col-12 md:col-3">
            <label for="minmax">Nº de Hombres</label>
            <InputText
              inputId="minmax"
              v-model="hombres"
              mode="decimal"
              :min="0"
              :max="10000"
              :showButtons="true"
            />
          </div>

          <div class="field col-12 md:col-3">
            <label for="minmax">Nº de Mujeres</label>
            <InputText
              inputId="minmax"
              v-model="mujeres"
              mode="decimal"
              :min="0"
              :max="10000"
              :showButtons="true"
            />
          </div>

          <div class="field col-12 md:col-3">
            <label for="minmax">Año de egreso</label>
            <InputText
              inputId="minmax"
              v-model="año_egreso"
              mode="decimal"
              :showButtons="true"
            />
          </div>

          <div class="field col-12 md:col-3 mt-3">
            <label for="minmax">Cuatrimestre</label>
            <Dropdown
              v-model="cuatrimestre"
              :options="cuatriLista"
              optionLabel="name"
              optionValue="code"
              placeholder="Seleccione"
            />
          </div>

          <div class="field col-12 md:col-3 mt-3">
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
          </Button></div>
        </form>
      </div>

      <!-- Botonera de filtros-->
    </Dialog>
    <section class="bg-white" id="tablaEgreso">
      <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8 p-[20px]">
        <div class="text-center mb-5">
          <div class="flex gap-5 justify-center flex-wrap">
            <div>
              <Toast />
            </div>

            <!-- Filtros -->
            <MultiSelect
              v-model="filters.carrera.value"
              :options="filtrarCarreras()"
              placeholder="Carrera"
              display="chip"
            />

            <MultiSelect
              v-model="filters.generacion.value"
              :options="filtrarGeneracion()"
              placeholder="Generacion"
              display="chip"
            />

            <MultiSelect
              v-model="filters.año_egreso.value"
              :options="filtrarAño()"
              placeholder="Año"
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
          :value="egresados"
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

          <Column field="id" header="ID" :sortable="true" hidden ></Column>
          <Column field="carrera" header="Carrera" :sortable="true"></Column>
          <Column field="generacion" header="Generacion" :sortable="true"></Column>
          <Column field="egresados" header="Nº de Egresados" :sortable="true" ></Column>
          <Column field="hombres" header=" Nº Hombres" :sortable="true"></Column>
          <Column field="mujeres" header="Nº Mujeres" :sortable="true"></Column>
          <Column field="año_egreso" header="Año de egreso" :sortable="true"></Column>
          <Column field="cuatrimestre" header="Cuatrimestre" :sortable="true"></Column>
          
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
          header="Editar Egreso"
          v-model:visible="editDialog"
          :breakpoints="{ '960px': '75vw', '75vw': '85vw' }"
          :style="{ width: '25vw' }"
          :modal="true"
          :closable="true"
          :dismissableMask="false"
        >
          <div class="p-fluid p-formgrid p-grid">
            <form @submit.prevent="editarEgreso">
              <InputText id="id" v-model.trim="product.id" required="true" hidden/>

              <div class="p-field p-col-12 p-md-6">
                <label for="carrera">Carrera</label>
                <InputText id="name" v-model.trim="product.carrera" />
                <!-- <Dropdown v-model="carrera" :options="carrerasLista" optionLabel="name" optionValue="code" :filter="true" -->
                <!--  placeholder="Carrera..." v-model.trim="product.carrera"/> -->
              </div>
              <div class="p-field p-col-12 p-md-6">
                <label for="generacion">Generación</label>
                <InputText
                  id="name"
                  v-model.trim="product.generacion"
                  required="true"
                />
              </div>
              <div class="p-field p-col-12 p-md-6">
                <label for="egresados">Egresados</label>
                <InputText
                  id="name"
                  v-model.trim="product.egresados"
                  required="true"
                />
              </div>
              <div class="p-field p-col-12 p-md-6">
                <label for="año">Año de egreso</label>
                <InputText
                  id="name"
                  v-model.trim="product.año_egreso"
                  required="true"
                />
              </div>
              <div class="p-field p-col-12 p-md-6">
                <label for="cuatrimestre">Cuatrimestre</label>
                <InputText
                  id="name"
                  v-model.trim="product.cuatrimestre"
                  required="true"
                />
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
            <i
              class="pi pi-exclamation-triangle mr-3"
              style="font-size: 2rem"
            />
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
            <i
              class="pi pi-exclamation-triangle mr-3"
              style="font-size: 2rem"
            />
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

<style scoped>
::v-deep(.p-paginator) .p-paginator-current {
  margin-left: auto;
}

::v-deep(.p-progressbar) {
  height: 0.5rem;
  background-color: #d8dadc;
}

::v-deep(.p-progressbar) .p-progressbar-value {
  background-color: #607d8b;
}

::v-deep(.p-datepicker) {
  min-width: 25rem;
}

::v-deep(.p-datepicker) td {
  font-weight: 400;
}

::v-deep(.p-datatable.p-datatable-customers) .p-datatable-header {
  padding: 1rem;
  text-align: left;
  font-size: 1.5rem;
}

::v-deep(.p-datatable.p-datatable-customers) .p-paginator {
  padding: 1rem;
}

::v-deep(.p-datatable.p-datatable-customers) .p-datatable-thead > tr > th {
  text-align: left;
}

::v-deep(.p-datatable.p-datatable-customers) .p-datatable-tbody > tr > td {
  cursor: auto;
}

::v-deep(.p-datatable.p-datatable-customers)
  .p-dropdown-label:not(.p-placeholder) {
  text-transform: uppercase;
}
</style>
