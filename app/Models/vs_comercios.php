<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vs_comercios extends Model
{
    use HasFactory;

    protected $table = 'vs_comercios';

    

      public function reporte()
      {
          return $this->belongsTo(reportes::class);
      }
}
