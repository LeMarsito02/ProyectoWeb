<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Definir los campos que pueden ser asignados masivamente
    protected $fillable = [
        'id',
        'name',
        'category',
        'price',
        'image',
        'availableDescription',
    ];
    public function pedidos()
{
    return $this->belongsToMany(Pedido::class, 'pedido_productos')
                ->withPivot('quantity', 'precio_unitario', 'subtotal')
                ->withTimestamps();
}

}
