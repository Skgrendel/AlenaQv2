@extends('layouts.frontpage.app')


@section('content')

<div class="card">
    <div class="card-body">
        @livewire('personals-datatable')
    </div>
</div>
@endsection

@section('scripts')
<script>
       document.addEventListener("DOMContentLoaded", function() {
                @if (Session::has('success'))
                    Swal.fire({
                        icon: '{{ Session::get('icon') }}',
                        title: '{{ Session::get('title') }}',
                        text: '{{ Session::get('success') }}',
                        showConfirmButton: false,
                        timer: 1500
                    });
                @endif
            });
</script>
@endsection

