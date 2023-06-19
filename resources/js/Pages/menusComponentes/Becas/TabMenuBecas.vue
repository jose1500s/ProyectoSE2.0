<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Excelencia from "./Excelencia.vue";
import Apoyo from "./Apoyo.vue";
import Proyecto from "./Proyecto.vue";
import Azul from "./Azul.vue";
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';

export default {
    components: {
        TabView,
        TabPanel,
        AppLayout,
        Excelencia,
        Apoyo,
        Proyecto,
        Azul,
    },
    props: {
        excelencia: Array,
        apoyo: Array,
        proyecto: Array,
        azul: Array,
    },
}
</script>

<template>
    <AppLayout title="Becas">
        <TabView ref="tabview1" class="p-3">
            <TabPanel header="Beca excelencia académica">
                <Excelencia :excelencia="excelencia" />
            </TabPanel>
            <TabPanel header="Beca Apoyo Cardenal">
                <Apoyo :apoyo="apoyo" />
            </TabPanel>
            <TabPanel header="Beca por proyecto">
                <Proyecto :proyecto="proyecto" />
            </TabPanel>
            <TabPanel header="Beca cardenal azul">
                <Azul :azul="azul" />
            </TabPanel>
        </TabView>
    </AppLayout>
</template>