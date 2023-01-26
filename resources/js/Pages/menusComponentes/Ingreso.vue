<template>
  <AppLayout title="Ingreso">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Ingreso</h2>
    </template>
    <section class="bg-white">
      <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-6 md:py-16 lg:px-8">
        <div class="max-w-md mx-auto">
          <Chart type="doughnut" :data="chartData" :options="lightOptions" />
        </div>
      </div>
    </section>
  </AppLayout>
</template>

<script>
import { ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Chart from "primevue/chart";
import { Head, Link, router } from "@inertiajs/vue3";

export default {
  setup() {
    const chartData = ref({
      labels: ["A", "B", "C"],
      datasets: [
        {
          data: [300, 50, 100],
          backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56"],
          hoverBackgroundColor: ["#FF6384", "#36A2EB", "#FFCE56"],
        },
      ],
    });

    const lightOptions = ref({
      plugins: {
        legend: {
          labels: {
            color: "#495057",
          },
        },
      },
    });

    return { chartData, lightOptions };
  },
  components: {
    AppLayout,
    Chart,
  },
};
</script>