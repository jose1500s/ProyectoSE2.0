import{A as S,s as A,a as M,b as I}from"./AppLayout-d1333a90.js";import N from"./GraficaIngreso-688c277d.js";import{s as E,a as U,b as T,c as R}from"./datatable.esm-789c8773.js";import{s as B,a as G,b as j,c as L}from"./toolbar.esm-92c3a35d.js";import{a as F}from"./button.esm-256f0b79.js";import{a6 as b,f as x,b as t,w as d,a as i,F as z,y as n,o as y,m as V,j as C,t as Y,h as q}from"./app-1b8d8cba.js";import{s as H}from"./chart.esm-58fe6bc4.js";import{_ as J}from"./_plugin-vue_export-helper-c27b6911.js";const K={components:{AppLayout:S,DataTable:E,Column:B,InputText:U,Row:G,Button:F,MultiSelect:j,Chart:H,Dialog:A,GraficaIngreso:N,Toast:M,ConfirmDialog:I,Toolbar:L,Dropdown:T,InputNumber:R},props:{ingresos:Array},setup(){},methods:{filtrarCarreras(){return["Negocios","Administración","Sistemas","Automotriz","Mecatrónica","Manufactura","Telemática"]},filtrarProcesos(){return["1er Proceso","2do Proceso","3er Proceso"]},filtrarFecha(){return["SEP-DIC"]},exportCSV(){this.$refs.dt.exportCSV()},limpiarFiltros(){this.filters.carrera.value=null,this.filters.Proceso.value=null,this.filters.fecha.value=null,this.$refs.dt.filter(this.filters,"carrera"),this.$refs.dt.filter(this.filters,"Proceso"),this.$refs.dt.filter(this.filters,"fecha")},openResponsive(){this.displayResponsive=!0},closeResponsive(){this.displayResponsive=!1},saveImage(){const p=document.getElementById("contenedorGrafica").getElementsByTagName("canvas")[0].toDataURL("image/png"),f=document.createElement("a");f.download="GraficaIngreso.png",f.href=p,f.click()},confirm1(){this.$confirm.require({message:"Are you sure you want to proceed?",header:"Confirmation",icon:"pi pi-exclamation-triangle",accept:()=>{this.$toast.add({severity:"info",summary:"Confirmed",detail:"You have accepted",life:3e3})},reject:()=>{this.$toast.add({severity:"error",summary:"Rejected",detail:"You have rejected",life:3e3})}})},openNew(){this.product={},this.submitted=!1,this.productDialog=!0},hideDialog(){this.productDialog=!1,this.submitted=!1},registrarAdmision(){if(this.submitted=!0,this.carreras==null||this.aspirantes==0||this.examinados==0||this.noAdmitidos==0||this.periodos==null)return this.$toast.add({severity:"error",summary:"Error",detail:"Todos los campos son obligatorios",life:3e3}),!1;{const r={carreras:this.carreras,aspirantes:this.aspirantes,examinados:this.examinados,noAdmitidos:this.noAdmitidos,periodos:this.periodos};this.$inertia.post("/registro-Admision",r,{preserveState:!0,preserveScroll:!0,onSuccess:()=>{this.productDialog=!1,this.$toast.add({severity:"success",summary:"Exito",detail:"Registro exitoso",life:3e3})}})}},editarAdmision(){if(this.submitted=!0,this.product.id==0||this.product.carrera==null||this.product.aspirantes==0||this.product.examinados==0||this.product.no_admitidos==0||this.product.periodo==null)return this.$toast.add({severity:"error",summary:"Error",detail:"Todos los campos son obligatorios",life:3e3}),!1;{const r={id:this.product.id,carrera:this.product.carrera,aspirantes:this.product.aspirantes,examinados:this.product.examinados,no_admitidos:this.product.no_admitidos,periodo:this.product.periodo};this.$inertia.post(`/editar-Admision/${this.product.id}`,r,{preserveState:!0,preserveScroll:!0,onSuccess:()=>{this.editDialog=!1,this.$toast.add({severity:"success",summary:"Exito",detail:"Actualizado exitosamente",life:3e3})}})}},editProduct(r){this.product={...r},this.editDialog=!0},confirmDeleteProduct(r){this.product=r,this.deleteProductDialog=!0},deleteProduct(){const r={id:this.product.id};this.$inertia.post(`/eliminar-Admision/${this.product.id}`,r,{preserveState:!0,preserveScroll:!0,onSuccess:()=>{this.deleteProductDialog=!1,this.product={},this.$toast.add({severity:"success",summary:"Exito",detail:"Eliminado exitosamente",life:3e3})}})},deleteSelectedProducts(){const r={id:this.selectedProducts.map(e=>e.id)};this.$inertia.post("/eliminar-Admisiones",r,{preserveState:!0,preserveScroll:!0,onSuccess:()=>{this.deleteProductsDialog=!1,this.$toast.add({severity:"success",summary:"Exito",detail:"Eliminado exitosamente",life:3e3})}})},confirmDeleteSelected(){this.deleteProductsDialog=!0}},data(){return{filters:{carrera:{value:null,matchMode:b.IN},Proceso:{value:null,matchMode:b.IN},periodo:{value:null,matchMode:b.IN}},noDataMessage:"No se encontraron datos",displayResponsive:!1,carrerasLista:[{name:"Manufactura",code:"Manufactura"},{name:"Mecatronica",code:"Mecatronica"},{name:"Negocios",code:"Negocios"},{name:"Procesos",code:"Procesos"},{name:"Pymes",code:"Pymes"},{name:"Sistemas",code:"Sistemas"},{name:"Telematica",code:"Telematica"}],periodosLista:[{name:"SEP-DIC",code:"SEP-DIC"}],carreras:null,periodos:null,aspirantes:0,examinados:0,noAdmitidos:0,productDialog:!1,editDialog:!1,deleteProductDialog:!1,selectedProducts:null,deleteProductsDialog:!1}}},O={class:"field"},Q={class:"field col-12 md:col-3"},W=i("label",{for:"minmax"},"Aspirantes",-1),X={class:"field col-12 md:col-3"},Z=i("label",{for:"minmax"},"Examinados",-1),$={class:"field col-12 md:col-3"},ee=i("label",{for:"minmax"},"No Admitidos",-1),oe={class:"field col-12 md:col-3 mt-3"},te=i("span",null," Registrar ",-1),ie=i("span",null,[i("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24",fill:"currentColor",class:"h-6 w-6"},[i("path",{"fill-rule":"evenodd",d:"M16.72 7.72a.75.75 0 011.06 0l3.75 3.75a.75.75 0 010 1.06l-3.75 3.75a.75.75 0 11-1.06-1.06l2.47-2.47H3a.75.75 0 010-1.5h16.19l-2.47-2.47a.75.75 0 010-1.06z","clip-rule":"evenodd"})])],-1),se={class:"bg-white",id:"tablaIngreso"},re={class:"mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8 p-[20px]"},le={class:"text-center mb-5"},ae={class:"flex gap-5 justify-center flex-wrap"},de={class:"w-full",id:"contenedorGrafica"},ne=i("div",{class:"flex justify-center align-middle text-xl"},[i("h2",null,"No se encontraron datos")],-1),ue={class:"p-fluid p-formgrid p-grid"},ce={class:"p-field p-col-12 p-md-6"},me=i("label",{for:"carrera"},"Carrera",-1),pe={class:"p-field p-col-12 p-md-6"},fe=i("label",{for:"aspirantes"},"Aspirantes",-1),he={class:"p-field p-col-12 p-md-6"},ve=i("label",{for:"examinados"},"Examinados",-1),be={class:"p-field p-col-12 p-md-6"},ge=i("label",{for:"no_admitidos"},"No Admitidos",-1),xe={class:"p-field p-col-12 p-md-6"},ye=i("label",{for:"periodo"},"Periodo",-1),Ve={class:"confirmation-content flex justify-center items-center"},Ce=i("i",{class:"pi pi-exclamation-triangle mr-3",style:{"font-size":"2rem"}},null,-1),we={key:0},_e=i("div",{class:"confirmation-content flex items-center justify-center"},[i("i",{class:"pi pi-exclamation-triangle mr-3",style:{"font-size":"2rem"}}),i("span",null," ¿Confirma eliminar los registros seleccionados? ")],-1);function De(r,e,p,f,s,l){const a=n("Button"),w=n("Toolbar"),g=n("Dropdown"),h=n("InputNumber"),m=n("Dialog"),_=n("Toast"),D=n("GraficaIngreso"),v=n("MultiSelect"),u=n("Column"),P=n("DataTable"),c=n("InputText");return y(),x(z,null,[t(w,{class:"mb-4"},{start:d(()=>[t(a,{label:"Nuevo Registro",icon:"pi pi-plus",class:"p-button-success !mr-2",onClick:l.openNew},null,8,["onClick"]),t(a,{label:"Eliminar",icon:"pi pi-trash",class:"p-button-danger",onClick:l.confirmDeleteSelected,disabled:!s.selectedProducts||!s.selectedProducts.length},null,8,["onClick","disabled"])]),_:1}),t(m,{visible:s.productDialog,"onUpdate:visible":e[6]||(e[6]=o=>s.productDialog=o),breakpoints:{"960px":"75vw","640px":"85vw"},style:{width:"25vw"},header:"Nuevo Registro",modal:!0,class:"p-fluid"},{default:d(()=>[i("div",O,[i("form",{onSubmit:e[5]||(e[5]=V((...o)=>l.registrarAdmision&&l.registrarAdmision(...o),["prevent"]))},[t(g,{modelValue:s.carreras,"onUpdate:modelValue":e[0]||(e[0]=o=>s.carreras=o),options:s.carrerasLista,optionLabel:"name",optionValue:"code",filter:!0,placeholder:"Carrera..."},null,8,["modelValue","options"]),i("div",Q,[W,t(h,{inputId:"minmax",modelValue:s.aspirantes,"onUpdate:modelValue":e[1]||(e[1]=o=>s.aspirantes=o),mode:"decimal",min:0,max:1e4,showButtons:!0},null,8,["modelValue"])]),i("div",X,[Z,t(h,{inputId:"minmax",modelValue:s.examinados,"onUpdate:modelValue":e[2]||(e[2]=o=>s.examinados=o),mode:"decimal",min:0,max:1e4,showButtons:!0},null,8,["modelValue"])]),i("div",$,[ee,t(h,{inputId:"minmax",modelValue:s.noAdmitidos,"onUpdate:modelValue":e[3]||(e[3]=o=>s.noAdmitidos=o),mode:"decimal",min:0,max:1e4,showButtons:!0},null,8,["modelValue"])]),i("div",oe,[t(g,{modelValue:s.periodos,"onUpdate:modelValue":e[4]||(e[4]=o=>s.periodos=o),options:s.periodosLista,optionLabel:"name",optionValue:"code",placeholder:"Periodo"},null,8,["modelValue","options"])]),t(a,{type:"submit",id:"btnRegisrar",class:"flex items-center justify-center space-x-2 rounded-md border-2 border-blue-500 px-4 py-2 font-medium text-blue-600 transition hover:bg-blue-500 hover:text-white"},{default:d(()=>[te,ie]),_:1})],32)])]),_:1},8,["visible"]),i("section",se,[i("div",re,[i("div",le,[i("div",ae,[i("div",null,[t(_)]),t(a,{label:"Grafica",icon:"pi pi-chart-bar",onClick:l.openResponsive},null,8,["onClick"]),t(m,{header:"Grafica",visible:s.displayResponsive,"onUpdate:visible":e[7]||(e[7]=o=>s.displayResponsive=o),breakpoints:{"960px":"75vw","75vw":"90vw"},style:{width:"70vw"}},{footer:d(()=>[t(a,{label:"Cerrar",icon:"pi pi-check",onClick:l.closeResponsive,autofocus:""},null,8,["onClick"]),t(a,{label:"Guardar",icon:"pi pi-save",onClick:l.saveImage},null,8,["onClick"])]),default:d(()=>[i("div",de,[t(D,{ingresos:p.ingresos},null,8,["ingresos"])])]),_:1},8,["visible"]),t(a,{icon:"pi pi-external-link",label:"Exportar Excel",onClick:e[8]||(e[8]=o=>l.exportCSV(o))}),t(v,{modelValue:s.filters.carrera.value,"onUpdate:modelValue":e[9]||(e[9]=o=>s.filters.carrera.value=o),options:l.filtrarCarreras(),placeholder:"Carrera",display:"chip"},null,8,["modelValue","options"]),t(v,{modelValue:s.filters.Proceso.value,"onUpdate:modelValue":e[10]||(e[10]=o=>s.filters.Proceso.value=o),options:l.filtrarProcesos(),placeholder:"Proceso",display:"chip"},null,8,["modelValue","options"]),t(v,{modelValue:s.filters.periodo.value,"onUpdate:modelValue":e[11]||(e[11]=o=>s.filters.periodo.value=o),options:l.filtrarFecha(),placeholder:"Fecha",display:"chip"},null,8,["modelValue","options"]),t(a,{icon:"pi pi-times",label:"Limpiar",onClick:e[12]||(e[12]=o=>l.limpiarFiltros())})])]),t(P,{value:p.ingresos,paginator:!0,class:"p-datatable-customers",rows:7,ref:"dt",filters:s.filters,"onUpdate:filters":e[13]||(e[13]=o=>s.filters=o),selection:s.selectedProducts,"onUpdate:selection":e[14]||(e[14]=o=>s.selectedProducts=o),emptyMessage:s.noDataMessage,stripedRows:"",sortMode:"multiple",removableSort:""},{empty:d(()=>[ne]),default:d(()=>[t(u,{selectionMode:"multiple",style:{width:"3rem"},exportable:!1}),t(u,{field:"id",header:"ID",sortable:!0,hidden:""}),t(u,{field:"carrera",header:"Carrera",sortable:!0}),t(u,{field:"aspirantes",header:"Aspirantes",sortable:!0}),t(u,{field:"examinados",header:"Examinados",sortable:!0}),t(u,{field:"no_admitidos",header:"No Admitidos",sortable:!0}),t(u,{field:"periodo",header:"Periodo",sortable:!0}),t(u,{exportable:!1,style:{"min-width":"8rem"},class:"p-6"},{body:d(o=>[t(a,{icon:"pi pi-pencil",class:"p-button-rounded p-button-success !mr-2",onClick:k=>l.editProduct(o.data)},null,8,["onClick"]),t(a,{icon:"pi pi-trash",class:"p-button-rounded p-button-warning",onClick:k=>l.confirmDeleteProduct(o.data)},null,8,["onClick"])]),_:1})]),_:1},8,["value","filters","selection","emptyMessage"]),t(m,{header:"Editar Admision",visible:s.editDialog,"onUpdate:visible":e[22]||(e[22]=o=>s.editDialog=o),breakpoints:{"960px":"75vw","75vw":"85vw"},style:{width:"25vw"},modal:!0,closable:!0,dismissableMask:!1},{default:d(()=>[i("div",ue,[i("form",{onSubmit:e[21]||(e[21]=V((...o)=>l.editarAdmision&&l.editarAdmision(...o),["prevent"]))},[t(c,{id:"id",modelValue:r.product.id,"onUpdate:modelValue":e[15]||(e[15]=o=>r.product.id=o),modelModifiers:{trim:!0},hidden:""},null,8,["modelValue"]),i("div",ce,[me,t(c,{id:"name",modelValue:r.product.carrera,"onUpdate:modelValue":e[16]||(e[16]=o=>r.product.carrera=o),modelModifiers:{trim:!0}},null,8,["modelValue"])]),i("div",pe,[fe,t(c,{id:"name",modelValue:r.product.aspirantes,"onUpdate:modelValue":e[17]||(e[17]=o=>r.product.aspirantes=o),modelModifiers:{trim:!0}},null,8,["modelValue"])]),i("div",he,[ve,t(c,{inputId:"minmax",modelValue:r.product.examinados,"onUpdate:modelValue":e[18]||(e[18]=o=>r.product.examinados=o),modelModifiers:{trim:!0},mode:"decimal",min:0,max:1e4,showButtons:!0},null,8,["modelValue"])]),i("div",be,[ge,t(c,{inputId:"minmax",modelValue:r.product.no_admitidos,"onUpdate:modelValue":e[19]||(e[19]=o=>r.product.no_admitidos=o),modelModifiers:{trim:!0},mode:"decimal",min:0,max:1e4,showButtons:!0},null,8,["modelValue"])]),i("div",xe,[ye,t(c,{id:"name",modelValue:r.product.periodo,"onUpdate:modelValue":e[20]||(e[20]=o=>r.product.periodo=o),modelModifiers:{trim:!0},required:"true"},null,8,["modelValue"])]),t(a,{type:"submit",label:"Guardar",icon:"pi pi-check",class:"!mt-3"})],32)])]),_:1},8,["visible"]),t(m,{visible:s.deleteProductDialog,"onUpdate:visible":e[24]||(e[24]=o=>s.deleteProductDialog=o),style:{width:"450px"},header:"Confirmar",modal:!0},{footer:d(()=>[t(a,{label:"No",icon:"pi pi-times",class:"p-button-text",onClick:e[23]||(e[23]=o=>s.deleteProductDialog=!1)}),t(a,{label:"Si",icon:"pi pi-check",class:"p-button-text",onClick:l.deleteProduct},null,8,["onClick"])]),default:d(()=>[i("div",Ve,[Ce,r.product?(y(),x("span",we,[C("¿Confirma eliminar el registro "),i("b",null,Y(r.product.carrera),1),C("?")])):q("",!0)])]),_:1},8,["visible"]),t(m,{visible:s.deleteProductsDialog,"onUpdate:visible":e[26]||(e[26]=o=>s.deleteProductsDialog=o),style:{width:"550px"},header:"Confirm",modal:!0},{footer:d(()=>[t(a,{label:"No",icon:"pi pi-times",class:"p-button-text",onClick:e[25]||(e[25]=o=>s.deleteProductsDialog=!1)}),t(a,{label:"Yes",icon:"pi pi-check",class:"p-button-text",onClick:l.deleteSelectedProducts},null,8,["onClick"])]),default:d(()=>[_e]),_:1},8,["visible"])])])],64)}const Ue=J(K,[["render",De]]);export{Ue as default};