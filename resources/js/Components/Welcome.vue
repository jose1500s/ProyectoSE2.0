<script>
import Card from 'primevue/card';
import Chart from 'primevue/chart';
import { ref } from "vue";
import {Link} from '@inertiajs/vue3';
import Tag from 'primevue/tag';
import Button from 'primevue/button';
import Accordion from 'primevue/accordion';
import AccordionTab from 'primevue/accordiontab';
import Toolbar from "primevue/toolbar";
import SplitButton from 'primevue/splitbutton';


export default {
    components: {
        Card,
        Chart,
        Link,
        Tag,
        Button,
        Accordion,
        AccordionTab,
        Toolbar,
        SplitButton,

    },
    
    data() {
    return {
      // ... Plantillas de Ingreso.............................................
      excelOptionsA: [
        {
          label: "Descargar Plantilla Admiciones",
          icon: "pi pi-file-excel",
          command: this.downloadExcelA,
        },
        {
          label: "Descargar Plantilla NuevoIngreso",
          icon: "pi pi-file-excel",
          command: this.downloadExcelB,
        },
        {
          label: "Descargar Plantilla Reingreso",
          icon: "pi pi-file-excel",
          command: this.downloadExcelC,
        },
        {
          label: "Descargar Plantilla Equivalencia",
          icon: "pi pi-file-excel",
          command: this.downloadExcelA,
        },
        {
          label: "Descargar Plantilla Maestrias",
          icon: "pi pi-file-excel",
          command: this.downloadExcelA,
        },
      ],
      // ... Plantillas de Matricula.............................................
      excelOptionsB: [
        {
          label: "Descargar Plantilla Matricula",
          icon: "pi pi-file-excel",
          command: this.downloadExcelD,
        },
      ],
      // ... Plantillas de Bajas.............................................
      excelOptionsC: [
      {
          label: "Descargar Plantilla Temporal",
          icon: "pi pi-file-excel",
          command: this.downloadExcelE,
        },
        {
          label: "Descargar Plantilla Voluntaria",
          icon: "pi pi-file-excel",
          command: this.downloadExcelE,
        },
        {
          label: "Descargar Plantilla Academica",
          icon: "pi pi-file-excel",
          command: this.downloadExcelE,
        },
        {
          label: "Descargar Plantilla Administrativa",
          icon: "pi pi-file-excel",
          command: this.downloadExcelE,
        },
      ],
      // ... Plantillas de Egresados.............................................
      excelOptionsD: [
        {
          label: "Descargar Plantilla Egresados",
          icon: "pi pi-file-excel",
          command: this.downloadExcelF,
        },
        {
          label: "Descargar Plantilla Carreras",
          icon: "pi pi-file-excel",
          command: this.downloadExcelG,
        },
        {
          label: "Descargar Plantilla Generaciones",
          icon: "pi pi-file-excel",
          command: this.downloadExcelH,
        },
      ],
      // ... Plantillas de Titulados.............................................
      excelOptionsE: [
        {
          label: "Descargar Plantilla Titulados",
          icon: "pi pi-file-excel",
          command: this.downloadExcelI,
        },
        {
          label: "Descargar Plantilla Carreras",
          icon: "pi pi-file-excel",
          command: this.downloadExcelJ,
        },
        {
          label: "Descargar Plantilla Generaciones",
          icon: "pi pi-file-excel",
          command: this.downloadExcelK,
        },
      ],
      // ... Plantillas de Becas.............................................
      excelOptionsF: [
        {
          label: "Descargar Plantilla ExAcademica",
          icon: "pi pi-file-excel",
          command: this.downloadExcelL,
        },
        {
          label: "Descargar Plantilla ApCardenal",
          icon: "pi pi-file-excel",
          command: this.downloadExcelL,
        },
        {
          label: "Descargar Plantilla PorProyecto",
          icon: "pi pi-file-excel",
          command: this.downloadExcelL,
        },
        {
          label: "Descargar Plantilla CarAzul",
          icon: "pi pi-file-excel",
          command: this.downloadExcelL,
        },
      ],
      // ... Plantillas de Transporte.............................................
      excelOptionsG: [
        {
          label: "Descargar Plantilla Solicitudes",
          icon: "pi pi-file-excel",
          command: this.downloadExcelM,
        },
        {
          label: "Descargar Plantilla Rutas",
          icon: "pi pi-file-excel",
          command: this.downloadExcelN,
        },
      ],
      // ... Plantillas de Cambio de carrera.............................................
      excelOptionsH: [
        {
          label: "Descargar Plantilla CambioCarrera",
          icon: "pi pi-file-excel",
          command: this.downloadExcelO,
        },
      ],
    };
    },

    methods: {
    // ... Plantillas de Ingreso.............................................
    downloadExcelA() {
        const fileUrl = '/Plantilla1.xlsx'; // Ruta al archivo Excel en la carpeta "public"
        const link = document.createElement('a');
        link.href = fileUrl;
        link.setAttribute('download', 'Plantilla1.xlsx');
        link.click();
        
    },
    downloadExcelB() {
      const fileUrl = '/Plantilla2.xlsx'; // Ruta al archivo Excel en la carpeta "public"
      const link = document.createElement('a');
      link.href = fileUrl;
      link.setAttribute('download', 'Plantilla2.xlsx');
      link.click();
      
    },
    downloadExcelC() {
      const fileUrl = '/Plantilla3.xlsx'; // Ruta al archivo Excel en la carpeta "public"
      const link = document.createElement('a');
      link.href = fileUrl;
      link.setAttribute('download', 'Plantilla3.xlsx');
      link.click();
      
    },
    // ... Plantillas de Matricula.............................................
    downloadExcelD() {
      const fileUrl = '/Plantilla4.xlsx'; // Ruta al archivo Excel en la carpeta "public"
      const link = document.createElement('a');
      link.href = fileUrl;
      link.setAttribute('download', 'Plantilla4.xlsx');
      link.click();
      
    },
    // ... Plantillas de Bajas.............................................
    downloadExcelE() {
      const fileUrl = '/Plantilla5.xlsx'; // Ruta al archivo Excel en la carpeta "public"
      const link = document.createElement('a');
      link.href = fileUrl;
      link.setAttribute('download', 'Plantilla5.xlsx');
      link.click();
      
    },
    // ... Plantillas de Egresados.............................................
    downloadExcelF() {
      const fileUrl = '/Plantilla6.xlsx'; // Ruta al archivo Excel en la carpeta "public"
      const link = document.createElement('a');
      link.href = fileUrl;
      link.setAttribute('download', 'Plantilla6.xlsx');
      link.click();
      
    },
    downloadExcelG() {
      const fileUrl = '/Plantilla7.xlsx'; // Ruta al archivo Excel en la carpeta "public"
      const link = document.createElement('a');
      link.href = fileUrl;
      link.setAttribute('download', 'Plantilla7.xlsx');
      link.click();
      
    },
    downloadExcelH() {
      const fileUrl = '/Plantilla8.xlsx'; // Ruta al archivo Excel en la carpeta "public"
      const link = document.createElement('a');
      link.href = fileUrl;
      link.setAttribute('download', 'Plantilla8.xlsx');
      link.click();
      
    },
    // ... Plantillas de Titulados.............................................
    downloadExcelI() {
      const fileUrl = '/Plantilla9.xlsx'; // Ruta al archivo Excel en la carpeta "public"
      const link = document.createElement('a');
      link.href = fileUrl;
      link.setAttribute('download', 'Plantilla9.xlsx');
      link.click();
      
    },
    downloadExcelJ() {
      const fileUrl = '/Plantilla10.xlsx'; // Ruta al archivo Excel en la carpeta "public"
      const link = document.createElement('a');
      link.href = fileUrl;
      link.setAttribute('download', 'Plantilla10.xlsx');
      link.click();
      
    },
    downloadExcelK() {
      const fileUrl = '/Plantilla11.xlsx'; // Ruta al archivo Excel en la carpeta "public"
      const link = document.createElement('a');
      link.href = fileUrl;
      link.setAttribute('download', 'Plantilla11.xlsx');
      link.click();
      
    },
    // ... Plantillas de Becas.............................................
    downloadExcelL() {
      const fileUrl = '/Plantilla12.xlsx'; // Ruta al archivo Excel en la carpeta "public"
      const link = document.createElement('a');
      link.href = fileUrl;
      link.setAttribute('download', 'Plantilla12.xlsx');
      link.click();
      
    },
    // ... Plantillas de Transporte.............................................
    downloadExcelM() {
      const fileUrl = '/Plantilla13.xlsx'; // Ruta al archivo Excel en la carpeta "public"
      const link = document.createElement('a');
      link.href = fileUrl;
      link.setAttribute('download', 'Plantilla13.xlsx');
      link.click();
      
    },
    downloadExcelN() {
      const fileUrl = '/Plantilla14.xlsx'; // Ruta al archivo Excel en la carpeta "public"
      const link = document.createElement('a');
      link.href = fileUrl;
      link.setAttribute('download', 'Plantilla14.xlsx');
      link.click();
      
    },
    // ... Plantillas de Cambio de carrera.............................................
    downloadExcelO() {
      const fileUrl = '/Plantilla15.xlsx'; // Ruta al archivo Excel en la carpeta "public"
      const link = document.createElement('a');
      link.href = fileUrl;
      link.setAttribute('download', 'Plantilla15.xlsx');
      link.click();
      
    },
  },
};
</script>

<template>
    <section class="bg-white">
        <div class="mx-auto max-w-screen-xl px-4 sm:px-6  lg:px-8">
            <div class="w-full text-center">
                <!-- {{ $page.props.user.name}} -->
                <div class="flex flex-col justify-between gap-6" id="upSide">
                    <div class="titulo">
                        <div class="text-3xl font-bold" id="nombreDashboard">
                            <h2>Bienvenido {{ $page.props.user.name }}</h2>
                        </div>
                        <div class="text-lg mb-6 mt-6" id="parrafoDashboard">
                            Aquí podrás encontrar una explicación de cómo funcionan todos los apartados de cada indicador. <br>
                            Si quieres descargar la plantilla de tu respectivo indicador hay un botón con su nombre en cada uno 
                            de los indicadores y aquí hay una recopilación de cada una de esas plantillas, todos tienen ejemplos 
                            de como ingresar los datos para subirlos.<br>
                        </div>
                    </div>
           
                </div>

                <div class="button-container">                
                    <div class="button-group">
                        <SplitButton
                        label="Plantillas Ingreso"
                        :model="excelOptionsA"
                        icon="pi pi-file-excel"
                        class="!mr-2"
                        ></SplitButton>
                        <SplitButton
                        label="Plantillas Matricula"
                        :model="excelOptionsB"
                        icon="pi pi-file-excel"
                        class="!mr-2"
                        ></SplitButton>
                        <SplitButton
                        label="Plantillas Bajas"
                        :model="excelOptionsC"
                        icon="pi pi-file-excel"
                        class="!mr-2"
                        ></SplitButton>
                        <SplitButton
                        label="Plantillas Egresados"
                        :model="excelOptionsD"
                        icon="pi pi-file-excel"
                        class="!mr-2"
                        ></SplitButton>
                    </div>
                    <div class="button-group">
                        <SplitButton
                        label="Plantillas Titulados"
                        :model="excelOptionsE"
                        icon="pi pi-file-excel"
                        class="!mr-2"
                        ></SplitButton>
                        <SplitButton
                        label="Plantillas Becas"
                        :model="excelOptionsF"
                        icon="pi pi-file-excel"
                        class="!mr-2"
                        ></SplitButton>
                        <SplitButton
                        label="Plantillas Transporte"
                        :model="excelOptionsG"
                        icon="pi pi-file-excel"
                        class="!mr-2"
                        ></SplitButton>
                        <SplitButton
                        label="Plantillas CambioCarrera"
                        :model="excelOptionsH"
                        icon="pi pi-file-excel"
                        class="!mr-2"
                        ></SplitButton>
                    </div>
                    <!-- ... otros elementos ... -->
                </div>
                    
                
                <Accordion class="accordion-custom mb-10" :activeIndex="0">
                    <AccordionTab>
                        <template #header>
                            <i class="pi pi-save"></i>
                            <span>Como Ingresar Datos? </span>
                        </template>
                        <p>
                            Con el propósito de incorporar información a cualquier indicador, se encuentra disponible un botón situado en la sección 
                            superior de la interfaz. Distinguido por su tonalidad verde y el ícono de suma (+), este botón se destina a esta funcionalidad 
                            específica. Al proceder a su activación, se materializará una ventana emergente que contendrá una serie de campos. Cabe destacar que 
                            la naturaleza de estos campos puede variar en función de las particularidades inherentes a cada uno de los indicadores. No obstante, 
                            el procedimiento subyacente en todos los casos es uniforme y coherente.
                            <img src="images/Ingresar.jpg" class="img-fluid mt-2 mb-2" alt="1" border="0">
                        </p>
                    </AccordionTab>
                    <AccordionTab>
                        <template #header>
                            <i class="pi pi-delete-left"></i>
                            <span>Como Eliminar Datos? </span>
                        </template>
                        <p>
                            Existen dos métodos disponibles para proceder a la eliminación de datos within de las tablas correspondientes a 
                            cada uno de los indicadores. El primero de estos métodos consiste en emplear el botón ubicado junto a cada dato 
                            presente en la tabla, el cual se encuentra representado por el símbolo 🗑, característico de un contenedor de basura. 
                            La segunda alternativa disponible radica en la utilización del botón situado en la parte superior de la interfaz. No 
                            obstante, este botón posee la función específica de permitir la eliminación simultánea de múltiples datos, motivo por 
                            el cual se encuentra inactivo hasta que se seleccione al menos un elemento. Para tal fin, se incorpora un cuadro de selección 
                            adyacente a cada uno de los datos, posibilitando su marcado individual. Asimismo, en la zona superior donde se encuentran listados 
                            los nombres de cada elemento, se ubica otro cuadro de selección que posibilita la marcación global de todos los elementos con tan solo 
                            un clic. Una vez que se hayan seleccionado los datos deseados, el botón rojo ubicado en la parte superior se activará y, al ser accionado, 
                            procederá a la eliminación de todos los datos que han sido previamente seleccionados.
                            <img src="images/Eliminar.jpg" class="img-fluid" alt="1" border="0">
                        </p>
                    </AccordionTab>
                    <AccordionTab>
                        <template #header>
                            <i class="pi pi-file-edit"></i>
                            <span>Como Editar Datos?</span>
                        </template>
                        <p>
                            Con el propósito de efectuar modificaciones en los datos presentes en la tabla, se encuentra disponible un botón caracterizado por el 
                            símbolo de un lápiz (✏), el cual se ubica junto a cada uno de los datos previamente registrados. Al seleccionar dicho botón, se generará 
                            una acción que dará lugar a la aparición de una ventana emergente. Esta ventana contendrá la información relativa al dato específico que se 
                            haya seleccionado. Dentro de este entorno, se brindará la capacidad de elegir el componente deseado para su edición, el cual podrá ser modificado
                            sin contratiempos.
                            <img src="images/Editar.jpg" class="img-fluid" alt="1" border="0">
                        </p>
                    </AccordionTab>
                    <AccordionTab>
                        <template #header>
                            <i class="pi pi-file-export"></i>
                            <span>Como Exportar a Excel?</span>
                        </template>
                        <p>
                            El procedimiento para llevar a cabo la exportación de un archivo en formato Excel se caracteriza por su simplicidad. El botón pertinente, claramente identificado por su matiz azul, 
                            se encuentra estratégicamente posicionado en la parte superior de la interfaz. Al ejecutar una interacción de clic sobre este botón, se desencadena 
                            de forma inmediata el proceso de descarga del archivo Excel, el cual se almacenará en la carpeta destinada a las descargas en la computadora del usuario.

                            Vale la pena destacar que el contenido del archivo Excel resultante reflejará directamente las configuraciones de filtro que el usuario haya 
                            empleado en ese momento particular. Siempre que se haya aplicado un filtro a los datos antes de efectuar la descarga, el archivo Excel reflejará 
                            únicamente los datos que estuvieran visibles o seleccionados en el instante de la acción. Este nivel de adaptabilidad en la exportación garantiza la 
                            presentación precisa y coherente de los datos conforme a las preferencias y requisitos del usuario.
                            <img src="images/Exportar.jpg" class="img-fluid" alt="1" border="0">
                        </p>
                    </AccordionTab>
                    <AccordionTab>
                        <template #header>
                            <i class="pi pi-file-import"></i>
                            <span>Como Importar un Excel?</span>
                        </template>
                        <p>
                            Con el propósito de efectuar la importación de un archivo en formato Excel, es imperativo contar con la plantilla específica correspondiente a su indicador. 
                            Esta plantilla se hallará compuesta por los campos respectivos, dispuestos para ser completados de manera adecuada. Dichas plantillas están a su disposición 
                            en la página principal del sistema o en la sección correspondiente al indicador específico. Una vez que se cuente con la plantilla pertinente, el siguiente 
                            paso implica la diligente cumplimentación de los datos requeridos. Una vez que se haya asegurado de que la información ha sido debidamente consignada, tan 
                            solo deberá presionar el botón de tonalidad azul denominado "Importar Excel".

                            La ejecución de este comando abrirá una sección dedicada, donde se permitirá cargar el archivo previamente elaborado. Conviene señalar que únicamente se podrá 
                            realizar la carga exitosa si el archivo se encuentra en el formato xlsx. Por consiguiente, resulta crucial asegurarse de que el archivo cumpla con esta especificación 
                            para garantizar una importación sin contratiempos.
                            <img src="images/Importar.jpg" class="img-fluid" alt="1" border="0">
                        </p>
                    </AccordionTab>
                    <AccordionTab>
                        <template #header>
                            <i class="pi pi-chart-line"></i>
                            <span>Como Usar las Graficas?</span>
                        </template>
                        <p>
                            Para habilitar la funcionalidad de generación de gráficos, es necesario efectuar una selección de los datos que se desean representar visualmente. Esta tarea puede 
                            llevarse a cabo mediante la utilización de los cuadros de selección adyacentes a cada uno de los puntos de datos. En la eventualidad de que el propósito sea representar 
                            la totalidad de los datos, se proporciona un cuadro de selección adicional en la parte superior, contiguo a cada uno de los nombres de los datos. Este último mecanismo 
                            posibilita la selección global automática de todos los datos.

                            Una vez que los datos han sido cuidadosamente elegidos, únicamente resta accionar el botón designado para la generación de gráficos. Como resultado, se generará una 
                            representación visual de los datos seleccionados, con la opción de optar por el tipo de gráfico que mejor se ajuste a sus preferencias. Adicionalmente, se brinda la facultad 
                            de aplicar filtraciones directamente en la misma visualización gráfica, permitiendo un mayor nivel de personalización y comprensión de la información presentada.
                            <img src="images/Graficas.jpg" class="img-fluid" alt="1" border="0">
                        </p>
                    </AccordionTab>
                    <AccordionTab>
                        <template #header>
                            <i class="pi pi-filter"></i>
                            <span>Como Usar los filtros?</span>
                        </template>
                        <p>
                            Dentro de cada uno de los indicadores, se han implementado conjuntos específicos de filtros, diseñados con el propósito de facilitar la organización y estructuración más eficiente 
                            de la información. Estos filtros individuales habilitan la posibilidad de llevar a cabo búsquedas selectivas que atiendan a las necesidades particulares del usuario. Por ejemplo, es 
                            viable efectuar la segmentación de datos basada en criterios como la carrera académica, el periodo de tiempo, el año u otras variables que han sido previamente establecidas en los filtros existentes.
                        </p>
                    </AccordionTab>
                </Accordion>
                
            </div>
        </div>
    </section>
</template>

<style scoped>
.p-tag {
    margin: 0.5em 0.3em 0.5em 0.3em;
    padding: 0.5em;
    border-radius: 3px;
    font-size: 0.85em;
    font-weight: 600;
}
.etiquetahombre	{
   background-color: #0f6ec5	;
}
.etiquetamujer    {
   background-color: #f24a57	;
}
.etiquetavoluntaria    {
   background-color: #32c2b9	;
}
.etiquetatemporal    {
   background-color: #00686c	;
}
.etiquetaacademica{
    background-color: #fad928;
}
.etiquetaadministrativa{
    background-color: #ff9915;
}
.etiquetanegocios{
    background-color: #000000;
}
.etiquetamanufactura{
    background-color: #19058f;
}
.etiquetamecatronica{
    background-color: #9f102c;
}
.etiquetasistemas{
    background-color: #05d3f8;
}
.etiquetaadministracion{
    background-color: #d60212;
}
.etiquetatelematica{
    background-color: #aef055;
}
.etiquetaautomotriz{
    background-color: #5b1d99;
}

.accordion-custom i span {
    vertical-align: middle;
}

.accordion-custom span {
    margin: 0 0.8rem;
}

.p-accordion p {
    line-height: 1.5;
    margin: 0;
}


.button-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  background-color: #d8d1d1; /* Color gris de fondo */
  padding: 10px; /* Espacio alrededor del contenedor */
  margin-bottom: 20px; /* Margen inferior */
  border-radius: 8px; 
}

.button-group {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  margin-bottom: 10px;
}

.button-group > * {
  margin: 5px; /* Ajusta este valor según tus preferencias */
}

</style>