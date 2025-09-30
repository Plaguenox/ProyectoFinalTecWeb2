<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderReceiptMail;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }
        return view('checkout.index', compact('cart'));
    }

    public function process(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío.');
        }
        $request->validate([
            'payment_method' => 'required',
        ]);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'pagado',
            'total' => $total,
        ]);
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
            // Actualizar stock
            $book = Book::find($item['id']);
            if ($book) {
                $book->stock = max(0, $book->stock - $item['quantity']);
                $book->save();
            }
        }
        // Envío de recibo de compra (desactivado)
        // Mail::to(Auth::user()->email)->send(new OrderReceiptMail());
        session()->forget('cart');
        return redirect()->route('orders.index')->with('success', '¡Compra realizada con éxito!');
    }
}
