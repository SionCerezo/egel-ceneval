@extends('admin.adminmaster')

@section('css')
<link rel="stylesheet" href="{{ asset('css/trumbowyg.min.css') }}">
<style>
.item-title{
    font-weight: 500;
    margin-bottom: 10px;
    color: #212529;
}
</style>
@endsection

@section('body')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">
                Registro de nueva convocatoria
            </h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Convocatoria</li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Nueva</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    @dump($errors)
    <form action="{{ route('admin.convocatoria.store') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Status -->
            <div class="col-lg-12">
                <h3>
                    <h3 class="item-title" style="display: inline; margin: 0px 25px">Status</h3>
                    <span class="badge badge-info">Nueva</span>
                </h3>
            </div>
            <!-- Start date -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                {{-- <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Fecha de inicio</h4>
                        <h6 class="card-subtitle">Se abrirá automaticamente</h6>
                        <div class="form-group">
                            <input type="date" class="form-control" name="startDate" id="startDate">
                        </div>
                    </div>
                </div> --}}
                <x-card>
                    <x-slot name="title">Fecha de inicio</x-slot>
                    <x-slot name="subtitle">Se abrirá automaticamente</x-slot>
                    <x-forms.validation-input type="date" name="startDate" label="Fecha de inicio"/>
                </x-card>
            </div>
            <!-- End date -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <x-card>
                    <x-slot name="title">Fecha de cierre</x-slot>
                    <x-slot name="subtitle">Se cerrará automaticamente</x-slot>
                    <x-forms.validation-input type="date" name="endDate" label="Fecha de inicio"/>
                </x-card>
            </div>
            <!-- Period -->
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="input-group mb-3" style="padding: 25px">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="slctPeriod">Periodo</label>
                    </div>
                    <select class="custom-select" name="period" id="slctPeriod">
                        <option selected="">Elegir...</option>
                        @foreach ($periods as $period)
                            <option value="{{ $period->id }}">{{ $period->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="txt-title"
                            style="font-weight: bold; padding: 6px 25px;">
                            Título
                        </label>
                    </div>
                    {{-- <input type="text" class="form-control" name="title" id="txt-title"> --}}
                    <x-forms.validation-input type="text" name="title" id="txt-title" label="Titulo"/>
                </div>
            </div>
            <div></div>
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
</div>
@endsection

@section('js')
<script src="{{ asset('js/trumbowyg.min.js') }}"></script>
<script src="{{ asset('js/utils/CustomDate.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {
    $.trumbowyg.svgPath = "{{ asset('icons/icons.svg')}}";
    $('#editor-convocatoria').trumbowyg();

    startDate = new CustomDate("{{ $startDate }}");
    $("#startDate").val(startDate.toIsoLocaleDateString())
    $("#endDate").val(startDate.addMonth(1).toIsoLocaleDateString());

    $("#startDate").change(function (e) {
        let select = document.getElementById("slctPeriod");
        setTitle($("#slctPeriod"), $(this));
    })
    $("#slctPeriod").change(function (e) {
        setTitle($(this), $("#startDate"));
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
