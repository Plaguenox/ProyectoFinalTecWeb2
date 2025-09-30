<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->orderByDesc('created_at')->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items.book')->where('user_id', Auth::id())->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function downloads()
    {
        $books = Book::select('books.*', 'orders.status as order_status')
            ->join('order_items', 'books.id', '=', 'order_items.book_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.user_id', Auth::id())
            ->where('orders.status', '!=', 'cancelled')
            ->groupBy('books.id', 'orders.status', 'books.title', 'books.author', 'books.description', 'books.price', 'books.stock', 'books.category_id', 'books.isbn', 'books.image_path', 'books.pdf_url', 'books.created_at', 'books.updated_at')
            ->get();
        return view('orders.downloads', compact('books'));
    }
}
