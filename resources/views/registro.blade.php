@extends('layouts.plantilla')

@section('title', 'Registro Nuevo Alumno')

@section('content')
    <div class="d-flex flex-sm-column flex-md-column flex-lg-column flex-xl-column justify-content-sm-center justify-content-md-center justify-content-lg-center justify-content-xl-center align-items-sm-center align-items-md-center align-items-lg-center align-items-xl-center">
        <div class="">
            <h1>Registro de datos</h1>
        </div>
        
        <div class="text-justify">
            <h4>Favor de llenar los campos correspondientes</h4>
        </div>
    </div>

    <form action="">
        <div class="container mt-5">
            <div class="form-group row">
                <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 h4" for="">Nombre</label>
                <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
                    <input type="text" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 h4" for="">Apellido paterno</label>
                <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
                    <input type="text" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 h4" for="">Apellido materno</label>
                <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
                    <input type="text" class="form-control">
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 h4" for="">Teléfono</label>
                <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
                    <input type="text" class="form-control" placeholder="222-163-9880">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 h4" for="">Correo</label>
                <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
                    <input type="text" class="form-control" placeholder="email@example.com">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 h4" for="">Matrícula</label>
                <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
                    <input type="text" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 h4" for="">Carrera</label>
                <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
                    <select name="" id="" class="form-control">
                        <option value="" selected>Seleccionar</option>
                        <option value="">Licenciatura en Cs. de la Computación</option>
                        <option value="">Ingeniería en Cs. de la Computación</option>
                        <option value="">Ingeniería en Tecnologías de la Información</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-md-3 col-lg-3 col-xl-3 h4" for="">Password</label>
                <div class="col-sm-9 col-md-9 col-lg-9 col-xl-9">
                    <input type="password" name="" id="" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Registrar</button>
                </div>
            </div>
    </form>
@endsection