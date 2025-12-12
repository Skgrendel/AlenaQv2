@extends('layouts.frontpage.app')

@section('content')
    <div class="col">
        <div class="widget widget-chart-three">
            <div class="widget-heading">
                <div class="widget-content">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Gestión de Tokens GIS</h5>
                            <a href="{{ route('gis-tokens.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Nuevo Token
                            </a>
                        </div>
                        <div class="card-body">
                            @if($tokens->isEmpty())
                                <div class="alert alert-info">
                                    No hay tokens registrados. Cree uno para comenzar.
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Token</th>
                                                <th>Descripción</th>
                                                <th>Estado</th>
                                                <th>Fecha Creación</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($tokens as $token)
                                                <tr>
                                                    <td>{{ $token->id }}</td>
                                                    <td>
                                                        <code class="text-truncate" style="max-width: 200px; display: inline-block;">
                                                            {{ Str::limit($token->token, 50) }}
                                                        </code>
                                                    </td>
                                                    <td>{{ $token->descripcion ?? 'Sin descripción' }}</td>
                                                    <td>
                                                        @if($token->activo)
                                                            <span class="badge bg-success">Activo</span>
                                                        @else
                                                            <span class="badge bg-secondary">Inactivo</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $token->created_at->format('d/m/Y H:i') }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            @if(!$token->activo)
                                                                <form action="{{ route('gis-tokens.activate', $token) }}" method="POST" style="display: inline;">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="submit" class="btn btn-success btn-sm" title="Activar">
                                                                        <i class="fas fa-check"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                            <a href="{{ route('gis-tokens.edit', $token) }}" class="btn btn-warning btn-sm" title="Editar">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('gis-tokens.destroy', $token) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Está seguro de eliminar este token?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @if (session('success'))
        <script>
            Swal.fire({
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
@endsection
