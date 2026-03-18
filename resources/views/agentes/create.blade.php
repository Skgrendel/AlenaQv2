@extends('layouts.frontpage.app')

@section('content')
    <div class="container-fluid" style="padding: 10px; max-width: 100%;">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3 p-md-4">
                <form class="row g-2 g-md-3" id="reportes" action="{{ route('reportes.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="text" hidden id="latitud" name="latitud" value="">
                    <input type="text" hidden id="longitud" name="longitud" value="">

                    {{-- Información del Predio --}}
                    <div class="col-12">
                        <div class="card border-0 bg-light">
                            <div class="card-body p-3" style="background-color: #f8f9fa; border-bottom: 3px solid #2c3e50;">
                                <h5 class="card-title mb-3" style="color: #2c3e50;">
                                    <i class="fas fa-building me-2"></i>Información del Predio
                                </h5>

                                {{-- Grid de 2 columnas que se adapta a móvil --}}
                                <div class="row g-2">
                                    {{-- Nombre Cliente --}}
                                    <div class="col-12 col-sm-6">
                                        <div class="info-item" style="background: white; padding: 12px; border-radius: 6px; border: 1px solid #e0e0e0;">
                                            <small style="color: #7a8a99;">Nombre</small>
                                            <p class="mb-0 fw-bold" style="color: #2c3e50;">{{ $data['info']['db_Surtigas']['cliente'] ?? 'sin datos' }}</p>
                                        </div>
                                        <input type="text" name="nombre_cliente" id="nombre_cliente" hidden
                                            value="{{ $data['info']['db_Surtigas']['cliente'] ?? 'sin datos' }}">
                                    </div>

                                    {{-- Número de Contrato --}}
                                    <div class="col-12 col-sm-6">
                                        <div class="info-item" style="background: white; padding: 12px; border-radius: 6px; border: 1px solid #e0e0e0;">
                                            <small style="color: #7a8a99;">Contrato</small>
                                            <p class="mb-0 fw-bold" style="color: #2c3e50;">{{ $data['info']['db_Surtigas']['contrato'] ?? 'sin datos' }}</p>
                                        </div>
                                        <input type="text" name="numero_contrato" id="numero_contrato" hidden
                                            value="{{ $data['info']['db_Surtigas']['contrato'] ?? 'sin datos' }}">
                                    </div>

                                    {{-- Número de Medidor --}}
                                    <div class="col-12 col-sm-6">
                                        <div class="info-item" style="background: white; padding: 12px; border-radius: 6px; border: 1px solid #e0e0e0;">
                                            <small style="color: #7a8a99;">Medidor</small>
                                            <p class="mb-0 fw-bold" style="color: #2c3e50;">{{ $data['info']['db_Surtigas']['medidor'] ?? 'sin datos' }}</p>
                                        </div>
                                        <input type="text" name="numero_medidor" id="numero_medidor" hidden
                                            value="{{ $data['info']['db_Surtigas']['medidor'] ?? 'sin datos' }}">
                                    </div>

                                    {{-- Ciclo --}}
                                    <div class="col-12 col-sm-6">
                                        <div class="info-item" style="background: white; padding: 12px; border-radius: 6px; border: 1px solid #e0e0e0;">
                                            <small style="color: #7a8a99;">Ciclo</small>
                                            <p class="mb-0 fw-bold" style="color: #2c3e50;">{{ $data['info']['db_Surtigas']['ciclo'] ?? 'sin datos' }}</p>
                                        </div>
                                        <input type="text" name="ciclo" id="ciclo" hidden
                                            value="{{ $data['info']['db_Surtigas']['ciclo'] ?? 'sin datos' }}">
                                    </div>

                                    {{-- Dirección --}}
                                    <div class="col-12">
                                        <div class="info-item" style="background: white; padding: 12px; border-radius: 6px; border: 1px solid #e0e0e0;">
                                            <small style="color: #7a8a99;">Dirección</small>
                                            <p class="mb-0 fw-bold text-truncate" style="color: #2c3e50;">{{ $data['info']['db_Surtigas']['direccion'] ?? 'sin datos' }}</p>
                                        </div>
                                        <input type="text" name="direccion" id="direccion" hidden
                                            value="{{ $data['info']['db_Surtigas']['direccion'] ?? 'sin datos' }}">
                                        <input type="text" name="barrio" id="barrio" hidden
                                            value="{{ $data['info']['db_Surtigas']['barrio'] ?? 'sin datos' }}">
                                    </div>

                                    {{-- Estado del Servicio y GIS --}}
                                    <div class="col-12 col-sm-6">
                                        <div class="info-item" style="background: white; padding: 12px; border-radius: 6px; border: 1px solid #e0e0e0;">
                                            <small style="color: #7a8a99;">Estado Servicio</small>
                                            <p class="mb-0">
                                                {!! $data['info']['db_Surtigas']['estado_servicio'] == 1
                                                    ? '<span class="badge" style="background-color: #d4edda; color: #155724;">Activo</span>'
                                                    : '<span class="badge" style="background-color: #f8d7da; color: #721c24;">Inactivo</span>' !!}
                                            </p>
                                        </div>
                                        <input type="text" id="estado_servicio" name="estado_servicio" hidden
                                            value="{{ $data['info']['db_Surtigas']['estado_servicio'] ?? 'sin datos' }}">
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="info-item" style="background: white; padding: 12px; border-radius: 6px; border: 1px solid #e0e0e0;">
                                            <small style="color: #7a8a99;">Estado GIS</small>
                                            <p class="mb-0">
                                                <span class="badge" style="background-color: #e2e3e5; color: #383d41;">{{ $gis['info']['estado'] ?? 'sin datos' }}</span>
                                            </p>
                                        </div>
                                    </div>

                                    <input type="text" id="medidor" name="surtigas_id" hidden
                                        value="{{ $data['info']['db_Surtigas']['id'] }}">

                                    @if (isset($gis['info']))
                                        <div class="col-12">
                                            <div class="info-item" style="background: white; padding: 12px; border-radius: 6px; border: 1px solid #e0e0e0;">
                                                <small style="color: #7a8a99;">Descripción</small>
                                                <p class="mb-0 fw-bold" style="color: #2c3e50;">{{ $gis['info']['descripcion'] ?? 'sin datos' }}</p>
                                            </div>
                                        </div>
                                    @elseif (isset($gis['error']))
                                        <div class="col-12">
                                            <div class="alert alert-danger mb-0" role="alert">
                                                <i class="fas fa-exclamation-circle me-2"></i>{{ $gis['error'] ?? 'sin datos' }}
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                {{-- Botones de Acción --}}
                                <div class="row g-2 mt-2">
                                    @if (isset($gis['info']))
                                        <div class="col-6">
                                            <a id="ubication" href="{{ $gis['geometry']['link'] ?? '#' }}"
                                                target="_blank" class="btn btn-light w-100"
                                                title="Ver Ubicación"><i class="fas fa-map-marker-alt me-2"></i>Ubicación</a>
                                        </div>
                                    @else
                                        <div class="col-6">
                                            <a id="ubication" href="{{ $data['location']['link'] ?? '#' }}"
                                                target="_blank" class="btn btn-light w-100"
                                                title="Ver Ubicación"><i class="fas fa-map-marker-alt me-2"></i>Ubicación</a>
                                        </div>
                                    @endif
                                    <div class="col-6">
                                        <a class="btn btn-secondary w-100"
                                            title="Regresar" href="{{ route('asignados') }}">
                                            <i class="fas fa-arrow-left me-2"></i>Regresar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Formulario Principal --}}
                    <div id="info" class="col-12">
                        <input type="text" name="contrato" id="data_gis" hidden
                            value="{{ $data['info']['db_Surtigas']['contrato'] ?? 'sin datos' }}">

                        {{-- SECCIÓN 1: DATOS DE LA ORDEN --}}
                        <div class="card border-0 mb-3" style="background: #f8f9fa;">
                            <button class="btn btn-link text-start d-flex justify-content-between align-items-center w-100"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#seccionOrden"
                                    style="padding: 14px 16px; text-decoration: none; color: #2c3e50;">
                                <span class="fw-600" style="font-size: 1.05rem;">
                                    <i class="fas fa-file-alt me-2" style="color: #7a8a99;"></i>1. Datos de la Orden
                                </span>
                                <i class="fas fa-chevron-down" style="color: #7a8a99;"></i>
                            </button>
                            <div class="collapse show" id="seccionOrden">
                                <div class="card-body" style="border-top: 1px solid #e0e0e0; padding: 16px;">
                                    {{-- Número de Orden --}}
                                    <div class="mb-3">
                                        <label for="numero_orden" class="form-label fw-500" style="color: #2c3e50;">
                                            <i class="fas fa-hashtag me-2" style="color: #7a8a99;"></i>Número de Orden
                                        </label>
                                        <input type="text" name="numero_orden" id="numero_orden" class="form-control form-control-lg" required>
                                    </div>

                                    {{-- Tipo de Comercio --}}
                                    <div class="mb-3">
                                        <label for="slcComercio" class="form-label fw-500" style="color: #2c3e50;">
                                            <i class="fas fa-store me-2" style="color: #7a8a99;"></i>Tipo de Comercio Encontrado
                                        </label>
                                        <select id="slcComercio" class="form-select form-select-lg" name="tipo_comercio" required>
                                            @foreach ($data['comercios'] as $id => $nombre)
                                                <option value="{{ $nombre }}">{{ $nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Nombre del Comercio --}}
                                    <div class="mb-0">
                                        <label for="nombre_comercio" class="form-label fw-500" style="color: #2c3e50;">
                                            <i class="fas fa-edit me-2" style="color: #7a8a99;"></i>Nombre del Comercio
                                        </label>
                                        <input type="text" name="nombre_comercio" id="nombre_comercio" class="form-control form-control-lg" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- SECCIÓN 2: INFORMACIÓN DEL MEDIDOR --}}
                        <div class="card border-0 mb-3" style="background: #f8f9fa;">
                            <button class="btn btn-link text-start d-flex justify-content-between align-items-center w-100"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#seccionMedidor"
                                    style="padding: 14px 16px; text-decoration: none; color: #2c3e50;">
                                <span class="fw-600" style="font-size: 1.05rem;">
                                    <i class="fas fa-gauge-simple me-2" style="color: #7a8a99;"></i>2. Información del Medidor
                                </span>
                                <i class="fas fa-chevron-down" style="color: #7a8a99;"></i>
                            </button>
                            <div class="collapse show" id="seccionMedidor">
                                <div class="card-body" style="border-top: 1px solid #e0e0e0; padding: 16px;">
                                    {{-- Número de Medidor --}}
                                    <div class="mb-3" id="medidor_anomalia_container">
                                        <label for="medidor_anomalia" class="form-label fw-500" style="color: #2c3e50;">
                                            <i class="fas fa-meter me-2" style="color: #7a8a99;"></i>Número de Medidor
                                        </label>
                                        <input type="text" name="medidor_anomalia" id="medidor_anomalia"
                                            class="form-control form-control-lg" required>
                                    </div>

                                    {{-- Lectura --}}
                                    <div class="mb-3" id="lectura_container">
                                        <label for="lectura" class="form-label fw-500" style="color: #2c3e50;">
                                            <i class="fas fa-tachometer-alt me-2" style="color: #7a8a99;"></i>Lectura del Medidor
                                        </label>
                                        <input type="text" name="lectura" id="lectura" class="form-control form-control-lg" required>
                                    </div>

                                    {{-- Descripción del Medidor --}}
                                    <div class="mb-0" id="descripcion_medidor_container">
                                        <label for="descripcion_medidor" class="form-label fw-500" style="color: #2c3e50;">
                                            <i class="fas fa-file-text me-2" style="color: #7a8a99;"></i>Descripción del Medidor
                                        </label>
                                        <select id="descripcion_medidor" class="form-select form-select-lg" name="descripcion_medidor" required>
                                            @foreach ($data['descripcion_medidor'] as $id => $nombre)
                                                <option value="{{ $nombre }}">{{ $nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- SECCIÓN 3: CONFIGURACIÓN TÉCNICA --}}
                        <div class="card border-0 mb-3" style="background: #f8f9fa;">
                            <button class="btn btn-link text-start d-flex justify-content-between align-items-center w-100"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#seccionTecnica"
                                    style="padding: 14px 16px; text-decoration: none; color: #2c3e50;">
                                <span class="fw-600" style="font-size: 1.05rem;">
                                    <i class="fas fa-sliders-h me-2" style="color: #7a8a99;"></i>3. Configuración Técnica
                                </span>
                                <i class="fas fa-chevron-down" style="color: #7a8a99;"></i>
                            </button>
                            <div class="collapse" id="seccionTecnica">
                                <div class="card-body" style="border-top: 1px solid #e0e0e0; padding: 16px;">
                                    {{-- Tipo de Presión --}}
                                    <div class="mb-3" id="tipo_regulador_container">
                                        <label for="tipo_presion" class="form-label fw-500" style="color: #2c3e50;">
                                            <i class="fas fa-wind me-2" style="color: #7a8a99;"></i>Tipo de Presión
                                        </label>
                                        <select id="tipo_presion" class="form-select form-select-lg" name="tipo_presion" required>
                                            @foreach ($data['tipo_presion'] as $id => $nombre)
                                                <option value="{{ $nombre }}">{{ $nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Marca del Regulador --}}
                                    <div class="mb-3" id="marca_regulador_container">
                                        <label for="marca_regulador" class="form-label fw-500" style="color: #2c3e50;">
                                            <i class="fas fa-wrench me-2" style="color: #7a8a99;"></i>Tipo del Regulador
                                        </label>
                                        <select id="marca_regulador" class="form-select form-select-lg" name="marca_regulador" required>
                                            @foreach ($data['marca_regulador'] as $id => $nombre)
                                                <option value="{{ $nombre }}">{{ $nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Marca del Medidor --}}
                                    <div class="mb-3" id="marca_medidor_container">
                                        <label for="marca_medidor" class="form-label fw-500" style="color: #2c3e50;">
                                            <i class="fas fa-tag me-2" style="color: #7a8a99;"></i>Marca del Medidor
                                        </label>
                                        <select id="marca_medidor" class="form-select form-select-lg" name="marca_medidor" required>
                                            @foreach ($data['marca_medidor'] as $id => $nombre)
                                                <option value="{{ $nombre }}">{{ $nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Notificación de Alertas --}}
                                    <div class="mb-0" id="cau_container">
                                        <label for="cau" class="form-label fw-500" style="color: #2c3e50;">
                                            <i class="fas fa-bell me-2" style="color: #7a8a99;"></i>Notificación de Alertas
                                        </label>
                                        <select id="cau" class="form-select form-select-lg" name="cau" required>
                                            @foreach ($data['alertas'] as $id => $nombre)
                                                <option value="{{ $nombre }}">{{ $nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- SECCIÓN 4: DETECCIÓN DE ANOMALÍAS --}}
                        <div class="card border-0 mb-3" style="background: #f8f9fa;">
                            <button class="btn btn-link text-start d-flex justify-content-between align-items-center w-100"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#seccionAnomalias"
                                    style="padding: 14px 16px; text-decoration: none; color: #2c3e50;">
                                <span class="fw-600" style="font-size: 1.05rem;">
                                    <i class="fas fa-exclamation-triangle me-2" style="color: #7a8a99;"></i>4. Detección de Anomalías
                                </span>
                                <i class="fas fa-chevron-down" style="color: #7a8a99;"></i>
                            </button>
                            <div class="collapse" id="seccionAnomalias">
                                <div class="card-body" style="border-top: 1px solid #e0e0e0; padding: 16px;">
                                    {{-- Anomalías --}}
                                    <div class="mb-3" id="anomaliaContainer">
                                        <label for="slcanomalia" class="form-label fw-500" style="color: #2c3e50;">
                                            <i class="fas fa-search me-2" style="color: #7a8a99;"></i>Anomalías Detectadas
                                        </label>
                                        <select id="slcanomalia" class="form-select form-select-lg select2" name="anomalia[]"
                                            multiple="multiple" data-placeholder="Seleccione las anomalías" required>
                                            @foreach ($data['anomalias'] as $id => $nombre)
                                                <option value="{{ $nombre }}">{{ $nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Imposibilidad --}}
                                    <div class="mb-0" id="container_imposibilidad">
                                        <label for="imposibilidad" class="form-label fw-500" style="color: #2c3e50;">
                                            <i class="fas fa-ban me-2" style="color: #7a8a99;"></i>¿Hubo Imposibilidad?
                                        </label>
                                        <select id="imposibilidad" class="form-select form-select-lg" name="imposibilidad" required>
                                            @foreach ($data['imposibilidad'] as $id => $nombre)
                                                <option value="{{ $nombre }}">{{ $nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SECCIÓN 5: INCIDENCIAS DETECTADAS --}}
                    <div class="col-12">
                        <div class="card border-0 mb-3" style="background: #f8f9fa;">
                            <button class="btn btn-link text-start d-flex justify-content-between align-items-center w-100"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#seccionIncidencias"
                                    style="padding: 14px 16px; text-decoration: none; color: #2c3e50;">
                                <span class="fw-600" style="font-size: 1.05rem;">
                                    <i class="fas fa-exclamation-circle me-2" style="color: #7a8a99;"></i>5. Incidencias Detectadas
                                </span>
                                <i class="fas fa-chevron-down" style="color: #7a8a99;"></i>
                            </button>
                            <div class="collapse" id="seccionIncidencias">
                                <div class="card-body" style="border-top: 1px solid #e0e0e0; padding: 16px;">
                                    <div class="row g-3">
                                        {{-- Checkbox: Fuga de Gas --}}
                                        <div class="col-12">
                                            <label for="fuga_gas" style="cursor: pointer; display: block;">
                                                <div style="padding: 16px; background: white; border-radius: 8px; border: 2px solid #e0e0e0; transition: all 0.3s ease; display: flex; align-items: center; gap: 12px;"
                                                     class="incidencia-option" onclick="toggleCheckbox('fuga_gas')">
                                                    <input class="form-check-input" type="checkbox" id="fuga_gas" name="fuga_gas" value="true" style="width: 24px; height: 24px; cursor: pointer; margin: 0;">
                                                    <div>
                                                        <div class="fw-600" style="color: #2c3e50; font-size: 1rem;">
                                                            <i class="fas fa-water me-2" style="color: #7a8a99;"></i>Hay Fuga de Gas
                                                        </div>
                                                        <small style="color: #7a8a99; display: block; margin-top: 4px;">Detecta fugas o escapes de gas</small>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>

                                        {{-- Checkbox: Excede Capacidad --}}
                                        <div class="col-12">
                                            <label for="ex_capacidad" style="cursor: pointer; display: block;">
                                                <div style="padding: 16px; background: white; border-radius: 8px; border: 2px solid #e0e0e0; transition: all 0.3s ease; display: flex; align-items: center; gap: 12px;"
                                                     class="incidencia-option" onclick="toggleCheckbox('ex_capacidad')">
                                                    <input class="form-check-input" type="checkbox" id="ex_capacidad" name="ex_capacidad" value="true" style="width: 24px; height: 24px; cursor: pointer; margin: 0;">
                                                    <div>
                                                        <div class="fw-600" style="color: #2c3e50; font-size: 1rem;">
                                                            <i class="fas fa-expand me-2" style="color: #7a8a99;"></i>Excede Capacidad
                                                        </div>
                                                        <small style="color: #7a8a99; display: block; margin-top: 4px;">La instalación supera capacidad permitida</small>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SECCIÓN 6: OBSERVACIONES --}}
                    <div class="col-12">
                        <div class="card border-0 mb-3" style="background: #f8f9fa;">
                            <button class="btn btn-link text-start d-flex justify-content-between align-items-center w-100"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#seccionObservaciones"
                                    style="padding: 14px 16px; text-decoration: none; color: #2c3e50;">
                                <span class="fw-600" style="font-size: 1.05rem;">
                                    <i class="fas fa-pen-fancy me-2" style="color: #7a8a99;"></i>6. Observaciones
                                </span>
                                <i class="fas fa-chevron-down" style="color: #7a8a99;"></i>
                            </button>
                            <div class="collapse" id="seccionObservaciones">
                                <div class="card-body" style="border-top: 1px solid #e0e0e0; padding: 16px;">
                                    <label for="comentarios" class="form-label fw-500 mb-2" style="color: #2c3e50;">
                                        <i class="fas fa-note-sticky me-2" style="color: #7a8a99;"></i>Comentarios Adicionales
                                    </label>
                                    <textarea name="comentarios" id="comentarios" rows="5" class="form-control"
                                        placeholder="Agrega aquí cualquier observación importante sobre la inspección..."
                                        style="background: white; border: 2px solid #e0e0e0; color: #2c3e50; padding: 12px; border-radius: 6px;"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SECCIÓN 7: FOTOS EVIDENCIAS --}}
                    <div id="evidencias" class="col-12">
                        <div class="card border-0 mb-3" style="background: #f8f9fa;">
                            <button class="btn btn-link text-start d-flex justify-content-between align-items-center w-100"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#seccionFotos"
                                    style="padding: 14px 16px; text-decoration: none; color: #2c3e50;">
                                <span class="fw-600" style="font-size: 1.05rem;">
                                    <i class="fas fa-camera me-2" style="color: #7a8a99;"></i>7. Fotos Evidencias
                                </span>
                                <i class="fas fa-chevron-down" style="color: #7a8a99;"></i>
                            </button>
                            <div class="collapse show" id="seccionFotos">
                                <div class="card-body" style="border-top: 1px solid #e0e0e0; padding: 16px;">
                                    <div class="row g-2">
                                        {{-- Foto 1: Fachada --}}
                                        <div class="col-12">
                                            <div style="padding: 12px; background: white; border-radius: 6px; border: 2px dashed #c0c0c0;">
                                                <label for="foto1-input" class="form-label mb-2 fw-500" style="color: #2c3e50;">
                                                    <i class="fas fa-building me-2" style="color: #7a8a99;"></i>Foto de la Fachada
                                                </label>
                                                <input type="file" class="form-control form-control-sm" id="foto1-input" name="foto1"
                                                accept="image/jpeg" capture="camera">
                                        </div>
                                    </div>

                                    {{-- Foto 2: Medidor --}}
                                    <div class="col-12">
                                        <div style="padding: 12px; background: white; border-radius: 6px; border: 2px dashed #c0c0c0;">
                                            <label for="foto2-input" class="form-label mb-2 fw-500" style="color: #2c3e50;">
                                                <i class="fas fa-gauge-simple me-2" style="color: #7a8a99;"></i>Foto del Medidor
                                            </label>
                                            <input type="file" class="form-control form-control-sm" id="foto2-input" name="foto2"
                                                accept="image/jpeg" capture="camera">
                                        </div>
                                    </div>

                                    {{-- Foto 3: Odómetro --}}
                                    <div class="col-12">
                                        <div style="padding: 12px; background: white; border-radius: 6px; border: 2px dashed #c0c0c0;">
                                            <label for="foto3-input" class="form-label mb-2 fw-500" style="color: #2c3e50;">
                                                <i class="fas fa-meter me-2" style="color: #7a8a99;"></i>Foto del Odómetro
                                            </label>
                                            <input type="file" class="form-control form-control-sm" id="foto3-input" name="foto3"
                                                accept="image/jpeg" capture="camera">
                                        </div>
                                    </div>

                                    {{-- Foto 4: Regulador --}}
                                    <div class="col-12">
                                        <div style="padding: 12px; background: white; border-radius: 6px; border: 2px dashed #c0c0c0;">
                                            <label for="foto4-input" class="form-label mb-2 fw-500" style="color: #2c3e50;">
                                                <i class="fas fa-microchip me-2" style="color: #7a8a99;"></i>Foto del Regulador
                                            </label>
                                            <input type="file" class="form-control form-control-sm" id="foto4-input" name="foto4"
                                                accept="image/jpeg" capture="camera">
                                        </div>
                                    </div>

                                    {{-- Foto 5: Detector de Fuga (Condicional) --}}
                                    <div class="col-12 d-none" id="foto5-button">
                                        <div style="padding: 12px; background: white; border-radius: 6px; border: 2px dashed #c0c0c0;">
                                            <label for="foto5-input" class="form-label mb-2 fw-500" style="color: #2c3e50;">
                                                <i class="fas fa-water me-2" style="color: #7a8a99;"></i>Foto Detector de Fuga
                                            </label>
                                            <input type="file" class="form-control form-control-sm" id="foto5-input" name="foto5"
                                                accept="image/jpeg" capture="camera">
                                        </div>
                                    </div>

                                    {{-- Foto 6: Exceso de Capacidad (Condicional) --}}
                                    <div class="col-12 d-none" id="foto6-button">
                                        <div style="padding: 12px; background: white; border-radius: 6px; border: 2px dashed #c0c0c0;">
                                            <label for="foto6-input" class="form-label mb-2 fw-500" style="color: #2c3e50;">
                                                <i class="fas fa-exclamation-triangle me-2" style="color: #7a8a99;"></i>Foto Exceso de Capacidad
                                            </label>
                                            <input type="file" class="form-control form-control-sm" id="foto6-input" name="foto6"
                                                accept="image/jpeg" capture="camera">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-info mt-3 d-none" role="alert" id="progressBarObservacion">
                            <i class="fas fa-spinner fa-spin me-2"></i><span class="text-sm">Guardando, por favor espere...</span>
                        </div>
                    </div>

                    {{-- Botón Enviar --}}
                    <div class="col-12 sticky-bottom bg-white pt-3 pb-3" style="box-shadow: 0 -2px 10px rgba(0,0,0,0.05);">
                        <button type="submit" class="btn btn-lg w-100" id="submitButtonReporte" style="background-color: #2c3e50; border-color: #2c3e50; color: white;">
                            <i class="fas fa-paper-plane me-2"></i>Enviar Reporte
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('script/agentes/AgentesGlobal.js') }}"></script>
    <script>
        $(".select2").select2({
            theme: "classic"
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#reportes').submit(function() {
                $('#submitButtonReporte').addClass('d-none');
                $('#progressBarObservacion').removeClass('d-none');
            });
        });
    </script>
    <script>
        document.getElementById('reportes').addEventListener('submit', function(event) {
            event.preventDefault();
            fetch('/check-connection', {
                    method: 'GET'
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status === 'ok') {
                        this.submit();
                    }
                })
                .catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Sin conexión a internet',
                        text: 'No tienes conexión a internet. Por favor, revisa tu conexión y vuelve a intentarlo.',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Acciones a ejecutar cuando se presiona "OK" en la alerta
                            $('#submitButtonReporte').removeClass('d-none');
                            $('#progressBarObservacion').addClass('d-none');
                        }
                    });
                });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fugaGasCheckbox = document.getElementById('fuga_gas');
            const foto5Button = document.getElementById('foto5-button');

            fugaGasCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    foto5Button.classList.remove('d-none');
                } else {
                    foto5Button.classList.add('d-none');
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fugaGasCheckbox = document.getElementById('ex_capacidad');
            const foto6Button = document.getElementById('foto6-button');

            fugaGasCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    foto6Button.classList.remove('d-none');
                } else {
                    foto6Button.classList.add('d-none');
                }
            });
        });
    </script>
    <script>
        // Función para mejorar interactividad de los checkboxes de incidencias
        function toggleCheckbox(checkboxId) {
            const checkbox = document.getElementById(checkboxId);
            checkbox.checked = !checkbox.checked;

            // Cambiar estilo del borde cuando está seleccionado
            const option = checkbox.closest('.incidencia-option');
            if (checkbox.checked) {
                option.style.borderColor = '#2c3e50';
                option.style.backgroundColor = '#f0f4f8';
            } else {
                option.style.borderColor = '#e0e0e0';
                option.style.backgroundColor = 'white';
            }
        }

        // Aplicar estilos iniciales y listeners
        document.addEventListener('DOMContentLoaded', function() {
            ['fuga_gas', 'ex_capacidad'].forEach(checkboxId => {
                const checkbox = document.getElementById(checkboxId);
                const option = checkbox.closest('.incidencia-option');

                // Disparar evento change para mantener compatibilidad
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        option.style.borderColor = '#2c3e50';
                        option.style.backgroundColor = '#f0f4f8';
                    } else {
                        option.style.borderColor = '#e0e0e0';
                        option.style.backgroundColor = 'white';
                    }
                });

                // Establecer estilo inicial si ya está checked
                if (checkbox.checked) {
                    option.style.borderColor = '#2c3e50';
                    option.style.backgroundColor = '#f0f4f8';
                }
            });
        });
    </script>
@endsection
