<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Ingreso from "@/Pages/menusComponentes/Ingreso/Ingreso.vue";
import Equivalencia from "@/Pages/menusComponentes/Ingreso/Equivalencia.vue";
import Maestrias from "@/Pages/menusComponentes/Ingreso/Maestrias.vue";
import NIngreso from "@/Pages/menusComponentes/Ingreso/NuevoIngreso.vue";
import Reingreso from "@/Pages/menusComponentes/Ingreso/Reingreso.vue";

import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';

export default {
    components: {
        TabView,
        TabPanel,
        AppLayout,
        Ingreso,
        Equivalencia,
        Maestrias,
        NIngreso,
        Reingreso,
    },
    props: {
        ingresos: Array,
        maestrias: Array,
        equivalencias: Array,
        ningresos: Array,
        reingresos: Array,
    },
}
</script>

<template>
    <AppLayout title="Ingreso">
        <TabView ref="tabview1" class="p-3">
            <TabPanel header="Admision">
                <Ingreso :ingresos="ingresos" />
            </TabPanel>
            <TabPanel header="Nuevo Ingreso">
                <NIngreso :ningresos="ningresos" />
            </TabPanel>
            <TabPanel header="Reingreso">
                <Reingreso :reingresos="reingresos" />
            </TabPanel>
            <TabPanel header="Equivalencia">
                <Equivalencia :equivalencias="equivalencias" />
            </TabPanel>
            <TabPanel header="Maestrias">
                <Maestrias :maestrias="maestrias" />
            </TabPanel>
        </TabView>
    </AppLayout>
</template>