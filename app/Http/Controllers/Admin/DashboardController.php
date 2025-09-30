<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $total_books = Book::count();
        $total_categories = Category::count();
    $total_users = User::where('is_admin', false)->count();
        $total_orders = Order::count();
        $recent_orders = Order::with('user')->orderByDesc('created_at')->limit(5)->get();
        $low_stock_books = Book::where('stock', '<=', 5)->orderBy('stock')->limit(5)->get();
        return view('admin.dashboard', compact('total_books', 'total_categories', 'total_users', 'total_orders', 'recent_orders', 'low_stock_books'));
    }
}
