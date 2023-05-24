<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Egresados from "@/Pages/menusComponentes/Egresados/Egresados.vue";
import Totales from "@/Pages/menusComponentes/Egresados/Totales.vue";
import TotalesGene from "@/Pages/menusComponentes/Egresados/TotalesGene.vue";
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';

export default {
    components: {
        TabView,
        TabPanel,
        AppLayout,
        Egresados,
        Totales,
        TotalesGene
    },
    props: {
        egresados: Array,
        totales: Array,
        totalesgene: Array
    },
}
</script>

<template>
    <AppLayout title="Egresados">
        <TabView ref="tabview1" class="p-3">
            <TabPanel header="Egresados">
                <Egresados :egresados="egresados" />
            </TabPanel>
            <TabPanel header="Carreras">
                <Totales :totales="totales" />
            </TabPanel>
            <TabPanel header="Generaciones">
                <TotalesGene :totalesgene="totalesgene" />
            </TabPanel>
        </TabView>
    </AppLayout>
</template>