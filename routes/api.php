<?php
use App\Type_Product;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('type', function() {
   
    $type=Type_Product::where('status','=',1)->get();
    return response()->json($type, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
});
Route::get('city', function() { 
    $data = json_decode(file_get_contents('https://thongtindoanhnghiep.co/api/city'), true);
    //$json = json_encode($data, JSON_PRETTY_PRINT);
    return response()->json($data, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
    JSON_UNESCAPED_UNICODE);
    //return $json;
});


