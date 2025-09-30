<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->paginate(9);
        return view('books.index', compact('books'));
    }

    public function show($id)
    {
        $book = Book::with('category')->findOrFail($id);
        $relatedBooks = Book::where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();
        return view('books.show', compact('book', 'relatedBooks'));
    }
}
