@extends('layouts.auth.login')

@section('content')
    <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto ">
        <div class="card mt-3 mb-3" >
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="justify-content-center mb-3 ">
                            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                                <img src="{{ asset('src/image/LogoAlenaQanalyticData.svg') }}" alt=""
                                    style="width: 250px; higth: 150px;">
                            </div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="col-md-12">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <div class="mb-3">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <div class="mb-4">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-4">
                                <button type="submit" class="btn btn-secondary mb-2 me-4 w-100">{{ __('Login') }}</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    @if ($errors->any())
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: "Error",
                text: "{{ $errors->first() }}",
                icon: "error"
            });
        });
    @endif
</script>
@endsection
