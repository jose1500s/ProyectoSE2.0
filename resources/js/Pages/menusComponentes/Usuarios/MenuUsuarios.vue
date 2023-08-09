<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Usuarios from "@/Pages/menusComponentes/Usuarios/Usuarios.vue";
import Roles from "@/Pages/menusComponentes/Usuarios/Roles.vue";

import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';

export default {
    components: {
        TabView,
        TabPanel,
        AppLayout,
        Usuarios,
        Roles,
    },
    props: {
        usuarios: Array,
        roles: Array,
        permisos: Array,
    },
}
</script>

<template>
    <AppLayout title="Usuarios">
        <TabView ref="tabview1" class="p-3">
            <TabPanel header="Usuarios">
                <Usuarios :usuarios="usuarios" :roles="roles" :permisos="permisos"/>
            </TabPanel>
            <TabPanel header="Roles">
                <Roles :usuarios="usuarios" :roles="roles" :permisos="permisos"/>
            </TabPanel>
        </TabView>
    </AppLayout>
</template>