<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Equivalencia from "@/Pages/menusComponentes/Equivalencia/SeguroFacultativo.vue";
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';

export default {
    components: {
        TabView,
        TabPanel,
        AppLayout,
        Equivalencia,
    },
    props: {
        equiva: Array,
    },
}
</script>

<template>
    <AppLayout title="Equivalencia">
        <TabView ref="tabview1" class="p-3">
            <TabPanel header="Equivalencia">
                <Equivalencia :equiva="equiva" />
            </TabPanel>
        </TabView>
    </AppLayout>
</template>