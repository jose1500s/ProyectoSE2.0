<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import CustomerService from './service/CustomerService';
import { FilterMatchMode, FilterOperator } from 'primevue/api';
import InputText from 'primevue/inputtext';

export default {
  components: {
    AppLayout,
    DataTable,
    Column,
    InputText,

  },
  props: {
    ingresos: Array,
  },
  setup() {

  }


};
</script>

<template>
  <AppLayout title="Ingreso">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Ingreso</h2>
    </template>
    <section class="bg-white">
      <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-6 md:py-16 lg:px-8">
        <DataTable :value="ingresos" :paginator="true" class="p-datatable-customers" :rows="10">
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

