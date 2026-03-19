<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class GisToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'descripcion',
        'activo',
        'expires_at'
    ];

    protected $casts = [
        'activo' => 'boolean',
        'expires_at' => 'datetime',
    ];

    /**
     * Obtener el token activo y válido
     */
    public static function getActiveToken()
    {
        $token = self::where('activo', true)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                      ->orWhere('expires_at', '>', Carbon::now());
            })
            ->first();

        if ($token) {
            return $token->token;
        }

        // Fallback al token de configuración si no hay ninguno activo
        return config('app.gis_api_token');
    }

    /**
     * Verificar si el token está próximo a expirar
     */
    public static function isTokenExpiringSoon()
    {
        $token = self::where('activo', true)->first();

        if (!$token) {
            return true;
        }

        if (!$token->expires_at) {
            return false;
        }

        // Renovar si expira en menos de 5 minutos
        return $token->expires_at->diffInMinutes(Carbon::now()) <= 5;
    }
}
