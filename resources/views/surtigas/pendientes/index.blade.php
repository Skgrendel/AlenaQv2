@extends('layouts.frontpage.app')

@section('content')
    <div class="container mt-6 justify-content-center">
        <div class="row">
            <div class="col-xl-12 bg-white rounded mb-4">
                <div class="mt-4 p-2 mr-2">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h3 style="margin: 0;">Surtigas Pendientes por Asignar</h3>
                    </div>

                    <!-- Botones -->
                    <div style="margin-bottom: 20px;">
                        <a href="{{ route('surtigas.exportar-pendientes') }}" class="btn btn-success" style="display: inline-block; margin-right: 10px;">
                            <i class="fas fa-download"></i> Descargar Excel
                        </a>
                        <a href="{{ route('surtigas.asignar-masivo') }}" class="btn btn-primary" style="display: inline-block;">
                            <i class="fas fa-users"></i> Asignación Masiva
                        </a>
                    </div>

                    @livewire('pendientes-surtugas-datatable')
                </div>
            </div>
        </div>
    </div>
@endsection
