<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Definir los campos que pueden ser asignados masivamente
    protected $fillable = [
        'name',
        'category',
        'price',
        'image',
        'availableDescription',
    ];
}
