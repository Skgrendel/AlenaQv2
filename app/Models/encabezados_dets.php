<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class encabezados_dets extends Model
{
    use HasFactory;

    protected $fillable = [
        'encabezados_id',
        'nombre',
    ];

    
}
