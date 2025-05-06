<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vs_marca_medidor extends Model
{
    use HasFactory;
    protected $table = 'vs_marca_medidor';

    public function reporte()
    {
        return $this->belongsTo(reportes::class,'id');
    }
}
