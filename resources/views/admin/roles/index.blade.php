@extends('layouts.frontpage.app')

@section('content')
    <div class="container mt-3 ">
        <div class="card">
            <div class="card-body">
                   @livewire('roles-datatable')
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
    <script>
        $(document).ready(function() {
            // Delegación de eventos para manejar clics en cualquier botón de eliminación
            $(document).on('click', '.deleteButton', function() {
                const roleId = $(this).data('item-id');
                const formId = `#deleteForm-${roleId}`;
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: '¡No podrás revertir esto!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, bórralo',
                    cancelButtonText: 'No, cancelar',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si el usuario confirma, enviar el formulario de eliminación
                        $(formId).submit();
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire({
                            title: 'Cancelado',
                            text: 'Tu acción fue cancelada con éxito',
                            icon: 'error'
                        });
                    }
                });
            });
        });
    </script>
@endsection
