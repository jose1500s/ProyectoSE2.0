<script>
import Card from 'primevue/card';
import Chart from 'primevue/chart';
import { ref } from "vue";
import {Link} from '@inertiajs/vue3'
export default {
    components: {
        Card,
        Chart,
        Link,
    },
    setup() {

        const ingresosData = ref({
            labels: ['Mujeres', 'Hombres'],
            datasets: [
                {
                    
                
                    data: [2230, 2960],
                    backgroundColor: ["pink", "blue"],
                    hoverBackgroundColor: ["pink", "blue"],
                    porcentajes: []
                }
            ]
        });

        const totalIngresos = ingresosData.value.datasets[0].data.reduce((acc, val) => acc + val);
        ingresosData.value.datasets[0].porcentajes = ingresosData.value.datasets[0].data.map(val => Math.round((val / totalIngresos) * 100));
        const ingresos = ingresosData.value.datasets[0].porcentajes;

        const matriculaData = ref({
            labels: ['Negocios', 'Administración' , 'Sistemas' , 'Automotriz', 'Mecatronica', 'Manufactura', 'Telematica'],
            datasets: [
                {
                    data: [647, 336, 409, 91, 471, 510, 143],
                    backgroundColor: ["black", "blue", "yellow", "red", "pink", "gray", "green"],
                    hoverBackgroundColor: ["black", "blue", "yellow", "red", "pink", "gray", "green"],
                    porcentajes: []
                }
            ]
        });

        const totalMatricula = matriculaData.value.datasets[0].data.reduce((acc, val) => acc + val);
        matriculaData.value.datasets[0].porcentajes = matriculaData.value.datasets[0].data.map(val => Math.round((val / totalMatricula) * 100));
        const matricula = matriculaData.value.datasets[0].porcentajes;
        

        const bajasData = ref({
            datasets: [
                {
                    data: [34, 124, 12, 5],
                    backgroundColor: ["#42A5F5", "#66BB6A", "#FFA726", "#EF5350"],
                    hoverBackgroundColor: ["#64B5F6", "#81C784", "#FFB74D", "#E57373"],
                    porcentajes: []
                }
            ],
            labels: ['Temporal', 'Voluntaria', 'Académica', 'Administrativa']
        });

        const totalBajas = bajasData.value.datasets[0].data.reduce((acc, val) => acc + val);
        bajasData.value.datasets[0].porcentajes = bajasData.value.datasets[0].data.map(val => Math.round((val / totalBajas) * 100));
        const bajas = bajasData.value.datasets[0].porcentajes;

        const lightOptions = ref({
            plugins: {
                legend: {
                    labels: {
                        color: '#495057',
                    }
                }
            },
            generateLabels: (chart) => {
                const data = chart.data.datasets[0];
                return data.labels.map((label,i) => {
                    const value = data.porcentajes[i];
                    return {
                        text: `${label}: ${value}%`,
                        fillStyle: data.backgroundColor[i],
                        hidden: isNaN(value) || chart.getDatasetMeta(0).data[i].hidden,
                        index: i
                    }
                }
        )},
            responsive: true,
        });

        return { ingresosData, matriculaData, bajasData, lightOptions, ingresos, matricula,bajas }
    }
}
</script>

<template>
    <section class="bg-white">
        <div class="mx-auto max-w-screen-xl px-4 sm:px-6 md:py-16 lg:px-8">
            <div class="w-full text-center">
                <!-- {{ $page.props.user.name}} -->
                <div class="flex flex-col justify-between gap-6" id="upSide">
                    <div class="titulo">
                        <div class="text-3xl font-bold" id="nombreDashboard">
                            <h2>Bienvenido {{ $page.props.user.name }}</h2>
                        </div>
                        <div class="text-lg mt-4" id="parrafoDashboard">
                            Aqui podras ver un resumen de todos los indicadores actuales.
                        </div>
                    </div>
                    <div class="tarjetas flex justify-center gap-10 flex-wrap">

                   
                        <Card style="width: 20rem; margin-bottom: 2em" class="transform hover:scale-105 duration-100">
                            
                            <template #title>
                                <Link :href="route('usuario.ingreso')">
                                Ingreso
                                </Link>
                            </template>
                            
                            <template #content>
                                <!-- aqui va la grafica de matricula -->
                                <div class="" id="contenedorGrafica">
                                    <Chart type="doughnut" :data="ingresosData" :options="lightOptions" />
                                    <p>Hombres: {{ ingresos[0] }}%
                                    Mujeres: {{ ingresos[1] }}%</p>
                                </div>
                            </template>
                        </Card>
                    

                    
                        <Card style="width: 20rem; margin-bottom: 2em" class="transform hover:scale-105 duration-100">
                            <template #title>
                                <Link :href="route('usuario.bajas')">
                                Bajas
                                </Link>
                            </template>
                            <template #content>
                                <!-- aqui la grafica de bajas -->
                                <div class="" id="contenedorGrafica">
                                    <Chart type="doughnut" :data="bajasData" :options="lightOptions" />
                                    <p>Voluntaria: {{ bajas[1] }}%
                                    Temporal: {{ bajas[0] }}%
                                    Académica: {{ bajas[2] }}%
                                    Administrativa: {{ bajas[3] }}%</p>
                                </div>
                            </template>
                        </Card>
                    

                    
                        <Card style="width: 20rem; margin-bottom: 2em" class="transform hover:scale-105 duration-100">
                            <template #title>
                                <Link :href="route('usuario.matricula')">
                                Matrícula
                                </Link>
                            </template>
                            <template #content>
                                <!-- aqui va la grafica de matricula -->
                                <div class="" id="contenedorGrafica">
                                    <Chart type="doughnut" :data="matriculaData" :options="lightOptions" />
                                    <p>Negocios: {{ matricula[0] }}%
                                    Manufactura: {{ matricula[5] }}%
                                    Mecatrónica: {{ matricula[4] }}%
                                    Sistemas: {{ matricula[2] }}%
                                    Administración: {{ matricula[1] }}%
                                    Telemática: {{ matricula[6] }}%
                                    Automotriz: {{ matricula[5] }}%</p>
                                </div>
                            </template>
                        </Card>
                    
                    
                    </div>
                </div>
                <div id="downSide" class="flex justify-between gap-4">
                    <div class="downSide__left">
                        <div id="downSide__card">
                            <div class="titulo">
                                
                            </div>
                        </div>
                    </div>
                    <div class="right">
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
Card {
    cursor: pointer;
}
</style>
