<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class auditoria extends Model
{
    use HasFactory;
    protected $table = 'auditorias';
    protected $fillable = ['reportes_id','medidor_coincide','lectura_correcta','foto_correcta','comercio_coincide','revisado','confirmado_anomalia','observaciones'];

    public function ReportesLecutra()
    {
        return $this->hasOne(reportes::class,'id','reportes_id' );
    }
}
