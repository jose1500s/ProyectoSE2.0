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
        equivalencias2: Array,
    },
}
</script>

<template>
    <AppLayout title="Equivalencia">
        <TabView ref="tabview1" class="p-3">
            <TabPanel header="Equivalencia">
                <Equivalencia :equivalencias2="equivalencias2" />
            </TabPanel>
        </TabView>
    </AppLayout>
</template>