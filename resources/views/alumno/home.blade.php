@extends('alumno.alumno-master')

@section('css')
<link href="{{ asset('css/egel/components/cards/convocatoria.css') }}" rel="stylesheet">
@endsection

@section('body')
<div class="blog-item post-item">
    <x-cards.empty-page>
        <x-cards.convocatoria :convocatoria="$convocatoria" />

        {{-- BTN REGISTRO --}}
        @if ( !$isRegistred )
            <hr/>
            <div class="text-center">
                <a href="{{ route('alumno.postulacion.create', ['conv_id' => $convocatoria->id]) }}" class="btn btn-primary">
                    Registrarse
                </a>
            </div>
        @endif
    </x-cards.empty-page>
</div>
@endsection
