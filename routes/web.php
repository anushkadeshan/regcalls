<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Admin\AppController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\DatabaseController;
use App\Http\Controllers\Admin\Ecommerce\AttributeController;
use App\Http\Controllers\Admin\Ecommerce\CategoryController;
use App\Http\Controllers\Admin\Ecommerce\ProductController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\Ecommerce\StockController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\HomeController;

Route::group(['middleware' => 'CreateDatabaseConnection'], function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('home.index');
        Route::get('allproducts', 'products')->name('home.products');
    });

    Route::prefix('/cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add', [CartController::class, 'add'])->name('add');
        Route::post('/remove', [CartController::class, 'remove'])->name('remove');
        Route::post('/update-quantity', [CartController::class, 'updateQuantity'])->name('update-quantity');
    });
});


Route::get('/customer/register', function () {
    return Inertia::render('Client/Auth/Register');
})->name('custom.register');

Route::get('/customer/login', function () {
    return Inertia::render('Client/Auth/Login');
})->name('custom.login');

Route::post('/customer/login',  [CustomAuthController::class,'login'])->name('custom.post.login');
Route::post('/customer/register',  [CustomAuthController::class,'register'])->name('custom.post.register');




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

        //groups
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

        //databases
        Route::prefix('databases')->group(function () {
            Route::controller(DatabaseController::class)->group(function () {
                Route::get('/index', 'index')->name('databases.index');
                Route::get('/edit/{id}', 'edit')->name('databases.edit');
                Route::post('/update', 'update')->name('databases.update');
                Route::get('/sync', 'syncTables')->name('databases.sync');
            });
        });


        //all the routes where not to redirect to root services
        Route::group(['middleware' => 'CreateDatabaseConnection'], function () {
            //ecommerce
            Route::prefix('ecommerce')->group(function () {
                //stocks
                Route::controller(StockController::class)->group(function () {
                    Route::get('/stock/index', 'index')->name('stock.index');
                    Route::post('/stock/create', 'store')->name('stock.store');
                    Route::get('/stock/edit/{id}', 'edit')->name('stock.edit');
                    Route::post('/stock/update', 'update')->name('stock.update');
                });

                //products
                Route::controller(ProductController::class)->group(function () {
                    Route::get('/product/index', 'index')->name('product.index');
                    Route::get('/product/create', 'create')->name('product.create');
                    Route::post('/product/store', 'store')->name('product.store');
                    Route::post('/product/update', 'update')->name('product.update');
                    Route::get('/product/edit/{id}', 'edit')->name('product.edit');
                    Route::post('/product/uploadDownloads', 'uploadDownloads')->name('product.uploadDownloads');
                    Route::post('/product/deleteDownloads', 'deleteDownloads')->name('product.deleteDownloads');
                    Route::post('/product/uploadTechSpecs', 'uploadTechSpecs')->name('product.uploadTechSpecs');
                    Route::post('/product/uploadMainImage', 'uploadMainImage')->name('product.uploadMainImage');
                    Route::post('/product/uploadOtherImages', 'uploadOtherImages')->name('product.uploadOtherImages');
                    Route::post('/product/deleteImage', 'deleteImage')->name('product.deleteImage');
                });

                //category
                Route::controller(CategoryController::class)->group(function () {
                    Route::get('/category/index', 'index')->name('category.index');
                    Route::post('/category/store', 'store')->name('category.store');
                    Route::post('/category/update', 'update')->name('category.update');
                });

                //Attributes
                Route::controller(AttributeController::class)->group(function () {
                    Route::get('/attribute/index', 'index')->name('attribute.index');
                    Route::post('/attribute/store', 'store')->name('attribute.store');
                    Route::post('/attribute/update', 'update')->name('attribute.update');
                });
            });
        });
    });

    //user apps
    Route::prefix('apps')->group(function () {
        Route::controller(AppController::class)->group(function () {
            Route::get('/home/{app_key}/{title_en}', 'home')->name('apps.home');
        });
    });

    //settings
    Route::prefix('settings')->group(function () {
        Route::controller(SettingsController::class)->group(function () {
            Route::get('/index', 'index')->name('settings.index');
            Route::post('/changeTheme', 'changeTheme')->name('settings.changeTheme');
        });
    });



});
