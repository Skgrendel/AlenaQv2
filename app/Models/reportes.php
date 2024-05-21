<?php

namespace App\Models;

use BaconQrCode\Renderer\RendererStyle\Fill;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reportes extends Model
{
    use HasFactory;

    static $rules = [
        'contrato' => 'required',
        'medidor' => 'required',
        'lectura' => 'required',
        'anomalia' => 'required',
        'imposibilidad' => 'required  ',
        'tipo_comercio' => 'required',
    ];

    protected $fillable = [
        'personals_id',
        'ubicacions_id',
        'comercios_id',
        'contrato',
        'medidor',
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
        return $this->belongsTo(personals::class,'id');
    }

    public function vs_estado()
    {
        return $this->hasOne(vs_estado::class, 'id', 'estado');
    }

    public function vs_imposibilidad()
    {
        return $this->hasOne(vs_imposibilidad::class, 'id', 'imposibilidad');
    }

    public function vs_anomalia()
    {
        return $this->hasOne(vs_anomalias::class, 'id', 'anomalia');
    }

    public function vs_comercio()
    {
        return $this->hasOne(vs_comercios::class, 'id', 'tipo_comercio');
    }

    public function report_ubicacion()
    {
        return $this->hasOne(ubicacion::class,'id','ubicacions_id');
    }

    public function report_comercio()
    {
        return $this->hasOne(comercio::class,'id','comercios_id');
    }


}
