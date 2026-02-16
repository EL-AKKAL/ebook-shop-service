<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'Ebook Shop Service is running.',
        'api routes' => [
            '/books' => 'GET : get paginated list of books',
            '/books/tags' => 'GET : fetch available tags',
        ],
    ]);
});
