<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import InputText from 'primevue/inputtext';
import Row from 'primevue/row';
import Button from 'primevue/button';
import { FilterMatchMode, FilterService } from 'primevue/api';
import MultiSelect from 'primevue/multiselect';

export default {
  components: {
    AppLayout,
    DataTable,
    Column,
    InputText,
    Row,
    Button,
    MultiSelect,
  },
  props: {
    ingresos: Array,
  },
  setup() {

  },
  methods: {
    filtrarCarreras() {
      // filtar del arreglo ingresos.carrera, todos los que se repiten
      // y retornar un arreglo con los nombres de las carreras sin repetir
      const carreras = this.ingresos.map(item => item.carrera);
      const carrerasFiltradas = [...new Set(carreras)];
      return carrerasFiltradas;
    },
    filtrarProcesos() {
      // filtar del arreglo ingresos.carrera, todos los que se repiten
      // y retornar un arreglo con los nombres de las carreras sin repetir
      const procesos = this.ingresos.map(item => item.Proceso);
      const procesosFiltradas = [...new Set(procesos)];
      return procesosFiltradas;
    },
    filtrarFecha() {
      // filtar del arreglo ingresos.carrera, todos los que se repiten
      // y retornar un arreglo con los nombres de las carreras sin repetir
      const fechas = this.ingresos.map(item => item.fecha);
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
      this.$refs.dt.filter(this.filters, 'carrera');
      this.$refs.dt.filter(this.filters, 'Proceso');
      this.$refs.dt.filter(this.filters, 'fecha');
    },
  },
  data() {
    return {
      filters: {
        'carrera': { value: null, matchMode: FilterMatchMode.IN },
        'Proceso': { value: null, matchMode: FilterMatchMode.IN },
        'fecha': { value: null, matchMode: FilterMatchMode.IN },
      },
      noDataMessage: 'No se encontraron datos'
    };
  },


};
</script>

<template>
  <AppLayout title="Ingreso">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Ingreso</h2>
    </template>
    <section class="bg-white">

      <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8 p-[20px]">
        <div class="text-center mb-5">
          <div class="flex gap-5 justify-center">
            <Button icon="pi pi-external-link" label="Exportar Excel" @click="exportCSV($event)" />


            <MultiSelect v-model="filters.carrera.value" :options="filtrarCarreras()" placeholder="Carrera"
              display="chip" />

            <MultiSelect v-model="filters.Proceso.value" :options="filtrarProcesos()" placeholder="Proceso"
              display="chip" />

            <MultiSelect v-model="filters.fecha.value" :options="filtrarFecha()" placeholder="Fecha"
              display="chip" />

            <Button icon="pi pi-times" label="Limpiar" @click="limpiarFiltros()" />


          </div>
        </div>

        <DataTable :value="ingresos" :paginator="true" class="p-datatable-customers" :rows="10" ref="dt"
          v-model:filters="filters" :emptyMessage="noDataMessage">

          <Column field="carrera" header="Carrera" :sortable="true"></Column>
          <Column field="aspirantes" header="Aspirantes" :sortable="true"></Column>
          <Column field="examinados" header="Examinados" :sortable="true"></Column>
          <Column field="admitidos" header="Admitidos" :sortable="true"></Column>
          <Column field="rechazados" header="Rechazados" :sortable="true"></Column>
          <Column field="inscritos" header="Inscritos" :sortable="true"></Column>
          <Column field="Proceso" header="Proceso" :sortable="true"></Column>
          <Column field="fecha" header="Fecha" :sortable="true"></Column>

          <!-- mensaje de no hay datos -->
          <template #empty>
              <div class="flex justify-center align-middle text-xl">
                <h2>No se encontraron datos</h2>
              </div>
          </template>


        </DataTable>

      </div>
    </section>
  </AppLayout>
</template>

<style type="text/css">
.p-multiselect-label-container {
  max-width: 170px;
}
</style>
