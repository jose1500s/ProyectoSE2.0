<script>
import Chart from 'primevue/chart';
import { ref, watch } from 'vue'


export default {
    components: {
        Chart,
    },
    props: {
        data: {
            type: Array,
        },
    },
    mounted: function () {
        // si viene vacio el array data no se grafica
        if (this.data === null || this.data.length === 0) {
            return;
        }
        this.chartData = this.setChartData();
        this.chartOptions = this.setChartOptions();

    },
    created() {
        this.actualizarChartOptions(); // llama al método cuando se inicialice el componente
    },
    methods: {
        setChartData() {
            return {
                labels: this.data.map((item) => item.carrera + '-' + item.periodo),
                datasets: [
                    {
                        label: 'Aspirantes',
                        backgroundColor: '#FFB84C',
                        data: this.data.map((item) => item.aspirantes)
                    },
                    {
                        label: 'Hombres',
                        backgroundColor: '#36A2EB',
                        data: this.data.map((item) => item.hombres)
                    },
                    {
                        label: 'Mujeres',
                        backgroundColor: '#FF6384',
                        data: this.data.map((item) => item.mujeres)
                    },
                    {
                        label: 'Admitidos',
                        backgroundColor: '#4BC0C0',
                        data: this.data.map((item) => item.admitidos)
                    },
                    {
                        label: 'Examinados',
                        backgroundColor: '#7DB9B6',
                        data: this.data.map((item) => item.examinados)
                    },
                    {
                        label: 'No Admitidos',
                        backgroundColor: '#EB455F',
                        data: this.data.map((item) => item.no_admitidos)
                    },
                ]
            }
        },
        setChartOptions() {
            return {
                responsive: true,
                maintainAspectRatio: false,
                aspectRatio: 0.6,
                scales: {
                    x: {
                        stacked: true,
                    },
                    y: {
                        stacked: true
                    }
                },
                plugins: {
                    
                },
                indexAxis: this.orientacionGrafica ? this.orientacionGrafica : 'y',

            }
        },
        actualizarChartOptions() {
            this.chartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                aspectRatio: 0.6,
                scales: {
                    x: {
                        stacked: true,
                    },
                    y: {
                        stacked: true,
                    }
                },
                indexAxis: this.orientacionGrafica,
            };
        },

    },
    data() {
        return {
            chartData: null,
            chartOptions: null,
            tipoGrafica: '',
            orientacionGrafica: '',
        }
    },
}

</script>
<template>
    <div class="flex items-center gap-3 text-center" id="selects">
        <div>
            <select class="mb-5" v-model="tipoGrafica">
                <option value="">Tipo de grafica</option>
                <option value="pie">Pie</option>
                <option value="doughnut">doughnut</option>
                <option value="line">line</option>
                <option value="bar">Bar</option>
            </select>
        </div>
        <div v-if="tipoGrafica === 'bar'">
            <select class="mb-5 ml-3" v-model="orientacionGrafica" @change="actualizarChartOptions">
                <option value="">Orientación</option>
                <option value="y">Horizontal</option>
                <option value="x">Vertical</option>
            </select>
        </div>
    </div>

    <div v-if="data === null || data.length === 0" class="text-2xl text-center m-auto h-96 grid items-center">
        <h2>Seleccione datos para graficar</h2>
    </div>
    <div v-else-if="data.length <= 15">
        <Chart :type="tipoGrafica ? tipoGrafica : 'bar'" :data="chartData" :options="chartOptions" class="" />
    </div>
    <div v-else class="text-2xl text-center m-auto h-96 grid items-center">
        <h2>Demasiados datos seleccionados, máximo 10</h2>
    </div>
</template>

<style scoped>
.p-chart {
    max-height: 420px !important;
}
</style>
