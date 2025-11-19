@extends('layouts.frontpage.app')

@section('content')
    <div class="container mt-6 justify-content-center">
        <div class="row">
            <div class="col-xl-12 bg-white rounded mb-4">
                <div class="mt-4 p-2 mr-2">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3>Surtigas Pendientes por Asignar</h3>
                        <a href="{{ route('surtigas.asignar-masivo') }}" class="btn btn-primary">
                            <i class="fas fa-users"></i> Asignación Masiva
                        </a>
                    </div>
                    @livewire('pendientes-surtugas-datatable')
                </div>
            </div>
        </div>
    </div>
@endsection
