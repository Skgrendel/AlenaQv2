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
                                        <div class="mb-2">
                                            <span class="card-title mb-4 "> Informacion del Predio</span>
                                        </div>
                                        <div class="mb-1">
                                            <span for="nombre_cliente">Nombre:</span>
                                            <span
                                                class=" text-body staticEmail "id="nombre_cliente">{{ $gis['info']['cliente'] }}</span>
                                        </div>
                                        <div class="mb-1">
                                            <span for="numero_contrato" class="form-label">Numero de Contrato:</span>
                                            <span class="text-body staticEmail"
                                                id="numero_contrato">{{ $gis['info']['contrato'] }}</span>
                                        </div>
                                        <div class="mb-1">
                                            <span for="numero_medidor" class="form-label">Numero de Medidor: </span>
                                            <span class=" text-body" id="numero_medidor">
                                                <strong>{{ $gis['info']['medidor'] }}</strong></span>
                                        </div>
                                        <div class="mb-1">
                                            <span for="direccion">Direccion: </span>
                                            <span class=" text-body" id="direccion">{{ $gis['info']['direccion'] }}</span>
                                        </div>
                                        <div class="mb-1">
                                            <span for="ciclo">Ciclo: </span>
                                            <span class="text-body" id="ciclo">{{ $data['info']['ciclo'] }}</span>
                                        </div>
                                        <hr>
                                        @if ($data['info']['observaciones'])
                                            <span class="form-label">Observaciones:</span>
                                            <span class="form-control">{{ $data['info']['observaciones'] }}</span>
                                        @endif
                                        <a class="btn btn-info me-4 rounded  bs-tooltip"
                                                    title="Regresar Pagina Anterior" data-bs-placement="top"
                                                    href="{{ route('reportes.index') }}"><i
                                                        class="fas fa-arrow-circle-left"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="comercio" class="form-label"> Tipo de Comercio Encontrado</label>
                    <select id="comercio" class="form-select" name="tipo_comercio" disabled >
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
                            <label for="nueva_opcion" class="form-label ">Anomalia Detectada</label>
                            <select id="anomalia" class="form-control" name="anomalia[]" multiple disabled >
                                @foreach ($data['anomalias'] as $id => $nombre)
                                    <option
                                        value="{{ $id }}"{{ in_array($id, $data['info']['anomaliasid']) ? 'selected' : '' }}>
                                        {{ $nombre }}</option>
                                @endforeach
                            </select>
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
                        <select id="imposibilidad" class="form-select" name="imposibilidad" disabled>
                            @foreach ($data['imposibilidad'] as $id => $nombre)
                                <option value="{{ $id }}"
                                    {{ $data['info']['imposibilidadid'] == $id ? 'selected' : '' }}>{{ $nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @if (isset($data['info']['observaciones']))
                <div class="col-12">
                    <label for="comentarios" class="form-label">Observaciones</label>
                   <span id="comentarios" cols="30" rows="3" class="form-control">{{ $data['info']['observaciones'] }}</span>
                </div>
                @endif
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
                                                    @if (isset($data['imagenes']['foto' . $i]))
                                                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                                            <a href="/imagen/{{ $data['imagenes']['foto' . $i] }}"
                                                                class="withDescriptionGlightbox glightbox-content"
                                                                data-glightbox="title: Contrato y medidor; description: Contrato #:{{ $data['info']['contrato'] }} - Medidor #:{{ $data['info']['medidor'] }};">
                                                                <img src="/imagen/{{ $data['imagenes']['foto' . $i] }}"
                                                                    alt="image" class="img-fluid"
                                                                    style="width:350px; height:250px; object-fit: cover;" />
                                                            </a>
                                                        </div>
                                                    @endif
                                                @endforeach
                                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4 me-auto">
                                                    @if (isset($data['video']))
                                                        <a href="{{ asset('video/' . $data['video']) }}"
                                                            class="withDescriptionGlightbox glightbox-content">
                                                            <img src="{{ asset('src/image/video.jpeg') }}" alt="image"
                                                                class="img-fluid"
                                                                style="width:350px; height:250px; object-fit: cover;" />
                                                        </a>
                                                    @endif
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
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('script/agentes/AgentesGlobal.js') }}"></script>
@endsection
