<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\FlashsaleController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/katalog', [CatalogController::class, 'index'])->name('katalog');
Route::get('/beli', [CatalogController::class, 'beli'])->name('beli.index');
Route::get('/beli/{account:slug}', [CatalogController::class, 'beliShow'])->name('beli.show');
Route::get('/sewa', [CatalogController::class, 'sewa'])->name('sewa.index');
Route::get('/sewa/{account:slug}', [CatalogController::class, 'sewaShow'])->name('sewa.show');
Route::get('/katalog/{game:slug}', [CatalogController::class, 'game'])->name('katalog.game');
Route::get('/akun/{account:slug}', [CatalogController::class, 'show'])->name('katalog.show');

Route::get('/flashsale', [FlashsaleController::class, 'index'])->name('flashsale');

Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::post('/wishlist/{account}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
    Route::get('/chat/{user}', [ChatController::class, 'with'])->name('chat.with');
    Route::post('/chat/{user}', [ChatController::class, 'send'])->name('chat.send');

    Route::get('/riwayat', [TransactionController::class, 'riwayat'])->name('riwayat');

    Route::get('/transaksi/beli/{account}', [TransactionController::class, 'beli'])->name('transactions.beli');
    Route::post('/transaksi/beli/{account}', [TransactionController::class, 'storeBeli']);
    Route::get('/transaksi/sewa/{account}', [TransactionController::class, 'sewa'])->name('transactions.sewa');
    Route::post('/transaksi/sewa/{account}', [TransactionController::class, 'storeSewa']);
    Route::post('/transaksi/{transaction}/bukti', [TransactionController::class, 'uploadBukti'])->name('transactions.bukti');
    Route::post('/transaksi/{transaction}/review', [App\Http\Controllers\ReviewController::class, 'store'])->name('transactions.review');
    Route::post('/transaksi/{transaction}/cancel', [TransactionController::class, 'cancel'])->name('transactions.cancel');
    Route::get('/transaksi/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', fn () => view('admin.dashboard.index'))->name('admin.dashboard');
    Route::resource('games', App\Http\Controllers\Admin\GameController::class)->names('admin.games');
    Route::resource('accounts', App\Http\Controllers\Admin\AccountController::class)->names('admin.accounts');
    Route::resource('transactions', App\Http\Controllers\Admin\TransactionController::class)->names('admin.transactions');
    Route::get('users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users');
    Route::resource('rental-packages', App\Http\Controllers\Admin\RentalPackageController::class)->names('admin.rental-packages');
    Route::get('chat', [App\Http\Controllers\Admin\ChatController::class, 'index'])->name('admin.chat');
    Route::get('chat/{user}', [App\Http\Controllers\Admin\ChatController::class, 'show'])->name('admin.chat.show');
    Route::get('laporan', [App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('admin.laporan');
    Route::get('reviews', [App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('admin.reviews');
    Route::post('reviews/{review}/approve', [App\Http\Controllers\Admin\ReviewController::class, 'approve'])->name('admin.reviews.approve');
    Route::post('reviews/{review}/reject', [App\Http\Controllers\Admin\ReviewController::class, 'reject'])->name('admin.reviews.reject');
    Route::delete('reviews/{review}', [App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('admin.reviews.destroy');
});

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

Route::get('/sitemap.xml', function () {
    return response()->view('seo.sitemap')->header('Content-Type', 'application/xml');
});

Route::get('/robots.txt', function () {
    return response()->view('seo.robots')->header('Content-Type', 'text/plain');
});

require __DIR__.'/auth.php';
