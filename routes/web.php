<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminRequestController;

// Rotte pubbliche
Route::get('/', [PublicController::class, 'homepage'])->name('homepage');
Route::get('chi-siamo', [PublicController::class, 'aboutUs'])->name('aboutUs');
Route::get('join-team', [PublicController::class, 'joinTeam'])->name('join.team');
// !Contatti
Route::get('contacts', [PublicController::class, 'contacts'])->name('contacts');
// !invio EMAIL
Route::post('contact-us', [PublicController::class, 'contactUs'])->name('contactUs');

// !PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/settings', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// !Lingua
Route::post('lingua/{lang}', [PublicController::class, 'setLanguage'])->name('setLocale');

// // Rotta per la pagina delle carriere
// Route::get('/careers', [PublicController::class, 'careers'])->name('careers');
// Route::get('/faq', [PublicController::class, 'faq'])->name('faq');

// !Article
// !CRUD
// !create e read
Route::get('/create/article', [ArticleController::class, 'create'])->middleware('auth')->name('create.article');
Route::get('/article/edit/{id}', [ArticleController::class, 'edit'])->name('article.edit');
Route::get('/article/delete/{id}', [ArticleController::class, 'delete'])->name('article.delete');

Route::get('/tutti-gli-annunci', [ArticleController::class, 'index'])->name('article.index');
// Route::get('/category/{category}', [CategoryController::class, 'index'])->name('category.index');
// rotta parametrica per Dettaglio articoli-annunci
Route::get('/show/article/{article}', [ArticleController::class, 'show'])->name('article.show');
Route::get('category/{category}', [ArticleController::class, 'byCategory'])->name('byCategory');
// !edit - update

//! RICERCA articoli
Route::get('/search/article', [PublicController::class,'searchArticles'])->name('article.search');

//! REVISORE
Route::get('/revisor/index', [RevisorController::class, 'index'])->middleware('isRevisor')->name('revisor.index');

// Cart Routes
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart/add/{article}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');

// Status Articoli
Route::patch('/accepte/{article}',[RevisorController::class, 'accept'])->name('accept');
Route::patch('/reject/{article}',[RevisorController::class, 'reject'])->name('reject');

//!REVISORE - REVISOR
//  Email per diventare Revisore
Route::get('/revisor/request', [RevisorController::class, 'showRequestForm'])->middleware('auth')->name('revisor.request.form');
Route::post('/revisor/request/submit', [RevisorController::class, 'becomeRevisor'])->middleware('auth')->name('become.revisor');
Route::get('/make/revisor/{email}', [RevisorController::class, 'makeRevisor'])->name('revisor.make');

// !AMMINISTRATORE - ADMIN
// Admin Request Routes
Route::middleware(['auth'])->group(function() {
    Route::get('/admin/request', [AdminRequestController::class, 'showRequestForm'])->name('admin.request.form');
    Route::post('/admin/request', [AdminRequestController::class, 'submitRequest'])->name('admin.request.submit');
});

// Super Admin Routes (solo per gli admin esistenti)
Route::middleware(['auth', 'isAdmin'])->group(function() {
    Route::get('/admin/requests/pending', [AdminRequestController::class, 'pendingRequests'])->name('admin.requests.pending');
    Route::post('/admin/request/approve/{adminRequest}', [AdminRequestController::class, 'approveRequest'])->name('admin.request.approve');
    Route::post('/admin/request/reject/{adminRequest}', [AdminRequestController::class, 'rejectRequest'])->name('admin.request.reject');
});

// Admin Routes
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/revisor/{user}/accept', [AdminController::class, 'acceptRevisor'])->name('revisor.accept');
    Route::post('/revisor/{user}/reject', [AdminController::class, 'rejectRevisor'])->name('revisor.reject');
    Route::post('/revisor/{user}/remove', [AdminController::class, 'removeRevisor'])->name('revisor.remove');
});
