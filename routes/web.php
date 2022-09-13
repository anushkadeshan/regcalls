<?php

use App\Http\Controllers\LanguageController;
use Inertia\Inertia;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});



Route::get('language/{language}/set', function ($language) {
    App::setLocale($language);
    //storing the locale in session to get it back in the middleware
    session()->put('locale', $language);
    return redirect()->back();
})->name('language');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');
        Route::get('/translations', function () {
            return Inertia::render('Language/Translations');
        })->name('translations');

        Route::post('/add-translations', [LanguageController::class,'setLangItems'])->name('addTranslation');
    });

});
