<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vs_tipo_regulador extends Model
{
    use HasFactory;
    protected $table = 'vs_tipo_regulador';
 
    public function reporte()
    {
        return $this->belongsTo(reportes::class, 'id');
    }
}
