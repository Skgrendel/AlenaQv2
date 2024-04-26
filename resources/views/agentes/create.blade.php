@extends('layouts.frontpage.app')

@section('content')
    <div class="container mt-3">
        <a class="btn btn-primary mb-2 me-4" href="{{ route('reportes.index') }}">Regresar</a>
        <div class="card">
            <div class="card-body">
                <form class="row g-3" id="reporte" action="{{ route('reportes.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <label for="Contrato" class="form-label">Numero de Contrato</label>
                    <div class="col-12 input-group">
                        <input id="Contrato" class="form-control" name="contrato" placeholder="Numero de Contrato"
                            required>
                        <button type="button" class="btn btn-primary" onclick="BuscarContrato()">Buscar</button>
                    </div>
                    <div class="col-12">
                        <div class="card  shadow d-none " id="ubicacion">
                            <div class="card-body">
                                <label class="form-label"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="-0.815 -0.815 26 26" height="26" width="26"
                                        id="Location-Pin-3--Streamline-Plump">
                                        <g id="location-pin-3--navigation-map-maps-pin-gps-location">
                                            <path id="Rectangle 180" stroke="#000000" stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="m19.0390625 16.886379166666664 0.2944708333333333 0.016246666666666666c0.616865625 0.03452416666666667 1.168236875 0.3721502083333333 1.4459533333333332 0.9240291666666667a17.018891041666667 17.018891041666667 0 0 1 1.2301772916666667 3.2391791666666667c0.22339166666666666 0.8412727083333333 -0.3934739583333333 1.6195895833333334 -1.262670625 1.6551291666666665C19.29190125 22.780872916666663 16.665018333333332 22.846875 12.184999999999999 22.846875c-4.480018333333333 0 -7.106901249999999 -0.06600208333333334 -8.561993333333334 -0.12540395833333332 -0.8691966666666666 -0.03553958333333333 -1.4855545833333335 -0.8148718749999999 -1.262670625 -1.6551291666666665a17.019906458333335 17.019906458333335 0 0 1 1.2301772916666667 -3.239686875c0.27771645833333336 -0.5518789583333333 0.8290877083333333 -0.889505 1.4459533333333332 -0.9240291666666667l0.2944708333333333 -0.015738958333333334"
                                                stroke-width="1.63"></path>
                                            <path id="Ellipse 517" stroke="#000000" stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M19.800625 9.174289583333334c0 5.396939583333333 -5.456849166666666 9.270754166666666 -7.132286666666666 10.333387708333333a0.8966129166666666 0.8966129166666666 0 0 1 -0.9666766666666666 0C10.026224166666667 18.445551458333334 4.569375 14.571229166666665 4.569375 9.174289583333334 4.569375 4.948633125 7.979144166666666 1.5231249999999998 12.184999999999999 1.5231249999999998c4.205855833333334 0 7.615625 3.425508125 7.615625 7.651164583333333Z"
                                                stroke-width="1.63"></path>
                                            <path id="Ellipse 27" stroke="#000000" stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M15.23125 9.13875a3.0462499999999997 3.0462499999999997 0 1 1 -6.092499999999999 0 3.0462499999999997 3.0462499999999997 0 0 1 6.092499999999999 0Z"
                                                stroke-width="1.63"></path>
                                        </g>
                                    </svg> Ubicación</label>
                                <p id="direccion"></p>
                                <a href="" target="_blank" class="btn btn-info btn-sm d-none"
                                    rel="noopener noreferrer" id="maps">Maps</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="medidor" class="form-label">Numero de Medidor</label>
                        <input type="text" class="form-control" id="medidor">
                        <div class="form-check form-check-danger form-check-inline mt-2 ">
                            <input class="form-check-input" type="checkbox" value="" id="medidor_Cambio">
                            <label class="form-check-label" for="medidor_Cambio">
                                Cambio
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="lectura" class="form-label">Numero de Lectura</label>
                        <input type="text" class="form-control" id="lectura" name="lectura">
                    </div>

                    <div class="col-12">
                        <label for="lectura" class="form-label">Numero de Lectura</label>
                        <input type="text" class="form-control" id="lectura" name="lectura">
                    </div>
                    <div class="col-12">
                        <label for="comercio" class="form-label">Tipo de Comercio</label>
                        <select id="comercio" class="form-select">
                            <option selected disabled>Seleccione El tipo de Comercio</option>
                            @foreach ($comercios as $id => $nombre)
                                <option value="{{ $id }}">{{ $nombre }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-12">
                        <label for="imposibilidad" class="form-label">Imposibilidad</label>
                        <select id="imposibilidad" class="form-select">
                            <option selected disabled>Seleccione Su imposibilidad</option>
                            @foreach ($imposibilidad as $id => $nombre)
                                <option value="{{ $id }}">{{ $nombre }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-12">
                        <label for="anomalia" class="form-label">Anomalias Detectadas</label>
                        <select id="anomalia" class="form-select" name="anomalias[]" multiple autocomplete="off"
                            data-placeholder="Seleccione Las anomalias Detectadas">
                            @foreach ($anomalias as $id => $nombre)
                                <option value="{{ $id }}">{{ $nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="comentarios" class="form-label">Observaciones</label>
                        <textarea name="comentarios" id="comentarios" cols="30" rows="3" class="form-control"></textarea>
                    </div>

                    <div id="fuMultipleFile" class="col-lg-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Fotos Evidencias</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="multiple-file-upload">
                                            <input type="file" class="filepond file-upload-multiple" name="filepond"
                                                multiple data-allow-reorder="true" data-max-file-size="3MB"
                                                data-max-files="6" accept="image/*;capture=camera">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary" id="submitButtonReporte">Enviar</button>
                        <button class="btn btn-success mb-2 me-4 d-none" id="progressBarReporte">
                            <div class="spinner-border text-white me-2 align-self-center loader-sm "></div> Enviando
                            Archivos Espere...
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function BuscarContrato() {
            var id = $('#Contrato').val();
            if (id) {
                $.ajax({
                    url: '/funtion/busqueda/' + id,
                    type: 'GET',
                    success: function(response) {
                        // Aquí puedes manejar la respuesta del servidor
                        $('#medidor').val(response.contrato.medidor);
                        $('#direccion').text(response.contrato.direccion);
                        $('#maps').removeClass('d-none');
                        $('#maps').attr('href', 'https://www.google.com/maps/place/' + response.src);
                        $('#ubicacion').removeClass('d-none');
                    },
                    error: function(error) {
                        if (error.responseJSON && error.responseJSON.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: error.responseJSON.error,
                            });
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ingrese un numero de contrato',
                });
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#reporte').submit(function() {
                $('#submitButtonReporte').addClass('d-none');
                $('#progressBarReporte').removeClass('d-none');
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            new TomSelect("#anomalia", {
                persist: false,
                createOnBlur: true,
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            FilePond.registerPlugin(
                FilePondPluginImagePreview,
                FilePondPluginImageExifOrientation,
                FilePondPluginFileValidateSize
            );
            FilePond.create(
                document.querySelector('.file-upload-multiple')
            );
        });
    </script>
@endsection
