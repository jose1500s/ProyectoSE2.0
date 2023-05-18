<script>
import Chart from 'primevue/chart';
export default {
    components: {
        Chart,
    },
    props: {
        carrerasFiltradas: {
            type: Array,
        },
    },
    mounted: function () {
        // verificar si estan llegando el array carrerasFiltradas como props
        console.log(this.carrerasFiltradas);
        console.log(this.admisionesTodosLosRegistros);

    },

    created() {
        if (this.carrerasFiltradas.length > 0) {
            this.chartData = {
                labels: this.carrerasFiltradas.map(item => item.carrera + ' - ' + item.periodo),


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
                ],

            },
                this.chartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        title: {
                            display: true,
                            text: 'Carreras: ' + this.carrerasFiltradas
                                .map(item => item.carrera) // Obtener la lista de carreras
                                .filter((value, index, self) => self.indexOf(value) === index) // Filtrar carreras únicas
                                .join(', '), // Unir carreras en una cadena separada por comas
                            font: {
                                size: 17,
                            },
                            // colores de el titulo de la grafica
                            color: '#000000',
                        },
                    },
                    // que las barras esten en horizontal
                    indexAxis: 'y',
                }
        }
    },
    methods: {

    },
    data () {
        return {
           
        }
    },
}

</script>
<template>
    <div class="card">
        <div v-if="carrerasFiltradas.length == 0">
            <div id="divError">
                <h2>Sin datos para graficar, seleccione la carrera e intente de nuevo</h2>
            </div>
        </div>
        <div v-else>
            <chart type="bar" :data="chartData" :options="chartOptions" />
        </div>

    </div>
</template>

<style scoped>
#divError {
    display: grid;
    place-items: center;
    min-height: 400px;
}

#divError h2 {
    color: #000000;
    font-size: 20px;
    font-weight: 600;
}
</style>
