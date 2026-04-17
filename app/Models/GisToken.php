<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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
     * Solo retorna si está REALMENTE vigente
     */
    public static function getActiveToken()
    {
        $token = self::where('activo', true)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                      ->orWhere('expires_at', '>', Carbon::now());
            })
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$token) {
            Log::warning('No hay token válido en BD (todos expirados o ausentes)');
            return config('app.gis_api_token');
        }

        // Verificar que realmente no esté expirado
        if ($token->expires_at && $token->expires_at->isPast()) {
            Log::warning('Token en BD está expirado: ' . $token->expires_at->toDateTimeString());
            return null;
        }

        Log::info('Token válido en BD, expira en ' . $token->expires_at->diffInMinutes(Carbon::now()) . ' minutos');
        return $token->token;
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
