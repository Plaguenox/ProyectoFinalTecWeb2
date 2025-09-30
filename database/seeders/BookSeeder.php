<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run()
    {
        $books = [
            [
                'id' => 31,
                'title' => 'Bajo un cielo escarlata',
                'author' => 'Mark Sullivan',
                'description' => '"Bajo un cielo escarlata" es una novela de Mark Sullivan que cuenta la historia de Pino Lella, un joven italiano que se une a una red clandestina para ayudar a judíos a escapar a través de los Alpes durante la Segunda Guerra Mundial.',
                'price' => 90.00,
                'stock' => 98,
                'category_id' => 4,
                'image_path' => 'images/books/6814526554df9.jpg',
                'isbn' => '9788491292982',
                'pdf_url' => 'https://cdn.bookey.app/files/pdf/book/es/bajo-un-cielo-escarlata.pdf',
            ],
            [
                'id' => 30,
                'title' => 'Primavera con una esquina rota',
                'author' => 'Mario Benedetti',
                'description' => 'es una novela que explora el exilio y la dictadura en Uruguay, presentando una visión esperanzada sobre el futuro del país, aunque marcado por la pérdida y el dolor. El título refleja la idea de que la primavera, símbolo de renovación, llega a pesar de las heridas y las dificultades.',
                'price' => 75.00,
                'stock' => 50,
                'category_id' => 6,
                'image_path' => 'images/books/681452451222c.jpg',
                'isbn' => '9788579621048',
                'pdf_url' => 'https://scispace.com/pdf/primavera-con-una-esquina-rota-de-mario-benedetti-de-la-318xs2sa7g.pdf',
            ],
            [
                'id' => 33,
                'title' => 'La chica del tren',
                'author' => 'Paula Hawkins',
                'description' => 'La novela detalla las dificultades de Rachel Watson, la protagonista, mientras lidia con el divorcio, el alcoholismo y la pérdida de su trabajo',
                'price' => 80.00,
                'stock' => 15,
                'category_id' => 4,
                'image_path' => 'images/books/681452aaeae14.jpg',
                'isbn' => '9788501105417',
                'pdf_url' => 'https://sallebelllo.edu.co/images/La_chica_del_tren_-_Paula_Hawkins.pdf',
            ],
            [
                'id' => 34,
                'title' => 'La pareja de al lado',
                'author' => 'Shari Larena',
                'description' => 'Nunca se sabe lo que ocurre en la casa de al lado. Dos parejas, dos casas y una montaña rusa de mentiras, traición y secretos entre maridos y mujeres.',
                'price' => 45.00,
                'stock' => 5,
                'category_id' => 4,
                'image_path' => 'images/books/681452de63372.jpg',
                'isbn' => '9783732540297',
                'pdf_url' => 'https://cdn.bookey.app/files/pdf/book/es/la-pareja-de-al-lado.pdf',
            ],
            [
                'id' => 35,
                'title' => 'La sexta extincion',
                'author' => 'Elizabeth Kolbert',
                'description' => 'se refiere a la actual crisis de biodiversidad, donde la tasa de extinción de especies es alarmantemente alta y atribuida principalmente a las actividades humanas',
                'price' => 50.00,
                'stock' => 3,
                'category_id' => 2,
                'image_path' => 'images/books/68145312ba52a.png',
                'isbn' => '9783518740620',
                'pdf_url' => 'https://www.planetadelibros.com.co/libros_contenido_extra/31/30322_1_Sexta_extincion.pdf',
            ],
            [
                'id' => 36,
                'title' => 'El giro',
                'author' => 'Stephen Greenblatt',
                'description' => 'El "giro" puede referirse a varias cosas, incluyendo una rotación, una transferencia bancaria, un giro postal, una carrera ciclista (el Giro de Italia), o un libro.',
                'price' => 100.00,
                'stock' => 75,
                'category_id' => 2,
                'image_path' => 'images/books/6814533b86bd6.jpg',
                'isbn' => '9780393083385',
                'pdf_url' => 'https://proassetspdlcom.cdnstatics2.com/usuarios/libros_contenido/arxius/29/28159_El%20giro.pdf',
            ],
            [
                'id' => 41,
                'title' => 'Los viajes de Gulliver',
                'author' => 'Jonathan Swift',
                'description' => 'es una novela satírica que relata los viajes de Lemuel Gulliver, un cirujano y capitán de barco, a diversos países y tierras fantásticas',
                'price' => 50.00,
                'stock' => 30,
                'category_id' => 7,
                'image_path' => 'images/books/68145c0166eca.jpg',
                'isbn' => '9788366339521',
                'pdf_url' => 'https://cdn.prueebat.org/recursos/recursos/libros/pdf/Gulliver.pdf',
            ],
            [
                'id' => 42,
                'title' => 'El Fantasma de la Ópera',
                'author' => 'Gaston Leroux',
                'description' => 'novela de terror gótico escrita por Gastón Leroux en 1910, que narra la historia de un genio musical deforme, conocido como el Fantasma, que se obsesiona con una joven soprano, Christine Daaé',
                'price' => 80.00,
                'stock' => 60,
                'category_id' => 8,
                'image_path' => 'images/books/68145cc11468e.jpg',
                'isbn' => '9788469836620',
                'pdf_url' => 'https://cdn.prueebat.org/recursos/recursos/El-fantasma-opera.pdf',
            ],
        ];
        // Copiar imágenes desde Biblioteca/images/books a public/images/books
        foreach ($books as $book) {
            $filename = basename($book['image_path']);
            $source = base_path('Biblioteca/images/books/' . $filename);
            $dest = public_path('images/books/' . $filename);
            if (file_exists($source) && !file_exists($dest)) {
                if (!is_dir(public_path('images/books'))) {
                    mkdir(public_path('images/books'), 0777, true);
                }
                copy($source, $dest);
            }
        }
        Book::insert($books);
    }
}
