<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PageBlockController;
use App\Http\Controllers\Admin\PageBuilderController;
use App\Http\Controllers\Admin\PageSectionController;
use App\Http\Controllers\Admin\PageTemplateController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\ThemeController;

// -------------------------------
// Admin Authentication
// -------------------------------
Route::get('admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// -------------------------------
// Protected Admin Routes
// -------------------------------
Route::middleware('admin.auth')->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // Visual Builder
    Route::get('/builder', [PageBuilderController::class, 'index'])->name('builder');

    Route::get('/page-templates', [PageTemplateController::class, 'index'])->name('page-templates.index');
    Route::post('/page-templates', [PageTemplateController::class, 'store'])->name('page-templates.store');
    Route::get('/page-templates/{template}', [PageTemplateController::class, 'show'])->name('page-templates.show');
    Route::put('/page-templates/{template}', [PageTemplateController::class, 'update'])->name('page-templates.update');
    Route::delete('/page-templates/{template}', [PageTemplateController::class, 'destroy'])->name('page-templates.destroy');
    Route::post('/page-templates/{template}/publish', [PageTemplateController::class, 'publish'])->name('page-templates.publish');

    Route::post('/page-sections', [PageSectionController::class, 'store'])->name('page-sections.store');
    Route::get('/page-sections/{section}', [PageSectionController::class, 'show'])->name('page-sections.show');
    Route::put('/page-sections/{section}', [PageSectionController::class, 'update'])->name('page-sections.update');
    Route::delete('/page-sections/{section}', [PageSectionController::class, 'destroy'])->name('page-sections.destroy');
    Route::post('/page-templates/{template}/sections/reorder', [PageSectionController::class, 'reorder'])->name('page-sections.reorder');

    Route::post('/page-blocks', [PageBlockController::class, 'store'])->name('page-blocks.store');
    Route::get('/page-blocks/{block}', [PageBlockController::class, 'show'])->name('page-blocks.show');
    Route::put('/page-blocks/{block}', [PageBlockController::class, 'update'])->name('page-blocks.update');
    Route::delete('/page-blocks/{block}', [PageBlockController::class, 'destroy'])->name('page-blocks.destroy');
    Route::post('/page-sections/{section}/blocks/reorder', [PageBlockController::class, 'reorder'])->name('page-blocks.reorder');

    Route::get('/theme', [ThemeController::class, 'show'])->name('theme.show');
    Route::put('/theme', [ThemeController::class, 'update'])->name('theme.update');

    Route::get('/media', [MediaController::class, 'index'])->name('media.index');
    Route::post('/media', [MediaController::class, 'store'])->name('media.store');
    Route::delete('/media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');

    // Blog Management
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');

    // SEO Settings
    Route::get('/seo', [SeoController::class, 'edit'])->name('seo.edit');
    Route::put('/seo', [SeoController::class, 'update'])->name('seo.update');
});
