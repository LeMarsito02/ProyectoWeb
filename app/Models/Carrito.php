<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    // Definir la tabla si el nombre no sigue la convención plural
    protected $table = 'carrito';

    // Atributos que son asignables masivamente
    protected $fillable = [
        'cliente_id', 'producto_id', 'quantity',
    ];

    // Relación con el cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Relación con el producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
