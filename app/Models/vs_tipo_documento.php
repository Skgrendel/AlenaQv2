<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\personals;

class vs_tipo_documento extends Model
{
    use HasFactory;
    protected $table = 'vs_tipo_documento';
    /**
       * @return \Illuminate\Database\Eloquent\Relations\HasOne
       */

      public function personal()
      {
          return $this->belongsTo(personals::class);
      }
}
