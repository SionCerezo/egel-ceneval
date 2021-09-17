@extends('alumno.alumno-master')

@php
    $user = $postulacion->alumno;
@endphp

@section('alumno-breadcrumb-items')
<li class="breadcrumb-item">
    <a class="text-muted">Postulaciones</a>
</li>
<li class="breadcrumb-item text-muted active" aria-current="page">Actual</li>
@endsection

@section('body')
<x-cards.postulacion :user="$user" :files="$files">
    <x-slot name="title">Postulación actual</x-slot>
    <x-slot name="subtitle">
        <a href="{{ route('alumno.home') }}">Detalle de la convocatoria</a>
    </x-slot>
    <x-slot name="titleDataSection">Mis datos:</x-slot>
</x-cards.postulacion>
@endsection
