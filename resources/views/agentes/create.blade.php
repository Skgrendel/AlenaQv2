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
                                                    value="{{ $data['info']['db_Surtigas']['id'] }}">
                                                <hr>
                                                <div class="d-flex justify-content-between ">
                                                    <a href="{{ $gis['geometry']['link'] ?? '#' }}" target="_blank"
                                                        class="btn btn-info me-4 bs-tooltip rounded " title="Ver Ubicacion"
                                                        data-bs-placement="top"><i class="fas fa-map-marker-alt"></i></a>
                                                    <a class="btn btn-info me-4 rounded  bs-tooltip"
                                                        title="Regresar Pagina Anterior" data-bs-placement="top"
                                                        href="{{ route('asignados') }}"><i
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
                        <div class="row">
                            <div class="col-6 d-flex justify-content-start ">
                                <label for="switch-predio" class="form-label">¿Encontro el Predio?</label>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <div class="btn-group me-2" role="group" aria-label="Second group">
                                    <input type="radio" class="btn-check" name="options-predio" id="prediosi"
                                        autocomplete="off">
                                    <label class="btn btn-outline-success" for="prediosi">Si</label>
                                    <input type="radio" class="btn-check" name="options-predio" id="prediono"
                                        autocomplete="off">
                                    <label class="btn btn-outline-danger" for="prediono">No</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-none" id="info">
                        <div class="col-12 mb-2">
                            <label for="comercio" class="form-label">¿Que Tipo de Comercio Encontro?</label>
                            <select id="slcComercio" class="form-select" name="tipo_comercio" required
                                data-placeholder="Seleccione el Tipo de Comercio">
                                @foreach ($data['comercios'] as $id => $nombre)
                                    <option value="{{ $id }}">{{ $nombre }}</option>
                                @endforeach
                            </select>
                            <div class="mt-3">
                                <label for="nueva_opcion" class="form-label">Nombre del Comercio Encontrado</label>
                                <input type="text" name="nombre_comercio" id="nombre_comercio" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="row">
                                <div class="col-6 d-flex justify-content-start">
                                    <label for="switch-medidor" class="form-label">¿Encontro un medidor?</label>
                                </div>
                                <div class="col-6 d-flex justify-content-end ">
                                    <div class="btn-group me-2" role="group" aria-label="Second group">
                                        <input type="radio" class="btn-check" name="options-medidor" id="medidorsi"
                                            autocomplete="off">
                                        <label class="btn btn-outline-success text-center" for="medidorsi">Si</label>
                                        <input type="radio" class="btn-check" name="options-medidor" id="medidorno"
                                            autocomplete="off">
                                        <label class="btn btn-outline-danger text-center" for="medidorno">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-none" id="cont-medidor">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6 d-flex justify-content-start ">
                                        <label for="switch-coincide" class="form-label">¿El medidor coincide?</label>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end">
                                        <div class="btn-group me-2" role="group" aria-label="Second group">
                                            <input type="radio" class="btn-check" name="options-medidorA" id="medidorcsi"
                                                autocomplete="off">
                                            <label class="btn btn-outline-success text-center" for="medidorcsi">Si</label>
                                            <input type="radio" class="btn-check" name="options-medidorA" id="medidorcno"
                                                autocomplete="off">
                                            <label class="btn btn-outline-danger text-center" for="medidorcno">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 d-none mb-2" id="medidor_anomalia_container">
                                <div class="mt-1">
                                    <label for="nueva_opcion" class="form-label">Digite el numero de Medidor Que
                                        Encontro</label>
                                    <input type="text" name="medidor_anomalia" id="medidor_anomalia"
                                        class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-12" id="container_anomalia_select">
                                <div class="row">
                                    <div class="col-6 d-flex justify-content-start ">
                                        <label for="switch-anomalia" class="form-label">¿Observa alguna anomalía?</label>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end ">
                                        <div class="btn-group me-2" role="group" aria-label="Second group">
                                            <input type="radio" class="btn-check" name="options-anomalia" id="anomaliasi"
                                                autocomplete="off">
                                            <label class="btn btn-outline-success text-center" for="anomaliasi">Si</label>
                                            <input type="radio" class="btn-check" name="options-anomalia" id="anomaliano"
                                                autocomplete="off">
                                            <label class="btn btn-outline-danger text-center" for="anomaliano">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 d-none mb-2" id="anomaliaContainer">
                                <div class="mt-1">
                                    <label for="slcanomalia" class="form-label">Seleccione La Anomalia Que
                                        Detecto</label>
                                    <select id="slcanomalia" class="form-select select2" name="anomalia[]"
                                        multiple="multiple"  data-placeholder="Seleccione la anomalia">
                                        @foreach ($data['anomalias'] as $id => $nombre)
                                            <option value="{{ $id }}">{{ $nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-between">
                                <label for="switch-lectura" class="form-label">¿Puede tomar la lectura?</label>
                                <div class="btn-group me-2" role="group" aria-label="Second group">
                                    <input type="radio" class="btn-check" name="options-lectura" id="lecturasi"
                                        autocomplete="off">
                                    <label class="btn btn-outline-success text-center" for="lecturasi">Si</label>
                                    <input type="radio" class="btn-check" name="options-lectura" id="lecturano"
                                        autocomplete="off">
                                    <label class="btn btn-outline-danger text-center" for="lecturano">No</label>
                                </div>
                            </div>
                            <div class="col-lg-12 d-none mb-2" id="lectura_container">
                                <div class="mt-1">
                                    <label for="lectura" class="form-label">Digite el numero de Lectura</label>
                                    <input type="text" name="lectura" id="lectura" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 d-none mb-2" id="container_imposibilidad">
                                <label for="imposibilidad" class="form-label">Imposibilidad</label>
                                <select id="imposibilidad" class="form-select" name="imposibilidad"
                                    data-placeholder="Seleccione la imposibilidad">
                                    @foreach ($data['imposibilidad'] as $id => $nombre)
                                        <option value="{{ $id }}">{{ $nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
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
                                                <path id="Intersect_3" stroke="#4147d5" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M1.4988528385714284 16.249887642857143C2.7998469 14.622446978571428 3.857571085714286 13.625749628571429 5.538014185714286 12.456368464285713c0.93495405 -0.6506291785714285 2.171141528571429 -0.7067681357142858 3.1127507357142856 -0.06578734285714286 3.067820464285714 2.088318257142857 5.652123064285714 5.278224235714286 7.328458435714286 8.378763235714286"
                                                    stroke-width="1.71"></path>
                                                <path id="Intersect_4" stroke="#4147d5" stroke-linecap="round"
                                                    stroke-linejoin="round"
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
                                                <path id="Intersect_3" stroke="#4147d5" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M1.4988528385714284 16.249887642857143C2.7998469 14.622446978571428 3.857571085714286 13.625749628571429 5.538014185714286 12.456368464285713c0.93495405 -0.6506291785714285 2.171141528571429 -0.7067681357142858 3.1127507357142856 -0.06578734285714286 3.067820464285714 2.088318257142857 5.652123064285714 5.278224235714286 7.328458435714286 8.378763235714286"
                                                    stroke-width="1.71"></path>
                                                <path id="Intersect_4" stroke="#4147d5" stroke-linecap="round"
                                                    stroke-linejoin="round"
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
                                                <path id="Intersect_3" stroke="#4147d5" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M1.4988528385714284 16.249887642857143C2.7998469 14.622446978571428 3.857571085714286 13.625749628571429 5.538014185714286 12.456368464285713c0.93495405 -0.6506291785714285 2.171141528571429 -0.7067681357142858 3.1127507357142856 -0.06578734285714286 3.067820464285714 2.088318257142857 5.652123064285714 5.278224235714286 7.328458435714286 8.378763235714286"
                                                    stroke-width="1.71"></path>
                                                <path id="Intersect_4" stroke="#4147d5" stroke-linecap="round"
                                                    stroke-linejoin="round"
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
                                                <path id="Intersect_3" stroke="#4147d5" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M1.4988528385714284 16.249887642857143C2.7998469 14.622446978571428 3.857571085714286 13.625749628571429 5.538014185714286 12.456368464285713c0.93495405 -0.6506291785714285 2.171141528571429 -0.7067681357142858 3.1127507357142856 -0.06578734285714286 3.067820464285714 2.088318257142857 5.652123064285714 5.278224235714286 7.328458435714286 8.378763235714286"
                                                    stroke-width="1.71"></path>
                                                <path id="Intersect_4" stroke="#4147d5" stroke-linecap="round"
                                                    stroke-linejoin="round"
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
                                                <path id="Intersect_3" stroke="#4147d5" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M1.4988528385714284 16.249887642857143C2.7998469 14.622446978571428 3.857571085714286 13.625749628571429 5.538014185714286 12.456368464285713c0.93495405 -0.6506291785714285 2.171141528571429 -0.7067681357142858 3.1127507357142856 -0.06578734285714286 3.067820464285714 2.088318257142857 5.652123064285714 5.278224235714286 7.328458435714286 8.378763235714286"
                                                    stroke-width="1.71"></path>
                                                <path id="Intersect_4" stroke="#4147d5" stroke-linecap="round"
                                                    stroke-linejoin="round"
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
                                                <path id="Intersect_3" stroke="#4147d5" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M1.4988528385714284 16.249887642857143C2.7998469 14.622446978571428 3.857571085714286 13.625749628571429 5.538014185714286 12.456368464285713c0.93495405 -0.6506291785714285 2.171141528571429 -0.7067681357142858 3.1127507357142856 -0.06578734285714286 3.067820464285714 2.088318257142857 5.652123064285714 5.278224235714286 7.328458435714286 8.378763235714286"
                                                    stroke-width="1.71"></path>
                                                <path id="Intersect_4" stroke="#4147d5" stroke-linecap="round"
                                                    stroke-linejoin="round"
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
                                <hr class="my-2">
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
    <script src="{{ asset('script/agentes/AgentesCreate.js') }}"></script>
    <script>
        $(".select2").select2({
            theme: "classic"
        });
    </script>
@endsection
