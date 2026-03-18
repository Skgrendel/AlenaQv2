@extends('layouts.frontpage.app')

@section('content')
    <div class="widget-content widget-content-area">
        <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 ">
                <div class="card style-4" style="width: 100%; height: 100%;">
                    <div class="card-body pt-3">
                        <div class="m-o-dropdown-list">
                            <div class="media mt-0 mb-3">
                                <div class="badge--group me-3">
                                    <div class="badge badge-success badge-dot"></div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading mb-0">
                                        <span class="text-card">Información del Reporte: <strong>{{ $data['info']['contrato'] }}</strong></span>
                                    </h4>
                                </div>
                            </div>
                            <hr class="my-2">
                        </div>

                        {{-- Información del Medidor --}}
                        <div class="mb-4">
                            <h6 class="text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                <i class="fas fa-gauge-simple me-2"></i>Medidor
                            </h6>
                            <div class="row mt-2">
                                <div class="col-12 mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted text-sm">Número:</span>
                                        <span class="text-card text-sm fw-bold">{{ $data['info']['medidor'] ?? 'Sin medidor' }}</span>
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted text-sm">Lectura:</span>
                                        <span class="text-card text-sm fw-500">{{ $data['info']['lectura'] }}</span>
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted text-sm">Marca:</span>
                                        <span class="text-card text-sm fw-500">{{ $data['info']['marca de medidor'] ?? 'Sin Datos' }}</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted text-sm">Descripción:</span>
                                        <span class="text-card text-sm fw-500">{{ $data['info']['descripcion_medidor'] ?? 'Sin Datos' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-3">

                        {{-- Información de Servicio --}}
                        <div class="mb-4">
                            <h6 class="text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                <i class="fas fa-building me-2"></i>Servicio
                            </h6>
                            <div class="row mt-2">
                                <div class="col-12 mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted text-sm">Ciclo:</span>
                                        <span class="text-card text-sm fw-500">{{ $data['info']['ciclo'] ?? 'Sin Datos' }}</span>
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted text-sm">Tipo de Comercio:</span>
                                        <span class="text-card text-sm fw-500">{{ $data['info']['comercios'] ?? 'No tiene comercio' }}</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted text-sm">Tipo de Presión:</span>
                                        <span class="text-card text-sm fw-500">{{ $data['info']['tipo presion'] ?? 'Sin Datos' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-3">

                        {{-- Información del Regulador --}}
                        <div class="mb-4">
                            <h6 class="text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                <i class="fas fa-sliders me-2"></i>Regulador
                            </h6>
                            <div class="row mt-2">
                                <div class="col-12 mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted text-sm">Marca:</span>
                                        <span class="text-card text-sm fw-500">{{ $data['info']['marca de regulador'] ?? 'Sin Datos' }}</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted text-sm">Medidor Encontrado:</span>
                                        <span class="badge badge-light-warning text-sm">{{ $data['info']['medidoranomalia'] ?? 'Sin datos' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-3">

                        {{-- Estado e Incidencias --}}
                        <div class="mb-4">
                            <h6 class="text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                <i class="fas fa-exclamation-triangle me-2"></i>Estado
                            </h6>
                            <div class="row mt-2">
                                <div class="col-12 mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted text-sm">Estado:</span>
                                        {!! $data['info']['estado'] == 1
                                            ? '<span class="badge bg-success">Activo</span>'
                                            : '<span class="badge bg-danger">Inactivo</span>' !!}
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted text-sm">Alertas:</span>
                                        @if (trim($data['info']['alertas']) === 'Sin Alertas')
                                            <span class="badge bg-success">Sin Alertas</span>
                                        @else
                                            <span class="badge bg-danger">{{ $data['info']['alertas'] }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted text-sm">Imposibilidad:</span>
                                        <span class="badge badge-light-secondary text-sm">{{ $data['info']['imposibilidad'] ?? 'Ninguna' }}</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted text-sm">Anomalías:</span>
                                        <span class="badge badge-light-danger text-sm">{{ $data['info']['anomaliasN'] ?? 'sin datos' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-3">

                        {{-- Comentarios --}}
                        <div class="mb-3">
                            <h6 class="text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                <i class="fas fa-comments me-2"></i>Comentarios
                            </h6>
                            <div class="alert alert-soft-info border-0 mt-2 mb-0" style="background-color: rgba(87, 167, 225, 0.1);">
                                <p class="text-card text-sm mb-0">{{ $data['info']['comentarios'] ?? 'sin datos' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer pt-0 border-0">
                        <div class="progress br-30 progress-sm">
                            <div class="progress-bar" role="progressbar" style="width: 100%;background:#0E1726"
                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 ">
                <div class="card style-4" style="width: 100%; height: 100%;">
                    <div class="card-body pt-3">
                        <div class="m-o-dropdown-list">
                            <div class="media mt-0 mb-3">
                                <div class="badge--group me-3">
                                    <div class="badge badge-success badge-dot"></div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading mb-0">
                                        <span class="text-card">Datos del Usuario: <strong>{{ $gis['info']['cliente'] ?? 'sin datos' }}</strong></span>
                                    </h4>
                                </div>
                            </div>
                            <hr class="my-2">
                        </div>
                        @if (isset($gis['info']))
                            {{-- Información de Ubicación --}}
                            <div class="mb-4">
                                <h6 class="text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                    <i class="fas fa-map-marker-alt me-2"></i>Ubicación
                                </h6>
                                <div class="row mt-2">
                                    <div class="col-12 mb-2">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <span class="text-muted text-sm">Dirección:</span>
                                            <span class="text-card text-sm fw-500" style="text-align: right; flex: 1; margin-left: 10px;">{{ $gis['info']['direccion'] ?? 'sin datos' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-muted text-sm">Barrio:</span>
                                            <span class="text-card text-sm fw-500">{{ $gis['info']['barrio'] ?? 'sin datos' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-muted text-sm">Departamento:</span>
                                            <span class="text-card text-sm fw-500">{{ $gis['info']['localidad'] ?? 'sin datos' }}</span>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <hr class="my-3">

                            {{-- Información de Contrato y Medidores --}}
                            <div class="mb-4">
                                <h6 class="text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                    <i class="fas fa-file-invoice me-2"></i>Servicio
                                </h6>
                                <div class="row mt-2">
                                    <div class="col-12 mb-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-muted text-sm">Contrato:</span>
                                            <span class="text-card text-sm fw-bold">{{ $gis['info']['contrato'] ?? 'sin datos' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-muted text-sm">Medidor Actual:</span>
                                            <span class="text-card text-sm fw-500">{{ $gis['info']['medidor'] ?? 'sin datos' }}</span>
                                        </div>
                                    </div>
                                     <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-muted text-sm">Categoría:</span>
                                            <span class="text-card text-sm fw-500">{{ $gis['info']['categoria'] ?? 'sin datos' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-3">

                            {{-- Información de Medidor Anterior --}}
                            <div class="mb-4">
                                <h6 class="text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                    <i class="fas fa-history me-2"></i>Medidor Anterior
                                </h6>
                                <div class="row mt-2">
                                    <div class="col-12 mb-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-muted text-sm">Número:</span>
                                            <span class="text-card text-sm fw-500">{{ $gis['info']['medidor_anterior'] ?? 'sin datos' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-muted text-sm">Fecha:</span>
                                            <span class="badge badge-light-info text-sm">{{ $gis['info']['fecha_anterior'] ?? 'sin datos' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-3">

                            {{-- Información de Estado --}}
                            <div class="mb-4">
                                <h6 class="text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                    <i class="fas fa-info-circle me-2"></i>Estado
                                </h6>
                                <div class="row mt-2">
                                    <div class="col-12 mb-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-muted text-sm">Estado:</span>
                                            <span class="badge {{ $gis['info']['estado'] == 'Activo' ? 'badge-success' : 'badge-danger' }} text-sm">
                                                {{ $gis['info']['estado'] ?? 'sin datos' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-muted text-sm">Conexión:</span>
                                            <span class="text-card text-sm fw-500">{{ $gis['info']['estadoCorte'] ?? 'sin datos' }}</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <span class="text-muted text-sm">Descripción:</span>
                                            <span class="text-card text-sm fw-500" style="text-align: right; flex: 1; margin-left: 10px;">{{ $gis['info']['descripcion'] ?? 'sin datos' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>{{ $gis['error'] }}
                            </div>
                        @endif
                    </div>
                    <div class="card-footer pt-0 border-0">
                        <div class="progress br-30 progress-sm">
                            <div class="progress-bar" role="progressbar" style="width: 100%;background:#0E1726"
                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="widget-content widget-content-area mt-2 ">
        <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 ">
                <div class="card style-4" style="width: 100%; height: 100%;">
                    <div class="card-body pt-3">
                        <div class="m-o-dropdown-list">
                            <div class="media mt-0 mb-3">
                                <div class="badge--group me-3">
                                    <div class="badge badge-success badge-dot"></div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading mb-0">
                                        <span class="media-title">Observaciones</span>
                                    </h4>
                                </div>
                            </div>
                            <hr class="my-2">
                        </div>
                        <form action="{{ route('coordinador.update', $data['info']['id']) }}" method="post"
                            id="observacion" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            {{-- Preguntas de Verificación --}}
                            <div class="mb-4">
                                <h6 class="text-uppercase text-muted mb-3" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                    <i class="fas fa-check-circle me-2"></i>Preguntas de Verificación
                                </h6>

                                <div class="row g-3">
                                    {{-- Pregunta 1 --}}
                                    <div class="col-md-6">
                                        <div style="background: rgba(87, 167, 225, 0.05); padding: 12px; border-radius: 6px; border-left: 3px solid #57a7e1;">
                                            <p class="mb-2 text-sm fw-500">¿El medidor coincide con el Contrato?</p>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="medidor_si" name="medidor_coincide" value="1">
                                                <label class="form-check-label text-sm" for="medidor_si">
                                                    <i class="fas fa-check me-1" style="color: #28a745;"></i>Sí
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="medidor_no" name="medidor_coincide" value="0">
                                                <label class="form-check-label text-sm" for="medidor_no">
                                                    <i class="fas fa-times me-1" style="color: #dc3545;"></i>No
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Pregunta 2 --}}
                                    <div class="col-md-6">
                                        <div style="background: rgba(87, 167, 225, 0.05); padding: 12px; border-radius: 6px; border-left: 3px solid #57a7e1;">
                                            <p class="mb-2 text-sm fw-500">¿La lectura es correcta?</p>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="lectura_si" name="lectura_correcta" value="1">
                                                <label class="form-check-label text-sm" for="lectura_si">
                                                    <i class="fas fa-check me-1" style="color: #28a745;"></i>Sí
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="lectura_no" name="lectura_correcta" value="0">
                                                <label class="form-check-label text-sm" for="lectura_no">
                                                    <i class="fas fa-times me-1" style="color: #dc3545;"></i>No
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Pregunta 3 --}}
                                    <div class="col-md-6">
                                        <div style="background: rgba(87, 167, 225, 0.05); padding: 12px; border-radius: 6px; border-left: 3px solid #57a7e1;">
                                            <p class="mb-2 text-sm fw-500">¿La foto fue tomada en posición correcta?</p>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="foto_si" name="foto_correcta" value="1">
                                                <label class="form-check-label text-sm" for="foto_si">
                                                    <i class="fas fa-check me-1" style="color: #28a745;"></i>Sí
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="foto_no" name="foto_correcta" value="0">
                                                <label class="form-check-label text-sm" for="foto_no">
                                                    <i class="fas fa-times me-1" style="color: #dc3545;"></i>No
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Pregunta 4 --}}
                                    <div class="col-md-6">
                                        <div style="background: rgba(87, 167, 225, 0.05); padding: 12px; border-radius: 6px; border-left: 3px solid #57a7e1;">
                                            <p class="mb-2 text-sm fw-500">¿Coincide el tipo de comercio?</p>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="comercio_si" name="comercio_coincide" value="1">
                                                <label class="form-check-label text-sm" for="comercio_si">
                                                    <i class="fas fa-check me-1" style="color: #28a745;"></i>Sí
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="comercio_no" name="comercio_coincide" value="0">
                                                <label class="form-check-label text-sm" for="comercio_no">
                                                    <i class="fas fa-times me-1" style="color: #dc3545;"></i>No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Checkboxes adicionales --}}
                            <div class="mb-4">
                                <h6 class="text-uppercase text-muted mb-3" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                    <i class="fas fa-flag me-2"></i>Validaciones Adicionales
                                </h6>
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="revisado_check" name="revisado" value="1">
                                            <label class="form-check-label text-sm" for="revisado_check">
                                                <i class="fas fa-eye me-1"></i>Reporte Revisado
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="soborno_check" name="soborno" value="1">
                                            <label class="form-check-label text-sm" for="soborno_check">
                                                <i class="fas fa-warning me-1"></i>Intento de Soborno
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($data['info']['estado'] != '6')
                                {{-- Textarea de Observaciones --}}
                                <div class="mb-4">
                                    <h6 class="text-uppercase text-muted mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                        <i class="fas fa-pen-fancy me-2"></i>Observaciones Adicionales
                                    </h6>
                                    <textarea id="editor" rows="4" name="observaciones" class="form-control"
                                        placeholder="Escriba sus observaciones, notas importantes o comentarios sobre la revisión..."
                                        style="border: 1px solid #d1d3d4; border-radius: 6px;"></textarea>
                                </div>

                                {{-- Estado del Reporte --}}
                                <div class="mb-4">
                                    <h6 class="text-uppercase text-muted mb-3" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                        <i class="fas fa-certificate me-2"></i>Resultado de la Revisión
                                    </h6>
                                    <div class="row g-2">
                                        <div class="col-12">
                                            <div style="background: rgba(40, 167, 69, 0.08); padding: 12px; border-radius: 6px; border: 1px solid rgba(40, 167, 69, 0.2);">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="estado" id="estado_aprueba" value="6">
                                                    <label class="form-check-label fw-500" for="estado_aprueba">
                                                        <span class="badge badge-success me-2">
                                                            <i class="fas fa-check me-1"></i>Revisado y Aprobado
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div style="background: rgba(220, 53, 69, 0.08); padding: 12px; border-radius: 6px; border: 1px solid rgba(220, 53, 69, 0.2);">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="estado" id="estado_rechaza" value="7">
                                                    <label class="form-check-label fw-500" for="estado_rechaza">
                                                        <span class="badge badge-danger me-2">
                                                            <i class="fas fa-times me-1"></i>Rechazado
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('estado'))
                                            <span class="text-danger text-sm"><i class="fas fa-exclamation-circle me-1"></i>{{ $errors->first('estado') }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <div class="alert alert-warning d-none" role="alert" id="progressBarObservacion">
                                <span class="text-sm"><i class="fas fa-spinner fa-spin me-2"></i>Guardando Cambios, Por favor espere...</span>
                            </div>

                            <hr class="my-3">

                            <div class="d-flex justify-content-end">
                                <button type="submit" id="submitButtonObservacion" class="btn btn-success">
                                    <i class="fas fa-save me-2"></i>Guardar Cambios
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 ">
                <div class="card style-4" style="width: 100%; height: 100%;">
                    <div class="card-body pt-3">
                        <div class="m-o-dropdown-list">
                            <div class="media mt-0 mb-3">
                                <div class="badge--group me-3">
                                    <div class="badge badge-success badge-dot"></div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading mb-0">
                                        <span class="text-card">Subir Evidencias</span>
                                    </h4>
                                </div>
                            </div>
                            <hr class="my-2">
                        </div>
                        <form action="{{ route('coordinador.store') }}" method="POST" enctype="multipart/form-data"
                            id="evidencias">
                            @csrf
                            <input type="text" name="id" value="{{ $data['info']['id'] }}" hidden>

                            <div class="row g-3">
                                {{-- Foto 1: Fachada --}}
                                <div class="col-md-6">
                                    <div style="padding: 12px; background: rgba(87, 167, 225, 0.05); border-radius: 6px; border: 2px dashed #57a7e1;">
                                        <label for="foto1-input" class="mb-2 text-sm fw-500 d-block">
                                            <i class="fas fa-building me-1" style="color: #57a7e1;"></i>Foto de la Fachada
                                        </label>
                                        <input type="file" class="form-control form-control-sm" id="foto1-input" name="foto1"
                                            accept="image/jpeg" capture="camera">
                                        <small class="text-muted d-block mt-1"><i class="fas fa-info-circle me-1"></i>Foto frontal del inmueble</small>
                                    </div>
                                </div>

                                {{-- Foto 2: Medidor --}}
                                <div class="col-md-6">
                                    <div style="padding: 12px; background: rgba(87, 167, 225, 0.05); border-radius: 6px; border: 2px dashed #57a7e1;">
                                        <label for="foto2-input" class="mb-2 text-sm fw-500 d-block">
                                            <i class="fas fa-gauge-simple me-1" style="color: #57a7e1;"></i>Foto del Medidor
                                        </label>
                                        <input type="file" class="form-control form-control-sm" id="foto2-input" name="foto2"
                                            accept="image/jpeg" capture="camera">
                                        <small class="text-muted d-block mt-1"><i class="fas fa-info-circle me-1"></i>Primer plano del medidor</small>
                                    </div>
                                </div>

                                {{-- Foto 3: Odómetro --}}
                                <div class="col-md-6">
                                    <div style="padding: 12px; background: rgba(87, 167, 225, 0.05); border-radius: 6px; border: 2px dashed #57a7e1;">
                                        <label for="foto3-input" class="mb-2 text-sm fw-500 d-block">
                                            <i class="fas fa-meter me-1" style="color: #57a7e1;"></i>Foto del Odómetro
                                        </label>
                                        <input type="file" class="form-control form-control-sm" id="foto3-input" name="foto3"
                                            accept="image/jpeg" capture="camera">
                                        <small class="text-muted d-block mt-1"><i class="fas fa-info-circle me-1"></i>Lectura del odómetro</small>
                                    </div>
                                </div>

                                {{-- Foto 4: Regulador --}}
                                <div class="col-md-6">
                                    <div style="padding: 12px; background: rgba(87, 167, 225, 0.05); border-radius: 6px; border: 2px dashed #57a7e1;">
                                        <label for="foto4-input" class="mb-2 text-sm fw-500 d-block">
                                            <i class="fas fa-microchip me-1" style="color: #57a7e1;"></i>Foto del Regulador
                                        </label>
                                        <input type="file" class="form-control form-control-sm" id="foto4-input" name="foto4"
                                            accept="image/jpeg" capture="camera">
                                        <small class="text-muted d-block mt-1"><i class="fas fa-info-circle me-1"></i>Regulador de presión</small>
                                    </div>
                                </div>

                                {{-- Foto 5: Detector de Fuga --}}
                                <div class="col-md-6">
                                    <div style="padding: 12px; background: rgba(87, 167, 225, 0.05); border-radius: 6px; border: 2px dashed #57a7e1;">
                                        <label for="foto5-input" class="mb-2 text-sm fw-500 d-block">
                                            <i class="fas fa-water me-1" style="color: #57a7e1;"></i>Foto Detector de Fuga
                                        </label>
                                        <input type="file" class="form-control form-control-sm" id="foto5-input" name="foto5"
                                            accept="image/jpeg" capture="camera">
                                        <small class="text-muted d-block mt-1"><i class="fas fa-info-circle me-1"></i>Prueba con detector</small>
                                    </div>
                                </div>

                                {{-- Foto 6: Exceso de Capacidad --}}
                                <div class="col-md-6">
                                    <div style="padding: 12px; background: rgba(87, 167, 225, 0.05); border-radius: 6px; border: 2px dashed #57a7e1;">
                                        <label for="foto6-input" class="mb-2 text-sm fw-500 d-block">
                                            <i class="fas fa-exclamation-triangle me-1" style="color: #57a7e1;"></i>Foto Exceso de Capacidad
                                        </label>
                                        <input type="file" class="form-control form-control-sm" id="foto6-input" name="foto6"
                                            accept="image/jpeg" capture="camera">
                                        <small class="text-muted d-block mt-1"><i class="fas fa-info-circle me-1"></i>Si hay exceso, evidenciarlo</small>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-3">

                            <div class="alert alert-success d-none alert-evidencia" role="alert" id="alert"></div>

                            <div class="alert alert-info d-none" role="alert" id="progressBarEvidencias">
                                <span class="text-sm"><i class="fas fa-spinner fa-spin me-2"></i>Cargando archivos, por favor espere...</span>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" id="submitButtonEvidencias" class="btn btn-success">
                                    <i class="fas fa-cloud-upload-alt me-2"></i>Guardar Evidencias
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="widget-content widget-content-area mt-2">
        <div class="card style-4">
            <div class="card-body">
                <h6 class="text-uppercase text-muted mb-3" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                    <i class="fas fa-images me-2"></i>Galería de Evidencias
                </h6>
                <div class="row g-3">
                    @php
                        $tieneImagenes = false;
                        for ($i = 1; $i <= 6; $i++) {
                            if (isset($data['imagenes']['foto' . $i])) {
                                $tieneImagenes = true;
                                break;
                            }
                        }
                    @endphp

                    @if ($tieneImagenes)
                        @foreach (range(1, 6) as $i)
                            @php
                                $rutaImagen = $data['imagenes']['foto' . $i] ?? null;
                                $nombreArchivo = $rutaImagen ? pathinfo($rutaImagen, PATHINFO_FILENAME) : 'Imagen';
                                $tituloGlightbox = $nombreArchivo . ' - Contrato #: ' . ($data['info']['contrato'] ?? 'N/A');
                                $descripcionGlightbox = 'Contrato #: ' . ($data['info']['contrato'] ?? 'N/A') . ' - Medidor #: ' . ($data['info']['medidor'] ?? 'N/A');
                            @endphp
                            @if ($rutaImagen)
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div style="position: relative; overflow: hidden; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: all 0.3s ease;">
                                        <a href="{{ asset($rutaImagen) }}" class="withDescriptionGlightbox glightbox-content" style="display: block; position: relative; overflow: hidden;"
                                            data-glightbox="title: {{ $tituloGlightbox }}; description: {{ $descripcionGlightbox }};">
                                            <img src="{{ asset($rutaImagen) }}" alt="{{ $nombreArchivo }}" class="img-fluid"
                                                style="width: 100%; height: 220px; object-fit: cover; display: block; transition: transform 0.3s ease;" />
                                            {{-- Overlay con icono al pasar el mouse --}}
                                            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.4); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease;" class="overlay-icon">
                                                <i class="fas fa-search-plus" style="font-size: 32px; color: white;"></i>
                                            </div>
                                        </a>
                                    </div>
                                    <p class="text-muted mt-2 mb-0" style="font-size: 0.85rem; text-align: center;">
                                        @if ($i == 1) Fachada
                                        @elseif ($i == 2) Medidor
                                        @elseif ($i == 3) Odómetro
                                        @elseif ($i == 4) Regulador
                                        @elseif ($i == 5) Detector Fuga
                                        @else Exceso Capacidad
                                        @endif
                                    </p>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="col-12">
                            <div class="alert alert-soft-warning border-0 mb-0" style="background-color: rgba(255, 193, 7, 0.1);">
                                <i class="fas fa-camera me-2"></i>No hay imágenes disponibles para este coordinador.
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .glightbox-content:hover img {
            transform: scale(1.05);
        }

        .glightbox-content:hover .overlay-icon {
            opacity: 1 !important;
        }
    </style>
@endsection

@section('scripts')
    <script>
        for (let i = 1; i <= 6; i++) {
            document.getElementById("foto" + i).addEventListener("change", function() {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('fotoPreview' + i).src = e.target.result;
                }
                reader.readAsDataURL(this.files[0]);
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#observacion').submit(function() {
                $('#submitButtonObservacion').addClass('d-none');
                $('#progressBarObservacion').removeClass('d-none');
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#evidencias').submit(function(e) {
                e.preventDefault();
                $('#submitButtonEvidencias').addClass('d-none');
                $('#progressBarEvidencias').removeClass('d-none');

                var formData = new FormData($('#evidencias')[0]);

                $.ajax({
                    url: "{{ route('coordinador.store') }}",
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#alert').removeClass('d-none');
                        $('.alert-evidencia').text(response.success).show();
                        $('#progressBarEvidencias').addClass('d-none');
                        // $('#evidencias')[0].reset();
                    }
                });
            });
        });
    </script>
@endsection
