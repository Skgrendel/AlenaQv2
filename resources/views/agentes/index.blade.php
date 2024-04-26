@extends('layouts.frontpage.app')

@section('content')
<div class="container mt-3 ">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <a class="btn btn-primary mt-2 me-4" href="{{route('reportes.create')}}">Nuevo Reporte</a>
            @if ($reportes->isEmpty())
                            <div class="text-center py-3">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="text-black">No hay Reportes Activos</p>
                                    </div>
                                </div>
                            </div>
             @endif
            @foreach ($reportes as $reporte)
            <div class="card style-3 d-flex flex-column">
                <div class="d-flex">
                    @if ($estados != '7')
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="100" height="100" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-warning">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                    @elseif ($estados == '7')
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"  width="50" height="50" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-danger">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.25-8.25-3.286Zm0 13.036h.008v.008H12v-.008Z" />
                      </svg>
                    @endif
                    <div class="card-body px-0 py-0 align-self-center">
                        <p class="card-text text-sm">Contrato: <div id="">{$reporte->contrato}</div> </p>
                       <ul>
                        <li>
                            <span></span>
                        </li>
                       </ul>
                    </div>
                </div>
                <div class="mt-auto">
                    @if ($estados != '7')
                        <a href="#" class="btn btn-warning mb-2 me-4">Ver Informacion</a>
                    @elseif ($estados == '7')
                        <a href="#" class="btn btn-danger mb-2 me-4">Revisar</a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
