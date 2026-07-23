<?php

use App\Livewire\AboutPage;
use App\Livewire\ConstructionPage;
use App\Livewire\ContactPage;
use App\Livewire\HomePage;
use App\Livewire\InventoryPage;
use App\Livewire\LifestylePage;
use App\Livewire\LoginPage;
use App\Livewire\PrivacyPage;
use App\Livewire\ProfilePage;
use App\Livewire\SavedUnitsPage;
use App\Livewire\SearchPage;
use App\Livewire\UnitPage;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Lang;
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

// Sitio público desactivado temporalmente — todo redirige a /nova.
/*
Route::localized(function () {

    Route::get('/', HomePage::class)->name('home');

    Route::get( Lang::uri('/estilo-de-vida'), LifestylePage::class)->name('lifestyle');

    Route::get( Lang::uri('/contacto'), ContactPage::class)->name('contact');

    Route::get( Lang::uri('/desarrollador-del-proyecto'), AboutPage::class)->name('about');

    Route::get( Lang::uri('/avances-de-construccion'), ConstructionPage::class)->name('construction');

    Route::get( Lang::uri('/buscar-unidades'), SearchPage::class)->name('search');

    Route::get( Lang::uri('/condominio-en-venta').'/{name}', UnitPage::class)->name('unit');

    Route::get( Lang::uri('/inventario/torre').'-{name}', InventoryPage::class)->name('tower');

    Route::get( Lang::uri('/aviso-de-privacidad'), PrivacyPage::class)->name('privacy');

    Route::get( Lang::uri('/iniciar-sesion'), LoginPage::class)->name('login');

    Route::get( Lang::uri('/mi-perfil'), ProfilePage::class)->name('profile');

    Route::get( Lang::uri('/unidades-guardadas'), SavedUnitsPage::class)->name('saved');

});
*/

// El middleware 'auth' redirige a route('login') cuando no hay sesión activa;
// como la ruta pública de login está comentada, se conserva este nombre para
// que ese redirect no truene, y de paso manda al mismo lugar que todo lo demás.
Route::redirect('/iniciar-sesion', '/nova')->name('login');

Route::get('/alma-optimize', function() {

    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('view:cache');

    return ('Optimizado');
})->middleware('auth');

// Cualquier otra ruta redirige temporalmente (302) a /nova.
Route::redirect('/{any}', '/nova')->where('any', '^(?!nova).*$');