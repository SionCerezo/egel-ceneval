@extends('alumno.alumno-master')

@section('alumno-breadcrumb-items')
<li class="breadcrumb-item">
    <a class="text-muted">Postulaciones</a>
</li>
<li class="breadcrumb-item text-muted active" aria-current="page">Actual</li>
@endsection

@section('body')
    @isset($postulacion)
        @if( session('create-success') != null )
        <x-modals.message type='success'>
            <p class="mt-3">{{ session('create-success') }}</p>
        </x-modals.message>
        @endif
        <x-cards.postulacion :postulacion="$postulacion" :files="$files"  :comments="$comments">
            <x-slot name="title">Postulación actual</x-slot>
            <x-slot name="subtitle">
                <a href="{{ route('alumno.home') }}">Detalle de la convocatoria</a>
            </x-slot>

            <x-slot name="titleDataSection">Mis datos:</x-slot>

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

@section('js')
<script src="{{ asset('template/dist/js/custom.min.js') }}"></script>
<script src="{{ asset('js/utils/CustomDate.js') }}"></script>
<script src="{{ asset('js/postulacion/chat.js') }}"></script>

<script type="text/javascript">
    $("#success-alert-modal").modal();
    initChat('{{ csrf_token() }}', {{$postulacion->id}},'{{ route("comment.store") }}');
</script>
@endsection
