@extends('layouts.frontpage.app')

@section('content')
    <div class="col">
        <div class="widget widget-chart-three">
            <div class="widget-heading">
                <div class="widget-content">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form id="ciclo" action="{{ route('configs.update', $data->id) }}" method="post">
                                        @method('put')
                                        @csrf
                                        <div class="form-group">
                                            <label for="ciclos">Seleccione el Ciclo Actual</label>
                                            <select class="form-select" aria-label="ciclos" name="ciclo" id="ciclos"
                                                required>
                                                <option selected>Seleccione el numero de Ciclo</option>
                                                @foreach ($ciclos as $id => $nombre)
                                                    <option
                                                        value="{{ $id }}"{{ $data->ciclo == $id ? 'selected' : '' }}>
                                                        {{ $nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                    <button type="submit" form="ciclo" class="btn btn-primary mt-2">Guardar
                                        Ciclo</button>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-text mb-3">
                                        <h6>Opciones Adicionales</h6>
                                        <a href="{{ route('reguladores.index') }}" class="btn btn-info btn-sm w-100">
                                            <i class="fas fa-cogs"></i> Gestionar Reguladores
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @if (session('success'))
        <script>
            Swal.fire({
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
@endsection
