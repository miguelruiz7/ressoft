<?php

use App\Http\Controllers\controladorAdministrador;
use App\Http\Controllers\controladorCorreo;
use App\Http\Controllers\controladorDispositivos;
use App\Http\Controllers\controladorPermisos;
use App\Http\Controllers\controladorPrincipal;
use App\Http\Controllers\controladorRoles;
use App\Http\Controllers\controladorSensores;
use App\Http\Controllers\controladorSesion;
use App\Http\Controllers\controladorUnidades;
use App\Http\Controllers\controladorUsuarios;
use App\Http\Controllers\controladorVariables;
use App\Http\Middleware\activoMiddleware;
use App\Http\Middleware\sesionMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('/', [controladorPrincipal::class, 'inicio'])->middleware(sesionMiddleware::class, activoMiddleware::class);
Route::post('/permisos', [controladorPermisos::class, 'ver'])->middleware(sesionMiddleware::class, activoMiddleware::class);
Route::post('/roles', [controladorRoles::class, 'ver'])->middleware(sesionMiddleware::class, activoMiddleware::class);
Route::post('/rolesAsignacion', [controladorRoles::class, 'verAsignaciones'])->middleware(sesionMiddleware::class, activoMiddleware::class);
Route::post('/usuarios', [controladorUsuarios::class, 'ver'])->middleware(sesionMiddleware::class, activoMiddleware::class);
Route::post('/unidades', [controladorUnidades::class, 'ver'])->middleware(sesionMiddleware::class, activoMiddleware::class);
Route::post('/sensores', [controladorSensores::class, 'ver'])->middleware(sesionMiddleware::class, activoMiddleware::class);
Route::post('/variables', [controladorVariables::class, 'ver'])->middleware(sesionMiddleware::class, activoMiddleware::class);
Route::post('/variablesAsignacion', [controladorVariables::class, 'verAsignaciones'])->middleware(sesionMiddleware::class, activoMiddleware::class);

Route::post('/dispositivos', [controladorDispositivos::class, 'ver'])->middleware(sesionMiddleware::class, activoMiddleware::class);
Route::post('/sensores', [controladorSensores::class, 'ver'])->middleware(sesionMiddleware::class, activoMiddleware::class);


Route::get('/acceso', function () {
    return view('acceso');
})->middleware(sesionMiddleware::class);

Route::post('/acceso', [controladorSesion::class, 'acceso']);
Route::get('/cerrarSesion', [controladorSesion::class, 'cerrarSesion']);

Route::group(['prefix' => '/form',], function () {

    Route::post('/permisos',  [controladorPermisos::class, 'agregarModal']);
    Route::post('/permisosElim',  [controladorPermisos::class, 'eliminarModal']);

    Route::post('/roles',  [controladorRoles::class, 'agregarModal']);
    Route::post('/rolesElim',  [controladorRoles::class, 'eliminarModal']);
    Route::post('/rolesAct',  [controladorRoles::class, 'actualizarModal']);

    Route::post('/usuarios',  [controladorUsuarios::class, 'agregarModal']);
    Route::post('/usuariosElim',  [controladorUsuarios::class, 'eliminarModal']);
    Route::post('/usuariosAct',  [controladorUsuarios::class, 'actualizarModal']);

    Route::post('/unidades',  [controladorUnidades::class, 'agregarModal']);
    Route::post('/unidadesElim',  [controladorUnidades::class, 'eliminarModal']);

    Route::post('/variables',  [controladorVariables::class, 'agregarModal']);
    Route::post('/variablesElim',  [controladorVariables::class, 'eliminarModal']);
    Route::post('/variablesAct',  [controladorVariables::class, 'actualizarModal']);




     Route::post('/admin',  [controladorAdministrador::class, 'actualizarModal']);

     Route::post('/correo',  [controladorCorreo::class, 'actualizarModal']);

     Route::post('/dispositivos',  [controladorDispositivos::class, 'agregarModal']);
     Route::post('/dispositivosElim',  [controladorDispositivos::class, 'eliminarModal']);
     Route::post('/dispositivosAct',  [controladorDispositivos::class, 'actualizarModal']);

     Route::post('/sensores',  [controladorSensores::class, 'agregarModal']);
     Route::post('/sensoresElim',  [controladorSensores::class, 'eliminarModal']);
     Route::post('/sensoresAct',  [controladorSensores::class, 'actualizarModal']);

});

Route::group(['prefix' => '/func',], function () {
    Route::post('/permisos',  [controladorPermisos::class, 'agregar']);
    Route::post('/permisosElim',  [controladorPermisos::class, 'eliminar']);

    Route::post('/roles',  [controladorRoles::class, 'agregar']);
    Route::post('/rolesElim',  [controladorRoles::class, 'eliminar']);
    Route::post('/rolesAct',  [controladorRoles::class, 'actualizar']);

    Route::post('/usuarios',  [controladorUsuarios::class, 'agregar']);
    Route::post('/usuariosElim',  [controladorUsuarios::class, 'eliminar']);
    Route::post('/usuariosAct',  [controladorUsuarios::class, 'actualizar']);


    Route::post('/unidades',  [controladorUnidades::class, 'agregar']);
    Route::post('/unidadesElim',  [controladorUnidades::class, 'eliminar']);

    Route::post('/variables',  [controladorVariables::class, 'agregar']);
    Route::post('/variablesElim',  [controladorVariables::class, 'eliminar']);
    Route::post('/variablesAct',  [controladorVariables::class, 'actualizar']);



    Route::post('/rolesPermisos', [controladorRoles::class, 'rolesPermisos'])->middleware(sesionMiddleware::class, activoMiddleware::class);
    Route::post('/rolesPermisosGenerar', [controladorRoles::class, 'rolesPermisosGenerar'])->middleware(sesionMiddleware::class, activoMiddleware::class);


    Route::post('/variablesUnidades', [controladorVariables::class, 'variablesUnidades'])->middleware(sesionMiddleware::class, activoMiddleware::class);
    Route::post('/variablesUnidadesGenerar', [controladorVariables::class, 'variablesUnidadesGenerar'])->middleware(sesionMiddleware::class, activoMiddleware::class);

    Route::post('/admin',  [controladorAdministrador::class, 'agregar']);

    Route::post('/correo',  [controladorCorreo::class, 'actualizar']);

    Route::post('/dispositivos',  [controladorDispositivos::class, 'agregar']);
    Route::post('/dispositivosElim',  [controladorDispositivos::class, 'eliminar']);
    Route::post('/dispositivosAct',  [controladorDispositivos::class, 'actualizar']);

    Route::post('/sensores',  [controladorSensores::class, 'agregar']);
    Route::post('/sensoresElim',  [controladorSensores::class, 'eliminar']);
    Route::post('/sensoresAct',  [controladorSensores::class, 'actualizar']);

});


 Route::get("email", [controladorCorreo::class, "email"])->name("email");




