<script>
import Card from 'primevue/card';
import Chart from 'primevue/chart';
import { ref } from "vue";
import {Link} from '@inertiajs/vue3';
import Tag from 'primevue/tag';


export default {
    components: {
        Card,
        Chart,
        Link,
        Tag,
    },
    setup() {

        const ingresosData = ref({
            labels: ['Mujeres', 'Hombres'],
            datasets: [
                {
                    data: [2230, 2960],
                    backgroundColor: ["#f24a57", "#0f6ec5"],
                    hoverBackgroundColor: ["#f24a57", "#0f6ec5"],
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
                    backgroundColor: ["#000000", "#d60212", "#05d3f8", "#5b1d99", "#9f102c", "#19058f", "#aef055"],
                    hoverBackgroundColor: ["#000000", "#d60212", "#05d3f8", "#5b1d99", "#9f102c", "#19058f", "#aef055"],
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
                    backgroundColor: ["#00686c", "#32c2b9", "#fad928", "#ff9915"],
                    hoverBackgroundColor: ["#00686c", "#32c2b9", "#fad928", "#ff9915"],
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
            responsive: true,
        });

        return { ingresosData, matriculaData, bajasData, lightOptions, ingresos, matricula,bajas }
    }
}
</script>

<template>
    <section class="bg-white">
        <div class="mx-auto max-w-screen-xl px-4 sm:px-6  lg:px-8">
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
                                    <div>
                                        <br>                                             
                                        <Tag class="mr-3 etiquetamujer" icon="pi pi-user"> Mujeres: {{ ingresos[0] }}%</Tag>
                                        <Tag class="mr-3 etiquetahombre" icon="pi pi-user"> Hombres: {{ ingresos[1] }}%</Tag>
                                    </div>

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
                                    <br>
                                    <Tag class="mr-3 etiquetavoluntaria">Voluntaria: {{ bajas[1] }}%</Tag>
                                    <Tag class="mr-3 etiquetatemporal">Temporal: {{ bajas[0] }}%</Tag><br><br>
                                    <Tag class="mr-3 etiquetaacademica">Académica: {{ bajas[2] }}%</Tag>
                                    <Tag class="mr-3 etiquetaadministrativa">Administrativa: {{ bajas[3] }}%</Tag>
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
                                    <br>
                                    <Tag class="mr-3 etiquetanegocios">Negocios: {{ matricula[0] }}%</Tag>
                                    <Tag class="mr-3 etiquetaadministracion">Administración: {{ matricula[1] }}%</Tag>
                                    <Tag class="mr-3 etiquetasistemas">Sistemas: {{ matricula[2] }}%</Tag>
                                    <Tag class="mr-3 etiquetaautomotriz">Automotriz: {{ matricula[3] }}%</Tag>
                                    <Tag class="mr-3 etiquetamecatronica"> Mecatrónica: {{ matricula[4] }}%</Tag>
                                    <Tag class="mr-3 etiquetamanufactura">Manufactura: {{ matricula[5] }}%</Tag>
                                    <Tag class="mr-3 etiquetatelematica">Telemática: {{ matricula[6] }}%</Tag>
                                    
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
.p-tag {
    margin: 0.5em 0.3em 0.5em 0.3em;
    padding: 0.5em;
    border-radius: 3px;
    font-size: 0.85em;
    font-weight: 600;
}
.etiquetahombre	{
   background-color: #0f6ec5	;
}
.etiquetamujer    {
   background-color: #f24a57	;
}
.etiquetavoluntaria    {
   background-color: #32c2b9	;
}
.etiquetatemporal    {
   background-color: #00686c	;
}
.etiquetaacademica{
    background-color: #fad928;
}
.etiquetaadministrativa{
    background-color: #ff9915;
}
.etiquetanegocios{
    background-color: #000000;
}
.etiquetamanufactura{
    background-color: #19058f;
}
.etiquetamecatronica{
    background-color: #9f102c;
}
.etiquetasistemas{
    background-color: #05d3f8;
}
.etiquetaadministracion{
    background-color: #d60212;
}
.etiquetatelematica{
    background-color: #aef055;
}
.etiquetaautomotriz{
    background-color: #5b1d99;
}




</style>
