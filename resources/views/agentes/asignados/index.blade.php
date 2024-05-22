@extends('layouts.frontpage.app')

@section('content')
    <div class="container mt-6 justify-content-center">
        <div class="row">
            <div class="col-xl-12 bg-white rounded mb-4 ">
                <div class="mt-4 p-2 mr-2">
                    @livewire('asignados-datatable')
                </div>
            </div>
        </div>
    </div>
@endsection
