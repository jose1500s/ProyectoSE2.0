<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Egresados from "@/Pages/menusComponentes/Egresados/Egresados.vue";
import Totales from "@/Pages/menusComponentes/Egresados/Totales.vue";
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';

export default {
    components: {
        TabView,
        TabPanel,
        AppLayout,
        Egresados,
        Totales,
    },
    props: {
        egresados: Array,
        totales: Array,
    },
}
</script>

<template>
    <AppLayout title="Egresados">
        <TabView ref="tabview1" class="p-3">
            <TabPanel header="Egresados">
                <Egresados :egresados="egresados" />
            </TabPanel>
            <TabPanel header="Totales">
                <Totales :totales="totales" />
            </TabPanel>
        </TabView>
    </AppLayout>
</template>