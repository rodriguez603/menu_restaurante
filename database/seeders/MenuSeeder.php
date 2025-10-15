<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Platillo;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Limpieza
        \DB::table('platillos')->delete();
        \DB::table('categorias')->delete();

        // Categorías
        $comidas = Categoria::create(['nombre' => 'Comidas','slug' => 'comidas']);
        $bebidas = Categoria::create(['nombre' => 'Bebidas','slug' => 'bebidas']);

        // 9 COMIDAS con imágenes reales
        $foods = [
            ['Enchiladas Suizas',
                'Tortillas de maíz rellenas de pollo, cubiertas con salsa de crema y queso.',
                'Tortillas de maíz, pollo, crema, queso, cebolla, cilantro.',
                187.00, 'enchiladas.jpeg'],
            ['Milanesa Hawaiana',
                'Milanesa de carne empanizada y frita, servida con piña y queso.',
                'Carne de res, piña, queso, pan rallado, huevo.',
                225.00, 'milanesa.jpg'],
            ['Tacos Dorados de Pollo',
                'Tacos dorados rellenos de pollo deshebrado, servidos con salsa y crema.',
                'Tortillas de maíz, pollo, salsa, crema, queso.',
                143.00, 'tacos.jpg'],
            ['Carne Asada',
                'Carne de res asada a la parrilla, servida con arroz y frijoles.',
                'Carne de res, arroz, frijoles, cebolla, cilantro.',
                217.00, 'asada.jpeg'],
            ['Arrachera Norteña',
                'Carne de res asada a la parrilla, servida con nopales y cebolla.',
                'Carne de res, nopales, cebolla, cilantro.',
                283.00, 'arrachera.webp'],
            ['Chilaquiles Rojos',
                'Tortillas de maíz fritas en salsa roja, servidas con crema y queso.',
                'Tortillas de maíz, salsa roja, crema, queso, cebolla.',
                153.00, 'chilaquiles.jpg'],
            ['Molletes Tradicionales',
                'Pan francés tostado con frijoles refritos y queso.',
                'Pan francés, frijoles refritos, queso.',
                145.00, 'molletes.jpg'],
            ['Enfrijoladas con Pollo',
                'Tortillas de maíz rellenas de pollo, cubiertas con salsa de frijol y queso.',
                'Tortillas de maíz, pollo, salsa de frijol, queso.',
                171.00, 'enfrijoladas.jpeg'],
            ['Chiles Rellenos',
                'Chiles poblanos rellenos de queso o carne, capeados y servidos con salsa de tomate.',
                'Chiles poblanos, queso o carne, salsa de tomate.',
                180.00, 'chilerelleno.webp'],
        ];

        foreach ($foods as [$n,$d,$i,$p,$img]) {
            Platillo::create([
                'categoria_id' => $comidas->id,
                'nombre' => $n,
                'descripcion' => $d,
                'ingredientes' => $i,
                'imagen' => $img,
                'precio' => $p,
            ]);
        }

        // 6 BEBIDAS con imágenes reales
        $drinks = [
            ['Jugo de Naranja','Jugo de naranja fresco y natural.','Naranjas.',61.00,'naranja.jpg'],
            ['Pepsi Black','Refresco de cola sin azúcar.','Cola, edulcorante artificial.',52.00,'PEPSI-BLACK.png'],
            ['7Up Original','Refresco de limón sin azúcar.','Limón, edulcorante artificial.',52.00,'7Up.webp'],
            ['Mirinda Naranja','Refresco de naranja.','Naranja, azúcar.',52.00,'mirinda.webp'],
            ['Manzanita Sol','Refresco de manzana.','Manzana, azúcar.',52.00,'manzanita.webp'],
            ['Café Americano','Café negro caliente.','Café.',38.00,'cafe.jpg'],
        ];

        foreach ($drinks as [$n,$d,$i,$p,$img]) {
            Platillo::create([
                'categoria_id' => $bebidas->id,
                'nombre' => $n,
                'descripcion' => $d,
                'ingredientes' => $i,
                'imagen' => $img,
                'precio' => $p,
            ]);
        }
    }
}
