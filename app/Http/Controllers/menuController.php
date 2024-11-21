<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;

class menuController extends Controller
{
    public function index()
    {
        // Aquí obtendrías los productos desde la base de datos
        $menuItems = Producto::all();

        return response()->json($menuItems);
    }
    public function store(Request $request)
    {
        // Valida los datos del pedido
        $validated = $request->validate([
            'cliente.nombre' => 'required|string|max:255',
            'cliente.telefono' => 'required|string|max:20',
            'cliente.direccion' => 'required|string|max:255',
            'pedido' => 'required|array',
            'pedido.*.nombre' => 'required|string',
            'pedido.*.precio' => 'required|numeric',
        ]);

        // Guardar el pedido en la base de datos (por ejemplo, en una tabla `orders`)
        // Aquí es donde podrías usar un modelo para guardar el pedido
        // \App\Models\Order::create($validated);

        // Responde al frontend con un mensaje de éxito
        return response()->json(['success' => true, 'message' => 'Pedido procesado con éxito']);
    }
}
