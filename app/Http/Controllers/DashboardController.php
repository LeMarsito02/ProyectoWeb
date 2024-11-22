<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;

class DashboardController extends Controller
{
        public function index()
    {
        $pedidos = Pedido::with('cliente')->get();

        return view('dashboard', compact('pedidos'));
    }
    public function show($id)
    {
        $pedido = Pedido::with(['cliente', 'productos'])->findOrFail($id);

        return response()->json([
            'cliente' => $pedido->cliente,
            'productos' => $pedido->productos,
            'total' => $pedido->total,
        ]);
    }

}
