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
                                                    <strong>{{ $data['info']['contrato'] }}</strong> </span>
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
                                            {{ $data['info']['lectura'] }}</span>
                                    </li>
                                    <li>
                                        <span class="text-card text-sm"> Tipo de Comercio:
                                            {{ $data['info']['comercios'] ?? 'No tiene comercio' }}</span>
                                    </li>
                                    <li>
                                        <span class="text-card text-sm"> Ciclo:
                                            {{ $data['info']['ciclo'] ?? 'Sin Datos' }}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul>
                                    <li>
                                        <span
                                            class="text-card text-sm">{{ $data['info']['imposibilidad'] ?? 'No registra imposibilidades' }}</span>
                                    </li>
                                    <li>
                                        <span class="text-card text-sm">
                                            {{ $data['info']['anomalias'] ?? 'sin datos' }}
                                        </span>
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
                            <div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100"></div>
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
                                            {{ $gis['info']['cliente'] ?? 'sin datos'}}
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
                                        <span class="media-title">Observaciones</span>
                                    </h4>
                                </div>
                            </div>
                            <hr class="my-2">
                        </div>
                        <div class="row">
                            <form action="{{ route('coordinador.update', $data['info']['id']) }}" method="post"
                                id="observacion" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <textarea id="editor" rows="5" name="observaciones" class="form-control mb-3"
                                    placeholder="Escriba Sus Observaciones"></textarea>
                                @if ($data['info']['estado'] != '6')
                                    <div class="mb-2">
                                        <div class="form-check form-check-success form-check-inline">
                                            <label class="form-check-label" for="inlineRadio1">
                                                <span class="badge badge-success">Revisado</span>
                                                <input class="form-check-input" type="radio" name="estado"
                                                    id="inlineRadio1" value="6">
                                            </label>
                                        </div>
                                        <div class="form-check form-check-danger form-check-inline">
                                            <label class="form-check-label" for="inlineRadio2">
                                                <span class="badge badge-danger">Rechazado</span>
                                                <input class="form-check-input" type="radio" name="estado"
                                                    id="inlineRadio2" value="7">
                                            </label>
                                        </div>
                                        @if ($errors->has('estado'))
                                            <span class="text-danger">{{ $errors->first('estado') }}</span>
                                        @endif
                                    </div>
                                @endif
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
                            <form action="{{ route('coordinador.store') }}" method="POST" enctype="multipart/form-data"
                                id="evidencias">
                                @csrf
                                <input type="text" name="id" value="{{ $data['info']['id'] }}" hidden>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group mb-1 ">
                                            <input type="file" class="form-control " id="foto1" name="foto1"
                                                accept="image/jpeg">
                                            <span class="input-group-text" id="foto1">Inmueble</span>
                                        </div>
                                        <div class="input-group mb-1">
                                            <input type="file" class="form-control" id="foto2" name="foto2"
                                                accept="image/jpeg">
                                            <span class="input-group-text" for="foto2">Numero Serial</span>
                                        </div>
                                        <div class="input-group mb-1">
                                            <input type="file" class="form-control" id="foto3" name="foto3"
                                                accept="image/jpeg">
                                            <span class="input-group-text" for="foto3">Numero Lectura</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-1">
                                            <input type="file" class="form-control" id="foto4" name="foto4"
                                                accept="image/jpeg">
                                            <span class="input-group-text" for="foto4">Numero Medidor</span>
                                        </div>
                                        <div class="input-group mb-1">
                                            <input type="file" class="form-control" id="foto5" name="foto5"
                                                accept="image/jpeg">
                                            <span class="input-group-text" for="foto5">Estado Medidor</span>
                                        </div>
                                        <div class="input-group mb-1">
                                            <input type="file" class="form-control" id="foto6" name="foto6"
                                                accept="image/jpeg">
                                            <span class="input-group-text" for="foto6">Opcional</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input class="form-control" type="file" id="video" name="video"
                                                accept="video/mp4">
                                            <span class="input-group-text" id="video">video</span>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-2">
                                <div class="alert alert-success d-none alert-evidencia" role="alert" id="alert">
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
    <div class="widget-content widget-content-area mt-2 ">
        <div class="row">
            @foreach (range(1, 6) as $i)
                @if (isset($data['imagenes']['foto' . $i]))
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <a href="/imagen/{{ $data['imagenes']['foto' . $i] }}"
                            class="withDescriptionGlightbox glightbox-content"
                            data-glightbox="title: Contrato y medidor; description: Contrato #:{{ $data['info']['contrato'] }} - Medidor #:{{ $data['info']['medidor'] }};">
                            <img src="/imagen/{{ $data['imagenes']['foto' . $i] }}" alt="image" class="img-fluid"
                                style="width:350px; height:250px; object-fit: cover;" />
                        </a>
                    </div>
                @endif
            @endforeach
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4 me-auto">
                @if (isset($data['video']))
                    <a href="{{ asset('video/' . $data['video']) }}" class="withDescriptionGlightbox glightbox-content">
                        <img src="{{ asset('src/image/video.jpeg') }}" alt="image" class="img-fluid"
                            style="width:350px; height:250px; object-fit: cover;" />
                    </a>
                @endif
            </div>
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
@endsection
