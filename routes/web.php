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
    Route::get('/egresados', [main::class, 'egresados'])->name('usuario.egresados');

    // Ruta para abrir el menu de titulados
    Route::get('/titulados', [main::class, 'titulados'])->name('usuario.titulados');

    // Ruta para abrir el menu de becas
    Route::get('/becas', [main::class, 'becas'])->name('usuario.becas');

    // Ruta para abrir el menu de transporte
    Route::get('/transporte', [main::class, 'transporte'])->name('usuario.transporte');

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
    Route::post('/registro-Titulado', [main::class, 'registrarTitulacion']);

    // ruta del indicador TITULADOS, para EDITAR una admision que recibe el id de la admision
    Route::post('/editar-Titulado/{id}', [main::class, 'editarTitulacion']);

    // ruta del indicador TITULADOS, para ELIMINAR una admision que recibe el id de la admision
    Route::post('/eliminar-Titulado/{id}', [main::class, 'eliminarTitulacion']);

    // ruta del indicador TITULADOS, para ELIMINAR VARIAS admisiones que recibe como array los ids de las admisiones
    Route::post('/eliminar-Titulados', [main::class, 'eliminarTitulaciones']);

    Route::post('/importar-excel-titulados',[main::class,'importarDataExcelTitulados']);

    // ---------------- TAB TITULADOS TOTALES GENERACIONES -------------------------
    // ruta del indicador TITULADOS, para REGISTRAR una admision
    Route::post('/registro-Titulado-Total', [main::class, 'registrarTitulacionTotal']);

    // ruta del indicador TITULADOS, para EDITAR una admision que recibe el id de la admision
    Route::post('/editar-Titulado-Total/{id}', [main::class, 'editarTitulacionTotal']);

    // ruta del indicador TITULADOS, para ELIMINAR una admision que recibe el id de la admision
    Route::post('/eliminar-Titulado-Total/{id}', [main::class, 'eliminarTitulacionTotal']);

    // ruta del indicador TITULADOS, para ELIMINAR VARIAS admisiones que recibe como array los ids de las admisiones
    Route::post('/eliminar-Titulados-Total', [main::class, 'eliminarTitulacionesTotal']);

    Route::post('/importar-excel-titulados-generaciones', [main::class, 'importarDataExcelTituladosGeneraciones']);

    // ---------------- TAB TITULADOS TOTALES CARRERAS -------------------------

    // ruta del indicador TITULADOS, para REGISTRAR una admision
    Route::post('/registro-Titulado-Total-Carreras', [main::class, 'registrarTitulacionTotalCarreras']);

    // ruta del indicador TITULADOS, para EDITAR una admision que recibe el id de la admision
    Route::post('/editar-Titulado-Total-Carreras/{id}', [main::class, 'editarTitulacionTotalCarreras']);

    // ruta del indicador TITULADOS, para ELIMINAR una admision que recibe el id de la admision
    Route::post('/eliminar-Titulado-Total-Carreras/{id}', [main::class, 'eliminarTitulacionTotalCarreras']);

    // ruta del indicador TITULADOS, para ELIMINAR VARIAS admisiones que recibe como array los ids de las admisiones
    Route::post('/eliminar-Titulados-Total-Carreras', [main::class, 'eliminarTitulacionesTotalCarreras']);

    Route::post('/importar-excel-titulados-carreras', [main::class, 'importarDataExcelTituladosCarreras']);

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

    Route::post('/registro-solicitudes', [main::class, 'registrarTranspSolicitudes']);

    Route::post('/eliminar-solicitudes', [main::class, 'eliminarTranspSolicitudes']);

    Route::post('eliminar-solicitud', [main::class, 'eliminarTranspSolicitud']);
    
    Route::post('/editar-solicitudes/{id}', [main::class, 'editarTranspSolicitudes']);
    
    Route::post('/registro-rutas', [main::class, 'registrarTranspRutas']);

    Route::post('/eliminar-rutas', [main::class, 'eliminarTranspRutas']);
    
    Route::post('/editar-rutas/{id}', [main::class, 'editarTranspRutas']);

    Route::post('eliminar-ruta', [main::class, 'eliminarTranspRuta']);

    // --------------------------- FIN TRANSPORTE -----------------------

    // --------------------------- BECAS -----------------------

    // --------------------------- EGRESADOS -----------------------

    Route::post('/registro-Egreso', [main::class, 'registrarEgresados']);

    route::post('/eliminar-Egresos', [main::class, 'eliminarEgresados']);

    route::post('/eliminar-Egreso/{id}', [main::class, 'eliminarEgreso']);

    route::post('/editar-Egreso/{id}', [main::class, 'editarEgreso']);

    Route::post('/importar-excel-egresados', [main::class, 'importarDataExcelEgresados']);
    
    //-------------------------------- EGRESADOS TOTALES CARRERAS -------------------------------

    Route::post('/registrar-Egreso-Totales', [main::class, 'registrarEgresadosTotales']);

    Route::post('/eliminar-Egreso-Totales/{id}', [main::class, 'eliminarEgresoTotales']);

    Route::post('/eliminar-Egresos-Totales', [main::class, 'eliminarEgresosTotales']);

    Route::post('/editar-Egreso-Totales/{id}', [main::class, 'editarEgresoTotales']);

    Route::post('/importar-excel-egresados-Totales', [main::class, 'importarDataExcelEgresadosTotales']);
    //--------------------------------- EGRESADOS TOTALES GENERACIONES ----------------------------------

    Route::post('/registrar-Egreso-Totales-Generacion', [main::class, 'registrarEgresadosTotalesGeneracion']);

    Route::post('/eliminar-Egreso-Totales-Generacion/{id}', [main::class, 'eliminarEgresoTotalesGeneracion']);

    Route::post('/eliminar-Egresos-Totales-Generacion', [main::class, 'eliminarEgresosTotalesGeneracion']);

    Route::post('/editar-Egreso-Totales-Generacion/{id}', [main::class, 'editarEgresoTotalesGeneracion']);

    Route::post('/importar-excel-egresados-Totales-Generacion', [main::class, 'importarDataExcelEgresadosGeneracion']);

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
    Route::post('/importar-excel-admisiones', [main::class, 'importarDataExcelAdmisiones']);

    Route::post('/importar-excel-ningresos', [main::class, 'importarDataExcelNIngresos']);
});
