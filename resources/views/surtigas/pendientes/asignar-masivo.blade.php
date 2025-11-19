@extends('layouts.frontpage.app')

@section('content')
    <div class="container mt-6">
        <div class="row">
            <div class="col-xl-8 offset-xl-2 bg-white rounded p-4">
                <h3 class="mb-4">Asignación Masiva de Personal por Ciclo</h3>

                <div class="alert alert-info" role="alert">
                    <i class="fas fa-info-circle"></i>
                    <strong>Información:</strong> Selecciona un ciclo y un personal para asignar a todos los surtigas pendientes de ese ciclo.
                </div>

                <form action="{{ route('surtigas.guardar-asignacion-masiva') }}" method="POST">
                    @csrf

                    <div class="form-group mb-4">
                        <label for="ciclo" class="form-label">
                            <strong>Seleccionar Ciclo</strong>
                        </label>
                        <select name="ciclo" id="ciclo" class="form-control @error('ciclo') is-invalid @enderror" required>
                            <option value="">-- Seleccionar ciclo --</option>
                            @foreach ($ciclos as $ciclo)
                                <option value="{{ $ciclo }}" @selected(old('ciclo') == $ciclo)>
                                    {{ $ciclo }}
                                </option>
                            @endforeach
                        </select>
                        @error('ciclo')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
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

                    <div class="alert alert-warning" id="resumenAsignacion" style="display: none;">
                        <strong>Resumen:</strong>
                        <p>Se asignarán <strong id="cantidadPendientes">0</strong> surtigas al personal seleccionado.</p>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-users"></i> Asignar Masivamente
                        </button>
                        <a href="{{ route('surtigas.pendientes') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('ciclo').addEventListener('change', function() {
            const ciclo = this.value;
            if (ciclo) {
                // Aquí puedes hacer una llamada AJAX para obtener la cantidad de pendientes
                // Por ahora, solo mostramos el formulario listo
                document.getElementById('resumenAsignacion').style.display = 'block';
            } else {
                document.getElementById('resumenAsignacion').style.display = 'none';
            }
        });
    </script>
@endsection
