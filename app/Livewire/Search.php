<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Search extends Component
{
    public $search = '';
    public $direccion = '';
    public $contrato = '';
    public $medidor = '';
    public $nombre_user = '';
    public $apellido = '';
    public $categoria = '';
    public $descripcion = '';
    public $estado_servicio = '';
    public $nombre_barrio = '';
    public $errorMessage = '';


    public function resetAll()
    {
        $this->reset('search', 'result', 'direccion', 'errorMessage');
    }

    public function SearchLocation()
{
    // Inicializar las variables
    $this->direccion = null;
    $this->estado_servicio = null;
    $this->nombre_user = null;
    $this->apellido = null;
    $this->nombre_barrio = null;
    $this->categoria = null;
    $this->descripcion = null;
    $this->medidor = null;
    $this->contrato = null;
    $this->errorMessage = null;

    //servicio de consulta
    $consulta = new DataGisService();

    $consulta->DataGisubicacion($this->search);

    // Verificar si hay datos y si el array 'features' tiene al menos un elemento
    if (!$consulta || !isset($consulta['features'][0])) {
        // Manejar el caso de error
        $this->errorMessage = 'No se encontró ninguna información con ese contrato.';
    } else {
        // Obtener los atributos de la primera característica
        $attributes = $consulta['features'][0]['attributes'];
        $this->direccion = $attributes['DIRECCION'];
        $this->estado_servicio = $attributes['ESTADOPRODUCTO'];
        $this->nombre_user = $attributes['NOMBREUSUARIO'];
        $this->apellido = $attributes['APELLIDO'];
        $this->nombre_barrio = $attributes['NOMBREBARRIO'];
        $this->categoria = $attributes['DESCATEGORIA'];
        $this->descripcion = $attributes['DESCRIPCION'];
        $this->medidor = $attributes['ELEMENTOMEDICION'];
        $this->contrato = $attributes['PRODUCT_ID'];
    }
}

    function render()
    {
        return view('livewire.search');
    }
}
