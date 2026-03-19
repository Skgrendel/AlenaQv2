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
                                        <span class="text-card">Información del Contrato:
                                            <strong>{{ $data['info']['contrato'] ?? 'Sin datos' }}</strong></span>
                                    </h4>
                                </div>
                            </div>
                            <hr class="my-2">
                        </div>

                        {{-- Información del Medidor y Servicio | Regulador y Estado --}}
                        <div class="row">
                            {{-- Columna Izquierda: Medidor y Servicio --}}
                            <div class="col-6" style="border-right: 1px solid #e0e0e0; padding-right: 15px;">
                                {{-- Información del Medidor --}}
                                <div class="mb-4">
                                    <h6 class="text-uppercase text-muted"
                                        style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                        <i class="fas fa-gauge-simple me-2"></i>Medidor
                                    </h6>
                                    <div class="row mt-2">
                                        <div class="col-12 mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted text-sm">Número:</span>
                                                <span
                                                    class="text-card text-sm fw-bold">{{ $data['info']['medidor'] ?? 'Sin medidor' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted text-sm">Lectura Actual:</span>
                                                <span
                                                    class="text-card text-sm fw-500">{{ $data['info']['reporte']['lectura'] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted text-sm">Marca:</span>
                                                <span
                                                    class="text-card text-sm fw-500">{{ $data['info']['marca de medidor'] ?? 'Sin Datos' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted text-sm">Descripción:</span>
                                                <span
                                                    class="text-card text-sm fw-500">{{ $data['info']['descripcion_medidor'] ?? 'Sin Datos' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                {{-- Información de Servicio --}}
                                <div class="mb-4">
                                    <h6 class="text-uppercase text-muted"
                                        style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                        <i class="fas fa-building me-2"></i>Servicio
                                    </h6>
                                    <div class="row mt-2">
                                        <div class="col-12 mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted text-sm">Ciclo:</span>
                                                <span
                                                    class="text-card text-sm fw-500">{{ $data['info']['ciclo']['ciclo'] ?? 'Sin Datos' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted text-sm">Tipo de Comercio:</span>
                                                <span
                                                    class="text-card text-sm fw-500">{{ $data['info']['comercios'] ?? 'No tiene comercio' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted text-sm">Tipo de Presión:</span>
                                                <span
                                                    class="text-card text-sm fw-500">{{ $data['info']['tipo presion'] ?? 'Sin Datos' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Columna Derecha: Regulador y Estado --}}
                            <div class="col-6" style="padding-left: 15px;">
                                {{-- Información del Regulador --}}
                                <div class="mb-4">
                                    <h6 class="text-uppercase text-muted"
                                        style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                        <i class="fas fa-sliders me-2"></i>Regulador
                                    </h6>
                                    <div class="row mt-2">
                                        <div class="col-12 mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted text-sm">Marca:</span>
                                                <span
                                                    class="text-card text-sm fw-500">{{ $data['info']['marca de regulador'] ?? 'Sin Datos' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted text-sm">Medidor Encontrado:</span>
                                                <span
                                                    class="badge badge-light-warning text-sm">{{ $data['info']['medidoranomalia'] ?? 'Sin datos' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                {{-- Estado e Incidencias --}}
                                <div class="mb-4">
                                    <h6 class="text-uppercase text-muted"
                                        style="font-size: 0.75rem; letter-spacing: 0.5px;">
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
                                                @if (trim($data['info']['alerta']) === 'Sin Alertas')
                                                    <span class="badge bg-success">Sin Alertas</span>
                                                @else
                                                    <span class="badge bg-danger">{{ $data['info']['alerta'] }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted text-sm">Imposibilidad:</span>
                                                <span
                                                    class="badge badge-light-secondary text-sm">{{ $data['info']['imposibilidad'] ?? 'Ninguna' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted text-sm">Anomalías:</span>
                                                <span
                                                    class="badge badge-light-danger text-sm">{{ $data['info']['anomaliasN'] ?? 'sin datos' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-3">

                        {{-- Comentarios --}}
                        <div class="mb-3">
                            <h6 class="text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                <i class="fas fa-comments me-2"></i>Comentarios del Agente
                            </h6>
                            <div class="alert alert-soft-info border-0 mt-2 mb-0"
                                style="background-color: rgba(87, 167, 225, 0.1);">
                                <p class="text-card text-sm mb-0">{{ $data['info']['comentarios'] ?? 'sin datos' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer pt-0 border-0">
                        <div class="progress br-30 progress-sm">
                            <div class="progress-bar " role="progressbar" style="width: 100%;background:#0E1726"
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
                                        <span class="text-card">Datos del Usuario:
                                            <strong>{{ $gis['info']['cliente'] ?? 'sin datos' }}</strong></span>
                                    </h4>
                                </div>
                            </div>
                            <hr class="my-2">
                        </div>
                        @if (isset($gis['info']))
                            {{-- Información de Ubicación | Medidor Anterior | Estado --}}
                            <div class="row">
                                {{-- Columna Izquierda: Ubicación y Servicio --}}
                                <div class="col-6" style="border-right: 1px solid #e0e0e0; padding-right: 15px;">
                                    {{-- Información de Ubicación --}}
                                    <div class="mb-4">
                                        <h6 class="text-uppercase text-muted"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                            <i class="fas fa-map-marker-alt me-2"></i>Ubicación
                                        </h6>
                                        <div class="row mt-2">
                                            <div class="col-12 mb-2">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <span class="text-muted text-sm">Dirección:</span>
                                                    <span class="text-card text-sm fw-500"
                                                        style="text-align: right; flex: 1; margin-left: 10px;">{{ $gis['info']['direccion'] ?? 'sin datos' }}</span>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="text-muted text-sm">Barrio:</span>
                                                    <span
                                                        class="text-card text-sm fw-500">{{ $gis['info']['barrio'] ?? 'sin datos' }}</span>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="text-muted text-sm">Departamento:</span>
                                                    <span
                                                        class="text-card text-sm fw-500">{{ $gis['info']['localidad'] ?? 'sin datos' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    {{-- Información de Contrato y Medidores --}}
                                    <div class="mb-4">
                                        <h6 class="text-uppercase text-muted"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                            <i class="fas fa-file-invoice me-2"></i>Servicio
                                        </h6>
                                        <div class="row mt-2">
                                            <div class="col-12 mb-2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="text-muted text-sm">Contrato:</span>
                                                    <span
                                                        class="text-card text-sm fw-bold">{{ $gis['info']['contrato'] ?? 'sin datos' }}</span>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="text-muted text-sm">Medidor Actual:</span>
                                                    <span
                                                        class="text-card text-sm fw-500">{{ $gis['info']['medidor'] ?? 'sin datos' }}</span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="text-muted text-sm">Categoría:</span>
                                                    <span
                                                        class="text-card text-sm fw-500">{{ $gis['info']['categoria'] ?? 'sin datos' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Columna Derecha: Medidor Anterior y Estado --}}
                                <div class="col-6" style="padding-left: 15px;">
                                    {{-- Información de Medidor Anterior --}}
                                    <div class="mb-4">
                                        <h6 class="text-uppercase text-muted"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                            <i class="fas fa-history me-2"></i>Medidor Anterior
                                        </h6>
                                        <div class="row mt-2">
                                            <div class="col-12 mb-2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="text-muted text-sm">Número:</span>
                                                    <span
                                                        class="text-card text-sm fw-500">{{ $gis['info']['medidor_anterior'] ?? 'sin datos' }}</span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="text-muted text-sm">Fecha:</span>
                                                    <span
                                                        class="badge badge-light-info text-sm">{{ $gis['info']['fecha_anterior'] ?? 'sin datos' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    {{-- Información de Estado --}}
                                    <div class="mb-4">
                                        <h6 class="text-uppercase text-muted"
                                            style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                            <i class="fas fa-info-circle me-2"></i>Estado
                                        </h6>
                                        <div class="row mt-2">
                                            <div class="col-12 mb-2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="text-muted text-sm">Estado:</span>
                                                    <span
                                                        class="badge {{ $gis['info']['estado'] == 'Activo' ? 'badge-success' : 'badge-danger' }} text-sm">
                                                        {{ $gis['info']['estado'] ?? 'sin datos' }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <span class="text-muted text-sm">Conexión:</span>
                                                    <span class="text-card fw-500"
                                                        style="font-size: 0.70rem; text-align: right; flex: 1; margin-left: 10px;">{{ $gis['info']['estadoCorte'] ?? 'sin datos' }}</span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <span class="text-muted text-sm">Descripción:</span>
                                                    <span class="text-card text-sm fw-500"
                                                        style="text-align: right; flex: 1; margin-left: 10px;">{{ $gis['info']['descripcion'] ?? 'sin datos' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>{{ $gis['error'] }}
                            </div>
                        @endif

                        <hr class="my-3">
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
    @if ($data['info']['reporte']['revisado'] === 0 && $data['info']['reporte']['confirmado'] === 0)
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
                                            <span class="media-title">Informacion de Reportes</span>
                                        </h4>
                                    </div>
                                </div>
                                <hr class="my-2">
                            </div>
                            <div class="row">
                                <form action="{{ route('auditorias.update', $data['info']['reporte']['id']) }}"
                                    method="post" id="observacion" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group mb-1 ">
                                        <label for="Contrato" class="form-label">Numero de Contrato</label>
                                        <span id="Contrato" class="form-control"
                                            name="contrato">{{ $gis['info']['contrato'] ?? $data['info']['contrato'] }}
                                        </span>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-1 ">
                                                <label for="medidor" class="form-label">Numero de Medidor</label>
                                                <span type="text" class="form-control" id="medidor"
                                                    name="medidor">{{ $gis['info']['medidor'] ?? $data['info']['medidor'] }}</span>

                                            </div>
                                            <div class="form-group mb-1 ">
                                                <label for="lectura">Numero de Lectura</label>
                                                <input type="text" class="form-control" id="lectura" name="lectura"
                                                    value="{{ $data['info']['lectura'] }}">
                                            </div>
                                            <div class="form-group mb-1 ">
                                                <label for="imposibilidad" class="form-label">Imposibilidad</label>
                                                <select id="imposibilidad" class="form-select" name="imposibilidad">
                                                    @foreach ($data['imposibilidad'] as $id => $nombre)
                                                        <option value="{{ $nombre }}"
                                                            {{ $data['info']['imposibilidad'] == $nombre ? 'selected' : '' }}>
                                                            {{ $nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12  mb-2" id="tipo_regulador_container">
                                                <label for="tipo_presion" class="form-label">Tipo de Presion</label>
                                                <select id="tipo_presion" class="form-select" name="tipo_presion">
                                                    @foreach ($data['tipo presion'] as $id => $nombre)
                                                        <option
                                                            value="{{ $nombre }}"{{ $data['info']['tipo presion'] == $nombre ? 'selected' : '' }}>
                                                            {{ $nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12  mb-2" id="descripcion_medidor_container">
                                                <label for="descripcion_medidor" class="form-label">Descripcion del
                                                    Medidor</label>
                                                <select id="descripcion_medidor" class="form-select"
                                                    name="descripcion_medidor" required>
                                                    @foreach ($data['descripcion'] as $id => $nombre)
                                                        <option
                                                            value="{{ $nombre }}"{{ $data['info']['descripcion_medidor'] == $nombre ? 'selected' : '' }}>
                                                            {{ $nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12  mb-2" id="marca_regulador_container">
                                                <label for="marca_regulador" class="form-label">Tipo del Regulador</label>
                                                <select id="marca_regulador" class="form-select" name="marca_regulador">
                                                    @foreach ($data['marca de regulador'] as $id => $nombre)
                                                        <option
                                                            value="{{ $nombre }}"{{ $data['info']['marca de regulador'] == $nombre ? 'selected' : '' }}>
                                                            {{ $nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12  mb-2" id="marca_medidor_container">
                                                <label for="marca_medidor" class="form-label">Marca del Medidor</label>
                                                <select id="marca_medidor" class="form-select" name="marca_medidor">
                                                    @foreach ($data['marca de medidor'] as $id => $nombre)
                                                        <option
                                                            value="{{ $nombre }}"{{ $data['info']['marca de medidor'] == $nombre ? 'selected' : '' }}>
                                                            {{ $nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 mb-2" id="cau_container">
                                                <label for="cau" class="form-label">Notificación de Alertas</label>
                                                <select id="cau" class="form-select" name="cau">
                                                    @foreach ($data['alertas'] as $id => $nombre)
                                                        <option
                                                            value="{{ $nombre }}"{{ $data['info']['alerta'] == $nombre ? 'selected' : '' }}>
                                                            {{ $nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-1 ">
                                                <label for="medidor" class="form-label text-danger ">Medidor
                                                    Anomalia</label>
                                                <input type="text" class="form-control" id="medidor_anomalia"
                                                    name="medidor_anomalia"
                                                    value="{{ $data['info']['comercio']['medidor_anomalia'] }}">
                                            </div>
                                            <div class="form-group mb-1 ">
                                                <label for="comercio" class="form-label">Tipo de Comercio</label>
                                                <select id="comercio" class="form-select" name="tipo_comercio">
                                                    @foreach ($data['comercios'] as $id => $nombre)
                                                        <option value="{{ $nombre }}"
                                                            {{ $data['info']['comercio']['tipo_comercio'] == $nombre ? 'selected' : '' }}>
                                                            {{ $nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group mb-1 ">
                                                <label for="anomalia" class="form-label">Anomalias Detectadas</label>
                                                <select id="anomalia" class="form-select select2" name="anomalias[]"
                                                    multiple="multiple" autocomplete="off" data-placeholder="anomalias">
                                                    @foreach ($data['anomalias'] as $id => $nombre)
                                                        <option
                                                            value="{{ $nombre }}"{{ in_array($nombre, $data['info']['anomaliasid']) ? 'selected' : '' }}>
                                                            {{ $nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="comentarios" class="form-label">Observaciones</label>
                                            <textarea name="comentarios" id="comentarios" cols="30" rows="3" class="form-control"></textarea>
                                        </div>
                                    </div>
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
                                            <span class="media-title">Observaciones</span>
                                        </h4>
                                    </div>
                                </div>
                                <hr class="my-2">
                            </div>
                            <div class="row">
                                <div>
                                    <div class="row mt-3">
                                        <div class="col-3">
                                            <span class="form-check-label">¿El medidor coincide con el Contrato?</span>
                                            <div class="form-check ">
                                                <input class="form-check-input" type="radio" id="inlineCheckbox1"
                                                    name="medidor_coincide" value="1">
                                                <label class="form-check-label" for="inlineCheckbox1">si</label>
                                            </div>
                                            <div class="form-check ">
                                                <input class="form-check-input" type="radio" id="inlineCheckbox1"
                                                    name="medidor_coincide" value="0">
                                                <label class="form-check-label" for="inlineCheckbox1">no</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <span class="form-check-label">¿La lectura es correcta?</span>
                                            <div class="form-check ">
                                                <input class="form-check-input" type="radio" id="inlineCheckbox1"
                                                    name="lectura_correcta" value="1">
                                                <label class="form-check-label" for="inlineCheckbox1">si</label>
                                            </div>
                                            <div class="form-check ">
                                                <input class="form-check-input" type="radio" id="inlineCheckbox1"
                                                    name="lectura_correcta" value="0">
                                                <label class="form-check-label" for="inlineCheckbox1">no</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <span class="form-check-label">¿La foto fue tomada en la posicion
                                                correcta?</span>
                                            <div class="form-check ">
                                                <input class="form-check-input" type="radio" id="inlineCheckbox1"
                                                    name="foto_correcta" value="1">
                                                <label class="form-check-label" for="inlineCheckbox1">si</label>
                                            </div>
                                            <div class="form-check ">
                                                <input class="form-check-input" type="radio" id="inlineCheckbox1"
                                                    name="foto_correcta" value="0">
                                                <label class="form-check-label" for="inlineCheckbox1">no</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-4">
                                            <span class="form-check-label">¿Coicide el tipo de comercio?</span>
                                            <div class="form-check ">
                                                <input class="form-check-input" type="radio" id="inlineCheckbox1"
                                                    name="comercio_coincide" value="1">
                                                <label class="form-check-label" for="inlineCheckbox1">si</label>
                                            </div>
                                            <div class="form-check ">
                                                <input class="form-check-input" type="radio" id="inlineCheckbox1"
                                                    name="comercio_coincide" value="0">
                                                <label class="form-check-label" for="inlineCheckbox1">no</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                    name="revisado" value="1">
                                                <label class="form-check-label" for="inlineCheckbox1">Revisado</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                                    name="soborno" value="1">
                                                <label class="form-check-label" for="inlineCheckbox1">Intento de
                                                    Soborno</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <textarea id="editor" rows="5" name="observaciones" class="form-control mb-3"
                                    placeholder="Escriba Sus Observaciones"></textarea>
                            </div>

                            <div class="alert alert-warning d-none" role="alert" id="progressBarObservacion">
                                <span class="text-sm">Guardando Cambios Porfavor Espere.....</span>
                            </div>
                            <hr class="my-2">
                            <div class=" d-flex justify-content-end">
                                <button type="submit" id="submitButtonObservacion"
                                    class="btn btn-success">Guardar</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @can('admin.edit')
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
                                                <span class="text-card">Subir Evidencias</span>
                                            </h4>
                                        </div>
                                    </div>
                                    <hr class="my-2">
                                </div>
                                <div class="row">
                                    <form action="{{ route('coordinador.store') }}" method="POST"
                                        enctype="multipart/form-data" id="evidencias">
                                        @csrf
                                        <input type="text" name="id" value="{{ $data['info']['reporte']['id'] }}"
                                            hidden>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div id="foto1-button">
                                                    <span class="input-group-text  m-2" for="foto1-input">Foto de la
                                                        Fachada</span>
                                                    <input type="file" class="form-control" id="foto1-input"
                                                        name="foto1" accept="image/jpeg" capture="camera">
                                                </div>
                                                <div id="foto2-button">
                                                    <span class="input-group-text m-2" for="foto2-input">Foto del
                                                        Medidor</span>
                                                    <input type="file" class="form-control" id="foto2-input"
                                                        name="foto2" accept="image/jpeg" capture="camera">
                                                </div>
                                                <div id="foto5-button">
                                                    <span class="input-group-text m-2" for="foto5-input">Foto Detector de
                                                        Fuga</span>
                                                    <input type="file" class="form-control" id="foto5-input"
                                                        name="foto5" accept="image/jpeg" capture="camera">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="foto3-button">
                                                    <span class="input-group-text m-2" for="foto3-input">Foto del
                                                        Odómetro</span>
                                                    <input type="file" class="form-control" id="foto3-input"
                                                        name="foto3" accept="image/jpeg" capture="camera">
                                                </div>
                                                <div id="foto4-button">
                                                    <span class="input-group-text m-2" for="foto4-input">Foto del
                                                        Regulador</span>
                                                    <input type="file" class="form-control" id="foto4-input"
                                                        name="foto4" accept="image/jpeg" capture="camera">
                                                </div>
                                                <div id="foto6-button">
                                                    <span class="input-group-text m-2" for="foto6-input">Foto Exceso de
                                                        Capacidad</span>
                                                    <input type="file" class="form-control" id="foto6-input"
                                                        name="foto6" accept="image/jpeg" capture="camera">
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-2">
                                        <div class="alert alert-success d-none alert-evidencia" role="alert"
                                            id="alert">
                                        </div>
                                        <div class="alert alert-warning d-none" role="alert" id="progressBarEvidencias">
                                            <span class="text-sm">Cargando Archivos Porfavor Espere.....</span>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" id="submitButtonEvidencias"
                                                class="btn btn-success">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    @endif
    @if ($data['info']['reporte']['revisado'] === 1 && $data['info']['reporte']['confirmado'] === 0)
        <div class="widget-content widget-content-area my-2">
            <div class="row d-flex justify-content-center">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
                    <div class="card style-4" style="width: 100%; height: 100%;">
                        <div class="card-body pt-3">
                            <div class="m-o-dropdown-list">
                                <div class="media mt-0 mb-3">
                                    <div class="badge--group me-3">
                                        <div class="badge badge-success badge-dot"></div>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading mb-0">
                                            <span class="media-title">Informacion de Reportes</span>
                                        </h4>
                                    </div>
                                </div>
                                <hr class="my-2">
                            </div>
                            <div class="row">
                                <form action="{{ route('auditorias.update', $data['info']['reporte']['id']) }}"
                                    method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="form-check-label">Revisado por Balance y Control</span>
                                            <br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="inlineCheckbox1"
                                                    name="confirmado" value="1">
                                                <label class="form-check-label" for="inlineCheckbox1">si</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="inlineCheckbox1"
                                                    name="confirmado" value="2">
                                                <label class="form-check-label" for="inlineCheckbox1">no</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" d-flex justify-content-between ">
                                        <button type="submit" id="submitButtonRevisado"
                                            class="btn btn-success">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
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
                                $tituloGlightbox =
                                    $nombreArchivo . ' - Contrato #: ' . ($data['info']['contrato'] ?? 'N/A');
                                $descripcionGlightbox =
                                    'Contrato #: ' .
                                    ($data['info']['contrato'] ?? 'N/A') .
                                    ' - Medidor #: ' .
                                    ($data['info']['medidor'] ?? 'N/A');
                            @endphp
                            @if ($rutaImagen)
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div
                                        style="position: relative; overflow: hidden; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: all 0.3s ease;">
                                        <a href="{{ asset($rutaImagen) }}"
                                            class="withDescriptionGlightbox glightbox-content"
                                            style="display: block; position: relative; overflow: hidden;"
                                            data-glightbox="title: {{ $tituloGlightbox }}; description: {{ $descripcionGlightbox }};">
                                            <img src="{{ asset($rutaImagen) }}" alt="{{ $nombreArchivo }}"
                                                class="img-fluid"
                                                style="width: 100%; height: 220px; object-fit: cover; display: block; transition: transform 0.3s ease;" />
                                            {{-- Overlay con icono al pasar el mouse --}}
                                            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.4); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease;"
                                                class="overlay-icon">
                                                <i class="fas fa-search-plus" style="font-size: 32px; color: white;"></i>
                                            </div>
                                        </a>
                                    </div>
                                    <p class="text-muted mt-2 mb-0" style="font-size: 0.85rem; text-align: center;">
                                        @if ($i == 1)
                                            Fachada
                                        @elseif ($i == 2)
                                            Medidor
                                        @elseif ($i == 3)
                                            Odómetro
                                        @elseif ($i == 4)
                                            Regulador
                                        @elseif ($i == 5)
                                            Detector Fuga
                                        @else
                                            Exceso Capacidad
                                        @endif
                                    </p>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="col-12">
                            <div class="alert alert-soft-warning border-0 mb-0"
                                style="background-color: rgba(255, 193, 7, 0.1);">
                                <i class="fas fa-image me-2"></i>No hay imágenes disponibles para esta auditoría.
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
    <script src="{{ asset('script/agentes/AgentesGlobal.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#anomalia').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: false,
            });
        });
    </script>
@endsection
