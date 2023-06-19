<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
// importar el componente Register.vue de la carpeta Auth dentro de pages
use resources\js\pages\Auth\Login;
use App\Http\Controllers\main;
use App\Http\Controllers\BajasController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\EgresadosController;
use App\Http\Controllers\TituladosController;
use App\Http\Controllers\TransporteController;
use App\Http\Controllers\BecasController;
use App\Http\Controllers\Ingreso\admisionGraficasController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //si esta autenticado redirigir a dashboard
    if(Auth::check()){
        return redirect('/dashboard');
    //si no esta autenticado redirigir a login
    }else{
        return Inertia::render('Auth/Login', [
        'canResetPassword' => Route::has('password.request'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
    }
    
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // ruta para abrir el perfil del usuario
    Route::get('/ingreso', [IngresoController::class, 'ingreso'])->name('usuario.ingreso');

    // ruta para abrir el menu de bajas
    Route::get('/bajas', [BajasController::class, 'bajas'])->name('usuario.bajas');
    
    // Ruta para abrir el menu de matricula
    Route::get('/matricula', [main::class, 'matricula'])->name('usuario.matricula');
    
    // Ruta para abrir el menu de egresados
    Route::get('/egresados', [EgresadosController::class, 'egresados'])->name('usuario.egresados');

    // Ruta para abrir el menu de titulados
    Route::get('/titulados', [TituladosController::class, 'titulados'])->name('usuario.titulados');

    // Ruta para abrir el menu de becas
    Route::get('/becas', [BecasController::class, 'becas'])->name('usuario.becas');

    // Ruta para abrir el menu de transporte
    Route::get('/transporte', [TransporteController::class, 'transporte'])->name('usuario.transporte');

    // Ruta para abrir el menu de cambio de carrera
    Route::get('/cambio-de-carrera', [main::class, 'cambioDeCarrera'])->name('usuario.cambio_de_carrera');

    // Ruta para abrir el menu de seguro facultativo
    Route::get('/equivalencia', [main::class, 'equivalencia'])->name('usuario.equivalencia');

    // ---------- TAB ADMISIONES ------------
    
    // ruta del indicador INGRESO/ADMISION, para REGISTRAR una admision
    Route::post('/registro-Admision', [IngresoController::class, 'registrarAdmision']);

    // ruta del indicador INGRESO/ADMISION, para EDITAR una admision que recibe el id de la admision
    Route::post('/editar-Admision/{id}', [IngresoController::class, 'editarAdmision']);

    // ruta del indicador INGRESO/ADMISION, para ELIMINAR una admision que recibe el id de la admision
    Route::post('/eliminar-Admision/{id}', [IngresoController::class, 'eliminarAdmision']);

    // ruta del indicador INGRESO/ADMISION, para ELIMINAR VARIAS admisiones que recibe como array los ids de las admisiones
    Route::post('/eliminar-Admisiones', [IngresoController::class, 'eliminarAdmisiones']);

    // ---------- FIN TAB ADMISIONES ------------

    // ---------- TAB TITULADOS ------------

    // ruta del indicador TITULADOS, para REGISTRAR una admision
    Route::post('/registro-Titulado', [TituladosController::class, 'registrarTitulacion']);

    // ruta del indicador TITULADOS, para EDITAR una admision que recibe el id de la admision
    Route::post('/editar-Titulado/{id}', [TituladosController::class, 'editarTitulacion']);

    // ruta del indicador TITULADOS, para ELIMINAR una admision que recibe el id de la admision
    Route::post('/eliminar-Titulado/{id}', [TituladosController::class, 'eliminarTitulacion']);

    // ruta del indicador TITULADOS, para ELIMINAR VARIAS admisiones que recibe como array los ids de las admisiones
    Route::post('/eliminar-Titulados', [TituladosController::class, 'eliminarTitulaciones']);

    Route::post('/importar-excel-titulados',[TituladosController::class,'importarDataExcelTitulados']);

    // ---------------- TAB TITULADOS TOTALES GENERACIONES -------------------------
    // ruta del indicador TITULADOS, para REGISTRAR una admision
    Route::post('/registro-Titulado-Total', [TituladosController::class, 'registrarTitulacionTotal']);

    // ruta del indicador TITULADOS, para EDITAR una admision que recibe el id de la admision
    Route::post('/editar-Titulado-Total/{id}', [TituladosController::class, 'editarTitulacionTotal']);

    // ruta del indicador TITULADOS, para ELIMINAR una admision que recibe el id de la admision
    Route::post('/eliminar-Titulado-Total/{id}', [TituladosController::class, 'eliminarTitulacionTotal']);

    // ruta del indicador TITULADOS, para ELIMINAR VARIAS admisiones que recibe como array los ids de las admisiones
    Route::post('/eliminar-Titulados-Total', [TituladosController::class, 'eliminarTitulacionesTotal']);

    Route::post('/importar-excel-titulados-generaciones', [TituladosController::class, 'importarDataExcelTituladosGeneraciones']);

    // ---------------- TAB TITULADOS TOTALES CARRERAS -------------------------

    // ruta del indicador TITULADOS, para REGISTRAR una admision
    Route::post('/registro-Titulado-Total-Carreras', [TituladosController::class, 'registrarTitulacionTotalCarreras']);

    // ruta del indicador TITULADOS, para EDITAR una admision que recibe el id de la admision
    Route::post('/editar-Titulado-Total-Carreras/{id}', [TituladosController::class, 'editarTitulacionTotalCarreras']);

    // ruta del indicador TITULADOS, para ELIMINAR una admision que recibe el id de la admision
    Route::post('/eliminar-Titulado-Total-Carreras/{id}', [TituladosController::class, 'eliminarTitulacionTotalCarreras']);

    // ruta del indicador TITULADOS, para ELIMINAR VARIAS admisiones que recibe como array los ids de las admisiones
    Route::post('/eliminar-Titulados-Total-Carreras', [TituladosController::class, 'eliminarTitulacionesTotalCarreras']);

    Route::post('/importar-excel-titulados-carreras', [TituladosController::class, 'importarDataExcelTituladosCarreras']);

    // ---------- FIN TAB TITULADOS ------------

    // ruta del indicador TITULADOS, para REGISTRAR una admision



    // ---------- TAB NUEVO INGRESO -------------
    Route::post('/registro-NIngreso', [IngresoController::class, 'registrarNIngreso']);

    Route::post('/eliminar-NIngresos', [IngresoController::class, 'eliminarNIngresos']);

    Route::post('/eliminar-NIngreso', [IngresoController::class, 'eliminarNIngreso']);

    Route::post('/editar-NIngreso/{id}', [IngresoController::class, 'editarNIngreso']);
   
    // ---------- FIN TAB RE INGRESOS -------------
    Route::post('/registrar-RIngresos', [IngresoController::class, 'registrarRIngreso']);

    Route::post('/editar-RIngresos/{id}', [IngresoController::class, 'editarRIngresos']);

    Route::post('/eliminar-RIngreso/{id}', [IngresoController::class, 'eliminarRIngreso']);

    Route::post('/eliminar-RIngresos/{id}', [IngresoController::class, 'eliminarRIngresos']);

    // ---------- FIN TAB RE INGRESOS -------------

    // ---------- TAB EQUIVALENCIAS -------------
    
    // ruta del indicador INGRESO/EQUIVALENCIA, para REGISTRAR una equivalencia
    Route::post('/registro-Equivalencia', [IngresoController::class, 'registrarEquivalencia']);

    Route::post('/editar-Equivalencia/{id}', [IngresoController::class, 'editarEquivalencia']);

    Route::post('/eliminar-Equivalencia/{id}', [IngresoController::class, 'eliminarEquivalencia']);

    Route::post('/eliminar-Equivalencias/{id}', [IngresoController::class, 'eliminarEquivalencias']);

    // ---------- FIN TAB Equivalencia -------------

    // ---------- TAB Maestrias -------------
    Route::post('/registro-Maestria', [IngresoController::class, 'registrarMaestria']);

    Route::post('/editar-Maestria/{id}', [IngresoController::class, 'editarMaestria']);

    Route::post('/eliminar-Maestria/{id}', [IngresoController::class, 'eliminarMaestria']);

    Route::post('/eliminar-Maestrias/{id}', [IngresoController::class, 'eliminarMaestrias']);

    // ---------- FIN TAB Maestrias -------------


    // --------------------------- TRANSPORTE -----------------------

    Route::post('/registro-solicitudes', [TransporteController::class, 'registrarTranspSolicitudes']);

    Route::post('/eliminar-solicitudes', [TransporteController::class, 'eliminarTranspSolicitudes']);

    Route::post('eliminar-solicitud', [TransporteController::class, 'eliminarTranspSolicitud']);
    
    Route::post('/editar-solicitudes/{id}', [TransporteController::class, 'editarTranspSolicitudes']);
    
    Route::post('/registro-rutas', [TransporteController::class, 'registrarTranspRutas']);

    Route::post('/eliminar-rutas', [TransporteController::class, 'eliminarTranspRutas']);
    
    Route::post('/editar-rutas/{id}', [TransporteController::class, 'editarTranspRutas']);

    Route::post('eliminar-ruta', [TransporteController::class, 'eliminarTranspRuta']);

    // --------------------------- FIN TRANSPORTE -----------------------

    // --------------------------- BECAS -----------------------
    Route::post('/importar-excel-becas', [BecasController::class, 'importarDataExcelBecas']);
    
    // ------------------------------------------- BecasEA -------------------------------------------------

    Route::post('/registro-beca-excelencia-academica', [BecasController::class, 'registrarBecaEA']);

    Route::post('/editar-beca-excelencia-academica/{id}', [BecasController::class, 'editarBecaEA']);
    
    Route::post('/eliminar-becas-excelencia-academicas', [BecasController::class, 'eliminarBecaEAs']);

    Route::post('/eliminar-beca-excelencia-academica/{id}', [BecasController::class, 'eliminarBecaEA']);

    // ----------------------------------------- BecasAC --------------------------------------------------

    Route::post('/registro-beca-apoyo-cardenal', [BecasController::class, 'registrarBecaAC']);

    Route::post('/editar-beca-apoyo-cardenal/{id}', [BecasController::class, 'editarBecaAC']);
    
    Route::post('/eliminar-becas-apoyo-cardenales', [BecasController::class, 'eliminarBecaACs']);

    Route::post('/eliminar-beca-apoyo-cardenal/{id}', [BecasController::class, 'eliminarBecaAC']);

    // ------------------------------------------ BecasPP -----------------------------------------------

    Route::post('/registro-beca-por-proyecto', [BecasController::class, 'registrarBecaPP']);

    Route::post('/editar-beca-por-proyecto/{id}', [BecasController::class, 'editarBecaPP']);
    
    Route::post('/eliminar-becas-por-proyectos', [BecasController::class, 'eliminarBecaPPs']);

    Route::post('/eliminar-beca-por-proyecto/{id}', [BecasController::class, 'eliminarBecaPP']);

    // --------------------------------------------- BecasCA -----------------------------------------

    Route::post('/registro-beca-cardenal-azul', [BecasController::class, 'registrarBecaCA']);

    Route::post('/editar-beca-cardenal-azul/{id}', [BecasController::class, 'editarBecaCA']);
    
    Route::post('/eliminar-becas-cardenal-azules', [BecasController::class, 'eliminarBecaCAs']);

    Route::post('/eliminar-beca-cardenal-azul/{id}', [BecasController::class, 'eliminarBecaCA']);

    // --------------------------Fin indicador Becas----------------------------------

    // --------------------------- EGRESADOS -----------------------

    Route::post('/registro-Egreso', [EgresadosController::class, 'registrarEgresados']);

    route::post('/eliminar-Egresos', [EgresadosController::class, 'eliminarEgresados']);

    route::post('/eliminar-Egreso/{id}', [EgresadosController::class, 'eliminarEgreso']);

    route::post('/editar-Egreso/{id}', [EgresadosController::class, 'editarEgreso']);

    Route::post('/importar-excel-egresados', [EgresadosController::class, 'importarDataExcelEgresados']);
    
    //-------------------------------- EGRESADOS TOTALES CARRERAS -------------------------------

    Route::post('/registrar-Egreso-Totales', [EgresadosController::class, 'registrarEgresadosTotales']);

    Route::post('/eliminar-Egreso-Totales/{id}', [EgresadosController::class, 'eliminarEgresoTotales']);

    Route::post('/eliminar-Egresos-Totales', [EgresadosController::class, 'eliminarEgresosTotales']);

    Route::post('/editar-Egreso-Totales/{id}', [EgresadosController::class, 'editarEgresoTotales']);

    Route::post('/importar-excel-egresados-Totales', [EgresadosController::class, 'importarDataExcelEgresadosTotales']);
    //--------------------------------- EGRESADOS TOTALES GENERACIONES ----------------------------------

    Route::post('/registrar-Egreso-Totales-Generacion', [EgresadosController::class, 'registrarEgresadosTotalesGeneracion']);

    Route::post('/eliminar-Egreso-Totales-Generacion/{id}', [EgresadosController::class, 'eliminarEgresoTotalesGeneracion']);

    Route::post('/eliminar-Egresos-Totales-Generacion', [EgresadosController::class, 'eliminarEgresosTotalesGeneracion']);

    Route::post('/editar-Egreso-Totales-Generacion/{id}', [EgresadosController::class, 'editarEgresoTotalesGeneracion']);

    Route::post('/importar-excel-egresados-Totales-Generacion', [EgresadosController::class, 'importarDataExcelEgresadosGeneracion']);

    // --------------------------------------------- BAJAS ---------------------------------------------------

    Route::post('/importar-excel-bajas', [BajasController::class, 'importarDataExcelBajas']);
    
    // ------------------------------------------- TEMPORALES -------------------------------------------------

    Route::post('/registro-baja-temporal', [BajasController::class, 'registrarTemporal']);

    Route::post('/editar-baja-temporal/{id}', [BajasController::class, 'editarTemporal']);
    
    Route::post('/eliminar-bajas-temporales', [BajasController::class, 'eliminarTemporales']);

    Route::post('/eliminar-baja-temporal/{id}', [BajasController::class, 'eliminarTemporal']);

    // ----------------------------------------- VOLUNTARIAS --------------------------------------------------

    Route::post('/registro-baja-voluntaria', [BajasController::class, 'registrarVoluntaria']);

    Route::post('/editar-baja-voluntaria/{id}', [BajasController::class, 'editarVoluntaria']);
    
    Route::post('/eliminar-bajas-voluntarias', [BajasController::class, 'eliminarVoluntarias']);

    Route::post('/eliminar-baja-voluntaria/{id}', [BajasController::class, 'eliminarVoluntaria']);

    // ------------------------------------------ ACADEMICAS -----------------------------------------------

    Route::post('/registro-baja-academica', [BajasController::class, 'registrarAcademica']);

    Route::post('/editar-baja-academica/{id}', [BajasController::class, 'editarAcademica']);
    
    Route::post('/eliminar-bajas-academicas', [BajasController::class, 'eliminarAcademicas']);

    Route::post('/eliminar-baja-academica/{id}', [BajasController::class, 'eliminarAcademica']);

    // --------------------------------------------- ADMINISTRATIVAS -----------------------------------------

    Route::post('/registro-baja-administrativa', [BajasController::class, 'registrarAdministrativa']);

    Route::post('/editar-baja-administrativa/{id}', [BajasController::class, 'editarAdministrativa']);
    
    Route::post('/eliminar-bajas-administrativas', [BajasController::class, 'eliminarAdministrativas']);

    Route::post('/eliminar-baja-administrativa/{id}', [BajasController::class, 'eliminarAdministrativa']);

    //------------------------------------------------- FIN BAJAS ---------------------------------------------
    // ---------- rutas para GRAFICAS -------------
    Route::post('/obtener-filtro-carreras-admision', [admisionGraficasController::class, 'filtrarDatosCarreras']);

    // ruta para importar excels
    Route::post('/importar-excel-admisiones', [IngresoController::class, 'importarDataExcelAdmisiones']);

    Route::post('/importar-excel-ningresos', [IngresoController::class, 'importarDataExcelNIngresos']);

    Route::post('/importar-excel-reingreso', [IngresoController::class, 'importarDataExcelRIngresos']);

    Route::post('/importar-excel-equivalencias', [IngresoController::class, 'importarDataExcelEquivalencias']);

    Route::post('/importar-excel-maestrias', [IngresoController::class, 'importarDataExcelMaestrias']);
});
