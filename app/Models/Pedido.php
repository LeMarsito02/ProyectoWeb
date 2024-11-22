<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'cliente_id', 
        'total', 
        'tax', 
        'delivery_type', 
        'status',
    ];

    // Relación muchos a muchos con datos adicionales en `pedido_productos`
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'pedido_productos')
                    ->withPivot('quantity', 'precio_unitario', 'subtotal')
                    ->withTimestamps();
    }
        public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }


}
