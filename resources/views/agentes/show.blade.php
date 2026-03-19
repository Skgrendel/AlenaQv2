@extends('layouts.frontpage.app')

@section('content')
    <div class="widget-content widget-content-area">
        <div class="row">
            {{-- Card Información del Predio GIS --}}
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
                                        <span class="text-card">Información del Predio: <strong>{{ $gis['info']['cliente'] ?? 'sin datos' }}</strong></span>
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
                                            <span class="text-muted text-sm">Ciclo:</span>
                                            <span class="text-card text-sm fw-500">{{ $data['info']['db_Surtigas']['ciclo'] ?? 'sin datos' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-3">

                            {{-- Información de Servicio --}}
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
                                            <span class="text-muted text-sm">Medidor:</span>
                                            <span class="text-card text-sm fw-500">{{ $gis['info']['medidor'] ?? 'sin datos' }}</span>
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

                            <input type="text" id="medidor" name="surtigas_id" hidden value="{{ $data['info']['id'] }}">

                            <hr class="my-3">

                            {{-- Botones de Acción --}}
                            <div class="d-flex justify-content-between">
                                <a href="{{ $gis['geometry']['link'] ?? '#' }}" target="_blank"
                                    class="btn btn-info me-2 bs-tooltip rounded" title="Ver Ubicación en Google Maps"
                                    data-bs-placement="top"><i class="fas fa-map-marker-alt me-2"></i>Ubicación</a>
                                <a class="btn btn-secondary rounded bs-tooltip"
                                    title="Regresar a Página Anterior" data-bs-placement="top"
                                    href="{{ route('reportes.index') }}"><i class="fas fa-arrow-circle-left me-2"></i>Volver</a>
                            </div>
                        @else
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>{{ $gis['error'] ?? 'Error desconocido' }}
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

            {{-- Card Información del Reporte --}}
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
                                        <span class="text-card">Información del Reporte</span>
                                    </h4>
                                </div>
                            </div>
                            <hr class="my-2">
                        </div>

                        {{-- Comercio | Configuración Técnica --}}
                        <div class="row">
                            {{-- Columna Izquierda: Comercio y Medidor --}}
                            <div class="col-6">
                                {{-- Comercio --}}
                                <div class="mb-4">
                                    <h6 class="text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                        <i class="fas fa-store me-2"></i>Comercio
                                    </h6>
                                    <div class="row mt-2">
                                        <div class="col-12 mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted text-sm">Tipo:</span>
                                                <select id="comercio" class="form-select form-select-sm" name="tipo_comercio" disabled style="max-width: 200px;">
                                                    @foreach ($data['comercios'] as $id => $nombre)
                                                        <option value="{{ $id }}"
                                                            {{ $data['info']['comerciosid'] == $id ? 'selected' : '' }}>{{ $nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted text-sm">Nombre:</span>
                                                <span class="text-card text-sm fw-500">{{ $data['info']['nombrecomercio'] ?? 'Sin datos' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-3">

                                {{-- Información del Medidor --}}
                                <div class="mb-4">
                                    <h6 class="text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                        <i class="fas fa-gauge-simple me-2"></i>Medidor
                                    </h6>
                                    <div class="row mt-2">
                                        <div class="col-12 mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted text-sm">Lectura:</span>
                                                <span class="text-card text-sm fw-bold">{{ $data['info']['lectura'] ?? 'sin datos' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted text-sm">Medidor Encontrado (Anomalía):</span>
                                                <span class="badge badge-light-warning text-sm">{{ $data['info']['medidoranomalia'] ?? 'Sin datos' }}</span>
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
                                                <span class="text-card text-sm fw-500">{{ $data['info']['descripcion del medidor'] ?? 'Sin Datos' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Columna Derecha: Configuración Técnica, Incidencias y Comentarios --}}
                            <div class="col-6">
                                {{-- Configuración Técnica --}}
                                <div class="mb-4">
                                    <h6 class="text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                        <i class="fas fa-wrench me-2"></i>Configuración Técnica
                                    </h6>
                                    <div class="row mt-2">
                                        <div class="col-12 mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted text-sm">Tipo de Presión:</span>
                                                <span class="text-card text-sm fw-500">{{ $data['info']['tipo de presion'] ?? 'Sin Datos' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted text-sm">Marca del Regulador:</span>
                                                <span class="text-card text-sm fw-500">{{ $data['info']['marca de regulador'] ?? 'Sin Datos' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-3">

                                {{-- Estado e Incidencias --}}
                                <div class="mb-4">
                                    <h6 class="text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                        <i class="fas fa-exclamation-triangle me-2"></i>Incidencias
                                    </h6>
                                    <div class="row mt-2">
                                        <div class="col-12 mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted text-sm">Anomalías:</span>
                                                <span class="badge badge-light-danger text-sm">{{ implode(', ', $data['info']['anomalias'] ?? []) ?: 'Sin anomalías' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted text-sm">Imposibilidad:</span>
                                                <span class="badge badge-light-secondary text-sm">{{ $data['info']['imposibilidad'] ?? 'Ninguna' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if (isset($data['info']['comentarios']))
                                    <hr class="my-3">
                                    {{-- Comentarios --}}
                                    <div>
                                        <h6 class="text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                            <i class="fas fa-comments me-2"></i>Comentarios
                                        </h6>
                                        <div class="alert alert-soft-info border-0 mt-2 mb-0" style="background-color: rgba(87, 167, 225, 0.1);">
                                            <p class="text-card text-sm mb-0">{{ $data['info']['comentarios'] }}</p>
                                        </div>
                                    </div>
                                @endif
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
        </div>

        {{-- Galería de Imágenes Mejorada --}}
        <div class="widget-content widget-content-area mt-3">
            <div class="card style-4">
                <div class="card-body pt-3">
                    <h6 class="text-uppercase text-muted mb-3" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                        <i class="fas fa-images me-2"></i>Galería de Evidencias
                    </h6>
                    <div class="row g-3">
                        @php
                            $tieneImagenes = false;
                            for ($i = 1; $i <= 6; $i++) {
                                if (!empty($data['imagenes']['foto' . $i])) {
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
                                    <i class="fas fa-camera me-2"></i>No hay imágenes disponibles para este reporte.
                                </div>
                            </div>
                        @endif
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

        <style>
            .glightbox-content:hover img {
                transform: scale(1.05);
            }

            .glightbox-content:hover .overlay-icon {
                opacity: 1 !important;
            }
        </style>
    </div>
@endsection
