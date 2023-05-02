<script>
import Chart from 'primevue/chart';
export default {
    components: {
        Chart,
    },
    props: {
        equiva: Array,
    },
    methods: {
        filtrarCarreras() {
            // filtar del arreglo ingresos.carrera, todos los que se repiten
            // y retornar un arreglo con los nombres de las carreras sin repetir
            const carreras = this.ingresos.map(item => item.carrera);
            const carrerasFiltradas = [...new Set(carreras)];
            return carrerasFiltradas;
        },
    },
    data() {
        return {
            chartData: {
                // filtrar primero las carreras para que no se repitan
                labels: this.filtrarCarreras(),
                datasets: [
                    {
                        label: 'Aspirantes',
                        data: this.ingresos.map(item => item.aspirantes),
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
                        data: this.ingresos.map(item => item.examinados),
                        backgroundColor: 'rgba(54,162,235,0.2)',
                        borderColor: '#36A2EB',
                        borderWidth: 1,
                        tension: 0.4,
                        pointStyle: 'rectRot',
                        pointRadius: 7, 
                        fill: true
                    },
                    {
                        label: 'Admitidos',
                        data: this.ingresos.map(item => item.admitidos),
                        backgroundColor: 'rgba(255,167,38,0.2)',
                        borderColor: '#FFCE56',
                        borderWidth: 1,
                        tension: 0.4,
                        pointStyle: 'rectRot',
                        pointRadius: 7, 
                        fill: true
                    },
                    {
                        label: 'Rechazados',
                        data: this.ingresos.map(item => item.rechazados),
                        backgroundColor: 'rgba(75,192,192,0.2)',
                        borderColor: '#4BC0C0',
                        borderWidth: 1,
                        tension: 0.4,
                        pointStyle: 'rectRot',
                        pointRadius: 7, 
                        fill: true     
                    },
                    {
                        label: 'Inscritos',
                        data: this.ingresos.map(item => item.inscritos),
                        backgroundColor: 'rgba(255,159,64,0.2)',
                        borderColor: '#FF9F40',
                        borderWidth: 1,
                        tension: 0.4, 
                        pointStyle: 'rectRot',
                        pointRadius: 7,
                        fill: true     
                    },
                ],
            },
            chartOptions: {
                responsive: true,
                maintainAspectRatio: true, // esto es para que el grafico se ajuste al tamaño de la pantalla
            
            },
        }
    }
}

</script>

<template>
    <div class="card">
        <chart type="line" :data="chartData" :options="chartOptions" />
    </div>
</template>