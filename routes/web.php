<?php

use App\Livewire\HomePage;
use App\Livewire\UnitPage;
use App\Livewire\SearchPage;
use App\Livewire\LifestylePage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::localized(function () {

    Route::get('/', HomePage::class)->name('home');
    Route::get('/estilo-de-vida', LifestylePage::class)->name('lifestyle');

    Route::get('/buscar-unidades', SearchPage::class)->name('search');
    
    Route::get('/condominio-en-venta/{name}', UnitPage::class)->name('unit');

});