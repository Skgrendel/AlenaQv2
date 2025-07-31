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
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="media-title">Numero de Contrato:
                                                    <strong>{{ $data['info']['contrato'] ?? 'Sin datos' }}</strong> </span>
                                            </div>
                                        </div>
                                    </h4>
                                </div>
                            </div>
                            <hr class="my-2">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <ul>

                                    <li>
                                        <span class="text-card text-sm"> Numero del Medidor:
                                            {{ $data['info']['medidor'] ?? 'Sin medidor' }}</span>
                                    </li>
                                    <li>
                                        <span class="text-card text-sm"> Numero de Lectura:
                                            {{ $data['info']['reporte']['lectura'] }}</span>
                                    </li>
                                    <li>
                                        <span class="text-card text-sm"> Tipo de Comercio:
                                            {{ $data['info']['comercios'] ?? 'No tiene comercio' }}</span>
                                    </li>
                                    <li>
                                        <span class="text-card text-sm"> Ciclo:
                                            {{ $data['info']['ciclo']['ciclo'] ?? 'Sin Datos' }}</span>
                                    </li>
                                    <li>
                                        <span class="text-card text-sm"> Tipo de Presion:
                                            {{ $data['info']['tipo presion'] ?? 'Sin Datos' }}</span>
                                    </li>
                                    <li>
                                        <span class="text-card text-sm"> Descipcion del Medidor:
                                            {{ $data['info']['descripcion_medidor'] ?? 'Sin Datos' }}</span>
                                    </li>

                                    <li>
                                        <span class="text-card text-sm"> Marca del Regulador:
                                            {{ $data['info']['marca de regulador'] ?? 'Sin Datos' }}</span>

                                    </li>
                                    <li>
                                        <span class="text-card text-sm"> Marca del Medidor:
                                            {{ $data['info']['marca de medidor'] ?? 'Sin Datos' }}</span>
                                    </li>

                                    <li>
                                        <span class="text-card text-sm">Medidor Encontrado:
                                            {{ $data['info']['medidoranomalia'] ?? 'Sin datos' }}</span>
                                    </li>
                                    <li>
                                        <span class="text-card text-sm">Estado:
                                            {!! $data['info']['estado'] == 1
                                                ? '<span class="badge bg-success">Activo</span>'
                                                : '<span class="badge bg-danger">Inactivo </span>' !!}</span>
                                    </li>
                                    <li>
                                        <span class="text-card text-sm">
                                            Alertas del Medidor:
                                            @if (trim($data['info']['alertas']) === 'Sin Alertas')
                                                <span class="badge bg-success">Sin Alertas</span>
                                            @else
                                                <span class="badge bg-danger">{{ $data['info']['alertas'] }}</span>
                                            @endif
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul>
                                    <li>
                                        <span class="text-card text-sm">Imposibilidad:
                                            {{ $data['info']['imposibilidad'] ?? 'No registra imposibilidades' }}</span>
                                    </li>
                                    <li>
                                        <span class="text-card text-sm">
                                            Anomalias:
                                            {{ is_string($data['info']['anomalias']) ? $data['info']['anomalias'] : 'sin datos' }}
                                        </span>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <span class="text-card mb-2"> <strong>Comentarios del Agente de Campo</strong></span><br>
                            <div class="text-card text-sm">{{ $data['info']['comentarios'] ?? 'sin datos' }}</div>
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
                                        <span class="text-card">Datos del Usuario
                                        </span>
                                    </h4>
                                </div>
                            </div>
                            <hr class="my-2">
                        </div>
                        @if (isset($gis['info']))
                            <div class="row mt-2">
                                <div class="text-card text-sm col-6">
                                    <ul>
                                        <li class="mb-2">
                                            Usuario :
                                            {{ $gis['info']['cliente'] ?? 'sin datos' }}
                                        </li>
                                        <li class="mb-2">
                                            Direccion: {{ $gis['info']['direccion'] ?? 'sin datos' }}
                                        </li>
                                        <li class="mb-2">
                                            Barrio: {{ $gis['info']['barrio'] ?? 'sin datos' }}
                                        </li>
                                        <li>
                                            Categoria: {{ $gis['info']['categoria'] ?? 'sin datos' }}
                                        </li>
                                    </ul>
                                </div>
                                <div class="text-card text-sm col-6">
                                    <ul>
                                        <li class="mb-2">
                                            Contrato: {{ $gis['info']['contrato'] ?? 'sin datos' }}
                                        </li>
                                        <li class="mb-2">
                                            Medidor : {{ $gis['info']['medidor'] ?? 'sin datos' }}
                                        </li>
                                        <li class="mb-2">
                                            Estado: {{ $gis['info']['estado'] ?? 'sin datos' }}
                                        </li>
                                        <li class="mb-2">
                                            Descripcion: {{ $gis['info']['descripcion'] ?? 'sin datos' }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="text-card">
                                    <ul>
                                        <li>
                                            Estado de Conexion: {{ $gis['info']['estadoCorte'] ?? 'sin datos' }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @else
                            <p>{{ $gis['error'] }}</p>
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
                                                            {{ $data['info']['reporte']['imposibilidad'] == $nombre ? 'selected' : '' }}>
                                                            {{ $nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12  mb-2" id="tipo_regulador_container">
                                                <label for="tipo_presion" class="form-label">Tipo de Presion</label>
                                                <select id="tipo_presion" class="form-select" name="tipo_presion">
                                                    @foreach ($data['info']['presion'] as $id => $nombre)
                                                        <option
                                                            value="{{ $nombre }}"{{ $data['info']['reporte']['tipo_presion'] == $nombre ? 'selected' : '' }}>
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
                                                            value="{{ $nombre }}"{{ $data['info']['reporte']['descripcion'] == $nombre ? 'selected' : '' }}>
                                                            {{ $nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12  mb-2" id="marca_regulador_container">
                                                <label for="marca_regulador" class="form-label">Tipo del Regulador</label>
                                                <select id="marca_regulador" class="form-select" name="marca_regulador">
                                                    @foreach ($data['marca de regulador'] as $id => $nombre)
                                                        <option
                                                            value="{{ $nombre }}"{{ $data['info']['reporte']['marca_regulador'] == $nombre ? 'selected' : '' }}>
                                                            {{ $nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12  mb-2" id="marca_medidor_container">
                                                <label for="marca_medidor" class="form-label">Marca del Medidor</label>
                                                <select id="marca_medidor" class="form-select" name="marca_medidor">
                                                    @foreach ($data['marca de medidor'] as $id => $nombre)
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
                                        <div class="col-3">
                                            <span class="form-check-label">¿Anomalia Confirmada?</span>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="inlineCheckbox1"
                                                    name="confirmado" value="1">
                                                <label class="form-check-label" for="inlineCheckbox1">si</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="inlineCheckbox1"
                                                    name="confirmado" value="0">
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
    <div class="widget-content widget-content-area mt-2 ">
        <div class="row">
            @foreach (range(1, 6) as $i)
                @php
                    // La variable $rutaImagen ya debe contener la ruta completa desde la base de datos
                    $rutaImagen = $data['imagenes']['foto' . $i] ?? null;

                    // Opcional: Si quieres un título descriptivo para el lightbox, puedes extraerlo del nombre del archivo
                    $nombreArchivo = $rutaImagen ? pathinfo($rutaImagen, PATHINFO_FILENAME) : 'Imagen';
                    $tituloGlightbox = $nombreArchivo . ' - Contrato #: ' . ($data['info']['contrato'] ?? 'N/A');

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
                        <a href="{{ asset($rutaImagen) }}" class="withDescriptionGlightbox glightbox-content"
                            data-glightbox="title: {{ $tituloGlightbox }}; description: {{ $descripcionGlightbox }};">
                            <img src="{{ asset($rutaImagen) }}" alt="{{ $nombreArchivo }}" class="img-fluid"
                                style="width:350px; height:250px; object-fit: cover;" />
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
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
