<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class surtigas extends Model
{
    use HasFactory;

    protected $fillable = ['personals_id','contrato','direccion','latitud','longitud','ciclo','estado'];

    public function personal(){
        return $this->belongsTo(personals::class, 'id');
    }

}
