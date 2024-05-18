<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ubicacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'direccion',
        'latitud',
        'longitud',
    ];

    public function ReportesLecutra()
    {
        return $this->belongsTo(reportes::class,'id');
    }
}
