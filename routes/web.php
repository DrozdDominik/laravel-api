<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::get('/', [PetController::class, 'index']);
Route::get('/pets', [PetController::class, 'show'])->name('getPets');
Route::get('/pets/add', [PetController::class, 'create'])->name('addPet');
Route::get('/pets/edit', [PetController::class, 'edit'])->name('editPet');
Route::get('/pets/update', [PetController::class, 'update'])->name('updatePet');
Route::get('/pets/delete', [PetController::class, 'delete'])->name('deletePet');
Route::get('/pet', [PetController::class, 'getPet'])->name('getPet');
Route::get('/pets/status', [PetController::class, 'getPetsByStatus'])->name('getPetsByStatus');
Route::post('/pet', [PetController::class, 'store'])->name('createPet');
Route::post('/pet/edit', [PetController::class, 'editData'])->name('editData');
Route::post('/pet/update', [PetController::class, 'updateData'])->name('updateData');