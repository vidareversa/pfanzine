<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FanzineController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [FanzineController::class, 'index']); // Formulario
Route::post('/convertir', [FanzineController::class, 'convertir'])->name('fanzine.convertir'); // Proceso

Route::get('/test-mpdf', function() {
    try {
        $mpdf = new \Mpdf\Mpdf();
        return "¡Librería encontrada correctamente!";
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});