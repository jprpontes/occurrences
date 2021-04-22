@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col" style="max-width: 350px">
            <div class="col-12 d-flex justify-content-center my-4">
                <h1>{{ __('LOGIN') }}</h1>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group row">
                    <div class="col-12">
                        <label for="email">{{ __('Endereço de e-mail') }}</label>
                    </div>
                    <div class="col-12">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                    @error('email')
                        <div class="col-12">
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </div>
                    @enderror
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <label for="password">{{ __('Senha') }}</label>
                    </div>
                    <div class="col-12">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    </div>
                    @error('password')
                        <div class="col-12">
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        </div>
                    @enderror
                </div>

                <div class="form-group row">
                    <div class="col-12 mt-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Lembrar-me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    @if (Route::has('password.request'))
                        <div class="col-12 d-flex justify-content-center mt-2">
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Esqueceu sua senha? Clique aqui.') }}
                            </a>
                        </div>
                    @endif

                    <div class="col-12 d-flex justify-content-center mt-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Acessar') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
