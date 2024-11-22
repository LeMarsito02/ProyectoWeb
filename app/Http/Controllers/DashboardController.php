<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Pedido;

class DashboardController extends Controller
{
    /**
     * Muestra la vista principal del dashboard con todos los pedidos.
     */
    public function index(Request $request)
    {
        // Filtrar por estado si se pasa como parámetro
        $estado = $request->get('estado');
        $pedidos = Pedido::with('cliente')
            ->when($estado, function ($query) use ($estado) {
                return $query->where('status', $estado);
            })
            ->get();

        return view('dashboard', compact('pedidos'));
    }

    /**
     * Devuelve los detalles de un pedido específico.
     */
    public function show($id)
    {
        $pedido = Pedido::with(['cliente', 'productos'])->findOrFail($id);

        return response()->json([
            'cliente' => $pedido->cliente,
            'productos' => $pedido->productos,
            'total' => $pedido->total,
        ]);
    }

    /**
     * Actualiza el estado de un pedido.
     */
 public function updateStatus(Request $request, $id)
 {
    // Log inicial
    Log::info("Inicio de actualización de estado para el pedido: $id");

    // Log de datos recibidos
    Log::info("Datos recibidos en la solicitud: ", [
        'id' => $id,
        'status' => $request->status
    ]);

    try {
        // Buscar el pedido
        $pedido = Pedido::findOrFail($id);

        // Log del pedido encontrado
        Log::info("Pedido encontrado: ", ['pedido' => $pedido]);

        // Actualizar el estado
        $pedido->status = $request->status;
        $pedido->save();

        // Log de éxito
        Log::info("Estado del pedido actualizado correctamente a: {$pedido->status}");

        return response()->json(['message' => 'Estado del pedido actualizado correctamente.']);
    } catch (\Exception $e) {
        // Log de error
        Log::error("Error al actualizar el estado del pedido: ", [
            'id' => $id,
            'status' => $request->status,
            'error' => $e->getMessage()
        ]);

        return response()->json(['message' => 'Error al actualizar el estado del pedido.'], 500);
    }
}
}
