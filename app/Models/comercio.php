<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comercio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_comercio',
        'tipo_comercio',
        'medidor_anomalia',
        'medidor_cambio',
        'nuevo_comercio'
    ];

    public function ReportesLecutra()
    {
        return $this->belongsTo(reportes::class,'id');
    }
}
