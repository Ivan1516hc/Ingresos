<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('opcionMenu.opcion');
});
Auth::routes();

Route::resource('/users',UserController::class);
Route::resource('/transactions',App\Http\Controllers\TransactionController::class);
Route::resource('/services',App\Http\Controllers\ServiceController::class);
Route::get('perfiles',[App\Http\Controllers\datosController::class,'profiles']);
Route::get('grupos',[App\Http\Controllers\datosController::class,'groups']);
Route::get('ubicaciones',[App\Http\Controllers\datosController::class,'locations']);
Route::get('terapeutas',[App\Http\Controllers\datosController::class,'therapists']);
Route::get('promotores',[App\Http\Controllers\datosController::class,'promoters']);
Route::get('usuarios',[App\Http\Controllers\datosController::class,'users']);
Route::get('servicios',[App\Http\Controllers\datosController::class,'services']);
Route::get('grupoServicios',[App\Http\Controllers\datosController::class,'groupsServices']);
Route::get('transacciones',[App\Http\Controllers\datosController::class,'transactions']);
Route::get('pagosParciales',[App\Http\Controllers\datosController::class,'partialPayments']);
Route::get('transaccionesServicios',[App\Http\Controllers\datosController::class,'servicesTransactions']);
Route::get('transaccionesPromotores',[App\Http\Controllers\datosController::class,'promotersTransactions']);
Route::get('transaccionesTerapeutas',[App\Http\Controllers\datosController::class,'therapistsTransactions']);
Route::get('historialCancelaciones',[App\Http\Controllers\datosController::class,'cancellationHistories']);
Route::get('historialReimpresion',[App\Http\Controllers\datosController::class,'reprintHistories']);

Route::get('/home', [HomeController::class, 'index'])->name('home');
