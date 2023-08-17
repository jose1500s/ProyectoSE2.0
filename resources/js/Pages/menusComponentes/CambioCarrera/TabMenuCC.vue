<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import CambioCarrera from "@/Pages/menusComponentes/CambioCarrera/CambioCarrera.vue";

import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';

export default {
    components: {
        TabView,
        TabPanel,
        AppLayout,
        CambioCarrera,
    },
    props: {
        dataCambioCarreras: Array,
    },
}
</script>

<template>
    <AppLayout title="CambioCarrera">
        <TabView ref="tabview1" class="p-3">
            <TabPanel header="Cambio de Carrera">
                <CambioCarrera :dataCambioCarreras="dataCambioCarreras" />
            </TabPanel>
        </TabView>
    </AppLayout>
</template>