<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Matricula from "@/Pages/menusComponentes/Matricula/Matricula.vue";

import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';

export default {
    components: {
        TabView,
        TabPanel,
        AppLayout,
        Matricula,
    },
    props: {
        dataMatriculas: Array,
    },
}
</script>

<template>
    <AppLayout title="Matricula">
        <TabView ref="tabview1" class="p-3">
            <TabPanel header="Matricula">
                <Matricula :dataMatriculas="dataMatriculas" />
            </TabPanel>
        </TabView>
    </AppLayout>
</template>