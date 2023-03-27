<script>
import AppLayout from "@/Layouts/AppLayout.vue";

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
    },
    props: {
        rutas: Array,
    },
    setup(){},
    methods: {
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
    },
    data(){
        return {
            filters: {
                rutas: {  value: null,matchMode: FilterMatchMode.IN},
                turno: {  value: null,matchMode: FilterMatchMode.IN},
                cuatrimestre: {  value: null,matchMode: FilterMatchMode.IN},
            },
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
            rutasLista: [
                { name: "Loma-Av. De La Luz",code: "Loma-Av. De La Luz" },
                { name: "Biblioteca Gómez Morin",code: "Biblioteca Gómez Morin" },
                { name: "Libramiento Sur Poniente",code: "Libramiento Sur Poniente" },
                { name: "Constituyentes",code: "Constituyentes" },
                { name: "Pie De La Cuesta",code: "Pie De La Cuesta" },
                { name: "Bernardo Quintana",code: "Bernardo Quintana" },
            ],
            noDataMessage: "No se encontraron datos",
            displayResponsive: false,
            productDialog: false,
            editDialog: false,
            deleteProductDialog: false,
            selectedProducts: null,
            deleteProductsDialog: false,
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
                @clic="openNew"
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
                <Button
                    icon="pi pi-external-link"
                    label="Exportar Excel"
                    @click="exportCSV($event)"
                />

                <MultiSelect
                    v-model="filters.rutas.value"
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
        :value="rutas"
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
        <Column field="ruta" header="Ruta" :sortable="true"></Column>
        <Column field="lugares_disp" header="Lugares Disponibles" :sortable="true"></Column>
        <Column field="pagados" header="Lugares Pagados" :sortable="true"></Column>
        <Column field="cuatrimestre" header="Cuatrimestre" :sortable="true"></Column>
        <Column field="turno" header="Turno" :sortable="true"></Column>
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
  height: 100% !important;
}

table.p-datatable-table {
  width: 100%;
}

</style>