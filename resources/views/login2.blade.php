@extends('layouts.plantilla')

@section('title', 'Ingreso al sistema')



@section('content')
    <!--Aqui ya va todo el contenido del login-->
    <section class="container-fluid login-cuerpo d-flex justify-content-center align-items-center">

        <div class="d-flex align-items-center w-50 p-3">
            <a href="">
                <img src="{{ asset('images/ceneval.jpg') }}" alt="logoCeneval" width="350px" height="350px">
            </a>
            <p class="text-justify d-inline-flex pl-3">
                En caso de olvidar su contraseña favor de seguir los pasos que vienen al ingresar correspondiente. <br>
                Si quiere regresar a la pagina de inicio favor de presionar la imagen que esta junto a este texto.
            </p>
        </div>

        <div class="mx-5">
            <form action="">
                <div class="form-group">
                    <label class="font-weight-bold h3">Inciar sesion</label>
                    <input type="text" class="form-control" id="email" placeholder="Ingrese un correo">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="password" placeholder="Ingrese su password">
                </div>
                <div class="form-group">
                    <input type="submit" value="Entrar" class="btn btn-primary btn-lg btn-block">
                </div>
            </form>
            <div class="d-flex flex-column pl-4">
                <a href="" class="pl-4 ml-2">Registrarse</a>
                <a href="">Olvido su contraseña</a>
            </div>
        </div>
    </section>

@endsection