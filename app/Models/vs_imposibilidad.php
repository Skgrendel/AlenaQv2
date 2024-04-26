<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vs_imposibilidad extends Model
{
    use HasFactory;
    protected $table = 'vs_imposibilidades';

   

      public function reporte()
      {
          return $this->belongsTo(reportes::class);
      }
}
