@extends('layouts.frontpage.app')

@section('content')
    <div class="container mt-6">
        <div class="row">
            <div class="col-xl-12 bg-white rounded p-4">
                <h3 class="mb-4">Estadísticas de Surtigas Pendientes por Ciclo</h3>

                @if ($pendientes->isEmpty())
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle"></i>
                        <strong>¡Excelente!</strong> No hay surtigas pendientes por asignar.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Ciclo</th>
                                    <th class="text-center">Cantidad de Pendientes</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendientes as $item)
                                    <tr>
                                        <td>
                                            <strong class="badge badge-info p-2">{{ $item->ciclo }}</strong>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-danger p-2">{{ $item->cantidad }}</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('surtigas.asignar-masivo') }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i> Asignar
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-dark">
                                    <th>Total</th>
                                    <th class="text-center">
                                        <strong class="badge badge-danger p-2">{{ $pendientes->sum('cantidad') }}</strong>
                                    </th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('surtigas.pendientes') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-list"></i> Ver Listado Completo
                        </a>
                        <a href="{{ route('surtigas.asignar-masivo') }}" class="btn btn-success btn-lg">
                            <i class="fas fa-users"></i> Asignación Masiva
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
