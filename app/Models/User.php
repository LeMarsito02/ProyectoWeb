<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Los campos que pueden ser asignados masivamente
    protected $fillable = [
        'name',
        'email',
        'password',
        'username', // Añadimos el campo username
    ];

    // Los campos que deben ser ocultos en la serialización
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Los campos que deben ser casteados a tipos específicos
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Configuración para la autenticación por 'username' en lugar de 'email'
    public function getAuthIdentifierName()
    {
        return 'username'; // Cambiamos email por username
    }

    // Puedes agregar otros métodos si lo deseas.
}

