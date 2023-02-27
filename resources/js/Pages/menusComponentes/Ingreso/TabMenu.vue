<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Ingreso from "@/Pages/menusComponentes/Ingreso/Ingreso.vue";

import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';

export default {
    components: {
        TabView,
        TabPanel,
        AppLayout,
        Ingreso,
    },
    props: {
        ingresos: Array,
    },
}
</script>

<template>
    <AppLayout title="Ingreso">
        <TabView ref="tabview1" class="p-3">
            <TabPanel header="Ingreso">
                <Ingreso :ingresos="ingresos" />
            </TabPanel>
            <TabPanel header="Doctorado">
                <p>Doctorado</p>
            </TabPanel>
            <TabPanel header="Maestria">
                <p>Maestria</p>
            </TabPanel>
        </TabView>
    </AppLayout>
</template>