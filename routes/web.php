<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::get('/', [PetController::class, 'index']);
Route::get('/pets', [PetController::class, 'show'])->name('getPets');
Route::get('/pets/add', [PetController::class, 'create'])->name('addPet');
Route::get('/pets/update', [PetController::class, 'edit'])->name('updatePet');
Route::get('/pets/delete', [PetController::class, 'delete'])->name('deletePet');
