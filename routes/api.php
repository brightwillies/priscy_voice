<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\NewsController;
use App\Http\Controllers\Api\Admin\ImageController;
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\OverviewController;
use App\Http\Controllers\Api\Admin\AdminstratorsController;
use App\Http\Controllers\Api\Admin\AuthController as AdminAuthController;

Route::get('/login', function () {
    return response()->json([
        'message' => 'You are unauthorized',
    ], 401);
})->name('login');

Route::post('/login', function () {
    return response()->json([
        'message' => 'You are unauthorized',
    ], 401);
})->name('login');

Route::group(['prefix' => 'v1'], function () {

    Route::group(['prefix' => 'admin'], function () {

        Route::group(['prefix' => 'auth'], function () {
            Route::get('/{id}', [AdminAuthController::class, 'getDetails']);
            Route::post('passwordreset', [AdminAuthController::class, 'resetPassword']);
            Route::post('/update/{id}', [AdminAuthController::class, 'UpdateAdmin']);
            Route::post('/login', [AdminAuthController::class, 'Login']);
            Route::post('/usher-login', [AdminAuthController::class, 'usherLogin']);
            Route::delete('/{id}', [AdminAuthController::class, 'destroy']);
        });

        Route::get('stats', [OverviewController::class, 'stats']);

        // Route::middleware("auth:admin_api")->group(function () {

        Route::group(['prefix' => 'usermanagement'], function () {
            Route::group(['prefix' => 'admin'], function () {
                Route::get('/', [AdminstratorsController::class, 'index']);
                Route::get('/{id}', [AdminstratorsController::class, 'show']);
                Route::post('/', [AdminstratorsController::class, 'store']);
                Route::post('/{id}', [AdminstratorsController::class, 'update']);
                Route::delete('/{id}', [AdminstratorsController::class, 'destroy']);
            });
        });

        Route::group(['prefix' => 'category'], function () {
            Route::get('/', [CategoryController::class, 'index']);
            Route::post('/', [CategoryController::class, 'store']);
            Route::post('/{id}', [CategoryController::class, 'update']);
            Route::get('/{id}', [CategoryController::class, 'show']);
            Route::delete('/{id}', [CategoryController::class, 'destroy']);
        }
        );
        Route::group(['prefix' => 'blog'], function () {
            Route::get('/', [NewsController::class, 'index']);
            Route::post('/', [NewsController::class, 'store']);
            Route::post('/{id}', [NewsController::class, 'update']);
            // Route::get('/event-details/{id}', [NewsController::class, 'Details']);
            Route::get('/{id}', [NewsController::class, 'show']);
            Route::delete('/{id}', [NewsController::class, 'destroy']);
        }
        );

        Route::group(['prefix' => 'media-files'], function () {
            Route::get('/', [ImageController::class, 'indexMultiples']);
            Route::post('/', [ImageController::class, 'storeMultiples']);
            Route::post('/{id}', [ImageController::class, 'update']);
            Route::get('/{id}', [ImageController::class, 'show']);
            Route::delete('/{id}', [ImageController::class, 'destroy']);
        }
        );

        Route::post('/uploadimage', [ImageController::class, 'store']);
        Route::delete('/delete-image/{id}', [ImageController::class, 'deleteImage']);
    });
    // });
});
