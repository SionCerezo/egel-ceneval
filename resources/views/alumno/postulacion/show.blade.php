@extends('alumno.alumno-master')

@section('alumno-breadcrumb-items')
<li class="breadcrumb-item">
    <a class="text-muted">Postulaciones</a>
</li>
<li class="breadcrumb-item text-muted active" aria-current="page">Actual</li>
@endsection

@section('body')
    @isset($postulacion)
        <x-cards.postulacion :postulacion="$postulacion" :files="$files">
            <x-slot name="title">Postulación actual</x-slot>
            <x-slot name="subtitle">
                <a href="{{ route('alumno.home') }}">Detalle de la convocatoria</a>
            </x-slot>
            <x-slot name="titleDataSection">Mis datos:</x-slot>
        </x-cards.postulacion>
    @else
        <x-cards.page>
            <x-slot name="title">Postulación actual</x-slot>
            <x-slot name="subtitle">
                <a href="{{ route('alumno.home') }}">Ver convocatoria actual</a>
            </x-slot>
            <p>No tienes postulaciones activas en este momento.</p>
        </x-cards.page>
    @endisset
@endsection
