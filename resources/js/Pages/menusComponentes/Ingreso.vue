<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import InputText from 'primevue/inputtext';
import Row from 'primevue/row';
import Button from 'primevue/button';
import { FilterMatchMode, FilterService } from 'primevue/api';

export default {
  components: {
    AppLayout,
    DataTable,
    Column,
    InputText,
    Row,
    Button,
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
    exportCSV() {
      this.$refs.dt.exportCSV();
    },
  },
  data() {
    return {
      filters: {
        'carrera': { value: null, matchMode: FilterMatchMode.CONTAINS },
        'Proceso': { value: null, matchMode: FilterMatchMode.EQUALS },
      },
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

      <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-6 md:py-16 lg:px-8">


        <DataTable :value="ingresos" :paginator="true" class="p-datatable-customers" :rows="10" ref="dt"
          v-model:filters="filters">
          <div class="text-center mb-5">
            <div class="flex gap-5 justify-center">
              <Button icon="pi pi-external-link" label="Export Excel" @click="exportCSV($event)" />
              <select v-model="filters.carrera.value">
                <option class="" v-for="carrera in filtrarCarreras()" :key="carrera" :value="carrera">{{ carrera }}</option>
              </select>
              <select v-model="filters.Proceso.value">
                <option class="" v-for="procesos in filtrarProcesos()" :key="procesos" :value="procesos">{{ procesos }}
                </option>
              </select>
            </div>
          </div>
          <Column field="carrera" header="Carrera" :sortable="true"></Column>
          <Column field="aspirantes" header="Aspirantes" :sortable="true"></Column>
          <Column field="examinados" header="Examinados" :sortable="true"></Column>
          <Column field="admitidos" header="Admitidos" :sortable="true"></Column>
          <Column field="rechazados" header="Rechazados" :sortable="true"></Column>
          <Column field="inscritos" header="Inscritos" :sortable="true"></Column>
          <Column field="Proceso" header="Proceso" :sortable="true"></Column>
          <Column field="fecha" header="Fecha" :sortable="true"></Column>

        </DataTable>

      </div>
    </section>
  </AppLayout>
</template>

