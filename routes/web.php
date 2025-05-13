<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PdfController;

Route::get('/', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('/store', [EmployeeController::class, 'store'])->name('employee.store');
Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
Route::post('/update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
Route::delete('/destroy/{id?}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

Route::group(['prefix' => 'payment', 'as' => 'payment.'], function () {
    Route::get('/', [PaymentController::class, 'index'])->name('index');
    Route::get('/create', [PaymentController::class, 'create'])->name('create');
    Route::post('/store', [PaymentController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PaymentController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [PaymentController::class, 'update'])->name('update');
    Route::delete('/destroy/{id?}', [PaymentController::class, 'destroy'])->name('destroy');
});

Route::get('/pdf-penggajian/{id?}', [PdfController::class, 'generatePDF'])->name('pdf-penggajian');

