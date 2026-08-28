<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryBannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SiteSettingController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('brands', BrandController::class)->except('show');
    Route::resource('banners', BannerController::class)->except('show');
    Route::resource('category-banners', CategoryBannerController::class)
        ->except('show')
        ->parameters(['category-banners' => 'categoryBanner']);

    Route::resource('products', ProductController::class);
    Route::delete('products/{product}/images/{image}', [ProductController::class, 'destroyImage'])->name('products.images.destroy');
    Route::post('editor-image', [ProductController::class, 'uploadEditorImage'])->name('editor.image');

    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('orders/bulk-print', [OrderController::class, 'bulkPrint'])->name('orders.bulk_print');
    Route::get('orders/{order}/invoice', [OrderController::class, 'invoice'])->name('orders.invoice');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');

    Route::get('reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::patch('reviews/{review}/status', [ReviewController::class, 'updateStatus'])->name('reviews.status');
    Route::delete('reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    Route::get('contact-messages', [\App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('contact_messages.index');
    Route::delete('contact-messages/{contactMessage}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('contact_messages.destroy');

    Route::get('requests', [\App\Http\Controllers\Admin\OptionRequestController::class, 'index'])->name('requests.index');
    Route::delete('requests/{optionRequest}', [\App\Http\Controllers\Admin\OptionRequestController::class, 'destroy'])->name('requests.destroy');

    Route::get('settings', [SiteSettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SiteSettingController::class, 'update'])->name('settings.update');

    Route::get('social-links', [SiteSettingController::class, 'socialEdit'])->name('social.edit');
    Route::put('social-links', [SiteSettingController::class, 'socialUpdate'])->name('social.update');

    Route::get('counter', [SiteSettingController::class, 'counterEdit'])->name('counter.edit');
    Route::put('counter', [SiteSettingController::class, 'counterUpdate'])->name('counter.update');
});
