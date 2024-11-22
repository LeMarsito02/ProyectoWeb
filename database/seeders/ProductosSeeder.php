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
        $productos = [
            [
                'name' => 'Pizza de Pepperoni',
                'category' => 'pizza',
                'price' => 40000,
                'image' => 'Assets/MenuProductos/pizzapeperoni.png',
                'availableDescription' => 'La clásica de toda la vida',
            ],
            [
                'name' => 'Pizza de Queso',
                'category' => 'pizza',
                'price' => 40000,
                'image' => 'Assets/MenuProductos/pizzaqueso.png',
                'availableDescription' => 'Muy rica y sabrosa',
            ],
            [
                'name' => 'Pizza Vegetariana',
                'category' => 'pizza',
                'price' => 35000,
                'image' => 'Assets/MenuProductos/pizzavegetariana.png',
                'availableDescription' => 'Only vegetarianos',
            ],
            [
                'name' => 'Pizza Hawaiana',
                'category' => 'pizza',
                'price' => 45000,
                'image' => 'Assets/MenuProductos/pizzahawaiana.png',
                'availableDescription' => 'La mejor pizza de Hawaii',
            ],
            [
                'name' => 'Pizza de Pollo BBQ',
                'category' => 'pizza',
                'price' => 50000,
                'image' => 'Assets/MenuProductos/pizzabbq.png',
                'availableDescription' => 'Con pollo BBQ',
            ],
            [
                'name' => 'Pizza Margherita',
                'category' => 'pizza',
                'price' => 70000,
                'image' => 'Assets/MenuProductos/pizzamarguerita.png',
                'availableDescription' => 'Una pizza italiana',
            ],
            [
                'name' => 'Coca-Cola',
                'category' => 'drinks',
                'price' => 5000,
                'image' => 'Assets/MenuProductos/cocacola.png',
                'availableDescription' => 'Una Coke',
            ],
            [
                'name' => 'Pepsi',
                'category' => 'drinks',
                'price' => 10000,
                'image' => 'Assets/MenuProductos/pepsi.png',
                'availableDescription' => 'Peor que la Coca-Cola',
            ],
            [
                'name' => 'Heladito',
                'category' => 'dessert',
                'price' => 8000,
                'image' => 'Assets/MenuProductos/helado.png',
                'availableDescription' => 'El mejor helado de Colombia',
            ],
            [
                'name' => 'Torta de chocolate',
                'category' => 'dessert',
                'price' => 15000,
                'image' => 'Assets/MenuProductos/CakeChocolate.png',
                'availableDescription' => 'Una torta muy rica',
            ],
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}
