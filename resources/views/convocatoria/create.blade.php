@extends('admin.admin-master')

@section('css')
<link rel="stylesheet" href="{{ asset('css/trumbowyg.min.css') }}">
<style>
.item-title{
    font-weight: 500;
    margin-bottom: 10px;
    color: #212529;
}
.item-status{
    display: inline;
    margin: 0px 25px
}
</style>
@endsection

@section('admin-breadcrumb-items')
<li class="breadcrumb-item">
    <a href="{{ route('admin.convocatoria.active') }}" class="text-muted">Convocatoria</a>
</li>
<li class="breadcrumb-item text-muted active" aria-current="page">Nueva</li>
@endsection

@section('body')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <x-cards.page>
        <x-slot name="title">Registro de nueva convocatoria</x-slot>
        <x-slot name="subtitle"></x-slot>
        <hr>


        <form action="{{ route('admin.convocatoria.store') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Title -->
                <div class="col-lg-12">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="txt-title" style="font-weight: bold; padding: 6px 25px;">
                                Título
                            </label>
                        </div>
                        <x-forms.input-error type="text" name="title" id="txt-title" label="Título"/>
                    </div>
                </div>
                <!-- Start date -->
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <x-cards.input>
                        <x-slot name="title">Fecha de inicio</x-slot>
                        <x-slot name="subtitle">Se abrirá automaticamente</x-slot>
                        <x-forms.input-error type="date" name="start_date" label="Fecha de inicio"/>
                    </x-cards.input>
                </div>
                <!-- End date -->
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <x-cards.input>
                        <x-slot name="title">Fecha de cierre</x-slot>
                        <x-slot name="subtitle">Se cerrará automaticamente</x-slot>
                        <x-forms.input-error type="date" name="end_date" label="Fecha de inicio"/>
                    </x-cards.input>
                </div>
                <!-- Status - Period -->
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <x-cards.classic>
                        <x-slot name="title">
                            <span class="item-status">Estatus:</span>
                            <span class="badge badge-info">Inactiva</span>
                        </x-slot>
                        <x-slot name="subtitle"></x-slot>

                        <div class="input-group" style="margin-top: 2rem">
                            <x-prepend-component id="slctPeriod" label="Periodo">
                                <x-forms.select-error name="period" id="slctPeriod" label="Periodo"
                                    :items="$periods" item-val="name"/>
                            </x-prepend-component>
                        </div>
                    </x-cards.classic>
                </div>
                <div></div>
                {{-- Decription --}}
                {{-- <div class="col-lg-12" style="margin-top: 30px">
                    <h4 class="item-title">Descripción de la convocatoria</h4>
                    <textarea name="description" id="editor-convocatoria"></textarea>
                </div> --}}
                <div class="col-lg-12" style="margin-top: 30px">
                    <h4 class="item-title">Descripción de la convocatoria</h4>
                    <textarea name="description" id="editor-convocatoria"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" style="padding: 2rem 0px">
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i> Crear convocatoria
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </x-cards.classic>
</div>
@endsection

@section('js')
{{-- <script src="{{ asset('js/trumbowyg.min.js') }}"></script> --}}
<script src="{{ asset('js/ckeditor4/ckeditor.js') }}"></script>
<script src="{{ asset('js/utils/CustomDate.js') }}"></script>
<script src="{{ asset('js/utils/form-validations.js') }}"></script>

<script type="text/javascript">
$(document).ready(function () {
    // $.trumbowyg.svgPath = "{{ asset('icons/icons.svg')}}";
    // $('#editor-convocatoria').trumbowyg();
    CKEDITOR.replace( 'editor-convocatoria' );

    startDate = new CustomDate("{{ $startDate }}");
    $("#start_date").val(startDate.toIsoLocaleDateString())
    $("#end_date").val(startDate.addMonth(1).toIsoLocaleDateString());

    $("#start_date").change(function (e) {
        let select = document.getElementById("slctPeriod");
        setTitle($("#slctPeriod"), $(this));
    })
    $("#slctPeriod").change(function (e) {
        setTitle($(this), $("#start_date"));
    })
});

function setTitle($slctPeriod, $txtStartDate) {
    let year = CustomDate.fromLocale( $txtStartDate.val() ).getFullYear();

    let select = $slctPeriod[0];
    let selectedIndex = select.selectedIndex;
    let periodo = selectedIndex == 0 ? "" : select.options[selectedIndex].innerText;

    $('#txt-title').val('Convocatoria ' + periodo + ' ' + year);
}
</script>
@endsection
