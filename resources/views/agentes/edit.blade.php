@extends('layouts.frontpage.app')

@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-body">
                <form class="row g-3" id="reportes" action="{{ route('reportes.update', $data['info']['reporte']['id']) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="text" id="medidor" name="medidor" hidden value="{{ $data['info']['reporte']['medidor'] }}">
                    <input type="text" id="contrato" name="contrato" hidden value="{{ $data['info']['reporte']['contrato'] }}">
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
                                                <span class="text-card text-sm"><span class="badge bg-warning">{{ $gis['info']['estado'] ?? 'sin datos'}}</span></span>
                                            </div>
                                            <input type="text" id="medidor" name="surtigas_id" hidden
                                                value="{{ $data['data']['db_Surtigas']['id'] }}">
                                            @if (isset($gis['info']))
                                                <div class="mb-1">
                                                    <label for="ciclo">Descripcion: </label>
                                                    <span class=" text-body"
                                                        id="ciclo">{{$gis['info']['descripcion'] ?? 'sin datos'}} </span>
                                                </div>
                                            @elseif (isset($gis['error']))
                                                <div class="mb-1">
                                                    <label for="numero_contrato" class="form-label">Error:</label>
                                                    <span class="text-body" id="numero_contrato">{{ $gis['error'] ?? 'sin datos' }}</span>
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
                        <label for="comercio" class="form-label"> Tipo de Comercio Encontrado</label>
                        <select id="comercio" class="form-select" name="tipo_comercio">
                            @foreach ($data['comercios'] as $id => $nombre)
                                <option value="{{ $id }}"
                                    {{ $data['info']['comercio']['id'] == $id ? 'selected' : '' }}>{{ $nombre }}
                                </option>
                            @endforeach
                        </select>
                        @if ($data['info']['comercio']['tipo_comercio'] == '20')
                            <div id="div-comercio-nuevo" class="">
                                <label for="nueva_opcion" class="form-label"> Tipo Comercio Encontrado</label>
                                <input type="text" name="nuevo_comercio" id="nueva_opcion" class="form-control"
                                    value="{{ $data['info']['comercio']['vs_comercio']['nombre'] }}"
                                    {{ $data['info']['comercio']['tipo_comercio'] != '20' ? 'disabled' : '' }}>
                            </div>
                        @endif
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
                                    @foreach ($data['anomalias'] as $id => $nombre)
                                        <option value="{{ $id }}"{{ in_array($id, $data['info']['anomaliasid']) ? 'selected' : '' }}>{{ $nombre }}</option>
                                    @endforeach
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
                        <div class="col-12" id="container_imposibilidad">
                            <label for="imposibilidad" class="form-label">Imposibilidad Detectada</label>
                            <select id="imposibilidad" class="form-select" name="imposibilidad">
                                @foreach ($data['imposibilidad'] as $id => $nombre)
                                    <option value="{{ $id }}"
                                        {{ $data['info']['reporte']['imposibilidad'] == $id ? 'selected' : '' }}>
                                        {{ $nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
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
                                            <div class="col-md-12 mt-3">
                                                <a class="btn btn-info btn-lg mb-4 me-4" id="foto1-button"
                                                    style="font-size:16px;width: 250px; height: 50px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="-0.855 -0.855 24 24" id="Landscape-1--Streamline-Flex"
                                                        height="24" width="24">
                                                        <desc>Landscape 1 Streamline Icon: https://streamlinehq.com</desc>
                                                        <g
                                                            id="landscape-1--photos-photo-landscape-picture-photography-camera-pictures-image">
                                                            <path id="Intersect" fill="#d7e0ff"
                                                                d="M1.528245387857143 16.34891892857143C1.773647142857143 18.64271914285714 3.6184630714285713 20.48753507142857 5.9110851 20.743074 7.613961492857142 20.932857428571428 9.362389092857143 21.095892857142857 11.145 21.095892857142857s3.5310385071428567 -0.16303542857142858 5.233851214285714 -0.3528188571428571c2.292685714285714 -0.25553892857142857 4.137501642857143 -2.100354857142857 4.3828508571428575 -4.394155071428571 0.18118585714285712 -1.6932120857142856 0.33419078571428573 -3.4316251071428567 0.33419078571428573 -5.2039189285714285 0 -1.7723097428571426 -0.15300492857142858 -3.510706842857143 -0.33419078571428573 -5.203966692857143 -0.24534921428571427 -2.293720607142857 -2.090165142857143 -4.138552457142857 -4.3828508571428575 -4.3940929778571425C14.676038507142858 1.3571298342857143 12.927610907142858 1.1941071428571428 11.145 1.1941071428571428S7.613961492857142 1.3571298342857143 5.9110851 1.5469403292857142C3.6184630714285713 1.8024808499999998 1.773647142857143 3.6473127 1.528245387857143 5.941033307142857 1.347085005 7.6342931571428565 1.1941071428571428 9.372690257142857 1.1941071428571428 11.145c0 1.7722938214285715 0.15297945428571427 3.510706842857143 0.334138245 5.2039189285714285Z"
                                                                stroke-width="1.71"></path>
                                                            <path id="Intersect_2" fill="#ffffff"
                                                                d="M1.1941071428571428 16.856971714285713v-0.22051178571428573c1.4466687642857143 -1.8618996214285712 2.5340864142857145 -2.9208816 4.343445321428572 -4.180011857142857 0.93495405 -0.6506451 2.1715395642857143 -0.7070547214285714 3.113148771428571 -0.06608984999999999 3.1203293357142856 2.124077785714286 5.740439228571429 5.387827349999999 7.413701764285714 8.537881992857143v0.3068059285714286c-1.6841687142857142 0.15029828571428572 -3.4129970357142856 0.2784657857142857 -5.1753399642857145 0.2784657857142857 -3.1755607714285716 0 -9.230097942857142 -0.75786 -9.694955892857143 -4.656540214285714Z"
                                                                stroke-width="1.71"></path>
                                                            <path id="Intersect_3" stroke="#4147d5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                d="M1.4988528385714284 16.249887642857143C2.7998469 14.622446978571428 3.857571085714286 13.625749628571429 5.538014185714286 12.456368464285713c0.93495405 -0.6506291785714285 2.171141528571429 -0.7067681357142858 3.1127507357142856 -0.06578734285714286 3.067820464285714 2.088318257142857 5.652123064285714 5.278224235714286 7.328458435714286 8.378763235714286"
                                                                stroke-width="1.71"></path>
                                                            <path id="Intersect_4" stroke="#4147d5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                d="M1.528245387857143 16.34891892857143C1.773647142857143 18.64271914285714 3.6184630714285713 20.48753507142857 5.9110851 20.743074 7.613961492857142 20.932857428571428 9.362389092857143 21.095892857142857 11.145 21.095892857142857s3.5310385071428567 -0.16303542857142858 5.233851214285714 -0.3528188571428571c2.292685714285714 -0.25553892857142857 4.137501642857143 -2.100354857142857 4.3828508571428575 -4.394155071428571 0.18118585714285712 -1.6932120857142856 0.33419078571428573 -3.4316251071428567 0.33419078571428573 -5.2039189285714285 0 -1.7723097428571426 -0.15300492857142858 -3.510706842857143 -0.33419078571428573 -5.203966692857143 -0.24534921428571427 -2.293720607142857 -2.090165142857143 -4.138552457142857 -4.3828508571428575 -4.3940929778571425C14.676038507142858 1.3571298342857143 12.927610907142858 1.1941071428571428 11.145 1.1941071428571428S7.613961492857142 1.3571298342857143 5.9110851 1.5469403292857142C3.6184630714285713 1.8024808499999998 1.773647142857143 3.6473127 1.528245387857143 5.941033307142857 1.347085005 7.6342931571428565 1.1941071428571428 9.372690257142857 1.1941071428571428 11.145c0 1.7722938214285715 0.15297945428571427 3.510706842857143 0.334138245 5.2039189285714285Z"
                                                                stroke-width="1.71"></path>
                                                            <path id="Vector" fill="#ffffff"
                                                                d="M14.329190185714285 10.746773228571428c1.7831363142857144 0 2.786186314285714 -1.0030181571428571 2.786186314285714 -2.7861544714285715S16.112326499999998 5.1744642857142855 14.329190185714285 5.1744642857142855C12.54605387142857 5.1744642857142855 11.543035714285715 6.177482442857143 11.543035714285715 7.960618757142856s1.0030181571428571 2.7861544714285715 2.7861544714285715 2.7861544714285715Z"
                                                                stroke-width="1.71"></path>
                                                            <path id="Vector_2" stroke="#4147d5" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M14.329190185714285 10.746773228571428c1.7831363142857144 0 2.786186314285714 -1.0030181571428571 2.786186314285714 -2.7861544714285715S16.112326499999998 5.1744642857142855 14.329190185714285 5.1744642857142855C12.54605387142857 5.1744642857142855 11.543035714285715 6.177482442857143 11.543035714285715 7.960618757142856s1.0030181571428571 2.7861544714285715 2.7861544714285715 2.7861544714285715Z"
                                                                stroke-width="1.71"></path>
                                                        </g>
                                                    </svg>
                                                    <span class="btn-text-inner">Foto Inmueble</span>
                                                    <input type="file" class="form-control d-none" id="foto1-input"
                                                        name="foto1" accept="image/jpeg" capture="camera">
                                                </a>
                                                <a class="btn btn-info btn-lg mb-4 me-4" id="foto2-button"
                                                    style="font-size:16px;width: 250px; height: 50px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="-0.855 -0.855 24 24" id="Landscape-1--Streamline-Flex"
                                                        height="24" width="24">
                                                        <desc>Landscape 1 Streamline Icon: https://streamlinehq.com</desc>
                                                        <g
                                                            id="landscape-1--photos-photo-landscape-picture-photography-camera-pictures-image">
                                                            <path id="Intersect" fill="#d7e0ff"
                                                                d="M1.528245387857143 16.34891892857143C1.773647142857143 18.64271914285714 3.6184630714285713 20.48753507142857 5.9110851 20.743074 7.613961492857142 20.932857428571428 9.362389092857143 21.095892857142857 11.145 21.095892857142857s3.5310385071428567 -0.16303542857142858 5.233851214285714 -0.3528188571428571c2.292685714285714 -0.25553892857142857 4.137501642857143 -2.100354857142857 4.3828508571428575 -4.394155071428571 0.18118585714285712 -1.6932120857142856 0.33419078571428573 -3.4316251071428567 0.33419078571428573 -5.2039189285714285 0 -1.7723097428571426 -0.15300492857142858 -3.510706842857143 -0.33419078571428573 -5.203966692857143 -0.24534921428571427 -2.293720607142857 -2.090165142857143 -4.138552457142857 -4.3828508571428575 -4.3940929778571425C14.676038507142858 1.3571298342857143 12.927610907142858 1.1941071428571428 11.145 1.1941071428571428S7.613961492857142 1.3571298342857143 5.9110851 1.5469403292857142C3.6184630714285713 1.8024808499999998 1.773647142857143 3.6473127 1.528245387857143 5.941033307142857 1.347085005 7.6342931571428565 1.1941071428571428 9.372690257142857 1.1941071428571428 11.145c0 1.7722938214285715 0.15297945428571427 3.510706842857143 0.334138245 5.2039189285714285Z"
                                                                stroke-width="1.71"></path>
                                                            <path id="Intersect_2" fill="#ffffff"
                                                                d="M1.1941071428571428 16.856971714285713v-0.22051178571428573c1.4466687642857143 -1.8618996214285712 2.5340864142857145 -2.9208816 4.343445321428572 -4.180011857142857 0.93495405 -0.6506451 2.1715395642857143 -0.7070547214285714 3.113148771428571 -0.06608984999999999 3.1203293357142856 2.124077785714286 5.740439228571429 5.387827349999999 7.413701764285714 8.537881992857143v0.3068059285714286c-1.6841687142857142 0.15029828571428572 -3.4129970357142856 0.2784657857142857 -5.1753399642857145 0.2784657857142857 -3.1755607714285716 0 -9.230097942857142 -0.75786 -9.694955892857143 -4.656540214285714Z"
                                                                stroke-width="1.71"></path>
                                                            <path id="Intersect_3" stroke="#4147d5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                d="M1.4988528385714284 16.249887642857143C2.7998469 14.622446978571428 3.857571085714286 13.625749628571429 5.538014185714286 12.456368464285713c0.93495405 -0.6506291785714285 2.171141528571429 -0.7067681357142858 3.1127507357142856 -0.06578734285714286 3.067820464285714 2.088318257142857 5.652123064285714 5.278224235714286 7.328458435714286 8.378763235714286"
                                                                stroke-width="1.71"></path>
                                                            <path id="Intersect_4" stroke="#4147d5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                d="M1.528245387857143 16.34891892857143C1.773647142857143 18.64271914285714 3.6184630714285713 20.48753507142857 5.9110851 20.743074 7.613961492857142 20.932857428571428 9.362389092857143 21.095892857142857 11.145 21.095892857142857s3.5310385071428567 -0.16303542857142858 5.233851214285714 -0.3528188571428571c2.292685714285714 -0.25553892857142857 4.137501642857143 -2.100354857142857 4.3828508571428575 -4.394155071428571 0.18118585714285712 -1.6932120857142856 0.33419078571428573 -3.4316251071428567 0.33419078571428573 -5.2039189285714285 0 -1.7723097428571426 -0.15300492857142858 -3.510706842857143 -0.33419078571428573 -5.203966692857143 -0.24534921428571427 -2.293720607142857 -2.090165142857143 -4.138552457142857 -4.3828508571428575 -4.3940929778571425C14.676038507142858 1.3571298342857143 12.927610907142858 1.1941071428571428 11.145 1.1941071428571428S7.613961492857142 1.3571298342857143 5.9110851 1.5469403292857142C3.6184630714285713 1.8024808499999998 1.773647142857143 3.6473127 1.528245387857143 5.941033307142857 1.347085005 7.6342931571428565 1.1941071428571428 9.372690257142857 1.1941071428571428 11.145c0 1.7722938214285715 0.15297945428571427 3.510706842857143 0.334138245 5.2039189285714285Z"
                                                                stroke-width="1.71"></path>
                                                            <path id="Vector" fill="#ffffff"
                                                                d="M14.329190185714285 10.746773228571428c1.7831363142857144 0 2.786186314285714 -1.0030181571428571 2.786186314285714 -2.7861544714285715S16.112326499999998 5.1744642857142855 14.329190185714285 5.1744642857142855C12.54605387142857 5.1744642857142855 11.543035714285715 6.177482442857143 11.543035714285715 7.960618757142856s1.0030181571428571 2.7861544714285715 2.7861544714285715 2.7861544714285715Z"
                                                                stroke-width="1.71"></path>
                                                            <path id="Vector_2" stroke="#4147d5" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M14.329190185714285 10.746773228571428c1.7831363142857144 0 2.786186314285714 -1.0030181571428571 2.786186314285714 -2.7861544714285715S16.112326499999998 5.1744642857142855 14.329190185714285 5.1744642857142855C12.54605387142857 5.1744642857142855 11.543035714285715 6.177482442857143 11.543035714285715 7.960618757142856s1.0030181571428571 2.7861544714285715 2.7861544714285715 2.7861544714285715Z"
                                                                stroke-width="1.71"></path>
                                                        </g>
                                                    </svg>
                                                    <span class="btn-text-inner">Sellos del Medidor</span>
                                                    <input type="file" class="form-control d-none" id="foto2-input"
                                                        name="foto2" accept="image/jpeg" capture="camera">
                                                </a>
                                                <a class="btn btn-info btn-lg mb-4 me-4" id="foto3-button"
                                                    style="font-size:12px;width: 250px; height: 50px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="-0.855 -0.855 24 24" id="Landscape-1--Streamline-Flex"
                                                        height="24" width="24">
                                                        <desc>Landscape 1 Streamline Icon: https://streamlinehq.com</desc>
                                                        <g
                                                            id="landscape-1--photos-photo-landscape-picture-photography-camera-pictures-image">
                                                            <path id="Intersect" fill="#d7e0ff"
                                                                d="M1.528245387857143 16.34891892857143C1.773647142857143 18.64271914285714 3.6184630714285713 20.48753507142857 5.9110851 20.743074 7.613961492857142 20.932857428571428 9.362389092857143 21.095892857142857 11.145 21.095892857142857s3.5310385071428567 -0.16303542857142858 5.233851214285714 -0.3528188571428571c2.292685714285714 -0.25553892857142857 4.137501642857143 -2.100354857142857 4.3828508571428575 -4.394155071428571 0.18118585714285712 -1.6932120857142856 0.33419078571428573 -3.4316251071428567 0.33419078571428573 -5.2039189285714285 0 -1.7723097428571426 -0.15300492857142858 -3.510706842857143 -0.33419078571428573 -5.203966692857143 -0.24534921428571427 -2.293720607142857 -2.090165142857143 -4.138552457142857 -4.3828508571428575 -4.3940929778571425C14.676038507142858 1.3571298342857143 12.927610907142858 1.1941071428571428 11.145 1.1941071428571428S7.613961492857142 1.3571298342857143 5.9110851 1.5469403292857142C3.6184630714285713 1.8024808499999998 1.773647142857143 3.6473127 1.528245387857143 5.941033307142857 1.347085005 7.6342931571428565 1.1941071428571428 9.372690257142857 1.1941071428571428 11.145c0 1.7722938214285715 0.15297945428571427 3.510706842857143 0.334138245 5.2039189285714285Z"
                                                                stroke-width="1.71"></path>
                                                            <path id="Intersect_2" fill="#ffffff"
                                                                d="M1.1941071428571428 16.856971714285713v-0.22051178571428573c1.4466687642857143 -1.8618996214285712 2.5340864142857145 -2.9208816 4.343445321428572 -4.180011857142857 0.93495405 -0.6506451 2.1715395642857143 -0.7070547214285714 3.113148771428571 -0.06608984999999999 3.1203293357142856 2.124077785714286 5.740439228571429 5.387827349999999 7.413701764285714 8.537881992857143v0.3068059285714286c-1.6841687142857142 0.15029828571428572 -3.4129970357142856 0.2784657857142857 -5.1753399642857145 0.2784657857142857 -3.1755607714285716 0 -9.230097942857142 -0.75786 -9.694955892857143 -4.656540214285714Z"
                                                                stroke-width="1.71"></path>
                                                            <path id="Intersect_3" stroke="#4147d5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                d="M1.4988528385714284 16.249887642857143C2.7998469 14.622446978571428 3.857571085714286 13.625749628571429 5.538014185714286 12.456368464285713c0.93495405 -0.6506291785714285 2.171141528571429 -0.7067681357142858 3.1127507357142856 -0.06578734285714286 3.067820464285714 2.088318257142857 5.652123064285714 5.278224235714286 7.328458435714286 8.378763235714286"
                                                                stroke-width="1.71"></path>
                                                            <path id="Intersect_4" stroke="#4147d5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                d="M1.528245387857143 16.34891892857143C1.773647142857143 18.64271914285714 3.6184630714285713 20.48753507142857 5.9110851 20.743074 7.613961492857142 20.932857428571428 9.362389092857143 21.095892857142857 11.145 21.095892857142857s3.5310385071428567 -0.16303542857142858 5.233851214285714 -0.3528188571428571c2.292685714285714 -0.25553892857142857 4.137501642857143 -2.100354857142857 4.3828508571428575 -4.394155071428571 0.18118585714285712 -1.6932120857142856 0.33419078571428573 -3.4316251071428567 0.33419078571428573 -5.2039189285714285 0 -1.7723097428571426 -0.15300492857142858 -3.510706842857143 -0.33419078571428573 -5.203966692857143 -0.24534921428571427 -2.293720607142857 -2.090165142857143 -4.138552457142857 -4.3828508571428575 -4.3940929778571425C14.676038507142858 1.3571298342857143 12.927610907142858 1.1941071428571428 11.145 1.1941071428571428S7.613961492857142 1.3571298342857143 5.9110851 1.5469403292857142C3.6184630714285713 1.8024808499999998 1.773647142857143 3.6473127 1.528245387857143 5.941033307142857 1.347085005 7.6342931571428565 1.1941071428571428 9.372690257142857 1.1941071428571428 11.145c0 1.7722938214285715 0.15297945428571427 3.510706842857143 0.334138245 5.2039189285714285Z"
                                                                stroke-width="1.71"></path>
                                                            <path id="Vector" fill="#ffffff"
                                                                d="M14.329190185714285 10.746773228571428c1.7831363142857144 0 2.786186314285714 -1.0030181571428571 2.786186314285714 -2.7861544714285715S16.112326499999998 5.1744642857142855 14.329190185714285 5.1744642857142855C12.54605387142857 5.1744642857142855 11.543035714285715 6.177482442857143 11.543035714285715 7.960618757142856s1.0030181571428571 2.7861544714285715 2.7861544714285715 2.7861544714285715Z"
                                                                stroke-width="1.71"></path>
                                                            <path id="Vector_2" stroke="#4147d5" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M14.329190185714285 10.746773228571428c1.7831363142857144 0 2.786186314285714 -1.0030181571428571 2.786186314285714 -2.7861544714285715S16.112326499999998 5.1744642857142855 14.329190185714285 5.1744642857142855C12.54605387142857 5.1744642857142855 11.543035714285715 6.177482442857143 11.543035714285715 7.960618757142856s1.0030181571428571 2.7861544714285715 2.7861544714285715 2.7861544714285715Z"
                                                                stroke-width="1.71"></path>
                                                        </g>
                                                    </svg>
                                                    <span class="btn-text-inner">N. Lectura y N. Medidor</span>
                                                    <input type="file" class="form-control d-none" id="foto3-input"
                                                        name="foto3" accept="image/jpeg" capture="camera">
                                                </a>
                                                <a class="btn btn-info btn-lg mb-4 me-4" id="foto4-button"
                                                    style="font-size:16px;width: 250px; height: 50px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="-0.855 -0.855 24 24" id="Landscape-1--Streamline-Flex"
                                                        height="24" width="24">
                                                        <desc>Landscape 1 Streamline Icon: https://streamlinehq.com</desc>
                                                        <g
                                                            id="landscape-1--photos-photo-landscape-picture-photography-camera-pictures-image">
                                                            <path id="Intersect" fill="#d7e0ff"
                                                                d="M1.528245387857143 16.34891892857143C1.773647142857143 18.64271914285714 3.6184630714285713 20.48753507142857 5.9110851 20.743074 7.613961492857142 20.932857428571428 9.362389092857143 21.095892857142857 11.145 21.095892857142857s3.5310385071428567 -0.16303542857142858 5.233851214285714 -0.3528188571428571c2.292685714285714 -0.25553892857142857 4.137501642857143 -2.100354857142857 4.3828508571428575 -4.394155071428571 0.18118585714285712 -1.6932120857142856 0.33419078571428573 -3.4316251071428567 0.33419078571428573 -5.2039189285714285 0 -1.7723097428571426 -0.15300492857142858 -3.510706842857143 -0.33419078571428573 -5.203966692857143 -0.24534921428571427 -2.293720607142857 -2.090165142857143 -4.138552457142857 -4.3828508571428575 -4.3940929778571425C14.676038507142858 1.3571298342857143 12.927610907142858 1.1941071428571428 11.145 1.1941071428571428S7.613961492857142 1.3571298342857143 5.9110851 1.5469403292857142C3.6184630714285713 1.8024808499999998 1.773647142857143 3.6473127 1.528245387857143 5.941033307142857 1.347085005 7.6342931571428565 1.1941071428571428 9.372690257142857 1.1941071428571428 11.145c0 1.7722938214285715 0.15297945428571427 3.510706842857143 0.334138245 5.2039189285714285Z"
                                                                stroke-width="1.71"></path>
                                                            <path id="Intersect_2" fill="#ffffff"
                                                                d="M1.1941071428571428 16.856971714285713v-0.22051178571428573c1.4466687642857143 -1.8618996214285712 2.5340864142857145 -2.9208816 4.343445321428572 -4.180011857142857 0.93495405 -0.6506451 2.1715395642857143 -0.7070547214285714 3.113148771428571 -0.06608984999999999 3.1203293357142856 2.124077785714286 5.740439228571429 5.387827349999999 7.413701764285714 8.537881992857143v0.3068059285714286c-1.6841687142857142 0.15029828571428572 -3.4129970357142856 0.2784657857142857 -5.1753399642857145 0.2784657857142857 -3.1755607714285716 0 -9.230097942857142 -0.75786 -9.694955892857143 -4.656540214285714Z"
                                                                stroke-width="1.71"></path>
                                                            <path id="Intersect_3" stroke="#4147d5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                d="M1.4988528385714284 16.249887642857143C2.7998469 14.622446978571428 3.857571085714286 13.625749628571429 5.538014185714286 12.456368464285713c0.93495405 -0.6506291785714285 2.171141528571429 -0.7067681357142858 3.1127507357142856 -0.06578734285714286 3.067820464285714 2.088318257142857 5.652123064285714 5.278224235714286 7.328458435714286 8.378763235714286"
                                                                stroke-width="1.71"></path>
                                                            <path id="Intersect_4" stroke="#4147d5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                d="M1.528245387857143 16.34891892857143C1.773647142857143 18.64271914285714 3.6184630714285713 20.48753507142857 5.9110851 20.743074 7.613961492857142 20.932857428571428 9.362389092857143 21.095892857142857 11.145 21.095892857142857s3.5310385071428567 -0.16303542857142858 5.233851214285714 -0.3528188571428571c2.292685714285714 -0.25553892857142857 4.137501642857143 -2.100354857142857 4.3828508571428575 -4.394155071428571 0.18118585714285712 -1.6932120857142856 0.33419078571428573 -3.4316251071428567 0.33419078571428573 -5.2039189285714285 0 -1.7723097428571426 -0.15300492857142858 -3.510706842857143 -0.33419078571428573 -5.203966692857143 -0.24534921428571427 -2.293720607142857 -2.090165142857143 -4.138552457142857 -4.3828508571428575 -4.3940929778571425C14.676038507142858 1.3571298342857143 12.927610907142858 1.1941071428571428 11.145 1.1941071428571428S7.613961492857142 1.3571298342857143 5.9110851 1.5469403292857142C3.6184630714285713 1.8024808499999998 1.773647142857143 3.6473127 1.528245387857143 5.941033307142857 1.347085005 7.6342931571428565 1.1941071428571428 9.372690257142857 1.1941071428571428 11.145c0 1.7722938214285715 0.15297945428571427 3.510706842857143 0.334138245 5.2039189285714285Z"
                                                                stroke-width="1.71"></path>
                                                            <path id="Vector" fill="#ffffff"
                                                                d="M14.329190185714285 10.746773228571428c1.7831363142857144 0 2.786186314285714 -1.0030181571428571 2.786186314285714 -2.7861544714285715S16.112326499999998 5.1744642857142855 14.329190185714285 5.1744642857142855C12.54605387142857 5.1744642857142855 11.543035714285715 6.177482442857143 11.543035714285715 7.960618757142856s1.0030181571428571 2.7861544714285715 2.7861544714285715 2.7861544714285715Z"
                                                                stroke-width="1.71"></path>
                                                            <path id="Vector_2" stroke="#4147d5" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M14.329190185714285 10.746773228571428c1.7831363142857144 0 2.786186314285714 -1.0030181571428571 2.786186314285714 -2.7861544714285715S16.112326499999998 5.1744642857142855 14.329190185714285 5.1744642857142855C12.54605387142857 5.1744642857142855 11.543035714285715 6.177482442857143 11.543035714285715 7.960618757142856s1.0030181571428571 2.7861544714285715 2.7861544714285715 2.7861544714285715Z"
                                                                stroke-width="1.71"></path>
                                                        </g>
                                                    </svg>
                                                    <span class="btn-text-inner">Estado del Medidor</span>
                                                    <input type="file" class="form-control d-none" id="foto4-input"
                                                        name="foto4" accept="image/jpeg" capture="camera">
                                                </a>
                                                <a class="btn btn-info btn-lg mb-4 me-4" id="foto5-button"
                                                    style="font-size:16px;width: 250px; height: 50px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="-0.855 -0.855 24 24" id="Landscape-1--Streamline-Flex"
                                                        height="24" width="24">
                                                        <desc>Landscape 1 Streamline Icon: https://streamlinehq.com</desc>
                                                        <g
                                                            id="landscape-1--photos-photo-landscape-picture-photography-camera-pictures-image">
                                                            <path id="Intersect" fill="#d7e0ff"
                                                                d="M1.528245387857143 16.34891892857143C1.773647142857143 18.64271914285714 3.6184630714285713 20.48753507142857 5.9110851 20.743074 7.613961492857142 20.932857428571428 9.362389092857143 21.095892857142857 11.145 21.095892857142857s3.5310385071428567 -0.16303542857142858 5.233851214285714 -0.3528188571428571c2.292685714285714 -0.25553892857142857 4.137501642857143 -2.100354857142857 4.3828508571428575 -4.394155071428571 0.18118585714285712 -1.6932120857142856 0.33419078571428573 -3.4316251071428567 0.33419078571428573 -5.2039189285714285 0 -1.7723097428571426 -0.15300492857142858 -3.510706842857143 -0.33419078571428573 -5.203966692857143 -0.24534921428571427 -2.293720607142857 -2.090165142857143 -4.138552457142857 -4.3828508571428575 -4.3940929778571425C14.676038507142858 1.3571298342857143 12.927610907142858 1.1941071428571428 11.145 1.1941071428571428S7.613961492857142 1.3571298342857143 5.9110851 1.5469403292857142C3.6184630714285713 1.8024808499999998 1.773647142857143 3.6473127 1.528245387857143 5.941033307142857 1.347085005 7.6342931571428565 1.1941071428571428 9.372690257142857 1.1941071428571428 11.145c0 1.7722938214285715 0.15297945428571427 3.510706842857143 0.334138245 5.2039189285714285Z"
                                                                stroke-width="1.71"></path>
                                                            <path id="Intersect_2" fill="#ffffff"
                                                                d="M1.1941071428571428 16.856971714285713v-0.22051178571428573c1.4466687642857143 -1.8618996214285712 2.5340864142857145 -2.9208816 4.343445321428572 -4.180011857142857 0.93495405 -0.6506451 2.1715395642857143 -0.7070547214285714 3.113148771428571 -0.06608984999999999 3.1203293357142856 2.124077785714286 5.740439228571429 5.387827349999999 7.413701764285714 8.537881992857143v0.3068059285714286c-1.6841687142857142 0.15029828571428572 -3.4129970357142856 0.2784657857142857 -5.1753399642857145 0.2784657857142857 -3.1755607714285716 0 -9.230097942857142 -0.75786 -9.694955892857143 -4.656540214285714Z"
                                                                stroke-width="1.71"></path>
                                                            <path id="Intersect_3" stroke="#4147d5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                d="M1.4988528385714284 16.249887642857143C2.7998469 14.622446978571428 3.857571085714286 13.625749628571429 5.538014185714286 12.456368464285713c0.93495405 -0.6506291785714285 2.171141528571429 -0.7067681357142858 3.1127507357142856 -0.06578734285714286 3.067820464285714 2.088318257142857 5.652123064285714 5.278224235714286 7.328458435714286 8.378763235714286"
                                                                stroke-width="1.71"></path>
                                                            <path id="Intersect_4" stroke="#4147d5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                d="M1.528245387857143 16.34891892857143C1.773647142857143 18.64271914285714 3.6184630714285713 20.48753507142857 5.9110851 20.743074 7.613961492857142 20.932857428571428 9.362389092857143 21.095892857142857 11.145 21.095892857142857s3.5310385071428567 -0.16303542857142858 5.233851214285714 -0.3528188571428571c2.292685714285714 -0.25553892857142857 4.137501642857143 -2.100354857142857 4.3828508571428575 -4.394155071428571 0.18118585714285712 -1.6932120857142856 0.33419078571428573 -3.4316251071428567 0.33419078571428573 -5.2039189285714285 0 -1.7723097428571426 -0.15300492857142858 -3.510706842857143 -0.33419078571428573 -5.203966692857143 -0.24534921428571427 -2.293720607142857 -2.090165142857143 -4.138552457142857 -4.3828508571428575 -4.3940929778571425C14.676038507142858 1.3571298342857143 12.927610907142858 1.1941071428571428 11.145 1.1941071428571428S7.613961492857142 1.3571298342857143 5.9110851 1.5469403292857142C3.6184630714285713 1.8024808499999998 1.773647142857143 3.6473127 1.528245387857143 5.941033307142857 1.347085005 7.6342931571428565 1.1941071428571428 9.372690257142857 1.1941071428571428 11.145c0 1.7722938214285715 0.15297945428571427 3.510706842857143 0.334138245 5.2039189285714285Z"
                                                                stroke-width="1.71"></path>
                                                            <path id="Vector" fill="#ffffff"
                                                                d="M14.329190185714285 10.746773228571428c1.7831363142857144 0 2.786186314285714 -1.0030181571428571 2.786186314285714 -2.7861544714285715S16.112326499999998 5.1744642857142855 14.329190185714285 5.1744642857142855C12.54605387142857 5.1744642857142855 11.543035714285715 6.177482442857143 11.543035714285715 7.960618757142856s1.0030181571428571 2.7861544714285715 2.7861544714285715 2.7861544714285715Z"
                                                                stroke-width="1.71"></path>
                                                            <path id="Vector_2" stroke="#4147d5" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M14.329190185714285 10.746773228571428c1.7831363142857144 0 2.786186314285714 -1.0030181571428571 2.786186314285714 -2.7861544714285715S16.112326499999998 5.1744642857142855 14.329190185714285 5.1744642857142855C12.54605387142857 5.1744642857142855 11.543035714285715 6.177482442857143 11.543035714285715 7.960618757142856s1.0030181571428571 2.7861544714285715 2.7861544714285715 2.7861544714285715Z"
                                                                stroke-width="1.71"></path>
                                                        </g>
                                                    </svg>
                                                    <span class="btn-text-inner">Opcional</span>
                                                    <input type="file" class="form-control d-none" id="foto5-input"
                                                        name="foto5" accept="image/jpeg" capture="camera">
                                                </a>
                                                <a class="btn btn-info btn-lg mb-4 me-4" id="video-button"
                                                    style="font-size:16px;width: 250px; height: 50px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="-0.855 -0.855 24 24" id="Landscape-1--Streamline-Flex"
                                                        height="24" width="24">
                                                        <desc>Landscape 1 Streamline Icon: https://streamlinehq.com</desc>
                                                        <g
                                                            id="landscape-1--photos-photo-landscape-picture-photography-camera-pictures-image">
                                                            <path id="Intersect" fill="#d7e0ff"
                                                                d="M1.528245387857143 16.34891892857143C1.773647142857143 18.64271914285714 3.6184630714285713 20.48753507142857 5.9110851 20.743074 7.613961492857142 20.932857428571428 9.362389092857143 21.095892857142857 11.145 21.095892857142857s3.5310385071428567 -0.16303542857142858 5.233851214285714 -0.3528188571428571c2.292685714285714 -0.25553892857142857 4.137501642857143 -2.100354857142857 4.3828508571428575 -4.394155071428571 0.18118585714285712 -1.6932120857142856 0.33419078571428573 -3.4316251071428567 0.33419078571428573 -5.2039189285714285 0 -1.7723097428571426 -0.15300492857142858 -3.510706842857143 -0.33419078571428573 -5.203966692857143 -0.24534921428571427 -2.293720607142857 -2.090165142857143 -4.138552457142857 -4.3828508571428575 -4.3940929778571425C14.676038507142858 1.3571298342857143 12.927610907142858 1.1941071428571428 11.145 1.1941071428571428S7.613961492857142 1.3571298342857143 5.9110851 1.5469403292857142C3.6184630714285713 1.8024808499999998 1.773647142857143 3.6473127 1.528245387857143 5.941033307142857 1.347085005 7.6342931571428565 1.1941071428571428 9.372690257142857 1.1941071428571428 11.145c0 1.7722938214285715 0.15297945428571427 3.510706842857143 0.334138245 5.2039189285714285Z"
                                                                stroke-width="1.71"></path>
                                                            <path id="Intersect_2" fill="#ffffff"
                                                                d="M1.1941071428571428 16.856971714285713v-0.22051178571428573c1.4466687642857143 -1.8618996214285712 2.5340864142857145 -2.9208816 4.343445321428572 -4.180011857142857 0.93495405 -0.6506451 2.1715395642857143 -0.7070547214285714 3.113148771428571 -0.06608984999999999 3.1203293357142856 2.124077785714286 5.740439228571429 5.387827349999999 7.413701764285714 8.537881992857143v0.3068059285714286c-1.6841687142857142 0.15029828571428572 -3.4129970357142856 0.2784657857142857 -5.1753399642857145 0.2784657857142857 -3.1755607714285716 0 -9.230097942857142 -0.75786 -9.694955892857143 -4.656540214285714Z"
                                                                stroke-width="1.71"></path>
                                                            <path id="Intersect_3" stroke="#4147d5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                d="M1.4988528385714284 16.249887642857143C2.7998469 14.622446978571428 3.857571085714286 13.625749628571429 5.538014185714286 12.456368464285713c0.93495405 -0.6506291785714285 2.171141528571429 -0.7067681357142858 3.1127507357142856 -0.06578734285714286 3.067820464285714 2.088318257142857 5.652123064285714 5.278224235714286 7.328458435714286 8.378763235714286"
                                                                stroke-width="1.71"></path>
                                                            <path id="Intersect_4" stroke="#4147d5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                d="M1.528245387857143 16.34891892857143C1.773647142857143 18.64271914285714 3.6184630714285713 20.48753507142857 5.9110851 20.743074 7.613961492857142 20.932857428571428 9.362389092857143 21.095892857142857 11.145 21.095892857142857s3.5310385071428567 -0.16303542857142858 5.233851214285714 -0.3528188571428571c2.292685714285714 -0.25553892857142857 4.137501642857143 -2.100354857142857 4.3828508571428575 -4.394155071428571 0.18118585714285712 -1.6932120857142856 0.33419078571428573 -3.4316251071428567 0.33419078571428573 -5.2039189285714285 0 -1.7723097428571426 -0.15300492857142858 -3.510706842857143 -0.33419078571428573 -5.203966692857143 -0.24534921428571427 -2.293720607142857 -2.090165142857143 -4.138552457142857 -4.3828508571428575 -4.3940929778571425C14.676038507142858 1.3571298342857143 12.927610907142858 1.1941071428571428 11.145 1.1941071428571428S7.613961492857142 1.3571298342857143 5.9110851 1.5469403292857142C3.6184630714285713 1.8024808499999998 1.773647142857143 3.6473127 1.528245387857143 5.941033307142857 1.347085005 7.6342931571428565 1.1941071428571428 9.372690257142857 1.1941071428571428 11.145c0 1.7722938214285715 0.15297945428571427 3.510706842857143 0.334138245 5.2039189285714285Z"
                                                                stroke-width="1.71"></path>
                                                            <path id="Vector" fill="#ffffff"
                                                                d="M14.329190185714285 10.746773228571428c1.7831363142857144 0 2.786186314285714 -1.0030181571428571 2.786186314285714 -2.7861544714285715S16.112326499999998 5.1744642857142855 14.329190185714285 5.1744642857142855C12.54605387142857 5.1744642857142855 11.543035714285715 6.177482442857143 11.543035714285715 7.960618757142856s1.0030181571428571 2.7861544714285715 2.7861544714285715 2.7861544714285715Z"
                                                                stroke-width="1.71"></path>
                                                            <path id="Vector_2" stroke="#4147d5" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M14.329190185714285 10.746773228571428c1.7831363142857144 0 2.786186314285714 -1.0030181571428571 2.786186314285714 -2.7861544714285715S16.112326499999998 5.1744642857142855 14.329190185714285 5.1744642857142855C12.54605387142857 5.1744642857142855 11.543035714285715 6.177482442857143 11.543035714285715 7.960618757142856s1.0030181571428571 2.7861544714285715 2.7861544714285715 2.7861544714285715Z"
                                                                stroke-width="1.71"></path>
                                                        </g>
                                                    </svg>
                                                    <span class="btn-text-inner">Video</span>
                                                    <input type="file" class="form-control d-none" id="video-input"
                                                        name="video" accept="video/mp4" capture="camera">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel"
                                            aria-labelledby="profile-tab" tabindex="0">
                                            <div class="widget-content widget-content-area mt-2 ">
                                                <div class="row">
                                                    @foreach (range(1, 6) as $i)
                                                        @if (isset($data['imagenes']['foto' . $i]))
                                                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                                                <a href="/imagen/{{ $data['imagenes']['foto' . $i] }}"
                                                                    class="withDescriptionGlightbox glightbox-content"
                                                                    data-glightbox="title: Contrato y medidor; description: Contrato #:{{ $data['info']['reporte']['contrato'] }} - Medidor #:{{ $data['info']['reporte']['medidor'] }};">
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
                                                                <img src="{{ asset('src/image/video.jpeg') }}"
                                                                    alt="image" class="img-fluid"
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
