@extends('layouts.frontpage.app')

@section('content')
    <div class="col">
        <div class="widget widget-chart-three">
            <div class="widget-heading">
                <div class="widget-content">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Gestionar Reguladores</h5>
                            <a href="{{ route('reguladores.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Nuevo Regulador
                            </a>
                        </div>
                        <div class="card-body">
                            @if ($reguladores->isEmpty())
                                <div class="alert alert-info" role="alert">
                                    No hay reguladores registrados. <a href="{{ route('reguladores.create') }}">Crear uno ahora</a>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Nomenclatura</th>
                                                <th>Fecha de Creación</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reguladores as $regulador)
                                                <tr>
                                                    <td>{{ $regulador->nombre }}</td>
                                                    <td>
                                                        <span class="badge bg-info">{{ $regulador->nomenclatura }}</span>
                                                    </td>
                                                    <td>{{ $regulador->created_at->format('d/m/Y H:i') }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('reguladores.edit', $regulador) }}"
                                                               class="btn btn-warning btn-sm"
                                                               title="Editar">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form id="deleteForm-{{ $regulador->id }}"
                                                                  action="{{ route('reguladores.destroy', $regulador) }}"
                                                                  method="POST"
                                                                  style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button"
                                                                        class="btn btn-danger btn-sm delete-btn"
                                                                        data-id="{{ $regulador->id }}"
                                                                        data-nombre="{{ $regulador->nombre }}"
                                                                        title="Eliminar">
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

    @if ($errors->any())
        <script>
            Swal.fire({
                title: 'Error',
                text: 'Por favor verifica los errores en el formulario',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const id = this.dataset.id;
                const nombre = this.dataset.nombre;

                Swal.fire({
                    title: '¿Eliminar regulador?',
                    text: `¿Estás seguro de que deseas eliminar "${nombre}"?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('deleteForm-' + id).submit();
                    }
                });
            });
        });
    </script>
@endsection
