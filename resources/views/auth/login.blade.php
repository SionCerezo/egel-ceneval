@extends('auth.master')

@section('title', 'Login')

@section('body')
<div class="col-lg-5 col-md-7 bg-white">
    <div class="p-3">
        <div class="text-center">
            <img src="{{ asset('images/'.property('images.logos.fcc')) }}" width="50" height="63" alt="FCC">
        </div>
        <h2 class="mt-3 text-center">Iniciar sesión</h2>
        <p class="text-center">Ingresa tu e-mail y tu contraseña para acceder.</p>

        @if (session()->has('loginFail'))
            <span class="invalid-feedback" role="alert" style="display: inline">
                <strong>{{ session()->get('loginFail') }}</strong>
            </span>
        @endif

        <form class="mt-4" method="POST" action="{{ route('login') }}" id="frm-main">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="text-dark" for="email">Usuario</label>
                        <x-forms.input type="text" label="E-mail" name="email" with-error/>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="text-dark" for="password">Password</label>
                        <x-forms.input type="password" label="Contraseña" name="password" with-error/>
                    </div>
                </div>
                <div class="col-lg-12 text-center">
                    <button type="submit" class="btn btn-block btn-dark">Entrar</button>
                </div>
                <div class="col-lg-12 text-center mt-5">
                    ¿No tienes una cuenta? <a href="{{ route('alumno.register') }}" class="text-danger">Regístrate</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
