@extends('layouts.frontpage.app')

@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-body">
                <form class="row g-3" id="reportes" action="{{ route('reportes.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="text" hidden id="latitud" name="latitud" value="">
                    <input type="text" hidden id="longitud" name="longitud" value="">
                    <div class="col-12 mb-1 " id="ubicacion">
                        <div class="col-12">
                            <div class="col-lg-12 ">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <label class="form-label"> Informacion del Predio</label>
                                            <div class="mb-1">
                                                <label for="nombre_cliente">Nombre:</label>
                                                <span class="text-body staticEmail"
                                                    id="nombre_cliente">{{ $data['info']['db_Surtigas']['cliente'] ?? 'sin datos' }}</span>
                                                <input type="text" name="nombre_cliente" id="nombre_cliente" hidden
                                                    value="{{ $data['info']['db_Surtigas']['cliente'] ?? 'sin datos' }}">
                                            </div>
                                            <div class="mb-1">
                                                <label for="numero_contrato" class="form-label">Numero de
                                                    Contrato:</label>
                                                <span class="text-body staticEmail"
                                                    id="numero_contrato">{{ $data['info']['db_Surtigas']['contrato'] ?? 'sin datos' }}</span>
                                                <input type="text" name="numero_contrato" id="numero_contrato" hidden
                                                    value="{{ $data['info']['db_Surtigas']['contrato'] ?? 'sin datos' }}">
                                            </div>
                                            <div class="mb-1">
                                                <label for="numero_medidor" class="form-label">Numero de Medidor:
                                                </label>
                                                <span class=" text-body"
                                                    id="numero_medidor">{{ $data['info']['db_Surtigas']['medidor'] ?? 'sin datos' }}</span>
                                                <input type="text" name="numero_medidor" id="numero_medidor" hidden
                                                    value="{{ $data['info']['db_Surtigas']['medidor'] ?? 'sin datos' }}">
                                            </div>
                                            <div class="mb-1">
                                                <label for="direccion">Direccion: </label>
                                                <span class=" text-body"
                                                    id="direccion">{{ $data['info']['db_Surtigas']['direccion'] ?? 'sin datos' }}</span>
                                                <input type="text" name="direccion" id="direccion" hidden
                                                    value="{{ $data['info']['db_Surtigas']['direccion'] ?? 'sin datos' }}">
                                                    <input type="text" name="barrio" id="barrio" hidden
                                                    value="{{ $data['info']['db_Surtigas']['barrio'] ?? 'sin datos' }}">
                                            </div>
                                            <div class="mb-1">
                                                <label for="ciclo">Ciclo: </label>
                                                <span class=" text-body"
                                                    id="ciclo">{{ $data['info']['db_Surtigas']['ciclo'] ?? 'sin datos' }}</span>
                                                <input type="text" name="ciclo" id="ciclo" hidden
                                                    value="{{ $data['info']['db_Surtigas']['ciclo'] ?? 'sin datos' }}">
                                            </div>
                                            <div class="mb-1">
                                                <label for="ciclo">Estado del Servicio: </label>
                                                <span class="text-card text-sm">
                                                    {!! $data['info']['db_Surtigas']['estado_servicio'] == 1
                                                        ? '<span class="badge bg-success">Activo</span>'
                                                        : '<span class="badge bg-danger">Inactivo </span>' !!}</span>
                                                <input type="text" id="estado_servicio" name="estado_servicio" hidden
                                                    value="{{ $data['info']['db_Surtigas']['estado_servicio'] ?? 'sin datos' }}">
                                            </div>
                                            <div class="mb-1">
                                                <label for="ciclo">Estado del Servicio en el Gis: </label>
                                                <span class="text-card text-sm"><span class="badge bg-warning">{{ $gis['info']['estado'] ?? 'sin datos' }}</span>
                                            </span>
                                            </div>

                                            <input type="text" id="medidor" name="surtigas_id" hidden
                                                value="{{ $data['info']['db_Surtigas']['id'] }}">
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
                    <div id="info">
                        <input type="text" name="contrato" id="data_gis" hidden
                            value="{{ $data['info']['db_Surtigas']['contrato'] ?? 'sin datos' }}">
                        <div class="col-12 mb-2">
                            <label for="nueva_opcion" class="form-label">Numero de Orden</label>
                            <input type="text" name="numero_orden" id="numero_orden" class="form-control">
                            <label for="comercio" class="form-label mt-3">¿Que Tipo de Comercio Encontro?</label>
                            <select id="slcComercio" class="form-select" name="tipo_comercio" required>
                                @foreach ($data['comercios'] as $id => $nombre)
                                    <option value="{{ $nombre }}">{{ $nombre }}</option>
                                @endforeach
                            </select>
                            <div class="mt-3">
                                <label for="nueva_opcion" class="form-label">Nombre del Comercio Encontrado</label>
                                <input type="text" name="nombre_comercio" id="nombre_comercio" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div id="cont-medidor">
                            <div class="col-lg-12 mb-2" id="medidor_anomalia_container">
                                <div class="mt-1">
                                    <label for="nueva_opcion" class="form-label">Digite el numero de Medidor Que
                                        Encontro</label>
                                    <input type="text" name="medidor_anomalia" id="medidor_anomalia"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-2" id="anomaliaContainer">
                                <div class="mt-1">
                                    <label for="slcanomalia" class="form-label">Seleccione La Anomalia Que
                                        Detecto</label>
                                    <select id="slcanomalia" class="form-select select2" name="anomalia[]"
                                        multiple="multiple" data-placeholder="Seleccione la anomalia" required>
                                        @foreach ($data['anomalias'] as $id => $nombre)
                                            <option value="{{ $nombre }}">{{ $nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12  mb-2" id="lectura_container">
                                <div class="mt-1">
                                    <label for="lectura" class="form-label">Digite el numero de Lectura</label>
                                    <input type="text" name="lectura" id="lectura" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-12 mb-2" id="container_imposibilidad">
                                <label for="imposibilidad" class="form-label">Imposibilidad</label>
                                <select id="imposibilidad" class="form-select" name="imposibilidad" required>
                                    @foreach ($data['imposibilidad'] as $id => $nombre)
                                        <option value="{{ $nombre }}">{{ $nombre }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12  mb-2" id="tipo_regulador_container">
                                <label for="tipo_presion" class="form-label">Tipo de Presion</label>
                                <select id="tipo_presion" class="form-select" name="tipo_presion" required>
                                    @foreach ($data['tipo_presion'] as $id => $nombre)
                                        <option value="{{ $nombre }}">{{ $nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12  mb-2" id="marca_regulador_container">
                                <label for="marca_regulador" class="form-label">Tipo del Regulador</label>
                                <select id="marca_regulador" class="form-select" name="marca_regulador" required>
                                    @foreach ($data['marca_regulador'] as $id => $nombre)
                                        <option value="{{ $nombre }}">{{ $nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12  mb-2" id="marca_medidor_container">
                                <label for="marca_medidor" class="form-label">Marca del Medidor</label>
                                <select id="marca_medidor" class="form-select" name="marca_medidor" required>
                                    @foreach ($data['marca_medidor'] as $id => $nombre)
                                        <option value="{{ $nombre }}">{{ $nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12  mb-2" id="cau_container">
                                <label for="cau" class="form-label">Notificacion de Alertas</label>
                                <select id="cau" class="form-select" name="cau" required>
                                    <option disabled>──────────</option>
                                    <option value="Sin Alertas">Sin Alertas</option>
                                    <option value="Exceso de Capacidad">Exceso de Capacidad</option>
                                    <option value="CAU 01">CAU 01</option>
                                    <option value="CAU 02">CAU 02</option>
                                    <option value="CAU 03">CAU 03</option>
                                    <option value="CAU 04">CAU 04</option>
                                    <option value="Retro Flujo">Retro Flujo</option>
                                    <option value="Bateria Baja">Bateria Baja</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="true" id="fuga_gas"
                                name="fuga_gas">
                            <label class="form-check-label" for="fuga_gas">Hay Fuga de gas</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="true" id="ex_capacidad"
                                name="ex_capacidad">
                            <label class="form-check-label" for="ex_capacidad">Excede Capacidad</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="comentarios" class="form-label">Observaciones</label>
                        <textarea name="comentarios" id="comentarios" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                    <div id="evidencias" class="col-lg-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Fotos Evidencias</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div class="col-md-12">
                                    <div id="foto1-button">
                                        <span class="input-group-text  m-2" for="foto1-input">Foto de la
                                            Fachada</span>
                                        <input type="file" class="form-control" id="foto1-input" name="foto1"
                                            accept="image/jpeg" capture="camera">
                                    </div>
                                    <div id="foto2-button">
                                        <span class="input-group-text m-2" for="foto2-input">Foto del Medidor</span>
                                        <input type="file" class="form-control" id="foto2-input" name="foto2"
                                            accept="image/jpeg" capture="camera">
                                    </div>
                                    <div id="foto3-button">
                                        <span class="input-group-text m-2" for="foto3-input">Foto del Odómetro</span>
                                        <input type="file" class="form-control" id="foto3-input" name="foto3"
                                            accept="image/jpeg" capture="camera">
                                    </div>
                                    <div id="foto4-button">
                                        <span class="input-group-text m-2" for="foto4-input">Foto del Regulador</span>
                                        <input type="file" class="form-control" id="foto4-input" name="foto4"
                                            accept="image/jpeg" capture="camera">
                                    </div>
                                    <div class="d-none" id="foto5-button">
                                        <span class="input-group-text m-2" for="foto5-input">Foto Detector de Fuga</span>
                                        <input type="file" class="form-control" id="foto5-input" name="foto5"
                                            accept="image/jpeg" capture="camera">
                                    </div>
                                    <div class="d-none" id="foto6-button">
                                        <span class="input-group-text m-2" for="foto6-input">Foto Exceso de
                                            Capacidad</span>
                                        <input type="file" class="form-control" id="foto6-input" name="foto6"
                                            accept="image/jpeg" capture="camera">
                                    </div>
                                </div>
                                <hr class="my-2">
                            </div>
                        </div>
                        <div class="alert alert-warning mt-3 d-none" role="alert" id="progressBarObservacion">
                            <span class="text-sm">Guardando Cambios Porfavor Espere.....</span>
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
@endsection
