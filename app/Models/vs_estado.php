<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\personals;

class vs_estado extends Model
{
    use HasFactory;
    protected $table = 'vs_estado';

    public function personal()
      {
          return $this->belongsTo(personals::class);
      }

      public function reporte()
      {
          return $this->belongsTo(reportes::class);
      }
}
