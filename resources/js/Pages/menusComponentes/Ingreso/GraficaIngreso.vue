<script>
import Chart from 'primevue/chart';
export default {
    components: {
        Chart,
    },
    props: {
        carrerasFiltradas: {
            type: Array,
            required: true,
        },
        datosProcesoFiltro: {
            type: Array,
            required: true,
        },
    }, 
    mounted: function () {
        // verificar si estan llegando el array carrerasFiltradas como props
        console.log(this.carrerasFiltradas);
        console.log(this.datosProcesoFiltro);

    },
    methods: {

    },
    data() {
        return {
            chartData: {
                labels: this.carrerasFiltradas.map(item => item.carrera),

                datasets: [
                {
                    label: 'Aspirantes',
                    data: this.carrerasFiltradas.map(item => item.aspirantes),
                    backgroundColor: 'rgba(255,99,132,0.2)',
                    borderColor: '#FF6384',
                    borderWidth: 1,
                    tension: 0.4,
                    pointStyle: 'rectRot', 
                    pointRadius: 7,
                    fill: true
                },
                {
                    label: 'Examinados',
                    data: this.carrerasFiltradas.map(item => item.examinados),
                    backgroundColor: 'rgba(255,159,64,0.2)',
                    borderColor: '#FF6384',
                    borderWidth: 1,
                    tension: 0.4,
                    pointStyle: 'rectRot', 
                    pointRadius: 7,
                    fill: true
                },
                {
                    label: 'No Admitidos',
                    data: this.carrerasFiltradas.map(item => item.no_admitidos),
                    backgroundColor: 'rgba(255,159,64,0.2)',
                    borderColor: '#FF6384',
                    borderWidth: 1,
                    tension: 0.4,
                    pointStyle: 'rectRot', 
                    pointRadius: 7,
                    fill: true
                },
                ]

            },
            chartOptions: {
                responsive: true,
                maintainAspectRatio: true,
               
            },
        }
    }
}

</script>
<template>
    <div class="card">
        <chart type="bar" :data="chartData" :options="chartOptions" />
    </div>
</template>

