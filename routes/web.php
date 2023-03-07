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
Route::get('import4', [App\Http\Controllers\datosController::class, 'import4']);

Route::post('/login-username', [LoginController::class, 'postLogin']);


Route::middleware('auth'
)->group(function () {
    Route::get('/', function () {
        return view('opcionMenu.opcion');
    });
    Route::resource('/usuarios', App\Http\Controllers\UserController::class, ['names' => 'users'])->middleware('role:1');
    Route::resource('/movimientos', App\Http\Controllers\TransactionController::class, ['names' => 'transactions'])->middleware('role:1,2,3');
    Route::resource('/servicios', App\Http\Controllers\ServiceController::class, ['names' => 'services'])->middleware('role:1,2,3');
    Route::resource('/comunidades', App\Http\Controllers\CommunityController::class, ['names' => 'communities'])->middleware('role:2,3');
    Route::resource('/historial-cancelacion', App\Http\Controllers\CancellationHistoryController::class, ['names' => 'cancellation-histories'])->middleware('role:1,2,3,5');
    Route::resource('/grupo-servicios', App\Http\Controllers\GroupsServiceController::class, ['names' => 'groups-services'])->middleware('role:2,3');
    Route::resource('/ubicaciones', App\Http\Controllers\LocationController::class, ['names' => 'locations'])->middleware('role:1,2');
    Route::resource('/pagos-parciales', App\Http\Controllers\PartialPaymentController::class, ['names' => 'partial-payments'])->middleware('role:1,2,3');
    Route::resource('/promotores', App\Http\Controllers\PromoterController::class, ['names' => 'promoters'])->middleware('role:1,2,3');
    Route::resource('/historial-reimpresion', App\Http\Controllers\ReprintHistoryController::class, ['names' => 'reprint-histories'])->middleware('role:2,3,1');
    Route::resource('/terapeutas', App\Http\Controllers\TherapistController::class, ['names' => 'therapists'])->middleware('role:1,2,3');
    Route::resource('/cancelaciones', App\Http\Controllers\CancelTransactions::class, ['names' => 'cancel-transactions'])->middleware('role:2,5');
    // Route::resource('/comunidades/{nombre}',App\Http\Controllers\BeneficiariesCommunityController::class,['names' => '']);

    Route::get('servicios-usuario', [App\Http\Controllers\ServiceController::class, 'getServicesUser']);
    Route::get('servicios-no-vinculantes', [App\Http\Controllers\ServiceController::class, 'getServicesNotbilding']);
    
    Route::get('/mov/{id}', [App\Http\Controllers\TransactionController::class, 'cancel']);
    Route::get('/mov/request-cancel/{id}', [App\Http\Controllers\TransactionController::class, 'requestCancel']);

    Route::get('/partial/{id}', [App\Http\Controllers\PartialPaymentController::class, 'abono']);
    Route::get('/partial/cancel/{id}', [App\Http\Controllers\PartialPaymentController::class, 'requestCancel']);

    Route::get('getlocations', [App\Http\Controllers\FormsController::class, 'getLocations']);
    Route::get('gettherapists', [App\Http\Controllers\TherapistController::class, 'getTherapists']);

    Route::get('getpromoters', [App\Http\Controllers\PromoterController::class, 'getPromoters']);

    Route::get('/ticket/{invoice}', [App\Http\Controllers\TransactionController::class,'ticket']);
    
    Route::get('logout', function() {
        Auth::logout();
        return redirect('/login');
    });

});
