<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);
        $book = Book::findOrFail($request->book_id);
        $cart = session('cart', []);
        $id = $book->id;
        $quantity = $request->quantity;
        if ($book->stock < $quantity) {
            return back()->with('error', 'No hay suficiente stock disponible.');
        }
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
            if ($cart[$id]['quantity'] > $book->stock) {
                $cart[$id]['quantity'] = $book->stock;
            }
        } else {
            $cart[$id] = [
                'id' => $book->id,
                'title' => $book->title,
                'price' => $book->price,
                'quantity' => $quantity,
                'stock' => $book->stock,
            ];
        }
        session(['cart' => $cart]);
        return redirect()->route('cart.index')->with('success', 'Libro agregado al carrito.');
    }

    public function update(Request $request)
    {
        $cart = session('cart', []);
        $quantities = $request->input('quantity', []);
        foreach ($quantities as $id => $quantity) {
            if (isset($cart[$id])) {
                $book = Book::find($id);
                if ($book && $quantity > 0 && $quantity <= $book->stock) {
                    $cart[$id]['quantity'] = $quantity;
                } elseif ($quantity <= 0) {
                    unset($cart[$id]);
                }
            }
        }
        session(['cart' => $cart]);
        return back()->with('success', 'Carrito actualizado.');
    }

    public function remove($id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);
        return back()->with('success', 'Libro eliminado del carrito.');
    }
}
