<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Definir la tabla si el nombre no sigue la convención plural
    protected $table = 'clientes';

    // Atributos que son asignables masivamente
    protected $fillable = [
        'name', 'phone', 'address',
    ];

    // Relación con el carrito (un cliente puede tener varios productos en su carrito)
    public function carrito()
    {
        return $this->hasMany(Carrito::class);
    }

    // Relación con los pedidos (un cliente puede hacer varios pedidos)
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
