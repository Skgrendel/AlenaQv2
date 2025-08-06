@extends('layouts.frontpage.app')

@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-body">
                <div class="col-12 mb-1 " id="ubicacion">
                    <div class="">
                        <div class="col-lg-12 ">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <label class="form-label"> Informacion del Predio</label>
                                        @if (isset($gis['info']))
                                            <div class="mb-1">
                                                <label for="nombre_cliente">Nombre:</label>
                                                <span class=" text-body staticEmail "
                                                    id="nombre_cliente">{{ $gis['info']['cliente'] ?? 'sin datos' }}</span>
                                            </div>
                                            <div class="mb-1">
                                                <label for="numero_contrato" class="form-label">Numero de
                                                    Contrato:</label>
                                                <span class="text-body staticEmail"
                                                    id="numero_contrato">{{ $gis['info']['contrato'] ?? 'sin datos' }}</span>
                                            </div>
                                            <div class="mb-1">
                                                <label for="numero_medidor" class="form-label">Numero de Medidor:
                                                </label>
                                                <span class=" text-body"
                                                    id="numero_medidor">{{ $gis['info']['medidor'] ?? 'sin datos' }}</span>
                                            </div>
                                            <div class="mb-1">
                                                <label for="direccion">Direccion: </label>
                                                <span class=" text-body"
                                                    id="direccion">{{ $gis['info']['direccion'] ?? 'sin datos' }}</span>
                                            </div>
                                            <div class="mb-1">
                                                <label for="ciclo">Ciclo: </label>
                                                <span class=" text-body"
                                                    id="ciclo">{{ $data['info']['db_Surtigas']['ciclo'] ?? 'sin datos' }}</span>
                                            </div>
                                            <div class="mb-1">
                                                <label for="ciclo">Descripcion: </label>
                                                <span class=" text-body"
                                                    id="ciclo">{{ $gis['info']['descripcion'] ?? 'sin datos' }}</span>
                                            </div>
                                            <input type="text" id="medidor" name="surtigas_id" hidden
                                                value="{{ $data['info']['id'] }}">
                                            <hr>
                                            <div class="d-flex justify-content-between ">
                                                <a href="{{ $gis['geometry']['link'] ?? '#' }}" target="_blank"
                                                    class="btn btn-info me-4 bs-tooltip rounded " title="Ver Ubicacion"
                                                    data-bs-placement="top"><i class="fas fa-map-marker-alt"></i></a>
                                                <a class="btn btn-info me-4 rounded  bs-tooltip"
                                                    title="Regresar Pagina Anterior" data-bs-placement="top"
                                                    href="{{ route('reportes.index') }}"><i
                                                        class="fas fa-arrow-circle-left"></i></a>
                                            </div>
                                        @endif
                                        @if (isset($gis['error']))
                                            <div class="mb-1">
                                                <label for="numero_contrato" class="form-label">Error:</label>
                                                <span class="text-body staticEmail"
                                                    id="numero_contrato">{{ $gis['error'] ?? 'sin datos' }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="comercio" class="form-label"> Tipo de Comercio Encontrado</label>
                    <select id="comercio" class="form-select" name="tipo_comercio" disabled>
                        @foreach ($data['comercios'] as $id => $nombre)
                            <option value="{{ $id }}"
                                {{ $data['info']['comerciosid'] == $id ? 'selected' : '' }}>{{ $nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3">
                    <label for="nueva_opcion" class="form-label"> Nombre del Comercio Encontrado</label>
                    <span class="form-control" id="nombre_comercio">{{ $data['info']['nombrecomercio'] }}</span>
                </div>
                <div class="col-12" id="cont-medidor">
                    <div class="col-lg-12 mb-2" id="medidor_anomalia_container">
                        <div class="mt-1">
                            <label for="nueva_opcion" class="form-label"> Numero de Medidor Encontrado Anomalia </label>
                            <span id="medidor_anomalia" class="form-control">{{ $data['info']['medidoranomalia'] }}</span>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-2" id="anomaliaContainer">
                        <div class="mt-1">
                            <label for="anomalia_texto" class="form-label">Anomalia Detectada</label>
                            <span class="form-control" id="anomalia_texto" name="anomalia_texto" rows="3"
                                disabled>{{ implode(', ', $data['info']['anomalias']) }}</span>
                        </div>
                    </div>

                    <div class="col-lg-12 mb-2" id="lectura_container">
                        <div class="mt-1">
                            <label for="lectura" class="form-label">Numero de Lectura ingresada</label>
                            <span id="lectura" class="form-control">{{ $data['info']['lectura'] }}</span>
                        </div>
                    </div>
                    <div class="col-12 mb-2 " id="container_imposibilidad">
                        <label for="imposibilidad" class="form-label">Imposibilidad Detectada</label>
                        <div class="mt-1">
                            <span class="form-control" id="imposibilidad">{{ $data['info']['imposibilidad'] }}</span>
                        </div>
                    </div>
                    <div class="col-12 mb-2 " id="container_presion">
                        <label for="tipo_presion" class="form-label">Tipo de Presion</label>
                        <div class="mt-1">
                            <span class="form-control" id="tipo_presion">{{ $data['info']['tipo de presion'] }}</span>
                        </div>
                    </div>
                    <div class="col-12 mb-2 " id="container_descripcion_medidor">
                        <label for="descripcion_medidor" class="form-label">Descripcion del Medidor</label>
                        <div class="mt-1">
                            <span class="form-control"
                                id="descripcion_medidor">{{ $data['info']['descripcion del medidor'] ?? 'Sin Datos' }}
                            </span>
                        </div>
                    </div>
                    <div class="col-12 mb-2 " id="container_marca_medidor">
                        <label for="marca_medidor" class="form-label">Marca del Medidor</label>
                        <div class="mt-1">
                            <span class="form-control" id="marca_medidor">{{ $data['info']['marca de medidor'] }}</span>
                        </div>
                    </div>
                    <div class="col-12 mb-2 " id="container_marca_regulador">
                        <label for="marca_regulador" class="form-label">Marca del Regulador</label>
                        <div class="mt-1">
                            <span class="form-control" id="marca_regulador">{{ $data['info']['marca de regulador'] }}</span>
                        </div>
                    </div>
                    <div class="col-12 mb-2 " id="container_alertas">
                        <label for="alertas" class="form-label">Alertas del Medidor</label>
                        <div class="mt-1">
                            <span class="form-control" id="alertas">{{ $data['info']['alertas'] }}</span>
                        </div>
                    </div>
                </div>
                @if (isset($data['info']['comentarios']))
                    <div class="col-12">
                        <label for="comentarios" class="form-label">comentarios</label>
                        <span id="comentarios" cols="30" rows="3"
                            class="form-control">{{ $data['info']['comentarios'] }}</span>
                    </div>
                @endif
                <br>
                <div id="evidencias" class="col-lg-12 layout-spacing ">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <div class="simple-tab">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#profile-tab-pane" type="button" role="tab"
                                            aria-controls="profile-tab-pane" aria-selected="false">Fotos y video</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane show active fade" id="profile-tab-pane" role="tabpanel"
                                        aria-labelledby="profile-tab" tabindex="0">
                                        <div class="widget-content widget-content-area mt-2 ">
                                            <div class="row">
                                                @foreach (range(1, 6) as $i)
                                                    @php
                                                        // La variable $rutaImagen ya debe contener la ruta completa desde la base de datos
                                                        $rutaImagen = $data['imagenes']['foto' . $i] ?? null;

                                                        // Opcional: Si quieres un título descriptivo para el lightbox, puedes extraerlo del nombre del archivo
                                                        $nombreArchivo = $rutaImagen
                                                            ? pathinfo($rutaImagen, PATHINFO_FILENAME)
                                                            : 'Imagen';
                                                        $tituloGlightbox =
                                                            $nombreArchivo .
                                                            ' - Contrato #: ' .
                                                            ($data['info']['contrato'] ?? 'N/A');

                                                        // La descripción adicional para el lightbox
                                                        $descripcionGlightbox =
                                                            'Contrato #: ' .
                                                            ($data['info']['contrato'] ?? 'N/A') .
                                                            ' - Medidor #: ' .
                                                            ($data['info']['medidor'] ?? 'N/A');
                                                    @endphp

                                                    {{-- Solo muestra el div si la ruta de la imagen existe --}}
                                                    @if ($rutaImagen)
                                                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                                            {{-- Usa asset() para generar la URL pública correcta --}}
                                                            <a href="{{ asset($rutaImagen) }}"
                                                                class="withDescriptionGlightbox glightbox-content"
                                                                data-glightbox="title: {{ $tituloGlightbox }}; description: {{ $descripcionGlightbox }};">
                                                                <img src="{{ asset($rutaImagen) }}"
                                                                    alt="{{ $nombreArchivo }}" class="img-fluid"
                                                                    style="width:350px; height:250px; object-fit: cover;" />
                                                            </a>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
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
    <script src="{{ asset('script/agentes/AgentesGlobal.js') }}"></script>
@endsection
