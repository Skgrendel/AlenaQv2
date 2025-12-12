@extends('layouts.frontpage.app')

@section('content')
    <div class="col">
        <div class="widget widget-chart-three">
            <div class="widget-heading">
                <div class="widget-content">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Crear Nuevo Token GIS</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('gis-tokens.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="token" class="form-label">Token <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('token') is-invalid @enderror"
                                              id="token"
                                              name="token"
                                              rows="4"
                                              required
                                              placeholder="Ingrese el token GIS">{{ old('token') }}</textarea>
                                    @error('token')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Pegue aquí el token completo proporcionado por el servicio GIS
                                    </small>
                                </div>

                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <input type="text"
                                           class="form-control @error('descripcion') is-invalid @enderror"
                                           id="descripcion"
                                           name="descripcion"
                                           value="{{ old('descripcion') }}"
                                           placeholder="Ej: Token producción enero 2025">
                                    @error('descripcion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox"
                                           class="form-check-input"
                                           id="activo"
                                           name="activo"
                                           value="1"
                                           {{ old('activo') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="activo">
                                        Activar este token inmediatamente
                                    </label>
                                    <small class="form-text text-muted d-block">
                                        Al activarlo, se desactivarán todos los demás tokens
                                    </small>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Guardar Token
                                    </button>
                                    <a href="{{ route('gis-tokens.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Cancelar
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
