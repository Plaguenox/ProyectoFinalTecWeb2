<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderItem;

class OrderItemSeeder extends Seeder
{
    public function run()
    {
        OrderItem::insert([
            [
                'order_id' => 1,
                'book_id' => 31,
                'quantity' => 1,
                'price' => 90.00,
            ],
            [
                'order_id' => 2,
                'book_id' => 31,
                'quantity' => 1,
                'price' => 90.00,
            ],
        ]);
    }
}
