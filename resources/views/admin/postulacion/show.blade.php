@extends('admin.admin-master')

@section('css')
<style>
/* Deberia irse al gral */
.egel-float-right {
    display: inline-block;
    float: right;
}
.egel-section-body {
    padding: 25px;
}
</style>
@endsection

@section('admin-breadcrumb-items')
<li class="breadcrumb-item">
    <a href="{{ route('postulacion.index') }}" class="text-muted">Postulaciones</a>
</li>
<li class="breadcrumb-item text-muted active" aria-current="page">Matricula: {{ $postulacion->alumno->matricula }}</li>
@endsection

@section('body')
<x-cards.postulacion :postulacion="$postulacion" :files="$files" >

    <x-slot name="title">Postulación de {{ $postulacion->alumno->full_name }}</x-slot>
    <x-slot name="subtitle">Información proporcionada por el alumno</x-slot>
    <x-slot name="titleDataSection">Datos de alumno:</x-slot>

    <x-slot name="footer">
        <div class="egel-float-right">
            <div class="egel-section-body">
                <hr/>
                <button type="button" class="btn btn-outline-success">
                    <i class="fa fa-check"></i> Aprobar
                </button>
            </div>
        </div>
    </x-slot>
</x-cards.postulacion>
@endsection
