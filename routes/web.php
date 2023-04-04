<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
// importar el componente Register.vue de la carpeta Auth dentro de pages
use resources\js\pages\Auth\Login;
use App\Http\Controllers\main;

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
    return Inertia::render('Auth/Login', [ // si quiero renderizar un componente que no esta en la carpeta pages, debo poner la ruta completa ejemplo: 'resources\js\pages\Auth\Login'
        'canResetPassword' => Route::has('password.request'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
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
    Route::get('/ingreso', [main::class, 'ingreso'])->name('usuario.ingreso');

    // ruta para abrir el menu de bajas
    Route::get('/bajas', [main::class, 'bajas'])->name('usuario.bajas');
    
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
    Route::post('/registro-Admision', [main::class, 'registrarAdmision']);

    // ruta del indicador INGRESO/ADMISION, para EDITAR una admision que recibe el id de la admision
    Route::post('/editar-Admision/{id}', [main::class, 'editarAdmision']);

    // ruta del indicador INGRESO/ADMISION, para ELIMINAR una admision que recibe el id de la admision
    Route::post('/eliminar-Admision/{id}', [main::class, 'eliminarAdmision']);

    // ruta del indicador INGRESO/ADMISION, para ELIMINAR VARIAS admisiones que recibe como array los ids de las admisiones
    Route::post('/eliminar-Admisiones', [main::class, 'eliminarAdmisiones']);

    // ---------- FIN TAB ADMISIONES ------------

    // ---------- TAB NUEVO INGRESO -------------
    Route::post('/registro-NIngreso', [main::class, 'registrarNIngreso']);

    Route::post('/eliminar-NIngresos', [main::class, 'eliminarNIngresos']);

    Route::post('/eliminar-NIngreso', [main::class, 'eliminarNIngreso']);

    Route::post('/editar-NIngreso/{id}', [main::class, 'editarNIngreso']);
   
    // ---------- FIN TAB RE INGRESOS -------------
    Route::post('/registrar-RIngresos', [main::class, 'registrarRIngreso']);

    Route::post('/editar-RIngresos/{id}', [main::class, 'editarRIngresos']);

    Route::post('/eliminar-RIngreso/{id}', [main::class, 'eliminarRIngreso']);

    Route::post('/eliminar-RIngresos/{id}', [main::class, 'eliminarRIngresos']);

    // ---------- FIN TAB RE INGRESOS -------------

    // ---------- TAB EQUIVALENCIAS -------------
    
    // ruta del indicador INGRESO/EQUIVALENCIA, para REGISTRAR una equivalencia
    Route::post('/registro-Equivalencia', [main::class, 'registrarEquivalencia']);

    Route::post('/editar-Equivalencia/{id}', [main::class, 'editarEquivalencia']);

    Route::post('/eliminar-Equivalencia/{id}', [main::class, 'eliminarEquivalencia']);

    Route::post('/eliminar-Equivalencias/{id}', [main::class, 'eliminarEquivalencias']);

    // ---------- FIN TAB Equivalencia -------------
    // ---------- TAB Maestrias -------------
    Route::post('/registro-Maestria', [main::class, 'registrarMaestria']);

    Route::post('/editar-Maestria/{id}', [main::class, 'editarMaestria']);

    Route::post('/eliminar-Maestria/{id}', [main::class, 'eliminarMaestria']);

    Route::post('/eliminar-Maestrias/{id}', [main::class, 'eliminarMaestrias']);


    // ruta del indicador EQUIVALENCIA, para REGISTRAR una equivalencia
    Route::post('/registro-Equivalencia2', [main::class, 'registrarEquivalencia2']);

    Route::post('/editar-Equivalencia2/{id}', [main::class, 'editarEquivalencia2']);

    Route::post('/eliminar-Equivalencia2/{id}', [main::class, 'eliminarEquivalencia2']);

    Route::post('/eliminar-Equivalencias2/{id}', [main::class, 'eliminarEquivalencias2']);


       // --------------------------- TRANSPORTE -----------------------

    Route::post('/registro-solicitudes', [main::class, 'registrarTranspSolicitudes']);

    Route::post('/eliminar-solicitudes', [main::class, 'eliminarTranspSolicitudes']);

    Route::post('eliminar-solicitud', [main::class, 'eliminarTranspSolicitud']);
    
    Route::post('/editar-solicitudes/{id}', [main::class, 'editarTranspSolicitudes']);
    
    Route::post('/registro-rutas', [main::class, 'registrarTranspRutas']);

    Route::post('/eliminar-rutas', [main::class, 'eliminarTranspRutas']);
    
    Route::post('/editar-rutas/{id}', [main::class, 'editarTranspRutas']);

    Route::post('eliminar-ruta', [main::class, 'eliminarTranspRuta']);
});
