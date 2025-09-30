<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category');
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                  ->orWhere('author', 'like', '%'.$request->search.'%');
            });
        }
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->stock === 'low') {
            $query->where('stock', '<=', 5);
        } elseif ($request->stock === 'out') {
            $query->where('stock', 0);
        }
        $books = $query->orderByDesc('created_at')->paginate(10);
        $categories = Category::orderBy('name')->get();
        return view('admin.books.index', compact('books', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'isbn' => 'nullable|string|max:255',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048',
            'pdf_url' => 'nullable|string|max:255',
        ]);
        $image_path = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $image_name = uniqid('book_') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/books'), $image_name);
            $image_path = 'images/books/' . $image_name;
        }
        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'isbn' => $request->isbn,
            'image_path' => $image_path,
            'pdf_url' => $request->pdf_url,
        ]);
        return redirect()->route('admin.books.index')->with('success', 'Libro agregado correctamente.');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::orderBy('name')->get();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'isbn' => 'nullable|string|max:255',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048',
            'pdf_url' => 'nullable|string|max:255',
        ]);
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $image_name = uniqid('book_') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/books'), $image_name);
            $book->image_path = 'images/books/' . $image_name;
        }
        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'isbn' => $request->isbn,
            'pdf_url' => $request->pdf_url,
        ]);
        $book->save();
        return redirect()->route('admin.books.index')->with('success', 'Libro actualizado correctamente.');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        if ($book->image_path && file_exists(public_path($book->image_path))) {
            @unlink(public_path($book->image_path));
        }
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Libro eliminado correctamente.');
    }
}
