<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run()
    {
        Contact::insert([
            [
                'name' => 'liz',
                'email' => 'liz@gmail.com',
                'subject' => 'dcac',
                'message' => 'vsdvsd',
                'created_at' => now(),
            ],
        ]);
    }
}
