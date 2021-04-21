@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col" style="max-width: 400px">
            <div class="col-12 d-flex justify-content-center my-4">
                <h1>{{ __('REDEFINIR SENHA') }}</h1>
            </div>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
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

                <div class="form-group row mb-0 mt-5">
                    <div class="col-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Enviar link de redefinição de senha') }}
                        </button>
                    </div>
                </div>
            </form>

            <div class="form-group row mb-0 mt-3">
                <div class="col-12 d-flex justify-content-center">
                    <a class="btn btn-link" href="{{ route('login') }}">{{ __('Voltar para o login') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
