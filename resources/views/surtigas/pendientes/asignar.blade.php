@extends('layouts.frontpage.app')

@section('content')
    <div class="container mt-6">
        <div class="row">
            <div class="col-xl-8 offset-xl-2 bg-white rounded p-4">
                <h3 class="mb-4">Asignar Personal a Surtiga</h3>

                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>Contrato:</strong>
                                <p class="text-primary">{{ $surtiga->contrato }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Cliente:</strong>
                                <p>{{ $surtiga->cliente }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Ciclo:</strong>
                                <p class="badge badge-info">{{ $surtiga->ciclo }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Dirección:</strong>
                                <p>{{ $surtiga->direccion }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('surtigas.guardar-asignacion', $surtiga->id) }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="personals_id" class="form-label">
                            <strong>Seleccionar Personal</strong>
                        </label>
                        <select name="personals_id" id="personals_id" class="form-control @error('personals_id') is-invalid @enderror" required>
                            <option value="">-- Seleccionar un personal --</option>
                            @foreach ($personals as $id => $nombre)
                                <option value="{{ $id }}" @selected(old('personals_id') == $id)>
                                    {{ $nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('personals_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check"></i> Asignar Personal
                        </button>
                        <a href="{{ route('surtigas.pendientes') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
