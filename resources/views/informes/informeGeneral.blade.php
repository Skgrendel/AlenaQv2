@extends('layouts.frontpage.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="page-meta">
            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('reportes.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Reportes Investigación Q Sincelejo</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Encabezado con métricas principales -->
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="mb-0">Reportes Investigación Q</h4>
                        <h5 class="text-muted">Sincelejo</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Métricas principales -->
<div class="row mt-3">
    <div class="col-md-6">
        <div class="card border-left-success">
            <div class="card-body">
                <span class="text-muted d-block text-sm">Lecturas Realizadas</span>
                <h2 class="text-success fw-bold">{{ number_format($lecturasRealizadas) }}</h2>
                <small class="text-muted">Lecturas Restantes: {{ $lecturasRestantes }}</small>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-left-primary">
            <div class="card-body">
                <span class="text-muted d-block text-sm">% Realizado Por Ciclo</span>
                <h2 class="text-primary fw-bold">{{ number_format($porcentajeCompletado, 1) }}%</h2>
                <small class="text-success">% total: {{ number_format($porcentajeCompletado, 1) }}%</small>
            </div>
        </div>
    </div>
</div>

<!-- Anomalías -->
<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Anomalías Detectadas</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <h2 class="text-danger fw-bold">{{ number_format($totalAnomalias) }}</h2>
                        <p class="text-muted small">Total de Anomalías</p>
                    </div>
                    <div class="col-md-9">
                        <div style="max-height: 250px; overflow-y: auto;">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <tbody>
                                        @forelse ($anomaliasDetectadas as $anomalia => $cantidad)
                                            @php
                                                $anomaliaNorm = strtolower(trim($anomalia));
                                                if ($anomaliaNorm === 'sin anomalías' || $anomaliaNorm === 'sin anomalia' || $anomaliaNorm === 'ninguna') {
                                                    @endphp
                                                    @continue
                                                @php
                                                }
                                            @endphp
                                            <tr>
                                                <td class="text-muted" style="width: 60%;">{{ $anomalia }}</td>
                                                <td style="width: 40%;">
                                                    <span class="badge bg-danger">{{ $cantidad }}</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-muted text-center" colspan="2">No hay anomalías detectadas</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Gráficos -->
<div class="row mt-4">
    <!-- Top Anomalías -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Top 10 Anomalías Detectadas</h5>
            </div>
            <div class="card-body">
                <canvas id="anomaliasChart" height="300"></canvas>
            </div>
        </div>
    </div>

    <!-- Estado de Reportes -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Distribución por Tipo de Comercio</h5>
            </div>
            <div class="card-body">
                <canvas id="comercioChart" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Comercios con Anomalías -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Comercios Con Más Anomalías</h5>
            </div>
            <div class="card-body">
                <canvas id="comercioAnomaliaChart" height="300"></canvas>
            </div>
        </div>
    </div>

    <!-- Estado de Progreso -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Estado de Reportes</h5>
            </div>
            <div class="card-body">
                <canvas id="estadoChart" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Gráfico de líneas por ciclo -->
<div class="row mt-4 mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Histórico de Lecturas por Mes</h5>
            </div>
            <div class="card-body">
                <canvas id="cicloChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

<script>
    // Colores
    const colors = {
        primary: '#0d6efd',
        success: '#198754',
        danger: '#dc3545',
        warning: '#ffc107',
        info: '#0dcaf0',
        secondary: '#6c757d'
    };

    const chartColors = [
        '#0d6efd', '#6c757d', '#fd7e14', '#20c997', '#e83e8c',
        '#6f42c1', '#dc3545', '#008000', '#00bcd4', '#9c27b0'
    ];

    // ========================
    // Gráfico Barras - Anomalías
    // ========================
    @php
        $anomaliasLabels = [];
        $anomaliasValores = [];
        foreach($anomaliasDetectadas as $anomalia => $cantidad) {
            $anomaliasLabels[] = substr($anomalia, 0, 20);
            $anomaliasValores[] = $cantidad;
        }
    @endphp

    const ctxAnomalias = document.getElementById('anomaliasChart').getContext('2d');
    new Chart(ctxAnomalias, {
        type: 'bar',
        data: {
            labels: {!! json_encode($anomaliasLabels) !!},
            datasets: [{
                label: 'Cantidad',
                data: {!! json_encode($anomaliasValores) !!},
                backgroundColor: colors.danger,
                borderColor: colors.danger,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            indexAxis: 'y',
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: { beginAtZero: true }
            }
        }
    });

    // ========================
    // Gráfico Dona - Comercios
    // ========================
    @php
        $comerciosLabels = [];
        $comerciosValores = [];
        foreach($lecturasPorComercio as $item) {
            $comerciosLabels[] = $item->nombre;
            $comerciosValores[] = $item->total;
        }
    @endphp

    const ctxComercio = document.getElementById('comercioChart').getContext('2d');
    new Chart(ctxComercio, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($comerciosLabels) !!},
            datasets: [{
                data: {!! json_encode($comerciosValores) !!},
                backgroundColor: chartColors
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // ========================
    // Gráfico Barras - Comercios con Anomalías
    // ========================
    @php
        $comercioAnomaliaLabels = [];
        $comercioAnomaliaValores = [];
        foreach($comercioMasAnomalias as $comercio => $cantidad) {
            $comercioAnomaliaLabels[] = $comercio;
            $comercioAnomaliaValores[] = $cantidad;
        }
    @endphp

    const ctxComercioAnomalia = document.getElementById('comercioAnomaliaChart').getContext('2d');
    new Chart(ctxComercioAnomalia, {
        type: 'bar',
        data: {
            labels: {!! json_encode($comercioAnomaliaLabels) !!},
            datasets: [{
                label: 'Anomalías',
                data: {!! json_encode($comercioAnomaliaValores) !!},
                backgroundColor: colors.warning,
                borderColor: colors.warning,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // ========================
    // Gráfico Dona - Estado
    // ========================
    @php
        $estadoLabels = [];
        $estadoValores = [];
        foreach($estadoReportes as $item) {
            $estadoLabels[] = $item->nombre ?? 'Desconocido';
            $estadoValores[] = $item->total;
        }
    @endphp

    const ctxEstado = document.getElementById('estadoChart').getContext('2d');
    new Chart(ctxEstado, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($estadoLabels) !!},
            datasets: [{
                data: {!! json_encode($estadoValores) !!},
                backgroundColor: [colors.success, colors.warning, colors.danger, colors.info, colors.secondary]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // ========================
    // Gráfico Línea - Ciclo
    // ========================
    @php
        $cicloLabels = [];
        $cicloValores = [];
        foreach($lecturasporCiclo as $item) {
            $cicloLabels[] = $item->mes;
            $cicloValores[] = $item->total;
        }
    @endphp

    const ctxCiclo = document.getElementById('cicloChart').getContext('2d');
    new Chart(ctxCiclo, {
        type: 'line',
        data: {
            labels: {!! json_encode($cicloLabels) !!},
            datasets: [{
                label: 'Lecturas Realizadas',
                data: {!! json_encode($cicloValores) !!},
                borderColor: colors.primary,
                backgroundColor: 'rgba(13, 110, 253, 0.1)',
                tension: 0.4,
                fill: true,
                pointRadius: 5,
                pointBackgroundColor: colors.primary
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: true }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>

@endsection
