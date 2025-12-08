<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\RegionController;
use App\Http\Controllers\LangueController;
use App\Http\Controllers\ContributionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ContenuController;


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

Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes publiques
Route::get('/langues', [LangueController::class, 'index'])->name('langues.index');

// Routes pour la contribution
Route::get('/contribuer', [ContributionController::class, 'showForm'])->name('contribuer');
Route::post('/auth/login', [ContributionController::class, 'login']);
Route::post('/auth/register', [ContributionController::class, 'register']);
Route::post('/contenus', [ContributionController::class, 'storeContribution']);

// Routes pour les contenus (PUBLIC)
Route::get('/contenus', [ContenuController::class, 'index'])->name('contenus.index');
Route::get('/contenus/{type}', [ContenuController::class, 'index'])->name('contenus.type');
Route::get('/contenu/{id}', [ContenuController::class, 'show'])->name('contenus.show');

// Routes pour les régions
Route::get('/regions', [RegionController::class, 'index'])->name('regions.index');
Route::get('/regions/{id}', [RegionController::class, 'show'])->name('regions.show');

// Route détail contenu (alternative) - si nécessaire
// Route::get('/contenu-detail/{id}', function ($id) {
//     return view('contenu-detail', ['id' => $id]);
// });

// Routes pour le paiement du contenu
Route::middleware(['auth'])->group(function () {
    Route::get('/payment/content/{contenu}', [PaymentController::class, 'payForContent'])
        ->name('payment.content');
    
    Route::get('/payment/callback/{contenu}', [PaymentController::class, 'callback'])
        ->name('fedapay.content.callback');
});

// Dashboard accessible uniquement aux utilisateurs vérifiés
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes de profil (auth)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Préfixe admin (ajoutez middleware IsAdmin si nécessaire)
Route::prefix('admin')->middleware('auth')->group(function () {
    // Accueil dashboard
    Route::get('/accueil', [DashboardController::class, 'index'])->name('admin.accueil');

    // Utilisateurs
    Route::get('/utilisateurs', [DashboardController::class, 'utilisateurs'])->name('admin.utilisateurs.index');
    Route::get('/utilisateurs/create', [DashboardController::class, 'createUtilisateur'])->name('admin.utilisateurs.create');
    Route::post('/utilisateurs', [DashboardController::class, 'storeUtilisateur'])->name('admin.utilisateurs.store');
    Route::get('/utilisateurs/{id}', [DashboardController::class, 'showUtilisateur'])->name('admin.utilisateurs.show');
    Route::get('/utilisateurs/{id}/edit', [DashboardController::class, 'editUtilisateur'])->name('admin.utilisateurs.edit');
    Route::put('/utilisateurs/{id}', [DashboardController::class, 'updateUtilisateur'])->name('admin.utilisateurs.update');
    Route::delete('/utilisateurs/{id}', [DashboardController::class, 'destroyUtilisateur'])->name('admin.utilisateurs.destroy');

    // Modérateurs
    Route::get('/moderateurs', [DashboardController::class, 'moderateurs'])->name('admin.moderateurs');

    /**
     * Langues (CRUD)
     */
    Route::get('/langues', [DashboardController::class, 'langues'])->name('admin.langues.index');
    Route::get('/langues/create', [DashboardController::class, 'createLangue'])->name('admin.langues.create');
    Route::post('/langues', [DashboardController::class, 'storeLangue'])->name('admin.langues.store');
    Route::get('/langues/{id}/edit', [DashboardController::class, 'editLangue'])->name('admin.langues.edit');
    Route::put('/langues/{id}', [DashboardController::class, 'updateLangue'])->name('admin.langues.update');
    Route::delete('/langues/{id}', [DashboardController::class, 'destroyLangue'])->name('admin.langues.destroy');
    Route::get('/langues/{id}', [DashboardController::class, 'showLangue'])->name('admin.langues.show');

    /**
     * Recettes / Contenus (CRUD)
     */
    Route::get('/recettes', [DashboardController::class, 'recettes'])->name('admin.contenu.index');
    Route::get('/recettes/create', [DashboardController::class, 'createContenu'])->name('admin.contenu.create');
    Route::post('/recettes', [DashboardController::class, 'storeContenu'])->name('admin.contenu.store');
    Route::get('/recettes/{id}/edit', [DashboardController::class, 'editContenu'])->name('admin.contenu.edit');
    Route::put('/recettes/{id}', [DashboardController::class, 'updateContenu'])->name('admin.contenu.update');
    Route::delete('/recettes/{id}', [DashboardController::class, 'destroyContenu'])->name('admin.contenu.destroy');
    Route::get('/recettes/{id}', [DashboardController::class, 'showContenu'])->name('admin.contenu.show');

    /**
     * Régions (CRUD)
     */
    Route::get('/regions', [DashboardController::class, 'regions'])->name('admin.regions.index');
    Route::get('/regions/create', [DashboardController::class, 'createRegion'])->name('admin.regions.create');
    Route::post('/regions', [DashboardController::class, 'storeRegion'])->name('admin.regions.store');
    Route::get('/regions/{id}/edit', [DashboardController::class, 'editRegion'])->name('admin.regions.edit');
    Route::put('/regions/{id}', [DashboardController::class, 'updateRegion'])->name('admin.regions.update');
    Route::delete('/regions/{id}', [DashboardController::class, 'destroyRegion'])->name('admin.regions.destroy');
    Route::get('/regions/{id}', [DashboardController::class, 'showRegion'])->name('admin.regions.show');

    // Mot de passe et déconnexion (vues)
    Route::get('/mot-de-passe', [DashboardController::class, 'motDePasse'])->name('admin.mot-de-passe');
    Route::get('/deconnexion', [DashboardController::class, 'deconnexion'])->name('admin.deconnexion');
});

// Auth routes
require __DIR__.'/auth.php';