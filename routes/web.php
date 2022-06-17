<?php

use App\Http\Controllers\API\TransactionAPIController;
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
    return view('welcome');
});
Route::get('/client-qr/{id}', function ($id) {

  return view('qr',compact('id'));

//   for ($i=0; $i < 1; $i++) { 

//     "<div>"
//     "<\div>"
//     echo   \QrCode::size(200)->generate($id) ;
    
//     echo "<br><br>";
    
//     echo "عميل رقم " . $i+1;
//     echo "<br><br>";
    
// }
});


Route::post('getTransactionCart', [TransactionAPIController::class, 'getTransactionCart']);
