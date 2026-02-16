<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('books', [BookController::class, 'index'])->name('books.index');
Route::get('books/tags', [BookController::class, 'fetchTags'])->name('books.fetchTags');
