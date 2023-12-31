<?php


use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeLabel\HomeLabelController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Auth;
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


Route::group([
    'prefix' => 'admin',
    'middleware' => 'admin'
], function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin');
    Route::group([
        'prefix' => 'product',
    ], function ($router) {
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/', [ProductController::class, 'store'])->name('product.store');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::patch('/{product}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

        Route::post('/image', [ProductController::class, 'imageUpload'])->name('product.image.upload');
        Route::get('/image/{image}', [ProductController::class, 'imageShow'])->name('product.image.show');
        Route::delete('/image/{image}', [ProductController::class, 'imageDestroy'])->name('product.image.destroy');
    });
    Route::group([
        'prefix' => 'category',
    ], function ($router) {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('category.show');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::patch('/{category}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

        Route::post('/image', [CategoryController::class, 'imageUpload'])->name('category.image.upload');
        Route::get('/image/{image}', [CategoryController::class, 'imageShow'])->name('category.image.show');
        Route::delete('/image/{image}', [CategoryController::class, 'imageDestroy'])->name('category.image.destroy');
    });
    Route::group([
        'prefix' => 'order',
    ], function ($router) {
        Route::get('/', [OrderController::class, 'index'])->name('order.index');
    });
    Route::group([
        'prefix' => 'homeLabel',
    ], function ($router) {
        Route::get('/', [HomeLabelController::class, 'index'])->name('homeLabel.index');
        Route::get('/edit', [HomeLabelController::class, 'edit'])->name('homeLabel.edit');
        Route::get('/create', [HomeLabelController::class, 'create'])->name('homeLabel.create');
        Route::post('/', [HomeLabelController::class, 'store'])->name('homeLabel.store');
        Route::delete('/{label}', [HomeLabelController::class, 'destroy'])->name('homeLabel.destroy');
        Route::get('/{label}/edit', [HomeLabelController::class, 'edit'])->name('homeLabel.edit');
        Route::patch('/{label}', [HomeLabelController::class, 'update'])->name('homeLabel.update');
    });
});

Route::group([
    'prefix' => 'order',
], function ($router) {

    Route::post('/', [OrderController::class, 'store'])->name('order.store');
    Route::post('/basket', [OrderController::class, 'store_basket'])->name('order.basket.store');
    Route::get('/basket', [OrderController::class, 'get_basket'])->name('order.basket.index');

});



Auth::routes();



Route::group([
    'middleware' => 'web',
], function ($router) {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
});
Route::group([
    'prefix' => 'product',
], function ($router) {
    Route::get('/{product}', [ProductController::class, 'show'])->name('product.show');
});
