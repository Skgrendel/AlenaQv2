<div>
    <div class="card mb-2">
        <div class="card-body">
            <form wire:submit.prevent="SearchLocation">
                <label for="search" class="form-label">Informacion de Contrato</label>
                <div class="input-group mb-3">
                    <input type="search" wire:model="search" class="form-control" id="search"
                        placeholder="Numero de Contrato" aria-describedby="button-search" required>
                    <button class="btn btn-outline-primary" type="submit" id="button-search">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>


    @if ($contrato)
    <div class="card">
        <div class="card-body ">
            <h2 class=" text-center">Datos del usuario</h2>
            <div class="col-12 mb-2">
                <label for="direccion" class="form-label"><strong>Direccion del Contrato</strong> </label><br>
                <span class="form-control" id="direccion">{{ $direccion }}</span>
            </div>
            <div class="col-12 mb-2">
                <label for="direccion" class="form-label"><strong>Barrio</strong> </label><br>
                <span class="form-control" id="direccion">{{ $nombre_barrio }}</span>
            </div>
            <div class="col-12 mb-2">
                <label for="direccion" class="form-label"><strong>Nombre del Usuario</strong></label><br>
                <span class="form-control" id="direccion">{{ $nombre_user }}</span>
            </div>
            <div class="col-12 mb-2">
                <label for="direccion" class="form-label"><strong>Medidor</strong></label><br>
                <span class="form-control" id="direccion">{{ $medidor }}</span>
            </div>
            <div class="col-12 mb-2">
                <label for="direccion" class="form-label"><strong>Categoria</strong></label><br>
                <span class="form-control" id="direccion">{{ $categoria }}</span>
            </div>
            <div class="col-12 mb-2">
                <label for="direccion" class="form-label"><strong>Estado del Servicio</strong></label><br>
                <span class="form-control" id="direccion">{{ $estado_servicio }}</span>
            </div>
            <div class="col-12 mb-2">
                <label for="direccion" class="form-label"><strong>Descripcion</strong></label><br>
                <span class="form-control" id="direccion">{{ $descripcion }}</span>
            </div>
        </div>
    </div>
    @endif
    @if ($errorMessage)
    <div class="card">
        <div class="card-body">
            <div class="alert alert-danger text-center" role="alert">
               {{$errorMessage}}
              </div>
        </div>
    </div>
    @endif
</div>
</div>
