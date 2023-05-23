<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Titulados from "@/Pages/menusComponentes/Titulo/Titulacion.vue";
import Totales from "@/Pages/menusComponentes/Titulo/Totales.vue";

import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';

export default {
    components: {
        TabView,
        TabPanel,
        AppLayout,
        Titulados,
        Totales
    },
    props: {
        titulados: Array,
        totales: Array
    },
}
</script>

<template>
    <AppLayout title="Titulados">
        <TabView ref="tabview1" class="p-3">
            <TabPanel header="Titulados">
                <Titulados :titulados="titulados" />
            </TabPanel>
            <TabPanel header="Totales">
                <Totales :totales="totales" />
            </TabPanel>
        </TabView>
    </AppLayout>
</template>