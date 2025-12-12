<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GisToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'descripcion',
        'activo'
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    /**
     * Obtener el token activo
     */
    public static function getActiveToken()
    {
        $token = self::where('activo', true)->first();

        if ($token) {
            return $token->token;
        }

        // Fallback al token de configuración si no hay ninguno activo
        return config('app.gis_api_token');
    }
}
