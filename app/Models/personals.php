<?php

namespace App\Models;


use App\Models\vs_tipo_documento;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personals extends Model
{
    use HasFactory;

    static $rules = [
        'tipo_documento' => 'required',
        'numero_documento' => 'required',
        'nombres' => 'required|string',
        'apellidos' => 'required|string',
        'telefono' => 'required',
        'correo' => 'required|email',
    ];

    protected $fillable = [
        'tipo_documento',
        'numero_documento',
        'nombres',
        'telefono',
        'apellidos',
        'correo',
        'estado',
    ];

    public function usuarios()
    {
        return $this->hasOne(User::class);
    }

    public function vs_tipodocumento()
    {

        return $this->hasOne(vs_tipo_documento::class, 'id', 'tipo_documento');
    }

    public function vs_estado()
    {
        return $this->hasOne(vs_estado::class, 'id', 'estado');
    }

    public function reportes()
    {
        return $this->belongsTo(reportes::class,'personals_id');
    }
    public function dbs_surtigas()
    {
        return $this->hasOne(dbssurtigas::class,'personals_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
