@extends('admin.admin-master')

@php
    $user = $postulacion->alumno;
@endphp

@section('admin-breadcrumb-items')
<li class="breadcrumb-item">
    <a href="{{ route('postulacion.index') }}" class="text-muted">Postulaciones</a>
</li>
<li class="breadcrumb-item text-muted active" aria-current="page">Alumno {{ $user->matricula }}</li>
@endsection

@section('body')
<div class="blog-item post-item">
    <x-cards.page>
        <x-slot name="title">Postulación de {{ $user->full_name }}</x-slot>
        <x-slot name="subtitle">Información proporcionada por el alumno</x-slot>
        <hr>

        {{-- Datos del Alumno --}}
        <div class="row">
            <div class="col-md-12 border-bottom pb-3">
                <span class="font-weight-medium text-dark">
                    <i class="icon-info mr-2 text-info"></i> Datos de alumno:
                </span>
            </div>
            <div class="col-md-7 border-right">
                <ul class="list-style-none">
                    <li class="my-3">
                        <span><i class="icon-user mr-2 text-info"></i>{{ $user->full_name }}</span>
                    </li>
                    <li class="my-3">
                        <span><i class="icon-graduation mr-2 text-info"></i>{{ $user->carrera->name }}</span>
                    </li>
                    <li class="my-3">
                        <span><i class="icon-envelope mr-2 text-info"></i>{{ $user->email }}</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-5">
                <ul class="list-style-none">
                    <li class="my-3">
                        <span><i class="icon-user mr-2 text-info"></i>{{ $user->matricula }}</span>
                    </li>
                    <li class="my-3">
                        <span><i class="icon-phone mr-2 text-info"></i>{{ $user->telephone }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <hr/>
        <br>

        {{-- Documentos --}}
        <div class="row">
            <div class="col-md-12 border-bottom pb-3">
                <span class="font-weight-medium text-dark">
                    <i class="icon-docs mr-2 text-info"></i> Documentos enviados:
                </span>
            </div>
                @foreach ($files as $document)
                    <div class="col-md-6 my-3">
                        <span>
                            <i class="icon-paper-clip mr-2 text-info"></i>
                            <a target="_blank" href="{{ route('file.response', ['file_id' => $document->path]) }}">
                                {{ class_basename($document->path) }}
                            </a>
                        </span>
                    </div>
                @endforeach
        </div>
    </x-cards.page>
</div>
@endsection
