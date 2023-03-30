<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Titulados from "@/Pages/menusComponentes/Titulo/Titulacion.vue";
import Estatus from "@/Pages/menusComponentes/Titulo/Estatus.vue";

import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';

export default {
    components: {
        TabView,
        TabPanel,
        AppLayout,
        Titulados,
        Estatus,
    },
    props: {
        titulados: Array,
    },
}
</script>

<template>
    <AppLayout title="Ingreso">
        <TabView ref="tabview1" class="p-3">
            <TabPanel header="Titulados">
                <Titulados :titulados="titulados" />
            </TabPanel>
            <TabPanel header="Estatus">
                <Estatus />
            </TabPanel>
        </TabView>
    </AppLayout>
</template>