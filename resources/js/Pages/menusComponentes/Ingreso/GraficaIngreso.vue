<script>
import Chart from 'primevue/chart';
export default {
    components: {
        Chart,
    },
    props: {
        ingresos: Array,
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
                        backgroundColor: '#FF6384',
                        borderColor: '#FF6384',
                        borderWidth: 1,
                        tension: 0.4, 
                    },
                    {
                        label: 'Examinados',
                        data: this.ingresos.map(item => item.examinados),
                        backgroundColor: '#36A2EB',
                        borderColor: '#36A2EB',
                        borderWidth: 1,
                        tension: 0.4, 
                    },
                    {
                        label: 'Admitidos',
                        data: this.ingresos.map(item => item.admitidos),
                        backgroundColor: '#FFCE56',
                        borderColor: '#FFCE56',
                        borderWidth: 1,
                        tension: 0.4, 
                    },
                    {
                        label: 'Rechazados',
                        data: this.ingresos.map(item => item.rechazados),
                        backgroundColor: '#4BC0C0',
                        borderColor: '#4BC0C0',
                        borderWidth: 1,
                        tension: 0.4, 
                    },
                    {
                        label: 'Inscritos',
                        data: this.ingresos.map(item => item.inscritos),
                        backgroundColor: '#FF9F40',
                        borderColor: '#FF9F40',
                        borderWidth: 1,
                        tension: 0.4, 
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

