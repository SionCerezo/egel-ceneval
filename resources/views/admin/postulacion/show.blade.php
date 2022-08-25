@extends('admin.admin-master')

@section('css')
{{-- <link href="{{ asset('vendor/perfect-scrollbar/css/perfect-scrollbar.min.css')}}" rel="stylesheet"> --}}
<style>
/* Deberia irse al gral */
.egel-float-right {
    display: inline-block;
    float: right;
}
.egel-section-body {
    padding: 25px;
}
.comment-box {
    padding: 5px;
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
<x-cards.postulacion :postulacion="$postulacion" :files="$files" :comments="$comments">

    <x-slot name="title">Postulación de {{ $postulacion->alumno->full_name }}</x-slot>
    <x-slot name="subtitle">Información proporcionada por el alumno</x-slot>
    <x-slot name="titleDataSection">Datos de alumno:</x-slot>

    <x-slot name="footer">
        <div class="egel-float-right">
            <div class="egel-section-body">
                <hr/>
                <button type="button" class="btn btn-outline-success">
                    <i class="fa fa-check"></i> Editar
                </button>
            </div>
        </div>
    </x-slot>
</x-cards.postulacion>
@endsection

@section('js')
<script src="{{ asset('template/dist/js/custom.min.js') }}"></script>
<script src="{{ asset('js/utils/CustomDate.js') }}"></script>
<script src="{{ asset('template/assets/libs/moment/min/moment-with-locales.min.js') }}"></script>
<script src="{{ asset('js/postulacion/chat.js') }}"></script>

<script type="text/javascript">
    initChat({
        csrfToken     : '{{ csrf_token() }}',
        postulationId : {{$postulacion->id}},
        storeUrl      : '{{ route("comment.store") }}',
        retrieveUrl   : '{{ route("postulacion.comments", ["postulacion"=>$postulacion->id]) }}'
    });
</script>
@endsection
