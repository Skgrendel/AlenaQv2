<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class vs_anomalias extends Model
{
    use HasFactory;
    protected $table = 'vs_anomalias';

    public function personal()
      {
          return $this->belongsTo(personals::class);
      }

      public function reporte()
      {
          return $this->belongsTo(reportes::class);
      }
}
