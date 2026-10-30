<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CoaController;
use App\Http\Controllers\ComplianceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Media Asset Resolver
Route::get('/airo-assets/{type}/{path}', [MediaController::class, 'resolve'])
    ->where('path', '.*');

// 301 SEO Redirects (Must precede parameterized routes)
Route::redirect('/catalogue', '/peptide-vials', 301);
Route::redirect('/products', '/peptide-vials', 301);
Route::redirect('/peptides', '/peptide-vials', 301);
Route::redirect('/vials', '/peptide-vials', 301);
Route::redirect('/sarms', '/sarms-products', 301);
Route::redirect('/products/mk-677', '/products/mk-677-ibutamoren', 301);
Route::redirect('/products/mk677', '/products/mk-677-ibutamoren', 301);
Route::redirect('/products/mk-677-liquid-60ml', '/products/mk-677-ibutamoren', 301);
Route::redirect('/products/mk-677-liquid', '/products/mk-677-ibutamoren', 301);
Route::redirect('/products/mk-677-ibutamoren-60ml', '/products/mk-677-ibutamoren', 301);

// Main Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/peptide-vials', [ProductController::class, 'peptides'])->name('peptides');
Route::get('/sarms-products', [ProductController::class, 'sarms'])->name('sarms');
Route::get('/pen-kits', [ProductController::class, 'penKits'])->name('pen-kits');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/coa', [CoaController::class, 'index'])->name('coa');
Route::get('/compliance', [ComplianceController::class, 'index'])->name('compliance');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/order-confirmation', [CartController::class, 'orderConfirmation'])->name('order-confirmation');
Route::get('/checkout/success', [CartController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [CartController::class, 'cancel'])->name('checkout.cancel');

// Legal & Policies
Route::get('/acceptable-use', fn() => app(LegalController::class)->show('acceptable-use'))->name('legal.acceptable-use');
Route::get('/cookie-policy', fn() => app(LegalController::class)->show('cookie-policy'))->name('legal.cookie-policy');
Route::get('/disclaimer', fn() => app(LegalController::class)->show('disclaimer'))->name('legal.disclaimer');
Route::get('/privacy-policy', fn() => app(LegalController::class)->show('privacy-policy'))->name('legal.privacy-policy');
Route::get('/refund-policy', fn() => app(LegalController::class)->show('refund-policy'))->name('legal.refund-policy');
Route::get('/shipping-policy', fn() => app(LegalController::class)->show('shipping-policy'))->name('legal.shipping-policy');
Route::get('/terms-conditions', fn() => app(LegalController::class)->show('terms-conditions'))->name('legal.terms-conditions');

// ── Admin Portal ──
Route::prefix('admin')->group(function () {
    // Guest Admin Auth
    Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');

    // Authenticated Admin Area
    Route::middleware([App\Http\Middleware\AdminMiddleware::class])->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
        Route::post('/sync', [App\Http\Controllers\Admin\DashboardController::class, 'syncJson'])->name('admin.sync');

        // Orders Management
        Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/orders/{id}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('admin.orders.show');
        Route::post('/orders/{id}/status', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('admin.orders.status');
        Route::delete('/orders/{id}', [App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('admin.orders.destroy');

        // Leads & Inquiries Management
        Route::get('/leads', [App\Http\Controllers\Admin\LeadController::class, 'index'])->name('admin.leads.index');
        Route::get('/leads/{id}', [App\Http\Controllers\Admin\LeadController::class, 'show'])->name('admin.leads.show');
        Route::post('/leads/{id}/status', [App\Http\Controllers\Admin\LeadController::class, 'updateStatus'])->name('admin.leads.status');
        Route::delete('/leads/{id}', [App\Http\Controllers\Admin\LeadController::class, 'destroy'])->name('admin.leads.destroy');

        // Product Management
        Route::post('/products/{product}/toggle-stock', [App\Http\Controllers\Admin\ProductController::class, 'toggleStock'])->name('admin.products.toggle-stock');
        Route::resource('products', App\Http\Controllers\Admin\ProductController::class, [
            'as' => 'admin',
        ]);
    });
});
