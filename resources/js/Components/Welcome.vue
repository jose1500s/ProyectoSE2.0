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
                    backgroundColor: ["#913175", "#3F979B"],
                    hoverBackgroundColor: ["#CD5888", "#205E61"]
                }
            ]
        });

        const matriculaData = ref({
            labels: ['Negocios', 'PYMES' , 'Sistemas' , 'Automotriz', 'Mecatronica', 'Manufactura', 'Telematica'],
            datasets: [
                {
                    data: [647, 336, 409, 91, 471, 470, 143],
                    backgroundColor: ["black", "#1C315E", "yellow", "red", "pink", "gray", "#227C70"],
                    hoverBackgroundColor: ["black", "#227C70", "yellow", "red", "pink", "gray", "#88A47C"]
                }
            ]
        });

        const bajasData = ref({
            labels: ['Temporal', 'Voluntaria', 'Académica', 'Administrativa'],
            datasets: [
                {
                    data: [34, 124, 12, 5],
                    backgroundColor: ["#42A5F5", "#66BB6A", "#FFA726", "#EF5350"],
                    hoverBackgroundColor: ["#64B5F6", "#81C784", "#FFB74D", "#E57373"]
                }
            ]
        });

        const lightOptions = ref({
            plugins: {
                legend: {
                    labels: {
                        color: '#495057',
                    }
                }
            },
            responsive: true,
        });

        return { ingresosData, matriculaData, bajasData, lightOptions }
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
