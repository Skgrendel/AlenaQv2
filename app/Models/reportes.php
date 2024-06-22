<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reportes extends Model
{
    use HasFactory;

    static $rules = [
        'lectura' => 'required',
        'anomalia' => 'required',
        'imposibilidad' => 'required  ',
        'tipo_comercio' => 'required',
    ];

    protected $fillable = [
        'personals_id',
        'ubicacions_id',
        'comercios_id',
        'surtigas_id',
        'lectura',
        'anomalia',
        'imposibilidad',
        'comentarios',
        'observaciones',
        'imagenes',
        'video',
        'estado',
    ];

    public function personal()
    {
        return $this->hasOne(personals::class,'id','personals_id');
    }

    public function vs_estado()
    {
        return $this->hasOne(vs_estado::class, 'id', 'estado');
    }

    public function vs_imposibilidad()
    {
        return $this->hasOne(vs_imposibilidad::class, 'id', 'imposibilidad');
    }

    public function report_ubicacion()
    {
        return $this->hasOne(ubicacion::class,'id','ubicacions_id');
    }

    public function report_comercio()
    {
        return $this->hasOne(comercio::class,'id','comercios_id');
    }
    public function auditoria()
    {
        return $this->hasOne(auditoria::class,'id');
    }
    public function dbSurtigas()
    {
        return $this->hasOne(surtigas::class,'id','surtigas_id');
    }


}
