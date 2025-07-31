@extends('layouts.frontpage.app')

@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-body">
                <form class="row g-3" id="reportes" action="{{ route('reportes.update', $data['info']['reporte']['id']) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="text" id="medidor" name="medidor" hidden
                        value="{{ $data['info']['reporte']['medidor'] }}">
                    <input type="text" id="contrato" name="contrato" hidden
                        value="{{ $data['info']['reporte']['contrato'] }}">
                    <input type="text" id="id" name="id" hidden value="{{ $data['info']['reporte']['id'] }}">
                    <input type="text" hidden id="latitud" name="latitud" value="">
                    <input type="text" hidden id="longitud" name="longitud" value="">
                    <div class="col-12 mb-1 " id="ubicacion">
                        <div class="">
                            <div class="col-lg-12 ">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <label class="form-label"> Informacion del Predio</label>
                                            <div class="mb-1">
                                                <label for="nombre_cliente">Nombre:</label>
                                                <span class=" text-body staticEmail "
                                                    id="nombre_cliente">{{ $data['data']['db_Surtigas']['cliente'] ?? 'sin datos' }}</span>
                                            </div>
                                            <div class="mb-1">
                                                <label for="numero_contrato" class="form-label">Numero de
                                                    Contrato:</label>
                                                <span class="text-body staticEmail"
                                                    id="numero_contrato">{{ $data['data']['db_Surtigas']['contrato'] ?? 'sin datos' }}</span>
                                            </div>
                                            <div class="mb-1">
                                                <label for="numero_medidor" class="form-label">Numero de Medidor:
                                                </label>
                                                <span class=" text-body"
                                                    id="numero_medidor">{{ $data['data']['db_Surtigas']['medidor'] ?? 'sin datos' }}</span>
                                            </div>
                                            <div class="mb-1">
                                                <label for="direccion">Direccion: </label>
                                                <span class=" text-body"
                                                    id="direccion">{{ $data['data']['db_Surtigas']['direccion'] ?? 'sin datos' }}</span>
                                            </div>
                                            <div class="mb-1">
                                                <label for="ciclo">Ciclo: </label>
                                                <span class=" text-body"
                                                    id="ciclo">{{ $data['data']['db_Surtigas']['ciclo'] ?? 'sin datos' }}</span>
                                            </div>
                                            <div class="mb-1">
                                                <label for="ciclo">Estado del Servicio: </label>
                                                <span class="text-card text-sm">
                                                    {!! $data['data']['db_Surtigas']['estado_servicio'] == 1
                                                        ? '<span class="badge bg-success">Activo</span>'
                                                        : '<span class="badge bg-danger">Inactivo </span>' !!}</span>
                                            </div>
                                            <div class="mb-1">
                                                <label for="ciclo">Estado del Servicio en el Gis: </label>
                                                <span class="text-card text-sm"><span
                                                        class="badge bg-warning">{{ $gis['info']['estado'] ?? 'sin datos' }}</span></span>
                                            </div>
                                            <input type="text" id="medidor" name="surtigas_id" hidden
                                                value="{{ $data['data']['db_Surtigas']['id'] }}">
                                            @if (isset($gis['info']))
                                                <div class="mb-1">
                                                    <label for="ciclo">Descripcion: </label>
                                                    <span class=" text-body"
                                                        id="ciclo">{{ $gis['info']['descripcion'] ?? 'sin datos' }}
                                                    </span>
                                                </div>
                                            @elseif (isset($gis['error']))
                                                <div class="mb-1">
                                                    <label for="numero_contrato" class="form-label">Error:</label>
                                                    <span class="text-body"
                                                        id="numero_contrato">{{ $gis['error'] ?? 'sin datos' }}</span>
                                                </div>
                                            @endif
                                            <hr>
                                            <div class="d-flex justify-content-between ">
                                                @if (isset($gis['info']))
                                                    <a id="ubication" href="{{ $gis['geometry']['link'] ?? '#' }}"
                                                        target="_blank" class="btn btn-info me-4 bs-tooltip rounded "
                                                        title="Ver Ubicacion Gis" data-bs-placement="top"><i
                                                            class="fas fa-map-marker-alt"></i></a>
                                                @else
                                                    <a id="ubication" href="{{ $data['location']['link'] ?? '#' }}"
                                                        target="_blank" class="btn btn-danger me-4 bs-tooltip rounded "
                                                        title="Ver Ubicacion Surtigas" data-bs-placement="top"><i
                                                            class="fas fa-map-marker-alt"></i></a>
                                                @endif
                                                <a class="btn btn-info me-4 rounded  bs-tooltip"
                                                    title="Regresar Pagina Anterior" data-bs-placement="top"
                                                    href="{{ route('asignados') }}"><i
                                                        class="fas fa-arrow-circle-left"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="nueva_opcion" class="form-label">Numero de Orden</label>
                        <input type="text" name="numero_orden" id="numero_orden" class="form-control"
                            value="{{ $data['info']['reporte']['numero_orden'] }}">
                        <label for="comercio" class="form-label"> Tipo de Comercio Encontrado</label>
                        <select id="comercio" class="form-select" name="tipo_comercio">
                            @foreach ($data['comercios'] as $id => $nombre)
                                <option
                                    value="{{ $nombre }}"{{ $data['info']['comercio'] == $nombre ? 'selected' : '' }}>
                                    {{ $nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="nueva_opcion" class="form-label"> Nombre del Comercio Encontrado</label>
                        <input type="text" name="nombre_comercio" id="nombre_comercio" class="form-control"
                            value="{{ $data['info']['comercio']['nombre_comercio'] }}">
                    </div>
                    <div class="col-12" id="cont-medidor">
                        <div class="col-lg-12 mb-2" id="medidor_anomalia_container">
                            <div class="mt-1">
                                <label for="nueva_opcion" class="form-label"> Numero de Medidor Encontrado Anomalia
                                </label>
                                <input type="text" name="medidor_anomalia" id="medidor_anomalia" class="form-control"
                                    value="{{ $data['info']['comercio']['medidor_anomalia'] }}">
                            </div>
                        </div>
                        <div class="col-lg-12 mb-2" id="anomaliaContainer">
                            <div class="mt-1">
                                <label for="nueva_opcion" class="form-label ">Anomalia Detectada</label>
                                <select id="anomalia" class="form-control select2" name="anomalia[]" multiple>
                                    @php
                                        $seleccionadas = $data['info']['anomalias']; // <- array con las seleccionadas desde la BD (ya decodificadas)
                                    @endphp

                                    @foreach ($data['anomalias'] as $id => $nombre)
    <option value="{{ $nombre }}" {{ in_array($nombre, $seleccionadas ?? []) ? 'selected' : '' }}>
        {{ $nombre }}
    </option> @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-2" id="lectura_container">
                            <div class="mt-1">
                                <label for="lectura" class="form-label">Numero de Lectura ingresada</label>
                                <input type="text" name="lectura" id="lectura" class="form-control"
                                    value="{{ $data['info']['reporte']['lectura'] }}">
                            </div>
                        </div>
                        <div class="col-12 mb-2" id="container_imposibilidad">
                            <label for="imposibilidad" class="form-label">Imposibilidad Detectada</label>
                            <select id="imposibilidad" class="form-select" name="imposibilidad">
                                @foreach ($data['imposibilidad'] as $id => $nombre)
                                    <option
                                        value="{{ $nombre }}"{{ $data['info']['reporte']['imposibilidad'] == $nombre ? 'selected' : '' }}>
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
                                        value="{{ $nombre }}"{{ $data['info']['reporte']['tipo_presion'] == $nombre ? 'selected' : '' }}>
                                        {{ $nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12  mb-2" id="descripcion_medidor_container">
                                <label for="descripcion_medidor" class="form-label">Descripcion del Medidor</label>
                                <select id="descripcion_medidor" class="form-select" name="descripcion_medidor" required>
                                    @foreach ($data['descripcion_medidor'] as $id => $nombre)
                                        <option value="{{ $nombre }}"{{ $data['info']['reporte']['descripcion'] == $nombre ? 'selected' : '' }}>{{ $nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                    <div class="col-12  mb-2" id="marca_regulador_container">
                        <label for="marca_regulador" class="form-label">Tipo del Regulador</label>
                        <select id="marca_regulador" class="form-select" name="marca_regulador">
                            @foreach ($data['info']['marca de regulador'] as $id => $nombre)
                                <option
                                    value="{{ $nombre }}"{{ $data['info']['reporte']['marca_regulador'] == $nombre ? 'selected' : '' }}>
                                    {{ $nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12  mb-2" id="marca_medidor_container">
                        <label for="marca_medidor" class="form-label">Marca del Medidor</label>
                        <select id="marca_medidor" class="form-select" name="marca_medidor">
                            @foreach ($data['info']['marca de medidor'] as $id => $nombre)
                                <option
                                    value="{{ $nombre }}"{{ $data['info']['reporte']['marca_medidor'] == $nombre ? 'selected' : '' }}>
                                    {{ $nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 mb-2" id="cau_container">
                        <label for="cau" class="form-label">Notificación de Alertas</label>
                        <select id="cau" class="form-select" name="cau">
                            <option disabled>──────────</option>
                            @php
                                $opcionesCau = [
                                    'Sin Alertas',
                                    'Exceso de Capacidad',
                                    'CAU 01',
                                    'CAU 02',
                                    'CAU 03',
                                    'CAU 04',
                                    'Retro Flujo',
                                    'Bateria Baja',
                                ];
                                $valorSeleccionado = $data['info']['reporte']['cau'] ?? null; // o ajusta según tu estructura
                            @endphp

                            @foreach ($opcionesCau as $opcion)
                                <option value="{{ $opcion }}"
                                    {{ $valorSeleccionado == $opcion ? 'selected' : '' }}>
                                    {{ $opcion }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="comentarios" class="form-label">Observaciones</label>
                        <textarea name="comentarios" id="comentarios" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                    <div id="evidencias" class="col-lg-12 layout-spacing ">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-content widget-content-area">
                                <div class="simple-tab">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                                data-bs-target="#home-tab-pane" type="button" role="tab"
                                                aria-controls="home-tab-pane" aria-selected="true">Evidencias</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                                data-bs-target="#profile-tab-pane" type="button" role="tab"
                                                aria-controls="profile-tab-pane" aria-selected="false">Fotos y
                                                video</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                            aria-labelledby="home-tab" tabindex="0">
                                            <div class="col-md-12">
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
                                                <div class="d-none" id="foto5-button">
                                                    <span class="input-group-text m-2" for="foto5-input">Foto Detector de
                                                        Fuga</span>
                                                    <input type="file" class="form-control" id="foto5-input"
                                                        name="foto5" accept="image/jpeg" capture="camera">
                                                </div>
                                                <div class="d-none" id="foto6-button">
                                                    <span class="input-group-text m-2" for="foto6-input">Foto Exceso de
                                                        Capacidad</span>
                                                    <input type="file" class="form-control" id="foto6-input"
                                                        name="foto6" accept="image/jpeg" capture="camera">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel"
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

                        <div class="col-12">
                            <button class="btn btn-success mb-2 me-4 d-none" id="progressBarReporte">
                                <div class="spinner-border text-white me-2 align-self-center loader-sm "></div> Enviando
                                Archivos Espere...
                            </button>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mt-3" id="submitButtonReporte">Enviar</button>
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
@endsection
