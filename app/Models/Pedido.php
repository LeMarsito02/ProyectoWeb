<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    // Definir la tabla si el nombre no sigue la convención plural
    protected $table = 'pedidos';

    // Atributos que son asignables masivamente
    protected $fillable = [
        'cliente_id', 'total', 'tax', 'delivery_type', 'status',
    ];

    // Relación con los productos (un pedido puede tener muchos productos)
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'pedido_producto')
                    ->withPivot('quantity'); // Necesitamos la cantidad también
    }

    // Relación con el cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
