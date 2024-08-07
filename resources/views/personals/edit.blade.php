@extends('layouts.frontpage.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                       <span class="mb-2">Editar Personal</span>
                        <a href="{{ route('personals.index') }}" class="btn btn-outline-primary float-right">Regresar</a>
                    </div>
                    <form action="{{ route('personals.update',$data['personal']['id']) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tipo_documento">Tipo de Documento</label>
                                        <select class="form-select" aria-label="tipo_documento" name="tipo_documento" id="tipo_documento" required>
                                            <option selected disabled>Seleccione tipo de documento</option>
                                            @foreach ($data['tipodocumento'] as $id => $nombre)
                                                <option value="{{ $id }}" {{ $data['personal']['tipodocumento'] = $id ? 'selected' : '' }}>{{ $nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="nombres">Nombres</label>
                                        <input type="text" class="form-control @error('nombres') is-invalid @enderror"
                                            id="nombres" name="nombres" value="{{ $data['personal']['nombres'] }}">
                                        @error('nombres')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="telefono">Telefono</label>
                                        <input type="text" class="form-control @error('telefono') is-invalid @enderror"
                                            id="telefono" name="telefono" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ $data['personal']['telefono'] }}">
                                        @error('telefono')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="numero_documento">Número de Documento</label>
                                        <input type="tel" class="form-control" id="numero_documento"
                                            name="numero_documento"  oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ $data['personal']['numero_documento'] }}">
                                        @error('numero_documento')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div
                                        class="form-group mt-2
                                        @error('apellidos') is-invalid @enderror">
                                        <label for="apellidos">Apellidos</label>
                                        <input type="text" class="form-control" id="apellidos" name="apellidos"
                                            value="{{ $data['personal']['apellidos']}}">
                                        @error('apellidos')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div
                                        class="form-group mt-2
                                        @error('correo') is-invalid @enderror">
                                        <label for="correo">Correo</label>
                                        <input type="email" class="form-control" id="correo" name="correo"
                                            value="{{$data['personal']['correo'] }}">
                                        @error('correo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group mt-2">
                                    <label for="rol">Rol</label>
                                    <select name="rol" class="form-control" id="rol">
                                        <option value="">Seleccionar rol</option>
                                        @foreach ($data['roles'] as $id => $name)
                                            <option value="{{ $id }}"
                                                {{ is_array($data['userRoles']) && in_array($id, $data['userRoles']) ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                @if (Session::has('success'))
                    Swal.fire({
                        icon: '{{ Session::get('icon') }}',
                        title: '{{ Session::get('title') }}',
                        text: '{{ Session::get('success') }}',
                        showConfirmButton: false,
                        timer: 1500
                    });
                @endif
            });
        </script>
