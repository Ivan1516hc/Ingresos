<?php

use App\Http\Controllers\Auth\LoginController;
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


Auth::routes();
Route::get('import1', [App\Http\Controllers\datosController::class, 'import1']);
Route::get('import2', [App\Http\Controllers\datosController::class, 'import2']);
Route::get('import3', [App\Http\Controllers\datosController::class, 'import3']);

Route::post('/login-username', [LoginController::class, 'postLogin']);


Route::get('/mov/{id}', [App\Http\Controllers\TransactionController::class, 'cancel']);
Route::get('/mov/request-cancel/{id}', [App\Http\Controllers\TransactionController::class, 'requestCancel']);


Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('opcionMenu.opcion');
    });
    Route::resource('/usuarios', App\Http\Controllers\UserController::class, ['names' => 'users']);
    Route::resource('/movimientos', App\Http\Controllers\TransactionController::class, ['names' => 'transactions']);
    Route::resource('/servicios', App\Http\Controllers\ServiceController::class, ['names' => 'services']);
    Route::resource('/comunidades', App\Http\Controllers\CommunityController::class, ['names' => 'communities']);
    Route::resource('/historial-cancelacion', App\Http\Controllers\CancellationHistoryController::class, ['names' => 'cancellation-histories']);
    Route::resource('/grupo-servicios', App\Http\Controllers\GroupsServiceController::class, ['names' => 'groups-services']);
    Route::resource('/ubicaciones', App\Http\Controllers\LocationController::class, ['names' => 'locations']);
    Route::resource('/pagos-parciales', App\Http\Controllers\PartialPaymentController::class, ['names' => 'partial-payments']);
    Route::resource('/promotores', App\Http\Controllers\PromoterController::class, ['names' => 'promoters']);
    Route::resource('/historial-reimpresion', App\Http\Controllers\ReprintHistoryController::class, ['names' => 'reprint-histories']);
    Route::resource('/terapeutas', App\Http\Controllers\TherapistController::class, ['names' => 'therapists']);
    Route::resource('/cancelaciones', App\Http\Controllers\CancelTransactions::class, ['names' => 'cancel-transactions']);
    // Route::resource('/comunidades/{nombre}',App\Http\Controllers\BeneficiariesCommunityController::class,['names' => '']);

    Route::get('servicios-usuario', [App\Http\Controllers\ServiceController::class, 'getServicesUser']);
    Route::get('servicios-no-vinculantes', [App\Http\Controllers\ServiceController::class, 'getServicesNotbilding']);

    Route::get('logout', function() {
        Auth::logout();
        return redirect('/login');
    });

});
