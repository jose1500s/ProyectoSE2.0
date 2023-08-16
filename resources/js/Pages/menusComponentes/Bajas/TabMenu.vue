<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Temporal from "./Temporal.vue";
import Voluntaria from "./Volunaria.vue";
import Academica from "./Academica.vue";
import Administrativa from "./Administrativa.vue";
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';

export default {
    components: {
        TabView,
        TabPanel,
        AppLayout,
        Temporal,
        Voluntaria,
        Academica,
        Administrativa,
    },
    props: {
        temporal: Array,
        voluntaria: Array,
        academica: Array,
        administrativa: Array,
    },
}
</script>

<template>
    <AppLayout title="Bajas">
        <TabView ref="tabview1" class="p-3">
            <TabPanel header="Temporal">
                <Temporal :temporal="temporal" />
            </TabPanel>
            <TabPanel header="Voluntaria">
                <Voluntaria :voluntaria="voluntaria"/>
            </TabPanel>
            <TabPanel header="Académica">
                <Academica :academica="academica"/>
            </TabPanel>
            <TabPanel header="Administrativa">
                <Administrativa :administrativa="administrativa"/>
            </TabPanel>
        </TabView>
    </AppLayout>
</template>