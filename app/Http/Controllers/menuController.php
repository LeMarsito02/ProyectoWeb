<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


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
        Log::info('Iniciando la creación del pedido', ['request' => $request->all()]);
    
        try {
            $validated = $request->validate([
                'cliente.nombre' => 'required|string|max:255',
                'cliente.telefono' => 'required|string|max:20',
                'cliente.direccion' => 'required|string|max:255',
                'productos' => 'required|array',
                'productos.*.producto_id' => 'required|exists:productos,id',
                'productos.*.quantity' => 'required|integer|min:1',
                'productos.*.precio_unitario' => 'required|numeric|min:0',
            ]);
            Log::info('Datos validados correctamente', ['validated_data' => $validated]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Error en la validación', ['errors' => $e->errors()]);
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        }
        
    
        // Crear o buscar al cliente
        $cliente = Cliente::firstOrCreate(
            ['name' => $validated['cliente']['nombre'], 'phone' => $validated['cliente']['telefono']],
            ['address' => $validated['cliente']['direccion']]
        );
        
        Log::info('Cliente creado o encontrado', ['cliente' => $cliente]);
    
        // Calcular el total
        $total = collect($validated['productos'])->sum(function ($producto) {
            return $producto['quantity'] * $producto['precio_unitario'];
        });
    
        Log::info('Total calculado', ['total' => $total]);
    
        // Crear el pedido
        $pedido = Pedido::create([
            'cliente_id' => $cliente->id,
            'total' => $total,
            'tax' => 0, // Ajusta esto según sea necesario
            'delivery_type' => 'domicilio',
            'status' => 'pendiente',
        ]);
    
        Log::info('Pedido creado', ['pedido' => $pedido]);
    
        // Agregar productos al pedido
        foreach ($validated['productos'] as $producto) {
            $pedido->productos()->attach($producto['producto_id'], [
                'quantity' => $producto['quantity'],
                'precio_unitario' => $producto['precio_unitario'],
                'subtotal' => $producto['quantity'] * $producto['precio_unitario'],
            ]);
            
            Log::info('Producto agregado al pedido', ['producto_id' => $producto['producto_id'], 'quantity' => $producto['quantity']]);
        }
    
        Log::info('Pedido finalizado con éxito', ['pedido_id' => $pedido->id]);
    
        return response()->json(['success' => true, 'message' => 'Pedido creado con éxito']);
    }
    
    
}
