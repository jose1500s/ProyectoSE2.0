<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
// importar el componente Register.vue de la carpeta Auth dentro de pages
use resources\js\pages\Auth\Login;  
use App\Http\Controllers\main;
use App\Http\Controllers\ControladorUsuarios;

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
        $roles = Auth::user()->roles;

        foreach($roles as $rol){
            $rol->permissions;
        }

        return Inertia::render('Dashboard');
    })->name('dashboard');

    // ruta para abrir el perfil del usuario
    // Route::get('/ingreso', [main::class, 'ingreso'])->name('usuario.ingreso');
    Route::get('/ingreso', [main::class, 'ingreso'])->middleware(CheckPermissions::class . ':consultar_ingreso')->name('usuario.ingreso');

    // ruta para abrir el menu de bajas
    Route::get('/bajas', [main::class, 'bajas'])->middleware(CheckPermissions::class . ":consultar_bajas")->name('usuario.bajas');
    
    // Ruta para abrir el menu de matricula
    Route::get('/matricula', [main::class, 'matricula'])->middleware(CheckPermissions::class . ":consultar_matricula")->name('usuario.matricula');
    
    // Ruta para abrir el menu de egresados
    Route::get('/egresados', [main::class, 'egresados'])->middleware(CheckPermissions::class . ":consultar_egresados")->name('usuario.egresados');

    // Ruta para abrir el menu de titulados
    Route::get('/titulados', [main::class, 'titulados'])->middleware(CheckPermissions::class . ":consultar_titulados")->name('usuario.titulados');

    // Ruta para abrir el menu de becas
    Route::get('/becas', [main::class, 'becas'])->middleware(CheckPermissions::class . ":consultar_becas")->name('usuario.becas');

    // Ruta para abrir el menu de transporte
    Route::get('/transporte', [main::class, 'transporte'])->middleware(CheckPermissions::class . ":consultar_transporte")->name('usuario.transporte');

    // Ruta para abrir el menu de cambio de carrera
    Route::get('/cambio-de-carrera', [main::class, 'cambioDeCarrera'])->middleware(CheckPermissions::class . ":consultar_cambio_de_carrera")->name('usuario.cambio_de_carrera');

    // Ruta para abrir el menu de seguro facultativo
    Route::get('/seguro-facultativo', [main::class, 'seguroFacultativo'])->name('usuario.segurofacultativo');

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

    // Ruta para la gestión de usuarios, roles y permisos
    Route::get('/usuarios', [ControladorUsuarios::class, 'usuarios'])->middleware(CheckAdminUser::class)->name('usuario.usuarios');

    // ---------- Rutas para Usuarios -------------
    Route::post('/registrar-Usuario', [ControladorUsuarios::class, 'registrarUsuario']);

    Route::post('/editar-Usuario', [ControladorUsuarios::class, 'editarUsuario']);

    Route::post('/eliminar-Usuario', [ControladorUsuarios::class, 'eliminarUsuario']);

    Route::post('/eliminar-Usuarios', [ControladorUsuarios::class, 'eliminarUsuarios']);

    // ---------- Rutas para Roles -------------
    Route::post('/registrar-Rol', [ControladorUsuarios::class, 'registrarRol']);

    Route::post('/editar-Rol', [ControladorUsuarios::class, 'editarRol']);

    Route::post('/eliminar-Rol', [ControladorUsuarios::class, 'eliminarRol']);

    Route::post('/eliminar-Roles',[ControladorUsuarios::class, 'eliminarRoles']);

    // Rutas para agregar y remover permisos

    Route::post('/obtener-Permisos', [ControladorUsuarios::class, 'obtenerPermisos']);

    Route::post('/agregar-Permiso', [ControladorUsuarios::class, 'agregarPermiso']);

    Route::post('/remover-Permiso', [ControladorUsuarios::class, 'removerPermiso']);
});
