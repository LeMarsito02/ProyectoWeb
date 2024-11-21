<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Producto::create([
            'name' => 'Pizza Margherita',
            'category' => 'pizza',
            'price' => 8.50,
            'image' => 'https://example.com/images/pizza-margherita.jpg',
            'availableDescription' => 'Pizza clásica con tomate y queso',
        ]);

        Producto::create([
            'name' => 'Pizza Pepperoni',
            'category' => 'pizza',
            'price' => 9.50,
            'image' => 'https://example.com/images/pizza-pepperoni.jpg',
            'availableDescription' => 'Pizza con salsa de tomate y pepperoni',
        ]);

        Producto::create([
            'name' => 'Coca Cola',
            'category' => 'drinks',
            'price' => 2.00,
            'image' => 'https://example.com/images/coca-cola.jpg',
            'availableDescription' => 'Refresco clásico Coca-Cola',
        ]);
    }
}
