<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import InputText from "primevue/inputtext";
import Row from "primevue/row";
import Button from "primevue/button";
import { FilterMatchMode, FilterService } from "primevue/api";
import MultiSelect from "primevue/multiselect";
import Chart from "primevue/chart";
import Dialog from "primevue/dialog";
import Toast from "primevue/toast";
import ConfirmDialog from "primevue/confirmdialog";
import Toolbar from "primevue/toolbar";
import Dropdown from "primevue/dropdown";
import InputNumber from "primevue/inputnumber";

export default {
       components: {
        AppLayout,
        DataTable,
        Column,
        InputText,
        Row,
        Button,
        MultiSelect,
        Chart,
        Dialog,
        Toast,
        ConfirmDialog,
        Toolbar,
        Dropdown,
        InputNumber,
    },
    props: {
        totales: Array,
    },
    setup() {
        
    },
}
</script>

<template>
    <p>aqui va la tabla xdd</p>
</template>