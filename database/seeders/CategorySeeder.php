<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::insert([
            [
                'id' => 2,
                'name' => 'No Ficción',
                'description' => 'Libros basados en eventos, personas y temas reales',
            ],
            [
                'id' => 4,
                'name' => 'Misterio',
                'description' => 'Libros que implican crímenes, acertijos y trabajo de detective',
            ],
            [
                'id' => 6,
                'name' => 'Romance',
                'description' => 'un género literario que se centra en las relaciones amorosas entre personajes, explorando sus emociones y conflictos',
            ],
            [
                'id' => 7,
                'name' => 'Ficcion',
                'description' => 'es una obra literaria que narra historias inventadas, que no se basan en hechos reales o personas que hayan existido',
            ],
            [
                'id' => 8,
                'name' => 'Terror',
                'description' => 'obras de ficción cuyo principal objetivo es generar miedo, horror o terror en el lector, a través de elementos sobrenaturales, psicológicos o situaciones que perturban la realidad.',
            ],
        ]);
    }
}
