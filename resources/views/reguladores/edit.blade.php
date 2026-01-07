@extends('layouts.frontpage.app')

@section('content')
    <div class="col">
        <div class="widget widget-chart-three">
            <div class="widget-heading">
                <div class="widget-content">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Editar Regulador</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('reguladores.update', $regulador) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                                    <input type="text"
                                           class="form-control @error('nombre') is-invalid @enderror"
                                           id="nombre"
                                           name="nombre"
                                           value="{{ old('nombre', $regulador->nombre) }}"
                                           placeholder="Ej: Regulador de Baja Presión"
                                           required>
                                    @error('nombre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nomenclatura" class="form-label">Nomenclatura <span class="text-danger">*</span></label>
                                    <input type="text"
                                           class="form-control @error('nomenclatura') is-invalid @enderror"
                                           id="nomenclatura"
                                           name="nomenclatura"
                                           value="{{ old('nomenclatura', $regulador->nomenclatura) }}"
                                           placeholder="Ej: RBP001"
                                           required>
                                    @error('nomenclatura')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted d-block">
                                        Código o nomenclatura única para identificar este regulador
                                    </small>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Guardar Cambios
                                    </button>
                                    <a href="{{ route('reguladores.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Cancelar
                                    </a>
                                </div>
                            </form>
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

    @if ($errors->any())
        <script>
            Swal.fire({
                title: 'Error en la validación',
                text: 'Por favor verifica los datos ingresados',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
@endsection
