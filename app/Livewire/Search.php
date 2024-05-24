<?php

namespace App\Livewire;

use App\Models\direcciones;
use Livewire\Component;

class Search extends Component
{
    public $search = '';
    public $result = '';
    public $direccion = '';
    public $errorMessage = '';

    public function resetAll()
{
    $this->reset('search', 'result', 'direccion', 'errorMessage');
}

    public function SearchLocation()
    {
        $this->errorMessage = null;
        $dir = direcciones::where('contrato', $this->search)->first();

        if ($dir === null) {
            // Manejar el caso de error aquí. Por ejemplo, puedes establecer un mensaje de error en una variable.
            $this->errorMessage = 'No se encontró ninguna dirección con ese contrato.';
        } else {
            $src = $dir->latitud . ',' . $dir->longitud;
            $this->result = $src;
            $this->direccion = $dir->direccion;
        }
    }

    function render()
    {
        return view('livewire.search');
    }
}
