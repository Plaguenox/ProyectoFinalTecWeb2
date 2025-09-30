<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run()
    {
        Order::insert([
            [
                'id' => 1,
                'user_id' => 2, // Juan Pérez
                'total' => 90.00,
                'status' => 'completed',
            ],
            [
                'id' => 2,
                'user_id' => 3, // Ana Torres
                'total' => 90.00,
                'status' => 'pending',
            ],
            [
                'id' => 3,
                'user_id' => 2, // Juan Pérez
                'total' => 120.00,
                'status' => 'completed',
            ],
            [
                'id' => 4,
                'user_id' => 2, // Juan Pérez
                'total' => 175.00,
                'status' => 'cancelled',
            ],
        ]);
    }
}
