@extends('layouts.frontpage.app')

@section('content')
    <div class="container mt-3 ">
        <div class="card">
            <div class="card-body">
                {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'put']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Ingrese el Nombre del Rol') !!}
                    {!! Form::text('name', null, [
                        'class' => 'form-control mb-3',
                        'placeholder' => 'Ejemplo: Administrador del Sistema',
                    ]) !!}
                    @error('name')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="card-body">
                    <h4>Permsisos</h4>
                    @foreach ($permisos as $category => $permissions)
                        <div class="form-group">
                            <hr>
                            <h6><strong>{{ $category }}</strong></h6>
                            <div class="row">
                                @foreach ($permissions as $index => $item)
                                    <div class="col-md-3">
                                        <label for="">
                                            {!! Form::checkbox('permisos[]', $item->id, $role->hasPermissionTo($item->id) ?: false, ['class' => 'form-check-input mr-1']) !!}
                                            {{ $item->description }}
                                        </label>
                                    </div>
                                    @if (($index + 1) % 4 == 0 && $index + 1 != count($permissions))
                            </div>
                            <div class="row mt-2">
                    @endif
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
        <hr>
        {!! Form::submit('Actualizar Rol', ['class' => 'btn btn-primary btn-rounded mb-2 me-4']) !!}
        {!! Form::close() !!}
    </div>
    </div>
    </div>
@endsection

@section('scripts')
@endsection
