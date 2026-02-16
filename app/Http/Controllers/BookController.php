<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index(Request $request)
    {
        $perPage = $request->integer('perPage', 8);

        $books = Book::query()->latest('id')
            ->when($request->filled('price_range'), fn($q) => $q->filterByPrice($request->input('price_range')))
            ->when($request->filled('tags'), fn($q) => $q->filterByTags(explode(',', $request->input('tags'))))
            ->cursorPaginate($perPage);

        return BookResource::collection($books);
    }

    public function fetchTags()
    {
        $tags = Book::query()
            ->whereNotNull('tags')
            ->pluck('tags')
            ->flatten()
            ->unique()
            ->sort()
            ->values();

        return response()->json($tags);
    }
}
