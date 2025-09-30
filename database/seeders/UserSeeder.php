<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
    // Eliminar todos los usuarios existentes (sin truncar por clave foránea)
    User::query()->delete();

        // Crear 3 usuarios nuevos
        User::insert([
            [
                'name' => 'Administrador',
                'email' => 'admin@library.com',
                'password' => bcrypt('admin1234'),
                'is_admin' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Juan Pérez',
                'email' => 'juan@example.com',
                'password' => bcrypt('usuario123'),
                'is_admin' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ana Torres',
                'email' => 'ana@example.com',
                'password' => bcrypt('usuario456'),
                'is_admin' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
