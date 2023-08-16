<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Solicitudes from "@/Pages/menusComponentes/Transporte/Solicitudes.vue";
import Rutas from "@/Pages/menusComponentes/Transporte/Rutas.vue";
/*
import Ingreso from "@/Pages/menusComponentes/Ingreso/Ingreso.vue";
import Equivalencia from "@/Pages/menusComponentes/Ingreso/Equivalencia.vue";
import Maestrias from "@/Pages/menusComponentes/Ingreso/Maestrias.vue";
import NIngreso from "@/Pages/menusComponentes/Ingreso/NuevoIngreso.vue";
import Reingreso from "@/Pages/menusComponentes/Ingreso/Reingreso.vue";
*/

import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';

export default {
    components: {
        TabView,
        TabPanel,
        AppLayout,
        Solicitudes,
        Rutas,

    },
    props: {
        solicitudes: Array,
        rutas: Array,
    },
}
</script>

<template>
    <AppLayout title="Transporte">
        <TabView ref="tabview1" class="p-3">
            <TabPanel header="Solicitudes">
                <Solicitudes :solicitudes="solicitudes" />
            </TabPanel>
            <TabPanel header="Rutas">
                <Rutas :rutas="rutas" />
            </TabPanel>
        </TabView>
    </AppLayout>
</template>