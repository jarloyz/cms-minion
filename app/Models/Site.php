<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = [
        'nombre_empresa',
        'slug',
        'logo',
        'imagen_principal',
        'color_principal',
        'color_secundario',
        'telefono',
        'email',
        'direccion',
        'slogan',
        'titulo_hero',
        'texto_hero',
        'quienes_somos',
        'caracteristicas',
        'servicios',
        'textos_ui',
    ];

    protected function casts(): array
    {
        return [
            'caracteristicas' => 'array',
            'servicios' => 'array',
            'textos_ui' => 'array',
        ];
    }
}
