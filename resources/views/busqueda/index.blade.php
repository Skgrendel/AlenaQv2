@extends('layouts.frontpage.app')

@section('content')
    <div class="widget-content widget-content-area">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-search me-2" style="color: #667eea;"></i>Búsqueda de Ubicación
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- Sección de búsqueda -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="input-group input-group-lg">
                                    <input
                                        type="number"
                                        id="searchInput"
                                        class="form-control"
                                        placeholder="Ingresa número de contrato....">
                                    <button
                                        class="btn btn-primary"
                                        type="button"
                                        id="searchBtn"
                                        onclick="performSearch()">
                                        <i class="fas fa-search me-2"></i>Buscar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Spinner de carga -->
                        <div id="loadingSpinner" class="text-center d-none mb-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Buscando...</span>
                            </div>
                            <p class="text-muted mt-2">Buscando información...</p>
                        </div>

                        <!-- Mensajes de error -->
                        <div id="errorAlert" class="alert alert-danger alert-dismissible fade d-none" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <span id="errorMessage"></span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <!-- Resultado de búsqueda -->
                        <div id="resultContainer" class="d-none">
                            <!-- Tarjeta con información principal -->
                            <div class="card border-0 bg-light mb-4">
                                <div class="card-body">
                                    <h6 class="card-title mb-3 fw-600" style="color: #2c3e50;">
                                        <i class="fas fa-building me-2" style="color: #667eea;"></i>Información del Predio
                                    </h6>

                                    <div class="row g-3">
                                        <!-- Dirección -->
                                        <div class="col-12">
                                            <div class="info-item">
                                                <small class="text-muted d-block mb-1">
                                                    <i class="fas fa-user me-1"></i>Cliente
                                                </small>
                                                <p id="cliente" class="fw-500 mb-0" style="color: #2c3e50;"></p>
                                            </div>
                                        </div>
                                        <!-- Fila 1: Cliente y Contrato -->
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <small class="text-muted d-block mb-1">
                                                    <i class="fas fa-file-contract me-1"></i>Contrato
                                                </small>
                                                <p id="contrato" class="fw-500 mb-0" style="color: #2c3e50;"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <small class="text-muted d-block mb-1">
                                                    <i class="fas fa-map-marker-alt me-1"></i>Dirección
                                                </small>
                                                <p id="direccion" class="fw-500 mb-0" style="color: #2c3e50;"></p>
                                            </div>
                                        </div>
                                        <!-- Fila 2: Medidor y Barrio -->
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <small class="text-muted d-block mb-1">
                                                    <i class="fas fa-gauge-simple me-1"></i>Medidor
                                                </small>
                                                <p id="medidor" class="fw-500 mb-0" style="color: #2c3e50;"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <small class="text-muted d-block mb-1">
                                                    <i class="fas fa-map me-1"></i>Barrio
                                                </small>
                                                <p id="barrio" class="fw-500 mb-0" style="color: #2c3e50;"></p>
                                            </div>
                                        </div>
                                          <div class="col-md-6">
                                            <div class="info-item">
                                                <small class="text-muted d-block mb-1">
                                                    <i class="fas fa-map me-1"></i>Localidad
                                                </small>
                                                <p id="localidad" class="fw-500 mb-0" style="color: #2c3e50;"></p>
                                            </div>
                                        </div>

                                        <!-- Fila 3: Categoría y Estado -->
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <small class="text-muted d-block mb-1">
                                                    <i class="fas fa-tag me-1"></i>Categoría
                                                </small>
                                                <p id="categoria" class="fw-500 mb-0" style="color: #2c3e50;"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <small class="text-muted d-block mb-1">
                                                    <i class="fas fa-info-circle me-1"></i>Estado
                                                </small>
                                                <div id="estadoContainer"></div>
                                            </div>
                                        </div>

                                        <!-- Descripción completa -->
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <small class="text-muted d-block mb-1">
                                                    <i class="fas fa-file-alt me-1"></i>Descripción
                                                </small>
                                                <p id="descripcion" class="mb-0" style="color: #2c3e50; line-height: 1.5;"></p>
                                            </div>
                                        </div>

                                        <!-- Medidor Anterior -->
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <small class="text-muted d-block mb-1">
                                                    <i class="fas fa-history me-1"></i>Medidor Anterior
                                                </small>
                                                <p id="medidorAnterior" class="fw-500 mb-0" style="color: #2c3e50;"></p>
                                            </div>
                                        </div>

                                        <!-- Fecha Anterior -->
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <small class="text-muted d-block mb-1">
                                                    <i class="fas fa-calendar me-1"></i>Fecha Anterior
                                                </small>
                                                <p id="fechaAnterior" class="fw-500 mb-0" style="color: #2c3e50;"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Línea divisora -->
                                    <hr class="my-4" style="border-color: #e0e0e0;">

                                    <!-- Botones de acción -->
                                    <div class="d-flex gap-2">
                                        <a id="ubicacionBtn" href="#" target="_blank" class="btn btn-primary">
                                            <i class="fas fa-map-marker-alt me-2"></i>Ver en Google Maps
                                        </a>
                                        <a href="{{ route('busqueda-gis.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-times me-2"></i>Limpiar Búsqueda
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Mensaje de bienvenida -->
                        <div id="welcomeMessage" class="alert alert-info" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            Ingresa un número de contrato o medidor para buscar información en el sistema GIS
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .info-item {
            padding: 12px;
            background: white;
            border-radius: 6px;
            border-left: 3px solid #667eea;
        }

        .input-group-lg .form-control {
            font-size: 1.05rem;
        }

        .input-group-lg .btn {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
        }
    </style>

    <script>
        function performSearch() {
            const search = document.getElementById('searchInput').value.trim();

            if (!search) {
                showError('Por favor ingresa un número de contrato o medidor');
                return;
            }

            // Mostrar spinner
            document.getElementById('loadingSpinner').classList.remove('d-none');
            document.getElementById('resultContainer').classList.add('d-none');
            document.getElementById('welcomeMessage').classList.add('d-none');
            document.getElementById('errorAlert').classList.add('d-none');

            // Realizar búsqueda
            fetch('{{ route('busqueda-gis.search') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ search: search })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('loadingSpinner').classList.add('d-none');

                if (data.success) {
                    displayResults(data.data);
                } else {
                    showError(data.message || 'No se encontró información');
                }
            })
            .catch(error => {
                document.getElementById('loadingSpinner').classList.add('d-none');
                showError('Error al consultar el servidor: ' + error.message);
            });
        }

        function displayResults(data) {
            const info = data.info || {};
            const geometry = data.geometry || {};

            // Llenar información
            document.getElementById('direccion').textContent = info.direccion || 'N/A';
            document.getElementById('cliente').textContent = info.cliente || 'N/A';
            document.getElementById('contrato').textContent = info.contrato || 'N/A';
            document.getElementById('medidor').textContent = info.medidor || 'N/A';
            document.getElementById('barrio').textContent = info.barrio || 'N/A';
            document.getElementById('categoria').textContent = info.categoria || 'N/A';
            document.getElementById('descripcion').textContent = info.descripcion || 'N/A';
            document.getElementById('medidorAnterior').textContent = info.medidor_anterior || 'N/A';
            document.getElementById('fechaAnterior').textContent = info.fecha_anterior || 'N/A';
            document.getElementById('localidad').textContent = info.localidad || 'N/A';

            // Estado con badge
            const estadoContainer = document.getElementById('estadoContainer');
            if (info.estado) {
                const badgeColor = info.estado === 'Activo' ? '#d4edda' : '#f8d7da';
                const textColor = info.estado === 'Activo' ? '#155724' : '#721c24';
                estadoContainer.innerHTML = `<span class="badge" style="background-color: ${badgeColor}; color: ${textColor};">${info.estado}</span>`;
            } else {
                estadoContainer.textContent = 'N/A';
            }

            // Botón de ubicación
            const ubicacionBtn = document.getElementById('ubicacionBtn');
            if (geometry.link) {
                ubicacionBtn.href = geometry.link;
                ubicacionBtn.classList.remove('d-none');
            } else {
                ubicacionBtn.classList.add('d-none');
            }

            // Mostrar resultados
            document.getElementById('resultContainer').classList.remove('d-none');
        }

        function showError(message) {
            document.getElementById('errorMessage').textContent = message;
            document.getElementById('errorAlert').classList.remove('d-none');
            document.getElementById('loadingSpinner').classList.add('d-none');
            document.getElementById('welcomeMessage').classList.add('d-none');
        }

        // Permitir búsqueda con Enter
        document.getElementById('searchInput').addEventListener('keyup', function(event) {
            if (event.key === 'Enter') {
                performSearch();
            }
        });
    </script>
@endsection
