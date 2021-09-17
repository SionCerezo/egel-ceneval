@extends('alumno.alumno-master')

@section('css')
<link href="{{ asset('css/egel/components/cards/convocatoria.css') }}" rel="stylesheet">
@endsection

@section('alumno-breadcrumb-items')
<li class="breadcrumb-item">
    <a href="{{ route('admin.convocatoria.active') }}" class="text-muted">Postulacion</a>
</li>
<li class="breadcrumb-item text-muted active" aria-current="page">Nueva</li>
@endsection

@section('body')
<div class="blog-item post-item">
    <x-cards.page>
        <x-slot name="title">Registro para el exámen</x-slot>
        <x-slot name="subtitle"></x-slot>
        <hr>

        <form class="mt-4" method="POST" action="{{ route('postulacion.store') }}" enctype="multipart/form-data">
            @csrf
            @dump($errors)
            <input type="hidden" name="convocatoria_id" value="{{ $convocatoria_id }}">

            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        {{-- Nombre completo --}}
                        <div class="col-lg-12">
                            <div class="egel-form-group">
                                <label>Nombre:</label>
                                <input class="form-control " type="text" value="{{ $alumno->fullName }}" disabled>
                            </div>
                        </div>

                        {{-- Carrera --}}
                        <div class="col-lg-12">
                            <div class="egel-form-group">
                                <label>Carrera:</label>
                                <input class="form-control" type="text" value="{{ $alumno->carrera->name }}" disabled>
                            </div>
                        </div>

                        {{-- <div class="col-lg-12">
                            <div class="egel-form-group">
                                <input class="form-control" type="email" name="email" id="email" value="" placeholder="e-mail" data-toggle="tooltip" data-placement="top" data-original-title="e-mail" onfocus="checkIsInvalid(this)">
                            </div>
                        </div> --}}
                    </div>
                </div>
            {{-- </div>
            <div class="row"> --}}
                <div class="col-lg-4">
                    <div class="row">
                        {{-- Matricula --}}
                        <div class="col-lg-12">
                            <div class="egel-form-group">
                                <label>Matricula:</label>
                                <input class="form-control " type="text" value="{{ $alumno->matricula }}" disabled>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="col-lg-12">
                            <div class="egel-form-group">
                                <label>e-mail:</label>
                                <input class="form-control" type="text" value="{{ $alumno->email }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <div class="row">
                <div class="col-lg-6">
                    <label>Subir documentos requeridos:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="documents[]" multiple>
                            <label class="custom-file-label" for="inputGroupFile01">Seleccionar archivos...</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3-offset"></div>
                <div class="col-lg-6 text-center mt-5">
                    <button type="submit" class="btn btn-block btn-dark">Enviar registro</button>
                </div>
            </div>
        </form>
    </x-cards.page>
</div>
@endsection
