<?php

use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AppController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\LanguageController;
use Inertia\Inertia;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

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
        //dashboard
        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');

        //translations
        Route::prefix('translations')->group(function () {
            Route::get('/add-new', function () {
                return Inertia::render('Language/AddNew');
            })->name('translations');
            Route::get('/en', function () {
                return Inertia::render('Language/English');
            })->name('translations_en');
            Route::get('/pt', function () {
                return Inertia::render('Language/Portuguese');
            })->name('translations_pt');

            Route::post('/add-translations', [LanguageController::class,'setLangItems'])->name('addTranslation');
            Route::post('/edit-en-translations', [LanguageController::class,'setLangEnTranslations'])->name('editEnTranslation');
            Route::post('/edit-pt-translations', [LanguageController::class,'setLangPtTranslations'])->name('editPtTranslation');
        });

        //roles
        Route::prefix('roles')->group(function () {
            Route::controller(RoleController::class)->group(function () {
                Route::get('/index', 'index')->name('roles.index');
                Route::post('/add', 'store')->name('roles.store');
            });
        });

        //Permissions
        Route::prefix('permissions')->group(function () {
            Route::controller(PermissionController::class)->group(function () {
                Route::get('/index', 'index')->name('permissions.index');
                Route::post('/add', 'store')->name('permissions.store');
                Route::post('/givePermissionToRole', 'givePermissionToRole')->name('permissions.givePermissionToRole');
            });
        });

        //users
        Route::prefix('users')->group(function () {
            Route::controller(UserController::class)->group(function () {
                Route::get('/index', 'index')->name('users.index');
                Route::delete('/delete', 'destroy')->name('users.delete');
                Route::get('/edit/{id}', 'edit')->name('users.edit');
                Route::post('/changeStatus', 'changeStatus')->name('users.changeStatus');
                Route::post('/assignGroupsToUser', 'assignGroupsToUser')->name('users.assignGroupsToUser');
                Route::post('/removeGroups', 'removeGroups')->name('users.removeGroups');
                Route::post('/assignProfileToUser', 'assignProfileToUser')->name('users.assignProfileToUser');
                Route::post('/removeProfiles', 'removeProfiles')->name('users.removeProfiles');
                Route::post('/changeProfile', 'changeProfile')->name('users.changeProfile');

            });
        });

        //users
        Route::prefix('groups')->group(function () {
            Route::controller(GroupController::class)->group(function () {
                Route::get('/index', 'index')->name('groups.index');
                Route::post('/store', 'store')->name('groups.store');
                Route::delete('/delete', 'destroy')->name('groups.delete');
                Route::get('/edit/{id}', 'edit')->name('groups.edit');
                Route::post('/update', 'update')->name('groups.update');
                Route::post('/assignAppsToGroup', 'assignAppsToGroup')->name('groups.assignAppsToGroup');
                Route::post('/removeApp', 'removeApp')->name('groups.removeApp');
                Route::post('/changeGroup', 'changeGroup')->name('groups.changeGroup');

            });
        });

        //Apps
        Route::prefix('apps')->group(function () {
            Route::controller(AppController::class)->group(function () {
                Route::get('/index', 'index')->name('apps.index');
                Route::post('/store', 'store')->name('apps.store');
                Route::post('/changeStatus', 'changeStatus')->name('apps.changeStatus');
            });
        });
    });

    //user apps
    Route::prefix('apps')->group(function () {
        Route::controller(AppController::class)->group(function () {
            Route::get('/home/{app_key}/{title_en}', 'home')->name('apps.home');
        });
    });

    //setiings
    Route::prefix('settings')->group(function () {
        Route::controller(SettingsController::class)->group(function () {
            Route::get('/index', 'index')->name('settings.index');
            Route::post('/changeTheme', 'changeTheme')->name('settings.changeTheme');
        });
    });

});
