<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\NotebookController;

Route::prefix('v1/notebook')->group(function () {
    Route::get('/', [NotebookController::class, 'index']);
    Route::post('/', [NotebookController::class, 'store']);
    Route::get('/{id}', [NotebookController::class, 'show']);
    Route::post('/{id}', [NotebookController::class, 'update']);
    Route::delete('/{id}', [NotebookController::class, 'destroy']);
});

use Illuminate\Support\Facades\File;

Route::get('api/documentation', function () {
    $swaggerFilePath = storage_path('api-docs/swagger.json');
    if (!File::exists($swaggerFilePath)) {
        abort(404, 'Документация не найдена. Убедитесь, что она сгенерирована.');
    }
    return response()->file($swaggerFilePath, [
        'Content-Type' => 'application/json',
    ]);
});

